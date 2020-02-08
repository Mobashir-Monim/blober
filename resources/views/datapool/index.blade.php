@extends('layouts.app')

@section('content')
    <dp-view dps="{{ json_encode(App\DataPool::all()->pluck('name', 'id')->toArray()) }}"></dp-view>
@endsection