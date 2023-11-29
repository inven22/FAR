<?php

namespace App\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\PenyewaExport;


class DataExport extends Controller 
{
    public function export()
    {
        return Excel::download(new PenyewaExport, 'data_resep.xlsx');
    }
}
