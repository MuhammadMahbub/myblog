@extends('layouts.app')

@section('title', $setting->meta_title)
@section('meta_description', $setting->meta_description)
@section('meta_keyword', $setting->meta_keyword)

@section('content')
    <div class="container-fluid bg-info p-5">
        <div class="owl-carousel owl-theme">
            @foreach ($categories as $category)
                <div class="card m-3">
                    <img src="{{ asset('uploads/category_photos') . '/' . $category->category_photo }}"
                        class="card-img-top" width="80%" height="200" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">{{ $category->category_name }}</h3>
                        <a href="{{ route('viewcategory', $category->category_name) }}" class="btn btn-primary">Go Here</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h3>Categories</h3>
                <div class="row">
                    @foreach ($allcategory as $category)
                        <div class="col-6" style="font-size: 25px"><a class="text-decoration-none text-danger"
                                href="{{ route('viewcategory', $category->category_name) }}">{{ $category->category_name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-6">
                <h3>Latest Posts</h3>
                <div class="row">
                    @foreach ($latest_posts as $post)
                        <li><a class="text-decoration-none"
                                href="{{ route('viewpost', ['cat_name' => $post->category->category_name, 'post_name' => $post->name]) }}">{{ $post->name }}</a>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
