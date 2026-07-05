<?php
require_once __DIR__ . '/../includes/config.php';
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: ' . bc_url('auth/login.php'));
  exit;
}
$bc_title = 'Wishlist';
$bc_page = 'wishlist';
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
    <div><h4 class="mb-1">My Wishlist</h4><p class="text-muted-custom mb-0" id="wishlistCount">Loading...</p></div>
    <button class="btn btn-outline-custom btn-sm" id="addAllToCart" data-confirm="Add all wishlist items to cart?"><i class="fas fa-cart-plus me-1"></i> Add All to Cart</button>
  </div>
  <div class="row" id="wishlistGrid"><div class="col-12 text-center py-5"><div class="loading-spinner mx-auto"></div></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  function render() {
    const ids = JSON.parse(localStorage.getItem('bc-wishlist') || JSON.stringify(BlockCartData.wishlist));
    const products = ids.map(id => BlockCartData.products.find(p => p.id === id)).filter(Boolean);
    document.getElementById('wishlistCount').textContent = `${products.length} item${products.length !== 1 ? 's' : ''} saved`;
    const grid = document.getElementById('wishlistGrid');
    if (!products.length) {
      grid.innerHTML = `<div class="col-12"><div class="card-custom p-5 text-center"><i class="far fa-heart fa-3x text-muted-custom mb-3"></i><h5>Your wishlist is empty</h5><p class="text-muted-custom">Save items you love for later.</p><a href="<?= bc_url('shop.php') ?>" class="btn btn-primary-custom">Browse Products</a></div></div>`;
      return;
    }
    grid.innerHTML = products.map(p => {
      const price = getDiscountedPrice(p);
      return `<div class="col-sm-6 col-lg-4 col-xl-3 mb-4"><div class="card-custom product-card h-100">
        <div class="product-img-wrap"><button class="wishlist-btn active" onclick="toggleWishlist(${p.id});render()"><i class="fas fa-heart"></i></button>
        <a href="<?= bc_url('product.php') ?>?id=${p.id}"><img src="${p.image}" alt="${p.name}"></a></div>
        <div class="product-body"><small class="text-muted-custom">${p.category}</small><h6 class="mt-1">${p.name}</h6>
        <div class="rating mb-2">${renderStars(p.rating)}</div>
        <div class="d-flex justify-content-between align-items-center"><span class="product-price">${formatPrice(price)}</span>
        <button class="btn btn-sm btn-primary-custom" onclick="addToCart(${p.id})"><i class="fas fa-cart-plus"></i></button></div></div></div></div>`;
    }).join('');
  }
  window.render = render;
  document.getElementById('addAllToCart').addEventListener('click', () => {
    JSON.parse(localStorage.getItem('bc-wishlist') || '[]').forEach(id => addToCart(id));
  });
  render();
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
