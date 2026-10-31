<template>
  <!-- ✅ Use MasterLayout -->
  <MasterLayout>
    <div class="page-header">
      <h1><i class="fas fa-book"></i> Subject Management</h1>
      <p>Manage all school subjects here.</p>
    </div>
    
    <div class="layout-grid">
      <!-- ✅ Form to Add Subject -->
      <div class="form-card">
        <h3><i class="fas fa-plus-circle"></i> Add New Subject</h3>
        <form @submit.prevent="submitSubject">
          
          <div class="form-group">
            <label><i class="fas fa-school"></i> Select Class</label>
            <select v-model="form.class_id" required>
              <option value="" disabled>Select Class</option>
              <option v-for="cls in classStore.classes" :key="cls.id" :value="cls.id">
                {{ cls.name }} - {{ cls.section }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <label><i class="fas fa-book-open"></i> Subject Name</label>
            <input v-model="form.name" type="text" placeholder="e.g. Mathematics" required />
          </div>
          
          <div class="form-group">
            <label><i class="fas fa-code"></i> Subject Code</label>
            <input v-model="form.code" type="text" placeholder="e.g. MATH101" required />
          </div>

          <div class="form-group">
            <label><i class="fas fa-chalkboard-teacher"></i> Assign Teacher (Optional)</label>
            <select v-model="form.teacher_id">
              <option :value="null">No Teacher Assigned</option>
              <option v-for="teacher in teacherStore.teachers" :key="teacher.id" :value="teacher.id">
                {{ teacher.name }}
              </option>
            </select>
          </div>

          <button type="submit" class="btn-save" :disabled="loading">
            <i v-if="loading" class="fas fa-spinner fa-spin"></i>
            <i v-else class="fas fa-save"></i> 
            {{ loading ? 'Saving...' : 'Save Subject' }}
          </button>
        </form>
      </div>

      <!-- ✅ Table to Display Subjects -->
      <div class="table-card">
        <div class="table-header">
          <h3><i class="fas fa-list"></i> All Subjects</h3>
          <span class="badge-count">{{ subjectStore.subjects.length }} Total</span>
        </div>

        <div class="table-responsive">
          <table class="data-table">
            <thead>
              <tr>
                <th style="width: 8%;">ID</th>
                <th style="width: 35%;">Subject</th>
                <th style="width: 15%;">Class</th>
                <th style="width: 25%;">Teacher</th>
                <th style="width: 17%; text-align: center;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="subject in subjectStore.subjects" :key="subject.id">
                <td><span class="id-badge">#{{ subject.id }}</span></td>
                
                <!-- ✅ Subject Name & Code (Beautiful Badge) -->
                <td>
                  <div class="subject-info">
                    <div class="icon-box"><i class="fas fa-book"></i></div>
                    <div class="subject-details">
                      <strong class="subject-name">{{ subject.name }}</strong>
                      <span class="code-badge"><i class="fas fa-tag"></i> {{ subject.code }}</span>
                    </div>
                  </div>
                </td>
                
                <td>{{ subject.school_class ? subject.school_class.name : 'N/A' }}</td>
                <td>
                  <span v-if="subject.teacher" class="teacher-name">
                    <i class="fas fa-user-circle"></i> {{ subject.teacher.name }}
                  </span>
                  <span v-else class="text-muted">Not Assigned</span>
                </td>
                
                <!-- Three Dots Action Menu -->
                <td class="action-cell">
                  <div class="dropdown">
                    <button @click.stop="toggleMenu(subject.id)" class="btn-dots">
                      <i class="fas fa-ellipsis-v"></i>
                    </button>
                    
                    <div v-if="activeMenu === subject.id" class="dropdown-menu">
                      <button @click="openEditModal(subject)" class="dropdown-item edit">
                        <i class="fas fa-pen"></i> Edit
                      </button>
                      <button @click="deleteSubject(subject.id)" class="dropdown-item delete">
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

    <!-- ✅ EDIT MODAL -->
    <div v-if="showModal" class="modal-overlay">
      <div class="modal-content">
        <div class="modal-header">
          <h3><i class="fas fa-edit"></i> Edit Subject</h3>
          <button @click="showModal = false" class="btn-close"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="form-group">
          <label>Class</label>
          <select v-model="editForm.class_id" class="form-input" required>
            <option v-for="cls in classStore.classes" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
          </select>
        </div>
        <div class="form-group">
          <label>Subject Name</label>
          <input v-model="editForm.name" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Subject Code</label>
          <input v-model="editForm.code" type="text" class="form-input" />
        </div>
        <div class="form-group">
          <label>Teacher</label>
          <select v-model="editForm.teacher_id" class="form-input">
            <option :value="null">No Teacher</option>
            <option v-for="teacher in teacherStore.teachers" :key="teacher.id" :value="teacher.id">{{ teacher.name }}</option>
          </select>
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
import MasterLayout from '../../components/layouts/MasterLayout.vue' // ✅ Import MasterLayout
import { useSubjectStore } from '../../stores/subjectStore'
import { useClassStore } from '../../stores/classStore'
import { useTeacherStore } from '../../stores/teacherStore'

const subjectStore = useSubjectStore()
const classStore = useClassStore()
const teacherStore = useTeacherStore()

const activeMenu = ref<number | null>(null)
const showModal = ref(false)
const loading = ref(false)

// Form for adding
const form = ref({ class_id: '', name: '', code: '', teacher_id: null })

// Form for editing
const editForm = ref({ id: 0, class_id: '', name: '', code: '', teacher_id: null })

// Dropdown toggle
const toggleMenu = (id: number) => {
  activeMenu.value = activeMenu.value === id ? null : id
}
const closeMenu = () => { activeMenu.value = null }
onMounted(() => document.addEventListener('click', closeMenu))
onUnmounted(() => document.removeEventListener('click', closeMenu))

// ✅ Add Subject
const submitSubject = async () => {
  loading.value = true
  try {
    await subjectStore.addSubject(form.value)
    form.value = { class_id: '', name: '', code: '', teacher_id: null }
    alert('Subject added successfully!')
  } catch (error) {
    console.error(error)
    alert('Failed to add subject. Please try again.')
  } finally {
    loading.value = false
  }
}

// Open edit modal
const openEditModal = (subject: any) => {
  activeMenu.value = null
  editForm.value = {
    id: subject.id,
    class_id: subject.class_id,
    name: subject.name,
    code: subject.code,
    teacher_id: subject.teacher_id
  }
  showModal.value = true
}

// Save edit
const saveEdit = async () => {
  await subjectStore.updateSubject(editForm.value.id, editForm.value)
  showModal.value = false
}

// Delete subject
const deleteSubject = async (id: number) => {
  activeMenu.value = null
  if (confirm('Are you sure you want to delete this subject?')) {
    await subjectStore.removeSubject(id)
  }
}

onMounted(() => {
  subjectStore.fetchSubjects()
  classStore.fetchClasses()
  teacherStore.fetchTeachers()
})
</script>

<style scoped>
/* ✅ Page-specific styles */
.page-header { margin-bottom: 25px; }
.page-header h1 { margin: 0 0 8px 0; color: #1e293b; font-size: 24px; display: flex; align-items: center; gap: 12px; }
.page-header h1 i { color: #3498db; }
.page-header p { margin: 0; color: #64748b; font-size: 14px; }

/* ✅ Grid Layout */
.layout-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 25px; margin-top: 20px; }

/* ✅ Form Card */
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

/* ✅ Table Card */
.table-card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,0.06); overflow: hidden; }
.table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.table-header h3 { margin: 0; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px; }
.table-header h3 i { color: #3498db; }
.badge-count { background: #e0f2fe; color: #0284c7; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: 600; }

.table-responsive { overflow-x: auto; width: 100%; padding-bottom: 10px; }
.data-table { width: 100%; border-collapse: collapse; table-layout: fixed; min-width: 700px; }
.data-table th { background: #f8fafc; color: #64748b; padding: 15px; text-align: left; font-size: 13px; text-transform: uppercase; font-weight: 700; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
.data-table td { padding: 15px; border-bottom: 1px solid #f1f5f9; color: #334155; font-size: 14px; vertical-align: middle; }
.data-table tr:hover { background: #f8fafc; }

.id-badge { background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 13px; }

/* ✅ Subject Info & Code Badge */
.subject-info { display: flex; align-items: center; gap: 12px; }
.icon-box { width: 38px; height: 38px; background: #e0f2fe; color: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
.subject-details { display: flex; flex-direction: column; gap: 4px; }
.subject-name { font-weight: 600; color: #1e293b; font-size: 14px; }
.code-badge { 
  background: #f3e8ff; 
  color: #9333ea; 
  padding: 3px 8px; 
  border-radius: 4px; 
  font-size: 11px; 
  font-weight: 600; 
  display: inline-flex;
  align-items: center;
  gap: 4px;
  white-space: nowrap; 
  letter-spacing: 0.5px;
}
.code-badge i { font-size: 10px; }

.teacher-name { display: flex; align-items: center; gap: 6px; color: #334155; font-weight: 500; }
.teacher-name i { color: #3498db; }
.text-muted { color: #94a3b8; font-style: italic; font-size: 13px; }

/* ✅ Actions Column */
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

/* ✅ Modal */
.modal-overlay { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); display: flex; justify-content: center; align-items: center; z-index: 9999; }
.modal-content { background: white; padding: 30px; border-radius: 16px; width: 450px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); }
.modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.modal-header h3 { margin: 0; color: #1e293b; font-size: 20px; display: flex; align-items: center; gap: 10px; }
.btn-close { background: transparent; border: none; font-size: 20px; color: #94a3b8; cursor: pointer; }
.btn-close:hover { color: #ef4444; }
.form-input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 14px; background: white; }
.form-input:focus { border-color: #3498db; box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1); }
.modal-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 25px; }
.btn-cancel { padding: 10px 20px; background: #f1f5f9; color: #475569; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; }
.btn-cancel:hover { background: #e2e8f0; }
.btn-save { padding: 10px 20px; background: #2ecc71; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; }
.btn-save:hover { background: #27ae60; transform: translateY(-2px); }
</style>