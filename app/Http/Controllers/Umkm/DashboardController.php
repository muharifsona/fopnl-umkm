<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalProducts = Product::where('user_id', $user->id)->count();
        $submitted = Product::where('user_id', $user->id)->where('status', 'submitted')->count();
        $approved = Product::where('user_id', $user->id)->where('status', 'approved')->count();
        $rejected = Product::where('user_id', $user->id)->where('status', 'rejected')->count();

        return view('umkm.dashboard', compact('totalProducts', 'submitted', 'approved', 'rejected'));
    }
}
