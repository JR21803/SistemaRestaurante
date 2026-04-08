<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'employee_id',
        'total',
        'status'
    
    ];

    public function orderLines()
{
    return $this->hasMany(OrderLine::class);
}

public function invoice()
{
    return $this->hasOne(Invoice::class);
}

}