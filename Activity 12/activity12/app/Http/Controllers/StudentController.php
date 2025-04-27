<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $students = Student::query();

        if($request->has('search')){
            $students = Student::where('fname', 'like', '%'.$request->search.'%')
                ->orWhere('lname', 'like', '%'.$request->search.'%');
        }else{
            $students = Student::orderBy('id', 'desc');
        }
            $students = $students->paginate(5);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'bdate' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
        ]);

        Student::create($request->all());

        return to_route('students.index')->with('success', 'Student created succesfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {   
        $student = Student::find($student->id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'bdate' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        $student->update($request->only('fname', 'lname', 'bdate', 'address', 'email'));
        return to_route('students.index')->with('success', 'Student updated succesfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return to_route('students.index')->with('success', 'Student deleted succesfully.');
    }
}
