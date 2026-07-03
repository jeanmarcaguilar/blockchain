<?php
$bc_title = 'My Orders';
$bc_page = 'orders';
$bc_role = 'customer';
$bc_user = 'Maria Santos';
$bc_avatar = 'https://i.pravatar.cc/150?u=maria';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div><h4 class="mb-1">My Orders</h4><p class="text-muted-custom mb-0">Track and manage your order history</p></div>
    <a href="track-order.php" class="btn btn-outline-custom btn-sm"><i class="fas fa-search me-1"></i> Track Order</a>
  </div>
  <div class="card-custom p-3 mb-4">
    <div class="row g-2 align-items-end">
      <div class="col-md-4"><label class="form-label small">Search</label><input type="search" class="form-control form-control-custom" id="orderSearch" placeholder="Order ID..."></div>
      <div class="col-md-3"><label class="form-label small">Status</label><select class="form-select form-select-custom" id="orderStatusFilter"><option value="">All Statuses</option><option value="pending">Pending</option><option value="processing">Processing</option><option value="shipped">Shipped</option><option value="delivered">Delivered</option></select></div>
      <div class="col-md-3"><label class="form-label small">Date Range</label><select class="form-select form-select-custom" id="orderDateFilter"><option value="">All Time</option><option value="7">Last 7 days</option><option value="30">Last 30 days</option></select></div>
      <div class="col-md-2"><button class="btn btn-outline-custom w-100" id="clearOrderFilters">Clear</button></div>
    </div>
  </div>
  <div class="card-custom">
    <div class="table-responsive">
      <table class="table table-custom mb-0">
        <thead><tr><th>Order ID</th><th>Date</th><th>Items</th><th>Total</th><th>Payment</th><th>Status</th><th>Blockchain</th><th>Actions</th></tr></thead>
        <tbody id="ordersTable"><tr><td colspan="8" class="text-center py-4"><div class="loading-spinner mx-auto"></div></td></tr></tbody>
      </table>
    </div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  let orders = BlockCartData.orders.filter(o => o.customer === 'Maria Santos');
  function render() {
    const search = document.getElementById('orderSearch').value.toLowerCase();
    const status = document.getElementById('orderStatusFilter').value;
    let filtered = orders.filter(o => {
      if (search && !o.id.toLowerCase().includes(search)) return false;
      if (status && o.status !== status) return false;
      return true;
    });
    document.getElementById('ordersTable').innerHTML = filtered.length ? filtered.map(o => `
      <tr>
        <td><strong>${o.id}</strong></td><td>${o.date}</td><td>${o.items}</td><td>${formatPrice(o.total)}</td><td>${o.payment}</td>
        <td>${getStatusBadge(o.status)}</td>
        <td>${o.verified ? '<span class="badge bg-success"><i class="fas fa-link"></i> Verified</span>' : '<span class="badge bg-secondary">Pending</span>'}</td>
        <td><a href="order-details.php?id=${o.id}" class="btn btn-sm btn-outline-custom">Details</a></td>
      </tr>`).join('') : '<tr><td colspan="8" class="text-center py-4 text-muted-custom">No orders found</td></tr>';
  }
  ['orderSearch','orderStatusFilter','orderDateFilter'].forEach(id => document.getElementById(id).addEventListener('input', render));
  document.getElementById('clearOrderFilters').addEventListener('click', () => { document.getElementById('orderSearch').value = ''; document.getElementById('orderStatusFilter').value = ''; render(); });
  render();
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
