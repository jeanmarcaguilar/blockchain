<?php
$bc_title = 'Home';
$bc_page = 'home';
$bc_dashboard = false;
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/public-header.php';
?>

<!-- Hero -->
<section class="hero-section">
  <div class="container hero-content">
    <div class="row align-items-center">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="hero-badge mb-3"><i class="fas fa-link"></i> Blockchain-Verified Shopping</div>
        <h1 class="display-4 fw-bold mb-3">Shop Securely with <span style="color:var(--accent)">BlockCart</span></h1>
        <p class="lead mb-4 opacity-90">Experience next-generation e-commerce where every transaction is immutably
          recorded on the Ethereum blockchain. Shop with confidence.</p>
        <div class="d-flex flex-wrap gap-3">
          <a href="shop.php" class="btn btn-accent btn-lg"><i class="fas fa-shopping-bag me-2"></i>Shop Now</a>
          <a href="about.php" class="btn btn-outline-light btn-lg">Learn More</a>
        </div>
        <div class="d-flex gap-4 mt-4 pt-3">
          <div>
            <div class="fw-bold fs-4">10K+</div><small class="opacity-75">Happy Customers</small>
          </div>
          <div>
            <div class="fw-bold fs-4">500+</div><small class="opacity-75">Products</small>
          </div>
          <div>
            <div class="fw-bold fs-4">12K+</div><small class="opacity-75">Blockchain TXs</small>
          </div>
        </div>
      </div>
      <div class="col-lg-6 text-center mt-5 mt-lg-0" data-aos="fade-left">
        <div class="position-relative">
          <div class="hero-glow"
            style="position:absolute;inset:-20px;background:radial-gradient(circle,rgba(44,59,77,.25) 0%,transparent 70%);filter:blur(40px);z-index:-1">
          </div>
          <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600" alt="Shopping"
            class="img-fluid rounded-4 shadow-lg" style="max-height:420px;object-fit:cover">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Categories -->
<section class="py-5" style="background:rgba(44,59,77,.03)">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title">Shop by Category</h2>
      <p class="section-subtitle">Browse our wide selection of premium products</p>
    </div>
    <div class="row g-4" id="homeCategories"></div>
  </div>
</section>

<!-- Featured Products -->
<section class="py-5" style="background:rgba(44,59,77,.02)">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
      <div>
        <h2 class="section-title mb-0">Featured Products</h2>
        <p class="text-muted-custom mb-0">Handpicked for you</p>
      </div>
      <a href="shop.php" class="btn btn-outline-custom">View All <i class="fas fa-arrow-right ms-1"></i></a>
    </div>
    <div class="row" id="featuredProducts"></div>
  </div>
</section>

<!-- Best Sellers -->
<section class="py-5" style="background:rgba(44,59,77,.03)">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
      <div>
        <h2 class="section-title mb-0">Best Sellers</h2>
        <p class="text-muted-custom mb-0">Most popular this month</p>
      </div>
      <a href="shop.php?sort=bestseller" class="btn btn-outline-custom">View All</a>
    </div>
    <div class="row" id="bestsellerProducts"></div>
  </div>
</section>

<!-- Special Offers Banner -->
<section class="py-5">
  <div class="container" data-aos="zoom-in">
    <div class="card-glass p-5 text-center" style="background:rgba(44,59,77,.08);border:1px solid rgba(44,59,77,.15)">
      <h2 class="mb-3">Summer Sale — Up to 25% Off!</h2>
      <p class="text-muted-custom mb-4">Limited time offer on selected electronics and fashion items. All purchases
        blockchain-verified.</p>
      <a href="shop.php" class="btn btn-accent btn-lg">Shop the Sale</a>
    </div>
  </div>
</section>

<!-- Flash Deals -->
<section class="py-5" style="background:rgba(44,59,77,.02)">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
      <div>
        <h2 class="section-title mb-0">Flash Deals</h2>
        <p class="text-muted-custom mb-0">Limited time offers - Hurry!</p>
      </div>
      <div class="countdown-timer" id="flashDealsTimer">
        <div class="timer-block">
          <span class="timer-value" id="timerDays">00</span>
          <span class="timer-label">Days</span>
        </div>
        <div class="timer-block">
          <span class="timer-value" id="timerHours">00</span>
          <span class="timer-label">Hours</span>
        </div>
        <div class="timer-block">
          <span class="timer-value" id="timerMinutes">00</span>
          <span class="timer-label">Mins</span>
        </div>
        <div class="timer-block">
          <span class="timer-value" id="timerSeconds">00</span>
          <span class="timer-label">Secs</span>
        </div>
      </div>
    </div>
    <div class="row" id="flashDeals"></div>
  </div>
</section>

<!-- New Arrivals -->
<section class="py-5" style="background:rgba(44,59,77,.02)">
  <div class="container">
    <h2 class="section-title" data-aos="fade-up">New Arrivals</h2>
    <p class="section-subtitle" data-aos="fade-up">Fresh products just landed</p>
    <div class="row" id="newArrivals"></div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="py-5" style="background:rgba(44,59,77,.03)">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title">Why Choose BlockCart?</h2>
    </div>
    <div class="row g-4">
      <?php
      $features = [
        ['icon' => 'fa-link', 'title' => 'Blockchain Verified', 'desc' => 'Every order is recorded on Ethereum for tamper-proof verification.'],
        ['icon' => 'fa-shield-alt', 'title' => 'Secure Shopping', 'desc' => 'Enterprise-grade security with encrypted data and secure payments.'],
        ['icon' => 'fa-truck', 'title' => 'Fast Delivery', 'desc' => 'Quick and reliable shipping across the Philippines.'],
        ['icon' => 'fa-headset', 'title' => '24/7 Support', 'desc' => 'Our dedicated team is always ready to help you.'],
      ];
      foreach ($features as $i => $f): ?>
        <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
          <div class="card-custom p-4 text-center h-100">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3"><i
                class="fas <?= $f['icon'] ?>"></i></div>
            <h5><?= $f['title'] ?></h5>
            <p class="text-muted-custom small mb-0"><?= $f['desc'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Testimonials -->
<section class="py-5" style="background:rgba(44,59,77,.02)">
  <div class="container">
    <h2 class="section-title text-center" data-aos="fade-up">What Our Customers Say</h2>
    <div class="row g-4 mt-2" id="testimonials"></div>
  </div>
</section>

<!-- FAQ -->
<section class="py-5" style="background:rgba(44,59,77,.03)">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <p class="text-muted-custom">Got questions? We've got answers.</p>
        <a href="faq.php" class="btn btn-primary-custom">View All FAQs</a>
      </div>
      <div class="col-lg-7" data-aos="fade-left">
        <div class="accordion" id="homeFaq"></div>
      </div>
    </div>
  </div>
</section>

<!-- Recently Viewed -->
<section class="py-5" id="recentlyViewedSection" style="display:none;">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
      <div>
        <h2 class="section-title mb-0">Recently Viewed</h2>
        <p class="text-muted-custom mb-0">Items you've looked at</p>
      </div>
      <button class="btn btn-outline-custom btn-sm" onclick="clearRecentlyViewed()">Clear All</button>
    </div>
    <div class="row" id="recentlyViewed"></div>
  </div>
</section>

<!-- Newsletter -->
<section class="py-5" style="background:var(--primary-dark, #1B2632)">
  <div class="container text-center text-white" data-aos="fade-up">
    <h2 class="mb-3">Subscribe to Our Newsletter</h2>
    <p class="opacity-90 mb-4">Get the latest deals, new arrivals, and blockchain updates.</p>
    <form class="row g-2 justify-content-center max-w-600 mx-auto" style="max-width:500px"
      data-simulate="Subscribed successfully!">
      <div class="col-8"><input type="email" class="form-control form-control-custom" placeholder="Enter your email"
          required style="background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.3);color:#fff"></div>
      <div class="col-4"><button type="submit" class="btn btn-light w-100"
          style="color:var(--primary);font-weight:600">Subscribe</button></div>
    </form>
  </div>
</section>

<?php require_once __DIR__ . '/includes/public-footer.php'; ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('homeCategories').innerHTML = BlockCartData.categories.map(c => `
    <div class="col-6 col-md-4 col-lg-2" data-aos="fade-up">
      <a href="shop.php?category=${c.slug}" class="category-card d-block text-center p-4 text-decoration-none h-100">
        <div class="category-icon-wrapper mb-3">
          <div class="category-icon"><i class="fas ${c.icon}"></i></div>
        </div>
        <h6 class="mb-1">${c.name}</h6>
        <small class="text-muted-custom">${c.count} items</small>
      </a>
    </div>`).join('');

    document.getElementById('featuredProducts').innerHTML = BlockCartData.products.filter(p => p.featured).slice(0, 4).map(p => renderProductCard(p)).join('');
    document.getElementById('bestsellerProducts').innerHTML = BlockCartData.products.filter(p => p.bestseller).slice(0, 4).map(p => renderProductCard(p)).join('');
    document.getElementById('newArrivals').innerHTML = BlockCartData.products.filter(p => p.new).slice(0, 4).map(p => renderProductCard(p)).join('');
    document.getElementById('flashDeals').innerHTML = BlockCartData.products.filter(p => p.discount && p.discount > 0).slice(0, 4).map(p => renderProductCard(p)).join('');

    document.getElementById('testimonials').innerHTML = BlockCartData.testimonials.map(t => `
    <div class="col-md-4" data-aos="fade-up">
      <div class="card-custom p-4 h-100">
        <div class="rating mb-3">${renderStars(t.rating)}</div>
        <p class="mb-3">"${t.text}"</p>
        <div class="d-flex align-items-center gap-3">
          <img src="${t.avatar}" class="rounded-circle" width="48" height="48" alt="">
          <div><div class="fw-semibold">${t.name}</div><small class="text-muted-custom">${t.role}</small></div>
        </div>
      </div>
    </div>`).join('');

    document.getElementById('homeFaq').innerHTML = BlockCartData.faqs.slice(0, 4).map((f, i) => `
    <div class="accordion-item border-0 mb-2 card-custom overflow-hidden">
      <h2 class="accordion-header"><button class="accordion-button ${i ? 'collapsed' : ''}" type="button" data-bs-toggle="collapse" data-bs-target="#faq${i}">${f.q}</button></h2>
      <div id="faq${i}" class="accordion-collapse collapse ${i ? '' : 'show'}" data-bs-parent="#homeFaq"><div class="accordion-body text-muted-custom">${f.a}</div></div>
    </div>`).join('');
  });
</script>
<?php require_once __DIR__ . '/includes/footer-scripts.php'; ?>