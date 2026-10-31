import { defineStore } from 'pinia'
import { ref } from 'vue'
import api from '../services/api'

export const useAuthStore = defineStore('auth', () => {
  const user = ref<any>(JSON.parse(localStorage.getItem('user') || 'null'))
  const token = ref<string | null>(localStorage.getItem('token'))

  const login = async (email: string, password: string) => {
    const response = await api.post('/login', { email, password })
    user.value = response.data.user
    token.value = response.data.token
    localStorage.setItem('user', JSON.stringify(user.value))
    localStorage.setItem('token', token.value as string) 
  }

  const logout = () => {
    user.value = null
    token.value = null
    localStorage.removeItem('user')
    localStorage.removeItem('token')
  }

  return { user, token, login, logout }
})