<template>
  <div class="page-layout">
    <Navbar />
    <div class="dashboard-body">
      <Sidebar />
      <main class="main-content">
        <PageHeader title="Fee Status" icon="fas fa-money-bill-wave" />
        <InvoiceTable />
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import Navbar from '../../components/layouts/Navbar.vue'
import Sidebar from '../../components/layouts/Sidebar.vue'
import PageHeader from '../../components/common/PageHeader.vue'
import InvoiceTable from '../../components/tables/InvoiceTable.vue'
</script>

<style scoped>
.dashboard-body { display: flex; flex: 1; }
.main-content { flex: 1; padding: 30px; background-color: #f4f6f8; }
</style>