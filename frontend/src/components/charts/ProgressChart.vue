<template>
  <div class="progress-container">
    <div class="progress-header">
      <h3><i :class="icon" :style="{ color: color }"></i> {{ title }}</h3>
      <span class="progress-value">{{ percentage }}%</span>
    </div>
    
    <div class="progress-bar-bg">
      <div 
        class="progress-bar-fill" 
        :style="{ width: percentage + '%', backgroundColor: color }"
      ></div>
    </div>

    <p v-if="subtitle" class="progress-subtitle">{{ subtitle }}</p>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  title: string
  percentage: number
  color?: string
  icon?: string
  subtitle?: string
}>()
</script>

<style scoped>
.progress-container {
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  margin-bottom: 15px;
}

.progress-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.progress-header h3 {
  margin: 0;
  font-size: 15px;
  color: #2c3e50;
  display: flex;
  align-items: center;
  gap: 8px;
}

.progress-value {
  font-weight: bold;
  font-size: 18px;
  color: #2c3e50;
}

.progress-bar-bg {
  width: 100%;
  height: 12px;
  background-color: #ecf0f1;
  border-radius: 10px;
  overflow: hidden;
}

.progress-bar-fill {
  height: 100%;
  border-radius: 10px;
  transition: width 0.8s ease-in-out;
}

.progress-subtitle {
  margin: 10px 0 0 0;
  font-size: 12px;
  color: #7f8c8d;
}
</style>