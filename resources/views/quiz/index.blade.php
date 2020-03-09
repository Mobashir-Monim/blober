@extends('layouts.app')

@section('content')
    <quiz-index token="{{ csrf_token() }}" route="{{ route('quiz.start') }}"></quiz-index>
@endsection