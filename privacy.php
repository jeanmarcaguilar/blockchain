<?php
$bc_title = 'Privacy Policy';
$bc_page = 'privacy';
$bc_dashboard = false;
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/public-header.php';
?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="text-center mb-5" data-aos="fade-up">
          <h1 class="section-title">Privacy Policy</h1>
          <p class="text-muted-custom">Last updated: July 1, 2026</p>
        </div>
        <div class="card-custom p-4 p-lg-5 legal-content" data-aos="fade-up">
          <h5>1. Introduction</h5>
          <p class="text-muted-custom">BlockCart ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our blockchain-verified e-commerce platform.</p>

          <h5 class="mt-4">2. Information We Collect</h5>
          <p class="text-muted-custom">We may collect the following types of information:</p>
          <ul class="text-muted-custom">
            <li><strong>Personal Information:</strong> Name, email address, phone number, shipping address, and payment details when you create an account or place an order.</li>
            <li><strong>Blockchain Data:</strong> Order ID, transaction amount, and timestamp recorded on the Ethereum Sepolia testnet. Personal information is never stored on-chain.</li>
            <li><strong>Usage Data:</strong> Browser type, IP address, pages visited, and interaction with our website.</li>
            <li><strong>Wallet Information:</strong> Public wallet address when you connect MetaMask for blockchain verification.</li>
          </ul>

          <h5 class="mt-4">3. How We Use Your Information</h5>
          <ul class="text-muted-custom">
            <li>Process and fulfill your orders</li>
            <li>Create blockchain verification records for transactions</li>
            <li>Send order confirmations, shipping updates, and promotional communications</li>
            <li>Improve our website, products, and customer service</li>
            <li>Detect and prevent fraud or unauthorized activity</li>
            <li>Comply with legal obligations</li>
          </ul>

          <h5 class="mt-4">4. Blockchain & Data Storage</h5>
          <p class="text-muted-custom">Only non-personal order verification data (order ID, amount, timestamp) is stored on the Ethereum blockchain. This data is immutable and publicly accessible on the Sepolia testnet. Your name, email, address, and payment information remain in our secure, encrypted database and are never written to the blockchain.</p>

          <h5 class="mt-4">5. Information Sharing</h5>
          <p class="text-muted-custom">We do not sell your personal information. We may share data with trusted third parties including shipping carriers, payment processors, and cloud hosting providers — solely to operate our services. We may also disclose information when required by law.</p>

          <h5 class="mt-4">6. Data Security</h5>
          <p class="text-muted-custom">We implement industry-standard security measures including SSL/TLS encryption, secure password hashing, and regular security audits. However, no method of transmission over the Internet is 100% secure.</p>

          <h5 class="mt-4">7. Your Rights</h5>
          <p class="text-muted-custom">You have the right to access, correct, or delete your personal data. You may opt out of marketing communications at any time. Contact us at privacy@blockcart.com to exercise these rights.</p>

          <h5 class="mt-4">8. Cookies</h5>
          <p class="text-muted-custom">We use cookies and similar technologies to enhance your browsing experience, remember preferences, and analyze site traffic. You can control cookies through your browser settings.</p>

          <h5 class="mt-4">9. Contact Us</h5>
          <p class="text-muted-custom mb-0">For privacy-related inquiries, contact our Data Protection Officer at <a href="mailto:privacy@blockcart.com">privacy@blockcart.com</a> or write to BlockCart, 123 Ayala Avenue, Makati City, Philippines.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/public-footer.php'; ?>
<?php require_once __DIR__ . '/includes/footer-scripts.php'; ?>
