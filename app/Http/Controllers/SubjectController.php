<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(10);
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:subjects'],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        Subject::create($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => ['required', Rule::unique('subjects')->ignore($subject->id)],
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        $subject->update($request->all());

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
