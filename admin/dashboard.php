<?php
$bc_title = 'Admin Dashboard';
$bc_page = 'dashboard';
$bc_role = 'admin';
$bc_user = 'Admin User';
$bc_avatar = 'https://i.pravatar.cc/150?u=admin';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="mb-4"><h4 class="mb-1">Admin Dashboard</h4><p class="text-muted-custom">Complete overview of BlockCart operations</p></div>
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-peso-sign"></i></div><div><div class="stat-value">₱156K</div><div class="stat-label">Revenue (Jul)</div><small class="text-success"><i class="fas fa-arrow-up"></i> 12%</small></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-shopping-bag"></i></div><div><div class="stat-value" id="adminOrders">—</div><div class="stat-label">Total Orders</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-info bg-opacity-10 text-info"><i class="fas fa-users"></i></div><div><div class="stat-value" id="adminCustomers">—</div><div class="stat-label">Customers</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-box"></i></div><div><div class="stat-value">8</div><div class="stat-label">Products</div></div></div></div>
  </div>
  <div class="row g-4 mb-4">
    <div class="col-lg-8"><div class="card-custom p-4"><h5 class="mb-3">Sales Overview</h5><div style="height:300px"><canvas id="salesChart"></canvas></div></div></div>
    <div class="col-lg-4"><div class="card-custom p-4"><h5 class="mb-3">Sales by Category</h5><div style="height:300px"><canvas id="categoryChart"></canvas></div></div></div>
  </div>
  <div class="row g-4 mb-4">
    <div class="col-lg-6"><div class="card-custom p-4"><h5 class="mb-3">Top Products</h5><div style="height:260px"><canvas id="topProductsChart"></canvas></div></div></div>
    <div class="col-lg-6"><div class="card-custom p-4"><h5 class="mb-3">Blockchain Transactions</h5><div style="height:260px"><canvas id="blockchainChart"></canvas></div></div></div>
  </div>
  <div class="row g-4">
    <div class="col-lg-6"><div class="card-custom p-4"><h5 class="mb-3">Recent Orders</h5><div class="table-responsive"><table class="table table-custom table-sm mb-0"><thead><tr><th>Order</th><th>Customer</th><th>Total</th><th>Status</th></tr></thead><tbody id="adminRecentOrders"></tbody></table></div></div></div>
    <div class="col-lg-6"><div class="card-custom p-4"><h5 class="mb-3">System Alerts</h5><div id="adminAlerts"></div></div></div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('adminOrders').textContent = BlockCartData.orders.length;
  document.getElementById('adminCustomers').textContent = BlockCartData.users.customers.length;
  document.getElementById('adminRecentOrders').innerHTML = BlockCartData.orders.slice(0,5).map(o => `<tr><td>${o.id}</td><td>${o.customer}</td><td>${formatPrice(o.total)}</td><td>${getStatusBadge(o.status)}</td></tr>`).join('');
  document.getElementById('adminAlerts').innerHTML = BlockCartData.notifications.admin.map(n => `<div class="d-flex gap-2 mb-3 p-2 rounded bg-light"><div class="notif-icon ${n.color} text-white" style="width:32px;height:32px;font-size:.7rem"><i class="fas ${n.icon}"></i></div><div><small class="fw-medium">${n.title}</small><div class="text-muted-custom" style="font-size:.75rem">${n.message}</div></div></div>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
