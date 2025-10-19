<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ValidationRequest extends Model
{
    use HasFactory;

    protected $table = 'validation_requests'; // ← penting! gunakan bentuk jamak sesuai migrasi

    protected $fillable = [
        'product_id', 'submitted_by', 'assigned_admin', 'status',
        'notes', 'submitted_at', 'reviewed_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function submitter() {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'assigned_admin');
    }

    protected static function booted()
    {
        static::updated(function ($request) {
            if ($request->product) {
                $request->product->update([
                    'status' => $request->status
                ]);
            }
        });

        static::created(function ($request) {
            if ($request->product) {
                $request->product->update([
                    'status' => $request->status
                ]);
            }
        });
    }

}
