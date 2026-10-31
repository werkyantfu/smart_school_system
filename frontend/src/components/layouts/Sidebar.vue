<template>
  <aside class="sidebar">
    <!-- 1. MAIN SECTION -->
    <div class="menu-section">
      <span class="section-title">Main</span>
      <ul>
        <li>
          <router-link to="/admin/dashboard">
            <i class="fas fa-home"></i> Dashboard
          </router-link>
        </li>
      </ul>
    </div>

    <!-- 2. ACADEMIC SECTION -->
    <div class="menu-section">
      <span class="section-title">Academic</span>
      <ul>
        <li>
          <router-link to="/admin/students">
            <i class="fas fa-user-graduate"></i> Students
          </router-link>
        </li>
        <li>
          <router-link to="/admin/teachers">
            <i class="fas fa-chalkboard-teacher"></i> Teachers
          </router-link>
        </li>
        <li>
          <router-link to="/admin/classes">
            <i class="fas fa-chalkboard"></i> Classes
          </router-link>
        </li>
        <li>
          <router-link to="/admin/subjects">
            <i class="fas fa-book"></i> Subjects
          </router-link>
        </li>
      </ul>
    </div>

    <!-- 3. FINANCE SECTION -->
    <div class="menu-section">
      <span class="section-title">Finance</span>
      <ul>
        <li>
          <router-link to="/admin/finance">
            <i class="fas fa-wallet"></i> Finance
          </router-link>
        </li>
        <li>
          <router-link to="/admin/reports">
            <i class="fas fa-chart-pie"></i> Reports
          </router-link>
        </li>
      </ul>
    </div>

    <!-- 4. SETTINGS SECTION -->
    <div class="menu-section">
      <span class="section-title">Settings</span>
      <ul>
        <li>
          <router-link to="/admin/settings">
            <i class="fas fa-cog"></i> School Settings
          </router-link>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script setup lang="ts">
// No script logic needed for the Sidebar
</script>

<style scoped>
/* ✅ Sidebar Container */
.sidebar {
  width: 260px; 
  min-width: 260px;
  background-color: #1e293b; /* Dark Slate */
  color: white;
  height: 100%; 
  padding: 20px 10px;
  box-shadow: 2px 0 5px rgba(0,0,0,0.1);
  overflow-y: auto;
}

/* ✅ Section Styling */
.menu-section {
  margin-bottom: 25px;
}

.section-title {
  display: block;
  font-size: 11px;
  font-weight: 700;
  color: #64748b; /* Muted Gray */
  text-transform: uppercase;
  letter-spacing: 1px;
  padding-left: 20px;
  margin-bottom: 8px;
}

/* ✅ List & Links */
ul { 
  list-style: none; 
  padding: 0; 
  margin: 0; 
  display: flex; 
  flex-direction: column; 
  gap: 4px; 
}

li a {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 12px 20px;
  color: #94a3b8; /* Light Gray */
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  border-radius: 8px; 
  transition: all 0.3s ease;
}

li a:hover {
  background-color: #334155;
  color: #ffffff;
  transform: translateX(5px); /* Slight slide effect */
}

/* ✅ Active Route Styling */
li a.router-link-active {
  background-color: #3498db; /* Primary Blue */
  color: #ffffff;
  box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
}

/* ✅ Icon Styling */
li a i { 
  width: 20px; 
  text-align: center; 
  font-size: 16px; 
}
</style>