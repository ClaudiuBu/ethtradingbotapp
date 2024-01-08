<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TokenListenerService;

class Main extends Controller
{
    public function index()
    {
        return view('front.main');
    }
}
