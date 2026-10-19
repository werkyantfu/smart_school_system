<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SchoolClassController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\MarkController;
use App\Http\Controllers\Api\AttendanceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC ROUTES (No Login Required)
// ==========================================
Route::post('/login', [AuthController::class, 'login']);


// ==========================================
// 2. PROTECTED ROUTES (Login Required)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // --- AUTH ---
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- STUDENTS ---
    Route::get('/students', [StudentController::class, 'index']);
    Route::post('/students', [StudentController::class, 'store']);
    Route::get('/students/{id}', [StudentController::class, 'show']);
    Route::put('/students/{id}', [StudentController::class, 'update']);
    Route::delete('/students/{id}', [StudentController::class, 'destroy']);

    // --- CLASSES ---
    Route::get('/classes', [SchoolClassController::class, 'index']);
    Route::post('/classes', [SchoolClassController::class, 'store']);
    Route::get('/classes/{id}', [SchoolClassController::class, 'show']);
    Route::put('/classes/{id}', [SchoolClassController::class, 'update']);
    Route::delete('/classes/{id}', [SchoolClassController::class, 'destroy']);

    // --- SUBJECTS ---
    Route::get('/subjects', [SubjectController::class, 'index']);
    Route::post('/subjects', [SubjectController::class, 'store']);
    Route::get('/subjects/{id}', [SubjectController::class, 'show']);
    Route::put('/subjects/{id}', [SubjectController::class, 'update']);
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']);

    // --- FINANCE (Invoices & Payments) ---
    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::post('/invoices', [InvoiceController::class, 'store']);
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
    Route::put('/invoices/{id}', [InvoiceController::class, 'update']);
    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy']);

    Route::get('/payments', [PaymentController::class, 'index']);
    Route::post('/payments', [PaymentController::class, 'store']);
    Route::get('/payments/{id}', [PaymentController::class, 'show']);
    Route::put('/payments/{id}', [PaymentController::class, 'update']);
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);

    // --- LMS (Marks & Attendance) ---
    Route::get('/marks', [MarkController::class, 'index']);
    Route::post('/marks', [MarkController::class, 'store']);
    Route::get('/marks/{id}', [MarkController::class, 'show']);
    Route::put('/marks/{id}', [MarkController::class, 'update']);
    Route::delete('/marks/{id}', [MarkController::class, 'destroy']);

    Route::get('/attendance', [AttendanceController::class, 'index']);
    Route::post('/attendance', [AttendanceController::class, 'store']);
    Route::get('/attendance/{id}', [AttendanceController::class, 'show']);
    Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
    Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy']);
});