/* BlockCart Charts */
const BCCharts = {
  defaults: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
      x: { grid: { display: false }, ticks: { font: { family: 'Poppins', size: 11 } } },
      y: { grid: { color: 'rgba(0,0,0,.05)' }, ticks: { font: { family: 'Poppins', size: 11 } } }
    }
  },

  sales(canvasId, data = BlockCartData.salesChart) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return;
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: data.labels,
        datasets: [{
          label: 'Revenue',
          data: data.revenue,
          borderColor: '#2563EB',
          backgroundColor: 'rgba(37,99,235,.1)',
          fill: true, tension: .4, pointRadius: 4, pointBackgroundColor: '#2563EB'
        }]
      },
      options: { ...this.defaults, plugins: { legend: { display: true, position: 'top' } } }
    });
  },

  orders(canvasId) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return;
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: BlockCartData.salesChart.labels,
        datasets: [{
          label: 'Orders',
          data: BlockCartData.salesChart.orders,
          backgroundColor: 'rgba(16,185,129,.7)',
          borderRadius: 8
        }]
      },
      options: this.defaults
    });
  },

  doughnut(canvasId, labels, values, colors) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return;
    new Chart(ctx, {
      type: 'doughnut',
      data: { labels, datasets: [{ data: values, backgroundColor: colors, borderWidth: 0 }] },
      options: { responsive: true, maintainAspectRatio: false, cutout: '65%', plugins: { legend: { position: 'bottom', labels: { font: { family: 'Poppins', size: 11 }, padding: 12 } } } }
    });
  },

  blockchain(canvasId) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return;
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Transactions',
          data: [8, 12, 15, 10, 18, 22, 12],
          borderColor: '#10B981',
          backgroundColor: 'rgba(16,185,129,.1)',
          fill: true, tension: .4
        }]
      },
      options: this.defaults
    });
  },

  topProducts(canvasId) {
    const ctx = document.getElementById(canvasId);
    if (!ctx) return;
    const top = BlockCartData.products.filter(p => p.bestseller).slice(0, 5);
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: top.map(p => p.name.substring(0, 20) + '...'),
        datasets: [{ label: 'Sales', data: [234, 512, 178, 421, 167], backgroundColor: '#2563EB', borderRadius: 6 }]
      },
      options: { ...this.defaults, indexAxis: 'y' }
    });
  }
};

document.addEventListener('DOMContentLoaded', () => {
  if (typeof Chart === 'undefined') return;
  if (document.getElementById('salesChart')) BCCharts.sales('salesChart');
  if (document.getElementById('ordersChart')) BCCharts.orders('ordersChart');
  if (document.getElementById('blockchainChart')) BCCharts.blockchain('blockchainChart');
  if (document.getElementById('topProductsChart')) BCCharts.topProducts('topProductsChart');
  if (document.getElementById('categoryChart')) BCCharts.doughnut('categoryChart',
    BlockCartData.categories.map(c => c.name),
    BlockCartData.categories.map(c => c.count),
    ['#2563EB', '#10B981', '#F97316', '#8B5CF6', '#EC4899', '#06B6D4']
  );
  if (document.getElementById('inventoryChart')) BCCharts.doughnut('inventoryChart',
    ['In Stock', 'Low Stock', 'Out of Stock'],
    [6, 1, 0],
    ['#22C55E', '#F97316', '#EF4444']
  );
});
