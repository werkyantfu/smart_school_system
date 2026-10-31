<template>
  <div v-if="visible" class="dialog-overlay">
    <div class="dialog-box">
      <h3><i class="fas fa-exclamation-triangle" style="color: #e74c3c;"></i> {{ title }}</h3>
      <p>{{ message }}</p>
      <div class="dialog-actions">
        <button @click="onCancel" class="btn-cancel">Cancel</button>
        <button @click="onConfirm" class="btn-confirm">Confirm</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  visible: boolean
  title: string
  message: string
}>()

const emit = defineEmits(['confirm', 'cancel'])
const onConfirm = () => emit('confirm')
const onCancel = () => emit('cancel')
</script>

<style scoped>
.dialog-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center; z-index: 1000; }
.dialog-box { background: white; padding: 20px; border-radius: 8px; width: 300px; text-align: center; }
.dialog-actions { display: flex; justify-content: space-between; margin-top: 20px; }
.btn-cancel { padding: 8px 15px; background: #ccc; border: none; border-radius: 5px; cursor: pointer; }
.btn-confirm { padding: 8px 15px; background: #e74c3c; color: white; border: none; border-radius: 5px; cursor: pointer; }
</style>