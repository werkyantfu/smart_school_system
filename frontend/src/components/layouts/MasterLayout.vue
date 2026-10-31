<template>
  <div class="master-layout">
    <!-- ✅ 1. NAVBAR -->
    <nav class="navbar">
      <div class="logo" @click="goToDashboard">
        <i class="fas fa-school"></i> Smart SMS
      </div>
      
      <div class="search-bar">
        <i class="fas fa-search"></i>
        <input 
          v-model="searchQuery" 
          @keyup.enter="performSearch" 
          type="text" 
          placeholder="Search students, teachers..." 
        />
      </div>

      <div class="user-info">
        <!-- Notifications Dropdown -->
        <div class="notification-wrapper" @click.stop="toggleNotifications">
          <div class="notification-icon">
            <i class="fas fa-bell"></i>
            <span v-if="notifications.length > 0" class="badge">{{ notifications.length }}</span>
          </div>
          
          <div v-if="showNotifications" class="dropdown-menu">
            <div class="dropdown-header">
              <span>Notifications</span>
              <span class="mark-read" @click.stop="markAllRead">Mark all as read</span>
            </div>
            <ul>
              <li v-for="(notif, index) in notifications" :key="index">
                <div class="notif-icon" :class="notif.type">
                  <i :class="notif.icon"></i>
                </div>
                <div class="notif-content">
                  <p>{{ notif.message }}</p>
                  <span>{{ notif.time }}</span>
                </div>
              </li>
              <li v-if="notifications.length === 0" class="empty-state">
                <i class="fas fa-check-circle"></i> No new notifications
              </li>
            </ul>
          </div>
        </div>
        
        <!-- User Profile -->
        <div class="profile">
          <div class="avatar"><i class="fas fa-user-tie"></i></div>
          <div class="user-details">
            <span class="user-name">{{ userName }}</span>
            <span class="user-role">{{ userRole }}</span>
          </div>
        </div>
        
        <!-- Logout -->
        <button @click="logout" class="logout-btn" title="Logout">
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </div>
    </nav>

    <div class="layout-body">
      <!-- ✅ 2. DYNAMIC SIDEBAR -->
      <aside class="sidebar">
        <!-- ADMIN MENU -->
        <div v-if="userRole === 'Admin'" class="menu-section">
          <span class="section-title">Main</span>
          <ul>
            <li><router-link to="/admin/dashboard"><i class="fas fa-home"></i> Dashboard</router-link></li>
          </ul>
          <span class="section-title">Academic</span>
          <ul>
            <li><router-link to="/admin/students"><i class="fas fa-user-graduate"></i> Students</router-link></li>
            <li><router-link to="/admin/teachers"><i class="fas fa-chalkboard-teacher"></i> Teachers</router-link></li>
            <li><router-link to="/admin/classes"><i class="fas fa-chalkboard"></i> Classes</router-link></li>
            <li><router-link to="/admin/subjects"><i class="fas fa-book"></i> Subjects</router-link></li>
          </ul>
          <span class="section-title">Finance</span>
          <ul>
            <li><router-link to="/admin/finance"><i class="fas fa-wallet"></i> Finance</router-link></li>
            <li><router-link to="/admin/reports"><i class="fas fa-chart-pie"></i> Reports</router-link></li>
          </ul>
          <span class="section-title">Settings</span>
          <ul>
            <li><router-link to="/admin/settings"><i class="fas fa-cog"></i> School Settings</router-link></li>
          </ul>
        </div>

        <!-- TEACHER MENU -->
        <div v-else-if="userRole === 'Teacher'" class="menu-section">
          <span class="section-title">Teacher Menu</span>
          <ul>
            <li><router-link to="/teacher/dashboard"><i class="fas fa-home"></i> Dashboard</router-link></li>
            <li><router-link to="/teacher/marks"><i class="fas fa-pen"></i> Marks</router-link></li>
            <li><router-link to="/teacher/attendance"><i class="fas fa-user-check"></i> Attendance</router-link></li>
          </ul>
        </div>

        <!-- PARENT MENU -->
        <div v-else-if="userRole === 'Parent'" class="menu-section">
          <span class="section-title">Parent Menu</span>
          <ul>
            <li><router-link to="/parent/dashboard"><i class="fas fa-home"></i> Dashboard</router-link></li>
            <li><router-link to="/parent/grades"><i class="fas fa-graduation-cap"></i> Grades</router-link></li>
            <li><router-link to="/parent/fees"><i class="fas fa-wallet"></i> Fees</router-link></li>
          </ul>
        </div>

        <!-- STUDENT MENU -->
        <div v-else-if="userRole === 'Student'" class="menu-section">
          <span class="section-title">Student Menu</span>
          <ul>
            <li><router-link to="/student/dashboard"><i class="fas fa-home"></i> Dashboard</router-link></li>
            <li><router-link to="/student/grades"><i class="fas fa-graduation-cap"></i> Grades</router-link></li>
            <li><router-link to="/student/schedule"><i class="fas fa-calendar-alt"></i> Schedule</router-link></li>
          </ul>
        </div>
      </aside>

      <!-- ✅ 3. MAIN CONTENT -->
      <main class="main-content">
        <div class="content-scroll">
          <slot />
        </div>
      </main>
    </div>

    <!-- ✅ 4. FOOTER -->
    <footer class="footer">
      <p>© {{ currentYear }} <strong>Smart SMS</strong>. All rights reserved.</p>
      <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#">Support</a>
      </div>
    </footer>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const searchQuery = ref('')

// User Data
const user = JSON.parse(localStorage.getItem('user') || '{}')
const userName = computed(() => user.name || 'Guest')
const userRole = computed(() => {
  const role = user.role || 'guest'
  return role.charAt(0).toUpperCase() + role.slice(1)
})
const currentYear = computed(() => new Date().getFullYear())

// Notifications
const showNotifications = ref(false)
const notifications = ref([
  { message: 'New student registered.', time: '10 min ago', icon: 'fas fa-user-plus', type: 'blue' },
  { message: 'Payment received.', time: '25 min ago', icon: 'fas fa-money-bill-wave', type: 'green' },
])

const toggleNotifications = () => { showNotifications.value = !showNotifications.value }
const markAllRead = () => { notifications.value = []; showNotifications.value = false }

// Close Dropdown on Outside Click
const closeDropdowns = () => { showNotifications.value = false }
onMounted(() => document.addEventListener('click', closeDropdowns))
onUnmounted(() => document.removeEventListener('click', closeDropdowns))

// Search
const performSearch = () => {
  if (searchQuery.value.trim()) alert(`Searching for: ${searchQuery.value}`)
}

// Navigation
const goToDashboard = () => {
  if (userRole.value === 'Admin') router.push('/admin/dashboard')
  else if (userRole.value === 'Teacher') router.push('/teacher/dashboard')
  else if (userRole.value === 'Parent') router.push('/parent/dashboard')
  else if (userRole.value === 'Student') router.push('/student/dashboard')
  else router.push('/')
}

const logout = () => {
  localStorage.removeItem('token')
  localStorage.removeItem('user')
  router.push('/')
}
</script>

<style scoped>
/* Global Layout */
.master-layout { display: flex; flex-direction: column; height: 100vh; background: #f8fafc; overflow: hidden; }
.layout-body { display: flex; flex: 1; overflow: hidden; }

/* Navbar */
.navbar { display: flex; justify-content: space-between; align-items: center; padding: 0 30px; background: #ffffff; height: 70px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); z-index: 1000; }
.logo { font-size: 22px; font-weight: 800; color: #1e293b; display: flex; align-items: center; gap: 10px; cursor: pointer; }
.logo i { color: #3498db; }
.search-bar { display: flex; align-items: center; background: #f1f5f9; padding: 10px 20px; border-radius: 30px; gap: 10px; width: 350px; }
.search-bar input { background: transparent; border: none; outline: none; width: 100%; }
.user-info { display: flex; align-items: center; gap: 20px; }
.notification-wrapper { position: relative; cursor: pointer; }
.notification-icon { font-size: 22px; color: #64748b; position: relative; }
.notification-icon .badge { position: absolute; top: -5px; right: -8px; background: #ef4444; color: white; font-size: 11px; padding: 2px 6px; border-radius: 50%; font-weight: bold; }
.profile { display: flex; align-items: center; gap: 10px; padding-left: 20px; border-left: 1px solid #e2e8f0; }
.avatar { width: 40px; height: 40px; background: #e0f2fe; color: #3498db; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; }
.user-details { display: flex; flex-direction: column; }
.user-name { font-weight: 600; font-size: 14px; }
.user-role { font-size: 12px; color: #64748b; }
.logout-btn { background: #fee2e2; color: #ef4444; border: none; width: 40px; height: 40px; border-radius: 8px; cursor: pointer; }

/* Notification Dropdown */
.dropdown-menu { position: absolute; top: 40px; right: 0; background: white; width: 320px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border-radius: 12px; z-index: 100; overflow: hidden; border: 1px solid #e2e8f0; }
.dropdown-header { padding: 15px; background: #f8fafc; font-weight: 700; color: #1e293b; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
.mark-read { font-size: 12px; color: #3498db; cursor: pointer; font-weight: 600; }
.dropdown-menu ul { list-style: none; padding: 0; margin: 0; }
.dropdown-menu li { padding: 15px; border-bottom: 1px solid #f1f5f9; display: flex; gap: 15px; align-items: flex-start; }
.notif-icon { width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; flex-shrink: 0; }
.notif-icon.blue { background: #e0f2fe; color: #0284c7; }
.notif-icon.green { background: #dcfce7; color: #16a34a; }
.notif-content p { margin: 0; font-size: 14px; color: #334155; font-weight: 500; }
.notif-content span { font-size: 12px; color: #94a3b8; margin-top: 5px; display: block; }
.empty-state { justify-content: center; color: #94a3b8; font-size: 14px; padding: 30px !important; }

/* Sidebar */
.sidebar { width: 260px; min-width: 260px; background: #1e293b; color: white; padding: 20px 10px; overflow-y: auto; }
.menu-section { margin-bottom: 25px; }
.section-title { display: block; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; padding-left: 20px; margin-bottom: 8px; letter-spacing: 1px; }
.sidebar ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px; }
.sidebar li a { display: flex; align-items: center; gap: 15px; padding: 12px 20px; color: #94a3b8; text-decoration: none; font-size: 14px; font-weight: 500; border-radius: 8px; transition: 0.3s; }
.sidebar li a:hover, .sidebar li a.router-link-active { background: #3498db; color: white; transform: translateX(5px); }
.sidebar li a i { width: 20px; text-align: center; font-size: 16px; }

/* Main Content */
.main-content { flex: 1; overflow: hidden; display: flex; flex-direction: column; }
.content-scroll { flex: 1; padding: 30px; overflow-y: auto; }

/* Footer */
.footer { background: #ffffff; padding: 15px 30px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #64748b; flex-shrink: 0; }
.footer strong { color: #1e293b; }
.footer-links { display: flex; gap: 20px; }
.footer-links a { text-decoration: none; color: #64748b; }
.footer-links a:hover { color: #3498db; }

/* Responsive */
@media (max-width: 768px) {
  .layout-body { flex-direction: column; }
  .sidebar { width: 100%; min-width: 100%; }
  .main-content { width: 100%; }
  .content-scroll { padding: 15px; }
  .search-bar { width: 200px; }
  .user-details { display: none; }
}
</style>