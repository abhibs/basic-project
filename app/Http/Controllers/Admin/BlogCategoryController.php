<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $datas = BlogCategory::latest()->get();
        return view('admin.blogcategory.index', compact('datas'));
    }
}
