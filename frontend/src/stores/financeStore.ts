import { defineStore } from 'pinia'
import { ref } from 'vue'
import { financeService } from '../services/financeService'

export const useFinanceStore = defineStore('finance', () => {
  const totalIncome = ref<number>(0)
  const totalExpense = ref<number>(0)
  const profit = ref<number>(0)
  const loading = ref<boolean>(false)

  // Fetch summary data from Backend
  const fetchSummary = async () => {
    loading.value = true
    try {
      const response = await financeService.getSummary()
      // Fallback to 0 if data is undefined
      totalIncome.value = response.data.total_income || 0
      totalExpense.value = response.data.total_expense || 0
      profit.value = response.data.profit || 0
    } catch (error) {
      console.error('Error fetching finance summary:', error)
    } finally {
      loading.value = false
    }
  }

  // Add an expense
  const addExpense = async (data: any) => {
    try {
      await financeService.addExpense(data)
      await fetchSummary() // Refresh summary after adding
    } catch (error) {
      console.error('Error adding expense:', error)
    }
  }

  return { 
    totalIncome, 
    totalExpense, 
    profit, 
    loading, 
    fetchSummary,
    addExpense
  }
})