<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class StudentController extends Controller
{   

    public function insertform() {
        return view('stud_create');
     }
      
     public function insert(Request $request) {
        $name = $request->input('stud_name');
        DB::insert('insert into students (name) values(?)',[$name]);
        echo "Record inserted successfully.<br/>";
        echo '<a href = "/insert">Click Here</a> to go back.';
     }
     
     public function index() {
        $users = DB::select('select * from students');
        return view('stud_view',['users'=>$users]);
     }
     
     public function destroy($id) {
        DB::delete('delete from students where id = ?',[$id]);
        echo "Record deleted successfully.<br/>";
        echo '<a href = "/view-records">Click Here</a> to go back.';
     }
     
     public function show($id) {
        $users = DB::select('select * from students where id = ?',[$id]);
        return view('stud_update',['users'=>$users]);
     }
     public function edit(Request $request,$id) {
        $name = $request->input('stud_name');
        DB::update('update students set name = ? where id = ?',[$name,$id]);
        echo "Record updated successfully.<br/>";
        echo '<a href = "/view-records">Click Here</a> to go back.';
     }
  
}
