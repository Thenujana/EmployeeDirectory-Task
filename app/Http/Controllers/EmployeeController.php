<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\EmployeeImage;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::all();
        $query = Employee::with(['department', 'images']);

        if ($request->has('department') && $request->department != '') {
            $query->where('department_id', $request->department);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('job_title', 'like', "%{$search}%");
            });
        }

        $sortableColumns = ['first_name','last_name','email','job_title','status','department_id'];
        $sortBy = $request->get('sort_by');
        $sortOrder = $request->get('sort_order','asc');
        if (in_array($sortBy, $sortableColumns)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $employees = $query->paginate(10)->withQueryString();

        $departmentCounts = Employee::selectRaw('department_id, COUNT(*) as total')
            ->groupBy('department_id')
            ->pluck('total', 'department_id')
            ->toArray();

        $departmentNames = Department::whereIn('id', array_keys($departmentCounts))
            ->pluck('name', 'id')
            ->toArray();

        $chartLabels = array_values($departmentNames);
        $chartData = array_values($departmentCounts);

        return view('employees.index', compact(
            'employees',
            'departments',
            'chartLabels',
            'chartData'
        ));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees',
            'job_title' => 'required',
            'department_id' => 'required',
            'status' => 'required',
            'images.*' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $employee = Employee::create($request->only([
            'first_name', 'last_name', 'email', 'job_title', 'department_id', 'status'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $name = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('uploads/employees'), $name);
                EmployeeImage::create([
                    'employee_id' => $employee->id,
                    'filename' => $name
                ]);
            }
        }

        return redirect()->route('employees.index')->with('success', 'Employee added successfully');
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'job_title' => 'required',
            'department_id' => 'required',
            'status' => 'required',
            'images.*' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $employee->update($request->only([
            'first_name', 'last_name', 'email', 'job_title', 'department_id', 'status'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $name = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('uploads/employees'), $name);
                EmployeeImage::create([
                    'employee_id' => $employee->id,
                    'filename' => $name
                ]);
            }
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        foreach ($employee->images as $img) {
            $path = public_path('uploads/employees/' . $img->filename);
            if (file_exists($path)) unlink($path);
            $img->delete();
        }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
