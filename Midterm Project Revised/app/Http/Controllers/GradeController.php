<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    
    public function index($id)
    {
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
        $enrolledCourses = DB::table('enrollments')
                             ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                             ->where('enrollments.student_id', $studentId)
                             ->get();

        return view('students.grades.create', compact('enrolledCourses', 'studentId'));
    }

    public function store(Request $request, $studentId)
    {
        $request -> validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'grade' => 'required|numeric|between:1.0,5.0',
            'remarks' => 'required|string|max:255',
        ]);

        DB::insert("INSERT INTO grades (enrollment_id, grade, remarks, created_at, updated_at)
                        VALUES (?, ?, ?, NOW(), NOW())",[
                        $request -> enrollment_id,
                        $request -> grade,
                        $request -> remarks,
        ]);

        return redirect()->route('students.grades.index', $studentId)
                         ->with('success', 'Grade added successfully!');
    }

    public function edit($studentId, $gradeId)
    {
        $grade = DB::table('grades')
                   ->join('enrollments', 'grades.enrollment_id', '=', 'enrollments.id')
                   ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                   ->where('grades.id', $gradeId)
                   ->first();

        return view('students.grades.edit', compact('grade', 'studentId'));
    }

    public function update(Request $request, $studentId, $gradeId)
    {
        $request -> validate([
            'grade' => 'required|numeric|between:1.0,5.0',
            'remarks' => 'required|string|max:255'
        ]);
        DB::update('UPDATE grades SET grade = ?, remarks = ?, updated_at = NOW() WHERE id = ?',[
            $request -> grade,
            $request -> remarks,
            $gradeId
        ]);
        return redirect()->route('students.grades.index', $studentId)
                         ->with('success', 'Grade updated successfully!');
    }
}
