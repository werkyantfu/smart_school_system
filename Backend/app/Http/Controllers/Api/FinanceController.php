<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Expense;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    // 1. Dashboard Summary (Total Income, Total Expense, Profit)
    public function getSummary()
    {
        $totalIncome = Payment::sum('amount');
        $totalExpense = Expense::sum('amount');
        $profit = $totalIncome - $totalExpense;

        return response()->json([
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
            'profit' => $profit
        ]);
    }

    // 2. Add an Expense (e.g., Teacher Salary)
    public function addExpense(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'expense_date' => 'required|date',
            'category' => 'required|string',
        ]);

        $expense = Expense::create($validated);
        return response()->json(['message' => 'Expense added', 'expense' => $expense], 201);
    }
}