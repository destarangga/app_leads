<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArrayExport;
use App\Imports\NewLeadsImport;
use App\Models\LeadTemplate;
use App\Models\NewLead;
use PDF;

class NewLeadController extends Controller
{

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new NewLeadsImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data leads berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengimpor data: ' . $e->getMessage());
        }
    }

    public function showImport(){
        return view('newleads.import');
    }

    public function showLeads(Request $request)
    {
        $query = NewLead::query();
        $tipi = NewLead::distinct()->pluck('tipe');
        $warna = NewLead::distinct()->pluck('warna');
        $names = NewLead::distinct()->pluck('nama');
        $phoneNumbers = NewLead::distinct()->pluck('nohp');
        $dates = NewLead::distinct()->pluck('tanggal')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d'); 
        });

        foreach (['tipe', 'warna', 'nama', 'nohp', 'tanggal'] as $key) {
            if ($request->filled($key)) {
                if ($key == 'tanggal') {
                    $query->whereDate($key, '=', $request->$key); 
                } else {
                    $query->where($key, 'LIKE', "%{$request->$key}%"); 
                }
            }
        }

        $leads = $query->get();

        if ($request->has('save_template')) {
            LeadTemplate::create([
                'name' => 'Template ' . now()->format('d-m-Y H:i:s'),
                'fields' => json_encode($request->fields ?? []),
                'criteria' => json_encode($request->except(['fields', 'save_template', '_token'])),
            ]);
            return redirect()->back()->with('success', 'Template berhasil disimpan.');
        }

        $templates = LeadTemplate::latest()->get();
        $selectedTemplateId = $request->template_id ?? null;


        return view('newleads.index', compact('leads', 'templates', 'tipi', 'warna', 'names', 'phoneNumbers', 'dates', 'selectedTemplateId'));
    }


    public function export(Request $request)
    {
        $template = LeadTemplate::findOrFail($request->template);
        $fields = json_decode($template->fields, true);
        $criteria = json_decode($template->criteria ?? '[]', true);


        $query = NewLead::query();
        foreach ($criteria as $key => $value) {
            if (!empty($value)) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        $leads = $query->get();

        $filtered = $leads->map(fn($lead) => collect($lead)->only($fields));

        if ($request->format === 'pdf') {
            $pdf = Pdf::loadView('newleads.export-pdf', ['data' => $filtered]);
            return $pdf->download('leads.pdf');
        }

        if ($request->format === 'excel') {
            return Excel::download(new ArrayExport($filtered->toArray()), 'leads.xlsx');
        }

        return redirect()->back()->with('error', 'Format tidak valid.');
    }

    public function deleteTemplate($id)
    {
        $template = LeadTemplate::find($id);

        if (!$template) {
            return redirect()->back()->with('error', 'Template tidak ditemukan.');
        }

        try {
            $template->delete();
            return redirect()->back()->with('success', 'Template berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus template: ' . $e->getMessage());
        }
    }
}

