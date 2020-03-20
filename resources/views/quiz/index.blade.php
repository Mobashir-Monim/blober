@extends('layouts.app')

@section('content')
    <quiz-index token="{{ csrf_token() }}" route="{{ route('quiz.start') }}" time={{ $time }}></quiz-index>
@endsection