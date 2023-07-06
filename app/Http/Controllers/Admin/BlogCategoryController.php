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

    public function edit($id)
    {
        $data = BlogCategory::findOrFail($id);
        return view('admin.blogcategory.edit', compact('data'));
    }

    public function update(Request $request){
        $id = $request->id;

        BlogCategory::findOrFail($id)->update([
               'name' => $request->name,
           ]);

           $notification = array(
           'message' => 'Blog Category Updated Successfully',
           'alert-type' => 'success'
       );

       return redirect()->route('blog-category')->with($notification);

   }
}
