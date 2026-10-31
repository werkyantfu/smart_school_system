import api from './api'

export const subjectService = {
  getAll: () => api.get('/subjects'),
  create: (data: any) => api.post('/subjects', data),
  update: (id: number, data: any) => api.put(`/subjects/${id}`, data),
  delete: (id: number) => api.delete(`/subjects/${id}`)
}