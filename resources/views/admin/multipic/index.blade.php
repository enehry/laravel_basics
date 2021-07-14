@extends('admin.admin_master')

@section('admin')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Picture
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
                            Multi Pic
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card-group mb-4">
                                    @foreach($multipics as $multipic)
                                        <div class="col-md-4 mt-5">
                                            <div class="card">
                                                <img src=" {{ asset($multipic->image) }}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        {{ $multipics->links() }}
                    </div>
                </div>
                <div class="col-md-4">

                 
                    <div class="card">
                        <div class="card-header">
                            Add Multipic
                        </div>
                        <div class="card-body">
                            <form action="{{ route('multi.image.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="MultiImage">Image</label>
                                    <input name="image[]" type="file" class="form-control" id="brandImage" multiple="">
                                </div>

                                <button type="submit" class="btn btn-primary">Add Image</button>
                            </form>

                            @error('image')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection