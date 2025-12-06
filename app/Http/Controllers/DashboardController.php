<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        // Total employees
        $totalEmployees = Employee::count();

        // Employees by status
        $activeCount = Employee::where('status', 'active')->count();
        $onLeaveCount = Employee::where('status', 'on_leave')->count();
        $terminatedCount = Employee::where('status', 'terminated')->count();

        return view('dashboard', compact(
            'totalEmployees',
            'activeCount',
            'onLeaveCount',
            'terminatedCount'
        ));
    }
}
