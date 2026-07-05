<?php
$bc_title = 'Profile';
$bc_page = 'profile';
$bc_role = 'customer';
$bc_user = 'Maria Santos';
$bc_avatar = 'https://i.pravatar.cc/150?u=maria';
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
    <div class="col-lg-4">
      <div class="card-custom p-4 text-center">
        <div class="position-relative d-inline-block mb-3">
          <img src="<?= $bc_avatar ?>" alt="Avatar" class="rounded-circle" width="120" height="120" id="profileAvatar" style="object-fit:cover">
          <label class="btn btn-primary-custom btn-sm rounded-circle position-absolute bottom-0 end-0" style="width:36px;height:36px;padding:0;line-height:36px" title="Upload avatar">
            <i class="fas fa-camera"></i>
            <input type="file" class="d-none" accept="image/*" id="avatarUpload">
          </label>
        </div>
        <h5 class="mb-1">Maria Santos</h5>
        <p class="text-muted-custom small mb-3">maria.santos@email.com</p>
        <span class="badge bg-success">Active Member</span>
        <div class="mt-4 pt-3 border-top text-start small">
          <div class="d-flex justify-content-between mb-2"><span class="text-muted-custom">Member since</span><span>Mar 2025</span></div>
          <div class="d-flex justify-content-between mb-2"><span class="text-muted-custom">Total orders</span><span>12</span></div>
          <div class="d-flex justify-content-between"><span class="text-muted-custom">Verified TXs</span><span>11</span></div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card-custom p-4">
        <h5 class="mb-4"><i class="fas fa-user-edit text-primary me-2"></i>Edit Profile</h5>
        <form data-simulate="Profile updated successfully!">
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">First Name</label><input type="text" class="form-control form-control-custom" value="Maria" required></div>
            <div class="col-md-6"><label class="form-label">Last Name</label><input type="text" class="form-control form-control-custom" value="Santos" required></div>
            <div class="col-md-6"><label class="form-label">Email</label><input type="email" class="form-control form-control-custom" value="maria.santos@email.com" required></div>
            <div class="col-md-6"><label class="form-label">Phone</label><input type="tel" class="form-control form-control-custom" value="+63 917 123 4567"></div>
            <div class="col-12"><label class="form-label">Shipping Address</label><textarea class="form-control form-control-custom" rows="2">123 Ayala Avenue, Makati City, Metro Manila 1226</textarea></div>
            <div class="col-md-6"><label class="form-label">City</label><input type="text" class="form-control form-control-custom" value="Makati City"></div>
            <div class="col-md-6"><label class="form-label">Postal Code</label><input type="text" class="form-control form-control-custom" value="1226"></div>
            <div class="col-12"><button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-2"></i>Save Changes</button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
</div></div>
<script>
document.getElementById('avatarUpload')?.addEventListener('change', e => {
  const file = e.target.files[0];
  if (file) { const reader = new FileReader(); reader.onload = ev => { document.getElementById('profileAvatar').src = ev.target.result; BC.toast('Avatar updated!'); }; reader.readAsDataURL(file); }
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
