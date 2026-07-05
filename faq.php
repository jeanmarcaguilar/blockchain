<?php
$bc_title = 'FAQ';
$bc_page = 'faq';
$bc_dashboard = false;
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/public-header.php';
?>

<section class="py-5">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h1 class="section-title">Frequently Asked Questions</h1>
      <p class="section-subtitle">Everything you need to know about BlockCart</p>
      <div class="nav-search mx-auto mt-4" style="max-width:400px">
        <i class="fas fa-search"></i>
        <input type="search" id="faqSearch" placeholder="Search FAQs..." class="w-100">
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="accordion" id="faqAccordion"></div>
        <div id="faqEmpty" class="text-center py-5 d-none">
          <i class="fas fa-search fa-3x text-muted-custom mb-3"></i>
          <p class="text-muted-custom">No FAQs match your search.</p>
        </div>
      </div>
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
      <div class="card-custom p-4 d-inline-block">
        <h5 class="mb-2">Still have questions?</h5>
        <p class="text-muted-custom mb-3">Can't find the answer you're looking for? Our support team is here to help.</p>
        <a href="contact.php" class="btn btn-primary-custom">Contact Support</a>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/public-footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  function renderFaqs(query = '') {
    const q = query.toLowerCase();
    const faqs = BlockCartData.faqs.filter(f => !q || f.q.toLowerCase().includes(q) || f.a.toLowerCase().includes(q));
    const accordion = document.getElementById('faqAccordion');
    const empty = document.getElementById('faqEmpty');
    if (!faqs.length) { accordion.innerHTML = ''; empty.classList.remove('d-none'); return; }
    empty.classList.add('d-none');
    accordion.innerHTML = faqs.map((f, i) => `
      <div class="accordion-item border-0 mb-3 card-custom overflow-hidden faq-item">
        <h2 class="accordion-header">
          <button class="accordion-button ${i ? 'collapsed' : ''}" type="button" data-bs-toggle="collapse" data-bs-target="#faqFull${i}">${f.q}</button>
        </h2>
        <div id="faqFull${i}" class="accordion-collapse collapse ${i ? '' : 'show'}" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-muted-custom">${f.a}</div>
        </div>
      </div>`).join('');
  }
  renderFaqs();
  document.getElementById('faqSearch').addEventListener('input', e => renderFaqs(e.target.value));
});
</script>
<?php require_once __DIR__ . '/includes/footer-scripts.php'; ?>
