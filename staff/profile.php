<?php
$bc_title = 'Profile';
$bc_page = 'profile';
$bc_role = 'staff';
$bc_user = 'John Reyes';
$bc_avatar = 'https://i.pravatar.cc/150?u=john';
$bc_dashboard = true;
$bc_breadcrumb = ['Account', 'Profile'];
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="row g-4">
    <div class="col-lg-4"><div class="card-custom p-4 text-center"><img src="<?= $bc_avatar ?>" class="rounded-circle mb-3" width="120" height="120"><h5>John Reyes</h5><p class="text-primary small">Order Manager</p><span class="badge bg-success">Active</span></div></div>
    <div class="col-lg-8"><div class="card-custom p-4"><h5 class="mb-4">Edit Profile</h5>
      <form data-simulate="Profile updated!"><div class="row g-3">
        <div class="col-md-6"><label class="form-label">Full Name</label><input type="text" class="form-control form-control-custom" value="John Reyes"></div>
        <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control form-control-custom" value="john.reyes@blockcart.com"></div>
        <div class="col-md-6"><label class="form-label">Role</label><input type="text" class="form-control form-control-custom" value="Order Manager" readonly></div>
        <div class="col-md-6"><label class="form-label">Department</label><input type="text" class="form-control form-control-custom" value="Operations"></div>
        <div class="col-12"><button type="submit" class="btn btn-primary-custom">Save Changes</button></div>
      </div></form></div></div>
  </div>
</main>
</div></div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
