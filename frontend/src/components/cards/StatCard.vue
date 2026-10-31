<template>
  <div class="stat-card" :style="{ borderLeftColor: color }">
    <div class="icon-box" :style="{ backgroundColor: color + '20', color: color }">
      <i :class="icon"></i>
    </div>
    <div class="info-box">
      <h3>{{ title }}</h3>
      <p class="value">{{ value }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  title: string
  value: string | number
  icon: string
  color: string
}>()
</script>

<style scoped>
.stat-card {
  display: flex;
  align-items: center;
  gap: 15px;
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  border-left: 5px solid #ccc;
  transition: transform 0.2s;
}
.stat-card:hover { transform: translateY(-3px); }
.icon-box {
  width: 50px;
  height: 50px;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 24px;
}
.info-box h3 { margin: 0; font-size: 14px; color: #7f8c8d; font-weight: normal; }
.value { margin: 5px 0 0 0; font-size: 24px; font-weight: bold; color: #2c3e50; }
</style>