<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {


        $teachers = Teacher::with('subjects')->paginate(10);
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:teachers,email',
            'status' => 'required|in:Active,Inactive',
        ]);
        $teacher = new Teacher();
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->status = $request->input('status');

        $teacher->save();

        $teacher->subjects()->sync($request->input('subjects'));

        // Teacher::create($request->all());
        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('teachers')->ignore($teacher->id)],
            'status' => 'required|in:Active,Inactive',
        ]);

        $teacher = Teacher::find($teacher->id);
        if (!$teacher) {
            return redirect()->back()->with('error', 'teacher not found');
        }

        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->status = $request->input('status');

        $teacher->save();

        $teacher->subjects()->sync($request->input('subjects'));


        // $teacher->update($request->all());
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}

