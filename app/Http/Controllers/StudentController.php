<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('subjects')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('students.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            'status' => 'required|in:Active,Inactive',
        ]);

        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->status = $request->input('status');

        $student->save();

        $student->subjects()->sync($request->input('subjects'));


        // Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        $subjects = Subject::all();
        return view('students.edit', compact('student', 'subjects'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('students')->ignore($student->id)],
            'status' => 'required|in:Active,Inactive',
        ]);
        $student = Student::find($student->id);
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found');
        }
        // $student = new Student();
        // $student->id = $request->input('id');
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->status = $request->input('status');

        $student->save();

        $student->subjects()->sync($request->input('subjects'));
        // $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
