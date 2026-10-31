<template>
  <form @submit.prevent="submitForm" class="form-container">
    <h3><i class="fas fa-money-bill-wave"></i> Record Payment</h3>
    <div class="form-row">
      <input v-model="form.invoice_id" type="number" placeholder="Invoice ID" required />
      <input v-model="form.amount" type="number" placeholder="Amount (ETB)" required />
    </div>
    <div class="form-row">
      <select v-model="form.method" required>
        <option value="cash">Cash</option>
        <option value="bank">Bank Transfer</option>
        <option value="telebirr">Telebirr</option>
        <option value="cbe_birr">CBE Birr</option>
      </select>
      <input v-model="form.payment_date" type="date" required />
    </div>
    <button type="submit"><i class="fas fa-check-circle"></i> Record Payment</button>
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import api from '../../services/api'

const form = ref({ invoice_id: 1, amount: 0, method: 'cash', payment_date: '' })

const submitForm = async (): Promise<void> => {
  try {
    await api.post('/payments', form.value)
    alert('Payment recorded successfully! ✅')
    form.value = { invoice_id: 1, amount: 0, method: 'cash', payment_date: '' }
  } catch (error) { alert('Error recording payment!') }
}
</script>

<style scoped>
.form-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 15px; max-width: 600px; }
.form-container h3 { margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.form-row { display: flex; gap: 15px; }
.form-row input, .form-row select { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 12px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 8px; }
button:hover { background: #2980b9; }
</style>