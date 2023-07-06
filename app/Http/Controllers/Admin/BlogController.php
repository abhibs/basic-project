<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $datas = Blog::latest()->get();
        return view('admin.blogs.index', compact('datas'));
    }
}
