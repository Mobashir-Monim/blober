<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Mail;
use App\Mail\UserCreateMail;
use App\User;
use App\Role;
use App\Student;

class UsersController extends Controller
{
    public function index()
    {
        $users = array();
        $roles = auth()->user()->highestRole()->level == 6 ? Role::where('level', '<=', auth()->user()->highestRole()->level)->get() : Role::where('level', '<=', auth()->user()->highestRole()->level)->get();

        foreach ($roles as $key => $role) {
            $users[$role->name] = User::select('name', 'email')->whereIn('id', $role->users->pluck('id')->toArray())->get()->toArray();
            $roles[$key] = ucwords($role->name, '-');
        }

        $roles = $roles->toArray();

        // dd($users);

        return view('users.index', compact('users', 'roles'));
    }

    public function get(Request $request)
    {
        $user = User::find($request->user);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->highestRole()->display_name,
            ]
        ]);
    }

    public function create()
    {
        dd(request()->getHttpHost());
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate(User::storeValidator());
        $password = User::generatePassword();
        $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($password)]);
        $user->roles()->attach($request->role);

        if (Role::find($request->role)->name == 'student') {
            $this->createStudent($user, $request);
        }

        Mail::to($request->email)->send(new UserCreateMail($request->name, $request->email, $password));

        return redirect(route('home'))->with('success', $request->name . ' Registered on the system as a ' . Role::find($request->role)->display_name);
    }

    public function createStudent($user, $request)
    {
        $now = Carbon::now();
        
        Student::create([
            'user_id' => $user->id,
            'level_name' => 'Beginner',
            'level' => 0,
            'points' => 0,
            'enrollment' => ($now->month <= 4 ? 'Spring ' : ($now->month <= 8 ? 'Summer ' : 'Fall ')) . $now->year,
            'section' => $request->section,
            'status' => 'first-enrollment',
            'student_id' => $request->student_id
        ]);
    }

    public function edit()
    {
        return view('users.edit');
    }

    public function update(Request $request)
    {
        $user = User::find($request->user);
        $user->name = $request->name;

        if (User::find($request->editor)->highestRole()->level > 2) {
            $user->email = $request->email;
            $user->roles()->attach(Role::where('display_name', $request->role)->first()->id);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'data' => [
                'update' => 'Profile information updated'
            ]
        ]);
    }
}
