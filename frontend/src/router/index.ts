import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router'

// 1. Import Login Page
import Login from '../views/auth/Login.vue'
// 2. Admin Views
import AdminDashboard from '../views/admin/Dashboard.vue'
import AdminStudents from '../views/admin/Students.vue'
import AdminTeachers from '../views/admin/Teachers.vue'
import AdminClasses from '../views/admin/Classes.vue'
import AdminSubjects from '../views/admin/Subjects.vue'
import AdminFinance from '../views/admin/Finance.vue'
import AdminReports from '../views/admin/Reports.vue'
import AdminSettings from '../views/admin/Settings.vue' // ✅ Added Settings

// 3. Import Registrar Views
import RegistrarDashboard from '../views/registrar/Dashboard.vue'
import RegistrarStudents from '../views/registrar/Students.vue'

// 4. Import Accountant Pages
import AccountantDashboard from '../views/accountant/Dashboard.vue'
import AccountantInvoices from '../views/accountant/Invoices.vue'
import AccountantPayments from '../views/accountant/Payments.vue'

// 5. Import Teacher Pages
import TeacherDashboard from '../views/teacher/Dashboard.vue'
import TeacherMarks from '../views/teacher/Marks.vue'
import TeacherAttendance from '../views/teacher/Attendance.vue'

// 6. Import Parent Pages
import ParentDashboard from '../views/parent/Dashboard.vue'
import ParentGrades from '../views/parent/Grades.vue'
import ParentFees from '../views/parent/Fees.vue'

// 7. Import Student Pages
import StudentDashboard from '../views/student/Dashboard.vue'
import StudentGrades from '../views/student/Grades.vue'
import StudentSchedule from '../views/student/Schedule.vue'

// 8. Import Profile Pages
import UserProfile from '../views/profile/UserProfile.vue'
import Settings from '../views/profile/Settings.vue'

// 9. Import Report Pages
import FinancialReport from '../views/reports/FinancialReport.vue'
import AcademicReport from '../views/reports/AcademicReport.vue'

const routes: Array<RouteRecordRaw> = [
  // --- Login Route ---
  { path: '/', name: 'login', component: Login },

  // ✅ Redirect /dashboard to /admin/dashboard
  { path: '/dashboard', redirect: '/admin/dashboard' },

  // --- Admin Routes (Protected) ---
  { path: '/admin/dashboard', name: 'admin-dashboard', component: AdminDashboard, meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/students', name: 'admin-students', component: AdminStudents, meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/teachers', name: 'admin-teachers', component: AdminTeachers, meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/classes', name: 'admin-classes', component: AdminClasses, meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/subjects', name: 'admin-subjects', component: AdminSubjects, meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/finance', name: 'admin-finance', component: AdminFinance, meta: { requiresAuth: true, role: 'admin' } },
  { path: '/admin/reports', name: 'admin-reports', component: AdminReports, meta: { requiresAuth: true, role: 'admin' } }, 
  { path: '/admin/settings', name: 'admin-settings', component: AdminSettings, meta: { requiresAuth: true, role: 'admin' } }, // ✅ Added Settings Route

  // --- Registrar Routes (Protected) ---
  { path: '/registrar/dashboard', name: 'registrar-dashboard', component: RegistrarDashboard, meta: { requiresAuth: true, role: 'registrar' } },
  { path: '/registrar/students', name: 'registrar-students', component: RegistrarStudents, meta: { requiresAuth: true, role: 'registrar' } },

  // --- Accountant Routes (Protected) ---
  { path: '/accountant/dashboard', name: 'accountant-dashboard', component: AccountantDashboard, meta: { requiresAuth: true, role: 'accountant' } },
  { path: '/accountant/invoices', name: 'accountant-invoices', component: AccountantInvoices, meta: { requiresAuth: true, role: 'accountant' } },
  { path: '/accountant/payments', name: 'accountant-payments', component: AccountantPayments, meta: { requiresAuth: true, role: 'accountant' } },

  // --- Teacher Routes (Protected) ---
  { path: '/teacher/dashboard', name: 'teacher-dashboard', component: TeacherDashboard, meta: { requiresAuth: true, role: 'teacher' } },
  { path: '/teacher/marks', name: 'teacher-marks', component: TeacherMarks, meta: { requiresAuth: true, role: 'teacher' } },
  { path: '/teacher/attendance', name: 'teacher-attendance', component: TeacherAttendance, meta: { requiresAuth: true, role: 'teacher' } },

  // --- Parent Routes (Protected) ---
  { path: '/parent/dashboard', name: 'parent-dashboard', component: ParentDashboard, meta: { requiresAuth: true, role: 'parent' } },
  { path: '/parent/grades', name: 'parent-grades', component: ParentGrades, meta: { requiresAuth: true, role: 'parent' } },
  { path: '/parent/fees', name: 'parent-fees', component: ParentFees, meta: { requiresAuth: true, role: 'parent' } },

  // --- Student Routes (Protected) ---
  { path: '/student/dashboard', name: 'student-dashboard', component: StudentDashboard, meta: { requiresAuth: true, role: 'student' } },
  { path: '/student/grades', name: 'student-grades', component: StudentGrades, meta: { requiresAuth: true, role: 'student' } },
  { path: '/student/schedule', name: 'student-schedule', component: StudentSchedule, meta: { requiresAuth: true, role: 'student' } },

  // --- Profile Routes (Protected - Any authenticated user) ---
  { path: '/profile', name: 'profile', component: UserProfile, meta: { requiresAuth: true } },
  { path: '/settings', name: 'settings', component: Settings, meta: { requiresAuth: true } },

  // --- Reports Routes (Protected - Admin only usually) ---
  { path: '/reports/financial', name: 'financial-report', component: FinancialReport, meta: { requiresAuth: true, role: 'admin' } },
  { path: '/reports/academic', name: 'academic-report', component: AcademicReport, meta: { requiresAuth: true, role: 'admin' } }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

// ✅ Comprehensive Security Guard
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  const user = JSON.parse(localStorage.getItem('user') || '{}')

  if (to.meta.requiresAuth && !token) {
    next({ name: 'login' })
  } else if (to.meta.role && to.meta.role !== user.role) {
    alert("Access Denied: You don't have permission to view this page.")
    if (user.role === 'admin') next({ name: 'admin-dashboard' })
    else if (user.role === 'teacher') next({ name: 'teacher-dashboard' })
    else if (user.role === 'registrar') next({ name: 'registrar-dashboard' })
    else if (user.role === 'accountant') next({ name: 'accountant-dashboard' })
    else if (user.role === 'parent') next({ name: 'parent-dashboard' })
    else if (user.role === 'student') next({ name: 'student-dashboard' })
    else next({ name: 'login' })
  } else if (to.name === 'login' && token) {
    if (user.role === 'admin') next({ name: 'admin-dashboard' })
    else if (user.role === 'teacher') next({ name: 'teacher-dashboard' })
    else if (user.role === 'registrar') next({ name: 'registrar-dashboard' })
    else if (user.role === 'accountant') next({ name: 'accountant-dashboard' })
    else if (user.role === 'parent') next({ name: 'parent-dashboard' })
    else if (user.role === 'student') next({ name: 'student-dashboard' })
    else next()
  } else {
    next()
  }
})

export default router