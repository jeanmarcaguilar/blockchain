<?php
$bc_title = 'Verify Email';
$bc_page = 'verify-email';
$bc_dashboard = false;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="auth-wrapper">
  <div class="auth-card card-custom text-center" data-aos="fade-up">
    <div class="stat-icon bg-info bg-opacity-10 text-info mx-auto mb-4"><i class="fas fa-envelope-open-text fa-2x"></i></div>
    <h2 class="mb-2">Verify Your Email</h2>
    <p class="text-muted-custom mb-4">We've sent a verification link to <strong>maria.santos@email.com</strong>. Please check your inbox and click the link to activate your account.</p>
    <div class="card-custom p-3 bg-light mb-4 text-start">
      <small class="text-muted-custom d-block mb-2"><i class="fas fa-info-circle me-1"></i> Didn't receive the email?</small>
      <ul class="small text-muted-custom mb-0 ps-3">
        <li>Check your spam or junk folder</li>
        <li>Make sure the email address is correct</li>
        <li>Wait a few minutes and try again</li>
      </ul>
    </div>
    <form data-simulate="Verification email resent!" class="mb-3">
      <button type="submit" class="btn btn-primary-custom w-100"><i class="fas fa-redo me-2"></i>Resend Verification Email</button>
    </form>
    <a href="<?= bc_url('auth/login.php') ?>" class="btn btn-outline-custom w-100"><i class="fas fa-sign-in-alt me-2"></i>Go to Login</a>
    <div class="mt-4 pt-3 border-top">
      <button class="theme-toggle btn btn-link btn-sm"><i class="fas fa-moon"></i></button>
      <a href="<?= bc_url('index.php') ?>" class="btn btn-link btn-sm">Back to Store</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
