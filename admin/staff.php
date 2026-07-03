<?php
$bc_title = 'Staff';
$bc_page = 'staff';
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
  <div class="d-flex justify-content-between mb-4"><h4 class="mb-0">Staff Management</h4><button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addStaffModal"><i class="fas fa-user-plus me-2"></i>Add Staff</button></div>
  <div class="row g-4 mb-4" id="staffCards"></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Staff</th><th>Email</th><th>Role</th><th>Orders Handled</th><th>Status</th><th>Actions</th></tr></thead><tbody id="staffTable"></tbody></table></div></div>
</main>
</div></div>
<div class="modal fade" id="addStaffModal"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title">Add Staff Member</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
  <form data-simulate="Staff member added!"><div class="modal-body"><div class="mb-3"><label class="form-label">Full Name</label><input type="text" class="form-control form-control-custom" required></div>
  <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control form-control-custom" required></div>
  <div class="mb-3"><label class="form-label">Role</label><select class="form-select form-select-custom"><option>Order Manager</option><option>Inventory Manager</option><option>Support Agent</option></select></div></div>
  <div class="modal-footer"><button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary-custom">Add Staff</button></div></form>
</div></div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('staffCards').innerHTML = BlockCartData.users.staff.map(s => `
    <div class="col-md-6"><div class="card-custom p-3 d-flex align-items-center gap-3"><img src="${s.avatar}" class="rounded-circle" width="56" height="56"><div><h6 class="mb-0">${s.name}</h6><small class="text-muted-custom">${s.role} · ${s.orders} orders</small></div></div></div>`).join('');
  document.getElementById('staffTable').innerHTML = BlockCartData.users.staff.map(s => `
    <tr><td><div class="d-flex align-items-center gap-2"><img src="${s.avatar}" class="rounded-circle" width="36" height="36">${s.name}</div></td><td>${s.email}</td><td>${s.role}</td><td>${s.orders}</td>
    <td><span class="badge bg-success">Active</span></td><td><button class="btn btn-sm btn-outline-custom" onclick="BC.toast('Edit ${s.name}','info')"><i class="fas fa-edit"></i></button></td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
