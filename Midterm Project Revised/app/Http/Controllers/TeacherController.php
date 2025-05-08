<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $teachers = DB::table('teachers')
            ->join('usertype', 'teachers.usertype_id', '=', 'usertype.id')
            ->select('teachers.*', 'usertype.email')
            ->when($search, function ($query, $search) {
                return $query->where('teachers.fname', 'like', "%{$search}%")
                             ->orWhere('teachers.lname', 'like', "%{$search}%")
                             ->orWhere('teachers.phone', 'like', "%{$search}%")
                             ->orWhere('teachers.department', 'like', "%{$search}%")
                             ->orWhere('usertype.email', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function insert(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'department' => 'required|string|max:255',
            'email' => 'required|email|unique:usertype,email',
            'pwd' => 'required|string|min:6'
        ]);

        DB::transaction(function () use ($request) {
            // Create usertype first
            $usertypeId = DB::table('usertype')->insertGetId([
                'email' => $request->email,
                'password' => Hash::make($request->pwd),
                'role' => 'teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create teacher profile
            DB::table('teachers')->insert([
                'usertype_id' => $usertypeId,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'phone' => $request->phone,
                'department' => $request->department,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function show($id)
    {
        $teacher = DB::table('teachers')
            ->join('usertype', 'teachers.usertype_id', '=', 'usertype.id')
            ->select('teachers.*', 'usertype.email')
            ->where('teachers.id', $id)
            ->first();

        return view('teachers.details', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = DB::table('teachers')
            ->join('usertype', 'teachers.usertype_id', '=', 'usertype.id')
            ->select('teachers.*', 'usertype.email')
            ->where('teachers.id', $id)
            ->first();

        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'department' => 'required|string|max:255',
            'email' => "required|email|unique:usertype,email,{$id},id"
        ]);

        DB::transaction(function () use ($request, $id) {
            $teacher = DB::table('teachers')->where('id', $id)->first();

            // Update usertype email
            DB::table('usertype')->where('id', $teacher->usertype_id)->update([
                'email' => $request->email,
                'updated_at' => now(),
            ]);

            // Update teacher profile
            DB::table('teachers')->where('id', $id)->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'phone' => $request->phone,
                'department' => $request->department,
                'updated_at' => now(),
            ]);
        });

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy($id)
    {
        $teacher = DB::table('teachers')->where('id', $id)->first();

        DB::transaction(function () use ($teacher) {
            DB::table('teachers')->where('id', $teacher->id)->delete();
            DB::table('usertype')->where('id', $teacher->usertype_id)->delete();
        });

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}
