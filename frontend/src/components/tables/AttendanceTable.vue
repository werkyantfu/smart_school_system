<template>
  <div class="table-container">
    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Student ID</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="attendance in attendances" :key="attendance.id">
          <td>#{{ attendance.id }}</td>
          <td>{{ attendance.student_id }}</td>
          <td>{{ attendance.date }}</td>
          <td>
            <span class="badge" :class="{
              'success': attendance.status === 'present',
              'danger': attendance.status === 'absent',
              'warning': attendance.status === 'late'
            }">
              {{ attendance.status }}
            </span>
          </td>
        </tr>
        <tr v-if="attendances.length === 0">
          <td colspan="4" style="text-align: center;">No attendance records found</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const attendances = ref<any[]>([])
onMounted(async () => {
  try {
    const res = await api.get('/attendance')
    attendances.value = res.data.data
  } catch (error) {
    console.error('Error fetching attendance:', error)
  }
})
</script>

<style scoped>
.table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
th { background: #f8f9fa; color: #2c3e50; font-weight: bold; }
tr:hover { background: #f1f1f1; }
.badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; text-transform: capitalize; }
.badge.success { background: #d4edda; color: #155724; }
.badge.danger { background: #f8d7da; color: #721c24; }
.badge.warning { background: #fff3cd; color: #856404; }
</style>