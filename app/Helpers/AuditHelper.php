<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditHelper
{
    public static function log($entity, $entityId, $action, $details = null)
    {
        AuditLog::create([
            'entity' => $entity,
            'entity_id' => $entityId,
            'action' => $action,
            'performed_by' => Auth::id() ?? null,
            'details' => $details,
        ]);
    }
}
