import { defineStore } from 'pinia'
import { ref } from 'vue'
import { settingService } from '../services/settingService'

export const useSettingStore = defineStore('setting', () => {
  const settings = ref<any>({})
  const loading = ref<boolean>(false)

  const fetchSettings = async () => {
    loading.value = true
    try {
      const response = await settingService.getSettings()
      // ✅ Ensure we grab the correct data
      settings.value = response.data.data || {}
    } catch (error) {
      console.error('Error fetching settings:', error)
    } finally {
      loading.value = false
    }
  }

  const updateSettings = async (data: any) => {
    loading.value = true
    try {
      const response = await settingService.updateSettings(data)
      settings.value = response.data.data
    } catch (error) {
      console.error('Error updating settings:', error)
      throw error
    } finally {
      loading.value = false
    }
  }

  return { settings, loading, fetchSettings, updateSettings }
})