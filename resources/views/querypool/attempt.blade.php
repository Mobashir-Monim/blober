@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <qp-attempt
                token="{{ csrf_token() }}"
                route="{{ route('query.attempt') }}"
                >
            </qp-attempt>
        </div>
    </div>
@endsection