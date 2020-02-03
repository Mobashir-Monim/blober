@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <db-inp token="{{ csrf_token() }}" route="{{ route('datapool.create') }}"></db-inp>
        </div>
    </div>
@endsection