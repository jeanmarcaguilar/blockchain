<?php
$bc_title = 'System Settings';
$bc_page = 'settings';
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
  <h4 class="mb-4">System Settings</h4>
  <ul class="nav nav-tabs nav-tabs-custom mb-4" role="tablist">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabGeneral">General</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabEmail">Email</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabSecurity">Security</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabBackup">Backup</button></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="tabGeneral">
      <div class="card-custom p-4"><form data-simulate="General settings saved!"><div class="row g-3">
        <div class="col-md-6"><label class="form-label">Site Name</label><input type="text" class="form-control form-control-custom" value="BlockCart"></div>
        <div class="col-md-6"><label class="form-label">Tagline</label><input type="text" class="form-control form-control-custom" value="Shop Securely with Blockchain"></div>
        <div class="col-md-4"><label class="form-label">Currency</label><input type="text" class="form-control form-control-custom" value="₱"></div>
        <div class="col-md-4"><label class="form-label">Tax Rate (%)</label><input type="number" class="form-control form-control-custom" value="12"></div>
        <div class="col-md-4"><label class="form-label">Shipping Fee (₱)</label><input type="number" class="form-control form-control-custom" value="99"></div>
        <div class="col-12"><label class="form-label">Contract Address</label><input type="text" class="form-control form-control-custom" value="0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb0"></div>
        <div class="col-12"><button type="submit" class="btn btn-primary-custom">Save General Settings</button></div>
      </div></form></div>
    </div>
    <div class="tab-pane fade" id="tabEmail">
      <div class="card-custom p-4"><form data-simulate="Email settings saved!"><div class="row g-3">
        <div class="col-md-6"><label class="form-label">SMTP Host</label><input type="text" class="form-control form-control-custom" value="smtp.blockcart.com"></div>
        <div class="col-md-6"><label class="form-label">SMTP Port</label><input type="number" class="form-control form-control-custom" value="587"></div>
        <div class="col-md-6"><label class="form-label">From Email</label><input type="email" class="form-control form-control-custom" value="noreply@blockcart.com"></div>
        <div class="col-md-6"><label class="form-label">From Name</label><input type="text" class="form-control form-control-custom" value="BlockCart"></div>
        <div class="col-12"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked><label class="form-check-label">Send order confirmation emails</label></div></div>
        <div class="col-12"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked><label class="form-check-label">Send shipping notification emails</label></div></div>
        <div class="col-12"><button type="submit" class="btn btn-primary-custom">Save Email Settings</button> <button type="button" class="btn btn-outline-custom" onclick="BC.toast('Test email sent!')">Send Test Email</button></div>
      </div></form></div>
    </div>
    <div class="tab-pane fade" id="tabSecurity">
      <div class="card-custom p-4"><form data-simulate="Security settings saved!"><div class="row g-3">
        <div class="col-12"><div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" checked><label class="form-check-label">Require email verification</label></div></div>
        <div class="col-12"><div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" checked><label class="form-check-label">Enable two-factor authentication</label></div></div>
        <div class="col-12"><div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" checked><label class="form-check-label">Force HTTPS</label></div></div>
        <div class="col-md-6"><label class="form-label">Session Timeout (minutes)</label><input type="number" class="form-control form-control-custom" value="30"></div>
        <div class="col-md-6"><label class="form-label">Max Login Attempts</label><input type="number" class="form-control form-control-custom" value="5"></div>
        <div class="col-12"><button type="submit" class="btn btn-primary-custom">Save Security Settings</button></div>
      </div></form></div>
    </div>
    <div class="tab-pane fade" id="tabBackup">
      <div class="card-custom p-4">
        <h5 class="mb-3">Database Backup</h5>
        <p class="text-muted-custom">Last backup: July 2, 2026 at 3:00 AM · Size: 24.5 MB</p>
        <div class="d-flex gap-2 mb-4">
          <button class="btn btn-primary-custom" onclick="BC.showLoading();setTimeout(()=>{BC.hideLoading();BC.toast('Backup created!')},2000)"><i class="fas fa-database me-2"></i>Create Backup Now</button>
          <button class="btn btn-outline-custom" onclick="BC.toast('Backup downloaded!')"><i class="fas fa-download me-2"></i>Download Latest</button>
        </div>
        <h6>Auto Backup Schedule</h6>
        <form data-simulate="Backup schedule updated!"><div class="row g-3 mt-1">
          <div class="col-md-4"><select class="form-select form-select-custom"><option>Daily at 3:00 AM</option><option>Weekly</option><option>Monthly</option></select></div>
          <div class="col-md-4"><div class="form-check form-switch mt-2"><input class="form-check-input" type="checkbox" checked><label class="form-check-label">Enable auto backup</label></div></div>
          <div class="col-md-4"><button type="submit" class="btn btn-outline-custom">Save Schedule</button></div>
        </div></form>
        <div class="mt-4"><h6>Recent Backups</h6><ul class="list-group list-group-flush"><li class="list-group-item d-flex justify-content-between px-0"><span>backup_2026-07-02.sql</span><small class="text-muted-custom">24.5 MB</small></li>
        <li class="list-group-item d-flex justify-content-between px-0"><span>backup_2026-07-01.sql</span><small class="text-muted-custom">24.1 MB</small></li></ul></div>
      </div>
    </div>
  </div>
</main>
</div></div>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
