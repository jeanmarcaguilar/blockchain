<?php
$bc_title = 'Settings';
$bc_page = 'settings';
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
  <h4 class="mb-4">Staff Settings</h4>
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card-custom p-4 mb-4"><h5 class="mb-3">Notification Preferences</h5>
        <form data-simulate="Preferences saved!">
          <?php foreach (['New order alerts','Low stock warnings','Customer messages','Daily summary report'] as $p): ?>
          <div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" checked><label class="form-check-label"><?= $p ?></label></div>
          <?php endforeach; ?>
          <button type="submit" class="btn btn-primary-custom btn-sm">Save</button>
        </form>
      </div>
      <div class="card-custom p-4"><h5 class="mb-3">Change Password</h5>
        <form data-simulate="Password updated!">
          <div class="mb-3"><label class="form-label">Current Password</label><input type="password" class="form-control form-control-custom" required></div>
          <div class="mb-3"><label class="form-label">New Password</label><input type="password" class="form-control form-control-custom" minlength="8" required></div>
          <button type="submit" class="btn btn-primary-custom btn-sm">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</main>
</div></div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
