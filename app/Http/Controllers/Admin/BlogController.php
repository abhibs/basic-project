<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;


class BlogController extends Controller
{
    public function index()
    {
        $datas = Blog::latest()->get();
        return view('admin.blogs.index', compact('datas'));
    }

    public function create(){
        $categories = BlogCategory::orderBy('name','ASC')->get();
        return view('admin.blogs.create',compact('categories'));
    }
}
