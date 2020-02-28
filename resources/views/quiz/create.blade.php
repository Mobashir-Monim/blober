@extends('layouts.app')

@section('content')
    <quiz-create
        systemtags="{{ json_encode(App\Tag::all()->pluck('name')->toArray()) }}"
        labsections="{{ json_encode(App\Student::select('section')->groupBy('section')->get()->pluck('section')->toArray()) }}"
        token="{{ csrf_token() }}"
        route="{{ route('quiz.create') }}"
        ></quiz-create>
@endsection