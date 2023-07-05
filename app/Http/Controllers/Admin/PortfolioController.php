<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index(){

        $datas = Portfolio::latest()->get();
        return view('admin.portfolio.index',compact('datas'));
    }
}
