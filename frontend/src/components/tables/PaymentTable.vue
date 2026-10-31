<template>
  <div class="table-container">
    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Invoice</th>
          <th>Amount</th>
          <th>Method</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="payment in payments" :key="payment.id">
          <td>#{{ payment.id }}</td>
          <td>Inv-{{ payment.invoice_id }}</td>
          <td><strong>{{ payment.amount }} ETB</strong></td>
          <td>
            <i class="fas" :class="payment.method === 'telebirr' ? 'fa-mobile-alt' : 'fa-money-bill'"></i>
            {{ payment.method }}
          </td>
          <td>{{ payment.payment_date }}</td>
        </tr>
        <tr v-if="payments.length === 0">
          <td colspan="5" style="text-align: center;">No payments found</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const payments = ref<any[]>([])
onMounted(async () => {
  try {
    const res = await api.get('/payments')
    payments.value = res.data.data
  } catch (error) {
    console.error('Error fetching payments:', error)
  }
})
</script>

<style scoped>
.table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
th { background: #f8f9fa; color: #2c3e50; font-weight: bold; }
tr:hover { background: #f1f1f1; }
</style>