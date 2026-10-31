<template>
  <div class="table-container">
    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Class Name</th>
          <th>Level</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cls in classes" :key="cls.id">
          <td>{{ cls.id }}</td>
          <td><i class="fas fa-chalkboard"></i> {{ cls.name }}</td>
          <td>{{ cls.level }}</td>
        </tr>
        <tr v-if="classes.length === 0">
          <td colspan="3" style="text-align: center;">No classes found</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const classes = ref<any[]>([])
onMounted(async () => {
  try {
    const res = await api.get('/classes')
    classes.value = res.data.data
  } catch (error) {
    console.error('Error fetching classes:', error)
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