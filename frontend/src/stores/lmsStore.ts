import { defineStore } from 'pinia'
import { ref } from 'vue'
import { lmsService } from '../services/lmsService'

export const useLmsStore = defineStore('lms', () => {
  const marks = ref<any[]>([])
  const attendances = ref<any[]>([])

  const fetchMarks = async () => {
    try {
      const response = await lmsService.getAllMarks()
      marks.value = response.data.data
    } catch (error) {
      console.error('Error fetching marks:', error)
    }
  }

  const fetchAttendances = async () => {
    try {
      const response = await lmsService.getAllAttendance()
      attendances.value = response.data.data
    } catch (error) {
      console.error('Error fetching attendance:', error)
    }
  }

  return { marks, attendances, fetchMarks, fetchAttendances }
})