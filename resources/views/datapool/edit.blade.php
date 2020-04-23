@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Edit Datapool</div>

        <div class="card-body">
            <dp-edit token="{{ csrf_token() }}" route="{{ route('datapool.edit', ['pool' => $pool->id]) }}" name="{{ $pool->name }}" content="{{ json_encode($tables) }}"></dp-edit>
        </div>
    </div>
@endsection