<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Query;

class QueryController extends Controller
{
    public function index()
    {
        $datas = Query::latest()->get();
        return view('admin.query.index', compact('datas'));
    }

    public function delete($id)
    {
        Query::findOrFail($id)->delete();
        $notification = array(
            'message' => 'User Query Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
