<template>
  <nav class="navbar">
    <!-- ✅ Logo -->
    <div class="logo" @click="$router.push('/admin/dashboard')">
      <i class="fas fa-school"></i> Smart SMS
    </div>
    
    <!-- ✅ Search Bar -->
    <div class="search-bar">
      <i class="fas fa-search"></i>
      <input 
        v-model="searchQuery" 
        @keyup.enter="handleSearch" 
        type="text" 
        placeholder="Search students, teachers, classes..." 
      />
    </div>

    <div class="user-info">
      <!-- ✅ Notifications Dropdown -->
      <div class="notification-wrapper" @click.stop="toggleNotifications">
        <div class="notification-icon">
          <i class="fas fa-bell"></i>
          <span v-if="notifications.length > 0" class="badge">{{ notifications.length }}</span>
        </div>
        
        <!-- Dropdown Menu -->
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
      
      <!-- ✅ User Profile -->
      <div class="profile">
        <div class="avatar">
          <i class="fas fa-user-tie"></i>
        </div>
        <div class="user-details">
          <span class="user-name">{{ userName }}</span>
          <span class="user-role">{{ userRole }}</span>
        </div>
      </div>
      
      <!-- ✅ Logout Button -->
      <button @click="logout" class="logout-btn" title="Logout">
        <i class="fas fa-sign-out-alt"></i>
      </button>
    </div>
  </nav>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

// ✅ User Data
const user = JSON.parse(localStorage.getItem('user') || '{}')
const userName = computed(() => user.name || 'Guest')
const userRole = computed(() => user.role ? user.role.charAt(0).toUpperCase() + user.role.slice(1) : 'User')

// ✅ Search Functionality
const searchQuery = ref('')
const handleSearch = () => {
  if (searchQuery.value.trim()) {
    // In a real app, you would route to a search results page or call an API
    console.log('Searching for:', searchQuery.value)
    alert(`Searching for: ${searchQuery.value}`) 
    // router.push(`/admin/search?q=${searchQuery.value}`)
  }
}

// ✅ Notifications Logic
const showNotifications = ref(false)
const notifications = ref([
  { message: 'New student "Dawit" registered.', time: '10 min ago', icon: 'fas fa-user-plus', type: 'blue' },
  { message: 'Payment of 5,000 ETB received.', time: '25 min ago', icon: 'fas fa-money-bill-wave', type: 'green' },
  { message: 'Grade 10 Math marks updated.', time: '1 hour ago', icon: 'fas fa-pen', type: 'orange' },
])

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
}

const markAllRead = () => {
  notifications.value = []
  showNotifications.value = false
}

// ✅ Close Dropdown on Outside Click
const closeDropdowns = () => {
  showNotifications.value = false
}
onMounted(() => document.addEventListener('click', closeDropdowns))
onUnmounted(() => document.removeEventListener('click', closeDropdowns))

// ✅ Logout
const logout = (): void => {
  localStorage.removeItem('token')
  localStorage.removeItem('user')
  router.push('/')
}
</script>

<style scoped>
/* ✅ Main Navbar Container */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 30px;
  background-color: #ffffff;
  color: #1e293b;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  position: sticky;
  top: 0;
  z-index: 1000;
  height: 70px;
}

/* ✅ Logo */
.logo {
  font-size: 22px;
  font-weight: 800;
  color: #1e293b;
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
}
.logo i { color: #3498db; }

/* ✅ Search Bar */
.search-bar {
  display: flex;
  align-items: center;
  background: #f1f5f9;
  padding: 10px 20px;
  border-radius: 30px;
  gap: 10px;
  width: 400px;
  transition: 0.3s;
}
.search-bar:focus-within {
  background: #ffffff;
  box-shadow: 0 0 0 2px #3498db;
}
.search-bar i { color: #94a3b8; }
.search-bar input {
  background: transparent;
  border: none;
  outline: none;
  width: 100%;
  color: #1e293b;
  font-size: 14px;
}

/* ✅ User Info Area */
.user-info {
  display: flex;
  align-items: center;
  gap: 25px;
}

/* ✅ Notifications */
.notification-wrapper { position: relative; cursor: pointer; }
.notification-icon { font-size: 22px; color: #64748b; position: relative; }
.notification-icon:hover { color: #3498db; }
.notification-icon .badge {
  position: absolute;
  top: -5px;
  right: -8px;
  background: #ef4444;
  color: white;
  font-size: 11px;
  padding: 2px 6px;
  border-radius: 50%;
  font-weight: bold;
  border: 2px solid white;
}

/* ✅ Notifications Dropdown */
.dropdown-menu {
  position: absolute;
  top: 45px;
  right: -50px;
  background: white;
  width: 320px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  border-radius: 12px;
  z-index: 100;
  overflow: hidden;
  border: 1px solid #e2e8f0;
  animation: fadeIn 0.2s ease-in-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

.dropdown-header {
  padding: 15px;
  background: #f8fafc;
  font-weight: 700;
  color: #1e293b;
  border-bottom: 1px solid #e2e8f0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.mark-read { font-size: 12px; color: #3498db; cursor: pointer; font-weight: 600; }
.mark-read:hover { text-decoration: underline; }

.dropdown-menu ul { list-style: none; padding: 0; margin: 0; }
.dropdown-menu li {
  padding: 15px;
  border-bottom: 1px solid #f1f5f9;
  display: flex;
  gap: 15px;
  align-items: flex-start;
  transition: 0.2s;
}
.dropdown-menu li:hover { background: #f8fafc; }

.notif-icon {
  width: 35px; height: 35px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center; font-size: 14px;
}
.notif-icon.blue { background: #e0f2fe; color: #0284c7; }
.notif-icon.green { background: #dcfce7; color: #16a34a; }
.notif-icon.orange { background: #ffedd5; color: #ea580c; }

.notif-content p { margin: 0; font-size: 14px; color: #334155; font-weight: 500; }
.notif-content span { font-size: 12px; color: #94a3b8; margin-top: 5px; display: block; }

.empty-state {
  justify-content: center;
  color: #94a3b8;
  font-size: 14px;
  padding: 30px !important;
}
.empty-state i { margin-right: 8px; color: #2ecc71; }

/* ✅ Profile Area */
.profile {
  display: flex;
  align-items: center;
  gap: 12px;
  border-left: 1px solid #e2e8f0;
  padding-left: 20px;
}
.avatar {
  width: 40px; height: 40px; background: #e0f2fe; color: #3498db;
  border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px;
}
.user-details { display: flex; flex-direction: column; }
.user-name { font-weight: 600; color: #1e293b; font-size: 14px; }
.user-role { font-size: 12px; color: #64748b; }

/* ✅ Logout Button */
.logout-btn {
  background: #fee2e2; color: #ef4444; border: none; width: 40px; height: 40px;
  border-radius: 8px; cursor: pointer; font-size: 18px;
  display: flex; align-items: center; justify-content: center; transition: 0.3s;
}
.logout-btn:hover { background: #ef4444; color: white; transform: translateY(-2px); }
</style>