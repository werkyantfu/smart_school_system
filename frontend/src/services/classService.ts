import api from './api'

export const classService = {
  getAll: () => api.get('/classes'),
  create: (data: any) => api.post('/classes', data),
  update: (id: number, data: any) => api.put(`/classes/${id}`, data),
  delete: (id: number) => api.delete(`/classes/${id}`)
}