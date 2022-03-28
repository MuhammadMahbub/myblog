@extends('layouts.master')

@section('title', 'Blog Category')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Category</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
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
                        @forelse ($categories as $key=>$category)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
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
                                            {{-- <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger">Delete</button>
                                            </form> --}}
                                            <button type="button" class="btn btn-outline-danger" id="delete_category_btn"
                                                value="{{ $category->id }}">Delete</button>
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

    {{-- ;;;;;;;;;;; MODAL ....... --}}
    <!-- Button trigger modal -->
    <!-- Modal -->
    <form action="{{ route('categorydelete') }}" method="POST">
        @csrf
        <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Delete Category</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="category_delete_id" id="category_delete_id">
                        <h5>R U Sure?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Yap Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // $('#delete_category_btn').click(function(e) {
            $(document).on('click', '#delete_category_btn', function(e) {
                e.preventDefault();
                var cat_id = $(this).val()
                $('#category_delete_id').val(cat_id)
                $('#delete_modal').modal('show')
            })
        })
    </script>
@endsection
