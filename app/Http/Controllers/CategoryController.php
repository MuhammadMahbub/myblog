<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryFormRequest;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        // $request->validate([
        //     '*' => 'required',
        // ]);

        if ($request->hasFile('category_photo')) {
            $file = $request->file('category_photo');
            $ext = $file->getClientOriginalExtension();
            $new_name = Auth::id() . '-' . uniqid() . '.' . $ext;
            Image::make($request->file('category_photo'))->save(base_path('public/uploads/category_photos/' . $new_name));
            // $file->move('uploads/category_photos/', $new_name);
        }

        $category_slug = Auth::id() . '--' . $request->category_name;
        Category::insert([
            'category_photo' => $new_name,
            'category_name' => $request->category_name,
            'category_slug' => $category_slug,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'status' => $request->status == true ? 1 : 0,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('category.index')->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($request->hasFile('new_category_photo')) {
            unlink(base_path('public/uploads/category_photos/' . $category->category_photo));
            // $path = 'uploads/category_photos/' . $category->category_photo;
            // if (File::exists($path)) {
            //     File::delete($path);
            // }
            $ext = $request->file('new_category_photo')->getClientOriginalExtension();
            $new_name = $category->id . '-' . uniqid() . '.' . $ext;
            // $request->file('new_category_photo')->move('uploads/category_photos/', $new_name);
            Image::make($request->file('new_category_photo'))->save(base_path('public/uploads/category_photos/' . $new_name));

            $category->update([
                'category_photo' => $new_name,
            ]);
        }

        $category->update([
            'category_name' => $request->category_name,
            'meta_title' => $request->meta_title,
            'status' => $request->status,
        ]);
        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $path = 'uploads/category_photos/' . $category->category_photo;
        if (File::exists($path)) {
            File::delete($path);
        }
        // unlink(base_path('public/uploads/category_photos/' . $category->category_photo));
        $category->delete();
        return back()->with('delete', 'Category Deleted Successfully');
    }
}
