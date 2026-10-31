<template>
  <form @submit.prevent="submitForm" class="form-container">
    <h3><i class="fas fa-book"></i> Add New Subject</h3>
    <div class="form-row">
      <input v-model="form.name" placeholder="Subject Name (e.g. Math)" required />
      <input v-model="form.code" placeholder="Code (e.g. MTH-1)" required />
    </div>
    <div class="form-row">
      <input v-model="form.class_id" type="number" placeholder="Class ID" required />
    </div>
    <button type="submit"><i class="fas fa-book-medical"></i> Add Subject</button>
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import api from '../../services/api'

const form = ref({ name: '', code: '', class_id: 1 })

const submitForm = async (): Promise<void> => {
  try {
    await api.post('/subjects', form.value)
    alert('Subject added successfully! ✅')
    form.value = { name: '', code: '', class_id: 1 }
  } catch (error) { alert('Error adding subject!') }
}
</script>

<style scoped>
.form-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 15px; max-width: 600px; }
.form-container h3 { margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.form-row { display: flex; gap: 15px; }
.form-row input { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 12px; background: #9b59b6; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 8px; }
button:hover { background: #8e44ad; }
</style>