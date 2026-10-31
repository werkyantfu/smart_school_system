<template>
  <div class="pagination-container">
    <button 
      :disabled="currentPage === 1" 
      @click="$emit('page-change', currentPage - 1)"
      class="page-btn"
    >
      <i class="fas fa-chevron-left"></i> Prev
    </button>

    <span class="page-info">
      Page {{ currentPage }} of {{ totalPages }}
    </span>

    <button 
      :disabled="currentPage === totalPages" 
      @click="$emit('page-change', currentPage + 1)"
      class="page-btn"
    >
      Next <i class="fas fa-chevron-right"></i>
    </button>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  currentPage: number
  totalPages: number
}>()

defineEmits(['page-change'])
</script>

<style scoped>
.pagination-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 15px;
  padding: 20px;
}
.page-btn {
  padding: 8px 15px;
  background: #3498db;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
}
.page-btn:disabled {
  background: #bdc3c7;
  cursor: not-allowed;
}
.page-info {
  font-size: 14px;
  color: #2c3e50;
  font-weight: bold;
}
</style>