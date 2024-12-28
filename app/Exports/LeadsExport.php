<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeadsExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $status;

    /**
     * Constructor untuk menerima filter
     */
    public function __construct($status = null)
    {
        $this->status = $status;
    }

    /**
     * Mengambil data dengan filter (jika ada)
     */
    public function collection()
    {
        $query = Lead::query();

        // Filter data berdasarkan status
        if ($this->status === 'taken') {
            $query->where('taken_by_salesman', true);
        } elseif ($this->status === 'untaken') {
            $query->where('taken_by_salesman', false);
        }

        return $query->get();
    }

    /**
     * Menentukan header kolom pada file Excel
     */
    public function headings(): array
    {
        return [
            'Id Lead',          // Kolom No
            'Nama',        // Kolom Nama
            'No HP',       // Kolom No HP
            'Alamat',      // Kolom Alamat
            'Asal Leads',  // Kolom Asal Leads
            'Status',      // Kolom Status
            'Salesman',    // Kolom Salesman
        ];
    }

    /**
     * Mapping data untuk setiap baris
     */
    public function map($lead): array
    {
        return [
            $lead->id,                                    // No
            $lead->name,                                  // Nama
            $lead->phone,                                 // No HP
            $lead->address,                               // Alamat
            $lead->origin,                                // Asal Leads
            $lead->taken_by_salesman ? 'Diambil' : 'Belum Diambil', // Status
            $lead->salesman?->name ?? 'N/A',             // Salesman
        ];
    }

    /**
     * Menentukan style untuk file Excel
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Header (baris 1)
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => 'D3D3D3'], // Warna abu-abu muda
                ],
            ],

            // Style untuk kolom lainnya
            'A' => ['alignment' => ['horizontal' => 'center']],
            'B' => ['alignment' => ['horizontal' => 'left']],
            'C' => ['alignment' => ['horizontal' => 'left']],
            'D' => ['alignment' => ['horizontal' => 'left']],
            'E' => ['alignment' => ['horizontal' => 'left']],
            'F' => ['alignment' => ['horizontal' => 'center']],
            'G' => ['alignment' => ['horizontal' => 'left']],
        ];
    }
}
