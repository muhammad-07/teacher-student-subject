<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('teacher', 'subject')->paginate(10);
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $students = Student::all();
        return view('assignments.create', compact('teachers', 'subjects', 'students'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'students' => 'required|array',
            'status' => 'required|in:Active,Inactive',
        ]);
        // $validatedData['students'] = implode(',', $validatedData['students']);
        $assignment = Assignment::create($validatedData);
        // dd($assignment);
        return redirect()->route('assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function edit(Assignment $assignment)
    {
        $teachers = Teacher::all();
        $subjects = Subject::all();
        $students = Student::all();
        return view('assignments.edit', compact('assignment', 'teachers', 'subjects', 'students'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'students' => 'required|array',
            'status' => 'required|in:Active,Inactive',
        ]);
        $assignment->update($validatedData);

        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function show(Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    public function destroy(Assignment $assignment)
    {
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}
