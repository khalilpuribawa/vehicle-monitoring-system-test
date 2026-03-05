<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $orangCount = Booking::whereHas('vehicle', function($q) {
            $q->where('type', 'angkutan orang');
        })->count();

        $barangCount = Booking::whereHas('vehicle', function($q) {
            $q->where('type', 'angkutan barang');
        })->count();

        return view('dashboard.index', compact('orangCount', 'barangCount'));
    }
}
