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
            <h2>Create Home About</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('/home/about/update/'.$about->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input name="title" type="text" class="form-control" id="" placeholder="Title" value = "{{ $about->title }}">
                </div>
                <div class="form-group">
                    <label for="">Short Description</label>
                    <textarea name="short_description" class="form-control" id="" rows="3">{{ $about->short_des }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Long Description</label>
                    <textarea name="long_description" class="form-control" id="" rows="3">{{ $about->long_des }}</textarea>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <input type="submit" class="btn btn-primary btn-default"></input>
                </div>
            </form>
        </div>
    </div>


    @endsection