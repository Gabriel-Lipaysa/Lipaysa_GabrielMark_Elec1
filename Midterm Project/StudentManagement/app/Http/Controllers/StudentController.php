<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request){
        $search = $request->query('search'); 
    
        $students = DB::table('students')
            ->when($search, function ($query, $search) {
                return $query->where('fname', 'like', "%{$search}%")
                             ->orWhere('lname', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(3); 
        return view('students.index', compact('students'));
    }
    

    public function create(){
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
        'email' => 'required|email|unique:students,email',
        'pwd' => 'required|string|min:6'
    ]);

    DB::insert('INSERT INTO students (fname, mname, lname, sex, dob, phone, address, guardian_name, guardian_phone, status, email, pwd, created_at, updated_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())',
    [
        $request->fname,
        $request->mname,
        $request->lname,
        $request->sex,
        $request->dob,
        $request->phone,
        $request->address,
        $request->guardian_name,
        $request->guardian_phone,
        $request->status,
        $request->email,
        bcrypt($request->pwd),
    ]);

    return redirect()->route('students.index')->with('success', 'Student added successfully!');
}


    public function show($id){
        $student = DB::select('SELECT * FROM students WHERE id=?',[$id]);
        return view('students.details', ['student'=>$student[0]]);
    }

    public function edit($id){
        $student = DB::select('SELECT * FROM students WHERE id=?',[$id]);
        return view('students.edit',['student'=>$student[0]]);
    }

    public function update(Request $request, $id) {
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
            'email' => "required|email|unique:students,email,$id",
        ]);
    
        DB::update('UPDATE students SET fname=?, mname=?, lname=?, sex=?, dob=?, phone=?, address=?, guardian_name=?, guardian_phone=?, status=?, email=?, updated_at=NOW() WHERE id=?', [
            $request->fname,
            $request->mname,
            $request->lname,
            $request->sex,
            $request->dob,
            $request->phone,
            $request->address,
            $request->guardian_name,
            $request->guardian_phone,
            $request->status,
            $request->email,
            $id
        ]);
    
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }
    
    public function destroy($id) {
        DB::delete('DELETE FROM students WHERE id = ?', [$id]);
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
