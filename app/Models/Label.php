<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'label_type', 'label_image_path', 'qr_code_value', 'generated_at', 'version'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
