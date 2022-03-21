@extends('layouts.master')

@section('title', 'Blog Post')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Post</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Post</li>
        </ol>

        <a href="{{ route('post.create') }}" class="mb-3 btn btn-dark">Create Post</a>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $post->category->category_name }}</td>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->meta_title }}</td>
                                <td>{{ $post->status == 1 ? 'Hide' : 'Show' }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-3"><a class="btn btn-outline-info"
                                                href="{{ route('post.edit', $post->id) }}">Edit</a></div>
                                        <div class="col-3">
                                            <form action="{{ route('post.destroy', $post->id) }}" method="post">
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
