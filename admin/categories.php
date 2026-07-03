<?php
$bc_title = 'Categories';
$bc_page = 'categories';
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
  <div class="d-flex justify-content-between mb-4"><h4 class="mb-0">Categories</h4><button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-plus me-2"></i>Add Category</button></div>
  <div class="row g-4" id="categoriesGrid"></div>
</main>
</div></div>
<div class="modal fade" id="addCategoryModal"><div class="modal-dialog"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title">Add Category</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
  <form data-simulate="Category added!"><div class="modal-body"><div class="mb-3"><label class="form-label">Name</label><input type="text" class="form-control form-control-custom" required></div>
  <div class="mb-3"><label class="form-label">Icon (Font Awesome)</label><input type="text" class="form-control form-control-custom" placeholder="fa-laptop"></div></div>
  <div class="modal-footer"><button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary-custom">Add</button></div></form>
</div></div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('categoriesGrid').innerHTML = BlockCartData.categories.map(c => `
    <div class="col-md-6 col-lg-4"><div class="card-custom p-4"><div class="d-flex align-items-center gap-3 mb-3">
      <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fas ${c.icon}"></i></div>
      <div><h5 class="mb-0">${c.name}</h5><small class="text-muted-custom">${c.count} products · ${c.slug}</small></div></div>
      <img src="${c.image}" class="rounded mb-3 w-100" style="height:100px;object-fit:cover" alt="">
      <div class="d-flex gap-2"><button class="btn btn-sm btn-outline-custom flex-grow-1" onclick="BC.toast('Edit ${c.name}','info')"><i class="fas fa-edit"></i> Edit</button>
      <button class="btn btn-sm btn-outline-danger" data-confirm="Delete category?"><i class="fas fa-trash"></i></button></div></div></div>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
