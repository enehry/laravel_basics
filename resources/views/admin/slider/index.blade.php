@extends('admin.admin_master')

@section('admin')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Sliders
    </h2>
</x-slot>

<div class="py-12">
    <div class="container">
        <div class="row">

            <a href="{{ route('add.slider') }}"><button class="btn btn-info">Add Slider</button></a>

            <div class="col-md-12">

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
                        All Slider
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="10%">Title</th>
                                <th scope="col" width="20%">Description</th>
                                <th scope="col" width="10%">Slider Image</th>
                                <th scope="col" width="10%">Created At</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($sliders as $slider)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->description }}</td>
                                <td> <img style="height:40px" src=" {{ asset($slider->image) }}" alt="" srcset=""></td>
                                <td>
                                    @if($slider->created_at)
                                    {{ Carbon\Carbon::parse($slider->created_at)->diffForHumans() }}
                                    @else
                                    <span class="text-danger">No Date Set</span>
                                    @endif
                                </td>
                                <td >
                                    <a href="{{ url('/slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/slider/delete/'.$slider->id)}}" onclick="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                    {{ $sliders->links() }}
                </div>
            </div>

        </div>

    </div>
</div>

@endsection