<?php
$bc_title = 'Orders';
$bc_page = 'orders';
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
  <div class="mb-4"><h4 class="mb-1">All Orders</h4><p class="text-muted-custom">Complete order management across all customers</p></div>
  <div class="card-custom p-3 mb-4"><div class="row g-2"><div class="col-md-4"><input type="search" class="form-control form-control-custom" id="adminOrderSearch" placeholder="Search..."></div>
  <div class="col-md-3"><select class="form-select form-select-custom" id="adminStatusFilter"><option value="">All Statuses</option><option value="pending">Pending</option><option value="delivered">Delivered</option></select></div>
  <div class="col-md-3"><select class="form-select form-select-custom"><option>All Staff</option><option>John Reyes</option><option>Ana Cruz</option></select></div></div></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Order ID</th><th>Customer</th><th>Date</th><th>Total</th><th>Payment</th><th>Staff</th><th>Blockchain</th><th>Status</th><th>Actions</th></tr></thead><tbody id="adminOrdersTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  function render() {
    const search = document.getElementById('adminOrderSearch').value.toLowerCase();
    const status = document.getElementById('adminStatusFilter').value;
    let orders = BlockCartData.orders.filter(o => {
      if (search && !o.id.toLowerCase().includes(search) && !o.customer.toLowerCase().includes(search)) return false;
      if (status && o.status !== status) return false;
      return true;
    });
    document.getElementById('adminOrdersTable').innerHTML = orders.map(o => `
      <tr><td><strong>${o.id}</strong></td><td>${o.customer}<br><small class="text-muted-custom">${o.email}</small></td><td>${o.date}</td><td>${formatPrice(o.total)}</td><td>${o.payment}</td><td>${o.staff || '—'}</td>
      <td>${o.verified ? '<i class="fas fa-link text-success"></i>' : '—'}</td><td>${getStatusBadge(o.status)}</td>
      <td><button class="btn btn-sm btn-outline-custom" onclick="BC.toast('View order ${o.id}','info')"><i class="fas fa-eye"></i></button></td></tr>`).join('');
  }
  ['adminOrderSearch','adminStatusFilter'].forEach(id => document.getElementById(id).addEventListener('input', render));
  render();
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
