<?php
$bc_title = 'Notifications';
$bc_page = 'notifications';
$bc_role = 'staff';
$bc_user = 'John Reyes';
$bc_avatar = 'https://i.pravatar.cc/150?u=john';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="d-flex justify-content-between mb-4"><h4 class="mb-0">Notifications</h4><button class="btn btn-outline-custom btn-sm" onclick="BC.toast('All marked as read')">Mark All Read</button></div>
  <div class="card-custom" id="staffNotifList"></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('staffNotifList').innerHTML = BlockCartData.notifications.staff.map(n => `
    <div class="notif-item p-4 border-bottom ${n.read?'':'unread bg-light'}"><div class="d-flex gap-3"><div class="notif-icon ${n.color} text-white"><i class="fas ${n.icon}"></i></div>
    <div><strong>${n.title}</strong><p class="text-muted-custom mb-1">${n.message}</p><small class="text-muted-custom">${n.time}</small></div></div></div>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
