<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $casts = [
        'id' => 'string'
    ];
    protected $fillable = ['id', 'roomType', 'roomNumber', 'description', 'price', 'discount', 'cancellation', 'thumbnail', 'amenities', 'images', 'status'];
}
