@extends('layouts.app')

@section('meta')
    <title>Category</title>
@endsection

@section('content')
    <div class="container">
        <div class="row  p-2 rounded">
            <div class="col-lg-8">
                <div class="card p-2">

                    @if (session('editStatus'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('editStatus') }}
                        </div>
                    @endif
                    <h3>Category List</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Serial</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $index + $categories->firstItem() }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->created_at->DiffForHumans() }}</td>
                                    <td>
                                        <a class="text-danger mx-1"
                                            href="{{ url('/category/delete/' . $category->id) }}">Delete</a>
                                        <a type="button" class="text-success mx-1" data-bs-toggle="modal"
                                            data-bs-target="#categoryEdit{{ $category->id }}">Edit</a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal" id="categoryEdit{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="categoryEditLabel{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="categoryEditLabel{{ $category->id }}">Edit
                                                    Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card px-2 py-4">
                                                    <form action="{{ url('/category/edit') }}" method="post">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="category_name" class="form-label">Category
                                                                Name</label>
                                                            <input type="hidden" name="category_id"
                                                                value="{{ $category->id }}">
                                                            <input type="text" class="form-control" name="category_name"
                                                                id="category_name" value="{{ $category->category_name }}"
                                                                required>
                                                            @error('category_name')
                                                                <div class="alert alert-danger">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <button type="submit" class="btn btn-primary w-25">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-2">
                    <form action="{{ url('/category/insert') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="category_name" required>
                            @error('category_name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    @if (session('status'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
