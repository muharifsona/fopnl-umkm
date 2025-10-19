<?php

namespace App\Http\Controllers\Regulator;

use App\Http\Controllers\Controller;
use App\Models\ValidationRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $pending = ValidationRequest::where('status', 'submitted')->count();
        $approved = ValidationRequest::where('status', 'approved')->count();
        $rejected = ValidationRequest::where('status', 'rejected')->count();

        return view('regulator.dashboard', compact('pending', 'approved', 'rejected'));
    }
}
