import { defineStore } from 'pinia'
import { ref } from 'vue'
import { subjectService } from '../services/subjectService'

export const useSubjectStore = defineStore('subject', () => {
  const subjects = ref<any[]>([])
  const loading = ref<boolean>(false)

  // ✅ Fetch all subjects
  const fetchSubjects = async () => {
    loading.value = true
    try {
      const response = await subjectService.getAll()
      subjects.value = response.data.data || []
    } catch (error) {
      console.error('Error fetching subjects:', error)
    } finally {
      loading.value = false
    }
  }

  // ✅ Add a new subject
  const addSubject = async (data: any) => {
    try {
      await subjectService.create(data)
      await fetchSubjects()
    } catch (error) {
      console.error('Error adding subject:', error)
      throw error
    }
  }

  // ✅ Update a subject
  const updateSubject = async (id: number, data: any) => {
    try {
      await subjectService.update(id, data)
      await fetchSubjects()
    } catch (error) {
      console.error('Error updating subject:', error)
      throw error
    }
  }

  // ✅ Delete a subject
  const removeSubject = async (id: number) => {
    try {
      await subjectService.delete(id)
      await fetchSubjects()
    } catch (error) {
      console.error('Error deleting subject:', error)
      throw error
    }
  }

  // ✅ Return everything so it can be used in components
  return { 
    subjects, 
    loading, 
    fetchSubjects, 
    addSubject, 
    updateSubject, 
    removeSubject 
  }
})