@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Datapools</div>
        <div class="card-body">
            <div class="row">
                @foreach (App\Datapool::all() as $dp)
                    <div class="col-md-2"><a href="#/" class="btn btn-secondary w-100">{{ $dp->name }}</a></div>

                    @if ($loop->iteration == 6)
                        </div>
                        <div class="row">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection