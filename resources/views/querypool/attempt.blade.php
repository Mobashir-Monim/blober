@extends('layouts.app')

@section('content')
    <qp-attempt
        token="{{ csrf_token() }}"
        route="{{ route('query.attempt') }}"
        tags="{{ json_encode(App\Tag::all()->pluck('name', 'id')->toArray()) }}"
        sessioncode="{{ auth()->user()->getAuth() }}"
        >
    </qp-attempt>
@endsection