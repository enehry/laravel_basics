<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
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
                            All Category
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->user->name }}</td>
                                    <td>
                                        @if($category->created_at)
                                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                        @else
                                        <span class="text-danger">No Date Set</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('/category/softDelete/'.$category->id)}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>
                </div>
                <div class="col-md-4">

                 
                    <div class="card">
                        <div class="card-header">
                            Add Category
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="categoryName">Category Name</label>
                                    <input name="category_name" type="text" class="form-control" id="categoryName" aria-describedby="emailHelp">

                                </div>

                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>

                            @error('category_name')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Trashed Category
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trashCategory as $category)
                                <tr>
                                    <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->user->name }}</td>
                                    <td>
                                        @if($category->created_at)
                                        {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                        @else
                                        <span class="text-danger">No Date Set</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                                        <a href="{{ url('/category/permanentDelete/'.$category->id) }}" class="btn btn-danger">Permanent Delete</a>
                                    </td>
                                </tr>
                                @endforeach



                            </tbody>
                        </table>
                        {{ $trashCategory->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>