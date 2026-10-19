<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * 1. Get All Marks (List all marks with student and subject data)
     */
    public function index()
    {
        $marks = Mark::with(['student', 'subject'])->get();
        
        return response()->json([
            'message' => 'Marks retrieved successfully',
            'data' => $marks
        ], 200);
    }

    /**
     * 2. Store New Mark (Teacher enters a grade)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|numeric|min:0|max:100',
            'exam_type' => 'required|in:quiz,midterm,final',
        ]);

        $mark = Mark::create($validated);

        return response()->json([
            'message' => 'Mark saved successfully',
            'data' => $mark
        ], 201);
    }

    /**
     * 3. Get a Single Mark (Find one mark by ID)
     */
    public function show(string $id)
    {
        $mark = Mark::with(['student', 'subject'])->find($id);

        if (!$mark) {
            return response()->json(['message' => 'Mark not found'], 404);
        }

        return response()->json([
            'message' => 'Mark retrieved successfully',
            'data' => $mark
        ], 200);
    }

    /**
     * 4. Update Mark (Edit an existing grade)
     */
    public function update(Request $request, string $id)
    {
        $mark = Mark::find($id);

        if (!$mark) {
            return response()->json(['message' => 'Mark not found'], 404);
        }

        $validated = $request->validate([
            'student_id' => 'sometimes|exists:students,id',
            'subject_id' => 'sometimes|exists:subjects,id',
            'score' => 'sometimes|numeric|min:0|max:100',
            'exam_type' => 'sometimes|in:quiz,midterm,final',
        ]);

        $mark->update($validated);

        return response()->json([
            'message' => 'Mark updated successfully',
            'data' => $mark
        ], 200);
    }

    /**
     * 5. Delete Mark (Remove a grade)
     */
    public function destroy(string $id)
    {
        $mark = Mark::find($id);

        if (!$mark) {
            return response()->json(['message' => 'Mark not found'], 404);
        }

        $mark->delete();

        return response()->json(['message' => 'Mark deleted successfully'], 200);
    }
}