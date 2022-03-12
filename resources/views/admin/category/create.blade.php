@extends('layouts.master')

@section('title', 'Create Category')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create Category</li>
        </ol>
        <div class="mb-3">
            <a href="{{ route('category.index') }}" class="btn btn-dark">Category</a>
        </div>
        <div class="row">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="mb-3">
                        <li class="text-danger">{{ $error }}</li>
                    </div>
                @endforeach
            @endif
            <div class="col-8">
                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            value="{{ old('category_name') }}">
                    </div>
                    <div class="form-group">
                        <label>Category Photo</label>
                        <input type="file" class="form-control" id="category_photo" name="category_photo"
                            value="{{ old('category_photo') }}">
                    </div>
                    <div>
                        <img width="200" id="output">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" id="description"
                            name="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                            value="{{ old('meta_title') }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                            value="{{ old('meta_keyword') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" id="status" name="status">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        document.getElementById('category_photo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('output').src = src
        }
    </script>
@endsection
