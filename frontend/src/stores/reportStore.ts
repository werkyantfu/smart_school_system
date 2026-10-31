import { defineStore } from 'pinia'
import { ref } from 'vue'
import { reportService } from '../services/reportService'

export const useReportStore = defineStore('report', () => {
  const loading = ref(false)

  const downloadReport = async (type: string) => {
    loading.value = true
    try {
      const res = await reportService.download(type)
      const url = window.URL.createObjectURL(new Blob([res.data]))
      const link = document.createElement('a')
      link.href = url
      link.setAttribute('download', `${type}_report.pdf`)
      document.body.appendChild(link)
      link.click()
      link.remove()
    } catch (err) { 
      console.error(err)
      throw err 
    } finally { 
      loading.value = false 
    }
  }

  return { loading, downloadReport }
})