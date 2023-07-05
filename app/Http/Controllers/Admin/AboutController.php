<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Image;

class AboutController extends Controller
{
    public function index()
    {
        $data = About::find(1);
        return view('admin.about.index', compact('data'));
    }

    public function updateAbout(Request $request)
    {

        $about_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            if (file_exists($old_img)) {
                unlink($old_img);
            } else {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 3434343443.jpg

                Image::make($image)->resize(523, 605)->save('storage/about/' . $name_gen);
                $save_url = 'storage/about/' . $name_gen;

                About::findOrFail($about_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'content' => $request->content,
                    'description' => $request->description,
                    'image' => $save_url,

                ]);
            }

            $notification = array(
                'message' => 'About Page Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'content' => $request->content,
                'description' => $request->description,

            ]);
            $notification = array(
                'message' => 'About Page Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }

    }
}
