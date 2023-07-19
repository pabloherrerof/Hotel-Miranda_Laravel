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
            } else {
                $bookings = Booking::all()->toArray();
                $availableRooms = [];
                foreach ($rooms as $room) {
                    if (count($room->roomAvailability( $bookings, $request->checkIn, $request->checkOut)) === 0) {
                        $availableRooms[] = $room;
                    }
                }
                $rooms = $availableRooms;
            }
        }
        return view('rooms', [
            'rooms' => $rooms
        ]);
    }

    public function showSingle(string $id): View
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
}




