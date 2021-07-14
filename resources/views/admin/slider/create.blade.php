@extends('admin.admin_master')

@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Slider</h2>
        </div>
        <div class="card-body">
            <form action="{{route('store.slider')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input name="title" type="text" class="form-control" id="" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id="" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input name="image" type="file" class="form-control-file" id="">
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <input type="submit" class="btn btn-primary btn-default"></input>
                </div>
            </form>
        </div>
    </div>


@endsection