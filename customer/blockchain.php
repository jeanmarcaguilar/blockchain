<?php
$bc_title = 'Blockchain Verification';
$bc_page = 'blockchain';
$bc_role = 'customer';
require_once __DIR__ . '/../includes/config.php';
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: ' . bc_url('auth/login.php'));
  exit;
}
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
  <div class="mb-4"><h4 class="mb-1">Blockchain Verification</h4><p class="text-muted-custom">Verify your orders on the Ethereum Sepolia testnet</p></div>
  <div class="row g-4 mb-4">
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-check-circle"></i></div><div><div class="stat-value" id="bcVerified">—</div><div class="stat-label">Verified</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fab fa-ethereum"></i></div><div><div class="stat-label">Network</div><div class="fw-bold">Sepolia</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-info bg-opacity-10 text-info"><i class="fas fa-file-contract"></i></div><div><div class="stat-label">Contract</div><div class="small tx-hash" id="bcContract"></div></div></div></div>
  </div>
  <div class="card-custom p-4 mb-4">
    <h5 class="mb-3"><i class="fab fa-ethereum me-2"></i>Connect MetaMask</h5>
    <p class="text-muted-custom small">Connect your wallet to verify transactions on-chain</p>
    <button class="btn btn-primary-custom" id="connectWallet"><i class="fab fa-ethereum me-2"></i>Connect MetaMask</button>
    <span id="walletInfo" class="ms-3 small text-muted-custom"></span>
  </div>
  <div class="card-custom p-4 mb-4">
    <h5 class="mb-3">Verify by Order ID</h5>
    <form id="verifyForm" class="row g-2"><div class="col-md-8"><input type="text" class="form-control form-control-custom" id="verifyOrderId" placeholder="Enter order ID (e.g. BC-2026-00142)" required></div>
    <div class="col-md-4"><button type="submit" class="btn btn-primary-custom w-100"><i class="fas fa-shield-alt me-2"></i>Verify</button></div></form>
    <div id="verifyResult" class="mt-4"></div>
  </div>
  <div class="card-custom p-4">
    <h5 class="mb-3">Your Blockchain Transactions</h5>
    <div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Order ID</th><th>TX Hash</th><th>Block</th><th>Amount</th><th>Status</th><th></th></tr></thead><tbody id="bcTxTable"></tbody></table></div>
  </div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const localBc = JSON.parse(localStorage.getItem('bc-blockchain') || '{}');
  const localTx = Object.keys(localBc).map(orderId => ({
    orderId,
    txHash: localBc[orderId].txHash,
    blockNumber: localBc[orderId].blockNumber,
    amount: localBc[orderId].amount || 0,
    status: localBc[orderId].verified ? 'verified' : 'pending',
    timestamp: localBc[orderId].timestamp,
    customerHash: localBc[orderId].customerHash
  }));
  const myTx = [...localTx, ...BlockCartData.blockchainTx];
  document.getElementById('bcVerified').textContent = myTx.length;
  document.getElementById('bcContract').textContent = BlockCartData.settings.contractAddress.slice(0,10) + '...';
  document.getElementById('bcTxTable').innerHTML = myTx.map(t => `
    <tr><td><strong>${t.orderId}</strong></td><td><code class="small">${t.txHash.slice(0,16)}...</code></td><td>#${t.blockNumber}</td><td>${formatPrice(t.amount)}</td><td>${getStatusBadge(t.status)}</td>
    <td><button class="btn btn-sm btn-outline-custom" onclick="document.getElementById('verifyOrderId').value='${t.orderId}';document.getElementById('verifyForm').dispatchEvent(new Event('submit'))">Verify</button></td></tr>`).join('');
  document.getElementById('connectWallet').addEventListener('click', async () => {
    const addr = await BCBlockchain.connectMetaMask();
    if (addr) document.getElementById('walletInfo').textContent = 'Connected: ' + addr.slice(0,8) + '...';
  });
  document.getElementById('verifyForm').addEventListener('submit', async e => {
    e.preventDefault();
    const id = document.getElementById('verifyOrderId').value.trim();
    BC.showLoading();
    const verified = await BCBlockchain.verifyTransaction(id);
    BC.hideLoading();
    document.getElementById('verifyResult').innerHTML = verified ? BCBlockchain.renderVerificationCard(id) : '<div class="alert alert-warning">No blockchain record found for this order.</div>';
  });
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
