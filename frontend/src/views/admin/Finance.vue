<template>
  <!-- ✅ Use MasterLayout -->
  <MasterLayout>
    <!-- ✅ Page Header -->
    <div class="page-header">
      <h1><i class="fas fa-wallet"></i> Finance Management</h1>
      <p>Manage school income, expenses, and profit.</p>
    </div>

    <!-- ✅ Finance Summary Cards -->
    <div class="stats-grid">
      <div class="stat-card blue">
        <h3>Total Income</h3>
        <h2>{{ financeStore.totalIncome.toLocaleString() }} ETB</h2>
      </div>
      <div class="stat-card red">
        <h3>Total Expense</h3>
        <h2>{{ financeStore.totalExpense.toLocaleString() }} ETB</h2>
      </div>
      <div class="stat-card green">
        <h3>Net Profit</h3>
        <h2>{{ financeStore.profit.toLocaleString() }} ETB</h2>
      </div>
    </div>

    <div class="finance-grid">
      <!-- ✅ Add Expense Form -->
      <div class="form-card">
        <h3><i class="fas fa-plus-circle"></i> Add New Expense</h3>
        <form @submit.prevent="submitExpense">
          <div class="form-group">
            <label>Expense Title</label>
            <input v-model="expenseForm.title" type="text" placeholder="e.g. Teacher Salary" required />
          </div>
          <div class="form-group">
            <label>Amount (ETB)</label>
            <input v-model="expenseForm.amount" type="number" placeholder="e.g. 5000" required />
          </div>
          <div class="form-group">
            <label>Category</label>
            <select v-model="expenseForm.category" required>
              <option value="" disabled>Select Category</option>
              <option value="salary">Salary</option>
              <option value="utility">Utility (Water, Electricity)</option>
              <option value="maintenance">Maintenance</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="form-group">
            <label>Date</label>
            <input v-model="expenseForm.expense_date" type="date" required />
          </div>
          <button type="submit" class="btn-save">Record Expense</button>
        </form>
      </div>

      <!-- ✅ Profit Summary Box -->
      <div class="summary-box">
        <h3><i class="fas fa-chart-line"></i> Financial Summary</h3>
        <p>Total Income: <strong>{{ financeStore.totalIncome.toLocaleString() }} ETB</strong></p>
        <p>Total Expenses: <strong>{{ financeStore.totalExpense.toLocaleString() }} ETB</strong></p>
        <hr />
        <h2 :class="financeStore.profit >= 0 ? 'profit-text' : 'loss-text'">
          {{ financeStore.profit >= 0 ? 'Profit' : 'Loss' }}: 
          {{ financeStore.profit.toLocaleString() }} ETB
        </h2>
      </div>
    </div>
  </MasterLayout>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import MasterLayout from '../../components/layouts/MasterLayout.vue' // ✅ Import MasterLayout
import { useFinanceStore } from '../../stores/financeStore'

const financeStore = useFinanceStore()

const expenseForm = ref({
  title: '',
  amount: '',
  category: '',
  expense_date: new Date().toISOString().split('T')[0]
})

const submitExpense = async () => {
  await financeStore.addExpense(expenseForm.value)
  expenseForm.value = { title: '', amount: '', category: '', expense_date: new Date().toISOString().split('T')[0] }
  alert('Expense recorded successfully!')
}

onMounted(() => {
  financeStore.fetchSummary()
})
</script>

<style scoped>
/* ✅ Page Header */
.page-header { margin-bottom: 25px; }
.page-header h1 { margin: 0 0 8px 0; color: #1e293b; font-size: 24px; display: flex; align-items: center; gap: 12px; }
.page-header h1 i { color: #3498db; }
.page-header p { margin: 0; color: #64748b; font-size: 14px; }

/* ✅ Stats Grid */
.stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px; }
.stat-card { padding: 20px; border-radius: 12px; color: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
.stat-card.blue { background: #3498db; }
.stat-card.red { background: #e74c3c; }
.stat-card.green { background: #2ecc71; }
.stat-card h3 { margin: 0; font-size: 14px; opacity: 0.9; }
.stat-card h2 { margin: 10px 0 0 0; font-size: 24px; }

/* ✅ Finance Grid */
.finance-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-top: 30px; }
.form-card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
.form-card h3 { margin-top: 0; color: #2c3e50; margin-bottom: 20px; }
.form-group { margin-bottom: 15px; display: flex; flex-direction: column; gap: 5px; }
.form-group label { font-size: 13px; font-weight: 600; color: #64748b; }
.form-group input, .form-group select { padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; }
.btn-save { width: 100%; padding: 14px; background: #e74c3c; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; }
.btn-save:hover { background: #c0392b; }

/* ✅ Summary Box */
.summary-box { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
.summary-box h3 { margin-top: 0; color: #2c3e50; }
.summary-box p { color: #64748b; font-size: 15px; margin: 10px 0; }
.summary-box hr { border: none; border-top: 1px solid #e2e8f0; margin: 20px 0; }
.profit-text { color: #2ecc71; }
.loss-text { color: #e74c3c; }

@media (max-width: 768px) {
  .stats-grid, .finance-grid { grid-template-columns: 1fr; }
}
</style>