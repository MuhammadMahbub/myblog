@extends('layouts.master')

@section('title', 'Website Setting')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Website Setting</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Website Setting</li>
        </ol>
        {{-- <div class="mb-3">
            <a href="{{ route('admin.setting.update') }}" class="btn btn-dark">Settings</a>
        </div> --}}
        <div class="row">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="mb-3">
                        <li class="text-danger">{{ $error }}</li>
                    </div>
                @endforeach
            @endif
            <div class="col-8">
                <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="website_name">Website Name</label>
                        <input type="text" class="form-control" id="website_name" name="website_name"
                            @if ($setting) value="{{ $setting->website_name }}" @endif>
                    </div>
                    <div class="form-group">
                        <label>LOGO</label>
                        <input type="file" class="form-control" id="web_logo" name="web_logo" width="100"
                            value="{{ old('web_logo') }}">
                        @if ($setting)
                            <img src="{{ asset('uploads/settings/' . $setting->web_logo) }}" width="200">
                        @endif
                    </div>
                    <div>
                        <img width="100" id="logooutput">
                    </div>
                    <div class="form-group">
                        <label>Fav Icon</label>
                        <input type="file" class="form-control" id="fav_icon" name="fav_icon" width="100"
                            value="{{ old('fav_icon') }}">
                        @if ($setting)
                            <img src="{{ asset('uploads/settings/' . $setting->fav_icon) }}" alt="Fav Icon" width="200">
                        @endif
                    </div>
                    <div>
                        <img width="100" id="fav_iconoutput">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description">
@if ($setting)
{{ $setting->description }}
@endif
</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <textarea type="text" class="form-control" id="meta_description" name="meta_description">
@if ($setting)
{{ $setting->meta_description }}
@endif
</textarea>
                    </div>
                    <div class="form-group">
                        <label for="meta_title">Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                            @if ($setting) value="{{ $setting->meta_title }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="meta_keyword">Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                            @if ($setting) value="{{ $setting->meta_keyword }}" @endif>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        document.getElementById('logo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('logooutput').src = src
        }
        document.getElementById('fav_icon').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('fav_iconoutput').src = src
        }
    </script>
@endsection
