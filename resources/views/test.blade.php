@extends('layouts.app')

@section('content')
    
    @foreach ($collection as $item)
        <div class="row">

            <div class="col-md-6">{{ $item['query_pool_id'] }}</div>
        </div>
    @endforeach
@endsection