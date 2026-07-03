<?php
$bc_title = 'Invoice';
$bc_page = 'orders';
$bc_role = 'customer';
$bc_user = 'Maria Santos';
$bc_avatar = 'https://i.pravatar.cc/150?u=maria';
$bc_dashboard = true;
$bc_breadcrumb = ['My Orders', 'Invoice'];
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="d-flex justify-content-between mb-4 no-print">
    <a href="orders.php" class="btn btn-outline-custom btn-sm"><i class="fas fa-arrow-left me-1"></i> Back</a>
    <button class="btn btn-primary-custom btn-sm" onclick="window.print()"><i class="fas fa-print me-1"></i> Print Invoice</button>
  </div>
  <div class="card-custom p-4 p-lg-5" id="invoiceContent">
    <div class="text-center py-5"><div class="loading-spinner mx-auto"></div></div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const orderId = new URLSearchParams(location.search).get('id') || 'BC-2026-00142';
  const order = BlockCartData.orders.find(o => o.id === orderId) || BlockCartData.orders[0];
  const items = BlockCartData.products.slice(0, order.items);
  document.getElementById('invoiceContent').innerHTML = `
    <div class="row mb-5"><div class="col-6"><h3><i class="fas fa-cube text-primary"></i> BlockCart</h3><p class="text-muted-custom small mb-0">123 Ayala Avenue, Makati City<br>support@blockcart.com</p></div>
    <div class="col-6 text-end"><h4>INVOICE</h4><p class="mb-0"><strong>${order.id}</strong></p><p class="text-muted-custom small">Date: ${order.date}</p>${getStatusBadge(order.status)}</div></div>
    <div class="row mb-4"><div class="col-6"><h6>Bill To</h6><p class="text-muted-custom small">${BlockCartData.currentUser.customer.name}<br>${BlockCartData.currentUser.customer.email}<br>${BlockCartData.currentUser.customer.address}</p></div>
    <div class="col-6 text-end"><h6>Payment</h6><p class="text-muted-custom small">${order.payment}<br>Blockchain: ${order.verified ? 'Verified' : 'Pending'}</p></div></div>
    <table class="table table-custom"><thead><tr><th>Item</th><th>SKU</th><th>Qty</th><th>Price</th><th>Total</th></tr></thead><tbody>
    ${items.map(p => { const pr = getDiscountedPrice(p); return `<tr><td>${p.name}</td><td>${p.sku}</td><td>1</td><td>${formatPrice(pr)}</td><td>${formatPrice(pr)}</td></tr>`; }).join('')}
    </tbody></table>
    <div class="text-end mt-4"><div class="d-inline-block text-start" style="min-width:250px">
      <div class="d-flex justify-content-between mb-1"><span>Subtotal</span><span>${formatPrice(order.total * 0.88)}</span></div>
      <div class="d-flex justify-content-between mb-1"><span>Tax (12%)</span><span>${formatPrice(order.total * 0.12)}</span></div>
      <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2"><span>Total</span><span>${formatPrice(order.total)}</span></div>
    </div></div>
    ${order.txHash ? `<div class="mt-4 p-3 bg-light rounded small"><strong>Blockchain TX:</strong> <code>${order.txHash}</code></div>` : ''}
    <p class="text-center text-muted-custom small mt-5 mb-0">Thank you for shopping with BlockCart!</p>`;
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
