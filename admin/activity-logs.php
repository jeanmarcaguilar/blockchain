<?php
$bc_title = 'Activity Logs';
$bc_page = 'activity-logs';
$bc_role = 'admin';
$bc_user = 'Admin User';
$bc_avatar = 'https://i.pravatar.cc/150?u=admin';
$bc_dashboard = true;
require_once __DIR__ . '/../includes/head.php';
?>
<div class="dashboard-wrapper">
<?php require_once __DIR__ . '/../includes/dashboard-sidebar.php'; ?>
<div class="dashboard-main">
<?php require_once __DIR__ . '/../includes/dashboard-header.php'; ?>
<main class="dashboard-content">
  <div class="d-flex justify-content-between mb-4"><div><h4 class="mb-1">Activity Logs</h4><p class="text-muted-custom">User and system activity history</p></div>
  <button class="btn btn-outline-custom btn-sm" onclick="BC.toast('Activity log exported!')"><i class="fas fa-download me-1"></i> Export</button></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Time</th><th>User</th><th>Activity</th><th>Details</th><th>Portal</th></tr></thead><tbody id="activityTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const activities = [
    { time: '2 min ago', user: 'Maria Santos', activity: 'Placed order', details: 'BC-2026-00144 · ₱6,499', portal: 'Customer' },
    { time: '30 min ago', user: 'John Reyes', activity: 'Processed order', details: 'BC-2026-00145 → Confirmed', portal: 'Staff' },
    { time: '1 hour ago', user: 'Pedro Garcia', activity: 'Registered account', details: 'New customer signup', portal: 'Public' },
    { time: '1 hour ago', user: 'Admin User', activity: 'Viewed reports', details: 'Sales dashboard accessed', portal: 'Admin' },
    { time: '2 hours ago', user: 'Ana Lopez', activity: 'Added to wishlist', details: 'Galaxy S24', portal: 'Customer' },
    { time: '2 hours ago', user: 'Ana Cruz', activity: 'Updated stock', details: 'Skincare Set: 5 units', portal: 'Staff' },
    { time: '3 hours ago', user: 'Juan Dela Cruz', activity: 'Left review', details: 'Smart Watch Pro · 4 stars', portal: 'Customer' },
    { time: '5 hours ago', user: 'Admin User', activity: 'Approved review', details: 'Review #2 approved', portal: 'Admin' },
    { time: '5 hours ago', user: 'System', activity: 'Blockchain TX verified', details: '12 transactions on Sepolia', portal: 'System' },
    { time: '6 hours ago', user: 'Maria Santos', activity: 'Verified blockchain TX', details: 'BC-2026-00143', portal: 'Customer' }
  ];
  const portalBadge = { Customer: 'bg-primary', Staff: 'bg-success', Admin: 'bg-warning text-dark', Public: 'bg-info', System: 'bg-secondary' };
  document.getElementById('activityTable').innerHTML = activities.map(a => `
    <tr><td><small class="text-muted-custom">${a.time}</small></td><td><strong>${a.user}</strong></td><td>${a.activity}</td><td class="text-muted-custom small">${a.details}</td>
    <td><span class="badge ${portalBadge[a.portal]}">${a.portal}</span></td></tr>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
