<?php
$bc_title = 'Customers';
$bc_page = 'users';
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
  <div class="d-flex justify-content-between mb-4"><div><h4 class="mb-1">Customer Management</h4><p class="text-muted-custom">Manage registered customers</p></div></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Customer</th><th>Email</th><th>Phone</th><th>Orders</th><th>Joined</th><th>Status</th><th>Actions</th></tr></thead><tbody id="customersTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('customersTable').innerHTML = BlockCartData.users.customers.map(u => `
    <tr><td><div class="d-flex align-items-center gap-2"><img src="${u.avatar}" class="rounded-circle" width="36" height="36"><strong>${u.name}</strong></div></td>
    <td>${u.email}</td><td>${u.phone}</td><td>${u.orders}</td><td>${u.joined}</td>
    <td>${u.status === 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Suspended</span>'}</td>
    <td><button class="btn btn-sm btn-outline-custom" onclick="BC.toast('View ${u.name}','info')"><i class="fas fa-eye"></i></button>
    ${u.status === 'active' ? `<button class="btn btn-sm btn-outline-warning" onclick="BC.toast('User suspended','warning')"><i class="fas fa-ban"></i></button>` : `<button class="btn btn-sm btn-outline-success" onclick="BC.toast('User activated')"><i class="fas fa-check"></i></button>`}</td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
