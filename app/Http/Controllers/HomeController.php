<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $user = auth()->user();
        $dataset = null;

        if ($user->hasRole('student')) {
            $dataset = $user->student->generateGraphAnalytics();
        }

        return view('home', compact('user', 'dataset'));
    }

    public function dashboard(Request $request)
    {
        $user = User::find($request->user);
        $dataset = null;

        if ($user->hasRole('student')) {
            $dataset = $user->student->generateGraphAnalytics();
        }

        return view('home', compact('user', 'dataset'));   
    }
}
