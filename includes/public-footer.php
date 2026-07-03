<?php require_once __DIR__ . '/config.php'; ?>
<footer class="footer-blockcart">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-4">
        <h5><i class="fas fa-cube me-2 text-primary"></i>BlockCart</h5>
        <p class="small">Secure blockchain-verified e-commerce platform. Shop with confidence knowing your transactions are immutably recorded on Ethereum.</p>
        <div class="d-flex gap-3 mt-3">
          <a href="#"><i class="fab fa-facebook fa-lg"></i></a>
          <a href="#"><i class="fab fa-twitter fa-lg"></i></a>
          <a href="#"><i class="fab fa-instagram fa-lg"></i></a>
          <a href="#"><i class="fab fa-linkedin fa-lg"></i></a>
        </div>
      </div>
      <div class="col-6 col-lg-2">
        <h5>Shop</h5>
        <a href="<?= bc_url('shop.php') ?>">All Products</a>
        <a href="<?= bc_url('shop.php') ?>">Categories</a>
        <a href="<?= bc_url('shop.php') ?>">Best Sellers</a>
        <a href="<?= bc_url('shop.php') ?>">New Arrivals</a>
      </div>
      <div class="col-6 col-lg-2">
        <h5>Support</h5>
        <a href="<?= bc_url('contact.php') ?>">Contact Us</a>
        <a href="<?= bc_url('faq.php') ?>">FAQs</a>
        <a href="<?= bc_url('customer/orders.php') ?>">Track Order</a>
        <a href="<?= bc_url('customer/blockchain.php') ?>">Blockchain Verify</a>
      </div>
      <div class="col-6 col-lg-2">
        <h5>Legal</h5>
        <a href="<?= bc_url('privacy.php') ?>">Privacy Policy</a>
        <a href="<?= bc_url('terms.php') ?>">Terms of Service</a>
        <a href="<?= bc_url('faq.php') ?>">FAQ</a>
      </div>
      <div class="col-6 col-lg-2">
        <h5>Contact</h5>
        <p class="small mb-1"><i class="fas fa-envelope me-2"></i>support@blockcart.com</p>
        <p class="small mb-1"><i class="fas fa-phone me-2"></i>+63 2 8123 4567</p>
        <p class="small"><i class="fas fa-map-marker-alt me-2"></i>Makati City, Philippines</p>
      </div>
    </div>
    <div class="footer-bottom text-center small">
      <p class="mb-0">&copy; <?= date('Y') ?> BlockCart. All rights reserved. | Powered by Ethereum Blockchain</p>
    </div>
  </div>
</footer>
