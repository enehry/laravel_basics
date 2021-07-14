@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    @if(session('success'))
    <div class="mb-4 alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> {{ session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Contact</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/contact/update/'.$contact->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Address</label>
                    <input value="{{ $contact->address }}" name="address" type="text" class="form-control" id="" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input value="{{ $contact->email }}"  name="email" type="email" class="form-control" id="" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input value="{{ $contact->phone }}"  name="phone" type="text" class="form-control" id="" placeholder="Phone">
                </div>
                <input type="submit" class="btn btn-primary" value="Update">
            </form>
        </div>
    </div>

    @endsection