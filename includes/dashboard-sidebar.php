<?php
$bc_role = $bc_role ?? 'customer';
$bc_user = $bc_user ?? 'Maria Santos';
$bc_avatar = $bc_avatar ?? 'https://i.pravatar.cc/150?u=maria';

$menus = [
  'customer' => [
    ['section' => 'Main', 'items' => [
      ['icon' => 'fa-th-large', 'label' => 'Dashboard', 'url' => 'dashboard.php', 'page' => 'dashboard'],
      ['icon' => 'fa-shopping-bag', 'label' => 'My Orders', 'url' => 'orders.php', 'page' => 'orders'],
      ['icon' => 'fa-heart', 'label' => 'Wishlist', 'url' => 'wishlist.php', 'page' => 'wishlist'],
      ['icon' => 'fa-shopping-cart', 'label' => 'Cart', 'url' => 'cart.php', 'page' => 'cart'],
    ]],
    ['section' => 'Blockchain', 'items' => [
      ['icon' => 'fa-link', 'label' => 'Verification', 'url' => 'blockchain.php', 'page' => 'blockchain'],
    ]],
    ['section' => 'Account', 'items' => [
      ['icon' => 'fa-user', 'label' => 'Profile', 'url' => 'profile.php', 'page' => 'profile'],
      ['icon' => 'fa-bell', 'label' => 'Notifications', 'url' => 'notifications.php', 'page' => 'notifications', 'badge' => '2'],
      ['icon' => 'fa-cog', 'label' => 'Settings', 'url' => 'settings.php', 'page' => 'settings'],
    ]],
  ],
  'staff' => [
    ['section' => 'Main', 'items' => [
      ['icon' => 'fa-th-large', 'label' => 'Dashboard', 'url' => 'dashboard.php', 'page' => 'dashboard'],
      ['icon' => 'fa-clipboard-list', 'label' => 'Orders', 'url' => 'orders.php', 'page' => 'orders', 'badge' => '3'],
      ['icon' => 'fa-boxes', 'label' => 'Inventory', 'url' => 'inventory.php', 'page' => 'inventory'],
      ['icon' => 'fa-file-invoice', 'label' => 'Invoices', 'url' => 'invoices.php', 'page' => 'invoices'],
    ]],
    ['section' => 'Blockchain', 'items' => [
      ['icon' => 'fa-link', 'label' => 'Blockchain', 'url' => 'blockchain.php', 'page' => 'blockchain'],
      ['icon' => 'fa-chart-bar', 'label' => 'Reports', 'url' => 'reports.php', 'page' => 'reports'],
    ]],
    ['section' => 'Account', 'items' => [
      ['icon' => 'fa-bell', 'label' => 'Notifications', 'url' => 'notifications.php', 'page' => 'notifications', 'badge' => '2'],
      ['icon' => 'fa-user', 'label' => 'Profile', 'url' => 'profile.php', 'page' => 'profile'],
      ['icon' => 'fa-cog', 'label' => 'Settings', 'url' => 'settings.php', 'page' => 'settings'],
    ]],
  ],
  'admin' => [
    ['section' => 'Overview', 'items' => [
      ['icon' => 'fa-th-large', 'label' => 'Dashboard', 'url' => 'dashboard.php', 'page' => 'dashboard'],
      ['icon' => 'fa-chart-line', 'label' => 'Reports', 'url' => 'reports.php', 'page' => 'reports'],
      ['icon' => 'fa-link', 'label' => 'Blockchain', 'url' => 'blockchain.php', 'page' => 'blockchain'],
    ]],
    ['section' => 'Catalog', 'items' => [
      ['icon' => 'fa-box', 'label' => 'Products', 'url' => 'products.php', 'page' => 'products'],
      ['icon' => 'fa-tags', 'label' => 'Categories', 'url' => 'categories.php', 'page' => 'categories'],
      ['icon' => 'fa-trademark', 'label' => 'Brands', 'url' => 'brands.php', 'page' => 'brands'],
      ['icon' => 'fa-warehouse', 'label' => 'Inventory', 'url' => 'inventory.php', 'page' => 'inventory'],
    ]],
    ['section' => 'Management', 'items' => [
      ['icon' => 'fa-shopping-bag', 'label' => 'Orders', 'url' => 'orders.php', 'page' => 'orders'],
      ['icon' => 'fa-star', 'label' => 'Reviews', 'url' => 'reviews.php', 'page' => 'reviews', 'badge' => '1'],
      ['icon' => 'fa-users', 'label' => 'Customers', 'url' => 'users.php', 'page' => 'users'],
      ['icon' => 'fa-user-tie', 'label' => 'Staff', 'url' => 'staff.php', 'page' => 'staff'],
    ]],
    ['section' => 'System', 'items' => [
      ['icon' => 'fa-cog', 'label' => 'Settings', 'url' => 'settings.php', 'page' => 'settings'],
      ['icon' => 'fa-shield-alt', 'label' => 'Audit Logs', 'url' => 'audit-logs.php', 'page' => 'audit-logs'],
      ['icon' => 'fa-history', 'label' => 'Activity Logs', 'url' => 'activity-logs.php', 'page' => 'activity-logs'],
    ]],
  ]
];

$portalPrefix = ['customer' => 'customer', 'staff' => 'staff', 'admin' => 'admin'][$bc_role];
$menu = $menus[$bc_role];
?>
<div class="sidebar-overlay"></div>
<aside class="dashboard-sidebar">
  <div class="sidebar-brand"><i class="fas fa-cube me-2"></i>BlockCart <small class="text-muted-custom d-block" style="font-size:.65rem;font-weight:400"><?= ucfirst($bc_role) ?> Portal</small></div>
  <nav class="sidebar-nav">
    <?php foreach ($menu as $section): ?>
      <div class="sidebar-section"><?= $section['section'] ?></div>
      <?php foreach ($section['items'] as $item): ?>
        <a href="<?= bc_url($portalPrefix . '/' . $item['url']) ?>" class="sidebar-link <?= ($bc_page ?? '') === $item['page'] ? 'active' : '' ?>">
          <i class="fas <?= $item['icon'] ?>"></i> <?= $item['label'] ?>
          <?php if (!empty($item['badge'])): ?><span class="badge bg-danger rounded-pill"><?= $item['badge'] ?></span><?php endif; ?>
        </a>
      <?php endforeach; ?>
    <?php endforeach; ?>
    <div class="sidebar-section">Portal</div>
    <a href="<?= bc_url('index.php') ?>" class="sidebar-link"><i class="fas fa-store"></i> Visit Store</a>
    <a href="<?= bc_url('auth/login.php') ?>" class="sidebar-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </nav>
</aside>
