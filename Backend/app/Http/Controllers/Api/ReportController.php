<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Payment;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function generate($type)
    {
        $data = [];
        if ($type === 'financial') {
            $data = [
                'title' => 'Financial Report',
                'total' => Payment::sum('amount'),
                'totalStudents' => Student::count(),
                'payments' => Payment::with('student')->latest()->take(10)->get(),
            ];
        } elseif ($type === 'academic') {
            $data = ['title' => 'Academic Report', 'students' => Student::orderBy('class_id')->get()];
        } elseif ($type === 'payment') {
            $data = ['title' => 'Payment History', 'payments' => Payment::with('student')->latest()->get()];
        } else {
            return response()->json(['error' => 'Invalid report type'], 400);
        }

        Report::create(['user_id' => Auth::id(), 'report_type' => $type, 'generated_at' => now()]);
        
        $pdf = Pdf::loadView('reports.pdf', $data);
        return $pdf->download("{$type}_report.pdf");
    }
}