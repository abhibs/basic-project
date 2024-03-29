<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Image;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function index()
    {
        $datas = Blog::latest()->get();
        return view('admin.blogs.index', compact('datas'));
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('name', 'ASC')->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 3434343443.jpg

        Image::make($image)->resize(430, 327)->save('storage/blog/' . $name_gen);
        $save_url = 'storage/blog/' . $name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'title' => $request->title,
            'tags' => $request->tags,
            'description' => $request->description,
            'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('blog')->with($notification);

    }

    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('name', 'ASC')->get();
        return view('admin.blogs.edit', compact('data', 'categories'));
    }

    public function update(Request $request)
    {

        $blog_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 3434343443.jpg

            Image::make($image)->resize(430, 327)->save('storage/blog/' . $name_gen);
            $save_url = 'storage/blog/' . $name_gen;

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'title' => $request->title,
                'tags' => $request->tags,
                'description' => $request->description,
                'image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Blog Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('blog')->with($notification);

        } else {

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'title' => $request->title,
                'tags' => $request->tags,
                'description' => $request->description,
            ]);

            $notification = array(
                'message' => 'Blog Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('blog')->with($notification);

        }

    }

    public function delete($id)
    {
        $data = Blog::findOrFail($id);
        $img = $data->image;
        unlink($img);
        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
