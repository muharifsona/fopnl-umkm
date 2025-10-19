<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name','default_measure','notes'];

    public function nutrition()
    {
        return $this->hasOne(IngredientNutrition::class, 'ingredient_id', 'id');
    }

    public function productIngredients()
    {
        return $this->hasMany(ProductIngredient::class, 'ingredient_id', 'id');
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'product_ingredients')
                    ->withPivot(['quantity_g','order_index','notes'])
                    ->withTimestamps();
    }
}
