<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index() { return response()->json(['data' => SchoolClass::all()]); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'section' => 'nullable|string',
            'room_number' => 'nullable|string',
        ]);
        $class = SchoolClass::create($validated);
        return response()->json(['message' => 'Class created', 'data' => $class], 201);
    }

    public function update(Request $request, $id)
    {
        $class = SchoolClass::findOrFail($id);
        $class->update($request->all());
        return response()->json(['message' => 'Class updated', 'data' => $class]);
    }

    public function destroy($id)
    {
        SchoolClass::findOrFail($id)->delete();
        return response()->json(['message' => 'Class deleted']);
    }
}