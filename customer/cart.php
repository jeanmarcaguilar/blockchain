<?php
$bc_title = 'Shopping Cart';
$bc_page = 'cart';
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
  <h4 class="mb-4">Shopping Cart</h4>
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card-custom" id="cartItems"><div class="p-5 text-center"><div class="loading-spinner mx-auto"></div></div></div>
    </div>
    <div class="col-lg-4">
      <div class="card-custom p-4 sticky-top" style="top:90px">
        <h5 class="mb-4">Order Summary</h5>
        <div id="cartSummary"></div>
        <a href="checkout.php" class="btn btn-primary-custom w-100 btn-lg mt-3" id="checkoutBtn"><i class="fas fa-lock me-2"></i>Proceed to Checkout</a>
        <a href="<?= bc_url('shop.php') ?>" class="btn btn-outline-custom w-100 mt-2">Continue Shopping</a>
      </div>
    </div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  function renderCart() {
    const items = getCartItems();
    const container = document.getElementById('cartItems');
    if (!items.length) {
      container.innerHTML = '<div class="p-5 text-center"><i class="fas fa-shopping-cart fa-3x text-muted-custom mb-3"></i><h5>Your cart is empty</h5><a href="<?= bc_url('shop.php') ?>" class="btn btn-primary-custom mt-3">Start Shopping</a></div>';
      document.getElementById('cartSummary').innerHTML = '';
      document.getElementById('checkoutBtn').classList.add('disabled');
      return;
    }
    container.innerHTML = `<div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th><th></th></tr></thead><tbody>
      ${items.map(item => `<tr><td><div class="d-flex align-items-center gap-3"><img src="${item.image}" width="60" height="60" class="rounded" style="object-fit:cover"><div><strong>${item.name}</strong><br><small class="text-muted-custom">${item.sku}</small></div></div></td>
      <td>${formatPrice(getDiscountedPrice(item))}</td><td><input type="number" class="form-control form-control-custom" style="width:70px" value="${item.qty}" min="1" onchange="updateQty(${item.id},this.value)"></td>
      <td>${formatPrice(item.lineTotal)}</td><td><button class="btn btn-sm btn-link text-danger" onclick="removeItem(${item.id})"><i class="fas fa-trash"></i></button></td></tr>`).join('')}
    </tbody></table></div>`;
    const subtotal = items.reduce((s,i) => s + i.lineTotal, 0);
    const tax = subtotal * BlockCartData.settings.taxRate;
    const shipping = subtotal > 5000 ? 0 : BlockCartData.settings.shippingFee;
    const total = subtotal + tax + shipping;
    document.getElementById('cartSummary').innerHTML = `
      <div class="d-flex justify-content-between mb-2"><span>Subtotal (${items.length} items)</span><span>${formatPrice(subtotal)}</span></div>
      <div class="d-flex justify-content-between mb-2"><span>Tax (12%)</span><span>${formatPrice(tax)}</span></div>
      <div class="d-flex justify-content-between mb-2"><span>Shipping</span><span>${shipping ? formatPrice(shipping) : 'FREE'}</span></div>
      <hr><div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span class="text-primary">${formatPrice(total)}</span></div>`;
  }
  window.updateQty = (id, qty) => { let cart = JSON.parse(localStorage.getItem('bc-cart')||'[]'); const item = cart.find(i=>i.productId===id); if(item){item.qty=+qty; localStorage.setItem('bc-cart',JSON.stringify(cart)); updateCartBadge(); renderCart();} };
  window.removeItem = (id) => { let cart = JSON.parse(localStorage.getItem('bc-cart')||'[]').filter(i=>i.productId!==id); localStorage.setItem('bc-cart',JSON.stringify(cart)); updateCartBadge(); BC.toast('Item removed','info'); renderCart(); };
  if (!localStorage.getItem('bc-cart')) localStorage.setItem('bc-cart', JSON.stringify(BlockCartData.cart));
  renderCart();
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
