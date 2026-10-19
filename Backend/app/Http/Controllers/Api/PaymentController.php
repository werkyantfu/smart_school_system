<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * 1. Get All Payments (List all payment records)
     */
    public function index()
    {
        $payments = Payment::with('invoice')->get();
        
        return response()->json([
            'message' => 'Payments retrieved successfully',
            'data' => $payments
        ], 200);
    }

    /**
     * 2. Store New Payment (Record a payment and update invoice status)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric|min:0',
            'method' => 'required|in:cash,bank,telebirr,cbe_birr',
            'payment_date' => 'required|date',
        ]);

        // Auto-generate receipt number
        $validated['receipt_number'] = 'RCP-' . rand(10000, 99999);

        $payment = Payment::create($validated);

        // Automatically update the invoice status to 'paid'
        $invoice = Invoice::find($validated['invoice_id']);
        if ($invoice) {
            $invoice->update(['status' => 'paid']);
        }

        return response()->json([
            'message' => 'Payment recorded and invoice marked as paid',
            'data' => $payment
        ], 201);
    }

    /**
     * 3. Get a Single Payment (Find one payment by ID)
     */
    public function show(string $id)
    {
        $payment = Payment::with('invoice')->find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        return response()->json([
            'message' => 'Payment retrieved successfully',
            'data' => $payment
        ], 200);
    }

    /**
     * 4. Update Payment (Edit payment details)
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $validated = $request->validate([
            'invoice_id' => 'sometimes|exists:invoices,id',
            'amount' => 'sometimes|numeric|min:0',
            'method' => 'sometimes|in:cash,bank,telebirr,cbe_birr',
            'payment_date' => 'sometimes|date',
        ]);

        $payment->update($validated);

        return response()->json([
            'message' => 'Payment updated successfully',
            'data' => $payment
        ], 200);
    }

    /**
     * 5. Delete Payment (Remove a payment record)
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully'], 200);
    }
}