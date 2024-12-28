<?php

namespace App\Exports;

use App\Models\LeadHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LeadHistoryExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize
{
    /**
     * Menentukan data yang akan diexport
     */
    public function collection()
    {
        return LeadHistory::select('id', 'follow_up_via', 'status', 'follow_up_date', 'notes', 'email', 'address', 'job', 'hobby')->get(); // Ambil data yang relevan
    }

    /**
     * Menentukan headings untuk kolom pada Excel
     */
    public function headings(): array
    {
        return [
            'NO',
            'Metode Follow-Up',
            'Status',
            'Tanggal Follow-Up',
            'Keterangan',
            'Email',
            'Alamat',
            'Pekerjaan Pelanggan',
            'Hobi',
        ];
    }

    /**
     * Menentukan bagaimana setiap row akan dimapping
     */
    public function map($leadHistory): array
    {
        return [
            $leadHistory->id, // Metode Follow-Up
            $leadHistory->follow_up_via, // Metode Follow-Up
            $leadHistory->status, // Status
            $leadHistory->follow_up_date, // Tanggal Follow-Up
            $leadHistory->notes, // Keterangan
            $leadHistory->email, // Email
            $leadHistory->address, // Alamat
            $leadHistory->job, // Pekerjaan Pelanggan
            $leadHistory->hobby, // Hobi
        ];
    }

    /**
     * Menambahkan gaya untuk header dan data
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Gaya untuk header (row 1)
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'D3D3D3']], // Warna latar belakang abu-abu muda
            ],
            // Gaya untuk kolom NO (A), Metode Follow-Up (B), dan seterusnya
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
                'alignment' => ['horizontal' => 'center'],
            ],
            'E2:E1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'F2:F1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'G2:G1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'H2:H1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            'I2:I1000' => [
                'alignment' => ['horizontal' => 'left'],
            ],
            // Menambahkan border di seluruh tabel
            'A1:I1' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }

    /**
     * Menentukan judul sheet pada file Excel
     */
    public function title(): string
    {
        return 'Riwayat Follow-Up Lead'; // Menentukan judul sheet di Excel
    }
}
