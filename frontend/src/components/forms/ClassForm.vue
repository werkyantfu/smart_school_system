<template>
  <form @submit.prevent="submitForm" class="form-container">
    <h3><i class="fas fa-chalkboard"></i> Add New Class</h3>
    <div class="form-row">
      <input v-model="form.name" placeholder="Class Name (e.g. Grade 1)" required />
      <input v-model="form.level" type="number" placeholder="Level (e.g. 1)" required />
    </div>
    <button type="submit"><i class="fas fa-plus-circle"></i> Add Class</button>
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import api from '../../services/api'

const form = ref({ name: '', level: 0 })

const submitForm = async (): Promise<void> => {
  try {
    await api.post('/classes', form.value)
    alert('Class added successfully! ✅')
    form.value = { name: '', level: 0 }
  } catch (error) { alert('Error adding class!') }
}
</script>

<style scoped>
.form-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; flex-direction: column; gap: 15px; max-width: 600px; }
.form-container h3 { margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.form-row { display: flex; gap: 15px; }
.form-row input { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 12px; background: #e67e22; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 8px; }
button:hover { background: #d35400; }
</style>