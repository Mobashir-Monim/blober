@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Update Profile</div>
        <div class="card-body">
            <h3 class="border-bottom mb-3">Personal Information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Name:</div>
                        <div class="col-md">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ auth()->user()->name }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Email:</div>
                        <div class="col-md">
                            <input type="text" name="name" class="form-control disabled" placeholder="Name" value="{{ auth()->user()->email }}" disabled required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-6">
                    <button type="submit" class="btn btn-success w-100">Update Personal Information</button>
                </div>
            </div>

            <h3 class="border-bottom mb-3">Password</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">New Password:</div>
                        <div class="col-md my-auto">
                            <input type="password" name="password" class="form-control" placeholder="New Password" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Confirm Password:</div>
                        <div class="col-md my-auto">
                            <input type="password" name="password_confirmed" class="form-control" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 text-right my-auto">Current Password:</div>
                        <div class="col-md my-auto">
                            <input type="password" name="current_password" class="form-control" placeholder="Current Password" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-auto">
                    <button type="submit" class="btn btn-danger w-100">Update Password</button>
                </div>
            </div>
        </div>
    </div>
@endsection