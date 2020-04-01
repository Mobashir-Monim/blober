@extends('layouts.app')

@section('content')
    <quiz-start
        sessioncode="{{ $authcode }}"
        questionslist="{{ json_encode($data['questions']) }}"
        tablelist="{{ json_encode($data['tables']) }}"
        qids="{{ json_encode($data['qids']) }}"
        names="{{ json_encode($data['names']) }}"
        settime="{{ $data['time'] }}"
        quid="{{ $data['quiz_id'] }}"
        attemptlist="{{ $data['groups'] }}"
        endurl="{{ route('quiz.invalid') }}"

        ></quiz-start>
@endsection