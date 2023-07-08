<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function about()
    {
        $data = About::find(1);
        return view('user.about', compact('data'));
    }
}
