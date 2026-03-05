<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BookingsExport;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new BookingsExport, 'bookings.xlsx');
    }
}
