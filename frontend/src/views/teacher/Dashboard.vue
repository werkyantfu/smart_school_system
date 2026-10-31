<template>
  <div class="dashboard-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <h1><i class="fas fa-chalkboard-teacher"></i> Teacher Dashboard</h1>
        <p>Welcome, Teacher!</p>
        <div class="stats-grid">
          <StatCard title="My Students" value="120" icon="fas fa-user-graduate" color="#3498db" />
          <StatCard title="Classes Today" value="4" icon="fas fa-clock" color="#f39c12" />
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