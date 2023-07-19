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

   
}

