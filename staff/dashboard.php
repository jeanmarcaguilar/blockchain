<?php
$bc_title = 'Staff Dashboard';
$bc_page = 'dashboard';
$bc_role = 'staff';
$bc_user = 'John Reyes';
$bc_avatar = 'https://i.pravatar.cc/150?u=john';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="mb-4"><h4 class="mb-1">Staff Dashboard</h4><p class="text-muted-custom">Welcome back, John. Here's today's overview.</p></div>
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-clock"></i></div><div><div class="stat-value" id="pendingOrders">—</div><div class="stat-label">Pending Orders</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-shopping-bag"></i></div><div><div class="stat-value">156</div><div class="stat-label">Orders Processed</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="fas fa-exclamation-triangle"></i></div><div><div class="stat-value" id="lowStock">—</div><div class="stat-label">Low Stock Items</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-link"></i></div><div><div class="stat-value">12</div><div class="stat-label">TXs Today</div></div></div></div>
  </div>
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card-custom p-4 mb-4">
        <div class="d-flex justify-content-between mb-3"><h5 class="mb-0">Pending Orders</h5><a href="orders.php" class="btn btn-sm btn-outline-custom">Manage All</a></div>
        <div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Order ID</th><th>Customer</th><th>Total</th><th>Status</th><th>Action</th></tr></thead><tbody id="pendingTable"></tbody></table></div>
      </div>
      <div class="card-custom p-4"><h5 class="mb-3">Orders This Week</h5><div style="height:280px"><canvas id="ordersChart"></canvas></div></div>
    </div>
    <div class="col-lg-4">
      <div class="card-custom p-4 mb-4"><h6 class="mb-3">Low Stock Alerts</h6><div id="stockAlerts"></div></div>
      <div class="card-custom p-4"><h6 class="mb-3">Recent Notifications</h6><div id="staffNotifs"></div></div>
    </div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const pending = BlockCartData.orders.filter(o => ['pending','processing','confirmed'].includes(o.status));
  document.getElementById('pendingOrders').textContent = pending.length;
  document.getElementById('lowStock').textContent = BlockCartData.inventory.filter(i => i.status === 'low-stock').length;
  document.getElementById('pendingTable').innerHTML = pending.map(o => `<tr><td><strong>${o.id}</strong></td><td>${o.customer}</td><td>${formatPrice(o.total)}</td><td>${getStatusBadge(o.status)}</td><td><a href="orders.php" class="btn btn-sm btn-primary-custom">Process</a></td></tr>`).join('');
  document.getElementById('stockAlerts').innerHTML = BlockCartData.inventory.filter(i => i.status === 'low-stock').map(i => `<div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-warning bg-opacity-10 rounded"><span class="small">${i.product}</span><span class="badge bg-warning text-dark">${i.stock} left</span></div>`).join('') || '<p class="text-muted-custom small">All stock levels OK</p>';
  document.getElementById('staffNotifs').innerHTML = BlockCartData.notifications.staff.map(n => `<div class="d-flex gap-2 mb-3 pb-2 border-bottom"><div class="notif-icon ${n.color} text-white" style="width:32px;height:32px;font-size:.7rem"><i class="fas ${n.icon}"></i></div><div><small class="fw-medium">${n.title}</small><div class="text-muted-custom" style="font-size:.75rem">${n.time}</div></div></div>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
