@extends('layouts.app')

@section('content')
    <quiz-create
        systemtags="{{ json_encode(App\Tag::all()->pluck('name')->toArray()) }}"
        labsections="{{ json_encode($sections) }}"
        token="{{ csrf_token() }}"
        route="{{ route('quiz.create') }}"
        ></quiz-create>
@endsection