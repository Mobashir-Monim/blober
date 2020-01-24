@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add User</div>
        <div class="card-body">
            <form action="{{ route('users.create') }}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="row mb-2">
                            <div class="col-md-2 my-auto text-right">
                                Name:
                            </div>
                            <div class="col-md">
                                <input type="text" name="name" class="form-control" placeholder="User Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-2 my-auto text-right">
                                Email:
                            </div>
                            <div class="col-md">
                                <input type="email" name="email" class="form-control" placeholder="User Email" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-2 my-auto text-right">
                                Role:
                            </div>
                            <div class="col-md">
                                <select name="role" class="form-control" required>
                                    <option value="">Select Role</option>
                                    @if (auth()->user()->highestRole()->name == 'developer')
                                        @foreach (App\Role::where('level', '<=', auth()->user()->highestRole()->level)->get() as $role)
                                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    @else
                                        @foreach (App\Role::where('level', '<', auth()->user()->highestRole()->level)->get() as $role)
                                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md offset-md-2">
                                <button type="submit" class="btn btn-success w-100">Add User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection