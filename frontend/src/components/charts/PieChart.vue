<template>
  <div class="chart-container">
    <h3>{{ title }}</h3>
    <!-- ✅ Added explicit height here so Chart.js knows where to draw -->
    <div class="chart-wrapper">
      <Pie v-if="chartData" :data="chartData" :options="chartOptions" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { Pie } from 'vue-chartjs'
import { 
  Chart as ChartJS, 
  Title, 
  Tooltip, 
  Legend, 
  ArcElement 
} from 'chart.js'

// ✅ Register required components
ChartJS.register(Title, Tooltip, Legend, ArcElement)

const props = defineProps<{
  title: string
  labels: string[]
  dataValues: number[]
  colors: string[]
}>()

const chartData = computed(() => ({
  labels: props.labels,
  datasets: [
    {
      backgroundColor: props.colors,
      data: props.dataValues,
      borderWidth: 1,
      borderColor: '#ffffff'
    }
  ]
}))

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false, // ✅ CRITICAL: Allows chart to fill the wrapper
  plugins: {
    legend: {
      position: 'bottom' as const,
    }
  }
}
</script>

<style scoped>
.chart-container {
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0,0,0,0.05);
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100%; /* ✅ ሙሉ ቦታውን እንዲይዝ */
}

h3 {
  margin: 0 0 15px 0;
  color: #2c3e50;
  font-size: 16px;
}

.chart-wrapper {
  position: relative;
  height: 250px; 
  width: 100%;
  max-width: 300px; 
  margin: 0 auto; 
}
</style>