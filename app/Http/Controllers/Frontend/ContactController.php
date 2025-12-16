<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function show()
    {
        return view('frontend.contact_message.show');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('message', 'Your message has been sent successfully, we will get back to you soon.');
    }
}
