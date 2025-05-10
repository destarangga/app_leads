<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\LeadHistory;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
   public function index(Request $request)
   {
       $status = $request->get('status'); 
    
       $leads = Lead::query();
   
       if ($status == 'taken') {
           $leads = $leads->where('taken_by_salesman', true)->orderBy('id', 'desc');
       } elseif ($status == 'untaken') {
           $leads = $leads->where('taken_by_salesman', false)->orderBy('id', 'asc');
       }

       $leads = $leads->get();
   
       $user = auth()->user();
       return view('leads.index', compact('leads', 'user', 'status')); 
   }
   


    public function create()
    {
        $user = auth()->user(); 

        return view('leads.create', compact( 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'origin' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);


        $lead = Lead::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'origin' => $request->origin,
            'address' => $request->address,
        ]);

    
        return redirect()->route('leads.index')->with('success', 'Lead successfully created.');
    }


    public function history($id)
    {
        $user = auth()->user(); 
        $lead = Lead::findOrFail($id);


        if ($lead->salesman_id != $user->id && $user->role != 'admin') {
            return redirect()->route('leads.index')->with('error', 'Anda tidak dapat mengakses histori lead ini.');
        }

        $leadHistories = LeadHistory::where('lead_id', $id)->get();

        return view('leads.history', compact('leadHistories', 'lead', 'user'));
    }



    public function updateFollowUp(Request $request, $id)
    {
        $request->validate([
            'follow_up_via' => 'required|string',
            'status' => 'required|in:Sudah di Follow UP,Belum di Follow UP,Follow UP ulang',
            'follow_up_date' => 'required|date',
            'notes' => 'nullable|string',
            'next_follow_up_date' => [
                'nullable', 
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->status == 'Follow UP ulang') {
                        if (empty($value)) {
                            $fail('Tanggal follow-up kelanjutan harus diisi ketika status adalah Follow UP ulang.');
                        } elseif (strtotime($value) < strtotime($request->follow_up_date)) {
                            $fail('Tanggal follow-up kelanjutan harus setelah atau sama dengan tanggal follow-up.');
                        }
                    }
                },
            ],
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'job' => 'nullable|string',
            'hobby' => 'nullable|string', 
        ]);

        $lead = Lead::findOrFail($id);

        LeadHistory::create([
            'lead_id' => $id,
            'salesman_id' => auth()->id(),
            'follow_up_via' => $request->follow_up_via,
            'follow_up_date' => $request->follow_up_date,
            'status' => $request->status,
            'notes' => $request->notes,
            'next_follow_up_date' => $request->next_follow_up_date,
            'email' => $request->email,
            'address' => $request->address, 
            'job' => $request->job,
            'hobby' => $request->hobby,
        ]);

        return redirect()->route('leads.history', $id)->with('success', 'Follow-up berhasil ditambahkan.');
    }




    public function take($id)
    {
        $lead = Lead::findOrFail($id);

        if ($lead->taken_by_salesman) {
            return redirect()->route('leads.index')->with('error', 'Lead sudah diambil.');
        }

        $lead->update([
            'taken_by_salesman' => true, 
            'salesman_id' => auth()->id() 
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead telah diambil.');
    }

    public function uploadLeads(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,csv']);

        $file = $request->file('file');
        $leads = Excel::toArray([], $file)[0];

        unset($leads[0]);

        foreach ($leads as $row) {
            Lead::create([
                'name' => $row[0],
                'phone' => $row[1],
                'origin' => $row[2],
                'address' => $row[3],
            ]);
        }

        return redirect()->route('leads.index')->with('success', 'Lead successfully created.');
    }


    public function storeLeadsViaAPI(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'origin' => 'required',
            'address' => 'nullable'
        ]);

        Lead::create($request->all());

        return response()->json(['message' => 'Lead added successfully.']);
    }

    public function monitoringLeads()
    {
        $leads = Lead::where('taken_by_salesman', false)->get();
        return response()->json($leads);
    }

    public function followUpList()
    {
        $user = auth()->user();
        $leads = $user->role == 'salesman'
            ? Lead::where('salesman_id', $user->id)->get()
            : Lead::all();

        return response()->json($leads);
    }

    
}
