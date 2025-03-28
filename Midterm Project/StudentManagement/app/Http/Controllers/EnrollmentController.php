<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // Display all enrollments
    public function index(Request $request)
    {   
        $search = $request->query('search');
        
        $enrollments = DB::table('enrollments')
        ->join('students', 'enrollments.student_id', '=', 'students.id')
        ->join('courses', 'enrollments.course_id', '=', 'courses.id')
        ->select('enrollments.*', 'students.fname', 'students.lname', 'courses.course_name')
        ->when($search, function($query, $search){
            return $query->where(DB::raw("CONCAT(students.fname, ' ', students.lname)"), 'like', "%{$search}%")
                    ->orWhere('courses.course_name', 'like', "%{$search}%");
        })
        ->paginate(perPage: 3); // 10 records per page

    return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = DB::select("SELECT * FROM students");
        $courses = DB::select("SELECT * FROM courses");
        return view('enrollments.create', compact('students', 'courses'));
    }

    public function insert(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:Active,Dropped,Completed'
        ]);

        DB::insert(
    "INSERT INTO enrollments (student_id, course_id, enrollment_date, status, created_at, updated_at) 
            VALUES (?, ?, ?, ?, NOW(), NOW())", [
                $request->student_id,
                $request->course_id,
                $request->enrollment_date,
                $request->status
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment added successfully');
    }

    public function edit($id)
    {
        $enrollment = DB::select("SELECT * FROM enrollments WHERE id = ?", [$id])[0] ?? null;
        $students = DB::select("SELECT * FROM students");
        $courses = DB::select("SELECT * FROM courses");

        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
            'status' => 'required|in:Active,Dropped,Completed'
        ]);

        DB::update("UPDATE enrollments SET student_id=?, course_id=?, enrollment_date=?, status=?, updated_at=NOW() WHERE id=?", [
            $request->student_id,
            $request->course_id,
            $request->enrollment_date,
            $request->status,
            $id
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully');
    }

    public function destroy($id)
    {
        DB::delete("DELETE FROM enrollments WHERE id=?", [$id]);
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully');
    }
}
