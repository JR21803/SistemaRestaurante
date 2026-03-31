<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPlate extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'plate_id',
        'discount_id',
        'is_available',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function plate()
    {
        return $this->belongsTo(Plate::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
}