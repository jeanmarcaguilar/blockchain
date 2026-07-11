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

  $_SESSION['logged_in'] = true;
  $_SESSION['user_email'] = $email;
  $_SESSION['user_role'] = $role;

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

  // Check if there's a redirect URL stored in session or from form
  $redirectUrl = $_POST['redirect'] ?? $_SESSION['redirect_after_login'] ?? null;

  if (!$redirectUrl) {
    $redirectUrls = [
      'customer' => 'customer/dashboard.php',
      'staff' => 'staff/dashboard.php',
      'admin' => 'admin/dashboard.php'
    ];
    $redirectUrl = $redirectUrls[$role] ?? 'index.php';
  }

  // Clear the redirect from session
  unset($_SESSION['redirect_after_login']);

  header('Location: ' . bc_url($redirectUrl));
  exit;
}

// Store the intended redirect URL if provided in query parameter
if (isset($_GET['redirect'])) {
  $_SESSION['redirect_after_login'] = $_GET['redirect'];
}

require_once __DIR__ . '/../includes/head.php';
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
  href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap"
  rel="stylesheet">

<style>
  :root {
    --uw-bg: #F7F8FA;
    --uw-green: #2C3B4D;
    --uw-green-2: #1B2632;
    --uw-green-3: #22303F;
    --uw-blob: #E4E8ED;
    --uw-teal: #D4A857;
    --uw-teal-light: #E8C97E;
    --uw-text-dark: #1F2933;
    --uw-muted-dark: #6B7686;
    --uw-text-light: #F2F4F7;
    --uw-muted-light: #9AA7B5;
  }

  body {
    background: var(--uw-bg);
  }

  .uw-shell {
    position: relative;
    min-height: 100vh;
    display: flex;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
  }

  .uw-wave-svg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    display: block;
  }

  /* ---------- LEFT: brand / illustration ---------- */
  .uw-left {
    position: relative;
    z-index: 1;
    width: 45%;
    padding: 2.75rem 3rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 100vh;
  }

  .uw-brand {
    display: flex;
    align-items: center;
    gap: .6rem;
    color: var(--uw-text-dark);
  }

  .uw-brand .uw-brand-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--uw-green);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--uw-teal-light);
    font-size: 1rem;
  }

  .uw-brand-text {
    line-height: 1.1;
  }

  .uw-brand-text strong {
    display: block;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: .95rem;
    letter-spacing: .02em;
  }

  .uw-brand-text span {
    display: block;
    font-size: .68rem;
    color: var(--uw-muted-dark);
    letter-spacing: .04em;
  }

  .uw-illustration {
    position: relative;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem 0;
  }

  .uw-illustration svg,
  .uw-illustration dotlottie-wc {
    width: 100%;
    max-width: 580px;
    height: auto;
  }

  .uw-blob-glow {
    animation: uw-drift 7s ease-in-out infinite;
  }

  @keyframes uw-drift {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-6px);
    }
  }

  .uw-facet-glint {
    animation: uw-sweep 5s ease-in-out infinite;
  }

  @keyframes uw-sweep {

    0%,
    100% {
      opacity: .18;
    }

    50% {
      opacity: .55;
    }
  }

  .uw-footer-left {
    color: var(--uw-muted-dark);
    font-size: .72rem;
    line-height: 1.6;
  }

  /* ---------- RIGHT: form ---------- */
  .uw-right {
    position: relative;
    z-index: 1;
    width: 55%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    min-height: 100vh;
  }

  .uw-right-inner {
    width: 100%;
    max-width: 380px;
  }

  .uw-right-inner h1 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 2.6rem;
    color: var(--uw-text-light);
    margin-bottom: 1.75rem;
  }

  .uw-role-tabs {
    display: flex;
    background: var(--uw-green-3);
    border-radius: 999px;
    padding: 4px;
    gap: 4px;
    margin-bottom: 1.5rem;
  }

  .uw-role-tabs .nav-link {
    flex: 1;
    text-align: center;
    font-size: .78rem;
    font-weight: 500;
    color: var(--uw-muted-light);
    background: transparent;
    border: none;
    border-radius: 999px;
    padding: .5rem 0;
    transition: all .18s ease;
  }

  .uw-role-tabs .nav-link.active {
    background: var(--uw-teal);
    color: #1B2632;
  }

  .uw-role-tabs .nav-link:not(.active):hover {
    color: var(--uw-text-light);
  }

  .uw-field {
    margin-bottom: 1.25rem;
  }

  .uw-field label {
    display: block;
    font-size: .82rem;
    font-weight: 500;
    color: var(--uw-muted-light);
    margin-bottom: .5rem;
  }

  .uw-field .form-control {
    background: var(--uw-green-3);
    border: 1px solid transparent;
    border-radius: 999px;
    color: var(--uw-text-light);
    padding: .8rem 1.3rem;
    font-size: .9rem;
  }

  .uw-field .form-control::placeholder {
    color: var(--uw-muted-light);
    opacity: .7;
  }

  .uw-field .form-control:focus {
    background: var(--uw-green-3);
    color: var(--uw-text-light);
    box-shadow: none;
    border-color: var(--uw-teal);
  }

  .uw-row-end {
    text-align: right;
    margin-bottom: 1.6rem;
  }

  .uw-row-end a {
    color: var(--uw-muted-light);
    font-size: .8rem;
    text-decoration: none;
  }

  .uw-row-end a:hover {
    color: var(--uw-teal-light);
  }

  .uw-submit {
    width: 100%;
    background: linear-gradient(135deg, var(--uw-teal), var(--uw-teal-light));
    color: #1B2632;
    border: none;
    font-weight: 600;
    font-size: .95rem;
    padding: .85rem 0;
    border-radius: 999px;
    transition: filter .18s ease;
  }

  .uw-submit:hover {
    filter: brightness(1.06);
    color: #1B2632;
  }

  .uw-register-note {
    text-align: center;
    font-size: .85rem;
    color: var(--uw-muted-light);
    margin-top: 1.5rem;
  }

  .uw-register-note a {
    color: var(--uw-text-light);
    text-decoration: underline;
    text-underline-offset: 3px;
  }

  .uw-terms {
    text-align: center;
    margin-top: 2.25rem;
  }

  .uw-terms a {
    color: var(--uw-muted-light);
    font-size: .8rem;
    text-decoration: underline;
    text-underline-offset: 3px;
  }

  .uw-terms a:hover {
    color: var(--uw-teal-light);
  }

  .uw-footer-right {
    position: absolute;
    right: 3rem;
    bottom: 2rem;
    text-align: right;
    font-size: .72rem;
    color: var(--uw-muted-light);
    line-height: 1.6;
  }

  .uw-footer-right a {
    color: var(--uw-teal-light);
    text-decoration: none;
  }

  @media (max-width: 991px) {
    .uw-shell {
      flex-direction: column;
    }

    .uw-wave-svg {
      display: none;
    }

    .uw-left {
      width: 100%;
      background: var(--uw-bg);
      min-height: auto;
      padding: 2rem;
    }

    .uw-right {
      width: 100%;
      background: var(--uw-green);
      min-height: auto;
      padding: 2.5rem 2rem 3rem;
    }

    .uw-footer-right {
      position: static;
      text-align: center;
      margin-top: 2rem;
    }
  }
</style>

<div class="uw-shell">

  <svg class="uw-wave-svg" viewBox="0 0 1440 900" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M650,0 C430,130 430,330 600,450 C760,570 760,770 620,900 L1440,900 L1440,0 Z" fill="#2C3B4D" />
  </svg>

  <!-- LEFT -->
  <div class="uw-left">
    <div class="uw-brand">
      <div class="uw-brand-icon"><i class="fas fa-cube"></i></div>
      <div class="uw-brand-text">
        <strong>BlockCart</strong>
        <span>Verified Jewelry Exchange</span>
      </div>
    </div>

    <div class="uw-illustration">
      <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.9.14/dist/dotlottie-wc.js" type="module"></script>
      <dotlottie-wc src="https://lottie.host/f372e110-ecf7-441b-9f18-53d9d78f5bff/n980kuroy1.lottie"
        style="width: 580px; height: 580px; max-width: 100%;" autoplay loop></dotlottie-wc>
    </div>

    <div class="uw-footer-left">
      &copy; <?= date('Y') ?> BlockCart<br>
      Blockchain-secured commerce
    </div>
  </div>

  <!-- RIGHT -->
  <div class="uw-right">
    <div class="uw-right-inner" data-aos="fade-up">
      <h1>Login</h1>

      <ul class="nav nav-fill uw-role-tabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill"
            data-bs-target="#tabCustomer">Customer</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tabStaff">Staff</button>
        </li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#tabAdmin">Admin</button>
        </li>
      </ul>

      <div class="tab-content">
        <?php foreach ([
          ['id' => 'Customer', 'role' => 'customer', 'demo' => 'maria.santos@email.com'],
          ['id' => 'Staff', 'role' => 'staff', 'demo' => 'john.reyes@blockcart.com'],
          ['id' => 'Admin', 'role' => 'admin', 'demo' => 'admin@blockcart.com']
        ] as $tab): ?>
          <div class="tab-pane fade <?= $tab['id'] === 'Customer' ? 'show active' : '' ?>" id="tab<?= $tab['id'] ?>">
            <form method="POST" action="">
              <input type="hidden" name="role" value="<?= $tab['role'] ?>">

              <div class="uw-field">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" value="<?= $tab['demo'] ?>" required>
              </div>

              <div class="uw-field">
                <label>Password</label>
                <input type="password" class="form-control" value="password123" required>
              </div>

              <div class="uw-row-end">
                <a href="<?= bc_url('auth/forgot-password.php') ?>">Forgot Password?</a>
              </div>

              <button type="submit" class="uw-submit">Login as <?= $tab['id'] ?></button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>

      <p class="uw-register-note">Don't have an account? <a href="<?= bc_url('auth/register.php') ?>">Register Now</a>
      </p>

      <div class="uw-terms">
        <a href="<?= bc_url('terms.php') ?>">Terms and Services</a>
      </div>
    </div>
  </div>

  <div class="uw-footer-right">
    Have a problem? Contact us at<br>
    <a href="mailto:support@blockcart.com">support@blockcart.com</a>
  </div>

</div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>