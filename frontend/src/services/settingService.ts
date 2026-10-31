import api from './api'

export const settingService = {
  // ✅ Get current settings
  getSettings: () => api.get('/settings'),

  // ✅ Update settings
  updateSettings: (data: any) => api.put('/settings', data)
}