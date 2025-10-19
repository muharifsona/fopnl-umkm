<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity', 'entity_id', 'action', 'performed_by', 'details'
    ];

    public $timestamps = ['created_at'];
    const UPDATED_AT = null;

    public function user() {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
