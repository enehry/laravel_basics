@extends('admin.admin_master')

@section('admin')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        All Message
    </h2>
</x-slot>

<div class="py-12">
    <div class="container">
        <div class="row">
            <p>Messages</p>

            @foreach($messages as $message)
            <div class="col-md-12">
                <div class="card mt-2 p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <p>From : {{ $message->name }}</p>
                        <div>
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#{{ $message->id }}" aria-expanded="false" aria-controls="collapseExample">
                                Show Message
                            </button>
                            <a href="{{ url('admin/contact/message/delete/'.$message->id) }}">
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </a>

                        </div>

                    </div>
                </div>
                <div class="collapse" id="{{ $message->id }}">
                    <div class="card card-body">
                        <p>Subject : {{ $message->subject }}</p>
                        <p>Email : {{ $message->email }}</p>
                        <hr>
                        <p>Message</p>
                        <p>{{ $message->message }}</p>
                    </div>
                    <div class="card card-footer">
                        <div class="d-flex justify-content-end">
                            @if($message->created_at)
                            {{ $message->created_at->diffForHumans() }}
                            @else
                            No data
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
</div>

@endsection