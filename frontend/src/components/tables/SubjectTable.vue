<template>
  <div class="table-container">
    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Subject Name</th>
          <th>Code</th>
          <th>Class ID</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="subject in subjects" :key="subject.id">
          <td>{{ subject.id }}</td>
          <td><i class="fas fa-book"></i> {{ subject.name }}</td>
          <td>{{ subject.code }}</td>
          <td>{{ subject.class_id }}</td>
        </tr>
        <tr v-if="subjects.length === 0">
          <td colspan="4" style="text-align: center;">No subjects found</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const subjects = ref<any[]>([])
onMounted(async () => {
  try {
    const res = await api.get('/subjects')
    subjects.value = res.data.data
  } catch (error) {
    console.error('Error fetching subjects:', error)
  }
})
</script>

<style scoped>
.table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
th { background: #f8f9fa; color: #2c3e50; font-weight: bold; }
tr:hover { background: #f1f1f1; }
</style>