<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationReviewController extends Controller
{
    public function index()
    {
        $requests = ValidationRequest::with(['product', 'submitter'])
            ->where('status', 'submitted')
            ->orderByDesc('submitted_at')
            ->get();

        return view('admin.validation.index', compact('requests'));
    }

    public function show(ValidationRequest $validationRequest)
    {
        $validationRequest->load(['product.ingredients.nutrition', 'product.nutritionSummary']);
        return view('admin.validation.show', compact('validationRequest'));
    }

    public function approve(Request $request, ValidationRequest $validationRequest)
    {
        $validationRequest->update([
            'status' => 'approved',
            'assigned_admin' => Auth::id(),
            'notes' => $request->notes,
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.validation.index')
            ->with('success', '✅ Produk berhasil disetujui.');
    }

    public function reject(Request $request, ValidationRequest $validationRequest)
    {
        $validationRequest->update([
            'status' => 'rejected',
            'assigned_admin' => Auth::id(),
            'notes' => $request->notes,
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.validation.index')
            ->with('error', '❌ Produk ditolak dengan catatan.');
    }
}
