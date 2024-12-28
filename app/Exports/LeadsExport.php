<?php

// app/Exports/LeadsExport.php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeadsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * Menentukan data yang akan diexport
     */
    public function collection()
    {
        return Lead::all();
    }

    /**
     * Menentukan headings untuk kolom pada Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'No HP',
            'Alamat',
            'Asal Leads',
            'Status',
            'Salesman',
        ];
    }

    /**
     * Menentukan bagaimana setiap row akan dimapping
     */
    public function map($lead): array
    {
        return [
            $lead->id,
            $lead->name,
            $lead->phone,
            $lead->address,
            $lead->origin,
            $lead->taken_by_salesman ? 'Diambil' : 'Belum Diambil',
            $lead->salesman ? $lead->salesman->name : 'N/A',
        ];
    }

    /**
     * Menambahkan gaya untuk header dan data
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Gaya untuk header
            1    => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'D3D3D3']], // Warna latar belakang header abu-abu muda
            ],
            // Gaya untuk kolom No (A), Nama (B), No HP (C), dan seterusnya
            'A2:A1000' => [
                'alignment' => ['horizontal' => 'center'],
            ],
            'B2:B1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'C2:C1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'D2:D1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'E2:E1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'F2:F1000' => [
                'alignment' => ['horizontal' => 'center'],
            ],
            'G2:G1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
        ];
    }
}

