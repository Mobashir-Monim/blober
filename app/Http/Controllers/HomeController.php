<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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

    public function dashboard(Request $request, $email)
    {
        $user = User::where('email', $email)->first();
        $dataset = null;

        if (is_null($user)) {
            return redirect(route('home'))->with('error', 'User does not exist on the system.');
        }

        if ($user->hasRole('student')) {
            $dataset = $user->student->generateGraphAnalytics();
        }

        return view('home', compact('user', 'dataset'));
    }
}
