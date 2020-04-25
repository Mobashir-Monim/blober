@extends('layouts.app')

@section('content')
    <qp-index dps="{{ App\DataPool::all()->pluck('name', 'id') }}" sessioncode="{{ auth()->user()->getAuth() }}"></qp-index>
    <a href="{{ route('query.create') }}" class="add-btn btn-dark"></a>
@endsection