<template>
  <form @submit.prevent="submitForm" class="form-container">
    <h3><i class="fas fa-pen"></i> Enter Student Mark</h3>
    <div class="form-row">
      <input v-model="form.student_id" type="number" placeholder="Student ID" required />
      <input v-model="form.subject_id" type="number" placeholder="Subject ID" required />
    </div>
    <div class="form-row">
      <input v-model="form.score" type="number" placeholder="Score (0-100)" required />
      <select v-model="form.exam_type" required>
        <option value="quiz">Quiz</option>
        <option value="midterm">Midterm</option>
        <option value="final">Final</option>
      </select>
    </div>
    <button type="submit"><i class="fas fa-save"></i> Save Mark</button>
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import api from '../../services/api'

const form = ref({ student_id: 1, subject_id: 1, score: 0, exam_type: 'quiz' })

const submitForm = async (): Promise<void> => {
  try {
    await api.post('/marks', form.value)
    alert('Mark saved successfully! ✅')
    form.value = { student_id: 1, subject_id: 1, score: 0, exam_type: 'quiz' }
  } catch (error) { alert('Error saving mark!') }
}
</script>

<style scoped>
.form-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 15px; max-width: 600px; }
.form-container h3 { margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.form-row { display: flex; gap: 15px; }
.form-row input, .form-row select { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 12px; background: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 8px; }
button:hover { background: #c0392b; }
</style>