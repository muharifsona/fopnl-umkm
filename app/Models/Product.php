<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Ingredient;
use App\Models\ProductIngredient;
use App\Models\NutritionSummary;
use App\Models\Label;
use App\Models\ValidationRequest;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name','description','net_weight','serving_size','status'];

    public function user() { return $this->belongsTo(User::class); }
    public function ingredients() {
        return $this->belongsToMany(Ingredient::class, 'product_ingredients')
                    ->withPivot(['quantity_g','order_index','notes'])
                    ->withTimestamps();
    }
    public function productIngredients() { return $this->hasMany(ProductIngredient::class, 'product_id'); }
    public function nutritionSummary() { return $this->hasOne(NutritionSummary::class); }
    public function labels() { return $this->hasMany(Label::class); }
    public function validationRequest() { return $this->hasOne(ValidationRequest::class, 'product_id'); }
}
