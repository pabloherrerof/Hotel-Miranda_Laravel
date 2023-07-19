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

    public function roomAvailability($bookings, $startDate, $endDate)
    {
        return array_filter($bookings, function ($booking) use ($startDate, $endDate) {
            return ($booking['room'] === $this->id &&
                (
                    (strtotime($booking['checkIn']) >= strtotime($startDate) &&
                        strtotime($booking['checkIn']) <= strtotime($endDate)) ||
                    (strtotime($booking['checkOut']) >= strtotime($startDate) &&
                        strtotime($booking['checkOut']) <= strtotime($endDate)) ||
                    (strtotime($booking['checkIn']) <= strtotime($startDate) &&
                        strtotime($booking['checkOut']) >= strtotime($endDate))
                )
            );
        });
    }
}
