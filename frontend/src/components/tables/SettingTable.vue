<template>
  <div class="table-card">
    <div class="table-header">
      <h3><i class="fas fa-table"></i> Current Settings</h3>
    </div>
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>Setting</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><i class="fas fa-school text-blue"></i> School Name</td>
            <td><strong>{{ settingStore.settings.school_name || 'N/A' }}</strong></td>
          </tr>
          <tr>
            <td><i class="fas fa-map-marker-alt text-blue"></i> Address</td>
            <td>{{ settingStore.settings.address || 'N/A' }}</td>
          </tr>
          <tr>
            <td><i class="fas fa-phone text-blue"></i> Phone</td>
            <td>{{ settingStore.settings.phone || 'N/A' }}</td>
          </tr>
          <tr>
            <td><i class="fas fa-envelope text-blue"></i> Email</td>
            <td>{{ settingStore.settings.email || 'N/A' }}</td>
          </tr>
          <tr>
            <td><i class="fas fa-calendar-alt text-blue"></i> Academic Year</td>
            <td><strong>{{ settingStore.settings.academic_year || 'N/A' }}</strong></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useSettingStore } from '../../stores/settingStore'
const settingStore = useSettingStore()
</script>

<style scoped>
.table-card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
.table-header { margin-bottom: 20px; }
.table-header h3 { margin: 0; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px; }
.table-header h3 i { color: #3498db; }
.table-responsive { overflow-x: auto; width: 100%; }
.data-table { width: 100%; border-collapse: collapse; }
.data-table th { background: #f8fafc; color: #64748b; padding: 15px; text-align: left; font-size: 13px; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; }
.data-table td { padding: 15px; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; }
.data-table tr:hover { background: #f8fafc; }
.text-blue { color: #3498db; width: 20px; }
</style>