<?php require_once __DIR__ . '/config.php'; ?>

<!-- Amazon-style Header -->
<header class="amazon-header-wrapper">
  <!-- Top Bar -->
  <div class="amazon-top-header">
    <div class="container-fluid px-3 d-flex align-items-center justify-content-between gap-3">
      
      <!-- Brand Logo & Deliver To -->
      <div class="d-flex align-items-center gap-3">
        <!-- Logo -->
        <a class="amazon-brand navbar-brand" href="<?= bc_url('index.php') ?>">
          <i class="fas fa-cube me-1"></i>BlockCart
        </a>
        
        <!-- Deliver To -->
        <div class="amazon-deliver-to d-none d-md-flex align-items-center gap-2">
          <i class="fas fa-map-marker-alt text-white fs-5 mt-1"></i>
          <div class="d-flex flex-column text-white lh-sm">
            <span class="small font-xs opacity-75" style="font-size: 0.75rem;">Deliver to</span>
            <span class="fw-bold font-sm" style="font-size: 0.85rem;">Philippines</span>
          </div>
        </div>
      </div>
      
      <!-- Search Bar -->
      <div class="amazon-search-container flex-grow-1 mx-2">
        <form action="<?= bc_url('shop.php') ?>" method="GET" class="input-group">
          <!-- Dropdown -->
          <button class="btn btn-search-cat dropdown-toggle px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            All
          </button>
          <ul class="dropdown-menu dropdown-menu-glass header-category-dropdown" id="searchCategoryMenu">
            <li><a class="dropdown-item" href="#" onclick="selectSearchCategory('', 'All'); return false;">All Departments</a></li>
          </ul>
          <input type="hidden" name="category" id="searchCategoryInput" value="<?= htmlspecialchars($_GET['category'] ?? '') ?>">
          
          <!-- Query input -->
          <input type="search" name="search" class="form-control" placeholder="Search BlockCart..." id="globalSearch" autocomplete="off" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
          
          <!-- Search Button -->
          <button class="btn btn-search-submit" type="submit" aria-label="Search">
            <i class="fas fa-search"></i>
          </button>
        </form>
        <div class="search-results" id="searchResults"></div>
      </div>
      
      <!-- Right Side Actions -->
      <div class="d-flex align-items-center gap-3">
        <!-- Language -->
        <div class="amazon-lang d-none d-lg-flex align-items-center gap-1 text-white cursor-pointer dropdown">
          <span class="dropdown-toggle" data-bs-toggle="dropdown">🇺🇸 EN</span>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item active" href="#">🇺🇸 English (EN)</a></li>
            <li><a class="dropdown-item" href="#">🇵🇭 Tagalog (TL)</a></li>
          </ul>
        </div>
        
        <!-- Account & Lists -->
        <div class="amazon-account text-white cursor-pointer dropdown">
          <div class="d-flex flex-column lh-sm dropdown-toggle" data-bs-toggle="dropdown">
            <span class="small font-xs opacity-75" style="font-size: 0.75rem;">Hello, sign in</span>
            <span class="fw-bold font-sm" style="font-size: 0.85rem;">Account & Lists</span>
          </div>
          <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 240px; z-index: 1060;">
            <div class="text-center mb-2">
              <a href="<?= bc_url('auth/login.php') ?>" class="btn btn-accent btn-sm w-100 mb-2">Sign In</a>
              <small class="text-muted d-block">New customer? <a href="<?= bc_url('auth/register.php') ?>">Start here.</a></small>
            </div>
            <li><hr class="dropdown-divider"></li>
            <li><strong class="px-3 d-block font-xs text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase;">Your Account</strong></li>
            <li><a class="dropdown-item py-1" href="<?= bc_url('customer/dashboard.php') ?>"><i class="fas fa-user-cog me-2"></i>My Dashboard</a></li>
            <li><a class="dropdown-item py-1" href="<?= bc_url('customer/wishlist.php') ?>"><i class="fas fa-heart me-2"></i>Wishlist <span class="badge bg-danger rounded-pill wishlist-badge ms-1" style="display:none">0</span></a></li>
            <li><a class="dropdown-item py-1" href="<?= bc_url('customer/cart.php') ?>"><i class="fas fa-shopping-cart me-2"></i>Shopping Cart <span class="badge bg-primary rounded-pill cart-badge ms-1" style="display:none">0</span></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><strong class="px-3 d-block font-xs text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase;">Portals</strong></li>
            <li><a class="dropdown-item py-1" href="<?= bc_url('staff/dashboard.php') ?>"><i class="fas fa-users-cog me-2"></i>Staff Portal</a></li>
            <li><a class="dropdown-item py-1" href="<?= bc_url('admin/dashboard.php') ?>"><i class="fas fa-shield-alt me-2"></i>Admin Portal</a></li>
          </ul>
        </div>
        
        <!-- Theme Toggle -->
        <button class="theme-toggle btn-link text-white border-0 bg-transparent px-1" title="Toggle dark mode" aria-label="Toggle dark mode">
          <i class="fas fa-moon fs-5"></i>
        </button>
        
        <!-- Cart -->
        <a href="<?= bc_url('customer/cart.php') ?>" class="amazon-cart d-flex align-items-center text-white text-decoration-none position-relative px-2">
          <div class="cart-icon-wrapper position-relative me-1">
            <span class="cart-badge badge bg-accent text-dark rounded-pill position-absolute" style="top: -8px; right: -8px; font-size: 0.7rem; padding: 0.2rem 0.4rem; font-weight: 800;">0</span>
            <i class="fas fa-shopping-cart fs-4"></i>
          </div>
          <span class="fw-bold mt-2 d-none d-sm-inline" style="font-size: 0.85rem;">Cart</span>
        </a>
      </div>
      
    </div>
  </div>
  
  <!-- Subbar (Lower Bar) -->
  <div class="amazon-bottom-header">
    <div class="container-fluid px-3 d-flex align-items-center justify-content-between">
      
      <!-- Subbar Left Navigation -->
      <div class="d-flex align-items-center gap-3">
        <!-- Hamburger Menu -->
        <button class="btn btn-hamburger text-white d-flex align-items-center gap-1 px-2 border-0 bg-transparent" id="hamburgerMenuTrigger">
          <i class="fas fa-bars"></i>
          <span class="fw-bold" style="font-size: 0.875rem;">All</span>
        </button>
        
        <!-- Custom links -->
        <div class="amazon-nav-links d-flex align-items-center gap-2">
          <a href="<?= bc_url('index.php') ?>" class="<?= ($bc_page??'')==='home'?'active':'' ?>">Home</a>
          <a href="<?= bc_url('shop.php') ?>" class="<?= ($bc_page??'')==='shop'?'active':'' ?>">Shop</a>
          <a href="<?= bc_url('contact.php') ?>" class="<?= ($bc_page??'')==='contact'?'active':'' ?>">Contact</a>
          <a href="<?= bc_url('about.php') ?>" class="d-none d-md-inline <?= ($bc_page??'')==='about'?'active':'' ?>">About Us</a>
        </div>
      </div>
      
      <!-- Subbar Right Ads -->
      <div class="d-none d-md-block text-white-50" style="font-size: 0.85rem;">
        <a href="<?= bc_url('shop.php') ?>" class="text-white text-decoration-none fw-bold hover-underline">Shop dynamic blockchain deals today!</a>
      </div>
      
    </div>
  </div>
</header>

<!-- Amazon Drawer Sidebar Overlay -->
<div class="amazon-sidebar-overlay" id="amazonSidebarOverlay"></div>

<!-- Amazon Drawer Sidebar -->
<aside class="amazon-sidebar-drawer" id="amazonSidebarDrawer">
  <!-- Close Button Container -->
  <button class="amazon-sidebar-close" id="amazonSidebarClose" aria-label="Close menu">
    <i class="fas fa-times"></i>
  </button>
  
  <!-- Header -->
  <div class="amazon-sidebar-header">
    <i class="fas fa-user-circle fs-3 me-2"></i>
    <span class="fw-bold fs-5">Hello, sign in</span>
  </div>
  
  <!-- Scrollable content -->
  <div class="amazon-sidebar-content">
    
    <!-- Section 1: Portals & Account -->
    <div class="amazon-sidebar-section">
      <div class="section-title">Trending & Portals</div>
      <ul class="section-list">
        <li><a href="<?= bc_url('index.php') ?>">Home Page <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
        <li><a href="<?= bc_url('customer/dashboard.php') ?>">Customer Dashboard <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
        <li><a href="<?= bc_url('staff/dashboard.php') ?>">Staff Panel <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
        <li><a href="<?= bc_url('admin/dashboard.php') ?>">Admin Panel <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
      </ul>
    </div>
    
    <hr class="section-divider">
    
    <!-- Section 2: Shop departments -->
    <div class="amazon-sidebar-section">
      <div class="section-title">Shop by Category</div>
      <ul class="section-list" id="sidebarCategoriesList">
        <li><a href="<?= bc_url('shop.php') ?>">All Departments <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
      </ul>
    </div>
    
    <hr class="section-divider">
    
    <!-- Section 3: Programs & Features -->
    <div class="amazon-sidebar-section">
      <div class="section-title">Programs & Features</div>
      <ul class="section-list">
        <li><a href="<?= bc_url('customer/wishlist.php') ?>">Wishlist Items <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
        <li><a href="<?= bc_url('customer/blockchain.php') ?>">Verify on Blockchain <i class="fas fa-chevron-right float-end mt-1 text-muted"></i></a></li>
      </ul>
    </div>
    
    <hr class="section-divider">
    
    <!-- Section 4: Help & Settings -->
    <div class="amazon-sidebar-section">
      <div class="section-title">Help & Settings</div>
      <ul class="section-list mb-5">
        <li><a href="<?= bc_url('customer/dashboard.php') ?>">Your Account</a></li>
        <li class="d-flex align-items-center justify-content-between px-3 py-2 text-dark" style="font-size: 0.95rem; font-weight: 500;">
          <span>Language: English</span>
          <span class="text-muted font-sm">🇺🇸 EN</span>
        </li>
        <li><a href="<?= bc_url('contact.php') ?>">Customer Service</a></li>
        <li><a href="<?= bc_url('auth/login.php') ?>">Sign In</a></li>
      </ul>
    </div>
    
  </div>
</aside>

<script>
// Category selector helper inside search input
function selectSearchCategory(slug, name) {
  const btn = document.querySelector('.btn-search-cat');
  if (btn) btn.textContent = name;
  const input = document.getElementById('searchCategoryInput');
  if (input) input.value = slug;
}
</script>
