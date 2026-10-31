<template>
  <!-- ✅ Use MasterLayout -->
  <MasterLayout>
    <!-- ✅ Page Header -->
    <div class="page-header">
      <h1><i class="fas fa-chart-pie"></i> Reports & Analytics</h1>
      <p>Generate and download school reports here.</p>
    </div>

    <!-- ✅ Report Cards Grid -->
    <div class="reports-grid">
      
      <!-- Financial Report Card -->
      <div class="report-card">
        <div class="icon-box blue">
          <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <h3>Financial Report</h3>
        <p>View total fee collections, outstanding balances, and monthly revenue reports.</p>
        <button @click="download('financial')" class="btn btn-blue" :disabled="reportStore.loading">
          <i v-if="reportStore.loading" class="fas fa-spinner fa-spin"></i>
          <i v-else class="fas fa-download"></i> 
          {{ reportStore.loading ? 'Generating...' : 'Download PDF' }}
        </button>
      </div>

      <!-- Academic Report Card -->
      <div class="report-card">
        <div class="icon-box green">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <h3>Academic Report</h3>
        <p>Analyze student grades, exam performance, and overall class averages.</p>
        <button @click="download('academic')" class="btn btn-green" :disabled="reportStore.loading">
          <i v-if="reportStore.loading" class="fas fa-spinner fa-spin"></i>
          <i v-else class="fas fa-download"></i> 
          {{ reportStore.loading ? 'Generating...' : 'Download PDF' }}
        </button>
      </div>

      <!-- Payment History Card -->
      <div class="report-card">
        <div class="icon-box purple">
          <i class="fas fa-receipt"></i>
        </div>
        <h3>Payment History</h3>
        <p>View detailed transaction history of all fee payments received.</p>
        <button @click="download('payment')" class="btn btn-purple" :disabled="reportStore.loading">
          <i v-if="reportStore.loading" class="fas fa-spinner fa-spin"></i>
          <i v-else class="fas fa-download"></i> 
          {{ reportStore.loading ? 'Generating...' : 'Download PDF' }}
        </button>
      </div>

    </div>
  </MasterLayout>
</template>

<script setup lang="ts">
import MasterLayout from '../../components/layouts/MasterLayout.vue' // ✅ Import MasterLayout
import { useReportStore } from '../../stores/reportStore'

const reportStore = useReportStore()

const download = async (type: string) => {
  try { 
    await reportStore.downloadReport(type) 
  } catch (e) { 
    alert('Failed to generate report') 
  }
}
</script>

<style scoped>
/* ✅ Page Header */
.page-header {
  margin-bottom: 25px;
}
.page-header h1 {
  margin: 0 0 8px 0;
  color: #1e293b;
  font-size: 24px;
  display: flex;
  align-items: center;
  gap: 12px;
}
.page-header h1 i {
  color: #3498db;
}
.page-header p {
  margin: 0;
  color: #64748b;
  font-size: 14px;
}

/* ✅ Reports Grid */
.reports-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 25px;
  margin-top: 20px;
}

/* ✅ Individual Report Card */
.report-card {
  background: white;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.report-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.report-card h3 { margin: 15px 0 10px 0; color: #2c3e50; font-size: 18px; }
.report-card p { color: #64748b; font-size: 14px; line-height: 1.5; margin-bottom: 20px; flex: 1; }

/* ✅ Icons */
.icon-box {
  width: 50px;
  height: 50px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}
.icon-box.blue { background: #e0f2fe; color: #0284c7; }
.icon-box.green { background: #dcfce7; color: #16a34a; }
.icon-box.purple { background: #f3e8ff; color: #9333ea; }

/* ✅ Buttons */
.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: 0.3s;
}
.btn:disabled { opacity: 0.7; cursor: not-allowed; }
.btn-blue { background: #3498db; color: white; }
.btn-blue:hover:not(:disabled) { background: #2980b9; }
.btn-green { background: #2ecc71; color: white; }
.btn-green:hover:not(:disabled) { background: #27ae60; }
.btn-purple { background: #9333ea; color: white; }
.btn-purple:hover:not(:disabled) { background: #7e22ce; }
</style>