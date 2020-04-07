@extends('layouts.app')

@section('content')
    <profile-index userlist="{{ json_encode($users) }}" systemroles="{{ json_encode($roles) }}"></profile-index>
@endsection