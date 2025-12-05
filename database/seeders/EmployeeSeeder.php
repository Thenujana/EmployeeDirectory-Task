<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Department;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        for ($i = 1; $i <= 10; $i++) {
            Employee::create([
                'first_name' => 'First'.$i,
                'last_name' => 'Last'.$i,
                'email' => 'employee'.$i.'@example.com',
                'phone' => '123456789'.$i,
                'job_title' => 'Job Title '.$i,
                'department_id' => $departments->random()->id,
                'status' => 'active',
            ]);
        }
    }
}
