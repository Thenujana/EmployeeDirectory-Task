<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeImage;

class EmployeeImageController extends Controller
{
    public function destroy($id)
    {
        $image = EmployeeImage::findOrFail($id);

     
        if(file_exists(public_path('uploads/employees/'.$image->filename))){
            unlink(public_path('uploads/employees/'.$image->filename));
        }

        // Delete record from database
        $image->delete();

        return back()->with('success', 'Image deleted successfully');
    }
}
