<template>
  <div class="form-card">
    <h3><i class="fas fa-user-plus"></i> Register New Student</h3>
    
    <form @submit.prevent="submitForm">
      <div class="form-row">
        <div class="form-group">
          <label>First Name</label>
          <input v-model="form.first_name" type="text" placeholder="e.g. Dawit" required />
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input v-model="form.last_name" type="text" placeholder="e.g. Tesfaye" required />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Date of Birth</label>
          <input v-model="form.dob" type="date" required />
        </div>
        <div class="form-group">
          <label>Gender</label>
          <select v-model="form.gender" required>
            <option value="" disabled>Select Gender</option>
            <option value="M">Male</option> <!-- ✅ 'M' ተቀይሯል -->
            <option value="F">Female</option> <!-- ✅ 'F' ተቀይሯል -->
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Class / Grade</label>
          <!-- ✅ Class ID መሆን አለበት (ከ 1 እስከ 15) -->
          <select v-model="form.class_id" required>
            <option value="" disabled>Select Class</option>
            <option value="1">KG 1</option>
            <option value="2">KG 2</option>
            <option value="3">KG 3</option>
            <option value="4">Grade 1</option>
            <option value="5">Grade 2</option>
            <option value="6">Grade 3</option>
            <option value="7">Grade 4</option>
            <option value="8">Grade 5</option>
            <option value="9">Grade 6</option>
            <option value="10">Grade 7</option>
            <option value="11">Grade 8</option>
            <option value="12">Grade 9</option>
            <option value="13">Grade 10</option>
            <option value="14">Grade 11</option>
            <option value="15">Grade 12</option>
          </select>
        </div>
        <div class="form-group">
          <label>Guardian Phone</label>
          <input v-model="form.guardian_phone" type="text" placeholder="e.g. 0933445566" required />
        </div>
      </div>

      <button type="submit" class="btn-submit">
        <i class="fas fa-save"></i> Save Student
      </button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useStudentStore } from '../../stores/studentStore'

const studentStore = useStudentStore()

const form = ref({
  first_name: '',
  last_name: '',
  dob: '',
  gender: '', // M ወይም F
  class_id: '', // Class ID
  guardian_phone: ''
})

const submitForm = async () => {
  try {
    await studentStore.addStudent(form.value)
    form.value = { first_name: '', last_name: '', dob: '', gender: '', class_id: '', guardian_phone: '' }
    alert('Student Registered Successfully!')
  } catch (error) {
    console.error(error)
    alert('Failed to add student. Please try again.')
  }
}
</script>

<style scoped>
.form-card {
  background: white;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.form-card h3 { margin-top: 0; color: #2c3e50; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }

.form-row { display: flex; gap: 15px; margin-bottom: 15px; }
.form-group { flex: 1; display: flex; flex-direction: column; gap: 5px; }
.form-group label { font-size: 13px; font-weight: 600; color: #64748b; }
.form-group input, .form-group select {
  padding: 12px;
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  outline: none;
  font-size: 14px;
  transition: 0.3s;
}
.form-group input:focus, .form-group select:focus { border-color: #3498db; box-shadow: 0 0 0 3px rgba(52,152,219,0.1); }

.btn-submit {
  width: 100%;
  padding: 14px;
  background: #2ecc71;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-top: 10px;
  transition: 0.3s;
}
.btn-submit:hover { background: #27ae60; transform: translateY(-2px); }
</style>