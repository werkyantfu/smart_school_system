<template>
  <MasterLayout>
    <div class="page-header">
      <h1><i class="fas fa-chalkboard"></i> Class Management</h1>
      <p>Manage all school classes, sections, and rooms.</p>
    </div>
    
    <div class="layout-grid">
      <!-- Form to Add Class -->
      <div class="form-card">
        <h3><i class="fas fa-plus-circle"></i> Add New Class</h3>
        <form @submit.prevent="submitClass">
          <div class="form-group">
            <label><i class="fas fa-tag"></i> Class Name</label>
            <select v-model="form.name" required>
              <option value="" disabled>Select Class</option>
              <option value="KG 1">KG 1</option>
              <option value="KG 2">KG 2</option>
              <option value="KG 3">KG 3</option>
              <option value="Grade 1">Grade 1</option>
              <option value="Grade 2">Grade 2</option>
              <option value="Grade 3">Grade 3</option>
              <option value="Grade 4">Grade 4</option>
              <option value="Grade 5">Grade 5</option>
              <option value="Grade 6">Grade 6</option>
              <option value="Grade 7">Grade 7</option>
              <option value="Grade 8">Grade 8</option>
              <option value="Grade 9">Grade 9</option>
              <option value="Grade 10">Grade 10</option>
              <option value="Grade 11">Grade 11</option>
              <option value="Grade 12">Grade 12</option>
            </select>
          </div>
          <div class="form-group">
            <label><i class="fas fa-layer-group"></i> Section</label>
            <input v-model="form.section" type="text" placeholder="e.g. A" />
          </div>
          <div class="form-group">
            <label><i class="fas fa-door-open"></i> Room Number</label>
            <input v-model="form.room_number" type="text" placeholder="e.g. 101" />
          </div>
          <button type="submit" class="btn-save" :disabled="loading">
            <i v-if="loading" class="fas fa-spinner fa-spin"></i>
            <i v-else class="fas fa-save"></i> 
            {{ loading ? 'Saving...' : 'Save Class' }}
          </button>
        </form>
      </div>

      <!-- Table to Display Classes -->
      <div class="table-card">
        <div class="table-header">
          <h3><i class="fas fa-list"></i> All Classes</h3>
          <span class="badge-count">{{ classStore.classes.length }} Total</span>
        </div>
        <div class="table-responsive">
          <table class="data-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Class Name</th>
                <th>Section</th>
                <th>Room</th>
                <th style="text-align: center;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="cls in classStore.classes" :key="cls.id">
                <td><span class="id-badge">#{{ cls.id }}</span></td>
                <td>
                  <div class="class-info">
                    <div class="icon-box"><i class="fas fa-chalkboard"></i></div>
                    <strong>{{ cls.name }}</strong>
                  </div>
                </td>
                <td>{{ cls.section || 'N/A' }}</td>
                <td>{{ cls.room_number || 'N/A' }}</td>
                <td class="action-cell">
                  <div class="dropdown">
                    <button @click.stop="toggleMenu(cls.id)" class="btn-dots">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div v-if="activeMenu === cls.id" class="dropdown-menu">
                      <button @click="openEditModal(cls)" class="dropdown-item edit">
                        <i class="fas fa-pen"></i> Edit
                      </button>
                      <button @click="deleteClass(cls.id)" class="dropdown-item delete">
                        <i class="fas fa-trash-alt"></i> Delete
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- EDIT MODAL -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3><i class="fas fa-edit"></i> Edit Class</h3>
          <button @click="showModal = false" class="btn-close"><i class="fas fa-times"></i></button>
        </div>
        <div class="form-group">
          <label>Class Name</label>
          <input v-model="editForm.name" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Section</label>
          <input v-model="editForm.section" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Room Number</label>
          <input v-model="editForm.room_number" type="text" class="form-input" />
        </div>
        <div class="modal-actions">
          <button @click="showModal = false" class="btn-cancel">Cancel</button>
          <button @click="saveEdit" class="btn-save"><i class="fas fa-check"></i> Save Changes</button>
        </div>
      </div>
    </div>
  </MasterLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import MasterLayout from '../../components/layouts/MasterLayout.vue'
import { useClassStore } from '../../stores/classStore'

const classStore = useClassStore()
const activeMenu = ref<number | null>(null)
const showModal = ref(false)
const loading = ref(false)

const form = ref({ name: '', section: '', room_number: '' })
const editForm = ref({ id: 0, name: '', section: '', room_number: '' })

const toggleMenu = (id: number) => {
  activeMenu.value = activeMenu.value === id ? null : id
}
const closeMenu = () => { activeMenu.value = null }
onMounted(() => document.addEventListener('click', closeMenu))
onUnmounted(() => document.removeEventListener('click', closeMenu))

const submitClass = async () => {
  loading.value = true
  try {
    await classStore.addClass(form.value)
    form.value = { name: '', section: '', room_number: '' }
    alert('Class added successfully!')
  } catch (error) {
    console.error(error)
    alert('Failed to add class. Please try again.')
  } finally {
    loading.value = false
  }
}

const openEditModal = (cls: any) => {
  activeMenu.value = null
  editForm.value = {
    id: cls.id,
    name: cls.name,
    section: cls.section || '',
    room_number: cls.room_number || ''
  }
  showModal.value = true
}

const saveEdit = async () => {
  await classStore.updateClass(editForm.value.id, editForm.value)
  showModal.value = false
}

const deleteClass = async (id: number) => {
  activeMenu.value = null
  if (confirm('Are you sure you want to delete this class?')) {
    await classStore.removeClass(id)
  }
}

onMounted(() => {
  classStore.fetchClasses()
})
</script>

<style scoped>
.page-header { margin-bottom: 25px; }
.page-header h1 { margin: 0 0 8px 0; color: #1e293b; font-size: 24px; display: flex; align-items: center; gap: 12px; }
.page-header h1 i { color: #3498db; }
.page-header p { margin: 0; color: #64748b; font-size: 14px; }

.layout-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 25px; margin-top: 20px; }

.form-card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
.form-card h3 { margin-top: 0; color: #1e293b; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.form-card h3 i { color: #3498db; }
.form-group { margin-bottom: 15px; }
.form-group label { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 5px; }
.form-group label i { color: #3498db; width: 16px; }
.form-group input, .form-group select { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 14px; transition: 0.2s; background: white; }
.form-group input:focus, .form-group select:focus { border-color: #3498db; box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1); }
.btn-save { width: 100%; padding: 14px; background: #2ecc71; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; transition: 0.2s; }
.btn-save:hover { background: #27ae60; transform: translateY(-2px); }
.btn-save:disabled { opacity: 0.7; cursor: not-allowed; }

.table-card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.06); overflow: hidden; }
.table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.table-header h3 { margin: 0; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px; }
.table-header h3 i { color: #3498db; }
.badge-count { background: #e0f2fe; color: #0284c7; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; }

.table-responsive { overflow-x: auto; width: 100%; padding-bottom: 10px; }
.data-table { width: 100%; border-collapse: collapse; table-layout: auto; min-width: 600px; }
.data-table th { background: #f8fafc; color: #64748b; padding: 15px; text-align: left; font-size: 13px; text-transform: uppercase; font-weight: 700; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
.data-table td { padding: 15px; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; vertical-align: middle; }
.data-table tr:hover { background: #f8fafc; }

.id-badge { background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 13px; }
.class-info { display: flex; align-items: center; gap: 12px; }
.icon-box { width: 36px; height: 36px; background: #e0f2fe; color: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; }

.action-cell { text-align: center; position: relative; width: 80px; min-width: 80px; }
.btn-dots { background: transparent; border: none; color: #94a3b8; font-size: 18px; cursor: pointer; padding: 8px 12px; border-radius: 8px; transition: 0.2s; }
.btn-dots:hover { background: #f1f5f9; color: #1e293b; }

.dropdown { position: relative; display: inline-block; }
.dropdown-menu { position: absolute; right: 0; top: 100%; background: white; min-width: 150px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-radius: 10px; z-index: 100; padding: 6px; border: 1px solid #e2e8f0; display: flex; flex-direction: column; animation: fadeIn 0.2s ease-in-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

.dropdown-item { display: flex; align-items: center; gap: 10px; width: 100%; padding: 10px 15px; background: transparent; border: none; text-align: left; cursor: pointer; font-size: 14px; font-weight: 500; border-radius: 6px; transition: 0.2s; }
.dropdown-item.edit { color: #3498db; }
.dropdown-item.edit:hover { background: #e0f2fe; }
.dropdown-item.delete { color: #ef4444; }
.dropdown-item.delete:hover { background: #fee2e2; }

.modal-overlay { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); display: flex; justify-content: center; align-items: center; z-index: 9999; }
.modal-content { background: white; padding: 30px; border-radius: 16px; width: 450px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.modal-header h3 { margin: 0; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px; }
.btn-close { background: transparent; border: none; font-size: 20px; color: #94a3b8; cursor: pointer; }
.btn-close:hover { color: #ef4444; }
.form-input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 14px; }
.form-input:focus { border-color: #3498db; box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1); }
.modal-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px; }
.btn-cancel { padding: 10px 20px; background: #f1f5f9; color: #475569; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; }
.btn-cancel:hover { background: #e2e8f0; }
</style>