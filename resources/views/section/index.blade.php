@extends('layouts.app')

@section('content')
    <section-index allsections="{{ json_encode($sections) }}"></section-index>
@endsection