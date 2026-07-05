/* BlockCart Sample Data */
const BlockCartData = {
  settings: {
    siteName: 'BlockCart',
    tagline: 'Shop Securely with Blockchain',
    contractAddress: '0x742d35Cc6634C0532925a3b844Bc9e7595f0bEb0',
    network: 'Sepolia Testnet',
    currency: '₱',
    taxRate: 0.12,
    shippingFee: 99
  },

  categories: [
    { id: 1, name: 'Electronics', slug: 'electronics', icon: 'fa-laptop', count: 48, image: 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400' },
    { id: 2, name: 'Fashion', slug: 'fashion', icon: 'fa-shirt', count: 86, image: 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400' },
    { id: 3, name: 'Home & Living', slug: 'home-living', icon: 'fa-couch', count: 34, image: 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400' },
    { id: 4, name: 'Sports', slug: 'sports', icon: 'fa-dumbbell', count: 27, image: 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=400' },
    { id: 5, name: 'Beauty', slug: 'beauty', icon: 'fa-spa', count: 41, image: 'https://images.unsplash.com/photo-1596462502278-27bfdd403f77?w=400' },
    { id: 6, name: 'Books', slug: 'books', icon: 'fa-book', count: 19, image: 'https://images.unsplash.com/photo-1495446815901-a7297e633e8d?w=400' }
  ],

  brands: [
    { id: 1, name: 'Apple', logo: 'fa-apple' },
    { id: 2, name: 'Samsung', logo: 'fa-mobile' },
    { id: 3, name: 'Nike', logo: 'fa-shoe-prints' },
    { id: 4, name: 'Sony', logo: 'fa-headphones' },
    { id: 5, name: 'Dell', logo: 'fa-desktop' }
  ],

  products: [
    { id: 1, name: 'Wireless Noise-Cancelling Headphones', slug: 'wireless-headphones', price: 4999, discount: 15, category: 'Electronics', brand: 'Sony', sku: 'BC-ELEC-001', stock: 45, rating: 4.8, reviews: 234, image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500', featured: true, bestseller: true, new: false, description: 'Premium wireless headphones with active noise cancellation and 30-hour battery life.' },
    { id: 2, name: 'Smart Watch Pro Series 8', slug: 'smart-watch-pro', price: 12999, discount: 10, category: 'Electronics', brand: 'Apple', sku: 'BC-ELEC-002', stock: 28, rating: 4.9, reviews: 512, image: 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500', featured: true, bestseller: true, new: true, description: 'Advanced health tracking, GPS, and seamless iPhone integration.' },
    { id: 3, name: 'Ultrabook Laptop 14"', slug: 'ultrabook-laptop', price: 45999, discount: 0, category: 'Electronics', brand: 'Dell', sku: 'BC-ELEC-003', stock: 12, rating: 4.7, reviews: 89, image: 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=500', featured: true, bestseller: false, new: true, description: 'Lightweight powerhouse with Intel i7, 16GB RAM, and 512GB SSD.' },
    { id: 4, name: 'Running Shoes Air Max', slug: 'running-shoes', price: 6499, discount: 20, category: 'Sports', brand: 'Nike', sku: 'BC-SPRT-001', stock: 67, rating: 4.6, reviews: 178, image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500', featured: false, bestseller: true, new: false, description: 'Responsive cushioning and breathable mesh upper for all-day comfort.' },
    { id: 5, name: 'Smartphone Galaxy S24', slug: 'galaxy-s24', price: 54999, discount: 5, category: 'Electronics', brand: 'Samsung', sku: 'BC-ELEC-004', stock: 34, rating: 4.8, reviews: 421, image: 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=500', featured: true, bestseller: true, new: true, description: 'AI-powered camera, stunning AMOLED display, and all-day battery.' },
    { id: 6, name: 'Minimalist Desk Lamp', slug: 'desk-lamp', price: 1899, discount: 0, category: 'Home & Living', brand: 'Sony', sku: 'BC-HOME-001', stock: 89, rating: 4.5, reviews: 56, image: 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=500', featured: false, bestseller: false, new: true, description: 'Adjustable LED desk lamp with warm/cool light modes.' },
    { id: 7, name: 'Organic Skincare Set', slug: 'skincare-set', price: 2799, discount: 25, category: 'Beauty', brand: 'Sony', sku: 'BC-BEAU-001', stock: 5, rating: 4.4, reviews: 92, image: 'https://images.unsplash.com/photo-1556228720-195a672e8a03?w=500', featured: false, bestseller: false, new: false, description: 'Complete 5-piece organic skincare routine for radiant skin.' },
    { id: 8, name: 'Bluetooth Speaker Portable', slug: 'bluetooth-speaker', price: 3299, discount: 12, category: 'Electronics', brand: 'Sony', sku: 'BC-ELEC-005', stock: 56, rating: 4.7, reviews: 167, image: 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=500', featured: true, bestseller: true, new: false, description: '360° sound, waterproof design, 20-hour playtime.' }
  ],

  orders: [
    { id: 'BC-2026-00142', customer: 'Maria Santos', email: 'maria.santos@email.com', date: '2026-07-01', total: 18497, status: 'delivered', items: 3, payment: 'COD', staff: 'John Reyes', txHash: '0x8f3b2a1c9d4e5f678901234567890abcdef1234567890abcdef1234567890ab', blockNumber: 5847291, verified: true },
    { id: 'BC-2026-00143', customer: 'Maria Santos', email: 'maria.santos@email.com', date: '2026-07-02', total: 12999, status: 'shipped', items: 1, payment: 'COD', staff: 'John Reyes', txHash: '0x1a2b3c4d5e6f789012345678901234567890abcdef1234567890abcdef123456', blockNumber: 5848102, verified: true },
    { id: 'BC-2026-00144', customer: 'Maria Santos', email: 'maria.santos@email.com', date: '2026-07-03', total: 6499, status: 'processing', items: 1, payment: 'COD', staff: 'Ana Cruz', txHash: '0x9c8d7e6f5a4b3c2d1e0f9a8b7c6d5e4f3a2b1c0d9e8f7a6b5c4d3e2f1a0b9c8', blockNumber: 5849203, verified: true },
    { id: 'BC-2026-00145', customer: 'Juan Dela Cruz', email: 'juan@email.com', date: '2026-07-03', total: 54999, status: 'pending', items: 1, payment: 'COD', staff: null, txHash: null, blockNumber: null, verified: false },
    { id: 'BC-2026-00146', customer: 'Ana Lopez', email: 'ana@email.com', date: '2026-07-02', total: 8798, status: 'confirmed', items: 2, payment: 'COD', staff: 'Ana Cruz', txHash: '0xabcdef1234567890abcdef1234567890abcdef1234567890abcdef12345678', blockNumber: 5848500, verified: true }
  ],

  users: {
    customers: [
      { id: 1, name: 'Maria Santos', email: 'maria.santos@email.com', phone: '+63 917 123 4567', status: 'active', orders: 12, joined: '2025-03-15', avatar: 'https://i.pravatar.cc/150?u=maria' },
      { id: 2, name: 'Juan Dela Cruz', email: 'juan@email.com', phone: '+63 918 234 5678', status: 'active', orders: 5, joined: '2025-06-20', avatar: 'https://i.pravatar.cc/150?u=juan' },
      { id: 3, name: 'Ana Lopez', email: 'ana@email.com', phone: '+63 919 345 6789', status: 'active', orders: 8, joined: '2025-01-10', avatar: 'https://i.pravatar.cc/150?u=ana' },
      { id: 4, name: 'Pedro Garcia', email: 'pedro@email.com', phone: '+63 920 456 7890', status: 'suspended', orders: 2, joined: '2025-09-05', avatar: 'https://i.pravatar.cc/150?u=pedro' }
    ],
    staff: [
      { id: 1, name: 'John Reyes', email: 'john.reyes@blockcart.com', role: 'Order Manager', status: 'active', orders: 156, avatar: 'https://i.pravatar.cc/150?u=john' },
      { id: 2, name: 'Ana Cruz', email: 'ana.cruz@blockcart.com', role: 'Inventory Manager', status: 'active', orders: 98, avatar: 'https://i.pravatar.cc/150?u=anacruz' }
    ],
    admins: [
      { id: 1, name: 'Admin User', email: 'admin@blockcart.com', role: 'Super Admin', status: 'active', avatar: 'https://i.pravatar.cc/150?u=admin' }
    ]
  },

  notifications: {
    customer: [
      { id: 1, title: 'Order Shipped', message: 'Your order BC-2026-00143 has been shipped.', time: '2 hours ago', read: false, icon: 'fa-truck', color: 'bg-primary' },
      { id: 2, title: 'Order Delivered', message: 'Order BC-2026-00142 was delivered successfully.', time: '1 day ago', read: true, icon: 'fa-check-circle', color: 'bg-success' },
      { id: 3, title: 'Blockchain Verified', message: 'Transaction verified on Sepolia Testnet.', time: '2 days ago', read: true, icon: 'fa-link', color: 'bg-info' },
      { id: 4, title: 'Review Reminder', message: 'Share your experience with Wireless Headphones.', time: '3 days ago', read: true, icon: 'fa-star', color: 'bg-warning' }
    ],
    staff: [
      { id: 1, title: 'New Order', message: 'Order BC-2026-00145 requires processing.', time: '30 min ago', read: false, icon: 'fa-shopping-bag', color: 'bg-primary' },
      { id: 2, title: 'Low Stock Alert', message: 'Organic Skincare Set has only 5 units left.', time: '1 hour ago', read: false, icon: 'fa-exclamation-triangle', color: 'bg-warning' }
    ],
    admin: [
      { id: 1, title: 'New User Registration', message: 'Pedro Garcia registered as a new customer.', time: '1 hour ago', read: false, icon: 'fa-user-plus', color: 'bg-primary' },
      { id: 2, title: 'Low Stock', message: '3 products are below minimum stock level.', time: '2 hours ago', read: false, icon: 'fa-box', color: 'bg-warning' },
      { id: 3, title: 'Blockchain Success', message: '12 transactions verified today on Sepolia.', time: '5 hours ago', read: true, icon: 'fa-link', color: 'bg-success' }
    ]
  },

  reviews: [
    { id: 1, product: 'Wireless Noise-Cancelling Headphones', customer: 'Maria Santos', rating: 5, comment: 'Amazing sound quality! The noise cancellation is top-notch.', date: '2026-06-28', status: 'approved' },
    { id: 2, product: 'Smart Watch Pro Series 8', customer: 'Juan Dela Cruz', rating: 4, comment: 'Great watch, battery could be better.', date: '2026-06-25', status: 'approved' },
    { id: 3, product: 'Running Shoes Air Max', customer: 'Ana Lopez', rating: 5, comment: 'Most comfortable running shoes I have ever owned!', date: '2026-07-01', status: 'pending' }
  ],

  inventory: [
    { id: 1, product: 'Wireless Headphones', sku: 'BC-ELEC-001', stock: 45, minStock: 10, status: 'in-stock' },
    { id: 2, product: 'Smart Watch Pro', sku: 'BC-ELEC-002', stock: 28, minStock: 15, status: 'in-stock' },
    { id: 3, product: 'Ultrabook Laptop', sku: 'BC-ELEC-003', stock: 12, minStock: 10, status: 'in-stock' },
    { id: 4, product: 'Running Shoes', sku: 'BC-SPRT-001', stock: 67, minStock: 20, status: 'in-stock' },
    { id: 5, product: 'Galaxy S24', sku: 'BC-ELEC-004', stock: 34, minStock: 10, status: 'in-stock' },
    { id: 6, product: 'Desk Lamp', sku: 'BC-HOME-001', stock: 89, minStock: 15, status: 'in-stock' },
    { id: 7, product: 'Skincare Set', sku: 'BC-BEAU-001', stock: 5, minStock: 10, status: 'low-stock' },
    { id: 8, product: 'Bluetooth Speaker', sku: 'BC-ELEC-005', stock: 56, minStock: 15, status: 'in-stock' }
  ],

  blockchainTx: [
    { id: 1, orderId: 'BC-2026-00142', txHash: '0x8f3b2a1c9d4e5f678901234567890abcdef1234567890abcdef1234567890ab', blockNumber: 5847291, amount: 18497, status: 'verified', timestamp: '2026-07-01 14:32:18', customerHash: '0x7a3f...9c2d' },
    { id: 2, orderId: 'BC-2026-00143', txHash: '0x1a2b3c4d5e6f789012345678901234567890abcdef1234567890abcdef123456', blockNumber: 5848102, amount: 12999, status: 'verified', timestamp: '2026-07-02 09:15:44', customerHash: '0x7a3f...9c2d' },
    { id: 3, orderId: 'BC-2026-00144', txHash: '0x9c8d7e6f5a4b3c2d1e0f9a8b7c6d5e4f3a2b1c0d9e8f7a6b5c4d3e2f1a0b9c8', blockNumber: 5849203, amount: 6499, status: 'verified', timestamp: '2026-07-03 11:08:22', customerHash: '0x7a3f...9c2d' }
  ],

  faqs: [
    { q: 'How does blockchain verification work?', a: 'After placing an order, a transaction record is created on the Ethereum Sepolia testnet. You can verify your order anytime using the transaction hash.' },
    { q: 'What payment methods do you accept?', a: 'We currently accept Cash on Delivery (COD). Blockchain records are created for transaction verification, not payment processing.' },
    { q: 'How long does delivery take?', a: 'Standard delivery takes 3-5 business days within Metro Manila and 5-7 days for provincial areas.' },
    { q: 'Can I return a product?', a: 'Yes, you can return products within 7 days of delivery if they are unused and in original packaging.' },
    { q: 'Is my personal data stored on the blockchain?', a: 'No. Only order verification data (order ID, amount, timestamp) is stored on-chain. Personal information remains in our secure database.' }
  ],

  testimonials: [
    { name: 'Maria Santos', role: 'Verified Buyer', text: 'Love the blockchain verification feature! I can prove my purchase was recorded securely.', rating: 5, avatar: 'https://i.pravatar.cc/80?u=maria' },
    { name: 'Juan Dela Cruz', role: 'Tech Enthusiast', text: 'BlockCart combines modern e-commerce with cutting-edge blockchain technology seamlessly.', rating: 5, avatar: 'https://i.pravatar.cc/80?u=juan' },
    { name: 'Ana Lopez', role: 'Frequent Shopper', text: 'Fast delivery, great products, and the order tracking is excellent. Highly recommended!', rating: 4, avatar: 'https://i.pravatar.cc/80?u=ana' }
  ],

  salesChart: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
    revenue: [125000, 148000, 132000, 167000, 189000, 201000, 156000],
    orders: [89, 102, 95, 118, 134, 142, 108]
  },

  cart: [
    { productId: 1, qty: 1 },
    { productId: 4, qty: 2 }
  ],

  wishlist: [2, 5, 8],

  currentUser: {
    customer: { name: 'Maria Santos', email: 'maria.santos@email.com', avatar: 'https://i.pravatar.cc/150?u=maria', phone: '+63 917 123 4567', address: '123 Ayala Avenue, Makati City, Metro Manila 1226' },
    staff: { name: 'John Reyes', email: 'john.reyes@blockcart.com', avatar: 'https://i.pravatar.cc/150?u=john', role: 'Order Manager' },
    admin: { name: 'Admin User', email: 'admin@blockcart.com', avatar: 'https://i.pravatar.cc/150?u=admin', role: 'Super Admin' }
  }
};

function formatPrice(amount) {
  return BlockCartData.settings.currency + amount.toLocaleString('en-PH', { minimumFractionDigits: 2 });
}

function getDiscountedPrice(product) {
  if (!product.discount) return product.price;
  return Math.round(product.price * (1 - product.discount / 100));
}

function getStatusBadge(status) {
  const map = {
    pending: 'badge-pending', confirmed: 'badge-confirmed', processing: 'badge-processing',
    packed: 'badge-packed', shipped: 'badge-shipped', 'out-for-delivery': 'badge-out-for-delivery',
    delivered: 'badge-delivered', cancelled: 'badge-cancelled', verified: 'badge-verified'
  };
  const label = status.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
  return `<span class="badge-status ${map[status] || 'badge-pending'}"><i class="fas fa-circle" style="font-size:.5rem"></i> ${label}</span>`;
}

function renderStars(rating) {
  let html = '';
  for (let i = 1; i <= 5; i++) {
    html += `<i class="fas fa-star${i <= Math.floor(rating) ? '' : (i - 0.5 <= rating ? '-half-alt' : '')}"></i>`;
  }
  return html;
}

function renderProductCard(product, showActions = true) {
  const price = getDiscountedPrice(product);
  return `
    <div class="col-sm-6 col-lg-4 col-xl-3 mb-4" data-aos="fade-up">
      <div class="card-custom product-card h-100">
        <div class="product-img-wrap">
          ${product.discount ? `<span class="product-badge">-${product.discount}%</span>` : ''}
          ${showActions ? `<button class="wishlist-btn" onclick="toggleWishlist(${product.id})" title="Add to Wishlist"><i class="far fa-heart"></i></button>` : ''}
          <a href="product.php?id=${product.id}"><img src="${product.image}" alt="${product.name}" loading="lazy"></a>
        </div>
        <div class="product-body">
          <small class="text-muted-custom">${product.category}</small>
          <h6 class="mt-1 mb-2"><a href="product.php?id=${product.id}" class="text-decoration-none">${product.name}</a></h6>
          <div class="rating mb-2">${renderStars(product.rating)} <small class="text-muted-custom">(${product.reviews})</small></div>
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <span class="product-price">${formatPrice(price)}</span>
              ${product.discount ? `<span class="old-price">${formatPrice(product.price)}</span>` : ''}
            </div>
            ${showActions ? `<button class="btn btn-sm btn-primary-custom" onclick="addToCart(${product.id})"><i class="fas fa-cart-plus"></i></button>` : ''}
          </div>
        </div>
      </div>
    </div>`;
}
