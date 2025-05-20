<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $courses = DB::table('courses')
            ->join('teachers', 'courses.teacher_id', '=', 'teachers.id')
            ->when($search, function ($query, $search) {
                return $query->where('course_name', 'like', "%{$search}%")
                    ->orWhere('course_code', 'like', "%{$search}%");
            })
            ->select('courses.*', 'teachers.fname as teacher_fname', 'teachers.lname as teacher_lname')
            ->orderBy('courses.created_at', 'desc')
            ->paginate(2);

        return view('courses.index', compact('courses'));
    }


    public function create()
    {
        $teachers = DB::table('teachers')->get();
        return view('courses.create', compact('teachers'));
    }

    public function insert(Request $request)
    {

        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255',
            'price' => 'required|numeric',
            'units' => 'required|numeric',
            'teacher_id' => 'required|exists:teachers,id',
            'year' => 'required|string|max:25',
            'semester' => 'required|string|max:255',
        ]);

        try {
            DB::table('courses')->insert([
                'course_name' => $request->course_name,
                'course_code' => $request->course_code,
                'price' => $request->price,
                'units' => $request->units,
                'teacher_id' => $request->teacher_id,
                'year' => $request->year,
                'semester' => $request->semester,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('courses.index')->with('success', 'Course created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Insert failed: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $course = DB::table('courses')->where('id', $id)->first();
        $teachers = DB::table('teachers')->get();
        return view('courses.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255',
            'price' => 'required|numeric',
            'units' => 'required|integer',
            'teacher_id' => 'required|exists:teachers,id',
            'year' => 'required|string|max:25',
            'semester' => 'required|string|max:255',
        ]);

        DB::update(
            'UPDATE courses SET course_name = ?, course_code = ?, price = ?, units = ?, teacher_id = ?, year = ?, semester = ?, updated_at = NOW() WHERE id = ?',
            [
                $request->course_name,
                $request->course_code,
                $request->price,
                $request->units,
                $request->teacher_id,
                $request->year,
                $request->semester,
                $id
            ]
        );

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }


    public function destroy($id)
    {
        DB::delete('DELETE FROM courses WHERE id = ?', [$id]);
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
