<?php
require_once __DIR__ . '/../includes/config.php';
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: ' . bc_url('auth/login.php'));
  exit;
}
$bc_title = 'Checkout';
$bc_page = 'cart';
$bc_role = 'customer';
$bc_user = $_SESSION['user_name'] ?? 'Maria Santos';
$bc_avatar = $_SESSION['user_avatar'] ?? 'https://i.pravatar.cc/150?u=maria';
$bc_dashboard = true;
$bc_breadcrumb = ['Cart', 'Checkout'];
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <h4 class="mb-4"><i class="fas fa-credit-card text-primary me-2"></i>Checkout</h4>
  <form id="checkoutForm">
    <div class="row g-4">
      <div class="col-lg-8">
        <div class="card-custom p-4 mb-4">
          <h5 class="mb-3">Shipping Information</h5>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Full Name</label><input type="text" class="form-control form-control-custom" value="<?= htmlspecialchars($bc_user) ?>" required></div>
            <div class="col-md-6"><label class="form-label">Phone</label><input type="tel" class="form-control form-control-custom" value="+63 917 123 4567" required></div>
            <div class="col-12"><label class="form-label">Address</label><input type="text" class="form-control form-control-custom" value="123 Ayala Avenue, Makati City" required></div>
            <div class="col-md-6"><label class="form-label">City</label><input type="text" class="form-control form-control-custom" value="Makati City"></div>
            <div class="col-md-6"><label class="form-label">Postal Code</label><input type="text" class="form-control form-control-custom" value="1226"></div>
          </div>
        </div>
        <div class="card-custom p-4 mb-4">
          <h5 class="mb-3">Payment Method</h5>
          <div class="form-check card-custom p-3 mb-2 border-primary"><input class="form-check-input" type="radio" name="payment" id="cod" checked><label class="form-check-label w-100" for="cod"><strong><i class="fas fa-money-bill-wave me-2 text-success"></i>Cash on Delivery</strong><small class="d-block text-muted-custom">Pay when your order arrives</small></label></div>
        </div>
        <div class="blockchain-card">
          <div class="d-flex align-items-center gap-2 mb-3"><i class="fab fa-ethereum fa-lg"></i><h5 class="mb-0 text-white">Blockchain Verification</h5></div>
          <p class="opacity-90 small mb-3">Connect MetaMask to create an immutable order record on Sepolia Testnet. This verifies your purchase on the blockchain.</p>
          <button type="button" class="btn btn-light" id="connectMetaMask"><i class="fab fa-ethereum me-2"></i>Connect MetaMask</button>
          <div id="walletStatus" class="mt-3 small opacity-75"></div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card-custom p-4 sticky-top" style="top:90px">
          <h5 class="mb-3">Order Summary</h5>
          <div id="checkoutSummary"></div>
          <button type="submit" class="btn btn-primary-custom w-100 btn-lg mt-4"><i class="fas fa-check me-2"></i>Place Order</button>
        </div>
      </div>
    </div>
  </form>
</main>
</div></div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  if (!localStorage.getItem('bc-cart')) localStorage.setItem('bc-cart', JSON.stringify(BlockCartData.cart));
  const items = getCartItems();
  const subtotal = items.reduce((s,i) => s + i.lineTotal, 0);
  const tax = subtotal * BlockCartData.settings.taxRate;
  const shipping = subtotal > 5000 ? 0 : BlockCartData.settings.shippingFee;
  const total = subtotal + tax + shipping;
  document.getElementById('checkoutSummary').innerHTML = items.map(i => `<div class="d-flex justify-content-between small mb-2"><span>${i.name.substring(0,25)}... x${i.qty}</span><span>${formatPrice(i.lineTotal)}</span></div>`).join('') +
    `<hr><div class="d-flex justify-content-between mb-1"><span>Subtotal</span><span>${formatPrice(subtotal)}</span></div>
    <div class="d-flex justify-content-between mb-1"><span>Tax</span><span>${formatPrice(tax)}</span></div>
    <div class="d-flex justify-content-between mb-2"><span>Shipping</span><span>${shipping ? formatPrice(shipping) : 'FREE'}</span></div>
    <div class="d-flex justify-content-between fw-bold fs-5"><span>Total</span><span class="text-primary">${formatPrice(total)}</span></div>`;
  document.getElementById('connectMetaMask').addEventListener('click', async () => {
    const addr = await BCBlockchain.connectMetaMask();
    if (addr) document.getElementById('walletStatus').innerHTML = `<i class="fas fa-check-circle text-success"></i> Connected: ${addr.slice(0,8)}...${addr.slice(-6)}`;
  });
  document.getElementById('checkoutForm').addEventListener('submit', async e => {
    e.preventDefault();
    if (!BCBlockchain.contract || !BCBlockchain.web3) {
      BC.toast('Please connect MetaMask first to verify the transaction on the blockchain.', 'warning');
      return;
    }
    BC.showLoading();
    const orderId = 'BC-2026-' + String(Math.floor(Math.random()*90000)+10000);
    const txData = await BCBlockchain.createBlockchainRecord(orderId, total, BlockCartData.currentUser.customer.email);
    const newOrder = {
      id: orderId,
      date: new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }),
      customer: BlockCartData.currentUser.customer.name,
      items: items.length,
      total: total,
      status: 'pending',
      payment: 'Cash on Delivery',
      verified: true,
      txHash: txData.txHash,
      blockNumber: txData.blockNumber
    };
    // Save order to localStorage
    let orders = JSON.parse(localStorage.getItem('bc-orders') || '[]');
    orders.unshift(newOrder);
    localStorage.setItem('bc-orders', JSON.stringify(orders));
    
    localStorage.setItem('bc-cart', '[]');
    updateCartBadge();
    BC.hideLoading();
    BC.toast('Order placed successfully!');
    setTimeout(() => location.href = 'order-details.php?id=' + orderId, 1500);
  });
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
