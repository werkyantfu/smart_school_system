<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * 1. Get All Invoices (List all invoices with student data)
     */
    public function index()
    {
        $invoices = Invoice::with('student')->get();
        
        return response()->json([
            'message' => 'Invoices retrieved successfully',
            'data' => $invoices
        ], 200);
    }

    /**
     * 2. Create New Invoice (Generate a new fee invoice)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'term' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
        ]);

        // Default status is 'unpaid'
        $validated['status'] = 'unpaid';

        $invoice = Invoice::create($validated);

        return response()->json([
            'message' => 'Invoice created successfully',
            'data' => $invoice
        ], 201);
    }

    /**
     * 3. Get a Single Invoice (Find one invoice by ID)
     */
    public function show(string $id)
    {
        $invoice = Invoice::with(['student', 'payments'])->find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        return response()->json([
            'message' => 'Invoice retrieved successfully',
            'data' => $invoice
        ], 200);
    }

    /**
     * 4. Update Invoice (Edit invoice details)
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $validated = $request->validate([
            'student_id' => 'sometimes|exists:students,id',
            'term' => 'sometimes|string|max:255',
            'total_amount' => 'sometimes|numeric|min:0',
            'due_date' => 'sometimes|date',
            'status' => 'sometimes|in:paid,unpaid,partial',
        ]);

        $invoice->update($validated);

        return response()->json([
            'message' => 'Invoice updated successfully',
            'data' => $invoice
        ], 200);
    }

    /**
     * 5. Delete Invoice (Remove an invoice)
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $invoice->delete();

        return response()->json(['message' => 'Invoice deleted successfully'], 200);
    }
}