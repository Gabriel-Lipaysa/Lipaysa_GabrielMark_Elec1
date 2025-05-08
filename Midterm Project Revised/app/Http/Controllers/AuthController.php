<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($request->email === 'admin@gmail.com' && $request->password === '1234') {
            Session::put('user_id', 1); 
            Session::put('user_email', 'admin@gmail.com');
            Session::put('user_role', 'admin');
        
            return to_route('admin.dashboard');
        }
        
        // User from database
        $user = DB::select("SELECT * FROM usertype WHERE email = ?", [$request->email]);
        
        if (!$user) {
            return back()->with('error', 'Invalid Email or Password');
        }
        
        $user = $user[0];
        
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid email or password');
        }
        
        Session::put('user_id', $user->id);
        Session::put('user_email', $user->email);
        Session::put('user_role', $user->role);
        
        // 🔁 Redirect based on role
        switch ($user->role) {
            case 'admin':
                return to_route('admin.dashboard');
            case 'teacher':
                return to_route('students.index', ['id' => $user->id]); // or your intended teacher landing route
            case 'student':
                $student = DB::table('students')->where('usertype_id', $user->id)->first();

                if (!$student) {
                    return to_route('login')->with('error', 'Student record not found');
                }

                Session::put('student_id', $student->id); // Optional, if you need it later

                return to_route('students.details', ['id' => $student->id]);
            default:
                return to_route('login')->with('error', 'Role not recognized');
        }
        
    }

    public function logout()
    {
        Session::flush();
        return to_route('login') -> with('success', 'Logged out successfully');
    }
}
