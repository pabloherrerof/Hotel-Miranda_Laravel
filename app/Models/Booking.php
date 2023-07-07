<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'orderDate', 'checkIn', 'checkOut', 'room', 'specialRequest'];
    protected $keyType = 'string';
}
