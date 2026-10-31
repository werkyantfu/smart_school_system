<template>
  <div class="table-card">
    <h3><i class="fas fa-list"></i> All Students</h3>
    
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Phone</th>
            <th>Status</th>
            <th style="text-align: center;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in studentStore.students" :key="student.id">
            <td><strong>{{ student.student_id || 'N/A' }}</strong></td>
            <td>
              <div class="user-info">
                <i class="fas fa-user-circle"></i>
                {{ student.first_name }} {{ student.last_name }}
              </div>
            </td>
            <td>{{ student.class }}</td>
            <td><i class="fas fa-phone" style="color: #2ecc71; font-size: 12px;"></i> {{ student.guardian_phone }}</td>
            <td><span class="badge active">Active</span></td>
            
            <!-- ✅ Three Dots Action Menu -->
            <td class="action-cell">
              <div class="dropdown">
                <button @click.stop="toggleMenu(student.id)" class="btn-dots">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
                
                <!-- Dropdown Menu -->
                <div v-if="activeMenu === student.id" class="dropdown-menu">
                  <button @click="openEditModal(student)" class="dropdown-item edit">
                    <i class="fas fa-edit"></i> Edit
                  </button>
                  <button @click="deleteStudent(student.id)" class="dropdown-item delete">
                    <i class="fas fa-trash"></i> Delete
                  </button>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- ✅ EDIT MODAL -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content">
        <h3>Edit Student</h3>
        
        <div class="form-group">
          <label>First Name</label>
          <input v-model="editForm.first_name" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input v-model="editForm.last_name" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Class</label>
          <input v-model="editForm.class" type="number" class="form-input" />
        </div>
        <div class="form-group">
          <label>Guardian Phone</label>
          <input v-model="editForm.guardian_phone" type="text" class="form-input" />
        </div>

        <div class="modal-actions">
          <button @click="showModal = false" class="btn-cancel">Cancel</button>
          <button @click="saveEdit" class="btn-save">Save Changes</button>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import { useStudentStore } from '../../stores/studentStore'

const studentStore = useStudentStore()
const activeMenu = ref<number | null>(null)
const showModal = ref(false)

// Edit Form Data
const editForm = ref({
  id: 0,
  first_name: '',
  last_name: '',
  class: '',
  guardian_phone: ''
})

const toggleMenu = (id: number) => {
  activeMenu.value = activeMenu.value === id ? null : id
}

const closeMenu = () => { activeMenu.value = null }
onMounted(() => document.addEventListener('click', closeMenu))
onUnmounted(() => document.removeEventListener('click', closeMenu))

const openEditModal = (student: any) => {
  activeMenu.value = null
  editForm.value = {
    id: student.id,
    first_name: student.first_name,
    last_name: student.last_name,
    class: student.class,
    guardian_phone: student.guardian_phone
  }
  showModal.value = true
}

const saveEdit = async () => {
  await studentStore.updateStudent(editForm.value.id, editForm.value)
  showModal.value = false
}

const deleteStudent = async (id: number) => {
  activeMenu.value = null
  if (confirm('Are you sure you want to delete this student?')) {
    await studentStore.removeStudent(id)
  }
}

onMounted(() => {
  studentStore.fetchStudents()
})
</script>

<style scoped>
.table-card {
  background: white;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  width: 100%;
}

.table-card h3 { margin-top: 0; color: #2c3e50; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }

/* ✅ Fixes table overflow */
.table-responsive { 
  overflow-x: auto; 
  width: 100%;
  padding-bottom: 10px; 
}

.data-table { 
  width: 100%; 
  border-collapse: collapse; 
  table-layout: auto;
  min-width: 700px; 
}

.data-table th { 
  background: #f8fafc; 
  color: #64748b; 
  padding: 15px; 
  text-align: left; 
  font-size: 13px; 
  text-transform: uppercase; 
  border-bottom: 2px solid #e2e8f0; 
  white-space: nowrap;
}

.data-table td { 
  padding: 15px; 
  border-bottom: 1px solid #e2e8f0; 
  color: #334155; 
  font-size: 14px; 
}

.data-table tr:hover { background: #f8fafc; }

.user-info { display: flex; align-items: center; gap: 10px; font-weight: 500; }
.user-info i { color: #94a3b8; font-size: 20px; }
.badge.active { background: #dcfce7; color: #16a34a; padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }

/* ✅ Actions Column Fix */
.action-cell { 
  text-align: center; 
  position: relative; 
  width: 80px; 
  min-width: 80px;
}

.btn-dots {
  background: transparent; 
  border: none; 
  color: #64748b; 
  font-size: 18px; 
  cursor: pointer; 
  padding: 8px 12px; 
  border-radius: 50%; 
  transition: 0.3s;
}
.btn-dots:hover { background: #e2e8f0; color: #2c3e50; }

.dropdown { position: relative; display: inline-block; }

.dropdown-menu {
  position: absolute;
  right: 0;
  top: 100%;
  background: white;
  min-width: 140px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  border-radius: 8px;
  z-index: 100;
  padding: 5px;
  border: 1px solid #e2e8f0;
  display: flex;
  flex-direction: column;
}

.dropdown-item {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
  padding: 10px 15px;
  background: transparent;
  border: none;
  text-align: left;
  cursor: pointer;
  font-size: 14px;
  font-weight: 500;
  border-radius: 6px;
  transition: 0.2s;
}
.dropdown-item.edit { color: #3498db; }
.dropdown-item.edit:hover { background: #e0f2fe; }
.dropdown-item.delete { color: #ef4444; }
.dropdown-item.delete:hover { background: #fee2e2; }

/* ✅ Modal Styles */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal-content {
  background: white;
  padding: 30px;
  border-radius: 12px;
  width: 400px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.modal-content h3 { margin-top: 0; color: #2c3e50; }

.form-group { margin-bottom: 15px; }
.form-group label { display: block; font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 5px; }
.form-input { width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 6px; outline: none; }
.form-input:focus { border-color: #3498db; }

.modal-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
.btn-cancel { padding: 10px 15px; background: #f1f5f9; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; }
.btn-save { padding: 10px 15px; background: #2ecc71; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; }
</style>