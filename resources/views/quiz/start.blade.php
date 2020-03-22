@extends('layouts.app')

@section('content')
    <quiz-start
        sessioncode="{{ $authcode }}"
        questionslist="{{ json_encode($questions) }}"
        tablelist="{{ json_encode($tables) }}"
        qids="{{ json_encode($qids) }}"
        names="{{ json_encode($names) }}"
        settime="{{ $time }}"
        attemptlist="{{ json_encode($groups) }}"
        ></quiz-start>
@endsection