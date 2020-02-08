@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add Datapool</div>

        <div class="card-body">
            <db-inp token="{{ csrf_token() }}" route="{{ route('datapool.create') }}"></db-inp>
        </div>
    </div>
@endsection