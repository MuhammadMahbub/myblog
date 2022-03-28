<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'setting' => Setting::find(1),
            'nav_status' => Category::where('nav_status', 0)->get(),
            'categories' => Category::where('status', 0)->get(),
            'allcategory' => Category::all(),
            'latest_posts' => Post::where('status', 0)->orderBy('created_at', 'DESC')->get()->take(5),
        ]);
    }

    public function viewcategory($category_name)
    {
        $category = Category::where('category_name', $category_name)->where('status', 0)->first();
        if ($category) {
            $posts = Post::where('category_id', $category->id)->where('status', 0)->paginate(5);
            return view('frontend.post.index', compact('posts', 'category'));
        }
    }

    public function viewpost($category_name, $post_name)
    {
        $category = Category::where('category_name', $category_name)->where('status', 0)->first();
        if ($category) {
            $post = Post::where('category_id', $category->id)->where('name', $post_name)->where('status', 0)->first();
            $latest_posts = Post::where('category_id', $category->id)->where('status', 0)->orderBy('created_at', 'DESC')->get()->take(5);
            return view('frontend.post.view', compact('post', 'category', 'latest_posts'));
        }
    }
}
