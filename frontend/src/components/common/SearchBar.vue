<template>
  <div class="search-bar">
    <i class="fas fa-search search-icon"></i>
    <input 
      type="text" 
      :value="modelValue"
      @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
      :placeholder="placeholder || 'Search...'"
    />
    <button v-if="modelValue" @click="$emit('update:modelValue', '')" class="clear-btn">
      <i class="fas fa-times"></i>
    </button>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  modelValue: string
  placeholder?: string
}>()

defineEmits(['update:modelValue'])
</script>

<style scoped>
.search-bar {
  display: flex;
  align-items: center;
  background: white;
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 8px 15px;
  width: 300px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}
.search-icon {
  color: #7f8c8d;
  margin-right: 10px;
}
input {
  border: none;
  outline: none;
  flex: 1;
  font-size: 14px;
  color: #2c3e50;
}
.clear-btn {
  background: none;
  border: none;
  color: #e74c3c;
  cursor: pointer;
  padding: 0 5px;
}
</style>