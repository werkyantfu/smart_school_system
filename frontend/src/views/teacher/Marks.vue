<template>
  <div class="page-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <PageHeader title="Enter Marks" icon="fas fa-pen" />
        <div class="content-grid">
          <div class="form-col"><MarkForm /></div>
          <div class="table-col"><MarkTable /></div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import Navbar from '../../components/layouts/Navbar.vue'
import Sidebar from '../../components/layouts/Sidebar.vue'
import PageHeader from '../../components/common/PageHeader.vue'
import MarkForm from '../../components/forms/MarkForm.vue'
import MarkTable from '../../components/tables/MarkTable.vue'
</script>

<style scoped>
.dashboard-body { display: flex; flex: 1; }
.main-content { flex: 1; padding: 30px; background-color: #f4f6f8; }
.content-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 20px; }
</style>