@extends('admin.admin_master')

@section('admin')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

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
                            All Brand
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td> <img style="height:40px" src=" {{ asset($brand->brand_image) }}" alt="" srcset=""></td>
                                    <td>
                                        @if($brand->created_at)
                                        {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                        @else
                                        <span class="text-danger">No Date Set</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('/brand/delete/'.$brand->id)}}" onclick="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>
                <div class="col-md-4">

                 
                    <div class="card">
                        <div class="card-header">
                            Add Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brandName">Brand Name</label>
                                    <input name="brand_name" type="text" class="form-control" id="brandName">
                                </div>
                                <div class="form-group">
                                    <label for="brandImage">Brand Image</label>
                                    <input name="brand_image" type="file" class="form-control" id="brandImage">
                                </div>

                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>

                            @error('brand_image')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection