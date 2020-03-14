@extends('layouts.app')

@section('content')
    <quiz-start
        sessioncode="{{ auth()->user()->getAuth() }}"
        questionslist="{{ json_encode($questions) }}"
        tablelist="{{ json_encode($tables) }}"
        qids="{{ json_encode($qids) }}"
        names="{{ json_encode($names) }}"
        settime="{{ $time }}"
        ></quiz-start>
@endsection