<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;

class CoursesController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');

        $courses = DB::table('courses')
        ->when($search, function($query, $search){
            return $query -> where('course_name', 'like', "%{$search}%")
                          -> orWhere('course_code', 'like', "%{$search}%");
        })      
        ->paginate(2);
        return view('courses.index', compact('courses'));
    }


    public function create() {
        return view('courses.create');
    }

    public function insert(Request $request) {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255',
            'price' => 'required|string',
            'units' => 'required|integer',
            'instructor' => 'required|string|max:255',
            'year' => 'required|string|max:25',
            'semester' => 'required|string|max:255',
        ]);

        DB::insert('INSERT INTO courses (course_name, course_code, price, units, instructor, year, semester, created_at, updated_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())', 
                    [
                        $request->course_name,
                        $request->course_code,
                        $request->price,
                        $request->units,
                        $request->instructor,
                        $request->year,
                        $request->semester
                    ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function edit($id) {
        $course = DB::select('SELECT * FROM courses WHERE id = ?', [$id]);
        return view('courses.edit', ['course' => $course[0]]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255',
            'price' => 'required|string',
            'units' => 'required|integer',
            'instructor' => 'required|string|max:255',
            'year' => 'required|string|max:25',
            'semester' => 'required|string|max:255',
        ]);

        DB::update('UPDATE courses SET course_name = ?, course_code = ?, price = ?, units = ?, instructor = ?, year = ?, semester = ?, updated_at = NOW() WHERE id = ?', 
                    [
                        $request->course_name,
                        $request->course_code,
                        $request->price,
                        $request->units,
                        $request->instructor,
                        $request->year,
                        $request->semester,
                        $id
                    ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id) {
        DB::delete('DELETE FROM courses WHERE id = ?', [$id]);
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
