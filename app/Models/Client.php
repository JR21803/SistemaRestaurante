<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
    ];

    public function orders()
{
    return $this->hasMany(Order::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
