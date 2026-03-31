<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'measurement_unit',
        'description',
    ];

    public function inventories()
    {
        return $this->hasMany(IngredientInventory::class);
    }

    public function plates()
    {
        return $this->belongsToMany(
            Plate::class,
            'plate_ingredients'
        )->withPivot('amount')->withTimestamps();
    }
}