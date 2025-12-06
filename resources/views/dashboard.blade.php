<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Employee Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .hero {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(to right, #007bff, #6610f2);
            color: white;
            border-radius: 15px;
            margin-bottom: 40px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        .hero h1 { font-weight: 700; font-size: 2rem; }

        .stat-card {
            border-radius: 15px;
            padding: 25px;
            color: white;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .stat-icon { font-size: 45px; opacity: 0.9; }
        .stat-title { font-size: 1rem; font-weight: 500; }
        .stat-value { font-size: 1.9rem; font-weight: 700; }

        .card-hover {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .logout-btn {
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="hero">
        <h1>Welcome, {{ session('admin_name') }}</h1>
        <p class="lead">Manage employees efficiently and monitor your workforce statistics.</p>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card" style="background:#007bff;">
                <i class="bi bi-people-fill stat-icon"></i>
                <div>
                    <div class="stat-title">Total Employees</div>
                    <div class="stat-value">{{ $totalEmployees ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card" style="background:#28a745;">
                <i class="bi bi-person-check-fill stat-icon"></i>
                <div>
                    <div class="stat-title">Active</div>
                    <div class="stat-value">{{ $activeCount ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card" style="background:#ffc107;">
                <i class="bi bi-person-dash-fill stat-icon"></i>
                <div>
                    <div class="stat-title">On Leave</div>
                    <div class="stat-value">{{ $onLeaveCount ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card" style="background:#dc3545;">
                <i class="bi bi-person-x-fill stat-icon"></i>
                <div>
                    <div class="stat-title">Terminated</div>
                    <div class="stat-value">{{ $terminatedCount ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4 col-sm-12">
            <a href="{{ route('employees.index') }}" class="text-decoration-none text-dark">
                <div class="card card-hover text-center p-4 h-100">
                    <div class="card-body">
                        <i class="bi bi-table fs-1 text-primary"></i>
                        <h4 class="mt-3">View Employees</h4>
                        <p>See all employees, edit details, and manage records.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-12">
            <a href="{{ route('employees.create') }}" class="text-decoration-none text-dark">
                <div class="card card-hover text-center p-4 h-100">
                    <div class="card-body">
                        <i class="bi bi-person-plus-fill fs-1 text-success"></i>
                        <h4 class="mt-3">Add Employee</h4>
                        <p>Create new employee records with multiple images.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-12">
            <a href="{{ route('profile.show') }}" class="text-decoration-none text-dark">
                <div class="card card-hover text-center p-4 h-100">
                    <div class="card-body">
                        <i class="bi bi-person-bounding-box fs-1 text-warning"></i>
                        <h4 class="mt-3">My Profile</h4>
                        <p>Update your admin profile information and password.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="text-center mt-5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
