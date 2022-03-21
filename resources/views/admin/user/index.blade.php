@extends('layouts.master')

@section('title', 'Blog Users')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Users</li>
        </ol>

        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role_as == 1)
                                        Admin
                                    @elseif ($user->role_as == 0)
                                        User
                                    @else
                                        Blogger
                                    @endif
                                </td>
                                <td>
                                    <div class="col-3"><a class="btn btn-outline-info"
                                            href="{{ route('admin.user.edit', $user->id) }}">Edit</a></div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-dark">No Record</div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
