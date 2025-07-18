<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulationAdminController extends Controller
{
    public function index()
    {
        return view('admin.simulations-admin');
    }
} 