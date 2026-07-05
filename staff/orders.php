<?php
$bc_title = 'Order Management';
$bc_page = 'orders';
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
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div><h4 class="mb-1">Order Management</h4><p class="text-muted-custom mb-0">Process and update order statuses</p></div>
  </div>
  <div class="card-custom p-3 mb-4">
    <div class="row g-2"><div class="col-md-4"><input type="search" class="form-control form-control-custom" id="staffOrderSearch" placeholder="Search orders..."></div>
    <div class="col-md-3"><select class="form-select form-select-custom" id="staffStatusFilter"><option value="">All Statuses</option><option value="pending">Pending</option><option value="confirmed">Confirmed</option><option value="processing">Processing</option><option value="shipped">Shipped</option><option value="delivered">Delivered</option></select></div></div>
  </div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Order ID</th><th>Customer</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th>Staff</th><th>Update Status</th></tr></thead><tbody id="staffOrdersTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const statuses = ['pending','confirmed','processing','packed','shipped','delivered'];
  function render() {
    const search = document.getElementById('staffOrderSearch').value.toLowerCase();
    const filter = document.getElementById('staffStatusFilter').value;
    let orders = BlockCartData.orders.filter(o => {
      if (search && !o.id.toLowerCase().includes(search) && !o.customer.toLowerCase().includes(search)) return false;
      if (filter && o.status !== filter) return false;
      return true;
    });
    document.getElementById('staffOrdersTable').innerHTML = orders.map(o => `
      <tr><td><strong>${o.id}</strong></td><td>${o.customer}<br><small class="text-muted-custom">${o.email}</small></td><td>${o.date}</td><td>${o.items}</td><td>${formatPrice(o.total)}</td><td>${getStatusBadge(o.status)}</td><td>${o.staff || '—'}</td>
      <td><select class="form-select form-select-custom form-select-sm" onchange="updateOrderStatus('${o.id}',this.value)">${statuses.map(s=>`<option value="${s}" ${s===o.status?'selected':''}>${s}</option>`).join('')}</select></td></tr>`).join('');
  }
  window.updateOrderStatus = (id, status) => { BC.showLoading(); setTimeout(() => { BC.hideLoading(); BC.toast(`Order ${id} updated to ${status}`); }, 800); };
  ['staffOrderSearch','staffStatusFilter'].forEach(id => document.getElementById(id).addEventListener('input', render));
  render();
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
