@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <qp-create
                token="{{ csrf_token() }}"
                route="{{ route('query.create') }}"
                difficulties="[1,2,3,4,5,6,7,8,9,10]"
                pools="{{ json_encode(App\DataPool::all()->pluck('name', 'id')->toArray()) }}"
            >
            </qp-create>
        </div>
    </div>
@endsection