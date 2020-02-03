@extends('layouts.app')

@section('content')
    <datapools-view dps="{{ json_encode(App\DataPool::all()->pluck('name', 'id')->toArray()) }}"></datapools-view>
@endsection