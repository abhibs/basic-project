<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;

class QueryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ], [
            'name.required' => 'Name is Required',
            'email.required' => 'Email is Required',
            'phone.required' => 'Phone Number is Required',
            'message.required' => 'Message is Required',
        ]);

        Query::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        $notification = array(
            'message' => 'Query Submitted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
