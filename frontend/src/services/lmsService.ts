import api from './api'

export const lmsService = {
  // Marks (ውጤቶች)
  getAllMarks: () => api.get('/marks'),
  createMark: (data: any) => api.post('/marks', data),
  
  // Attendance (መገኘት)
  getAllAttendance: () => api.get('/attendance'),
  createAttendance: (data: any) => api.post('/attendance', data)
}