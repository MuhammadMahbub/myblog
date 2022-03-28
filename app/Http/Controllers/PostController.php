<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', '0')->get();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'nullable',
            'yt_iframe' => 'nullable',
        ]);

        $slug = Auth::id() . '--' . $request->name;
        Post::insert([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'yt_iframe' => $request->yt_iframe,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'status' => $request->status == true ? 1 : 0,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('post.index')->with('success', 'Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('status', '0')->get();
        $post = Post::find($id);
        return view('admin.post.edit', compact('post', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $request->validate([
            'description' => 'required',
            'category_id' => 'required',
            'name' => 'required',
            'meta_title' => 'required',
            'yt_iframe' => 'nullable',
        ]);

        $slug = Auth::id() . '--' . $request->name;
        $post->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $slug,
            'yt_iframe' => $request->yt_iframe,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'status' => $request->status == true ? 1 : 0,
        ]);
        return redirect()->route('post.index')->with('message', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return back()->with('message', 'Post Deleted Successfully');
    }
}
