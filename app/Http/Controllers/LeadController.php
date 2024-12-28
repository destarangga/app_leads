<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\LeadHistory;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{
   // Menampilkan daftar leads dengan filter
    public function index(Request $request)
    {
        $status = $request->get('status'); // Mendapatkan parameter status dari request

        // Query untuk menghitung jumlah total leads, leads yang diambil, dan leads yang belum diambil
        $totalLeads = Lead::count();
        $takenLeads = Lead::where('taken_by_salesman', true)->count();
        $untakenLeads = Lead::where('taken_by_salesman', false)->count();                                           
        // Membuat query untuk mengambil semua leads
        $leads = Lead::query();

        // Menambahkan filter jika status dipilih
        if ($status == 'taken') {
            $leads = $leads->where('taken_by_salesman', true);
        } elseif ($status == 'untaken') {
            $leads = $leads->where('taken_by_salesman', false);
        }

        // Mendapatkan data leads setelah filter diterapkan
        $leads = $leads->get();

        $user = auth()->user(); // Mendapatkan data user yang sedang login
        return view('leads.index', compact('leads', 'user', 'status', 'totalLeads', 'takenLeads', 'untakenLeads')); // Mengirim data leads, user, dan status ke Blade
    }


    // Menampilkan form untuk menambahkan lead
    public function create()
    {
        $user = auth()->user(); 

        return view('leads.create', compact( 'user'));
    }

    // Menyimpan data lead baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'origin' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Membuat Lead baru
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
        $lead = Lead::findOrFail($id); // Mendapatkan lead berdasarkan ID

        // Cek apakah lead sudah diambil oleh salesman yang sedang login, atau jika role admin
        if ($lead->salesman_id != $user->id && $user->role != 'admin') {
            return redirect()->route('leads.index')->with('error', 'Anda tidak dapat mengakses histori lead ini.');
        }

        $leadHistories = LeadHistory::where('lead_id', $id)->get(); // Mengambil riwayat follow-up terkait lead

        return view('leads.history', compact('leadHistories', 'lead', 'user')); // Mengirimkan data ke view
    }



    // Fungsi untuk update status follow up lead
    public function updateFollowUp(Request $request, $id)
    {
        // Validasi input form follow-up
        $request->validate([
            'follow_up_via' => 'required|string',
            'status' => 'required|in:Sudah di Follow UP,Belum di Follow UP,Follow UP ulang', // Enum status follow-up
            'follow_up_date' => 'required|date',
            'notes' => 'nullable|string',
            'next_follow_up_date' => [
                'nullable', 
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    // Validasi jika statusnya adalah 'Follow UP ulang'
                    if ($request->status == 'Follow UP ulang') {
                        if (empty($value)) {
                            $fail('Tanggal follow-up kelanjutan harus diisi ketika status adalah Follow UP ulang.');
                        } elseif (strtotime($value) < strtotime($request->follow_up_date)) {
                            $fail('Tanggal follow-up kelanjutan harus setelah atau sama dengan tanggal follow-up.');
                        }
                    }
                },
            ],
            'email' => 'nullable|email', // Validasi untuk email
            'address' => 'nullable|string', // Validasi untuk address
            'job' => 'nullable|string', // Validasi untuk pekerjaan pelanggan
            'hobby' => 'nullable|string', // Validasi untuk hobby
        ]);

        $lead = Lead::findOrFail($id);

        // Menambahkan riwayat follow-up baru
        LeadHistory::create([
            'lead_id' => $id,
            'salesman_id' => auth()->id(),
            'follow_up_via' => $request->follow_up_via,
            'follow_up_date' => $request->follow_up_date,
            'status' => $request->status,
            'notes' => $request->notes,
            'next_follow_up_date' => $request->next_follow_up_date, // Opsional untuk menentukan jadwal follow-up selanjutnya
            'email' => $request->email, // Menyimpan email
            'address' => $request->address, // Menyimpan address
            'job' => $request->job, // Menyimpan pekerjaan pelanggan
            'hobby' => $request->hobby, // Menyimpan hobby
        ]);

        return redirect()->route('leads.history', $id)->with('success', 'Follow-up berhasil ditambahkan.');
    }




    // Fungsi untuk mengambil lead
    public function take($id)
    {
        $lead = Lead::findOrFail($id);

        // Pastikan hanya salesman yang dapat mengambil lead
        if ($lead->taken_by_salesman) {
            return redirect()->route('leads.index')->with('error', 'Lead sudah diambil.');
        }

        // Update status lead menjadi diambil dan simpan ID salesman
        $lead->update([
            'taken_by_salesman' => true, // Menandai lead sudah diambil
            'salesman_id' => auth()->id() // Menyimpan ID salesman yang mengambil lead
        ]);

        return redirect()->route('leads.index')->with('success', 'Lead telah diambil.');
    }

    // Fungsi upload leads via Excel
    public function uploadLeads(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,csv']);

        $file = $request->file('file');
        $leads = Excel::toArray([], $file)[0];

        foreach ($leads as $row) {
            Lead::create([
                'name' => $row[0],
                'phone' => $row[1],
                'origin' => $row[2],
                'address' => $row[3],
            ]);
        }

        return response()->json(['message' => 'Leads uploaded successfully.']);
    }

    // Fungsi untuk menambahkan lead via API
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

    // Menampilkan leads yang belum diambil oleh salesman
    public function monitoringLeads()
    {
        $leads = Lead::where('taken_by_salesman', false)->get();
        return response()->json($leads);
    }

    // Daftar leads berdasarkan role salesman
    public function followUpList()
    {
        $user = auth()->user();
        $leads = $user->role == 'salesman'
            ? Lead::where('salesman_id', $user->id)->get()
            : Lead::all();

        return response()->json($leads);
    }

    
}
