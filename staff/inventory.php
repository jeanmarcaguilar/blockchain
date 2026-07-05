<?php
$bc_title = 'Inventory';
$bc_page = 'inventory';
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
  <div class="d-flex justify-content-between align-items-center mb-4"><div><h4 class="mb-1">Inventory Management</h4><p class="text-muted-custom mb-0">Monitor and update stock levels</p></div></div>
  <div class="row g-4 mb-4">
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-box"></i></div><div><div class="stat-value" id="inStockCount">—</div><div class="stat-label">In Stock</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-exclamation-triangle"></i></div><div><div class="stat-value" id="lowStockCount">—</div><div class="stat-label">Low Stock</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-cubes"></i></div><div><div class="stat-value" id="totalUnits">—</div><div class="stat-label">Total Units</div></div></div></div>
  </div>
  <div class="row g-4">
    <div class="col-lg-8"><div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Product</th><th>SKU</th><th>Stock</th><th>Min Stock</th><th>Status</th><th>Update</th></tr></thead><tbody id="inventoryTable"></tbody></table></div></div></div>
    <div class="col-lg-4"><div class="card-custom p-4"><h6 class="mb-3">Stock Distribution</h6><div style="height:250px"><canvas id="inventoryChart"></canvas></div></div></div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const inv = BlockCartData.inventory;
  document.getElementById('inStockCount').textContent = inv.filter(i => i.status === 'in-stock').length;
  document.getElementById('lowStockCount').textContent = inv.filter(i => i.status === 'low-stock').length;
  document.getElementById('totalUnits').textContent = inv.reduce((s,i) => s + i.stock, 0);
  document.getElementById('inventoryTable').innerHTML = inv.map(i => `
    <tr><td>${i.product}</td><td><code>${i.sku}</code></td><td><input type="number" class="form-control form-control-custom form-control-sm" style="width:80px" value="${i.stock}" min="0"></td><td>${i.minStock}</td>
    <td>${i.status === 'low-stock' ? '<span class="badge bg-warning text-dark">Low Stock</span>' : '<span class="badge bg-success">In Stock</span>'}</td>
    <td><button class="btn btn-sm btn-primary-custom" onclick="BC.toast('Stock updated for ${i.product}')">Save</button></td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
