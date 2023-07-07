<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomsController extends Controller
{
    public function show(Request $request)
    {
        $rooms = Room::all();

        if ($request->checkIn != "" && $request->checkOut != "") {
            if (strtotime($request->checkIn) > strtotime($request->checkOut)) {
                return redirect()->back()->with('error', "Invalid Dates");
            } else if (strtotime($request->checkIn) < strtotime(date("Y-m-d"))) {
                return redirect()->back()->with('error', "The check-in must be after the current date.");
            } else {
                $bookings = Booking::all();
                $rooms = [];
                foreach ($rooms as $room) {
                    if (count(roomAvailability($room['id'], $bookings, $request->checkIn, $request->checkOut)) === 0) {
                        $rooms[] = $room;
                    }
                }
            }
        }
        return view('rooms', [
            'rooms' => Room::all()
        ]);
    }
}



function roomAvailability($roomId, $bookings, $startDate, $endDate)
{
    return array_filter($bookings, function ($booking) use ($roomId, $startDate, $endDate) {
        return ($booking['room'] === $roomId &&
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
