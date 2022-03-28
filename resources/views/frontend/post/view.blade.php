@extends('layouts.app')

@section('title', 'Post View')
{{-- <style>
    .post_desc {
        overflow-y: scroll;
        scrollbar-width: none;
    }
</style> --}}
@section('content')
    <div class="container">
        <h1>Category: {{ $post->category->category_name }}</h1>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $post->name }}</h3>
                        <span class="card-subtitle mb-2 text-muted post_desc">{{ $post->meta_title }}</span>
                        <p>Desc: {!! $post->description !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-2">
                    <h3>Latest Posts</h3>
                    @foreach ($latest_posts as $post)
                        <li>
                            <a style="text-decoration: none; font-size: 15px"
                                href="{{ route('viewpost', ['cat_name' => $category->category_name, 'post_name' => $post->name]) }}">{{ $post->name }}</a>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-5 mb-5">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="mb-3">
                        <li class="text-danger">{{ $error }}</li>
                    </div>
                @endforeach
            @endif
            <h3>Comment Here::</h3>
            <form method="POST" action="{{ route('postcomment') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="post_slug" value="{{ $post->slug }}">
                    <label for="comment">Comment Here</label>
                    <textarea type="text" class="form-control" id="comment" rows="3" name="comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <h4>All Comments</h4>
        @forelse ($post->comments as $comment)
            <div class="comment_div mt-5 border p-2">
                <p><span>User: <b>{{ $comment->user->name }}</b></span><br><span>Commented at:
                        {{ $comment->created_at }}</span></p>
                <p>{{ $comment->comment }}</p>
                @if (Auth::check() && Auth::id() == $comment->user_id)
                    <button class="btn btn-success">Edit</button>
                    <button class="btn btn-danger deletepost" type="button" value="{{ $comment->id }}">Delete</button>
                @endif
            </div>
        @empty
            <h4>No Comments</h4>
        @endforelse
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.deletepost', function(e) {
                e.preventDefault();
                if (confirm('R u Sure?')) {
                    var comment_id = $(this).val()
                    // alert(comment_id)

                    $.ajax({
                        type: "POST",
                        url: "/delete_comment",
                        data: {
                            'comment_id': comment_id
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                thisClick.closest('.comment_div').remove()
                                alert(response.message)
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection
