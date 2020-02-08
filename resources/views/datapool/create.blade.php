@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add Datapool</div>

        <div class="card-body">
            <dp-create token="{{ csrf_token() }}" route="{{ route('datapool.create') }}"></dp-create>
        </div>
    </div>
@endsection