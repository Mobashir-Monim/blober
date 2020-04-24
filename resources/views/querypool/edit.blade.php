@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <qp-edit
                token="{{ csrf_token() }}"
                route="{{ route('query.edit', ['query' => $query->id]) }}"
                difficulties="{{ json_encode($difficulties) }}"
                pools="{{ json_encode(App\DataPool::where('id', '!=', $query->data_pool_id)->get()->pluck('name', 'id')->toArray()) }}"
                poolname="{{ $query->datapool->name }}"
                querytags="{{ json_encode(App\Tag::all()->pluck('name', 'id')->toArray()) }}"
                qpool="{{ json_encode($query->toArray()) }}"
                ctags="{{ $tags }}"
            >
            </qp-edit>
        </div>
    </div>
@endsection