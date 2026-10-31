<template>
  <MasterLayout>
    <div class="page-header">
      <div class="header-left">
        <h1><i class="fas fa-chalkboard-teacher"></i> Teacher Management</h1>
        <p>Register, update, and manage all teaching staff.</p>
      </div>
      <div class="header-right">
        <span class="badge-total"><i class="fas fa-users"></i> {{ teacherStore.teachers.length }} Teachers</span>
      </div>
    </div>

    <div class="content-grid">
      <div class="form-col"><TeacherForm /></div>
      <div class="table-col"><TeacherTable /></div>
    </div>
  </MasterLayout>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import MasterLayout from '../../components/layouts/MasterLayout.vue'
import TeacherForm from '../../components/forms/TeacherForm.vue'
import TeacherTable from '../../components/tables/TeacherTable.vue'
import { useTeacherStore } from '../../stores/teacherStore'

const teacherStore = useTeacherStore()
onMounted(() => { teacherStore.fetchTeachers() })
</script>

<style scoped>
.page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px; }
.header-left h1 { margin: 0 0 8px 0; color: #1e293b; font-size: 24px; display: flex; align-items: center; gap: 12px; }
.header-left h1 i { color: #3498db; }
.header-left p { margin: 0; color: #64748b; font-size: 14px; }
.header-right { display: flex; align-items: center; }
.badge-total { background: #e0f2fe; color: #0284c7; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.content-grid { display: flex; flex-direction: column; gap: 25px; margin-top: 20px; }
.form-col { max-width: 800px; width: 100%; }
</style>