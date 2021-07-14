@extends('admin.admin_master')

@section('admin')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        All Contact
    </h2>
</x-slot>

<div class="py-12">
    <div class="container">
        <div class="row">

            <a href="{{ route('admin.contact.add') }}"><button class="btn btn-info">Add contact</button></a>

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
                        All Contact
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Address</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 1)
                            @foreach($contacts as $contact)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $contact->address }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ Carbon\Carbon::parse($contact->created_at)->diffForHumans() }}</td>
                                <td >
                                    <a href="{{ url('/admin/contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                    <a href="{{ url('/admin/contact/delete/'.$contact->id)}}" onclick="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                    {{ $contacts->links() }}
                </div>
            </div>

        </div>

    </div>
</div>

@endsection