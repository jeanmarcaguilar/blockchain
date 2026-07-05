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

    // Amazon Sidebar Drawer
    const amzToggle = document.getElementById('hamburgerMenuTrigger');
    const amzSidebar = document.getElementById('amazonSidebarDrawer');
    const amzOverlay = document.getElementById('amazonSidebarOverlay');
    const amzClose = document.getElementById('amazonSidebarClose');

    if (amzToggle && amzSidebar && amzOverlay) {
      const openDrawer = () => {
        amzSidebar.classList.add('show');
        amzOverlay.classList.add('show');
        document.body.style.overflow = 'hidden';
      };
      const closeDrawer = () => {
        amzSidebar.classList.remove('show');
        amzOverlay.classList.remove('show');
        document.body.style.overflow = '';
      };
      amzToggle.addEventListener('click', openDrawer);
      amzOverlay.addEventListener('click', closeDrawer);
      amzClose?.addEventListener('click', closeDrawer);
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
  if (!window.BlockCartData) return;

  // 1. Search category selector
  const searchMenu = document.getElementById('searchCategoryMenu');
  if (searchMenu) {
    const listHtml = BlockCartData.categories.map(c => `
      <li><a class="dropdown-item" href="#" onclick="selectSearchCategory('${c.slug}', '${c.name}'); return false;">${c.name}</a></li>
    `).join('');
    searchMenu.innerHTML = `<li><a class="dropdown-item" href="#" onclick="selectSearchCategory('', 'All'); return false;">All Departments</a></li>`
      + '<li><hr class="dropdown-divider"></li>'
      + listHtml;
  }

  // 2. Sidebar category list
  const sidebarList = document.getElementById('sidebarCategoriesList');
  if (sidebarList) {
    const listHtml = BlockCartData.categories.map(c => `
      <li><a href="${window.bcBase || ''}/shop.php?category=${encodeURIComponent(c.slug)}">${c.name} <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
    `).join('');
    sidebarList.innerHTML = listHtml + `<li><a href="${window.bcBase || ''}/shop.php">All Departments <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>`;
  }

  // 3. Fallback headerCategories
  const menu = document.getElementById('headerCategories');
  if (menu) {
    const categories = BlockCartData.categories.map(c => `
      <li><a class="dropdown-item" href="${window.bcBase || ''}/shop.php?category=${encodeURIComponent(c.slug)}">${c.name}</a></li>`
    ).join('');
    menu.innerHTML = categories + `<li><hr class="dropdown-divider"></li><li><a class="dropdown-item" href="${window.bcBase || ''}/shop.php">View all categories</a></li>`;
  }
}

function initGlobalSearch() {
  const input = document.getElementById('globalSearch');
  const resultsContainer = document.getElementById('searchResults');
  if (!input || !resultsContainer) return;

  let searchTimeout;

  input.addEventListener('input', e => {
    const query = e.target.value.trim().toLowerCase();
    clearTimeout(searchTimeout);

    if (query.length < 2) {
      resultsContainer.classList.remove('show');
      return;
    }

    searchTimeout = setTimeout(() => {
      if (!window.BlockCartData) return;
      const results = BlockCartData.products.filter(p =>
        p.name.toLowerCase().includes(query) ||
        p.category.toLowerCase().includes(query)
      ).slice(0, 5);

      if (results.length === 0) {
        resultsContainer.innerHTML = '<div class="search-no-results"><i class="fas fa-search mb-2"></i><br>No products found</div>';
      } else {
        resultsContainer.innerHTML = results.map(p => `
          <div class="search-result-item" onclick="window.location.href='${window.bcBase || ''}/product.php?id=${p.id}'">
            <img src="${p.image}" alt="${p.name}">
            <div class="result-info">
              <div class="result-name">${p.name}</div>
              <div class="result-category">${p.category}</div>
              <div class="result-price">$${getDiscountedPrice(p).toFixed(2)}</div>
            </div>
          </div>
        `).join('');
      }
      resultsContainer.classList.add('show');
    }, 300);
  });

  input.addEventListener('keydown', e => {
    if (e.key === 'Enter') {
      e.preventDefault();
      const query = input.value.trim();
      if (!query) return;
      const url = `${window.bcBase || ''}/shop.php?search=${encodeURIComponent(query)}`;
      window.location.href = url;
    }
    if (e.key === 'Escape') {
      resultsContainer.classList.remove('show');
    }
  });

  // Close search results when clicking outside
  document.addEventListener('click', e => {
    if (!input.contains(e.target) && !resultsContainer.contains(e.target)) {
      resultsContainer.classList.remove('show');
    }
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
  initBackToTop();
  initLiveChat();
  initQuickView();
  updateRecentlyViewedSection();
});

// Back to Top Button
function initBackToTop() {
  const backToTop = document.getElementById('backToTop');
  if (!backToTop) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      backToTop.classList.add('show');
    } else {
      backToTop.classList.remove('show');
    }
  });

  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// Live Chat
function initLiveChat() {
  const chatBtn = document.getElementById('liveChatBtn');
  const chatWindow = document.getElementById('liveChatWindow');
  const chatClose = document.getElementById('liveChatClose');
  const chatInput = document.getElementById('chatInput');
  const chatSend = document.getElementById('chatSend');
  const chatMessages = document.getElementById('chatMessages');

  if (!chatBtn || !chatWindow) return;

  chatBtn.addEventListener('click', () => {
    chatWindow.classList.toggle('show');
  });

  chatClose.addEventListener('click', () => {
    chatWindow.classList.remove('show');
  });

  function sendMessage() {
    const message = chatInput.value.trim();
    if (!message) return;

    // Add user message
    const userMsg = document.createElement('div');
    userMsg.className = 'chat-message user';
    userMsg.textContent = message;
    chatMessages.appendChild(userMsg);
    chatInput.value = '';

    // Scroll to bottom
    chatMessages.scrollTop = chatMessages.scrollHeight;

    // Simulate bot response
    setTimeout(() => {
      const botMsg = document.createElement('div');
      botMsg.className = 'chat-message bot';
      botMsg.innerHTML = '<i class="fas fa-robot me-2"></i>Thank you for your message! Our support team will assist you shortly.';
      chatMessages.appendChild(botMsg);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }, 1000);
  }

  chatSend.addEventListener('click', sendMessage);
  chatInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendMessage();
  });
}

// Quick View Modal
function initQuickView() {
  const quickViewModal = document.getElementById('quickViewModal');
  const quickViewContent = document.getElementById('quickViewContent');

  if (!quickViewModal || !quickViewContent) return;

  // Add quick view buttons to product cards (if they exist)
  document.querySelectorAll('.product-card').forEach(card => {
    const quickViewBtn = document.createElement('button');
    quickViewBtn.className = 'quick-view-btn';
    quickViewBtn.innerHTML = '<i class="fas fa-eye"></i>';
    quickViewBtn.title = 'Quick View';
    quickViewBtn.addEventListener('click', (e) => {
      e.preventDefault();
      showQuickView(card);
    });
    card.querySelector('.product-img-wrap')?.appendChild(quickViewBtn);
  });
}

function showQuickView(productCard) {
  const quickViewModal = document.getElementById('quickViewModal');
  const quickViewContent = document.getElementById('quickViewContent');

  if (!quickViewModal || !quickViewContent) return;

  // Get product data from card (simplified - in real app, would fetch from API)
  const productName = productCard.querySelector('.product-name')?.textContent || 'Product';
  const productPrice = productCard.querySelector('.product-price')?.textContent || '$0.00';
  const productImage = productCard.querySelector('img')?.src || '';
  const productRating = productCard.querySelector('.rating')?.innerHTML || '';

  quickViewContent.innerHTML = `
    <div class="quick-view-product">
      <div class="quick-view-image">
        <img src="${productImage}" alt="${productName}">
      </div>
      <div class="quick-view-details">
        <h4>${productName}</h4>
        <div class="quick-view-rating">${productRating}</div>
        <div class="quick-view-price">${productPrice}</div>
        <p class="quick-view-description">Experience premium quality with this amazing product. Perfect for your needs with blockchain-verified authenticity guarantee.</p>
        <div class="d-flex gap-2">
          <button class="btn btn-primary-custom" onclick="addToCart(1)">
            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
          </button>
          <button class="btn btn-outline-custom" onclick="toggleWishlist(1)">
            <i class="fas fa-heart"></i>
          </button>
        </div>
      </div>
    </div>
  `;

  const modal = new bootstrap.Modal(quickViewModal);
  modal.show();
}

// Recently Viewed Products
function addToRecentlyViewed(productId) {
  let recentlyViewed = JSON.parse(localStorage.getItem('bc-recently-viewed') || '[]');
  recentlyViewed = recentlyViewed.filter(id => id !== productId);
  recentlyViewed.unshift(productId);
  recentlyViewed = recentlyViewed.slice(0, 8);
  localStorage.setItem('bc-recently-viewed', JSON.stringify(recentlyViewed));
  updateRecentlyViewedSection();
}

function updateRecentlyViewedSection() {
  const section = document.getElementById('recentlyViewedSection');
  const container = document.getElementById('recentlyViewed');
  if (!section || !container) return;

  const recentlyViewed = JSON.parse(localStorage.getItem('bc-recently-viewed') || '[]');
  if (recentlyViewed.length === 0) {
    section.style.display = 'none';
    return;
  }

  section.style.display = 'block';
  const products = recentlyViewed.map(id => BlockCartData.products.find(p => p.id === id)).filter(Boolean);

  container.innerHTML = products.map(p => renderProductCard(p)).join('');
}

function clearRecentlyViewed() {
  localStorage.removeItem('bc-recently-viewed');
  updateRecentlyViewedSection();
  BC.toast('Recently viewed cleared', 'info');
}

// Compare Products
function toggleCompare(productId) {
  let compare = JSON.parse(localStorage.getItem('bc-compare') || '[]');
  const idx = compare.indexOf(productId);
  if (idx > -1) {
    compare.splice(idx, 1);
    BC.toast('Removed from comparison', 'info');
  } else {
    if (compare.length >= 4) {
      BC.toast('Maximum 4 products can be compared', 'warning');
      return;
    }
    compare.push(productId);
    BC.toast('Added to comparison!');
  }
  localStorage.setItem('bc-compare', JSON.stringify(compare));
  updateCompareBadge();
}

function updateCompareBadge() {
  const compare = JSON.parse(localStorage.getItem('bc-compare') || '[]');
  document.querySelectorAll('.compare-badge').forEach(el => {
    el.textContent = compare.length;
    el.style.display = compare.length > 0 ? 'inline' : 'none';
  });
}

function showCompareModal() {
  const compareModal = document.getElementById('compareModal');
  const compareContent = document.getElementById('compareContent');
  if (!compareModal || !compareContent) return;

  const compare = JSON.parse(localStorage.getItem('bc-compare') || '[]');
  if (compare.length === 0) {
    compareContent.innerHTML = '<p class="text-center text-muted-custom py-5">No products to compare</p>';
  } else {
    const products = compare.map(id => BlockCartData.products.find(p => p.id === id)).filter(Boolean);
    compareContent.innerHTML = `
      <div class="compare-table">
        <div class="row">
          ${products.map(p => `
            <div class="col">
              <div class="text-center mb-3">
                <img src="${p.image}" alt="${p.name}" class="img-fluid rounded mb-2" style="max-height:150px;">
                <h6 class="fw-bold">${p.name}</h6>
                <div class="text-primary fw-bold">$${getDiscountedPrice(p).toFixed(2)}</div>
                <button class="btn btn-sm btn-outline-danger mt-2" onclick="toggleCompare(${p.id}); showCompareModal();">Remove</button>
              </div>
            </div>
          `).join('')}
        </div>
        <hr>
        <div class="row">
          <div class="col-3"><strong>Price</strong></div>
          ${products.map(p => `<div class="col">$${getDiscountedPrice(p).toFixed(2)}</div>`).join('')}
        </div>
        <div class="row mt-2">
          <div class="col-3"><strong>Category</strong></div>
          ${products.map(p => `<div class="col">${p.category}</div>`).join('')}
        </div>
        <div class="row mt-2">
          <div class="col-3"><strong>Rating</strong></div>
          ${products.map(p => `<div class="col">${renderStars(p.rating)}</div>`).join('')}
        </div>
        <div class="row mt-2">
          <div class="col-3"><strong>Blockchain Verified</strong></div>
          ${products.map(p => `<div class="col"><i class="fas fa-check-circle text-success"></i></div>`).join('')}
        </div>
        <div class="row mt-2">
          <div class="col-3"><strong>Actions</strong></div>
          ${products.map(p => `<div class="col"><button class="btn btn-sm btn-primary-custom" onclick="addToCart(${p.id})">Add to Cart</button></div>`).join('')}
        </div>
      </div>
    `;
  }

  const modal = new bootstrap.Modal(compareModal);
  modal.show();
}

// Initialize compare button
document.addEventListener('DOMContentLoaded', () => {
  const compareBtn = document.getElementById('compareBtn');
  if (compareBtn) {
    compareBtn.addEventListener('click', showCompareModal);
  }
  updateCompareBadge();
  initCountdownTimer();
});

// Countdown Timer
function initCountdownTimer() {
  const timerContainer = document.getElementById('flashDealsTimer');
  if (!timerContainer) return;

  // Set end date to 7 days from now
  const endDate = new Date();
  endDate.setDate(endDate.getDate() + 7);

  function updateTimer() {
    const now = new Date();
    const diff = endDate - now;

    if (diff <= 0) {
      timerContainer.innerHTML = '<span class="text-danger">Deal Ended!</span>';
      return;
    }

    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

    document.getElementById('timerDays').textContent = String(days).padStart(2, '0');
    document.getElementById('timerHours').textContent = String(hours).padStart(2, '0');
    document.getElementById('timerMinutes').textContent = String(minutes).padStart(2, '0');
    document.getElementById('timerSeconds').textContent = String(seconds).padStart(2, '0');
  }

  updateTimer();
  setInterval(updateTimer, 1000);
}
