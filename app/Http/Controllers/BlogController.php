<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;


class BlogController extends Controller
{
    public function blog()
    {
        $categories = BlogCategory::orderBy('name', 'ASC')->get();
        $datas = Blog::latest()->get();
        return view('user.blog', compact('datas', 'categories'));
    }
}
