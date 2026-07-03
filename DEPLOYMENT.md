# BlockCart – Deploy Smart Contract to Sepolia (Remix)

Follow this guide to put your BlockCart contract on the **Ethereum Sepolia testnet** so checkout creates **real** on-chain transactions.

---

## What You Need

- [MetaMask](https://metamask.io/) browser extension installed
- A Google/GitHub account (optional, for Remix)
- About **15–20 minutes**

---

## Part 1 — Set Up MetaMask for Sepolia

### Step 1: Install MetaMask
1. Go to https://metamask.io/
2. Install the extension for Chrome/Edge/Firefox
3. Create a new wallet **or** import an existing one
4. **Save your Secret Recovery Phrase** somewhere safe (never share it)

### Step 2: Add Sepolia Testnet
1. Open MetaMask → click the **network dropdown** (top, usually says "Ethereum Mainnet")
2. Click **"Sepolia"** if it appears in the list
3. If not listed: **Add network** → search **Sepolia** → Add

| Setting | Value |
|---------|-------|
| Network Name | Sepolia |
| Chain ID | 11155111 |
| Currency | SepoliaETH |
| RPC URL | https://rpc.sepolia.org |

### Step 3: Get Free Sepolia ETH (for gas fees)
You need test ETH to pay deployment gas (~0.01–0.05 SepoliaETH).

**Option A – Google Cloud Faucet (recommended)**
1. Go to https://cloud.google.com/application/web3/faucet/ethereum/sepolia
2. Sign in with Google
3. Paste your MetaMask wallet address
4. Request Sepolia ETH

**Option B – Alchemy Faucet**
1. Go to https://www.alchemy.com/faucets/ethereum-sepolia
2. Create free account → paste wallet address → claim

**Option C – Sepolia PoW Faucet**
1. Go to https://sepolia-faucet.pk910.de/
2. Mine test ETH with your wallet address

After a few minutes, MetaMask should show SepoliaETH balance on the Sepolia network.

---

## Part 2 — Deploy Contract in Remix

### Step 4: Open Remix
1. Go to **https://remix.ethereum.org/**
2. No login required (you can use it immediately)

### Step 5: Create the contract file
1. In the left panel (**File Explorer**), click the **"+"** icon → **"New File"**
2. Name it: `BlockCartTransaction.sol`
3. Open your local file and copy all contents from:
   ```
   C:\xampp\htdocs\blockcart\contracts\BlockCartTransaction.sol
   ```
4. Paste into Remix and save (Ctrl+S)

### Step 6: Compile the contract
1. Click the **"Solidity Compiler"** icon (left sidebar, 2nd icon)
2. Set **Compiler** to `0.8.20` or `0.8.20+commit...`
3. Click **"Compile BlockCartTransaction.sol"**
4. You should see a **green checkmark** — no errors

### Step 7: Deploy to Sepolia
1. Click the **"Deploy & Run"** icon (left sidebar, 3rd icon)
2. **Environment:** select **"Injected Provider - MetaMask"**
   - MetaMask will pop up → click **Connect** → select your account → **Confirm**
3. **Contract:** select `BlockCartTransaction - contracts/BlockCartTransaction.sol`
4. Click the orange **"Deploy"** button
5. MetaMask opens again → review gas fee → click **Confirm**
6. Wait 15–60 seconds for confirmation

### Step 8: Copy your contract address
1. In Remix, under **"Deployed Contracts"**, expand your contract
2. You'll see the address like: `0xAbC123...`
3. Click the **copy icon** next to the address
4. **Save this address** — you need it for BlockCart

Also verify on Etherscan:
```
https://sepolia.etherscan.io/address/YOUR_CONTRACT_ADDRESS
```

---

## Part 3 — Connect BlockCart to Your Contract

You must update **2 files** with your new contract address.

### Step 9: Update `blockchain.js`
File: `C:\xampp\htdocs\blockcart\assets\js\blockchain.js`

Find line 5 and replace the placeholder:

```javascript
contractAddress: '0xYOUR_DEPLOYED_ADDRESS_HERE',
```

Example:
```javascript
contractAddress: '0x1a2B3c4D5e6F7890abcdef1234567890AbCdEf12',
```

### Step 10: Update `data.js`
File: `C:\xampp\htdocs\blockcart\assets\js\data.js`

Find `settings.contractAddress` and use the **same address**:

```javascript
contractAddress: '0xYOUR_DEPLOYED_ADDRESS_HERE',
```

### Step 11: Refresh the browser
1. Open http://localhost/blockcart/
2. Hard refresh: **Ctrl + Shift + R** (clears cached JS)

---

## Part 4 — Test Real Blockchain Transactions

### Step 12: Test in Remix first (optional but good for demo)
1. In Remix **Deployed Contracts**, expand your contract
2. Find `createTransaction` function
3. Fill in:
   - `_orderId`: `BC-2026-TEST01`
   - `_customerHash`: `0xabc123def456`
   - `_totalAmount`: `6499000000000000000` (amount in wei; for demo you can use any number)
4. Click **"transact"** → confirm in MetaMask
5. Check Sepolia Etherscan for the transaction

### Step 13: Test in BlockCart checkout
1. Make sure MetaMask is on **Sepolia** network
2. Login as customer: http://localhost/blockcart/auth/login.php
   - Email: `maria.santos@email.com` (any password)
3. Add items to cart → go to **Checkout**
4. Click **"Connect MetaMask"** → approve connection
5. Click **"Place Order"**
6. MetaMask will ask to **confirm the transaction** → click Confirm
7. Wait for success toast (not "demo mode")
8. Go to **Blockchain Verification** page → see your real TX hash
9. Click **"View on Etherscan"** → transaction appears on Sepolia

### Step 14: Verify an order
1. Customer portal → **Blockchain Verification**
2. Enter order ID (e.g. `BC-2026-00142` or your new order ID)
3. Click **Verify**
4. Or click **Re-verify on Chain** to call `verifyTransaction()` on the contract

---

## Troubleshooting

| Problem | Solution |
|---------|----------|
| "MetaMask is not installed" | Install extension and refresh page |
| "Blockchain transaction failed" | Check you're on Sepolia, have SepoliaETH, and contract address is correct |
| Still says "demo mode" | MetaMask not connected, wrong network, or wrong contract address |
| "Transaction exists" error | That order ID was already used — place a new order (new ID is auto-generated) |
| Insufficient funds | Get more Sepolia ETH from a faucet |
| Wrong network in MetaMask | Switch to Sepolia before connecting |
| Contract not on Etherscan | Wait 1–2 min after deploy, then refresh Etherscan |
| Changes not showing | Hard refresh browser (Ctrl+Shift+R) |

---

## For Your Capstone Presentation

**Demo script:**
1. Show the Solidity contract in Remix / project folder
2. Show deployed contract on Sepolia Etherscan
3. Place an order in BlockCart with MetaMask connected
4. Show the transaction hash on Etherscan (immutable proof)
5. Use **Verify** page to prove the order exists on-chain
6. Explain: only verification data is on-chain; customer PII stays in MySQL

**Key talking points:**
- Hybrid architecture: MySQL for app data, Ethereum for tamper-proof order records
- Sepolia testnet = no real money, safe for academic demo
- `createTransaction()` stores order ID, hashed customer ID, amount, timestamp
- Anyone can verify an order without trusting the company alone

---

## Contract Functions Reference

| Function | Who can call | Purpose |
|----------|--------------|---------|
| `createTransaction(orderId, customerHash, amount)` | Anyone (public) | Record new order on-chain |
| `verifyTransaction(orderId)` | Anyone (view) | Returns true if order exists |
| `getTransaction(orderId)` | Anyone (view) | Get full transaction struct |
| `updateOrderStatus(orderId, status)` | Contract owner only | Update order status |
| `getBlockNumber()` | Anyone (view) | Current block number |

**Note:** The wallet that deployed the contract is the **owner** and can call `updateOrderStatus`.

---

## Quick Checklist

- [ ] MetaMask installed
- [ ] Sepolia network added
- [ ] Sepolia ETH received from faucet
- [ ] Contract compiled in Remix (0.8.20)
- [ ] Contract deployed via Injected Provider
- [ ] Contract address copied
- [ ] `blockchain.js` updated
- [ ] `data.js` updated
- [ ] Browser hard-refreshed
- [ ] Test order placed with MetaMask
- [ ] Transaction visible on Sepolia Etherscan

---

**Need help?** Share your contract address or error message from MetaMask / browser console (F12 → Console).
