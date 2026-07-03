<?php
$bc_title = 'Invoices';
$bc_page = 'invoices';
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
  <div class="mb-4"><h4 class="mb-1">Invoices</h4><p class="text-muted-custom">View and manage customer invoices</p></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Invoice #</th><th>Order ID</th><th>Customer</th><th>Date</th><th>Amount</th><th>Status</th><th>Actions</th></tr></thead><tbody id="invoicesTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('invoicesTable').innerHTML = BlockCartData.orders.map((o, i) => `
    <tr><td>INV-${2026000 + i + 1}</td><td><strong>${o.id}</strong></td><td>${o.customer}</td><td>${o.date}</td><td>${formatPrice(o.total)}</td><td>${getStatusBadge(o.status)}</td>
    <td><button class="btn btn-sm btn-outline-custom" onclick="window.print()"><i class="fas fa-print"></i></button> <button class="btn btn-sm btn-outline-custom" onclick="BC.toast('Invoice emailed to ${o.email}')"><i class="fas fa-envelope"></i></button></td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
