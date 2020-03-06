@extends('layouts.app')

@section('content')
    <quiz-start token="{{ csrf_token() }}" route="{{ route('quiz.start') }}"></quiz-start>
@endsection