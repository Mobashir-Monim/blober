@extends('layouts.app')

@section('content')
    <profile-edit 
        user="{{ auth()->user()->id }}"
        editor="{{ auth()->user()->id }}"
        route="{{ route('users.password') }}"
        token="{{ csrf_token() }}"
        ></profile-edit>
@endsection