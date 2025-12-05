<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
class DepartmentSeeder extends Seeder
{
    
    public function run(): void
    {
        
       $departments = [
        'Human Resources',
        'IT Department',
        'Sales',
        'Finance',
        'Marketing'
       ];
       foreach ($departments as $dept) {
        Department::create([
            'name' => $dept,
            'slug' => strtolower(str_replace(' ', '-', $dept))
        ]);
    }
}
}