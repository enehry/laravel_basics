@extends('admin.admin_master')

@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brand
        </h2>

    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                @if(session('success'))
                    <div class="mb-4 alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success</strong> {{ session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                    <div class="card">
                        <div class="card-header">
                            Edit Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brand->id) }}"  method="POST" enctype="multipart/form-data" >
                                @csrf
                                <input type="hidden" name="old_image" value = "{{ $brand->brand_image }}">
                                <div class="form-group">
                                    <label for="brandName">Update Brand Name</label>
                                    <input name="brand_name" value="{{ $brand->brand_name }}" type="text" class="form-control" id="brandName" aria-describedby="emailHelp">

                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($brand->brand_image) }}" alt="" srcset="" style="height:80px">
                                    <label for="brandImage">Update Brand Image</label>
                                    <input name="brand_image" type="file" class="form-control" id="brandImage" aria-describedby="emailHelp">

                                </div>

                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>

                            @error('brand_name')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection