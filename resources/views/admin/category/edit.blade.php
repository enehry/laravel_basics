<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>

    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4">

                  
                    <div class="card">
                        <div class="card-header">
                            Edit Category
                        </div>
                        <div class="card-body">
                            <form action="{{ url('category/update/'.$category->id)}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="categoryName">Update Category Name</label>
                                    <input name="category_name" value="{{ $category->category_name }}" type="text" class="form-control" id="categoryName" aria-describedby="emailHelp">

                                </div>

                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>

                            @error('category_name')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>