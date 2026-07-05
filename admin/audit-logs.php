<?php
$bc_title = 'Audit Logs';
$bc_page = 'audit-logs';
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
  <div class="d-flex justify-content-between mb-4"><div><h4 class="mb-1">Audit Logs</h4><p class="text-muted-custom">Security and compliance audit trail</p></div>
  <button class="btn btn-outline-custom btn-sm" onclick="BC.toast('Audit log exported!')"><i class="fas fa-download me-1"></i> Export</button></div>
  <div class="card-custom p-3 mb-4"><div class="row g-2"><div class="col-md-4"><input type="search" class="form-control form-control-custom" id="auditSearch" placeholder="Search logs..."></div>
  <div class="col-md-3"><select class="form-select form-select-custom" id="auditTypeFilter"><option value="">All Types</option><option value="login">Login</option><option value="update">Update</option><option value="delete">Delete</option><option value="security">Security</option></select></div></div></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Timestamp</th><th>User</th><th>Action</th><th>Resource</th><th>IP Address</th><th>Severity</th></tr></thead><tbody id="auditTable"></tbody></table></div></div>
</main>
</div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const logs = [
    { time: '2026-07-03 11:45:22', user: 'Admin User', action: 'Updated product', resource: 'Smart Watch Pro', ip: '192.168.1.100', type: 'update', severity: 'info' },
    { time: '2026-07-03 10:30:15', user: 'John Reyes', action: 'Changed order status', resource: 'BC-2026-00144', ip: '192.168.1.105', type: 'update', severity: 'info' },
    { time: '2026-07-03 09:15:08', user: 'Admin User', action: 'Suspended user', resource: 'Pedro Garcia', ip: '192.168.1.100', type: 'security', severity: 'warning' },
    { time: '2026-07-02 16:22:44', user: 'Admin User', action: 'Login successful', resource: 'Admin Portal', ip: '192.168.1.100', type: 'login', severity: 'info' },
    { time: '2026-07-02 14:10:33', user: 'Ana Cruz', action: 'Updated inventory', resource: 'Skincare Set', ip: '192.168.1.108', type: 'update', severity: 'info' },
    { time: '2026-07-02 11:05:19', user: 'Admin User', action: 'Deleted review', resource: 'Review #12', ip: '192.168.1.100', type: 'delete', severity: 'warning' },
    { time: '2026-07-01 18:45:00', user: 'System', action: 'Auto backup completed', resource: 'Database', ip: '127.0.0.1', type: 'security', severity: 'info' },
    { time: '2026-07-01 08:30:12', user: 'Admin User', action: 'Changed security settings', resource: '2FA Policy', ip: '192.168.1.100', type: 'security', severity: 'warning' }
  ];
  function render() {
    const search = document.getElementById('auditSearch').value.toLowerCase();
    const type = document.getElementById('auditTypeFilter').value;
    let filtered = logs.filter(l => {
      if (search && !l.action.toLowerCase().includes(search) && !l.user.toLowerCase().includes(search) && !l.resource.toLowerCase().includes(search)) return false;
      if (type && l.type !== type) return false;
      return true;
    });
    const sevBadge = { info: 'bg-info', warning: 'bg-warning text-dark', danger: 'bg-danger' };
    document.getElementById('auditTable').innerHTML = filtered.map(l => `
      <tr><td><code class="small">${l.time}</code></td><td>${l.user}</td><td>${l.action}</td><td>${l.resource}</td><td><code class="small">${l.ip}</code></td>
      <td><span class="badge ${sevBadge[l.severity]}">${l.severity}</span></td></tr>`).join('');
  }
  ['auditSearch','auditTypeFilter'].forEach(id => document.getElementById(id).addEventListener('input', render));
  render();
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
