<?php
$bc_title = 'Blockchain';
$bc_page = 'blockchain';
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
  <div class="mb-4"><h4 class="mb-1">Verify Transactions</h4><p class="text-muted-custom">Staff blockchain verification portal</p></div>
  <div class="card-custom p-4 mb-4">
    <form id="staffVerifyForm" class="row g-2"><div class="col-md-8"><input type="text" class="form-control form-control-custom" id="staffOrderId" placeholder="Enter order ID to verify" required></div>
    <div class="col-md-4"><button type="submit" class="btn btn-primary-custom w-100"><i class="fas fa-shield-alt me-2"></i>Verify on Chain</button></div></form>
    <div id="staffVerifyResult" class="mt-4"></div>
  </div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Order ID</th><th>TX Hash</th><th>Block</th><th>Amount</th><th>Timestamp</th><th>Status</th><th>Action</th></tr></thead><tbody id="staffBcTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('staffBcTable').innerHTML = BlockCartData.blockchainTx.map(t => `
    <tr><td><strong>${t.orderId}</strong></td><td><code class="small">${t.txHash.slice(0,20)}...</code></td><td>#${t.blockNumber}</td><td>${formatPrice(t.amount)}</td><td>${t.timestamp}</td><td>${getStatusBadge(t.status)}</td>
    <td><button class="btn btn-sm btn-outline-custom" onclick="BCBlockchain.verifyOnChain('${t.orderId}')">Re-verify</button></td></tr>`).join('');
  document.getElementById('staffVerifyForm').addEventListener('submit', async e => {
    e.preventDefault();
    const id = document.getElementById('staffOrderId').value.trim();
    BC.showLoading();
    const verified = await BCBlockchain.verifyTransaction(id);
    BC.hideLoading();
    document.getElementById('staffVerifyResult').innerHTML = verified ? BCBlockchain.renderVerificationCard(id) : '<div class="alert alert-warning">No record found.</div>';
  });
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
