<?php
$bc_title = 'Order Details';
$bc_page = 'orders';
$bc_role = 'customer';
$bc_user = 'Maria Santos';
$bc_avatar = 'https://i.pravatar.cc/150?u=maria';
$bc_dashboard = true;
$bc_breadcrumb = ['My Orders', 'Order Details'];
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content" id="orderDetailPage">
  <div class="text-center py-5"><div class="loading-spinner mx-auto"></div><p class="text-muted-custom mt-3">Loading order...</p></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const orderId = new URLSearchParams(location.search).get('id') || 'BC-2026-00143';
  const order = BlockCartData.orders.find(o => o.id === orderId);
  const container = document.getElementById('orderDetailPage');
  if (!order) { container.innerHTML = '<div class="card-custom p-5 text-center"><h5>Order not found</h5><a href="orders.php" class="btn btn-primary-custom mt-3">Back to Orders</a></div>'; return; }

  const statuses = ['pending','confirmed','processing','packed','shipped','delivered'];
  const currentIdx = statuses.indexOf(order.status);

  container.innerHTML = `
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-4 gap-3">
      <div><h4 class="mb-1">Order ${order.id}</h4><p class="text-muted-custom mb-0">Placed on ${order.date} · ${order.items} item(s)</p></div>
      <div class="d-flex gap-2">${getStatusBadge(order.status)}<a href="invoice.php?id=${order.id}" class="btn btn-outline-custom btn-sm"><i class="fas fa-file-invoice me-1"></i> Invoice</a></div>
    </div>
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card-custom p-4 mb-4">
          <h5 class="mb-4"><i class="fas fa-truck text-primary me-2"></i>Order Tracking</h5>
          <div class="tracking-timeline">${statuses.map((s, i) => `
            <div class="tracking-step ${i <= currentIdx ? 'completed' : ''} ${i === currentIdx ? 'active' : ''}">
              <div class="tracking-dot"></div>
              <div><strong>${s.replace(/-/g,' ').replace(/\\b\\w/g,c=>c.toUpperCase())}</strong>
              <small class="text-muted-custom d-block">${i <= currentIdx ? order.date : 'Pending'}</small></div>
            </div>`).join('')}
          </div>
        </div>
        <div class="card-custom p-4">
          <h5 class="mb-3">Order Items</h5>
          <div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr></thead>
          <tbody id="orderItems"></tbody></table></div>
          <div class="border-top pt-3 mt-3 text-end">
            <div class="d-flex justify-content-between mb-1"><span>Subtotal</span><span>${formatPrice(order.total * 0.88)}</span></div>
            <div class="d-flex justify-content-between mb-1"><span>Tax (12%)</span><span>${formatPrice(order.total * 0.12)}</span></div>
            <div class="d-flex justify-content-between mb-1"><span>Shipping</span><span>${formatPrice(99)}</span></div>
            <div class="d-flex justify-content-between fw-bold fs-5 mt-2"><span>Total</span><span class="text-primary">${formatPrice(order.total)}</span></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card-custom p-4 mb-4">
          <h6 class="mb-3">Shipping Address</h6>
          <p class="text-muted-custom small mb-0">${BlockCartData.currentUser.customer.name}<br>${BlockCartData.currentUser.customer.address}</p>
        </div>
        <div class="card-custom p-4 mb-4">
          <h6 class="mb-3">Payment</h6>
          <p class="mb-1"><strong>Method:</strong> ${order.payment}</p>
          <p class="mb-0 text-muted-custom small">Cash on Delivery</p>
        </div>
        <div id="blockchainCard"></div>
      </div>
    </div>`;

  const items = BlockCartData.products.slice(0, order.items);
  document.getElementById('orderItems').innerHTML = items.map(p => {
    const price = getDiscountedPrice(p);
    return `<tr><td><div class="d-flex align-items-center gap-2"><img src="${p.image}" width="40" height="40" class="rounded" style="object-fit:cover"><span>${p.name.substring(0,30)}...</span></div></td><td>1</td><td>${formatPrice(price)}</td><td>${formatPrice(price)}</td></tr>`;
  }).join('');
  document.getElementById('blockchainCard').innerHTML = BCBlockchain.renderVerificationCard(order.id);
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
