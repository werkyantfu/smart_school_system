<template>
  <form @submit.prevent="submitForm" class="form-container">
    <h3><i class="fas fa-user-check"></i> Record Attendance</h3>
    <div class="form-row">
      <input v-model="form.student_id" type="number" placeholder="Student ID" required />
      <input v-model="form.date" type="date" required />
    </div>
    <div class="form-row">
      <select v-model="form.status" required>
        <option value="present">Present</option>
        <option value="absent">Absent</option>
        <option value="late">Late</option>
      </select>
    </div>
    <button type="submit"><i class="fas fa-clipboard-check"></i> Submit Attendance</button>
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import api from '../../services/api'

const form = ref({ student_id: 1, date: '', status: 'present' })

const submitForm = async (): Promise<void> => {
  try {
    await api.post('/attendance', form.value)
    alert('Attendance recorded successfully! ✅')
    form.value = { student_id: 1, date: '', status: 'present' }
  } catch (error) { alert('Error recording attendance!') }
}
</script>

<style scoped>
.form-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 15px; max-width: 600px; }
.form-container h3 { margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.form-row { display: flex; gap: 15px; }
.form-row input, .form-row select { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 12px; background: #34495e; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 8px; }
button:hover { background: #2c3e50; }
</style>