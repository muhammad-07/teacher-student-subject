<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validatedData['subject_id'] = (int) $validatedData['subject_id'];
        $teacherId = (int) $validatedData['teacher_id'];
        $subjectId = (int) $validatedData['subject_id'];
        $validator = Validator::make(
            $validatedData,
            [
                'subject_id' => function ($attribute, $value, $fail) use ($teacherId, $subjectId) {
                    $assignment = Assignment::where('teacher_id', $teacherId)->where('subject_id', $subjectId)->first();
                    if ($assignment) {
                        $fail("The selected subject is already assigned to the selected teacher.");
                    }
                },
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Assignment::create($validatedData);
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
