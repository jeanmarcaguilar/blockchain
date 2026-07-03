<?php
$bc_title = 'Reports';
$bc_page = 'reports';
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
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div><h4 class="mb-1">Comprehensive Reports</h4><p class="text-muted-custom mb-0">Analytics and business intelligence</p></div>
    <div class="d-flex gap-2">
      <button class="btn btn-outline-custom btn-sm" onclick="BC.toast('PDF report exported!')"><i class="fas fa-file-pdf me-1"></i> Export PDF</button>
      <button class="btn btn-outline-custom btn-sm" onclick="BC.toast('CSV data exported!')"><i class="fas fa-file-csv me-1"></i> Export CSV</button>
      <button class="btn btn-primary-custom btn-sm" onclick="BC.toast('Excel report exported!')"><i class="fas fa-file-excel me-1"></i> Export Excel</button>
    </div>
  </div>
  <div class="row g-4 mb-4">
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-chart-line"></i></div><div><div class="stat-value">₱1.2M</div><div class="stat-label">Total Revenue</div></div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-shopping-cart"></i></div><div><div class="stat-value">788</div><div class="stat-label">Total Orders</div></div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-info bg-opacity-10 text-info"><i class="fas fa-users"></i></div><div><div class="stat-value">4</div><div class="stat-label">Active Customers</div></div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-percentage"></i></div><div><div class="stat-value">3.2%</div><div class="stat-label">Conversion Rate</div></div></div></div>
  </div>
  <div class="row g-4 mb-4">
    <div class="col-lg-8"><div class="card-custom p-4"><h5 class="mb-3">Revenue & Sales</h5><div style="height:320px"><canvas id="salesChart"></canvas></div></div></div>
    <div class="col-lg-4"><div class="card-custom p-4"><h5 class="mb-3">Category Breakdown</h5><div style="height:320px"><canvas id="categoryChart"></canvas></div></div></div>
  </div>
  <div class="row g-4">
    <div class="col-lg-6"><div class="card-custom p-4"><h5 class="mb-3">Order Volume</h5><div style="height:280px"><canvas id="ordersChart"></canvas></div></div></div>
    <div class="col-lg-6"><div class="card-custom p-4"><h5 class="mb-3">Top Selling Products</h5><div style="height:280px"><canvas id="topProductsChart"></canvas></div></div></div>
  </div>
</main>
</div></div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
