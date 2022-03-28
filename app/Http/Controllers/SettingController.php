<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    function index()
    {
        $setting = Setting::find(1);
        return view('admin.setting', compact('setting'));
    }

    function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable',
            'website_name' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'nullable',
            'meta_description' => 'nullable',
            'web_logo' => 'nullable',
            'fav_icon' => 'nullable',
        ]);


        $setting = Setting::where('id', 1)->first();
        if ($setting) {
            $setting->website_name = $request->website_name;
            if ($request->hasFile('web_logo')) {
                $path = 'uploads/settings/' . $setting->web_logo;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $logo = $request->file('web_logo');
                $ext_logo = $logo->getClientOriginalExtension();
                $new_logo = Auth::id() . '-' . uniqid() . '.' . $ext_logo;
                $logo->move('uploads/settings/', $new_logo);
                $setting->web_logo = $new_logo;
            }
            if ($request->hasFile('fav_icon')) {
                $path = 'uploads/settings/' . $setting->fav_icon;
                if (File::exists($path)) {
                    File::delete($path);
                }
                $fav_icon = $request->file('fav_icon');
                $ext_fav_icon = $fav_icon->getClientOriginalExtension();
                $new_fav_icon = Auth::id() . '-' . uniqid() . '.' . $ext_fav_icon;
                $fav_icon->move('uploads/settings/', $new_fav_icon);
                $setting->fav_icon = $new_fav_icon;
            }

            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->meta_description = $request->meta_description;
            $setting->save();

            return redirect()->route('admin.setting')->with('message', 'Website Updated Successfully');
        } else {
            $setting = new Setting;
            $setting->website_name = $request->website_name;
            if ($request->hasFile('web_logo')) {
                $logo = $request->file('web_logo');
                $ext_logo = $logo->getClientOriginalExtension();
                $new_logo = Auth::id() . '-' . uniqid() . '.' . $ext_logo;
                $logo->move('uploads/settings/', $new_logo);
                $setting->web_logo = $new_logo;
            }
            if ($request->hasFile('fav_icon')) {
                $fav_icon = $request->file('fav_icon');
                $ext_fav_icon = $fav_icon->getClientOriginalExtension();
                $new_fav_icon = Auth::id() . '-' . uniqid() . '.' . $ext_fav_icon;
                $fav_icon->move('uploads/settings/', $new_fav_icon);
                $setting->fav_icon = $new_fav_icon;
            }

            $setting->description = $request->description;
            $setting->meta_title = $request->meta_title;
            $setting->meta_keyword = $request->meta_keyword;
            $setting->meta_description = $request->meta_description;
            $setting->save();

            return redirect()->route('admin.setting')->with('message', 'Website Updated Successfully');
        }
    }
}
