<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Border;


class PenyewaExport implements FromCollection,WithHeadings,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data dari database
        $data = DB::table('penyewa')->get();

        // Ubah data menjadi koleksi (collection) untuk diolah oleh Meatwebsite Excel
        $collection = collect($data)->map(function ($item) {
            return [
                'id' => $item->id,
                'nama_penyewa' => $item->nama_penyewa,
                'email' => $item->email,
                'no_hp' => $item->no_hp,
                'alamat' => $item->alamat,
            ];
        });

        return $collection;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Penyewa',
            'Email',
            'No hp',
            'Alamat',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '0', // Format ID sebagai teks
            'B' => '@', // Format Nama Penyewa sebagai teks
            'C' => '0', // Format Email sebagai teks
            'D' => '0', // Format No hp sebagai teks
            'E' => '@', // Format Alamat sebagai teks
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:E1'; // Jangkauan cell yang ingin diberi border
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
