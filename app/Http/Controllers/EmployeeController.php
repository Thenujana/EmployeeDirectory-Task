<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('department')->paginate(10);
    return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $departments = Department::all();
    return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'first_name' => 'required',
        'email' => 'required|email|unique:employees',
        'department_id' => 'required',
        'images.*' => 'image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $employee = Employee::create($request->all());

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $name = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('uploads/employees'), $name);

            EmployeeImage::create([
                'employee_id' => $employee->id,
                'filename' => $name
            ]);
        }
    }

    return redirect()->route('employees.index')->with('success', 'Employee added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = Department::all();
    return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
            $request->validate([
        'first_name' => 'required',
        'email' => 'required|email|unique:employees,email,' . $employee->id,
    ]);

    $employee->update($request->all());

    return redirect()->route('employees.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
            $employee->delete();
    return redirect()->route('employees.index')->with('success', 'Deleted');
    }
}
