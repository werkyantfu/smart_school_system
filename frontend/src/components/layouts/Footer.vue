<template>
  <footer class="main-footer">
    <div class="footer-content">
      
      <!-- ✅ Left Side: Copyright -->
      <div class="footer-left">
        <p>&copy; {{ currentYear }} <strong>Smart SMS</strong>. All rights reserved.</p>
      </div>

      <!-- ✅ Center: Quick Links -->
      <div class="footer-center">
        <a href="#">Privacy Policy</a>
        <span class="divider">|</span>
        <a href="#">Terms of Service</a>
        <span class="divider">|</span>
        <a href="#">Help Center</a>
      </div>

      <!-- ✅ Right Side: Version & Developer -->
      <div class="footer-right">
        <span class="version">v1.0.0</span>
        <span class="developer">Developed by <strong>Werkyantfu</strong></span>
      </div>

    </div>
  </footer>
</template>

<script setup lang="ts">
import { computed } from 'vue'
const currentYear = computed(() => new Date().getFullYear())
</script>

<style scoped>
/* ✅ Main Footer Container */
.main-footer {
  background-color: #ffffff;
  border-top: 1px solid #e2e8f0;
  padding: 15px 30px; /* ✅ Standard Height (Approx 60px) */
  margin-top: auto; /* Pushes to the bottom */
  width: 100%;
  box-shadow: 0 -2px 10px rgba(0,0,0,0.02);
}

/* ✅ Flexbox Layout */
.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1400px;
  margin: 0 auto;
  flex-wrap: wrap;
  gap: 15px;
}

/* ✅ Text Styling */
.footer-left p {
  margin: 0;
  font-size: 13px;
  color: #64748b; /* Gray */
}
.footer-left strong { color: #1e293b; }

/* ✅ Center Links */
.footer-center {
  display: flex;
  align-items: center;
  gap: 10px;
}

.footer-center a {
  text-decoration: none;
  font-size: 13px;
  color: #64748b;
  font-weight: 500;
  transition: 0.2s;
}
.footer-center a:hover { color: #3498db; }

.divider {
  color: #cbd5e1;
  font-size: 12px;
}

/* ✅ Right Side (Version & Developer) */
.footer-right {
  display: flex;
  align-items: center;
  gap: 15px;
}

.version {
  font-size: 11px;
  font-weight: 600;
  background: #f1f5f9;
  color: #475569;
  padding: 4px 8px;
  border-radius: 4px;
}

.developer {
  font-size: 13px;
  color: #64748b;
}
.developer strong { color: #3498db; }

/* ✅ Responsive Design */
@media (max-width: 768px) {
  .footer-content {
    flex-direction: column;
    text-align: center;
  }
  
  .footer-center {
    flex-wrap: wrap;
    justify-content: center;
  }
}
</style>