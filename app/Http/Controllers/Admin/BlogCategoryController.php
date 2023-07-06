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

    public function create()
    {

        return view('admin.blogcategory.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Blog Cateogry Name is Required',
        ]);

        BlogCategory::insert([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog-category')->with($notification);
    }
}
