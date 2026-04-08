<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'percent',
        'amount',
        'min_total',
        'description'
    ];

    public function menuPlates()
    {
        return $this->hasMany(MenuPlate::class);
    }
}