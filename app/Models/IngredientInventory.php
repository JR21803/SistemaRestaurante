<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'amount',
        'purchase_date',
        'expiration_date',
        'unit_cost',
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}