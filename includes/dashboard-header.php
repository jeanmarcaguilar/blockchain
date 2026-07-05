<?php
$notifKey = ['customer' => 'customer', 'staff' => 'staff', 'admin' => 'admin'][$bc_role ?? 'customer'];
?>
<header class="dashboard-header">
  <button class="btn btn-link d-lg-none me-2" id="sidebarToggle"><i class="fas fa-bars fa-lg"></i></button>
  <nav aria-label="breadcrumb" class="flex-grow-1">
    <ol class="breadcrumb breadcrumb-custom mb-0">
      <li class="breadcrumb-item"><a href="<?= bc_url(($bc_role??'customer') . '/dashboard.php') ?>">Home</a></li>
      <?php if (!empty($bc_breadcrumb)): ?>
        <?php foreach ($bc_breadcrumb as $i => $crumb): ?>
          <li class="breadcrumb-item <?= $i === count($bc_breadcrumb)-1 ? 'active' : '' ?>">
            <?php if (is_array($crumb)): ?><a href="<?= $crumb['url'] ?>"><?= $crumb['label'] ?></a><?php else: ?><?= $crumb ?><?php endif; ?>
          </li>
        <?php endforeach; ?>
      <?php else: ?>
        <li class="breadcrumb-item active"><?= $bc_title ?? 'Dashboard' ?></li>
      <?php endif; ?>
    </ol>
  </nav>
  <div class="d-flex align-items-center gap-2 ms-auto">
    <div class="nav-search d-none d-md-block" style="max-width:220px">
      <i class="fas fa-search"></i>
      <input type="search" placeholder="Search...">
    </div>
    <button class="theme-toggle" title="Toggle dark mode"><i class="fas fa-moon"></i></button>
    <div class="dropdown">
      <button class="btn btn-link position-relative" data-bs-toggle="dropdown">
        <i class="fas fa-bell fa-lg"></i>
        <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle" style="font-size:.6rem">2</span>
      </button>
      <div class="dropdown-menu dropdown-menu-end notif-dropdown shadow-lg border-0 p-0" id="notifDropdown"></div>
    </div>
    <div class="dropdown">
      <button class="btn btn-link d-flex align-items-center gap-2 text-decoration-none" data-bs-toggle="dropdown">
        <img src="<?= $bc_avatar ?? 'https://i.pravatar.cc/150?u=user' ?>" class="profile-avatar" alt="Profile">
        <span class="d-none d-md-inline fw-medium"><?= $bc_user ?? 'User' ?></span>
        <i class="fas fa-chevron-down small"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
        <li><a class="dropdown-item" href="<?= bc_url(($bc_role??'customer') . '/profile.php') ?>"><i class="fas fa-user me-2"></i>Profile</a></li>
        <li><a class="dropdown-item" href="<?= bc_url(($bc_role??'customer') . '/settings.php') ?>"><i class="fas fa-cog me-2"></i>Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="<?= bc_url('auth/login.php') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
      </ul>
    </div>
  </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const key = '<?= $notifKey ?>';
  const notifs = BlockCartData.notifications[key] || [];
  const el = document.getElementById('notifDropdown');
  if (el) {
    el.innerHTML = '<div class="p-3 border-bottom fw-semibold">Notifications</div>' +
      notifs.map(n => `<div class="notif-item ${n.read?'':'unread'}"><div class="notif-icon ${n.color} text-white"><i class="fas ${n.icon}"></i></div><div><div class="fw-medium small">${n.title}</div><div class="text-muted-custom" style="font-size:.8rem">${n.message}</div><small class="text-muted-custom">${n.time}</small></div></div>`).join('') +
      '<div class="p-2 text-center"><a href="<?= bc_url(($bc_role??'customer') . '/notifications.php') ?>" class="small">View All</a></div>';
  }
});
</script>
