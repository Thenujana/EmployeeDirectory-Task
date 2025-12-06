<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .card { max-width: 420px; margin: 100px auto; padding: 30px; border-radius: 10px; background: white; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="card">
    <h3 class="text-center mb-4">Admin Sign Up</h3>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('signup.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required placeholder="Your Name">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required placeholder="email@example.com">
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">Sign Up</button>
        <p class="mt-3 text-center">Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </form>
</div>

</body>
</html>
