@extends('layouts.app')

@section('content')
    <profile-edit user="{{ auth()->user()->id }}" editor="{{ auth()->user()->id }}"></profile-edit>
@endsection