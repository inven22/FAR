<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;


class PenyewaExport implements FromCollection, WithHeadings,WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use RegistersEventListeners;

    public function collection()
    {
        // Ambil data dari database
        $data = DB::table('penyewa')->get();

        // Ubah data menjadi koleksi (collection) untuk diolah oleh Maatwebsite Excel
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
                $cellRange = 'A1:E' . count($this->collection()) + 1; // Jangkauan cell yang ingin diberi border
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
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
            },
        ];
    }
   }
