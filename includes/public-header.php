<?php require_once __DIR__ . '/config.php'; ?>
<nav class="navbar navbar-expand-lg navbar-blockcart">
  <div class="container">
    <a class="navbar-brand" href="<?= bc_url('index.php') ?>"><i class="fas fa-cube me-2"></i>BlockCart</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link <?= ($bc_page??'')==='home'?'active':'' ?>" href="<?= bc_url('index.php') ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= ($bc_page??'')==='shop'?'active':'' ?>" href="<?= bc_url('shop.php') ?>">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= bc_url('shop.php') ?>">Categories</a></li>
        <li class="nav-item"><a class="nav-link <?= ($bc_page??'')==='about'?'active':'' ?>" href="<?= bc_url('about.php') ?>">About</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= ($bc_page??'')==='shop'?'active':'' ?>" href="<?= bc_url('shop.php') ?>" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
          <ul class="dropdown-menu" aria-labelledby="categoriesDropdown" id="headerCategories">
            <li><a class="dropdown-item" href="<?= bc_url('shop.php') ?>">All Categories</a></li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link <?= ($bc_page??'')==='contact'?'active':'' ?>" href="<?= bc_url('contact.php') ?>">Contact</a></li>
      </ul>
      <div class="nav-search d-none d-lg-block me-3">
        <i class="fas fa-search"></i>
        <input type="search" placeholder="Search products..." id="globalSearch">
      </div>
      <div class="d-flex align-items-center gap-2">
        <button class="theme-toggle" title="Toggle dark mode"><i class="fas fa-moon"></i></button>
        <a href="<?= bc_url('customer/wishlist.php') ?>" class="btn btn-link position-relative text-decoration-none">
          <i class="fas fa-heart fa-lg"></i>
          <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle wishlist-badge" style="display:none">0</span>
        </a>
        <a href="<?= bc_url('customer/cart.php') ?>" class="btn btn-link position-relative text-decoration-none">
          <i class="fas fa-shopping-cart fa-lg"></i>
          <span class="badge bg-primary rounded-pill position-absolute top-0 start-100 translate-middle cart-badge" style="display:none">0</span>
        </a>
        <a href="<?= bc_url('auth/login.php') ?>" class="btn btn-outline-custom btn-sm d-none d-md-inline">Login</a>
        <a href="<?= bc_url('auth/register.php') ?>" class="btn btn-primary-custom btn-sm">Register</a>
      </div>
    </div>
  </div>
</nav>
