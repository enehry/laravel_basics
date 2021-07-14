@extends('admin.admin_master')

@section('admin')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Home About
    </h2>
</x-slot>

<div class="py-12">
    <div class="container">
        <div class="row">

            <a href="{{ route('add.about') }}"><button class="btn btn-info">Add about</button></a>

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
                        All Home About
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">#</th>
                                <th scope="col" width="10%">Title</th>
                                <th scope="col" width="15%">Short Description</th>
                                <th scope="col" width="20%">Long Description</th>
                                <th scope="col" width="10%">Created At</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($homeAbout as $about)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $about->title }}</td>
                                <td>{{ $about->short_des }}</td>
                                <td>{{ $about->long_des }}</td>
                                <td>{{ Carbon\Carbon::parse($about->created_at)->diffForHumans() }}</td>
                                <td >
                                    <a href="{{ url('/home/about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/home/about/delete/'.$about->id)}}" onclick="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                    {{ $homeAbout->links() }}
                </div>
            </div>

        </div>

    </div>
</div>

@endsection