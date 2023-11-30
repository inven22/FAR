<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\PenyewaExport;
use App\Exports\LapanganExport;


class DataExport extends Controller 
{
    public function export()
    {
        return Excel::download(new PenyewaExport, 'data_custumer.xlsx');
    }

    public function exportlapang()
    {
        return Excel::download(new LapanganExport, 'data_lapangan.xlsx');
    }
}
