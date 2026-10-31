import api from './api'
export const reportService = {
  download: (type: string) => api.get(`/reports/${type}`, { responseType: 'blob' })
}