<template>
  <div class="page-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <PageHeader title="Settings" icon="fas fa-cog" />
        <form @submit.prevent="updatePassword" class="settings-form">
          <input v-model="currentPassword" type="password" placeholder="Current Password" required />
          <input v-model="newPassword" type="password" placeholder="New Password" required />
          <button type="submit"><i class="fas fa-save"></i> Update Password</button>
        </form>
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import Navbar from '../../components/layouts/Navbar.vue'
import Sidebar from '../../components/layouts/Sidebar.vue'
import PageHeader from '../../components/common/PageHeader.vue'

const currentPassword = ref('')
const newPassword = ref('')

const updatePassword = (): void => {
  alert('Password update feature coming soon!')
}
</script>

<style scoped>
.dashboard-body { display: flex; flex: 1; }
.main-content { flex: 1; padding: 30px; background-color: #f4f6f8; }
.settings-form { display: flex; flex-direction: column; gap: 15px; max-width: 400px; background: white; padding: 20px; border-radius: 10px; }
input { padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
button { padding: 10px; background: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer; }
</style>