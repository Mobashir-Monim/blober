@extends('layouts.app')

@section('content')
    <quiz-index sessioncode="{{ auth()->user()->getAuth() }}" qlist="{{ json_encode($quizzes) }}"></quiz-index>
@endsection