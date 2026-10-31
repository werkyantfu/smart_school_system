<template>
  <div class="page-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <PageHeader title="My Schedule" icon="fas fa-calendar-alt" />
        <div class="schedule-placeholder">
          <p><i class="fas fa-info-circle"></i> Schedule feature coming soon!</p>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import Navbar from '../../components/layouts/Navbar.vue'
import Sidebar from '../../components/layouts/Sidebar.vue'
import PageHeader from '../../components/common/PageHeader.vue'
</script>

<style scoped>
.dashboard-body { display: flex; flex: 1; }
.main-content { flex: 1; padding: 30px; background-color: #f4f6f8; }
.schedule-placeholder { background: white; padding: 40px; border-radius: 10px; text-align: center; color: #7f8c8d; }
</style>