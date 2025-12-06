<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

   
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #007bff, #6610f2);
            color: white;
        }

        .hero {
            text-align: center;
            background-color: rgba(0,0,0,0.25);
            padding: 50px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            max-width: 450px;
            width: 90%;
        }

        .hero h1 {
            font-size: 2.2rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.1rem;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        .btn-login, .btn-signup {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #e2e6ea;
            color: #007bff;
        }

        .btn-signup:hover {
            background-color: rgba(255,255,255,0.2);
            color: white;
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="hero">
    <h1 class="fw-bold">Employee Management System</h1>
    <p>Manage employees, departments, roles, and performance in one place.</p>

    <a href="{{ route('login') }}" class="btn btn-light btn-login mb-3">Login as Admin</a>
    <a href="{{ route('signup') }}" class="btn btn-outline-light btn-signup">Sign Up</a>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
