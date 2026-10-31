<template>
  <div v-if="message" :class="['alert', type]">
    <p><i :class="iconClass"></i> {{ message }}</p>
    <button @click="$emit('close')">×</button>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const props = defineProps<{
  message: string
  type: 'success' | 'error' | 'info' | 'warning'
}>()

defineEmits(['close'])

const iconClass = computed(() => {
  if (props.type === 'success') return 'fas fa-check-circle'
  if (props.type === 'error') return 'fas fa-exclamation-circle'
  if (props.type === 'warning') return 'fas fa-exclamation-triangle'
  return 'fas fa-info-circle'
})
</script>

<style scoped>
.alert { padding: 15px; margin: 10px 0; border-radius: 5px; display: flex; justify-content: space-between; align-items: center; }
.alert p { margin: 0; display: flex; align-items: center; gap: 10px; }
.alert button { background: none; border: none; font-size: 20px; cursor: pointer; }
.success { background-color: #d4edda; color: #155724; }
.error { background-color: #f8d7da; color: #721c24; }
.info { background-color: #d1ecf1; color: #0c5460; }
.warning { background-color: #fff3cd; color: #856404; }
</style>