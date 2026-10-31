<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSettings()
    {
        $settings = Setting::first();
        if (!$settings) {
            $settings = Setting::create([]);
        }
        return response()->json(['data' => $settings]);
    }

    public function updateSettings(Request $request)
    {
        $settings = Setting::first() ?? new Setting();
        
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'academic_year' => 'required|string',
        ]);

        $settings->fill($validated)->save();
        return response()->json(['message' => 'Settings updated', 'data' => $settings]);
    }
}