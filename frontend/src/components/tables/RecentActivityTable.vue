<template>
  <div class="table-container">
    <h3><i class="fas fa-history"></i> Recent Activities</h3>
    <table class="data-table">
      <thead>
        <tr>
          <th>Time</th>
          <th>Activity</th>
          <th>User</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(activity, index) in activities" :key="index">
          <td>{{ activity.time }}</td>
          <td><i :class="activity.icon" style="margin-right: 8px;"></i> {{ activity.description }}</td>
          <td>{{ activity.user }}</td>
          <td><span class="badge success">{{ activity.status }}</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const activities = ref([
  { time: '10 min ago', icon: 'fas fa-user-plus', description: 'New student registered', user: 'Registrar', status: 'Success' },
  { time: '25 min ago', icon: 'fas fa-money-bill-wave', description: 'Payment received (5,000 ETB)', user: 'Accountant', status: 'Paid' },
  { time: '1 hour ago', icon: 'fas fa-pen', description: 'Grade 10 Math marks entered', user: 'Teacher', status: 'Updated' },
  { time: '2 hours ago', icon: 'fas fa-user-check', description: 'Attendance marked for Grade 9', user: 'Teacher', status: 'Success' }
])
</script>

<style scoped>
.table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); margin-top: 30px; }
.table-container h3 { margin: 0 0 15px 0; color: #2c3e50; display: flex; align-items: center; gap: 10px; }
.data-table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
th { background: #f8f9fa; color: #2c3e50; font-weight: bold; }
tr:hover { background: #f1f1f1; }
.badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; }
.badge.success { background: #d4edda; color: #155724; }
</style>