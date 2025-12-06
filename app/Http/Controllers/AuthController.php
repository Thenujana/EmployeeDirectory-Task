<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session(['admin_id' => $user->id, 'admin_name' => $user->name]);
            return redirect()->route('dashboard')->with('success', 'Welcome ' . $user->name);
        }

        return back()->withErrors(['Invalid login credentials']);
    }


    public function logout()
    {
        session()->forget(['admin_id', 'admin_name']);
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    
    public function showProfile()
    {
        if(!session()->has('admin_id')){
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $admin = User::find(session('admin_id'));
        return view('profile', compact('admin'));
    }


    public function updateProfile(Request $request)
    {
        if(!session()->has('admin_id')){
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $admin = User::find(session('admin_id'));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$admin->id,
            'password' => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        if($request->password){
            $admin->password = Hash::make($request->password);
        }

   
        if($request->hasFile('profile_picture')){
            $file = $request->file('profile_picture');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/admins'), $filename);

            
            if($admin->profile_picture && file_exists(public_path('uploads/admins/'.$admin->profile_picture))){
                unlink(public_path('uploads/admins/'.$admin->profile_picture));
            }

            $admin->profile_picture = $filename;
        }

        $admin->save();

        return back()->with('success', 'Profile updated successfully');
    }
}
