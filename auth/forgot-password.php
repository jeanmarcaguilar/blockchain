<?php
$bc_title = 'Forgot Password';
$bc_page = 'forgot-password';
$bc_dashboard = false;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="auth-wrapper">
  <div class="auth-card card-custom" data-aos="fade-up">
    <div class="text-center mb-4">
      <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3"><i class="fas fa-key"></i></div>
      <h2 class="mb-1">Forgot Password?</h2>
      <p class="text-muted-custom">Enter your email and we'll send you a reset link</p>
    </div>
    <form data-simulate="Password reset link sent! Check your email.">
      <div class="mb-4">
        <label class="form-label">Email Address</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" class="form-control form-control-custom" placeholder="you@email.com" required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary-custom w-100 btn-lg mb-3"><i class="fas fa-paper-plane me-2"></i>Send Reset Link</button>
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
