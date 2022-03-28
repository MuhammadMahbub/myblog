<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::count();
        $posts = Post::count();
        $users = User::where('role_as', 0)->count();
        $admins = User::where('role_as', 1)->count();
        return view('admin.dashboard', compact('categories', 'posts', 'users', 'admins'));
    }

    public function user()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // return $request->role_as;
        $user = User::find($id);
        $user->update([
            'role_as' => $request->role_as,
        ]);
        return redirect()->route('admin.user');
    }
}
