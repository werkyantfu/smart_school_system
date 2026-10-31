<template>
  <div class="page-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <PageHeader title="Financial Report" icon="fas fa-chart-line" />
        <div class="stats-grid">
          <StatCard title="Total Collected" value="500,000 ETB" icon="fas fa-money-bill-wave" color="#2ecc71" />
          <StatCard title="Outstanding" value="50,000 ETB" icon="fas fa-exclamation-triangle" color="#e74c3c" />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import Navbar from '../../components/layouts/Navbar.vue'
import Sidebar from '../../components/layouts/Sidebar.vue'
import PageHeader from '../../components/common/PageHeader.vue'
import StatCard from '../../components/cards/StatCard.vue'
</script>

<style scoped>
.dashboard-body { display: flex; flex: 1; }
.main-content { flex: 1; padding: 30px; background-color: #f4f6f8; }
.stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 20px; }
</style>