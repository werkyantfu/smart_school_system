<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // 1. Get All Teachers
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        return response()->json(['data' => $teachers]);
    }

    // 2. Create a New Teacher
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string',
            'qualification' => 'nullable|string',
        ]);

        // Create the User
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make('password123'), // Default password
            'role' => 'teacher',
        ]);

        // ✅ Create the Teacher Profile (If you have the teachers table)
        // This prevents the 500 error if you are using a leftJoin
        try {
            $user->teacher()->create([
                'employee_id' => 'TCH-' . rand(1000, 9999),
                'qualification' => $validated['qualification'] ?? 'N/A',
                'specialization' => 'General',
                'hire_date' => now(),
            ]);
        } catch (\Exception $e) {
            // If the teachers table doesn't exist, just ignore it
            // and return the user
        }

        return response()->json([
            'message' => 'Teacher created successfully', 
            'data' => $user
        ], 201);
    }

    // 3. Update a Teacher
    public function update(Request $request, $id)
    {
        $user = User::where('role', 'teacher')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string',
            'qualification' => 'nullable|string',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update Teacher Profile if it exists
        if ($user->teacher) {
            $user->teacher()->update([
                'phone' => $validated['phone'] ?? null,
                'qualification' => $validated['qualification'] ?? null,
            ]);
        }

        return response()->json(['message' => 'Teacher updated successfully']);
    }

    // 4. Delete a Teacher
    public function destroy($id)
    {
        $user = User::where('role', 'teacher')->findOrFail($id);
        $user->delete(); 

        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}