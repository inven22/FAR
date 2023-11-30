<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LapanganExport implements FromCollection, WithHeadings,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use RegistersEventListeners;

    public function collection()
    {
        // Ambil data dari database
        $data = DB::table('lapangans')->get();

        // Ubah data menjadi koleksi (collection) untuk diolah oleh Maatwebsite Excel
        $collection = collect($data)->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'deskripsi' => $item->deskripsi,
                'waktu' => $item->waktu,
            ];
        });

        return $collection;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Lanpangan',
            'Deskripsi',
            'Batas waktu',
           
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '0', // Format ID sebagai teks
            'B' => '@', // Format Nama Penyewa sebagai teks
            'C' => '0', // Format Deskripsi sebagai teks
            'D' => '0', // Format Batas waktu sebagai teks
           
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:D' . count($this->collection()) + 1; // Jangkauan cell yang ingin diberi border
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Atur jarak antar kolom
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(15);
            },
        ];
    }
}
