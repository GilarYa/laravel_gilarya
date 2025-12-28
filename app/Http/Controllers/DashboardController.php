<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use App\Models\Pasien;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalRumahSakit = RumahSakit::count();
        $totalPasien = Pasien::count();
        
        return view('dashboard', compact('totalRumahSakit', 'totalPasien'));
    }
}
