<?php
$bc_title = 'Contact Us';
$bc_page = 'contact';
$bc_dashboard = false;
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/public-header.php';
?>

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h1 class="section-title">Get in Touch</h1>
      <p class="section-subtitle">We'd love to hear from you. Our team typically responds within 24 hours.</p>
    </div>
    <div class="row g-5">
      <div class="col-lg-5" data-aos="fade-right">
        <div class="card-glass p-4 mb-4">
          <h5 class="mb-4"><i class="fas fa-info-circle text-primary me-2"></i>Contact Information</h5>
          <div class="contact-item mb-4">
            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="contact-info"><strong>Address</strong><p class="text-muted-custom small mb-0">123 Ayala Avenue, Makati City<br>Metro Manila 1226, Philippines</p></div>
          </div>
          <div class="contact-item mb-4">
            <div class="contact-icon contact-icon-success"><i class="fas fa-phone"></i></div>
            <div class="contact-info"><strong>Phone</strong><p class="text-muted-custom small mb-0">+63 2 8123 4567<br>Mon–Fri, 9AM–6PM PHT</p></div>
          </div>
          <div class="contact-item mb-4">
            <div class="contact-icon contact-icon-info"><i class="fas fa-envelope"></i></div>
            <div class="contact-info"><strong>Email</strong><p class="text-muted-custom small mb-0">support@blockcart.com<br>sales@blockcart.com</p></div>
          </div>
          <div class="contact-item">
            <div class="contact-icon contact-icon-warning"><i class="fas fa-clock"></i></div>
            <div class="contact-info"><strong>Business Hours</strong><p class="text-muted-custom small mb-0">Monday – Friday: 9:00 AM – 6:00 PM<br>Saturday: 10:00 AM – 4:00 PM</p></div>
          </div>
        </div>
        <div class="card-custom p-4 mb-4 overflow-hidden">
          <h5 class="mb-3">Quick Support</h5>
          <p class="text-muted-custom small mb-4">Track your order or verify a transaction directly on our support portal.</p>
          <div class="d-flex flex-wrap gap-2">
            <a href="<?= bc_url('customer/track-order.php') ?>" class="btn btn-outline-custom btn-sm">Track Order</a>
            <a href="<?= bc_url('customer/blockchain.php') ?>" class="btn btn-primary-custom btn-sm">Verify Transaction</a>
            <a href="<?= bc_url('faq.php') ?>" class="btn btn-accent btn-sm">FAQ & Support</a>
          </div>
        </div>
        <div class="card-glass overflow-hidden" style="height:320px;">
          <iframe
            src="https://maps.google.com/maps?q=Makati%20City%2C%20Philippines&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" height="100%" style="border:0;"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
      <div class="col-lg-7" data-aos="fade-left">
        <div class="card-custom p-4 p-lg-5">
          <h5 class="mb-4">Send us a Message</h5>
          <form data-simulate="Message sent! We'll get back to you within 24 hours.">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control form-control-custom" placeholder="John Doe" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control form-control-custom" placeholder="you@email.com" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone (Optional)</label>
                <input type="tel" class="form-control form-control-custom" placeholder="+63 917 000 0000">
              </div>
              <div class="col-md-6">
                <label class="form-label">Order ID (Optional)</label>
                <input type="text" class="form-control form-control-custom" placeholder="BC-2026-00143">
              </div>
              <div class="col-md-6">
                <label class="form-label">Subject</label>
                <select class="form-select form-select-custom" required>
                  <option value="">Select a topic</option>
                  <option>General Inquiry</option>
                  <option>Order Support</option>
                  <option>Blockchain Verification</option>
                  <option>Returns & Refunds</option>
                  <option>Partnership</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label">Message</label>
                <textarea class="form-control form-control-custom" rows="5" placeholder="How can we help you?" required></textarea>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="agreeContact" required>
                  <label class="form-check-label small" for="agreeContact">I agree to the <a href="privacy.php">Privacy Policy</a></label>
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary-custom btn-lg"><i class="fas fa-paper-plane me-2"></i>Send Message</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/public-footer.php'; ?>
<?php require_once __DIR__ . '/includes/footer-scripts.php'; ?>
