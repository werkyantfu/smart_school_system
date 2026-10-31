import { defineStore } from 'pinia'
import { ref } from 'vue'
import { studentService } from '../services/studentService'

export const useStudentStore = defineStore('student', () => {
  const students = ref<any[]>([])
  const loading = ref<boolean>(false)

  // ✅ 1. Fetch all students
  const fetchStudents = async () => {
    loading.value = true
    try {
      const response = await studentService.getAll()
      students.value = response.data.data || []
    } catch (error) {
      console.error('Error fetching students:', error)
    } finally {
      loading.value = false
    }
  }

  // ✅ 2. Add a new student
  const addStudent = async (data: any) => {
    try {
      await studentService.create(data)
      await fetchStudents() // Refresh list
    } catch (error) {
      console.error('Error adding student:', error)
      throw error
    }
  }

  // ✅ 3. Update an existing student
  const updateStudent = async (id: number, data: any) => {
    try {
      await studentService.update(id, data)
      await fetchStudents() // Refresh list
    } catch (error) {
      console.error('Error updating student:', error)
      throw error
    }
  }

  // ✅ 4. Delete a student
  const removeStudent = async (id: number) => {
    try {
      await studentService.delete(id)
      await fetchStudents() // Refresh list
    } catch (error) {
      console.error('Error deleting student:', error)
      throw error
    }
  }

  return { 
    students, 
    loading, 
    fetchStudents, 
    addStudent, 
    updateStudent, 
    removeStudent 
  }
})