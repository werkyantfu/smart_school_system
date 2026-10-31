<template>
  <!-- ✅ Use MasterLayout for global Navbar, Sidebar, and Footer -->
  <MasterLayout>
    
    <!-- ✅ Page Header -->
    <PageHeader title="Student Management" icon="fas fa-user-graduate" />
    
    <!-- ✅ Grid Layout for Form and Table -->
    <div class="content-grid">
      <div class="form-col">
        <StudentForm />
      </div>
      <div class="table-col">
        <StudentTable />
      </div>
    </div>

  </MasterLayout>
</template>

<script setup lang="ts">
// ✅ Import MasterLayout
import MasterLayout from '../../components/layouts/MasterLayout.vue'

// ✅ Import Page Components
import PageHeader from '../../components/common/PageHeader.vue'
import StudentForm from '../../components/forms/StudentForm.vue'
import StudentTable from '../../components/tables/StudentTable.vue'
</script>

<style scoped>
/* ✅ Responsive Grid Layout (Form: 1 part, Table: 2 parts) */
.content-grid { 
  display: grid; 
  grid-template-columns: 1fr 2fr; 
  gap: 20px; 
  margin-top: 20px; 
}

/* ✅ Stack on smaller screens */
@media (max-width: 1024px) { 
  .content-grid { 
    grid-template-columns: 1fr; 
  } 
}
</style>