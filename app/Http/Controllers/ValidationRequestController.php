<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ValidationRequest;
use App\Helpers\AuditHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ValidationRequestController extends Controller
{
    public function store(Product $product)
    {
        // 🔹 Buat atau perbarui data pengajuan validasi
        $validation = ValidationRequest::updateOrCreate(
            ['product_id' => $product->id],
            [
                'submitted_by' => Auth::id(),
                'status'       => 'submitted',
                'submitted_at' => Carbon::now(),
            ]
        );

        // 🔹 Catat ke audit log
        AuditHelper::log(
            'validation_requests',          // entity
            $validation->id,                // entity_id
            'submit',                       // action
            sprintf(
                'Produk "%s" diajukan untuk validasi oleh pengguna "%s"',
                $product->name,
                Auth::user()->name ?? 'Tidak diketahui'
            )
        );

        return back()->with('success', 'Produk berhasil diajukan untuk validasi.');
    }

    // Admin melihat daftar pengajuan
    public function index()
    {
        $requests = ValidationRequest::with([
            'product.ingredients.nutrition',
            'product.nutritionSummary',
            'submitter'
        ])->orderByDesc('created_at')->get();

        return view('admin.validation_requests.index', compact('requests'));
    }

    public function update(Request $r, ValidationRequest $validationRequest)
    {
        $validated = $r->validate([
            'status' => 'required|in:approved,rejected',
            'notes'  => 'nullable|string|max:1000',
        ]);

        // 🔹 Simpan data lama untuk keperluan log
        $oldStatus = $validationRequest->status ?? '-';
        $oldNotes = $validationRequest->notes ?? '-';

        // 🔹 Update data validasi
        $validationRequest->update([
            'status'         => $validated['status'],
            'notes'          => $validated['notes'],
            'assigned_admin' => Auth::id(),
            'reviewed_at'    => Carbon::now(),
        ]);

        // 🔹 Tentukan aksi untuk audit log
        $action = $validated['status'] === 'approved' ? 'approve' : 'reject';

        // 🔹 Siapkan detail log
        $details = sprintf(
            'Admin "%s" %s produk "%s" (status sebelumnya: %s). Catatan: %s',
            Auth::user()->name ?? 'Tidak diketahui',
            $action === 'approve' ? 'menyetujui' : 'menolak',
            $validationRequest->product->name ?? 'Tidak diketahui',
            $oldStatus,
            $validated['notes'] ?: '-'
        );

        // 🔹 Catat aktivitas ke audit_logs
        AuditHelper::log(
            'validation_requests',
            $validationRequest->id,
            $action,
            $details
        );

        return back()->with('success', 'Status validasi berhasil diperbarui.');
    }
}
