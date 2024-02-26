<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
// use App\Models\Student;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view ('students.index')->with('students', $students);
    }


    public function create(): View
    {
        return view('students.create');

    }


    public function store(Request $request)
    {
        $add = new Student();
        $add->name = $request->name;
        $add->address = $request->address;
        $add->mobile = $request->mobile;
        $add->save();

        return redirect('students')->with('flash_message','Student Added');
    } 

    public function show(string $id): View
    {
        $student = Student::find($id);
        return view('students.show')->with('students',$student);    

    }

    public function edit(string $id): View
    {
        $student = Student::find($id);
        return view('students.edit')->with('students',$student);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $input = $request->all();
        Student::update($input);
        return redirect('students')->with('flash_message','Student updated');
    }

    public function destroy(string $id): RedirectResponse
    {
        Student::destroy($id);
        return redirect('students')->with('flash_message','Student deleted');
    }
}
