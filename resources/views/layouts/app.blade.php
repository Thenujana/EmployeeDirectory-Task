<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Directory</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
   body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-color);
    }


   

    .navbar {
        background-color: var(--navbar-bg) !important;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .card, .table {
        background-color: var(--card-bg) !important;
        color: var(--text-color) !important;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .table th, .table td {
        background-color: var(--table-bg) !important;
        color: var(--text-color) !important;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    footer {
        text-align: center;
        padding: 15px 0;
        margin-top: 50px;
        color: var(--text-color);
        font-size: 0.9rem;
    }

        
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('employees.index') }}">Employee Directory</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employees.index') }}">Employees</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.show') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-light btn-sm ms-2" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


<main class="py-4">
    @yield('content')
</main>


<footer>
    &copy; {{ date('Y') }} Employee Directory. All rights reserved.
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
