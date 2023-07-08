<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function portfolio(){

        $datas = Portfolio::latest()->get();
        return view('user.portfolio',compact('datas'));
       }
}
