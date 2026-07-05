<?php
$bc_title = 'Brands';
$bc_page = 'brands';
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
  <div class="d-flex justify-content-between mb-4"><h4 class="mb-0">Brands</h4><button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addBrandModal"><i class="fas fa-plus me-2"></i>Add Brand</button></div>
  <div class="row g-4" id="brandsGrid"></div>
</main>
</div></div>
<div class="modal fade" id="addBrandModal"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title">Add Brand</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
  <form data-simulate="Brand added!"><div class="modal-body"><div class="mb-3"><label class="form-label">Brand Name</label><input type="text" class="form-control form-control-custom" required></div>
  <div class="mb-3"><label class="form-label">Icon Class</label><input type="text" class="form-control form-control-custom" placeholder="fa-apple"></div></div>
  <div class="modal-footer"><button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary-custom">Add</button></div></form>
</div></div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('brandsGrid').innerHTML = BlockCartData.brands.map(b => {
    const count = BlockCartData.products.filter(p => p.brand === b.name).length;
    return `<div class="col-md-6 col-lg-4"><div class="card-custom p-4 text-center"><div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3"><i class="fas ${b.logo} fa-2x"></i></div>
    <h5>${b.name}</h5><p class="text-muted-custom small">${count} products</p>
    <div class="d-flex gap-2 justify-content-center"><button class="btn btn-sm btn-outline-custom" onclick="BC.toast('Edit ${b.name}','info')"><i class="fas fa-edit"></i></button>
    <button class="btn btn-sm btn-outline-danger" data-confirm="Delete brand?"><i class="fas fa-trash"></i></button></div></div></div>`;
  }).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
