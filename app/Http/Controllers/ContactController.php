<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ContactController extends Controller
{

    public function show()
    {   
        return view('contact');
    }
    public function post(Request $request)
    {
        $lastContact = Contact::latest('id')->first();
        if($lastContact){
            $fechaActual = Carbon::now();
            $lastId = intval(substr($lastContact->id, 2));
            
            $contact = new Contact();
            $contact->id = "C-" . str_pad(($lastId + 1), 4, "0", STR_PAD_LEFT);
            $contact->date = $fechaActual->format('Y-m-d');;
            $contact->customer = json_encode([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
            ]);
            $contact->subject = htmlspecialchars($request->subject);
            $contact->comment = htmlspecialchars($request->comment);
            $contact->isArchived = 0;
            $contact->save(); 
            return redirect()->back()->with('success', "We have received it correctly. Someone from our Team will get back to you very soon.");
        }
        return redirect()->back()->with('error', "Something went wrong. Try again!");
    }
}
