
<template>
  <div class="form-card">
    <h3><i class="fas fa-edit"></i> Update Settings</h3>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label><i class="fas fa-school"></i> School Name</label>
        <input v-model="form.school_name" type="text" placeholder="e.g. Smart SMS" required />
      </div>
      
      <div class="form-group">
        <label><i class="fas fa-map-marker-alt"></i> Address</label>
        <input v-model="form.address" type="text" placeholder="e.g. Addis Ababa" />
      </div>

      <div class="form-group">
        <label><i class="fas fa-phone"></i> Phone</label>
        <input v-model="form.phone" type="text" placeholder="e.g. 0911223344" />
      </div>

      <div class="form-group">
        <label><i class="fas fa-envelope"></i> Email</label>
        <input v-model="form.email" type="email" placeholder="e.g. info@school.com" />
      </div>

      <div class="form-group">
        <label><i class="fas fa-calendar-alt"></i> Academic Year</label>
        <input v-model="form.academic_year" type="text" placeholder="e.g. 2026" required />
      </div>

      <button type="submit" class="btn-save" :disabled="loading">
        <i v-if="loading" class="fas fa-spinner fa-spin"></i>
        <i v-else class="fas fa-save"></i> 
        {{ loading ? 'Saving...' : 'Save Settings' }}
      </button>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, watch } from 'vue'
import { useSettingStore } from '../../stores/settingStore'

const settingStore = useSettingStore()
const loading = ref(false)

const form = ref({
  school_name: '',
  address: '',
  phone: '',
  email: '',
  academic_year: ''
})

// ✅ Watch for store changes and update form
watch(() => settingStore.settings, (newSettings) => {
  if (newSettings && newSettings.school_name) {
    form.value = {
      school_name: newSettings.school_name || '',
      address: newSettings.address || '',
      phone: newSettings.phone || '',
      email: newSettings.email || '',
      academic_year: newSettings.academic_year || '2026'
    }
  }
}, { immediate: true })

const submitForm = async () => {
  loading.value = true
  try {
    await settingStore.updateSettings(form.value)
    alert('Settings saved successfully!')
  } catch (error) {
    alert('Failed to save settings. Please try again.')
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.form-card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
.form-card h3 { margin-top: 0; color: #1e293b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.form-card h3 i { color: #3498db; }
.form-group { margin-bottom: 15px; }
.form-group label { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 5px; }
.form-group label i { color: #3498db; width: 16px; }
.form-group input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 14px; transition: 0.2s; }
.form-group input:focus { border-color: #3498db; box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1); }
.btn-save { width: 100%; padding: 14px; background: #2ecc71; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; transition: 0.2s; margin-top: 10px; }
.btn-save:hover { background: #27ae60; transform: translateY(-2px); }
.btn-save:disabled { opacity: 0.7; cursor: not-allowed; }
</style>