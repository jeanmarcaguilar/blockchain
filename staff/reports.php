<?php
$bc_title = 'Reports';
$bc_page = 'reports';
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
  <div class="mb-4"><h4 class="mb-1">Sales Reports</h4><p class="text-muted-custom">Performance analytics and insights</p></div>
  <div class="row g-4 mb-4">
    <div class="col-lg-8"><div class="card-custom p-4"><h5 class="mb-3">Revenue Trend</h5><div style="height:300px"><canvas id="salesChart"></canvas></div></div></div>
    <div class="col-lg-4"><div class="card-custom p-4"><h5 class="mb-3">Orders by Month</h5><div style="height:300px"><canvas id="ordersChart"></canvas></div></div></div>
  </div>
  <div class="card-custom p-4"><h5 class="mb-3">Top Products</h5><div style="height:280px"><canvas id="topProductsChart"></canvas></div></div>
</main>
</div></div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
