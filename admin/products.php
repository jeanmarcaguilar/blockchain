<?php
$bc_title = 'Products';
$bc_page = 'products';
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
  <div class="d-flex justify-content-between align-items-center mb-4"><div><h4 class="mb-1">Products</h4><p class="text-muted-custom mb-0">Manage product catalog</p></div>
  <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fas fa-plus me-2"></i>Add Product</button></div>
  <div class="card-custom"><div class="table-responsive"><table class="table table-custom mb-0"><thead><tr><th>Image</th><th>Name</th><th>SKU</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead><tbody id="productsTable"></tbody></table></div></div>
</main>
</div></div>
<div class="modal fade" id="addProductModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content">
  <div class="modal-header"><h5 class="modal-title">Add New Product</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
  <form data-simulate="Product added successfully!"><div class="modal-body"><div class="row g-3">
    <div class="col-md-8"><label class="form-label">Product Name</label><input type="text" class="form-control form-control-custom" required></div>
    <div class="col-md-4"><label class="form-label">SKU</label><input type="text" class="form-control form-control-custom" placeholder="BC-XXX-000"></div>
    <div class="col-md-4"><label class="form-label">Price (₱)</label><input type="number" class="form-control form-control-custom" required></div>
    <div class="col-md-4"><label class="form-label">Discount (%)</label><input type="number" class="form-control form-control-custom" value="0"></div>
    <div class="col-md-4"><label class="form-label">Stock</label><input type="number" class="form-control form-control-custom" required></div>
    <div class="col-md-6"><label class="form-label">Category</label><select class="form-select form-select-custom" id="modalCategory"></select></div>
    <div class="col-md-6"><label class="form-label">Brand</label><select class="form-select form-select-custom" id="modalBrand"></select></div>
    <div class="col-12"><label class="form-label">Description</label><textarea class="form-control form-control-custom" rows="3"></textarea></div>
  </div></div><div class="modal-footer"><button type="button" class="btn btn-outline-custom" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary-custom">Add Product</button></div></form>
</div></div></div>
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('productsTable').innerHTML = BlockCartData.products.map(p => {
    const price = getDiscountedPrice(p);
    return `<tr><td><img src="${p.image}" width="40" height="40" class="rounded" style="object-fit:cover"></td><td><strong>${p.name}</strong></td><td><code>${p.sku}</code></td><td>${p.category}</td><td>${formatPrice(price)}</td><td>${p.stock}</td>
    <td>${p.stock > 10 ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning text-dark">Low</span>'}</td>
    <td><button class="btn btn-sm btn-outline-custom" onclick="BC.toast('Edit product: ${p.name}','info')"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-outline-danger" data-confirm="Delete this product?" onclick="BC.toast('Product deleted','info')"><i class="fas fa-trash"></i></button></td></tr>`;
  }).join('');
  document.getElementById('modalCategory').innerHTML = BlockCartData.categories.map(c => `<option>${c.name}</option>`).join('');
  document.getElementById('modalBrand').innerHTML = BlockCartData.brands.map(b => `<option>${b.name}</option>`).join('');
});
</script>
<?php require_once __DIR__ . '/../includes/footer-scripts.php'; ?>
