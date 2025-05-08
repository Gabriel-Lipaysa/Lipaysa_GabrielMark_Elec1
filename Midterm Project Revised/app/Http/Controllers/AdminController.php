<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $result = DB::select("
            SELECT 
                (SELECT COUNT(*) FROM enrollments) AS Total_Enrollment,
                (SELECT COUNT(*) FROM students) AS Total_Students,
                (SELECT COUNT(*) FROM courses) AS Total_Courses
        ");

        $data = (array) $result[0];

        return view('admin.dashboard', compact('data'));
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = DB::table('users')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,teacher,student',
        ]);

        DB::insert('INSERT INTO users (name, email, password, role, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, NOW(), NOW())', 
                    [
                        $request->name,
                        $request->email,
                        Hash::make($request->password),
                        $request->role,
                    ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$id]);

        if (!$user) {
            abort(404);
        }

        return view('admin.users.edit', ['user' => $user[0]]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'role' => 'required|in:admin,teacher,student',
        ]);

        DB::update('UPDATE users SET name = ?, email = ?, role = ?, updated_at = NOW() WHERE id = ?', 
                    [
                        $request->name,
                        $request->email,
                        $request->role,
                        $id
                    ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM users WHERE id = ?', [$id]);

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
