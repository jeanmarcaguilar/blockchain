<?php
$bc_title = 'Track Order';
$bc_page = 'orders';
$bc_role = 'customer';
$bc_user = 'Maria Santos';
$bc_avatar = 'https://i.pravatar.cc/150?u=maria';
$bc_dashboard = true;
$bc_breadcrumb = ['My Orders', 'Track Order'];
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card-custom p-4 p-lg-5 text-center mb-4">
        <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-4"><i class="fas fa-search-location fa-2x"></i></div>
        <h4 class="mb-2">Track Your Order</h4>
        <p class="text-muted-custom mb-4">Enter your order ID to see real-time tracking status</p>
        <form id="trackForm" class="row g-2 justify-content-center">
          <div class="col-md-8"><input type="text" class="form-control form-control-custom form-control-lg" id="trackOrderId" placeholder="e.g. BC-2026-00143" required></div>
          <div class="col-md-4"><button type="submit" class="btn btn-primary-custom btn-lg w-100"><i class="fas fa-search me-2"></i>Track</button></div>
        </form>
      </div>
      <div id="trackResult"></div>
    </div>
  </div>
</main>
</div></div>
<script>
document.getElementById('trackForm').addEventListener('submit', e => {
  e.preventDefault();
  const id = document.getElementById('trackOrderId').value.trim();
  const order = BlockCartData.orders.find(o => o.id.toLowerCase() === id.toLowerCase());
  const result = document.getElementById('trackResult');
  if (!order) { result.innerHTML = '<div class="card-custom p-4 text-center"><i class="fas fa-exclamation-circle fa-2x text-warning mb-3"></i><h5>Order Not Found</h5><p class="text-muted-custom">Please check your order ID and try again.</p></div>'; return; }
  const statuses = ['pending','confirmed','processing','packed','shipped','delivered'];
  const idx = statuses.indexOf(order.status);
  result.innerHTML = `
    <div class="card-custom p-4">
      <div class="d-flex justify-content-between align-items-center mb-4"><div><h5 class="mb-1">${order.id}</h5><small class="text-muted-custom">${order.date}</small></div>${getStatusBadge(order.status)}</div>
      <div class="tracking-timeline">${statuses.map((s,i)=>`<div class="tracking-step ${i<=idx?'completed':''} ${i===idx?'active':''}"><div class="tracking-dot"></div><div><strong>${s.replace(/-/g,' ').replace(/\\b\\w/g,c=>c.toUpperCase())}</strong></div></div>`).join('')}</div>
      <div class="mt-4 pt-3 border-top d-flex justify-content-between"><span>Total: <strong>${formatPrice(order.total)}</strong></span><a href="order-details.php?id=${order.id}" class="btn btn-sm btn-primary-custom">Full Details</a></div>
    </div>`;
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
