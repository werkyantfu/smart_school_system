<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * 1. Get All Attendance Records (ሁሉንም የመገኘት መዝገቦች ማምጣት)
     */
    public function index()
    {
        $attendance = Attendance::with('student')->get();
        
        return response()->json([
            'message' => 'Attendance records retrieved successfully',
            'data' => $attendance
        ], 200);
    }

    /**
     * 2. Record Attendance (የተማሪ መገኘት መመዝገብ)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,late',
        ]);

        $attendance = Attendance::create($validated);

        return response()->json([
            'message' => 'Attendance recorded successfully',
            'data' => $attendance
        ], 201);
    }

    /**
     * 3. Get a Single Attendance Record (አንድ የመገኘት መዝገብ ማምጣት)
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('student')->find($id);

        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        return response()->json([
            'message' => 'Attendance record retrieved successfully',
            'data' => $attendance
        ], 200);
    }

    /**
     * 4. Update Attendance Record (የመገኘት መዝገብ ማስተካከል)
     */
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $validated = $request->validate([
            'student_id' => 'sometimes|exists:students,id',
            'date' => 'sometimes|date',
            'status' => 'sometimes|in:present,absent,late',
        ]);

        $attendance->update($validated);

        return response()->json([
            'message' => 'Attendance record updated successfully',
            'data' => $attendance
        ], 200);
    }

    /**
     * 5. Delete Attendance Record (የመገኘት መዝገብ ማጥፋት)
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return response()->json(['message' => 'Attendance record not found'], 404);
        }

        $attendance->delete();

        return response()->json(['message' => 'Attendance record deleted successfully'], 200);
    }
}