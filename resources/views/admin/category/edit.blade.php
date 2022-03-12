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
        <div class="row">
            <div class="col-8">
                <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="status">Category Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{ $category->status == '0' ? 'selected' : '' }}>
                                Show</option>
                            <option value="1" {{ $category->status == '1' ? 'selected' : '' }}>Hide</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            value="{{ $category->category_name }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Category Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                            value="{{ $category->meta_title }}">
                    </div>
                    <div class="form-group">
                        <label>Old Category Photo</label>
                        <img src="{{ asset('uploads/category_photos/' . $category->category_photo) }}" width="200">
                    </div>
                    <div class="form-group">
                        <label>New Category Photo</label>
                        <input type="file" class="form-control" name="new_category_photo">
                    </div>

                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
