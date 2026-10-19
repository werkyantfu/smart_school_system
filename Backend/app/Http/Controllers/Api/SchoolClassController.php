<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * 1. Get All Classes (List all classes: KG to Grade 12)
     */
    public function index()
    {
        $classes = SchoolClass::all();
        
        return response()->json([
            'message' => 'Classes retrieved successfully',
            'data' => $classes
        ], 200);
    }

    /**
     * 2. Create New Class (Add a new class)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', // e.g., 'Grade 1', 'KG 2'
            'level' => 'required|integer',       // e.g., 1, 2 (for sorting)
        ]);

        $class = SchoolClass::create($validated);

        return response()->json([
            'message' => 'Class created successfully',
            'data' => $class
        ], 201);
    }

    /**
     * 3. Get a Single Class (Find one class by ID)
     */
    public function show(string $id)
    {
        $class = SchoolClass::with(['students', 'subjects'])->find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        return response()->json([
            'message' => 'Class retrieved successfully',
            'data' => $class
        ], 200);
    }

    /**
     * 4. Update Class (Edit a class name or level)
     */
    public function update(Request $request, string $id)
    {
        $class = SchoolClass::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'level' => 'sometimes|integer',
        ]);

        $class->update($validated);

        return response()->json([
            'message' => 'Class updated successfully',
            'data' => $class
        ], 200);
    }

    /**
     * 5. Delete Class (Remove a class)
     */
    public function destroy(string $id)
    {
        $class = SchoolClass::find($id);

        if (!$class) {
            return response()->json(['message' => 'Class not found'], 404);
        }

        $class->delete();

        return response()->json(['message' => 'Class deleted successfully'], 200);
    }
}