<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function loginPost(Request $request)
    {
        // dd($request->all());
        $credentials = $request->only('email', 'password');
        $credentials['password'] = $request->password;
        //  dd( $credentials);
        if (Auth::guard('admin')->attempt($credentials)) {
            // dd('hi');
            return redirect()->route('admin-dashboard')->with('flash_success', 'Login Successful');
        } else {
            return back()->with('error', 'Invalid Credentials');
        }
    }

    public function dashboard()
    {
        return view('admin.index');
    }
}
