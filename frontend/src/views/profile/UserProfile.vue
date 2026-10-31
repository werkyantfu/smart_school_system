<template>
  <div class="page-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <PageHeader title="My Profile" icon="fas fa-user-circle" />
        <div class="profile-card">
          <p><strong><i class="fas fa-user"></i> Name:</strong> {{ user.name }}</p>
          <p><strong><i class="fas fa-envelope"></i> Email:</strong> {{ user.email }}</p>
          <p><strong><i class="fas fa-user-tag"></i> Role:</strong> {{ user.role }}</p>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import Navbar from '../../components/layouts/Navbar.vue'
import Sidebar from '../../components/layouts/Sidebar.vue'
import PageHeader from '../../components/common/PageHeader.vue'

const user = ref(JSON.parse(localStorage.getItem('user') || '{}'))
</script>

<style scoped>
.dashboard-body { display: flex; flex: 1; }
.main-content { flex: 1; padding: 30px; background-color: #f4f6f8; }
.profile-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); max-width: 500px; }
.profile-card p { font-size: 16px; margin: 15px 0; }
</style>