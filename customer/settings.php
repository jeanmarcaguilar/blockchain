<?php
$bc_title = 'Settings';
$bc_page = 'settings';
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
  <h4 class="mb-4">Account Settings</h4>
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="card-custom p-4 mb-4">
        <h5 class="mb-3"><i class="fas fa-bell text-primary me-2"></i>Notification Preferences</h5>
        <form data-simulate="Notification preferences saved!">
          <?php foreach (['Order updates','Shipping notifications','Promotional emails','Blockchain verification alerts','Review reminders'] as $pref): ?>
          <div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" id="pref<?= md5($pref) ?>" checked><label class="form-check-label" for="pref<?= md5($pref) ?>"><?= $pref ?></label></div>
          <?php endforeach; ?>
          <button type="submit" class="btn btn-primary-custom btn-sm">Save Preferences</button>
        </form>
      </div>
      <div class="card-custom p-4">
        <h5 class="mb-3"><i class="fas fa-lock text-danger me-2"></i>Change Password</h5>
        <form data-simulate="Password changed successfully!">
          <div class="mb-3"><label class="form-label">Current Password</label><input type="password" class="form-control form-control-custom" required></div>
          <div class="mb-3"><label class="form-label">New Password</label><input type="password" class="form-control form-control-custom" minlength="8" required></div>
          <div class="mb-3"><label class="form-label">Confirm New Password</label><input type="password" class="form-control form-control-custom" required></div>
          <button type="submit" class="btn btn-primary-custom btn-sm">Update Password</button>
        </form>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card-custom p-4 mb-4">
        <h6 class="mb-3">Privacy</h6>
        <div class="form-check form-switch mb-2"><input class="form-check-input" type="checkbox" checked><label class="form-check-label small">Show profile to others</label></div>
        <div class="form-check form-switch"><input class="form-check-input" type="checkbox"><label class="form-check-label small">Share purchase history</label></div>
      </div>
      <div class="card-custom p-4 border-danger">
        <h6 class="text-danger mb-2">Danger Zone</h6>
        <p class="text-muted-custom small">Permanently delete your account and all data.</p>
        <button class="btn btn-outline-danger btn-sm" data-confirm="Are you sure you want to delete your account?">Delete Account</button>
      </div>
    </div>
  </div>
</main>
</div></div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
