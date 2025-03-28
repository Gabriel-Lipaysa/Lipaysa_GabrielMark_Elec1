<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $registrarEmail = "registrar@registrar.com";
        $registrarPwd = "registrar123";

        if($user['email'] === $registrarEmail && $user['password'] === $registrarPwd){
            Session::put('auth_user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'role' => $user['role']
            ]);
            return to_route('dashboard');
        }else{
            
        }
        $user = DB::table('users')->where('email', $request->email)->first();

       
            
        

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Session::forget('auth_user');
        return redirect()->route('login');
    }
}
