<?php
require_once __DIR__ . '/../includes/config.php';
session_start();
$bc_title = 'Login';
$bc_page = 'login';
$bc_dashboard = false;

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $role = $_POST['role'] ?? 'customer';
  
  // Set session variables
  $_SESSION['logged_in'] = true;
  $_SESSION['user_email'] = $email;
  $_SESSION['user_role'] = $role;
  
  // Set user name based on role
  if ($role === 'customer') {
    $_SESSION['user_name'] = 'Maria Santos';
    $_SESSION['user_avatar'] = 'https://i.pravatar.cc/150?u=maria';
  } elseif ($role === 'staff') {
    $_SESSION['user_name'] = 'John Reyes';
    $_SESSION['user_avatar'] = 'https://i.pravatar.cc/150?u=john';
  } elseif ($role === 'admin') {
    $_SESSION['user_name'] = 'Admin';
    $_SESSION['user_avatar'] = 'https://i.pravatar.cc/150?u=admin';
  }
  
  // Redirect based on role
  $redirectUrls = [
    'customer' => 'customer/dashboard.php',
    'staff' => 'staff/dashboard.php',
    'admin' => 'admin/dashboard.php'
  ];
  $redirectUrl = $redirectUrls[$role] ?? 'index.php';
  
  header('Location: ' . bc_url($redirectUrl));
  exit;
}

require_once __DIR__ . '/../includes/head.php';
?>
<div class="auth-wrapper">
  <div class="auth-card card-custom" data-aos="fade-up">
    <div class="text-center mb-4">
      <a href="<?= bc_url('index.php') ?>" class="text-decoration-none"><i class="fas fa-cube fa-2x text-primary"></i></a>
      <h2 class="mt-3 mb-1">Welcome Back</h2>
      <p class="text-muted-custom">Sign in to your BlockCart account</p>
    </div>
    <ul class="nav nav-pills nav-fill mb-4 auth-tabs" role="tablist">
      <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tabCustomer">Customer</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tabStaff">Staff</button></li>
      <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tabAdmin">Admin</button></li>
    </ul>
    <div class="tab-content">
      <?php foreach ([
        ['id'=>'Customer','role'=>'customer','url'=>'customer/dashboard.php','demo'=>'maria.santos@email.com'],
        ['id'=>'Staff','role'=>'staff','url'=>'staff/dashboard.php','demo'=>'john.reyes@blockcart.com'],
        ['id'=>'Admin','role'=>'admin','url'=>'admin/dashboard.php','demo'=>'admin@blockcart.com']
      ] as $tab): ?>
      <div class="tab-pane fade <?= $tab['id']==='Customer'?'show active':'' ?>" id="tab<?= $tab['id'] ?>">
        <form method="POST" action="">
          <input type="hidden" name="role" value="<?= $tab['role'] ?>">
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" name="email" class="form-control form-control-custom" value="<?= $tab['demo'] ?>" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
              <input type="password" class="form-control form-control-custom" value="password123" required>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check"><input class="form-check-input" type="checkbox" id="remember<?= $tab['id'] ?>"><label class="form-check-label small" for="remember<?= $tab['id'] ?>">Remember me</label></div>
            <a href="<?= bc_url('auth/forgot-password.php') ?>" class="small">Forgot password?</a>
          </div>
          <button type="submit" class="btn btn-primary-custom w-100 btn-lg mb-3"><i class="fas fa-sign-in-alt me-2"></i>Sign In as <?= $tab['id'] ?></button>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-3">
      <p class="text-muted-custom small mb-0">Don't have an account? <a href="<?= bc_url('auth/register.php') ?>">Create one</a></p>
    </div>
    <div class="text-center mt-4 pt-3 border-top">
      <button class="theme-toggle btn btn-link btn-sm" title="Toggle dark mode"><i class="fas fa-moon"></i></button>
      <a href="<?= bc_url('index.php') ?>" class="btn btn-link btn-sm"><i class="fas fa-arrow-left me-1"></i>Back to Store</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
