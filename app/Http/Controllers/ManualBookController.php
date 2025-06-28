<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManualBookController extends Controller
{
    public function index()
    {
        return view('manualbook');
    }
}
