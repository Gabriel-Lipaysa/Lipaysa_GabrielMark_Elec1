<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    
    public function index($id)
    {
        // Fetch enrolled courses with grades
        $enrollments = DB::select("
            SELECT 
                enrollments.id AS enrollment_id,
                courses.course_code, 
                courses.course_name, 
                courses.units, 
                grades.grade, 
                grades.remarks 
            FROM enrollments
            JOIN courses ON enrollments.course_id = courses.id
            LEFT JOIN grades ON enrollments.id = grades.enrollment_id
            WHERE enrollments.student_id = ?", [$id]);

        return view('students.grades.index', compact('enrollments', 'id'));
    }

    public function create($studentId)
    {
        // Fetch all the courses the student is enrolled in
        $enrolledCourses = DB::table('enrollments')
                             ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                             ->where('enrollments.student_id', $studentId)
                             ->get();

        return view('students.grades.create', compact('enrolledCourses', 'studentId'));
    }

    public function store(Request $request, $studentId)
    {
        $enrollmentId = $request->input('enrollment_id');
        $grade = $request->input('grade');
        $remarks = $request->input('remarks');

        // Insert grade record
        DB::table('grades')->insert([
            'enrollment_id' => $enrollmentId,
            'grade' => $grade,
            'remarks' => $remarks,
            'graded_at' => now(),
        ]);

        return redirect()->route('students.grades.index', $studentId)
                         ->with('success', 'Grade added successfully!');
    }

    public function edit($studentId, $gradeId)
    {
        // Fetch the grade record and the associated enrollment
        $grade = DB::table('grades')
                   ->join('enrollments', 'grades.enrollment_id', '=', 'enrollments.id')
                   ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                   ->where('grades.id', $gradeId)
                   ->first();

        return view('students.grades.edit', compact('grade', 'studentId'));
    }

    public function update(Request $request, $studentId, $gradeId)
    {
        $grade = $request->input('grade');
        $remarks = $request->input('remarks');

        // Update grade record
        DB::table('grades')
            ->where('id', $gradeId)
            ->update([
                'grade' => $grade,
                'remarks' => $remarks,
                'graded_at' => now(),
            ]);

        return redirect()->route('students.grades.index', $studentId)
                         ->with('success', 'Grade updated successfully!');
    }
}
