<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function postcomment(Request $request)
    {
        $request->validate([
            '*' => 'required',
        ]);
        // return $request;
        if (Auth::check()) {
            $post = Post::where('slug', $request->post_slug)->where('status', 0)->first();
            // if ($post) {
            Comment::insert([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id,
                'comment' => $request->comment,
                'created_at' => Carbon::now(),
            ]);
            // }
            return redirect()->route('postcomment')->with('message', 'Commented Successfully');
        } else {
            return redirect()->route('login');
        }
    }

    public function destroy(Request $request)
    {
        // return $request->comment_id;
        if (Auth::check()) {
            $comment = Comment::where('id', $request->comment_id)->where('user_id', Auth::id())->first();
            if ($comment) {
                $comment->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment Deleted'
                ]);
            }
        }
    }
}
