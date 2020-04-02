@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">All Quiz</div>
        <div class="card-body text-muted">
            @foreach ($quizzes as $quiz)
                <div class="card mb-3" style="border-radius: 25px">
                    <div class="card-body">
                        <h5 class="card-title border-bottom">Section: {{ $quiz->section }}</h5>
                        <div class="row mb-3" style="font-size: 0.9em">
                            <div class="col-md-6">
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Total Questions:</div>
                                    <div class="col-md-6 text-right">{{ $quiz->questionCount() }}</div>
                                </div>
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Total Groups:</div>
                                    <div class="col-md-6 text-right">{{ $quiz->groupCount() }}</div>
                                </div>
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Duration:</div>
                                    <div class="col-md-6 text-right">{{ Carbon\Carbon::parse($quiz->duration())->format("H:i:s") }}</div>
                                </div>
                                <div class="row border-bottom pt-2 ml-1">
                                    <div class="col-md-6">Start Time:</div>
                                    <div class="col-md-6 text-right">{{ Carbon\Carbon::parse($quiz->start)->format("H:i a d M, Y") }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-auto text-right">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div style="font-size: 0.8em; margin-bottom: -3px;">Created</div>
                                            <i>{{ $quiz->creator->name }} on {{ Carbon\Carbon::parse($quiz->created_at)->format("d M, Y") }}</i>
                                            <div style="font-size: 0.8em; margin-bottom: -3px;">Last Updated</div>
                                            @if (is_null($quiz->updator))
                                                <i>NOT UPDATED YET</i>
                                            @else
                                                <i>{{ $quiz->updator->name }} on {{ Carbon\Carbon::parse($quiz->updated_at)->format("d M, Y") }}</i>
                                            @endif
                                        </div>
                                        <a href="#/" class="pl-5 text-primary">View Quiz</a>
                                        <a href="#/" class="pl-5 text-secondary">Edit Quiz</a>
                                        <a href="#/" class="pl-5 text-danger">Delete Quiz</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection