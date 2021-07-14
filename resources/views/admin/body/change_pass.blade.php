@extends('admin.admin_master')

@section('admin')


<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>Change Password</h2>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            <p>{{ session('error')}}</p>
        </div>
        @endif
        <form action="{{ route('admin.change') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" class="form-control input-lg" placeholder="Old Password">
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" name="password" class="form-control input-lg" placeholder="New Password">
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control input-lg" placeholder="Confirm Password">
            </div>
            <input class="btn btn-primary" type="Submit">
        </form>
    </div>
</div>

@endsection