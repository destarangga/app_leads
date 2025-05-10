<?php

namespace App\Imports;

use App\Models\NewLead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class NewLeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new NewLead([
            'nomor'      => $row['nomor'],
            'tanggal'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal']),
            'nama'       => $row['nama'],
            'nohp'       => $row['nohp'],
            'alamat'     => $row['alamat'],
            'kelurahan'  => $row['kelurahan'],
            'kecamatan'  => $row['kecamatan'],
            'kota'       => $row['kota'],
            'tipe'       => $row['tipe'],
            'warna'      => $row['warna'],
            'hargajual'  => $row['hargajual'],
            'discount'   => $row['discount'],
            'status'     => $row['status'],
        ]);
    }
}
