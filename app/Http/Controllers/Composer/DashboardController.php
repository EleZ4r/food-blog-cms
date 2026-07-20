<?php

namespace App\Http\Controllers\Composer;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('composer.dashboard');
    }
}