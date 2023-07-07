<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomDetailController extends Controller
{
    public function show(string $id): View
    {
        $room = Room::findOrFail($id);

        return view('room-detail', [
            'room' => $room,
            'rooms' => Room::where('roomType', $room->roomType)
                ->where('id', '<>', $id)
                ->limit(2)
                ->get()
        ]);
    }

    public function post(Request $request, string $id)
    { 
        $lastBooking = Booking::latest('id')->first();
        echo $lastBooking;
        echo $lastBooking;
        echo $lastBooking;
        echo $lastBooking;
        echo $lastBooking->id;
        if (strtotime($request->checkIn) > strtotime($request->checkOut)) {
            return redirect()->back()->with('error', "Invalid Dates");
        } else if (strtotime($request->checkIn) < strtotime(Carbon::now())) {
            return redirect()->back()->with('error', "The check-in must be after the current date.");
        } else if ($lastBooking) {
            $bookings = Booking::all()->toArray();
            if (count(roomAvailability($id, $bookings, $request->checkIn, $request->checkOut)) === 0) {
                $fechaActual = Carbon::now();
                $lastId = intval(substr($lastBooking->id, 2));

                $booking = new Booking();
                $booking->id = "B-" . str_pad(($lastId + 1), 4, "0", STR_PAD_LEFT);
                $booking->name = $request->name;
                $booking->orderDate = $fechaActual->format('Y-m-d');;
                $booking->checkIn = $request->checkIn;
                $booking->checkOut = $request->checkOut;
                $booking->room = request()->route('id');
                $booking->specialRequest = $request->specialRequest;

                $booking->save();
                return redirect()->back()->with('success', "We have received it correctly. Someone from our Team will get back to you very soon.");
            } else return redirect()->back()->with('error', "The room is booked for these dates.");
        }
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
