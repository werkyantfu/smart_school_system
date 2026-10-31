import api from './api'

export const teacherService = {
  getAll: () => api.get('/teachers'),
  create: (data: any) => api.post('/teachers', data),
  update: (id: number, data: any) => api.put(`/teachers/${id}`, data),
  delete: (id: number) => api.delete(`/teachers/${id}`)
}