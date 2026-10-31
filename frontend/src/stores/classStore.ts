import { defineStore } from 'pinia'
import { ref } from 'vue'
import { classService } from '../services/classService'

export const useClassStore = defineStore('class', () => {
  const classes = ref<any[]>([])
  const loading = ref(false)

  const fetchClasses = async () => {
    loading.value = true
    try {
      const res = await classService.getAll()
      classes.value = res.data.data || []
    } catch (err) { console.error(err) } finally { loading.value = false }
  }

  const addClass = async (data: any) => { await classService.create(data); await fetchClasses() }
  const updateClass = async (id: number, data: any) => { await classService.update(id, data); await fetchClasses() }
  const removeClass = async (id: number) => { await classService.delete(id); await fetchClasses() }

  return { classes, loading, fetchClasses, addClass, updateClass, removeClass }
})