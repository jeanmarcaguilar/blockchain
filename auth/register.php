<?php
$bc_title = 'Register';
$bc_page = 'register';
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
    width: 42%;
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
    max-width: 380px;
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
    width: 58%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    min-height: 100vh;
  }

  .uw-right-inner {
    width: 100%;
    max-width: 460px;
  }

  .uw-right-inner h1 {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 2.2rem;
    color: var(--uw-text-light);
    margin-bottom: .5rem;
  }

  .uw-sub-text {
    color: var(--uw-muted-light);
    font-size: .88rem;
    margin-bottom: 1.75rem;
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
    padding: .75rem 1.3rem;
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

  .uw-field .input-group-text {
    background: var(--uw-green-3);
    border: 1px solid transparent;
    border-right: none;
    border-radius: 999px 0 0 999px;
    color: var(--uw-teal-light);
  }

  .uw-field .input-group .form-control {
    border-radius: 0 999px 999px 0;
  }

  .uw-field .input-group:focus-within .input-group-text {
    border-color: var(--uw-teal);
  }

  .uw-check-row {
    font-size: .8rem;
    color: var(--uw-muted-light);
  }

  .uw-check-row a {
    color: var(--uw-teal-light);
    text-decoration: underline;
    text-underline-offset: 2px;
  }

  .uw-check-row a:hover {
    color: var(--uw-text-light);
  }

  .uw-check-row .form-check-input {
    background-color: var(--uw-green-3);
    border-color: var(--uw-teal);
  }

  .uw-check-row .form-check-input:checked {
    background-color: var(--uw-teal);
    border-color: var(--uw-teal);
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

  .uw-auth-utility {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.25rem;
    margin-top: 1.75rem;
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
    <path d="M760,0 C540,130 540,330 710,450 C870,570 870,770 730,900 L1440,900 L1440,0 Z" fill="#2C3B4D" />
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
      <h1>Create Account</h1>
      <p class="uw-sub-text">Join BlockCart for secure blockchain-verified shopping</p>

      <form data-simulate="Account created! Please check your email to verify.">
        <div class="row g-3">
          <div class="col-md-6 uw-field">
            <label>First Name</label>
            <input type="text" class="form-control" placeholder="Maria" required>
          </div>
          <div class="col-md-6 uw-field">
            <label>Last Name</label>
            <input type="text" class="form-control" placeholder="Santos" required>
          </div>
          <div class="col-12 uw-field">
            <label>Email Address</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              <input type="email" class="form-control" placeholder="you@email.com" required>
            </div>
          </div>
          <div class="col-12 uw-field">
            <label>Phone Number</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
              <input type="tel" class="form-control" placeholder="+63 917 000 0000" required>
            </div>
          </div>
          <div class="col-md-6 uw-field">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Min. 8 characters" minlength="8" required>
          </div>
          <div class="col-md-6 uw-field">
            <label>Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm password" required>
          </div>
          <div class="col-12">
            <div class="form-check uw-check-row">
              <input class="form-check-input" type="checkbox" id="agreeTerms" required>
              <label class="form-check-label" for="agreeTerms">I agree to the <a href="<?= bc_url('terms.php') ?>">Terms
                  of Service</a> and <a href="<?= bc_url('privacy.php') ?>">Privacy Policy</a></label>
            </div>
          </div>
          <div class="col-12 mt-2">
            <button type="submit" class="uw-submit"><i class="fas fa-user-plus me-2"></i>Create Account</button>
          </div>
        </div>
      </form>

      <p class="uw-register-note">Already have an account? <a href="<?= bc_url('auth/login.php') ?>">Sign in</a></p>

      <div class="uw-auth-utility">
        <button class="theme-toggle"><i class="fas fa-moon"></i></button>
        <a href="<?= bc_url('index.php') ?>"><i class="fas fa-arrow-left me-1"></i>Back to store</a>
      </div>
    </div>
  </div>

  <div class="uw-footer-right">
    Have a problem? Contact us at<br>
    <a href="mailto:support@blockcart.com">support@blockcart.com</a>
  </div>

</div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>