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
          borderColor: '#2C3B4D',
          backgroundColor: 'rgba(44, 59, 77, .15)',
          fill: true, tension: .4, pointRadius: 4, pointBackgroundColor: '#2C3B4D'
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
          backgroundColor: 'rgba(255, 177, 98, .7)',
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
          borderColor: '#A35139',
          backgroundColor: 'rgba(163, 81, 57, .15)',
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
        datasets: [{ label: 'Sales', data: [234, 512, 178, 421, 167], backgroundColor: '#2C3B4D', borderRadius: 6 }]
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
    ['#2C3B4D', '#FFB162', '#A35139', '#C9C1B1', '#1B2632', '#3D4E63']
  );
  if (document.getElementById('inventoryChart')) BCCharts.doughnut('inventoryChart',
    ['In Stock', 'Low Stock', 'Out of Stock'],
    [6, 1, 0],
    ['#10B981', '#F59E0B', '#EF4444']
  );
});
