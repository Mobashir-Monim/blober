@extends('layouts.app')

@section('content')
    <quiz-edit
        systemtags="{{ json_encode(App\Tag::all()->pluck('name')->toArray()) }}"
        labsections="{{ json_encode($sections) }}"
        token="{{ csrf_token() }}"
        route="{{ route('quiz.edit', ['quiz' => $quiz->id]) }}"
        classeslist="{{ $quiz->data }}"
        section="{{ $quiz->section }}"
        date="{{ Carbon\Carbon::parse($quiz->start)->format('Y-m-d') }}"
        start="{{ Carbon\Carbon::parse($quiz->start)->format('H:i:s') }}"
        end="{{ Carbon\Carbon::parse($quiz->end)->format('H:i:s') }}"
        ></quiz-edit>
@endsection