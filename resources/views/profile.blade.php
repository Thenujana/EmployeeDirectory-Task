@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>My Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $admin->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $admin->email }}" required>
        </div>

        <div class="mb-3">
            <label>Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label>Profile Picture</label><br>
            @if($admin->profile_picture)
                <img src="{{ asset('uploads/admins/'.$admin->profile_picture) }}" width="100" class="rounded mb-2">
            @endif
            <input type="file" name="profile_picture" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
