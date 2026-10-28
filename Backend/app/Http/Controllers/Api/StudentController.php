<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('schoolClass')->get();
        return response()->json(['message' => 'Students retrieved successfully', 'data' => $students], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:M,F',
            'class_id' => 'required|exists:classes,id',
            'guardian_phone' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('students', 'public');
        $validated['photo'] = $photoPath;
    }

        $validated['student_id_number'] = 'SMS-' . date('Y') . '-' . rand(1000, 9999);
        $validated['status'] = 'active';

        $student = Student::create($validated);

        return response()->json(['message' => 'Student registered successfully', 'data' => $student], 201);
    }

    public function show(string $id)
    {
        $student = Student::with('schoolClass')->find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);
        return response()->json(['message' => 'Student retrieved successfully', 'data' => $student], 200);
    }

    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);

        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'dob' => 'sometimes|date',
            'gender' => 'sometimes|in:M,F',
            'class_id' => 'sometimes|exists:classes,id',
            'guardian_phone' => 'sometimes|string',
            'status' => 'sometimes|in:active,graduated,transferred',
        ]);

        $student->update($validated);
        return response()->json(['message' => 'Student updated successfully', 'data' => $student], 200);
    }

    public function destroy(string $id)
    {
        $student = Student::find($id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully'], 200);
    }
}