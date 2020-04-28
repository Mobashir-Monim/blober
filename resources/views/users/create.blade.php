@extends('layouts.app')

@section('content')
    @if ((new App\Helpers\AuthorizationHelper)->isAuthorized('users.create', 'POST'))
        <div class="card mb-3 text-muted card-rounded">
            <div class="card-body my-0">
                <h5 class="mb-3 border-bottom">Add User</h5>

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
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3 text-muted card-rounded">
                <div class="card-body my-0">
                    <h5 class="mb-3 border-bottom">Upload Student List</h5>

                    <form action="{{ route('students.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mb-2">
                                <input type="file" name="student_data" class="form-control" accept=".xlsx, .xls, .csv">
                            </div>
                            <div class="col-md-4 mb-2">
                                <button class="btn btn-dark w-100">Upload</button>
                            </div>
                            <div class="col-md-12 text-muted text-right" style="font-size: 0.8em">
                                <a href="http://view.officeapps.live.com/op/view.aspx?src={{ request()->root() . '/files/Blober Student Data Format.xlsx' }}" target="_blank">View upload file format</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3 text-muted card-rounded">
                <div class="card-body my-0">
                    <h5 class="mb-3 border-bottom">Upload Lab Instructor List</h5>

                    <form action="{{ route('sections.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mb-2">
                                <input type="file" name="instructor_data" class="form-control" accept=".xlsx, .xls, .csv">
                            </div>
                            <div class="col-md-4 mb-2">
                                <button class="btn btn-dark w-100">Upload</button>
                            </div>
                            <div class="col-md-12 text-muted text-right" style="font-size: 0.8em">
                                <a href="http://view.officeapps.live.com/op/view.aspx?src={{ request()->root() . '/files/Blober Instructor Data Format.xlsx' }}" target="_blank">View upload file format</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection