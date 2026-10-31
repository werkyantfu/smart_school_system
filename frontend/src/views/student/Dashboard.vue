<template>
  <div class="dashboard-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <h1><i class="fas fa-user-graduate"></i> Student Dashboard</h1>
        <p>Welcome, Student!</p>
        <div class="stats-grid">
          <StatCard title="My Grade" value="Grade 10" icon="fas fa-graduation-cap" color="#3498db" />
          <StatCard title="Pending Assignments" value="2" icon="fas fa-tasks" color="#e74c3c" />
        </div>
      </main>
    </div>
    <Footer />
  </div>
</template>

<script setup lang="ts">
import Navbar from '../../components/layouts/Navbar.vue'
import Sidebar from '../../components/layouts/Sidebar.vue'
import Footer from '../../components/layouts/Footer.vue'
import StatCard from '../../components/cards/StatCard.vue'
</script>

<style scoped>
.dashboard-layout { display: flex; flex-direction: column; height: 100vh; }
.dashboard-body { display: flex; flex: 1; }
.main-content { flex: 1; padding: 30px; background-color: #f4f6f8; }
.stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 20px; }
</style>