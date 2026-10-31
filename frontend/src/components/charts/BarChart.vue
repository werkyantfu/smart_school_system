<template>
  <div class="chart-container">
    <h3 v-if="title">{{ title }}</h3>
    <div class="chart-wrapper">
      <Bar :data="chartData" :options="chartOptions" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps<{
  title?: string
  labels: string[]
  dataValues: number[]
  labelName?: string
  barColor?: string
}>()

const chartData = computed(() => ({
  labels: props.labels,
  datasets: [{
    label: props.labelName || 'Data',
    backgroundColor: props.barColor || '#3498db',
    borderRadius: 6,
    data: props.dataValues
  }]
}))

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: { legend: { display: false } },
  scales: { y: { beginAtZero: true }, x: { grid: { display: false } } }
}
</script>

<style scoped>
.chart-container { background: white; padding: 20px; border-radius: 10px; height: 350px; display: flex; flex-direction: column; }
.chart-container h3 { margin: 0 0 15px 0; color: #2c3e50; font-size: 16px; font-weight: bold; }
.chart-wrapper { flex: 1; position: relative; width: 100%; }
</style>
