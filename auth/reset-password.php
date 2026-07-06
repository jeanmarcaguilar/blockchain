<?php
$bc_title = 'Reset Password';
$bc_page = 'reset-password';
$bc_dashboard = false;
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

  .uw-illustration svg {
    width: 100%;
    max-width: 420px;
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
    font-size: 2.2rem;
    color: var(--uw-text-light);
    margin-bottom: .5rem;
    text-align: center;
  }

  .uw-status-badge {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin: 0 auto 1.5rem;
    background: var(--uw-green-3);
    border: 1px solid var(--uw-teal);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--uw-teal-light);
    font-size: 1.3rem;
  }

  .uw-sub-text {
    text-align: center;
    color: var(--uw-muted-light);
    font-size: .88rem;
    margin-bottom: 2rem;
  }

  .uw-field {
    margin-bottom: 1.1rem;
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

  .uw-field small {
    color: var(--uw-muted-light);
    font-size: .74rem;
    display: block;
    margin-top: .5rem;
    padding-left: .3rem;
  }

  .uw-field .progress {
    background: var(--uw-green-3);
    border-radius: 999px;
  }

  .uw-field .progress-bar {
    background: linear-gradient(135deg, var(--uw-teal), var(--uw-teal-light));
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
    margin-top: .5rem;
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
    text-decoration: none;
  }

  .uw-register-note a:hover {
    color: var(--uw-teal-light);
  }

  .uw-auth-utility {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.25rem;
    margin-top: 2rem;
    padding-top: 1.25rem;
    border-top: 1px solid rgba(244, 248, 245, 0.1);
  }

  .uw-auth-utility button,
  .uw-auth-utility a {
    background: none;
    border: none;
    color: var(--uw-muted-light);
    font-size: .8rem;
    text-decoration: none;
  }

  .uw-auth-utility a:hover,
  .uw-auth-utility button:hover {
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
        style="width: 480px; height: 480px; max-width: 100%;" autoplay loop></dotlottie-wc>
    </div>

    <div class="uw-footer-left">
      &copy; <?= date('Y') ?> BlockCart<br>
      Blockchain-secured commerce
    </div>
  </div>

  <!-- RIGHT -->
  <div class="uw-right">
    <div class="uw-right-inner" data-aos="fade-up">
      <div class="uw-status-badge"><i class="fas fa-lock-open"></i></div>
      <h1>Reset Password</h1>
      <p class="uw-sub-text">Create a new password for your account</p>

      <form data-simulate="Password updated successfully! You can now sign in.">
        <div class="uw-field">
          <label>New Password</label>
          <input type="password" class="form-control" placeholder="Min. 8 characters" minlength="8" required>
          <div class="progress mt-2" style="height:4px">
            <div class="progress-bar" style="width:60%"></div>
          </div>
          <small>Use 8+ characters with letters, numbers &amp; symbols</small>
        </div>
        <div class="uw-field">
          <label>Confirm New Password</label>
          <input type="password" class="form-control" placeholder="Confirm password" required>
        </div>
        <button type="submit" class="uw-submit"><i class="fas fa-check me-2"></i>Update Password</button>
      </form>

      <p class="uw-register-note"><a href="<?= bc_url('auth/login.php') ?>"><i class="fas fa-arrow-left me-1"></i>Back
          to Login</a></p>

      <div class="uw-auth-utility">
        <button class="theme-toggle"><i class="fas fa-moon"></i></button>
      </div>
    </div>
  </div>

  <div class="uw-footer-right">
    Have a problem? Contact us at<br>
    <a href="mailto:support@blockcart.com">support@blockcart.com</a>
  </div>

</div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>