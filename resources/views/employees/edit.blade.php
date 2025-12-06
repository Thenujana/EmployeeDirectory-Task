@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Employee</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
            </div>
            <div class="col-md-6">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
            </div>
            <div class="col-md-6">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Job Title</label>
                <input type="text" name="job_title" class="form-control" value="{{ $employee->job_title }}">
            </div>
            <div class="col-md-6">
                <label>Department</label>
                <select name="department_id" class="form-select" required>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select">
                <option value="active" {{ $employee->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="on_leave" {{ $employee->status == 'on_leave' ? 'selected' : '' }}>On Leave</option>
                <option value="terminated" {{ $employee->status == 'terminated' ? 'selected' : '' }}>Terminated</option>
            </select>
        </div>

        <!-- Current Images with Delete Button -->
        <div class="mb-3">
            <label>Current Images</label><br>
            @foreach($employee->images as $img)
                <div class="d-inline-block position-relative me-2 mb-2">
                    <img src="{{ asset('uploads/employees/'.$img->filename) }}" width="100" class="rounded">
                    <form action="{{ route('employees.images.destroy', $img->id) }}" method="POST" 
                          style="position:absolute; top:0; right:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger p-1" 
                                onclick="return confirm('Delete this image?')">&times;</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Upload More Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <button type="submit" class="btn btn-success">Update Employee</button>
    </form>
</div>
@endsection
