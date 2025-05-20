<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $userRole = session('user_role');
        $userId = session('user_id');

        $students = DB::table('students')
            ->join('usertype', 'students.usertype_id', '=', 'usertype.id')
            ->select('students.*', 'usertype.email')
            ->when($userRole === 'teacher', function ($query) use ($userId) {
                return $query->whereIn('students.id', function ($subQuery) use ($userId) {
                    $subQuery->select('enrollments.student_id')
                        ->from('enrollments')
                        ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                        ->where('courses.teacher_id', $userId);
                });
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('students.fname', 'like', "%{$search}%")
                        ->orWhere('students.mname', 'like', "%{$search}%")
                        ->orWhere('students.lname', 'like', "%{$search}%")
                        ->orWhere('usertype.email', 'like', "%{$search}%");
                });
            })
            ->orderBy('students.created_at', 'desc')
            ->paginate(5);

        return view('students.index', compact('students'));
    }


    public function create()
    {
        return view('students.create');
    }

    public function insert(Request $request)
    {

        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive,Graduated,Dropped',
            'email' => 'required|email|unique:usertype,email',
            'pwd' => 'required|string|min:6'
        ]);

        DB::transaction(function () use ($request) {
            // Create user first
            $userId = DB::table('usertype')->insertGetId([
                'email' => $request->email,
                'password' => Hash::make($request->pwd),
                'role' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create student profile
            DB::table('students')->insert([
                'usertype_id' => $userId,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'sex' => $request->sex,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'address' => $request->address,
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    public function show($id)
    {
        $student = DB::table('students')
            ->join('usertype', 'students.usertype_id', '=', 'usertype.id')
            ->select('students.*', 'usertype.email')
            ->where('students.id', $id)
            ->first();

        return view('students.details', compact('student'));
    }

    public function edit($id)
    {
        // $user = Auth::user();

        // if ($user->role === 'student' && $user->student->id != $id) {
        //     abort(403, 'Unauthorized action.');
        // }

        $student = DB::table('students')
            ->join('usertype', 'students.usertype_id', '=', 'usertype.id')
            ->select('students.*', 'usertype.email')
            ->where('students.id', $id)
            ->first();

        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'mname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'sex' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive,Graduated,Dropped',
        ]);

        DB::transaction(function () use ($request, $id) {
            $student = DB::table('students')->where('id', $id)->first();

            // Update user email
            // DB::table('usertype')->where('id', $student->usertype_id)->update([
            //     'email' => $request->email,
            //     'updated_at' => now(),
            // ]);

            // Update student info
            DB::table('students')->where('id', $id)->update([
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'sex' => $request->sex,
                'dob' => $request->dob,
                'phone' => $request->phone,
                'address' => $request->address,
                'guardian_name' => $request->guardian_name,
                'guardian_phone' => $request->guardian_phone,
                'status' => $request->status,
                'updated_at' => now(),
            ]);
        });

        return redirect()->back()->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = DB::table('students')->where('id', $id)->first();

        DB::transaction(function () use ($student) {
            DB::table('students')->where('id', $student->id)->delete();
            DB::table('usertype')->where('id', $student->usertype_id)->delete();
        });

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
