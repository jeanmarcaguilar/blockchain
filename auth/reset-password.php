<?php
$bc_title = 'Reset Password';
$bc_page = 'reset-password';
$bc_dashboard = false;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="auth-wrapper">
  <div class="auth-card card-custom" data-aos="fade-up">
    <div class="text-center mb-4">
      <div class="stat-icon bg-success bg-opacity-10 text-success mx-auto mb-3"><i class="fas fa-lock-open"></i></div>
      <h2 class="mb-1">Reset Password</h2>
      <p class="text-muted-custom">Create a new password for your account</p>
    </div>
    <form data-simulate="Password updated successfully! You can now sign in.">
      <div class="mb-3">
        <label class="form-label">New Password</label>
        <input type="password" class="form-control form-control-custom" placeholder="Min. 8 characters" minlength="8" required>
        <div class="progress mt-2" style="height:4px"><div class="progress-bar bg-success" style="width:60%"></div></div>
        <small class="text-muted-custom">Use 8+ characters with letters, numbers & symbols</small>
      </div>
      <div class="mb-4">
        <label class="form-label">Confirm New Password</label>
        <input type="password" class="form-control form-control-custom" placeholder="Confirm password" required>
      </div>
      <button type="submit" class="btn btn-primary-custom w-100 btn-lg mb-3"><i class="fas fa-check me-2"></i>Update Password</button>
    </form>
    <div class="text-center">
      <a href="<?= bc_url('auth/login.php') ?>" class="small"><i class="fas fa-arrow-left me-1"></i>Back to Login</a>
    </div>
    <div class="text-center mt-4 pt-3 border-top">
      <button class="theme-toggle btn btn-link btn-sm"><i class="fas fa-moon"></i></button>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
