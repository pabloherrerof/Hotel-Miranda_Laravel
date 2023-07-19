<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Order;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrdersController extends Controller
{
    public function show(): View
    {
            $userId = Auth::id();
            $rooms = Order::where('user_id', $userId )->get();;
    
           
            return view('dashboard', [
                'order' => $rooms
            ]);
        }
        public function create(): View
        {
                $userId = Auth::id();
                $rooms = Order::where('user_id', $userId )->get();;
        
               
                return view('dashboard', [
                    'order' => $rooms
                ]);
            }
            public function update(): View
            {
                    $userId = Auth::id();
                    $rooms = Order::where('user_id', $userId )->get();;
            
                   
                    return view('dashboard', [
                        'order' => $rooms
                    ]);
                }

                public function delete(): View
        {
                $userId = Auth::id();
                $rooms = Order::where('user_id', $userId )->get();;
        
               
                return view('dashboard', [
                    'order' => $rooms
                ]);
            }
    }

    

   


