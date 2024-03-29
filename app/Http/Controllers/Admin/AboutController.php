<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
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

    public function createMultiImage()
    {
        $data = MultiImage::get();
        return view('admin.about.multipleimagecreate', compact('data'));
    }

    public function storeMultiImage(Request $request)
    {

        $image = $request->file('image');

        foreach ($image as $item) {

            $name_gen = hexdec(uniqid()) . '.' . $item->getClientOriginalExtension(); // 3434343443.jpg

            Image::make($item)->resize(220, 220)->save('storage/multipleimage/' . $name_gen);
            $save_url = 'storage/multipleimage/' . $name_gen;

            MultiImage::insert([

                'image' => $save_url,
                'created_at' => Carbon::now()

            ]);

        }


        $notification = array(
            'message' => 'Multiple Image Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('multiple-image-index')->with($notification);


    }

    public function allMultiImage()
    {
        $datas = MultiImage::get();
        return view('admin.about.indexmultipleimage', compact('datas'));
    }

    public function editMultiImage($id)
    {

        $data = MultiImage::findOrFail($id);
        return view('admin.about.editmultipleimage', compact('data'));

    }

    public function updateMultiImage(Request $request)
    {

        $multi_image_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 3434343443.jpg

            Image::make($image)->resize(220, 220)->save('storage/multipleimage/' . $name_gen);
            $save_url = 'storage/multipleimage/' . $name_gen;

            MultiImage::findOrFail($multi_image_id)->update([

                'image' => $save_url,

            ]);

            $notification = array(
                'message' => 'Multi Image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('multiple-image-index')->with($notification);

        }

    }


    public function deleteMultiImage($id)
    {

        $data = MultiImage::findOrFail($id);
        $img = $data->image;
        unlink($img);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
}
