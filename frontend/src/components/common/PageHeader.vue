<template>
  <div class="page-header">
    <div class="header-left">
      <h1><i :class="icon"></i> {{ title }}</h1>
      <p v-if="subtitle">{{ subtitle }}</p>
    </div>
    <div class="header-right">
      <slot name="actions"></slot>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  title: string
  subtitle?: string
  icon?: string
}>()
</script>

<style scoped>
.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  background: white;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  margin-bottom: 20px;
}
.header-left h1 {
  margin: 0;
  font-size: 24px;
  color: #2c3e50;
  display: flex;
  align-items: center;
  gap: 10px;
}
.header-left p {
  margin: 5px 0 0;
  color: #7f8c8d;
  font-size: 14px;
}
.header-right {
  display: flex;
  gap: 10px;
}
</style>