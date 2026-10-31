import api from './api'

export const financeService = {
  // Get total income, total expense, and profit
  getSummary: () => api.get('/finance/summary'),

  // Add a new expense (e.g., Teacher Salary)
  addExpense: (data: any) => api.post('/finance/expenses', data),

  // Create a new invoice
  createInvoice: (data: any) => api.post('/finance/invoices', data),

  // Record a new payment
  recordPayment: (data: any) => api.post('/finance/payments', data)
}