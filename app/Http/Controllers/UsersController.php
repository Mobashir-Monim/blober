<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\UserCreateMail;
use App\User;
use App\Role;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate(User::storeValidator());
        $password = User::generatePassword();
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($password)]);
        $user->roles()->attach($request->role);
        Mail::to($request->email)->send(new UserCreateMail($request->name, $request->email, $password));

        return redirect(route('home'))->with('success', $request->name . ' Registered on the system as a ' . Role::find($request->role)->display_name);
    }
}
