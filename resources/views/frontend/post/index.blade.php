@extends('layouts.app')

@section('title', "$category->meta_title")

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{ $category->category_name }}</h1>
            @forelse ($posts as $post)
                <div class="col-4">
                    <div class="card-body">
                        <h3 class="card-title"><a
                                href="{{ route('viewpost', ['cat_name' => $category->category_name, 'post_name' => $post->name]) }}">{{ $post->name }}</a>
                        </h3>
                        <h4 class="card-subtitle mb-2 text-muted">{{ $post->meta_title }}</h4>
                        <span class="card-text"><b>Created By</b>: {{ $post->user->name }}</span><br>
                        <span class="card-text"><b>Created At</b>: {{ $post->created_at->format('d-m-Y') }}</span>
                    </div>
                </div>
            @empty
                <div>
                    <h3>No Records</h3>
                </div>
            @endforelse
        </div>
        <p>{{ $posts->links() }}</p>
    </div>
@endsection
