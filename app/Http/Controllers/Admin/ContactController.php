<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $datas = Contact::latest()->get();
        return view('admin.contact.index', compact('datas'));
    }
}
