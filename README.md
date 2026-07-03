# BlockCart – Blockchain-Based E-Commerce Web Application

A complete, production-quality UI/UX prototype for a hybrid blockchain e-commerce platform. Customers shop online while order verification records are stored on the Ethereum Sepolia testnet.

## Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3, JavaScript, Bootstrap 5 |
| Backend (ready) | PHP, MySQL (XAMPP) |
| Blockchain | Solidity, MetaMask, Web3.js, Sepolia Testnet |
| Charts | Chart.js |
| Animations | AOS |

## Quick Start (XAMPP)

1. **Copy project to XAMPP htdocs**
   ```
   Copy the `blockcart` folder to: C:\xampp\htdocs\blockcart
   ```

2. **Start XAMPP** – Apache + MySQL

3. **Import database** (optional for prototype; UI works with sample JS data)
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Import `database/schema.sql`

4. **Open in browser**
   ```
   http://localhost/blockcart/
   ```

## Demo Login Portals

Use any password on the login forms. Click the role tab, then sign in:

| Role | Email | Dashboard |
|------|-------|-----------|
| Customer | maria.santos@email.com | `/customer/dashboard.php` |
| Staff | john.reyes@blockcart.com | `/staff/dashboard.php` |
| Admin | admin@blockcart.com | `/admin/dashboard.php` |

## Project Structure

```
blockcart/
├── index.php              # Homepage
├── shop.php               # Product listing
├── product.php            # Product details
├── about.php, contact.php, faq.php, privacy.php, terms.php
├── auth/                  # Login, register, password reset
├── customer/              # Customer portal (12 pages)
├── staff/                 # Staff portal (9 pages)
├── admin/                 # Admin portal (14 pages)
├── assets/
│   ├── css/main.css       # Design system
│   └── js/                # data.js, main.js, blockchain.js, charts.js
├── includes/              # PHP layout components
├── contracts/             # BlockCartTransaction.sol
├── database/              # schema.sql
└── api/                   # PHP backend stubs
```

## Pages Overview

### Public (10 pages)
Home, Shop, Product Details, About, Contact, FAQ, Privacy, Terms, Login, Register

### Customer Portal (12 pages)
Dashboard, Profile, Orders, Order Details, Track Order, Wishlist, Cart, Checkout, Invoice, Blockchain Verification, Notifications, Settings

### Staff Portal (9 pages)
Dashboard, Orders, Inventory, Invoices, Blockchain, Reports, Notifications, Profile, Settings

### Admin Portal (14 pages)
Dashboard, Products, Categories, Brands, Inventory, Orders, Reviews, Users, Staff, Reports, Blockchain, Settings, Audit Logs, Activity Logs

## Blockchain Workflow

1. Customer completes checkout (Cash on Delivery)
2. Order saved to MySQL (production) / localStorage (prototype)
3. MetaMask connects to Sepolia Testnet
4. Smart contract `createTransaction()` called
5. Transaction hash + block number stored
6. Customer can verify anytime via Blockchain Verification page

### Smart Contract Functions
- `createTransaction()` – Record order on-chain
- `verifyTransaction()` – Check if order exists
- `getTransaction()` – Retrieve transaction data
- `updateOrderStatus()` – Update status (admin)

Deploy `contracts/BlockCartTransaction.sol` via Remix or Hardhat to Sepolia testnet.

## Design System

- **Primary:** #2563EB (Blue)
- **Accent:** #10B981 (Emerald Green)
- **Background:** #F8FAFC
- **Font:** Poppins
- **Features:** Dark mode, glassmorphism, responsive, AOS animations

## Prototype vs Production

This prototype uses **JavaScript sample data** (`assets/js/data.js`) and **localStorage** for cart, wishlist, and blockchain records. For production:

1. Wire PHP pages to MySQL via `api/db.example.php`
2. Implement session-based auth with password hashing
3. Deploy smart contract and update `contractAddress` in `blockchain.js`
4. Add CSRF tokens, input validation, and file upload security

## License

Capstone project prototype – BlockCart © 2026
