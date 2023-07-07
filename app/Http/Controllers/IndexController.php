<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function show(): View
    {
        $rooms = Room::all();
        return view('index', [
            'rooms' => $rooms
        ]);
    }
}
