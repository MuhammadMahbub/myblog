@extends('layouts.master')

@section('title', 'Blog Post')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Post</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Post</li>
        </ol>
        <div class="row">
            <div class="col-8">
                <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="category_id" class="form-control">
                            @foreach ($category as $category)
                                <option value="{{ $category->id }}"
                                    {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Post Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{ $post->status == '0' ? 'selected' : '' }}>
                                Show</option>
                            <option value="1" {{ $post->status == '1' ? 'selected' : '' }}>Hide</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Post Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $post->name }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Post Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                            value="{{ $post->meta_title }}">
                    </div>
                    <div class="form-group">
                        <label for="summernote">Description</label>
                        <textarea type="text" class="form-control" id="summernote" name="description"
                            value="{!! $post->description !!}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="yt_iframe">YouTube Link</label>
                        <input type="text" class="form-control" id="yt_iframe" name="yt_iframe"
                            value="{{ $post->yt_iframe }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
