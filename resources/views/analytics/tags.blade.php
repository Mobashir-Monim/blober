@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tag Analytics</div>
                <div class="card-body">
                    <analytics-tags headers="{{ json_encode($headers) }}" table="{{ json_encode($vals) }}" vals="{{ sizeof($vals) }}" hlen="{{ sizeof($headers) }}"></analytics-tags>
                </div>
            </div>
        </div>
    </div>
@endsection