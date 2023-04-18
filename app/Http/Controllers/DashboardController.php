<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rent;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index' );
    }
}
