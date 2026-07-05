<?php
require_once __DIR__ . '/../includes/config.php';
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: ' . bc_url('auth/login.php'));
  exit;
}
$bc_title = 'Dashboard';
$bc_page = 'dashboard';
$bc_role = 'customer';
$bc_user = $_SESSION['user_name'] ?? 'Maria Santos';
$bc_avatar = $_SESSION['user_avatar'] ?? 'https://i.pravatar.cc/150?u=maria';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <div><h4 class="mb-1">Welcome back, Maria! 👋</h4><p class="text-muted-custom mb-0">Here's what's happening with your orders today.</p></div>
    <a href="<?= bc_url('shop.php') ?>" class="btn btn-primary-custom btn-sm"><i class="fas fa-shopping-bag me-1"></i> Continue Shopping</a>
  </div>
  <div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fas fa-shopping-bag"></i></div><div><div class="stat-value" id="statOrders">—</div><div class="stat-label">Total Orders</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-truck"></i></div><div><div class="stat-value" id="statActive">—</div><div class="stat-label">Active Orders</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fas fa-heart"></i></div><div><div class="stat-value" id="statWishlist">—</div><div class="stat-label">Wishlist Items</div></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="stat-card"><div class="stat-icon bg-info bg-opacity-10 text-info"><i class="fas fa-link"></i></div><div><div class="stat-value" id="statVerified">—</div><div class="stat-label">Verified TXs</div></div></div></div>
  </div>
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card-custom p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3"><h5 class="mb-0">Recent Orders</h5><a href="orders.php" class="btn btn-sm btn-outline-custom">View All</a></div>
        <div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Order ID</th><th>Date</th><th>Total</th><th>Status</th><th></th></tr></thead><tbody id="recentOrders"></tbody></table></div>
      </div>
      <div class="card-custom p-4">
        <h5 class="mb-3">Recommended for You</h5>
        <div class="row g-3" id="recommendedProducts"></div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="blockchain-card mb-4">
        <div class="d-flex align-items-center gap-2 mb-3"><i class="fas fa-link fa-lg"></i><h5 class="mb-0 text-white">Blockchain Status</h5></div>
        <div class="mb-3"><small class="opacity-75">Network</small><div class="fw-semibold">Sepolia Testnet</div></div>
        <div class="mb-3"><small class="opacity-75">Contract</small><div class="tx-hash mt-1" style="font-size:.7rem" id="contractAddr"></div></div>
        <div class="d-flex justify-content-between mb-3"><div><small class="opacity-75">Verified Orders</small><div class="fw-bold fs-4" id="verifiedCount">—</div></div><div><small class="opacity-75">Pending</small><div class="fw-bold fs-4" id="pendingCount">—</div></div></div>
        <a href="blockchain.php" class="btn btn-light btn-sm w-100"><i class="fas fa-shield-alt me-1"></i> Verify Transactions</a>
      </div>
      <div class="card-custom p-4">
        <h6 class="mb-3"><i class="fas fa-bell text-primary me-2"></i>Recent Notifications</h6>
        <div id="dashNotifs"></div>
        <a href="notifications.php" class="btn btn-sm btn-outline-custom w-100 mt-2">View All</a>
      </div>
    </div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const myOrders = BlockCartData.orders.filter(o => o.customer === 'Maria Santos');
  document.getElementById('statOrders').textContent = myOrders.length;
  document.getElementById('statActive').textContent = myOrders.filter(o => !['delivered','cancelled'].includes(o.status)).length;
  document.getElementById('statWishlist').textContent = BlockCartData.wishlist.length;
  document.getElementById('statVerified').textContent = myOrders.filter(o => o.verified).length;
  document.getElementById('contractAddr').textContent = BlockCartData.settings.contractAddress;
  document.getElementById('verifiedCount').textContent = myOrders.filter(o => o.verified).length;
  document.getElementById('pendingCount').textContent = myOrders.filter(o => !o.verified).length;
  document.getElementById('recentOrders').innerHTML = myOrders.slice(0,5).map(o => `
    <tr><td><strong>${o.id}</strong></td><td>${o.date}</td><td>${formatPrice(o.total)}</td><td>${getStatusBadge(o.status)}</td>
    <td><a href="order-details.php?id=${o.id}" class="btn btn-sm btn-outline-custom">View</a></td></tr>`).join('');
  document.getElementById('recommendedProducts').innerHTML = BlockCartData.products.filter(p=>p.featured).slice(0,2).map(p => {
    const price = getDiscountedPrice(p);
    return `<div class="col-6"><div class="d-flex gap-2 align-items-center"><img src="${p.image}" class="rounded" width="60" height="60" style="object-fit:cover"><div><small class="fw-medium d-block">${p.name.substring(0,25)}...</small><span class="text-primary fw-bold">${formatPrice(price)}</span></div></div></div>`;
  }).join('');
  document.getElementById('dashNotifs').innerHTML = BlockCartData.notifications.customer.slice(0,3).map(n => `
    <div class="d-flex gap-2 mb-3 pb-3 border-bottom ${n.read?'':'fw-medium'}"><div class="notif-icon ${n.color} text-white flex-shrink-0" style="width:32px;height:32px;font-size:.75rem"><i class="fas ${n.icon}"></i></div><div><small>${n.title}</small><div class="text-muted-custom" style="font-size:.75rem">${n.time}</div></div></div>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
