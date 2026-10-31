<template>
  <form @submit.prevent="submitForm" class="form-container">
    <h3><i class="fas fa-file-invoice"></i> Create Invoice</h3>
    <div class="form-row">
      <input v-model="form.student_id" type="number" placeholder="Student ID" required />
      <input v-model="form.term" placeholder="Term (e.g. Term 1)" required />
    </div>
    <div class="form-row">
      <input v-model="form.total_amount" type="number" placeholder="Total Amount (ETB)" required />
      <input v-model="form.due_date" type="date" required />
    </div>
    <button type="submit"><i class="fas fa-file-circle-plus"></i> Create Invoice</button>
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import api from '../../services/api'

const form = ref({ student_id: 1, term: '', total_amount: 0, due_date: '' })

const submitForm = async (): Promise<void> => {
  try {
    await api.post('/invoices', form.value)
    alert('Invoice created successfully! ✅')
    form.value = { student_id: 1, term: '', total_amount: 0, due_date: '' }
  } catch (error) { alert('Error creating invoice!') }
}
</script>

<style scoped>
.form-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 15px; max-width: 600px; }
.form-container h3 { margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.form-row { display: flex; gap: 15px; }
.form-row input { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 12px; background: #1abc9c; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 8px; }
button:hover { background: #16a085; }
</style>