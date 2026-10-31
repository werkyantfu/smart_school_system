import { defineStore } from 'pinia'
import { ref } from 'vue'
import { teacherService } from '../services/teacherService'

export const useTeacherStore = defineStore('teacher', () => {
  const teachers = ref<any[]>([])
  const loading = ref<boolean>(false)

  // ✅ Fetch all teachers from Backend
  const fetchTeachers = async () => {
    loading.value = true
    try {
      const response = await teacherService.getAll()
      // Ensure we grab the correct array from the response (assuming Laravel returns { data: [...] })
      teachers.value = response.data.data || response.data
    } catch (error) {
      console.error('Error fetching teachers:', error)
    } finally {
      loading.value = false
    }
  }

  // ✅ Add a new teacher
  const addTeacher = async (data: any) => {
    try {
      await teacherService.create(data)
      await fetchTeachers() // Refresh list after adding
    } catch (error) {
      console.error('Error adding teacher:', error)
      throw error
    }
  }

  // ✅ Update an existing teacher
  const updateTeacher = async (id: number, data: any) => {
    try {
      await teacherService.update(id, data)
      await fetchTeachers() // Refresh list after updating
    } catch (error) {
      console.error('Error updating teacher:', error)
      throw error
    }
  }

  // ✅ Delete a teacher
  const removeTeacher = async (id: number) => {
    try {
      await teacherService.delete(id)
      await fetchTeachers() // Refresh list after deleting
    } catch (error) {
      console.error('Error deleting teacher:', error)
      throw error
    }
  }

  return { 
    teachers, 
    loading, 
    fetchTeachers, 
    addTeacher, 
    updateTeacher, 
    removeTeacher 
  }
})