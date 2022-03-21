@extends('layouts.master')

@section('title', 'Blog User')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">User</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ $message }}</div>
        @endif
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">User</li>
        </ol>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input disabled type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="meta_title">User Email</label>
                    <input disabled type="text" class="form-control" id="meta_title" name="meta_title"
                        value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="yt_iframe">Created At</label>
                    <input disabled type="text" class="form-control" id="yt_iframe" name="yt_iframe"
                        value="{{ $user->created_at->format('d/m/Y') }}">
                </div>
                <form method="user" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="form-group">
                            <label for="role_as">Role As</label>
                            <select name="role_as" id="role_as" class="form-control">
                                <option value="1" {{ $user->role_as == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="0" {{ $user->role_as == 0 ? 'selected' : '' }}>User</option>
                                <option value="2" {{ $user->role_as == 2 ? 'selected' : '' }}>Vlogger</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Role</button>
                </form>
            </div>
        </div>
    </div>
@endsection
