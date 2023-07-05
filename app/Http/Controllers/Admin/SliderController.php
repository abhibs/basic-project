<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;

class SliderController extends Controller
{
    public function index()
    {
        $data = Slider::find(1);
        return view('admin.slider.index', compact('data'));
    }

    public function updateSlider(Request $request)
    {

        $slide_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(636, 852)->save('storage/slider/' . $name_gen);
            $save_url = 'storage/slider/' . $name_gen;
            Slider::findOrFail($slide_id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'video' => $request->video,
                'image' => $save_url,
            ]);
            $notification = array(
                'message' => 'Home Slider Updated with Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        } else {

            Slider::findOrFail($slide_id)->update([
                'title' => $request->title,
                'content' => $request->content,
                'video' => $request->video,

            ]);
            $notification = array(
                'message' => 'Home Slider Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }

    }
}
