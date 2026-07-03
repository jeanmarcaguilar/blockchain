<?php
$bc_title = 'Notifications';
$bc_page = 'notifications';
$bc_role = 'customer';
$bc_user = 'Maria Santos';
$bc_avatar = 'https://i.pravatar.cc/150?u=maria';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div><h4 class="mb-1">Notifications</h4><p class="text-muted-custom mb-0" id="notifSummary"></p></div>
    <button class="btn btn-outline-custom btn-sm" id="markAllRead"><i class="fas fa-check-double me-1"></i> Mark All Read</button>
  </div>
  <div class="card-custom" id="notifList"></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const notifs = BlockCartData.notifications.customer;
  document.getElementById('notifSummary').textContent = `${notifs.filter(n=>!n.read).length} unread of ${notifs.length} total`;
  document.getElementById('notifList').innerHTML = notifs.map(n => `
    <div class="notif-item p-4 border-bottom ${n.read?'':'unread bg-light'}">
      <div class="d-flex gap-3"><div class="notif-icon ${n.color} text-white flex-shrink-0"><i class="fas ${n.icon}"></i></div>
      <div class="flex-grow-1"><div class="d-flex justify-content-between"><strong>${n.title}</strong><small class="text-muted-custom">${n.time}</small></div>
      <p class="text-muted-custom mb-0 mt-1">${n.message}</p></div></div>
    </div>`).join('');
  document.getElementById('markAllRead').addEventListener('click', () => { BC.toast('All notifications marked as read'); document.querySelectorAll('.notif-item.unread').forEach(el => el.classList.remove('unread','bg-light')); });
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
