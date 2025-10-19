<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'ingredient_id', 'quantity_g', 'order_index', 'notes'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function ingredient() {
        return $this->belongsTo(Ingredient::class);
    }
}
