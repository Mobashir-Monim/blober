@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md" style="height: 90vh !important"></div>
        <div class="col-md-8 my-auto">
            <div class="card text-white {{ $message ? 'bg-success' : 'bg-danger' }} mb-3">
                <div class="card-header text-center h1">{{ $message ? 'Quiz Completed!' : '403 Forbidden' }}</div>
                <div class="card-body h4">
                <h2 class="card-title text-center">{{ $message ? 'Your Quiz has been submitted' : 'Invalid Request' }}</h2>
                <p class="card-text text-center">
                    <div class="text-center">{{ $message ? '' : 'Your quiz has already ended.' }}</div>
                    @if (!$message)
                        <div class="text-center">You have either submitted your quiz or time ran out. :'(</div>
                    @endif
                    <div class="mt-5 text-center">Please close this window to return to application.</div>
                </p>
                </div>
            </div>
        </div>
        <div class="col-md" style="height: 90vh !important"></div>
    </div>
@endsection