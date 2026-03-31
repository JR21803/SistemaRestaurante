<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function menuPlates()
    {
        return $this->hasMany(MenuPlate::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredient::class,
            'plate_ingredients'
        )->withPivot('amount')->withTimestamps();
    }
}
