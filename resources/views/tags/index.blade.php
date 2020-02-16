@extends('layouts.app')

@section('content')
    <tags-view querytags="{{ $tags }}"></tags-view>
@endsection