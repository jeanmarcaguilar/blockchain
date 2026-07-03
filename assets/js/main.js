/* BlockCart Core JavaScript */
const BC = {
  init() {
    this.initTheme();
    this.initSidebar();
    this.initTooltips();
    this.initConfirmDialogs();
    if (typeof AOS !== 'undefined') AOS.init({ duration: 600, once: true, offset: 50 });
  },

  initTheme() {
    const saved = localStorage.getItem('bc-theme') || 'light';
    document.documentElement.setAttribute('data-theme', saved);
    document.querySelectorAll('.theme-toggle').forEach(btn => {
      btn.innerHTML = saved === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
      btn.addEventListener('click', () => {
        const next = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('bc-theme', next);
        btn.innerHTML = next === 'dark' ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
      });
    });
  },

  initSidebar() {
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.dashboard-sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    if (toggle && sidebar) {
      toggle.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay?.classList.toggle('show');
      });
      overlay?.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      });
    }
  },

  initTooltips() {
    if (typeof bootstrap !== 'undefined') {
      document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
    }
  },

  initConfirmDialogs() {
    document.querySelectorAll('[data-confirm]').forEach(el => {
      el.addEventListener('click', e => {
        if (!confirm(el.dataset.confirm || 'Are you sure?')) e.preventDefault();
      });
    });
  },

  showLoading() {
    if (!document.getElementById('bcLoading')) {
      const div = document.createElement('div');
      div.id = 'bcLoading';
      div.className = 'loading-overlay';
      div.innerHTML = '<div class="loading-spinner"></div>';
      document.body.appendChild(div);
    }
  },

  hideLoading() {
    document.getElementById('bcLoading')?.remove();
  },

  toast(message, type = 'success') {
    let container = document.querySelector('.toast-container-custom');
    if (!container) {
      container = document.createElement('div');
      container.className = 'toast-container-custom';
      document.body.appendChild(container);
    }
    const icons = { success: 'fa-check-circle text-success', error: 'fa-times-circle text-danger', warning: 'fa-exclamation-triangle text-warning', info: 'fa-info-circle text-primary' };
    const toast = document.createElement('div');
    toast.className = 'toast-custom';
    toast.innerHTML = `<i class="fas ${icons[type] || icons.info}"></i><span>${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
  }
};

function addToCart(productId, qty = 1) {
  let cart = JSON.parse(localStorage.getItem('bc-cart') || '[]');
  const existing = cart.find(i => i.productId === productId);
  if (existing) existing.qty += qty;
  else cart.push({ productId, qty });
  localStorage.setItem('bc-cart', JSON.stringify(cart));
  updateCartBadge();
  BC.toast('Product added to cart!');
}

function toggleWishlist(productId) {
  let wishlist = JSON.parse(localStorage.getItem('bc-wishlist') || '[]');
  const idx = wishlist.indexOf(productId);
  if (idx > -1) { wishlist.splice(idx, 1); BC.toast('Removed from wishlist', 'info'); }
  else { wishlist.push(productId); BC.toast('Added to wishlist!'); }
  localStorage.setItem('bc-wishlist', JSON.stringify(wishlist));
  updateWishlistBadge();
}

function updateCartBadge() {
  const cart = JSON.parse(localStorage.getItem('bc-cart') || '[]');
  const count = cart.reduce((s, i) => s + i.qty, 0);
  document.querySelectorAll('.cart-badge').forEach(el => {
    el.textContent = count;
    el.style.display = count > 0 ? 'inline' : 'none';
  });
}

function updateWishlistBadge() {
  const wishlist = JSON.parse(localStorage.getItem('bc-wishlist') || '[]');
  document.querySelectorAll('.wishlist-badge').forEach(el => {
    el.textContent = wishlist.length;
    el.style.display = wishlist.length > 0 ? 'inline' : 'none';
  });
}

function getCartItems() {
  const cart = JSON.parse(localStorage.getItem('bc-cart') || '[]');
  return cart.map(item => {
    const product = BlockCartData.products.find(p => p.id === item.productId);
    return product ? { ...product, qty: item.qty, lineTotal: getDiscountedPrice(product) * item.qty } : null;
  }).filter(Boolean);
}

function initHeaderCategories() {
  const menu = document.getElementById('headerCategories');
  if (!menu || !window.BlockCartData) return;
  const categories = BlockCartData.categories.map(c => `
    <li><a class="dropdown-item" href="${window.bcBase || ''}/shop.php?category=${encodeURIComponent(c.slug)}">${c.name}</a></li>`
  ).join('');
  menu.innerHTML = categories + `<li><hr class="dropdown-divider"></li><li><a class="dropdown-item" href="${window.bcBase || ''}/shop.php">View all categories</a></li>`;
}

function initGlobalSearch() {
  const input = document.getElementById('globalSearch');
  if (!input) return;
  input.addEventListener('keydown', e => {
    if (e.key !== 'Enter') return;
    e.preventDefault();
    const query = input.value.trim();
    if (!query) return;
    const url = `${window.bcBase || ''}/shop.php?search=${encodeURIComponent(query)}`;
    window.location.href = url;
  });
}

function simulateFormSubmit(form, message = 'Saved successfully!') {
  form?.addEventListener('submit', e => {
    e.preventDefault();
    BC.showLoading();
    const redirectUrl = form.getAttribute('data-redirect');
    console.log('Redirect URL:', redirectUrl);
    setTimeout(() => {
      BC.hideLoading();
      BC.toast(message);
      if (redirectUrl) {
        console.log('Redirecting to:', redirectUrl);
        window.location.href = redirectUrl;
      }
    }, 1200);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  BC.init();
  updateCartBadge();
  updateWishlistBadge();
  document.querySelectorAll('form[data-simulate]').forEach(f => simulateFormSubmit(f, f.dataset.simulate));
  initHeaderCategories();
  initGlobalSearch();
});
