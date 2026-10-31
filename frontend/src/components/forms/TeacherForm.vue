<template>
  <form @submit.prevent="submitForm" class="form-container">
    <h3><i class="fas fa-chalkboard-teacher"></i> Add New Teacher</h3>
    <div class="form-row">
      <input v-model="form.name" placeholder="Full Name" required />
      <input v-model="form.email" type="email" placeholder="Email" required />
    </div>
    <div class="form-row">
      <input v-model="form.phone" placeholder="Phone Number" required />
      <input v-model="form.qualification" placeholder="Qualification (e.g. BSc)" required />
    </div>
    <button type="submit"><i class="fas fa-save"></i> Save Teacher</button>
  </form>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useTeacherStore } from '../../stores/teacherStore'

const teacherStore = useTeacherStore()
const loading = ref(false)

const form = ref({
  name: '',
  email: '',
  phone: '',
  qualification: ''
})

const submitForm = async () => {
  loading.value = true
  try {
    // ✅ Call the store to add the teacher
    await teacherStore.addTeacher(form.value)
    
    // ✅ Reset the form
    form.value = { name: '', email: '', phone: '', qualification: '' }
    
    alert('Teacher added successfully!')
  } catch (error) {
    console.error(error)
    alert('Failed to add teacher. Please try again.')
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.form-container { background: white; padding: 25px; border-radius: 10px; display: flex; flex-direction: column; gap: 15px; max-width: 600px; }
.form-container h3 { margin: 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.form-row { display: flex; gap: 15px; }
.form-row input { flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 12px; background: #2ecc71; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: flex; justify-content: center; align-items: center; gap: 8px; }
button:hover { background: #27ae60; }
</style>
