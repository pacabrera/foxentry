<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('CheckIfAdmin:role');
    }
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }
}
