<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarchentController extends Controller
{
    public function index()
    {
        return view('marchent.dashboard');
    }
}
