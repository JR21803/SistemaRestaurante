<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_plate_id',
        'amount',
        'line_cost',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuPlate()
    {
        return $this->belongsTo(MenuPlate::class);
    }
}