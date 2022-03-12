@extends('layouts.master')

@section('title', 'Blog Category')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Category</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Category</li>
        </ol>

        <a href="{{ route('category.create') }}" class="mb-3 btn btn-dark">Add Category</a>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Title</th>
                            <th scope="col">Category Photo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->meta_title }}</td>
                                <td>
                                    <img width="50"
                                        src="{{ asset('uploads/category_photos/' . $category->category_photo) }}" alt="">
                                </td>
                                <td>{{ $category->status == 1 ? 'Hide' : 'Show' }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-3"><a class="btn btn-outline-info"
                                                href="{{ route('category.edit', $category->id) }}">Edit</a></div>
                                        <div class="col-3">
                                            <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-dark">No Record</div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
