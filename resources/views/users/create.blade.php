@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add User</div>
        <div class="card-body">
            <form action="{{ route('users.create') }}" method="POST">
                @csrf
                @if (auth()->user()->highestRole()->name == 'developer')
                    <profile-create
                        systemroles="{{ json_encode(App\Role::where('level', '<=', auth()->user()->highestRole()->level)->get()->pluck('name', 'id')->toArray()) }}"
                        ></profile-create>
                @else
                    <profile-create
                        systemroles="{{ json_encode(App\Role::where('level', '<', auth()->user()->highestRole()->level)->get()->pluck('name', 'id')->toArray()) }}"
                        ></profile-create>
                @endif
            </form>
        </div>
    </div>
@endsection