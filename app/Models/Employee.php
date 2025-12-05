<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     protected $fillable = [
        'first_name', 'last_name', 'email', 'phone',
        'job_title', 'department_id', 'status'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function images()
    {
        return $this->hasMany(EmployeeImage::class);
    }
}
