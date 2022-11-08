<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logged_id = Auth::id();
        $logged_userName = Auth::user()->name;
        $users = User::where('id', '!=', $logged_id) -> simplepaginate(2);
        $total_user = User::count();

        return view('home', compact('users', 'logged_userName', 'total_user'));
    }
}
