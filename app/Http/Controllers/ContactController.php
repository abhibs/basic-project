<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function create()
    {
        return view('user.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ], [
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'phone.required' => 'Phone Number is Required',
            'subject.required' => 'Subject is Required',
            'message.required' => 'Message is Required',
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Contact Submitted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
