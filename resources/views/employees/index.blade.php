@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-2">Employee Directory</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-primary mb-2">Add Employee</a>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Employee Distribution by Department</strong>
        </div>
        <div class="card-body text-center">
            <canvas id="employeePieChart" style="max-height: 350px;"></canvas>
        </div>
    </div>
  


    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Photo</th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>
                        @if($employee->images->first())
                            <img src="{{ asset('uploads/employees/' . $employee->images->first()->filename) }}"
                                 alt="Employee Photo"
                                 width="50" height="50"
                                 style="object-fit: cover; border-radius: 50%;">
                        @else
                            <img src="https://via.placeholder.com/50"
                                 class="rounded-circle"
                                 alt="No Image">
                        @endif
                    </td>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->job_title }}</td>
                    <td>{{ $employee->department->name ?? '' }}</td>
                    <td>
                        @if($employee->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @elseif($employee->status == 'on_leave')
                            <span class="badge bg-warning text-dark">On Leave</span>
                        @else
                            <span class="badge bg-danger">Terminated</span>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning me-1 mb-1">Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mb-1" onclick="return confirm('Delete this employee?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-block d-md-none">
        @foreach($employees as $employee)
        <div class="card mb-3 shadow-sm">
            <div class="row g-0 align-items-center">
                <div class="col-3 text-center p-2">
                    @if($employee->images->first())
                        <img src="{{ asset('uploads/employees/' . $employee->images->first()->filename) }}"
                             class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/60" class="rounded-circle" alt="No Image">
                    @endif
                </div>
                <div class="col-9 p-2">
                    <h5 class="mb-1">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                    <p class="mb-1 small">{{ $employee->job_title }} | {{ $employee->department->name ?? 'N/A' }}</p>
                    <p class="mb-1 small">{{ $employee->email }}</p>
                    <span class="badge 
                        {{ $employee->status == 'active' ? 'bg-success' : 
                        ($employee->status == 'on_leave' ? 'bg-warning text-dark' : 'bg-danger') }}">
                        {{ ucfirst(str_replace('_',' ', $employee->status)) }}
                    </span>

                    <div class="mt-2">
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning me-1 mb-1">Edit</a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mb-1" onclick="return confirm('Delete this employee?')">Delete</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $employees->links() }}
    </div>
</div>

<style>
    table tbody tr:hover {
        background-color: #f2f2f2;
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const ctx = document.getElementById('employeePieChart');
    const chartLabels = @json($chartLabels);
    const chartData = @json($chartData);

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: chartLabels,
            datasets: [{
                data: chartData,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc',
                    '#f6c23e', '#e74a3b', '#858796',
                    '#20c997', '#6f42c1'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
            }
        }
    });

});
</script>

@endsection
