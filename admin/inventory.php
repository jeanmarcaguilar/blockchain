<?php
$bc_title = 'Inventory';
$bc_page = 'inventory';
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
  <div class="d-flex justify-content-between mb-4"><div><h4 class="mb-1">Inventory Management</h4><p class="text-muted-custom">Full stock control across all products</p></div>
  <button class="btn btn-outline-custom btn-sm" onclick="BC.toast('Inventory report exported!')"><i class="fas fa-download me-1"></i> Export</button></div>
  <div class="row g-4 mb-4">
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-check"></i></div><div><div class="stat-value">7</div><div class="stat-label">In Stock</div></div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-exclamation"></i></div><div><div class="stat-value">1</div><div class="stat-label">Low Stock</div></div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="fas fa-times"></i></div><div><div class="stat-value">0</div><div class="stat-label">Out of Stock</div></div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-cubes"></i></div><div><div class="stat-value">336</div><div class="stat-label">Total Units</div></div></div></div>
  </div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>ID</th><th>Product</th><th>SKU</th><th>Current Stock</th><th>Min Stock</th><th>Status</th><th>Restock</th></tr></thead><tbody id="adminInvTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('adminInvTable').innerHTML = BlockCartData.inventory.map(i => `
    <tr><td>${i.id}</td><td>${i.product}</td><td><code>${i.sku}</code></td><td><input type="number" class="form-control form-control-custom form-control-sm d-inline-block" style="width:80px" value="${i.stock}"></td><td>${i.minStock}</td>
    <td>${i.status === 'low-stock' ? '<span class="badge bg-warning text-dark">Low Stock</span>' : '<span class="badge bg-success">In Stock</span>'}</td>
    <td><button class="btn btn-sm btn-primary-custom" onclick="BC.toast('Restock order created for ${i.product}')"><i class="fas fa-plus"></i> Restock</button></td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
