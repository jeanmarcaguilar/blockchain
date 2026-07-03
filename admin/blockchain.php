<?php
$bc_title = 'Blockchain';
$bc_page = 'blockchain';
$bc_role = 'admin';
$bc_user = 'Admin User';
$bc_avatar = 'https://i.pravatar.cc/150?u=admin';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="mb-4"><h4 class="mb-1">Blockchain Transactions</h4><p class="text-muted-custom">All on-chain verification records</p></div>
  <div class="row g-4 mb-4">
    <div class="col-md-4"><div class="blockchain-card"><small class="opacity-75">Contract Address</small><div class="tx-hash mt-1" id="adminContract"></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fas fa-link"></i></div><div><div class="stat-value" id="totalTx">—</div><div class="stat-label">Total Transactions</div></div></div></div>
    <div class="col-md-4"><div class="stat-card"><div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fab fa-ethereum"></i></div><div><div class="stat-label">Network</div><div class="fw-bold">Sepolia Testnet</div></div></div></div>
  </div>
  <div class="card-custom p-4 mb-4"><h5 class="mb-3">Weekly Transaction Activity</h5><div style="height:260px"><canvas id="blockchainChart"></canvas></div></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>ID</th><th>Order ID</th><th>TX Hash</th><th>Block #</th><th>Amount</th><th>Customer Hash</th><th>Timestamp</th><th>Status</th><th></th></tr></thead><tbody id="adminBcTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('adminContract').textContent = BlockCartData.settings.contractAddress;
  document.getElementById('totalTx').textContent = BlockCartData.blockchainTx.length;
  document.getElementById('adminBcTable').innerHTML = BlockCartData.blockchainTx.map(t => `
    <tr><td>${t.id}</td><td><strong>${t.orderId}</strong></td><td><code class="small">${t.txHash.slice(0,20)}...</code></td><td>#${t.blockNumber}</td><td>${formatPrice(t.amount)}</td><td><code class="small">${t.customerHash}</code></td><td>${t.timestamp}</td><td>${getStatusBadge(t.status)}</td>
    <td><a href="https://sepolia.etherscan.io/tx/${t.txHash}" target="_blank" class="btn btn-sm btn-outline-custom"><i class="fas fa-external-link-alt"></i></a></td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
