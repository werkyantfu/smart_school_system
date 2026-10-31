<template>
  <div class="login-container">
    <div class="login-box">
      <div class="icon-header"><i class="fas fa-graduation-cap"></i></div>
      <h2>Smart SMS Login</h2>
      <p>Please Login to your account</p>
      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label><i class="fas fa-envelope"></i> Email:</label>
          <input v-model="email" type="email" placeholder="werkyantfutewachew@gmail.com" required />
        </div>
        <div class="form-group">
          <label><i class="fas fa-lock"></i> Password:</label>
          <input v-model="password" type="password" placeholder="********" required />
        </div>
        <button type="submit" :disabled="loading">
          <i class="fas fa-sign-in-alt"></i> {{ loading ? 'Logging in...' : 'Login' }}
        </button>
      </form>
      <p v-if="errorMessage" class="error"><i class="fas fa-exclamation-circle"></i> {{ errorMessage }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../../stores/auth'

const email = ref<string>('')
const password = ref<string>('')
const loading = ref<boolean>(false)
const errorMessage = ref<string>('')
const router = useRouter()
const authStore = useAuthStore()

const handleLogin = async (): Promise<void> => {
  loading.value = true
  errorMessage.value = ''
  try {
    await authStore.login(email.value, password.value)
    const role = authStore.user?.role
    if (role === 'admin') router.push('/dashboard')
    else if (role === 'teacher') router.push('/teacher/dashboard')
    else if (role === 'parent') router.push('/parent/dashboard')
    else if (role === 'student') router.push('/student/dashboard')
    else if (role === 'registrar') router.push('/registrar/dashboard')
    else if (role === 'accountant') router.push('/accountant/dashboard')
    else router.push('/dashboard')
  } catch (error: any) {
    if (error.response && error.response.status === 401) {
      errorMessage.value = 'Invalid email or password!'
    } else {
      errorMessage.value = 'An error occurred. Please try again.'
    }
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.login-container { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f2f5; }
.login-box { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; text-align: center; }
.icon-header { font-size: 40px; color: #007bff; margin-bottom: 10px; }
.form-group { margin-bottom: 15px; text-align: left; }
.form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
.form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; margin-top: 10px; }
button:hover { background-color: #0056b3; }
button:disabled { background-color: #6c757d; }
.error { color: red; margin-top: 15px; }
</style>