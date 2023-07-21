<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function show()
    {   
        return view('about');
    }
}