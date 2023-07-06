<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Image;

class PortfolioController extends Controller
{
    public function index()
    {

        $datas = Portfolio::latest()->get();
        return view('admin.portfolio.index', compact('datas'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'image' => 'required',
            'type' => 'required',
            'description' => 'required',
        ], [

            'name.required' => 'Portfolio Name is Required',
            'title.required' => 'Portfolio Titile is Required',
            'image.required' => 'Portfolio Image is Required',
            'type.required' => 'Portfolio Type is Required',

        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 3434343443.jpg

        Image::make($image)->resize(1020, 519)->save('storage/portfolio/' . $name_gen);
        $save_url = 'storage/portfolio/' . $name_gen;

        Portfolio::insert([
            'name' => $request->name,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('portfolio')->with($notification);

    }

    public function edit($id)
    {
        $data = Portfolio::findOrFail($id);
        return view('admin.portfolio.edit', compact('data'));
    }

    public function update(Request $request)
    {

        $portfolio_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('image')) {
            unlink($old_img);
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); // 3434343443.jpg

            Image::make($image)->resize(1020, 519)->save('storage/portfolio/' . $name_gen);
            $save_url = 'storage/portfolio/' . $name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'name' => $request->name,
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Portfolio Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('portfolio')->with($notification);

        } else {

            Portfolio::findOrFail($portfolio_id)->update([
                'name' => $request->name,
                'title' => $request->title,
                'type' => $request->type,
                'description' => $request->description,


            ]);
            $notification = array(
                'message' => 'Portfolio Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('portfolio')->with($notification);

        }

    }

    public function delete($id){

        $data = Portfolio::findOrFail($id);
        $img = $data->image;
        unlink($img);

        Portfolio::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Portfolio Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

     }

     
}
