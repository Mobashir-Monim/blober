@extends('layouts.app')

@section('content')
    <quiz-panel token="{{ csrf_token() }}" route="{{ route('quiz.start') }}" time={{ $time }} sessioncode="{{ auth()->user()->getAuth() }}"></quiz-panel>
@endsection