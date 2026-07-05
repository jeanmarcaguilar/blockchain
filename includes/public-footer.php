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

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content card-glass">
      <div class="modal-header border-0">
        <h5 class="modal-title">Quick View</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="quickViewContent">
        <!-- Content loaded dynamically -->
      </div>
    </div>
  </div>
</div>

<!-- Compare Products Modal -->
<div class="modal fade" id="compareModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content card-glass">
      <div class="modal-header border-0">
        <h5 class="modal-title">Compare Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="compareContent">
        <!-- Content loaded dynamically -->
      </div>
    </div>
  </div>
</div>

<!-- Back to Top Button -->
<button class="back-to-top" id="backToTop" title="Back to top">
  <i class="fas fa-arrow-up"></i>
</button>

<!-- Live Chat Button -->
<button class="live-chat-btn" id="liveChatBtn" title="Live Chat">
  <i class="fas fa-comments"></i>
</button>

<!-- Live Chat Window -->
<div class="live-chat-window" id="liveChatWindow">
  <div class="live-chat-header">
    <h6><i class="fas fa-headset me-2"></i>Live Support</h6>
    <button class="live-chat-close" id="liveChatClose"><i class="fas fa-times"></i></button>
  </div>
  <div class="live-chat-messages" id="chatMessages">
    <div class="chat-message bot">
      <i class="fas fa-robot me-2"></i>Hello! How can I help you today?
    </div>
  </div>
  <div class="live-chat-input">
    <input type="text" id="chatInput" placeholder="Type your message...">
    <button id="chatSend"><i class="fas fa-paper-plane"></i></button>
  </div>
</div>
