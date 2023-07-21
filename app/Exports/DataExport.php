<?php

namespace App\Exports;

use App\Models\MonitoringAngsuran as Monitoring;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Monitoring::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'Nama Anggota',
            'Tanggal',
            'Ditemui',
            'Pola Bayar',
            'Majelis',
            'Anggota',
            'Kondisi',
            'Hasil',
            'Nominal',
            'Dokumentasi',
            'created_at',
            'updated_at'
        ];
    }
}
