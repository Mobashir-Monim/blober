@extends('layouts.app')

@section('content')
    <dp-view dps="{{ json_encode(App\DataPool::all()->pluck('name', 'id')->toArray()) }}" addroute="{{ route('datapool.create') }}"></dp-view>
@endsection