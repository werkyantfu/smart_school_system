<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('schoolClass')->get();
        return response()->json(['message' => 'Subjects retrieved successfully', 'data' => $subjects], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:20',
            'teacher_id' => 'nullable|exists:users,id',
        ]);
        $subject = Subject::create($validated);
        return response()->json(['message' => 'Subject created successfully', 'data' => $subject], 201);
    }

    public function show(string $id)
    {
        $subject = Subject::with('schoolClass')->find($id);
        if (!$subject) return response()->json(['message' => 'Subject not found'], 404);
        return response()->json(['message' => 'Subject retrieved successfully', 'data' => $subject], 200);
    }

    public function update(Request $request, string $id)
    {
        $subject = Subject::find($id);
        if (!$subject) return response()->json(['message' => 'Subject not found'], 404);

        $validated = $request->validate([
            'class_id' => 'sometimes|exists:classes,id',
            'name' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|max:20',
            'teacher_id' => 'nullable|exists:users,id',
        ]);
        $subject->update($validated);
        return response()->json(['message' => 'Subject updated successfully', 'data' => $subject], 200);
    }

    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        if (!$subject) return response()->json(['message' => 'Subject not found'], 404);
        $subject->delete();
        return response()->json(['message' => 'Subject deleted successfully'], 200);
    }
}