<?php
$bc_title = 'About Us';
$bc_page = 'about';
$bc_dashboard = false;
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/public-header.php';
?>

<section class="hero-section py-5" style="min-height:auto">
  <div class="container hero-content text-center py-5">
    <div class="hero-badge mb-3 mx-auto"><i class="fas fa-cube"></i> About BlockCart</div>
    <h1 class="display-5 fw-bold mb-3">Revolutionizing E-Commerce with Blockchain</h1>
    <p class="lead opacity-90 mx-auto" style="max-width:700px">We're building the future of online shopping — where every transaction is transparent, verifiable, and secure on the Ethereum blockchain.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <h2 class="section-title">Our Mission</h2>
        <p class="text-muted-custom">BlockCart was founded with a simple vision: to bring trust and transparency to online shopping in the Philippines. By recording every order on the Ethereum blockchain, we give customers immutable proof of their purchases.</p>
        <p class="text-muted-custom">We believe that e-commerce should be secure, fast, and honest. Our platform combines modern shopping experiences with cutting-edge Web3 technology — without compromising on usability.</p>
        <div class="row g-3 mt-2">
          <div class="col-6"><div class="card-custom p-3 text-center"><div class="fw-bold fs-4 text-primary">2024</div><small class="text-muted-custom">Founded</small></div></div>
          <div class="col-6"><div class="card-custom p-3 text-center"><div class="fw-bold fs-4 text-success">10K+</div><small class="text-muted-custom">Customers</small></div></div>
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600" alt="Team collaboration" class="img-fluid rounded-4 shadow-lg">
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title">Our Values</h2>
      <p class="section-subtitle">What drives us every day</p>
    </div>
    <div class="row g-4">
      <?php foreach ([
        ['icon'=>'fa-shield-alt','title'=>'Trust & Security','desc'=>'Blockchain-verified transactions ensure tamper-proof order records.'],
        ['icon'=>'fa-users','title'=>'Customer First','desc'=>'Every decision we make puts our customers at the center.'],
        ['icon'=>'fa-lightbulb','title'=>'Innovation','desc'=>'We continuously explore new technologies to improve shopping.'],
        ['icon'=>'fa-leaf','title'=>'Sustainability','desc'=>'Eco-friendly packaging and responsible sourcing practices.']
      ] as $i => $v): ?>
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $i*100 ?>">
        <div class="card-custom p-4 text-center h-100">
          <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3"><i class="fas <?= $v['icon'] ?>"></i></div>
          <h5><?= $v['title'] ?></h5>
          <p class="text-muted-custom small mb-0"><?= $v['desc'] ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title">Meet Our Team</h2>
      <p class="section-subtitle">The people behind BlockCart</p>
    </div>
    <div class="row g-4 justify-content-center">
      <?php
      $team = [
        ['name'=>'Carlos Mendoza','role'=>'CEO & Founder','avatar'=>'https://i.pravatar.cc/200?u=carlos','bio'=>'Former fintech executive with 15 years in e-commerce.'],
        ['name'=>'Sarah Chen','role'=>'CTO','avatar'=>'https://i.pravatar.cc/200?u=sarah','bio'=>'Blockchain architect and Ethereum developer.'],
        ['name'=>'John Reyes','role'=>'Head of Operations','avatar'=>'https://i.pravatar.cc/200?u=john','bio'=>'Ensures every order is fulfilled with excellence.'],
        ['name'=>'Ana Cruz','role'=>'Head of Customer Success','avatar'=>'https://i.pravatar.cc/200?u=anacruz','bio'=>'Passionate about delivering exceptional service.'],
      ];
      foreach ($team as $i => $m): ?>
      <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= $i*100 ?>">
        <div class="card-custom text-center p-4 h-100">
          <img src="<?= $m['avatar'] ?>" alt="<?= $m['name'] ?>" class="rounded-circle mx-auto mb-3" width="120" height="120" style="object-fit:cover">
          <h5 class="mb-1"><?= $m['name'] ?></h5>
          <p class="text-primary small fw-medium mb-2"><?= $m['role'] ?></p>
          <p class="text-muted-custom small mb-3"><?= $m['bio'] ?></p>
          <div class="d-flex justify-content-center gap-2">
            <a href="#" class="text-muted-custom"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="text-muted-custom"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-5 bg-white">
  <div class="container text-center" data-aos="zoom-in">
    <div class="card-glass p-5">
      <h2 class="mb-3">Ready to Shop with Confidence?</h2>
      <p class="text-muted-custom mb-4">Join thousands of customers who trust BlockCart for secure, blockchain-verified shopping.</p>
      <a href="shop.php" class="btn btn-primary-custom btn-lg me-2">Browse Products</a>
      <a href="contact.php" class="btn btn-outline-custom btn-lg">Contact Us</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/public-footer.php'; ?>
<?php require_once __DIR__ . '/includes/footer-scripts.php'; ?>
