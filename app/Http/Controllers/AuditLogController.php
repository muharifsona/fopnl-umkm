<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->orderBy('created_at', 'desc');

        // 🔍 Filter opsional
        if ($request->filled('entity')) {
            $query->where('entity', 'LIKE', '%' . $request->entity . '%');
        }
        if ($request->filled('action')) {
            $query->where('action', 'LIKE', '%' . $request->action . '%');
        }
        if ($request->filled('performed_by')) {
            $query->where('performed_by', $request->performed_by);
        }

        $logs = $query->paginate(20);

        return view('audit.index', compact('logs'));
    }
}
