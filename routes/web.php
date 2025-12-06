<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeImageController;
use App\Http\Controllers\AuthController;    


Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Sign Up
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('employees', EmployeeController::class);


// Delete an image
Route::delete('/employees/images/{id}', [EmployeeImageController::class, 'destroy'])
    ->name('employees.images.destroy');


// Profile routes
Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile.show');
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');