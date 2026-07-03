<?php
$bc_title = 'Shop';
$bc_page = 'shop';
$bc_dashboard = false;
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/public-header.php';
?>

<section class="py-4 bg-white border-bottom">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb breadcrumb-custom mb-2">
        <li class="breadcrumb-item"><a href="<?= bc_url('index.php') ?>">Home</a></li>
        <li class="breadcrumb-item active">Shop</li>
      </ol>
    </nav>
    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
      <div>
        <h1 class="section-title mb-1">All Products</h1>
        <p class="text-muted-custom mb-0" id="shopResultCount">Loading products...</p>
      </div>
      <div class="d-flex gap-2 flex-wrap">
        <select class="form-select form-select-custom" id="shopSort" style="width:auto;min-width:180px">
          <option value="featured">Featured</option>
          <option value="price-asc">Price: Low to High</option>
          <option value="price-desc">Price: High to Low</option>
          <option value="rating">Top Rated</option>
          <option value="bestseller">Best Sellers</option>
          <option value="new">New Arrivals</option>
        </select>
        <div class="btn-group d-md-none">
          <button class="btn btn-outline-custom" id="filterToggle"><i class="fas fa-filter me-1"></i> Filters</button>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <aside class="col-lg-3">
        <div class="card-custom p-4 sticky-top" style="top:90px" id="shopFilters">
          <h5 class="mb-3"><i class="fas fa-sliders-h me-2 text-primary"></i>Filters</h5>
          <div class="mb-4">
            <label class="form-label fw-medium">Search</label>
            <div class="nav-search w-100">
              <i class="fas fa-search"></i>
              <input type="search" id="shopSearch" placeholder="Search products..." class="w-100">
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label fw-medium">Categories</label>
            <div id="filterCategories" class="d-flex flex-column gap-2"></div>
          </div>
          <div class="mb-4">
            <label class="form-label fw-medium">Brands</label>
            <div id="filterBrands" class="d-flex flex-column gap-2"></div>
          </div>
          <div class="mb-4">
            <label class="form-label fw-medium">Price Range</label>
            <input type="range" class="form-range" id="priceRange" min="0" max="60000" step="500" value="60000">
            <div class="d-flex justify-content-between small text-muted-custom">
              <span>₱0</span>
              <span id="priceRangeLabel">Up to ₱60,000</span>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="filterDiscount">
              <label class="form-check-label" for="filterDiscount">On Sale Only</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="filterInStock" checked>
              <label class="form-check-label" for="filterInStock">In Stock Only</label>
            </div>
          </div>
          <button class="btn btn-outline-custom w-100 btn-sm" id="clearFilters">Clear All Filters</button>
        </div>
      </aside>
      <div class="col-lg-9">
        <div class="row" id="shopProducts">
          <div class="col-12 text-center py-5">
            <div class="loading-spinner mx-auto"></div>
            <p class="text-muted-custom mt-3">Loading products...</p>
          </div>
        </div>
        <nav class="mt-4" id="shopPagination"></nav>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/public-footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const perPage = 8;
  let currentPage = 1;
  let filters = { search: '', category: '', brand: '', maxPrice: 60000, discount: false, inStock: true, sort: 'featured' };

  const params = new URLSearchParams(location.search);
  if (params.get('category')) filters.category = params.get('category');
  if (params.get('sort')) { filters.sort = params.get('sort'); document.getElementById('shopSort').value = params.get('sort'); }
  if (params.get('search')) { filters.search = params.get('search'); document.getElementById('shopSearch').value = filters.search; }

  document.getElementById('filterCategories').innerHTML = BlockCartData.categories.map(c => `
    <div class="form-check">
      <input class="form-check-input cat-filter" type="radio" name="category" id="cat${c.id}" value="${c.slug}" ${filters.category === c.slug ? 'checked' : ''}>
      <label class="form-check-label" for="cat${c.id}">${c.name} <span class="text-muted-custom">(${c.count})</span></label>
    </div>`).join('') +
    `<div class="form-check"><input class="form-check-input cat-filter" type="radio" name="category" id="catAll" value="" ${!filters.category ? 'checked' : ''}><label class="form-check-label" for="catAll">All Categories</label></div>`;

  document.getElementById('filterBrands').innerHTML = BlockCartData.brands.map(b => `
    <div class="form-check">
      <input class="form-check-input brand-filter" type="checkbox" id="brand${b.id}" value="${b.name}">
      <label class="form-check-label" for="brand${b.id}"><i class="fas ${b.logo} me-1"></i>${b.name}</label>
    </div>`).join('');

  function getFilteredProducts() {
    let products = [...BlockCartData.products];
    if (filters.search) {
      const q = filters.search.toLowerCase();
      products = products.filter(p => p.name.toLowerCase().includes(q) || p.category.toLowerCase().includes(q) || p.brand.toLowerCase().includes(q));
    }
    if (filters.category) {
      const cat = BlockCartData.categories.find(c => c.slug === filters.category);
      if (cat) products = products.filter(p => p.category === cat.name);
    }
    if (filters.brand) products = products.filter(p => p.brand === filters.brand);
    if (filters.maxPrice < 60000) products = products.filter(p => getDiscountedPrice(p) <= filters.maxPrice);
    if (filters.discount) products = products.filter(p => p.discount > 0);
    if (filters.inStock) products = products.filter(p => p.stock > 0);

    switch (filters.sort) {
      case 'price-asc': products.sort((a, b) => getDiscountedPrice(a) - getDiscountedPrice(b)); break;
      case 'price-desc': products.sort((a, b) => getDiscountedPrice(b) - getDiscountedPrice(a)); break;
      case 'rating': products.sort((a, b) => b.rating - a.rating); break;
      case 'bestseller': products = products.filter(p => p.bestseller); break;
      case 'new': products = products.filter(p => p.new); break;
      default: products.sort((a, b) => (b.featured ? 1 : 0) - (a.featured ? 1 : 0));
    }
    return products;
  }

  function render() {
    const products = getFilteredProducts();
    const totalPages = Math.max(1, Math.ceil(products.length / perPage));
    if (currentPage > totalPages) currentPage = totalPages;
    const start = (currentPage - 1) * perPage;
    const pageProducts = products.slice(start, start + perPage);

    document.getElementById('shopResultCount').textContent = `${products.length} product${products.length !== 1 ? 's' : ''} found`;
    const container = document.getElementById('shopProducts');
    if (!pageProducts.length) {
      container.innerHTML = `<div class="col-12"><div class="card-custom p-5 text-center"><i class="fas fa-search fa-3x text-muted-custom mb-3"></i><h5>No products found</h5><p class="text-muted-custom">Try adjusting your filters or search terms.</p></div></div>`;
    } else {
      container.innerHTML = pageProducts.map(p => renderProductCard(p)).join('');
    }

    let pagHtml = '<ul class="pagination justify-content-center">';
    for (let i = 1; i <= totalPages; i++) {
      pagHtml += `<li class="page-item ${i === currentPage ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
    }
    pagHtml += '</ul>';
    document.getElementById('shopPagination').innerHTML = totalPages > 1 ? pagHtml : '';
  }

  document.getElementById('shopSearch').addEventListener('input', e => { filters.search = e.target.value; currentPage = 1; render(); });
  document.getElementById('shopSort').addEventListener('change', e => { filters.sort = e.target.value; currentPage = 1; render(); });
  document.getElementById('priceRange').addEventListener('input', e => {
    filters.maxPrice = +e.target.value;
    document.getElementById('priceRangeLabel').textContent = 'Up to ' + formatPrice(+e.target.value);
    currentPage = 1; render();
  });
  document.getElementById('filterDiscount').addEventListener('change', e => { filters.discount = e.target.checked; currentPage = 1; render(); });
  document.getElementById('filterInStock').addEventListener('change', e => { filters.inStock = e.target.checked; currentPage = 1; render(); });
  document.querySelectorAll('.cat-filter').forEach(el => el.addEventListener('change', e => { if (e.target.checked) { filters.category = e.target.value; currentPage = 1; render(); } }));
  document.querySelectorAll('.brand-filter').forEach(el => el.addEventListener('change', () => {
    const checked = [...document.querySelectorAll('.brand-filter:checked')];
    filters.brand = checked.length === 1 ? checked[0].value : '';
    currentPage = 1; render();
  }));
  document.getElementById('clearFilters').addEventListener('click', () => {
    filters = { search: '', category: '', brand: '', maxPrice: 60000, discount: false, inStock: true, sort: 'featured' };
    document.getElementById('shopSearch').value = '';
    document.getElementById('shopSort').value = 'featured';
    document.getElementById('priceRange').value = 60000;
    document.getElementById('priceRangeLabel').textContent = 'Up to ₱60,000';
    document.getElementById('filterDiscount').checked = false;
    document.getElementById('filterInStock').checked = true;
    document.getElementById('catAll').checked = true;
    document.querySelectorAll('.brand-filter').forEach(c => c.checked = false);
    currentPage = 1; render();
  });
  document.getElementById('shopPagination').addEventListener('click', e => {
    e.preventDefault();
    if (e.target.dataset.page) { currentPage = +e.target.dataset.page; render(); window.scrollTo({ top: 0, behavior: 'smooth' }); }
  });
  document.getElementById('filterToggle')?.addEventListener('click', () => document.getElementById('shopFilters').classList.toggle('show-mobile'));
  render();
});
</script>
<?php require_once __DIR__ . '/includes/footer-scripts.php'; ?>
