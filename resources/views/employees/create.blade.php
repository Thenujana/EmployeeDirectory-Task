@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Add New Employee</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Job Title</label>
                <input type="text" name="job_title" class="form-control">
            </div>
            <div class="col-md-6">
                <label>Department</label>
                <select name="department_id" class="form-select" required>
                    <option value="">Select Department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="active">Active</option>
                <option value="on_leave">On Leave</option>
                <option value="terminated">Terminated</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Upload Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-success">Save Employee</button>
    </form>
</div>
@endsection
