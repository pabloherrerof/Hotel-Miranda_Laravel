<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OffersController extends Controller
{

    public function show(): View
    {
        $offerRooms = Room::where('discount', '>', 0)->get();
        $rooms = Room::all();
        return view('offers', [
            'offerRooms' => $offerRooms,
            'rooms' => $rooms
        ]);
    }
}
