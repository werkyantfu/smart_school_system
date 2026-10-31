<template>
  <div class="table-container">
    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Student ID</th>
          <th>Subject ID</th>
          <th>Score</th>
          <th>Exam Type</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="mark in marks" :key="mark.id">
          <td>#{{ mark.id }}</td>
          <td>{{ mark.student_id }}</td>
          <td>{{ mark.subject_id }}</td>
          <td><strong>{{ mark.score }}</strong></td>
          <td><span class="badge info">{{ mark.exam_type }}</span></td>
        </tr>
        <tr v-if="marks.length === 0">
          <td colspan="5" style="text-align: center;">No marks found</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const marks = ref<any[]>([])
onMounted(async () => {
  try {
    const res = await api.get('/marks')
    marks.value = res.data.data
  } catch (error) {
    console.error('Error fetching marks:', error)
  }
})
</script>

<style scoped>
.table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
th { background: #f8f9fa; color: #2c3e50; font-weight: bold; }
tr:hover { background: #f1f1f1; }
.badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
.badge.info { background: #d1ecf1; color: #0c5460; }
</style>