<template>
  <MasterLayout>
    <div class="page-header">
      <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
      <p>Welcome back, {{ authStore.user?.name || 'Admin' }}!</p>
    </div>

    <div class="quick-actions">
      <button @click="$router.push('/admin/students')"><i class="fas fa-user-plus"></i> Add Student</button>
      <button @click="$router.push('/admin/finance')"><i class="fas fa-file-invoice"></i> Create Invoice</button>
      <button @click="$router.push('/admin/teachers')"><i class="fas fa-chalkboard-teacher"></i> Add Teacher</button>
    </div>

    <div class="stats-grid">
      <StatCard title="Total Students" :value="studentStore.students.length" icon="fas fa-user-graduate" color="#3498db" />
      <StatCard title="Total Teachers" :value="teacherStore.teachers.length" icon="fas fa-chalkboard-teacher" color="#2ecc71" />
      <StatCard title="Total Subjects" :value="subjectStore.subjects.length" icon="fas fa-book" color="#9b59b6" />
      <StatCard title="Fees Collected" :value="formattedFees" icon="fas fa-money-check-alt" color="#f1c40f" />
    </div>

    <div class="charts-grid">
      <div class="chart-box">
        <BarChart title="Monthly Fee Collection" :labels="['Jan','Feb','Mar','Apr','May','Jun']" :dataValues="[15000,22000,18000,25000,30000,28000]" labelName="Fee Collected" barColor="#3498db" />
      </div>
      <div class="progress-box">
        <ProgressChart title="Attendance Rate" :percentage="85" color="#2ecc71" icon="fas fa-user-check" subtitle="85% present today" />
        <ProgressChart title="Fee Target" :percentage="60" color="#f39c12" icon="fas fa-bullseye" subtitle="60% collected" />
      </div>
      <div class="pie-box">
        <PieChart title="Fee Collection Status" :labels="['Paid','Partial','Unpaid']" :dataValues="[60,25,15]" :colors="['#2ecc71','#f39c12','#e74c3c']" />
      </div>
    </div>

    <RecentActivityTable />
  </MasterLayout>
</template>

<script setup lang="ts">
import { onMounted, computed } from 'vue'
import MasterLayout from '../../components/layouts/MasterLayout.vue'
import StatCard from '../../components/cards/StatCard.vue'
import BarChart from '../../components/charts/BarChart.vue'
import ProgressChart from '../../components/charts/ProgressChart.vue'
import PieChart from '../../components/charts/PieChart.vue'
import RecentActivityTable from '../../components/tables/RecentActivityTable.vue'
import { useAuthStore } from '../../stores/auth'
import { useStudentStore } from '../../stores/studentStore'
import { useTeacherStore } from '../../stores/teacherStore'
import { useFinanceStore } from '../../stores/financeStore'
import { useSubjectStore } from '../../stores/subjectStore'

const authStore = useAuthStore()
const studentStore = useStudentStore()
const teacherStore = useTeacherStore()
const financeStore = useFinanceStore()
const subjectStore = useSubjectStore()

const formattedFees = computed(() => (financeStore.totalIncome || 0).toLocaleString() + ' ETB')

onMounted(async () => {
  await Promise.all([
    studentStore.fetchStudents(),
    teacherStore.fetchTeachers(),
    financeStore.fetchSummary(),
    subjectStore.fetchSubjects()
  ])
})
</script>

<style scoped>
.page-header { margin-bottom: 25px; }
.page-header h1 { margin: 0 0 8px 0; color: #1e293b; font-size: 26px; display: flex; align-items: center; gap: 12px; }
.page-header h1 i { color: #3498db; }
.page-header p { margin: 0; color: #64748b; font-size: 14px; }

.quick-actions { display: flex; gap: 15px; margin: 20px 0; flex-wrap: wrap; }
.quick-actions button { padding: 12px 24px; background: #3498db; color: white; border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 10px rgba(52,152,219,0.2); transition: 0.3s; }
.quick-actions button:hover { background: #2980b9; transform: translateY(-2px); }

.stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 20px; }

.charts-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-top: 30px; align-items: stretch; }
.chart-box, .progress-box, .pie-box { display: flex; flex-direction: column; gap: 15px; background: white; padding: 20px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
.pie-box { grid-column: 1 / -1; }

@media (max-width: 1024px) { .charts-grid { grid-template-columns: 1fr; } }
</style>