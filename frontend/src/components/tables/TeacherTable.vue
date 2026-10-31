<template>
  <div class="table-card">
    <div class="table-header">
      <h3><i class="fas fa-list"></i> All Teachers</h3>
    </div>
    
    <!-- ✅ Table Responsive (Enables Horizontal Scroll) -->
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Teacher Info</th>
            <th>Contact</th>
            <th>Qualification</th>
            <th style="text-align: center;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="teacher in teacherStore.teachers" :key="teacher.id">
            <td><span class="id-badge">#{{ teacher.id }}</span></td>
            
            <td>
              <div class="user-profile">
                <div class="avatar"><i class="fas fa-user-tie"></i></div>
                <div class="user-details">
                  <span class="user-name">{{ teacher.name }}</span>
                  <span class="user-email"><i class="fas fa-envelope"></i> {{ teacher.email }}</span>
                </div>
              </div>
            </td>
            
            <td>
              <div class="contact-info">
                <i class="fas fa-phone-alt text-green"></i> 
                {{ teacher.phone || 'N/A' }}
              </div>
            </td>
            
            <td>
              <span class="qualification-badge">
                <i class="fas fa-graduation-cap"></i> {{ teacher.qualification || 'N/A' }}
              </span>
            </td>
            
            <!-- ✅ Actions (Three Dots) -->
            <td class="action-cell">
              <div class="dropdown">
                <button @click.stop="toggleMenu(teacher.id)" class="btn-dots">
                  <i class="fas fa-ellipsis-v"></i>
                </button>
                
                <div v-if="activeMenu === teacher.id" class="dropdown-menu">
                  <button @click="openEditModal(teacher)" class="dropdown-item edit">
                    <i class="fas fa-pen"></i> Edit
                  </button>
                  <button @click="deleteTeacher(teacher.id)" class="dropdown-item delete">
                    <i class="fas fa-trash-alt"></i> Delete
                  </button>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- EDIT MODAL -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3><i class="fas fa-user-edit"></i> Edit Teacher</h3>
          <button @click="showModal = false" class="btn-close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="form-group">
          <label>Name</label>
          <input v-model="editForm.name" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input v-model="editForm.email" type="email" class="form-input" />
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input v-model="editForm.phone" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Qualification</label>
          <input v-model="editForm.qualification" type="text" class="form-input" />
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
import { useTeacherStore } from '../../stores/teacherStore'

const teacherStore = useTeacherStore()
const activeMenu = ref<number | null>(null)
const showModal = ref(false)

const editForm = ref({ id: 0, name: '', email: '', phone: '', qualification: '' })

const toggleMenu = (id: number) => {
  activeMenu.value = activeMenu.value === id ? null : id
}

const closeMenu = () => { activeMenu.value = null }
onMounted(() => document.addEventListener('click', closeMenu))
onUnmounted(() => document.removeEventListener('click', closeMenu))

const openEditModal = (teacher: any) => {
  activeMenu.value = null
  editForm.value = { id: teacher.id, name: teacher.name, email: teacher.email, phone: teacher.phone || '', qualification: teacher.qualification || '' }
  showModal.value = true
}

const saveEdit = async () => {
  await teacherStore.updateTeacher(editForm.value.id, editForm.value)
  showModal.value = false
}

const deleteTeacher = async (id: number) => {
  activeMenu.value = null
  if (confirm('Are you sure you want to delete this teacher?')) {
    await teacherStore.removeTeacher(id)
  }
}

onMounted(() => {
  teacherStore.fetchTeachers()
})
</script>

<style scoped>
/* ✅ Table Card */
.table-card {
  background: white;
  padding: 25px;
  border-radius: 16px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.06);
  width: 100%;
  overflow: hidden; /* ✅ Prevents the card from breaking */
}

.table-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}
.table-header h3 { margin: 0; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px; }
.table-header h3 i { color: #3498db; }

/* ✅ Scrollable Container */
.table-responsive { 
  overflow-x: auto; /* ✅ Enables horizontal scroll if needed */
  width: 100%;
  padding-bottom: 10px;
}

/* ✅ Table */
.data-table { 
  width: 100%; 
  border-collapse: collapse; 
  table-layout: auto;
  min-width: 800px; /* ✅ Ensures the Actions column is not cut off */
}

.data-table th { 
  background: #f8fafc; 
  color: #64748b; 
  padding: 15px; 
  text-align: left; 
  font-size: 13px; 
  text-transform: uppercase; 
  font-weight: 700;
  border-bottom: 2px solid #e2e8f0; 
  white-space: nowrap;
}

.data-table td { 
  padding: 15px; 
  border-bottom: 1px solid #f1f5f9; 
  color: #334155; 
  font-size: 14px; 
  vertical-align: middle;
}

.data-table tr:hover { background: #f8fafc; }

/* ✅ ID Badge */
.id-badge { background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 13px; }

/* ✅ User Profile */
.user-profile { display: flex; align-items: center; gap: 12px; }
.avatar { width: 40px; height: 40px; background: #e0f2fe; color: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; }
.user-details { display: flex; flex-direction: column; }
.user-name { font-weight: 600; color: #1e293b; }
.user-email { font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 5px; margin-top: 3px; }

/* ✅ Contact */
.contact-info { display: flex; align-items: center; gap: 8px; font-weight: 500; }
.text-green { color: #2ecc71; }

/* ✅ Qualification Badge */
.qualification-badge { background: #f3e8ff; color: #9333ea; padding: 6px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap; }

/* ✅ Actions Column (Fixes the cut-off 3 dots) */
.action-cell { 
  text-align: center; 
  position: relative; 
  width: 80px; 
  min-width: 80px;
}

.btn-dots { background: transparent; border: none; color: #94a3b8; font-size: 18px; cursor: pointer; padding: 8px 12px; border-radius: 8px; transition: 0.2s; }
.btn-dots:hover { background: #f1f5f9; color: #1e293b; }

.dropdown { position: relative; display: inline-block; }

.dropdown-menu {
  position: absolute;
  right: 0;
  top: 100%;
  background: white;
  min-width: 150px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  border-radius: 10px;
  z-index: 100;
  padding: 6px;
  border: 1px solid #e2e8f0;
  display: flex;
  flex-direction: column;
}

.dropdown-item { display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 15px; background: transparent; border: none; text-align: left; cursor: pointer; font-size: 14px; font-weight: 500; border-radius: 6px; transition: 0.2s; }
.dropdown-item.edit { color: #3498db; }
.dropdown-item.edit:hover { background: #e0f2fe; }
.dropdown-item.delete { color: #ef4444; }
.dropdown-item.delete:hover { background: #fee2e2; }

/* ✅ Modal Styles */
.modal-overlay { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); display: flex; justify-content: center; align-items: center; z-index: 9999; }
.modal-content { background: white; padding: 30px; border-radius: 16px; width: 450px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.modal-header h3 { margin: 0; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px; }
.btn-close { background: transparent; border: none; font-size: 20px; color: #94a3b8; cursor: pointer; transition: 0.2s; }
.btn-close:hover { color: #ef4444; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 8px; }
.form-input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 14px; }
.form-input:focus { border-color: #3498db; box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1); }
.modal-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px; }
.btn-cancel { padding: 10px 20px; background: #f1f5f9; color: #475569; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; }
.btn-cancel:hover { background: #e2e8f0; }
.btn-save { padding: 10px 20px; background: #2ecc71; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.btn-save:hover { background: #27ae60; transform: translateY(-2px); }
</style>