<?php
$bc_title = 'Reviews';
$bc_page = 'reviews';
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
  <div class="mb-4"><h4 class="mb-1">Review Moderation</h4><p class="text-muted-custom">Approve or reject customer reviews</p></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Product</th><th>Customer</th><th>Rating</th><th>Comment</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead><tbody id="reviewsTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('reviewsTable').innerHTML = BlockCartData.reviews.map(r => `
    <tr><td>${r.product}</td><td>${r.customer}</td><td><div class="rating">${renderStars(r.rating)}</div></td><td style="max-width:250px">${r.comment}</td><td>${r.date}</td>
    <td>${r.status === 'approved' ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-warning text-dark">Pending</span>'}</td>
    <td>${r.status === 'pending' ? `<button class="btn btn-sm btn-success" onclick="BC.toast('Review approved')"><i class="fas fa-check"></i></button> <button class="btn btn-sm btn-danger" onclick="BC.toast('Review rejected','warning')"><i class="fas fa-times"></i></button>` : '—'}</td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
