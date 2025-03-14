<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $trips = Trip::where('status', 'ongoing')->get();
        return view('index', compact('trips'));
    }
}
