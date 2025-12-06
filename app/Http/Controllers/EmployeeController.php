<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\EmployeeImage;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function index()
    {
      
        $employees = Employee::with(['department', 'images'])->paginate(10);

        
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

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully');
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

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully');
    }

   
    public function destroy(Employee $employee)
    {
        foreach ($employee->images as $img) {
            $path = public_path('uploads/employees/' . $img->filename);
            if (file_exists($path)) {
                unlink($path);
            }
            $img->delete();
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully');
    }
}
