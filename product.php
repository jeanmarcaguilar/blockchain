<?php
$bc_title = 'Product Details';
$bc_page = 'product';
$bc_dashboard = false;
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/public-header.php';
?>

<section class="py-5">
  <div class="container" id="productPage">
    <div class="text-center py-5">
      <div class="loading-spinner mx-auto"></div>
      <p class="text-muted-custom mt-3">Loading product...</p>
    </div>
  </div>
</section>

<section class="py-5 bg-white">
  <div class="container">
    <h3 class="section-title mb-4">Related Products</h3>
    <div class="row" id="relatedProducts"></div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/public-footer.php'; ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const id = +new URLSearchParams(location.search).get('id') || 1;
  const product = BlockCartData.products.find(p => p.id === id);
  const container = document.getElementById('productPage');

  if (!product) {
    container.innerHTML = `<div class="card-custom p-5 text-center"><h4>Product not found</h4><a href="shop.php" class="btn btn-primary-custom mt-3">Back to Shop</a></div>`;
    return;
  }

  document.title = product.name + ' – BlockCart';
  const price = getDiscountedPrice(product);
  const productReviews = BlockCartData.reviews.filter(r => r.product.includes(product.name.split(' ')[0]));
  const gallery = [product.image, product.image.replace('w=500', 'w=600'), product.image.replace('w=500', 'w=400')];

  container.innerHTML = `
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb breadcrumb-custom">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="shop.php">Shop</a></li>
        <li class="breadcrumb-item"><a href="shop.php?category=${product.category.toLowerCase().replace(/ & /g,'-').replace(/ /g,'-')}">${product.category}</a></li>
        <li class="breadcrumb-item active">${product.name}</li>
      </ol>
    </nav>
    <div class="row g-5">
      <div class="col-lg-6">
        <div class="card-custom overflow-hidden mb-3">
          <img src="${gallery[0]}" alt="${product.name}" class="w-100" id="mainProductImg" style="max-height:480px;object-fit:cover">
        </div>
        <div class="d-flex gap-2">${gallery.map((img, i) => `
          <button class="btn p-0 border rounded overflow-hidden ${i === 0 ? 'border-primary border-2' : ''}" style="width:80px;height:80px" onclick="document.getElementById('mainProductImg').src='${img}'">
            <img src="${img}" alt="" class="w-100 h-100" style="object-fit:cover">
          </button>`).join('')}
        </div>
      </div>
      <div class="col-lg-6">
        <div class="d-flex gap-2 mb-2">
          ${product.new ? '<span class="badge bg-success">New</span>' : ''}
          ${product.bestseller ? '<span class="badge bg-warning text-dark">Best Seller</span>' : ''}
          ${product.discount ? `<span class="badge bg-danger">-${product.discount}% OFF</span>` : ''}
        </div>
        <h1 class="h2 fw-bold mb-2">${product.name}</h1>
        <div class="rating mb-3">${renderStars(product.rating)} <span class="text-muted-custom ms-2">${product.rating} (${product.reviews} reviews)</span></div>
        <div class="mb-3">
          <span class="product-price fs-3">${formatPrice(price)}</span>
          ${product.discount ? `<span class="old-price fs-5 ms-2">${formatPrice(product.price)}</span>` : ''}
        </div>
        <p class="text-muted-custom mb-4">${product.description}</p>
        <div class="row g-3 mb-4 small">
          <div class="col-6"><strong>SKU:</strong> ${product.sku}</div>
          <div class="col-6"><strong>Brand:</strong> ${product.brand}</div>
          <div class="col-6"><strong>Category:</strong> ${product.category}</div>
          <div class="col-6"><strong>Stock:</strong> <span class="${product.stock <= 10 ? 'text-warning' : 'text-success'}">${product.stock} available</span></div>
        </div>
        <div class="d-flex align-items-center gap-3 mb-4">
          <div class="input-group" style="max-width:140px">
            <button class="btn btn-outline-custom" type="button" id="qtyMinus">−</button>
            <input type="number" class="form-control text-center" id="productQty" value="1" min="1" max="${product.stock}">
            <button class="btn btn-outline-custom" type="button" id="qtyPlus">+</button>
          </div>
          <button class="btn btn-primary-custom flex-grow-1" id="addToCartBtn"><i class="fas fa-cart-plus me-2"></i>Add to Cart</button>
          <button class="btn btn-outline-custom" onclick="toggleWishlist(${product.id})" title="Add to Wishlist"><i class="far fa-heart fa-lg"></i></button>
        </div>
        <div class="card-custom p-3 bg-light">
          <div class="d-flex gap-3 small">
            <div><i class="fas fa-truck text-primary me-1"></i> Free shipping over ₱5,000</div>
            <div><i class="fas fa-link text-success me-1"></i> Blockchain verified</div>
            <div><i class="fas fa-undo text-info me-1"></i> 7-day returns</div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <ul class="nav nav-tabs nav-tabs-custom mb-4" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabDesc">Description</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabReviews">Reviews (${productReviews.length || product.reviews})</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabShipping">Shipping & Returns</button></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="tabDesc">
          <div class="card-custom p-4"><p>${product.description}</p><p class="text-muted-custom mb-0">Premium quality product backed by BlockCart's blockchain verification guarantee. Every purchase is immutably recorded on the Ethereum Sepolia testnet.</p></div>
        </div>
        <div class="tab-pane fade" id="tabReviews">
          <div class="card-custom p-4">
            ${productReviews.length ? productReviews.map(r => `
              <div class="border-bottom pb-3 mb-3">
                <div class="d-flex justify-content-between"><strong>${r.customer}</strong><small class="text-muted-custom">${r.date}</small></div>
                <div class="rating my-2">${renderStars(r.rating)}</div>
                <p class="mb-0">${r.comment}</p>
              </div>`).join('') : '<p class="text-muted-custom">No reviews yet. Be the first to review this product!</p>'}
            <form class="mt-4" data-simulate="Review submitted for moderation!">
              <h6>Write a Review</h6>
              <div class="mb-3"><select class="form-select form-select-custom" required><option value="">Rating</option>${[5,4,3,2,1].map(n=>`<option value="${n}">${n} Stars</option>`).join('')}</select></div>
              <div class="mb-3"><textarea class="form-control form-control-custom" rows="3" placeholder="Share your experience..." required></textarea></div>
              <button type="submit" class="btn btn-primary-custom btn-sm">Submit Review</button>
            </form>
          </div>
        </div>
        <div class="tab-pane fade" id="tabShipping">
          <div class="card-custom p-4">
            <h6>Shipping</h6>
            <p class="text-muted-custom">Standard delivery: 3-5 business days (Metro Manila), 5-7 days (Provincial). Express shipping available at checkout.</p>
            <h6 class="mt-3">Returns</h6>
            <p class="text-muted-custom mb-0">Return within 7 days in original packaging. Blockchain order record helps verify purchase authenticity.</p>
          </div>
        </div>
      </div>
    </div>`;

  document.getElementById('qtyMinus').addEventListener('click', () => { const i = document.getElementById('productQty'); if (+i.value > 1) i.value = +i.value - 1; });
  document.getElementById('qtyPlus').addEventListener('click', () => { const i = document.getElementById('productQty'); if (+i.value < product.stock) i.value = +i.value + 1; });
  document.getElementById('addToCartBtn').addEventListener('click', () => addToCart(product.id, +document.getElementById('productQty').value));

  const related = BlockCartData.products.filter(p => p.category === product.category && p.id !== product.id).slice(0, 4);
  document.getElementById('relatedProducts').innerHTML = related.length
    ? related.map(p => renderProductCard(p)).join('')
    : BlockCartData.products.filter(p => p.id !== product.id).slice(0, 4).map(p => renderProductCard(p)).join('');
});
</script>
<?php require_once __DIR__ . '/includes/footer-scripts.php'; ?>
