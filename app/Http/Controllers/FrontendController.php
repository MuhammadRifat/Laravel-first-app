<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function test() {
        $data = 1234;
        return view('test', compact('data'));
    }
}
