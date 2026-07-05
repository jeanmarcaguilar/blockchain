<?php
$bc_title = 'Register';
$bc_page = 'register';
$bc_dashboard = false;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="auth-wrapper">
  <div class="auth-card card-custom" data-aos="fade-up">
    <div class="text-center mb-4">
      <a href="<?= bc_url('index.php') ?>" class="text-decoration-none"><i class="fas fa-cube fa-2x text-primary"></i></a>
      <h2 class="mt-3 mb-1">Create Account</h2>
      <p class="text-muted-custom">Join BlockCart for secure blockchain-verified shopping</p>
    </div>
    <form data-simulate="Account created! Please check your email to verify.">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">First Name</label>
          <input type="text" class="form-control form-control-custom" placeholder="Maria" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Last Name</label>
          <input type="text" class="form-control form-control-custom" placeholder="Santos" required>
        </div>
        <div class="col-12">
          <label class="form-label">Email Address</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control form-control-custom" placeholder="you@email.com" required>
          </div>
        </div>
        <div class="col-12">
          <label class="form-label">Phone Number</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
            <input type="tel" class="form-control form-control-custom" placeholder="+63 917 000 0000" required>
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Password</label>
          <input type="password" class="form-control form-control-custom" placeholder="Min. 8 characters" minlength="8" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Confirm Password</label>
          <input type="password" class="form-control form-control-custom" placeholder="Confirm password" required>
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
            <label class="form-check-label small" for="agreeTerms">I agree to the <a href="<?= bc_url('terms.php') ?>">Terms of Service</a> and <a href="<?= bc_url('privacy.php') ?>">Privacy Policy</a></label>
          </div>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary-custom w-100 btn-lg"><i class="fas fa-user-plus me-2"></i>Create Account</button>
        </div>
      </div>
    </form>
    <div class="text-center mt-4">
      <p class="text-muted-custom small mb-0">Already have an account? <a href="<?= bc_url('auth/login.php') ?>">Sign in</a></p>
    </div>
    <div class="text-center mt-3 pt-3 border-top">
      <button class="theme-toggle btn btn-link btn-sm"><i class="fas fa-moon"></i></button>
      <a href="<?= bc_url('index.php') ?>" class="btn btn-link btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to Store</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
