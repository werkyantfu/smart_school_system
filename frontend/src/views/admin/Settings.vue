<template>
  <!-- ✅ Use MasterLayout -->
  <MasterLayout>
    <!-- ✅ Page Header -->
    <div class="page-header">
      <h1><i class="fas fa-cog"></i> School Settings</h1>
      <p>Manage your school information and academic year.</p>
    </div>

    <div class="layout-grid">
      <!-- ✅ Form Component -->
      <div class="form-col">
        <SettingForm />
      </div>

      <!-- ✅ Table Component -->
      <div class="table-col">
        <SettingTable />
      </div>
    </div>
  </MasterLayout>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import MasterLayout from '../../components/layouts/MasterLayout.vue' // ✅ Import MasterLayout
import SettingForm from '../../components/forms/SettingForm.vue'
import SettingTable from '../../components/tables/SettingTable.vue'
import { useSettingStore } from '../../stores/settingStore'

const settingStore = useSettingStore()

onMounted(async () => {
  await settingStore.fetchSettings()
})
</script>

<style scoped>
/* ✅ Page Header */
.page-header { margin-bottom: 25px; }
.page-header h1 { 
  margin: 0 0 8px 0; 
  color: #1e293b; 
  font-size: 24px; 
  display: flex; 
  align-items: center; 
  gap: 12px; 
}
.page-header h1 i { color: #3498db; }
.page-header p { 
  margin: 0; 
  color: #64748b; 
  font-size: 14px; 
}

/* ✅ Grid Layout */
.layout-grid { 
  display: grid; 
  grid-template-columns: 1fr 1fr; 
  gap: 25px; 
  margin-top: 20px; 
}

@media (max-width: 1024px) {
  .layout-grid { grid-template-columns: 1fr; }
}
</style>