<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Toko Sederhana - Demo</title>
    <style>
        :root{
            --bg:#f6f8fb; --card:#fff; --accent:#0b6efd; --muted:#667085;
        }
        *{box-sizing:border-box}
        body{
            margin:0; font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;
            background:linear-gradient(180deg,#f8fbff 0%,var(--bg) 100%);
            color:#0b1220;
        }
        header{
            display:flex; align-items:center; justify-content:space-between;
            gap:1rem; padding:1rem 1.25rem; background:transparent;
        }
        .brand{display:flex;align-items:center;gap:.75rem;font-weight:700}
        .logo{
            width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#6ea8fe);
            display:grid;place-items:center;color:#fff;font-weight:700;
            box-shadow:0 6px 18px rgba(11,110,253,.12);
        }
        .search{flex:1;max-width:640px;display:flex;align-items:center;background:var(--card);padding:.5rem;border-radius:10px;box-shadow:0 2px 6px rgba(15,23,42,.04)}
        .search input{border:0;outline:0;font-size:14px;padding:.5rem;background:transparent;width:100%}
        .actions{display:flex;gap:.5rem;align-items:center}
        button.icon{
            background:var(--card);border:0;padding:.5rem;border-radius:10px;cursor:pointer;box-shadow:0 2px 6px rgba(15,23,42,.04)
        }
        main{padding:1rem 1.25rem 3rem;max-width:1100px;margin:0 auto}
        .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem}
        .card{background:var(--card);padding:1rem;border-radius:12px;box-shadow:0 6px 20px rgba(11,15,30,.04);display:flex;flex-direction:column;gap:.5rem}
        .media{height:140px;border-radius:8px;background:linear-gradient(135deg,#f0f4ff,#fff);display:flex;align-items:center;justify-content:center;font-size:40px;color:var(--muted)}
        .title{font-weight:600;font-size:15px}
        .desc{font-size:13px;color:var(--muted);min-height:36px}
        .price-row{display:flex;align-items:center;justify-content:space-between;margin-top:auto}
        .price{font-weight:700;color:var(--accent)}
        .btn{background:var(--accent);color:#fff;border:0;padding:.5rem .7rem;border-radius:8px;cursor:pointer}
        .chip{font-size:12px;background:#eef2ff;color:var(--accent);padding:.25rem .5rem;border-radius:999px}
        /* cart drawer */
        .drawer{position:fixed;right:20px;bottom:20px;width:380px;max-width:calc(100% - 40px);background:var(--card);border-radius:12px;box-shadow:0 20px 60px rgba(11,15,30,.18);overflow:hidden;transform:translateY(0);z-index:60}
        .drawer.hidden{display:none}
        .drawer header{display:flex;align-items:center;justify-content:space-between;padding:1rem;border-bottom:1px solid #f2f4f7}
        .drawer .items{max-height:360px;overflow:auto;padding:1rem}
        .item{display:flex;gap:.75rem;align-items:center;padding:.5rem 0;border-bottom:1px dashed #f4f6fb}
        .item:last-child{border-bottom:0}
        .qty{display:flex;align-items:center;gap:.25rem}
        .qty button{background:#f1f5f9;border:0;padding:.3rem .5rem;border-radius:6px;cursor:pointer}
        .checkout{display:flex;align-items:center;justify-content:space-between;padding:1rem;border-top:1px solid #f2f4f7}
        .empty{padding:2rem;text-align:center;color:var(--muted)}
        /* responsive */
        @media (max-width:560px){
            .drawer{right:10px;left:10px;width:auto}
            .media{height:120px}
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">
            <div class="logo">TS</div>
            <div>
                <div>Toko Sederhana</div>
                <div style="font-size:12px;color:var(--muted)">Demo toko web - tanpa backend</div>
            </div>
        </div>

        <div class="search" role="search">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" style="margin-left:.4rem"><path d="M21 21l-4.35-4.35" stroke="#9aa4b2" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><circle cx="11" cy="11" r="6" stroke="#9aa4b2" stroke-width="1.6"/></svg>
            <input id="q" placeholder="Cari produk, mis. kaos, sepatu..." />
            <button class="icon" id="clearSearch" title="Clear" style="display:none">✕</button>
        </div>

        <div class="actions">
            <div class="chip" id="countBadge">0 items</div>
            <button class="icon" id="toggleCart" aria-label="Open cart">
                🛒
            </button>
        </div>
    </header>

    <main>
        <section style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem">
            <h2 style="margin:0">Produk Unggulan</h2>
            <div style="font-size:13px;color:var(--muted)">Pilih dan tambahkan ke keranjang</div>
        </section>

        <section>
            <div class="grid" id="catalog"></div>
        </section>
    </main>

    <!-- Cart Drawer -->
    <aside class="drawer hidden" id="cartDrawer" aria-hidden="true">
        <header>
            <div style="font-weight:700">Keranjang</div>
            <div style="font-size:13px;color:var(--muted)" id="summaryCount">0 items</div>
        </header>
        <div class="items" id="cartItems">
            <div class="empty" id="emptyState">Keranjang kosong. Tambahkan produk untuk memulai.</div>
        </div>
        <div class="checkout">
            <div>
                <div style="font-size:13px;color:var(--muted)">Total</div>
                <div style="font-weight:800;font-size:18px" id="totalPrice">Rp0</div>
            </div>
            <div>
                <button class="btn" id="checkoutBtn" disabled>Checkout</button>
            </div>
        </div>
    </aside>

    <script>
        // Demo product data
        const PRODUCTS = [
            { id: 'p1', name: 'Kaos Polos Premium', price: 99000, desc: 'Kaos katun berkualitas, nyaman dipakai sehari-hari.', color:'#ffe8e6', emoji:'👕' },
            { id: 'p2', name: 'Sneakers Sport', price: 349000, desc: 'Ringan dan support untuk aktivitas olahraga.', color:'#e8f3ff', emoji:'👟' },
            { id: 'p3', name: 'Tas Ransel', price: 179000, desc: 'Kapasitas besar dan tahan air.', color:'#fff4e6', emoji:'🎒' },
            { id: 'p4', name: 'Topi Trucker', price: 59000, desc: 'Gaya kasual, cocok untuk hangout.', color:'#e8fff2', emoji:'🧢' },
            { id: 'p5', name: 'Jam Tangan Digital', price: 129000, desc: 'Tampilan modern dengan stopwatch.', color:'#f4ecff', emoji:'⌚' },
            { id: 'p6', name: 'Mug Keramik', price: 45000, desc: 'Mug desain minimalis untuk minuman favorit.', color:'#fff5f0', emoji:'☕' }
        ];

        // Simple cart stored in memory and localStorage
        const CART_KEY = 'toko_demo_cart_v1';
        const cart = JSON.parse(localStorage.getItem(CART_KEY) || '{}'); // { id: qty }

        const qInput = document.getElementById('q');
        const catalogEl = document.getElementById('catalog');
        const countBadge = document.getElementById('countBadge');
        const toggleCart = document.getElementById('toggleCart');
        const cartDrawer = document.getElementById('cartDrawer');
        const cartItemsEl = document.getElementById('cartItems');
        const summaryCount = document.getElementById('summaryCount');
        const totalPriceEl = document.getElementById('totalPrice');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const clearSearch = document.getElementById('clearSearch');
        const emptyState = document.getElementById('emptyState');

        function formatIDR(n){
            return 'Rp' + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function saveCart(){
            localStorage.setItem(CART_KEY, JSON.stringify(cart));
            renderCart();
            renderBadge();
        }

        function addToCart(id, qty = 1){
            cart[id] = (cart[id] || 0) + qty;
            saveCart();
            flashBadge();
        }

        function setQty(id, qty){
            if (qty <= 0) { delete cart[id]; } else { cart[id] = qty; }
            saveCart();
        }

        function removeItem(id){
            delete cart[id];
            saveCart();
        }

        function getCartItems(){
            return Object.keys(cart).map(id => {
                const product = PRODUCTS.find(p => p.id === id);
                return { product, qty: cart[id] };
            });
        }

        function renderProducts(filter = ''){
            catalogEl.innerHTML = '';
            const q = filter.trim().toLowerCase();
            const list = PRODUCTS.filter(p => {
                if (!q) return true;
                return p.name.toLowerCase().includes(q) || p.desc.toLowerCase().includes(q);
            });
            if (!list.length){
                catalogEl.innerHTML = '<div style="grid-column:1/-1;padding:2rem;text-align:center;color:var(--muted)">Tidak ada produk cocok.</div>';
                return;
            }
            for (const p of list){
                const div = document.createElement('div');
                div.className = 'card';
                div.innerHTML = `
                    <div class="media" style="background:${p.color}">${p.emoji}</div>
                    <div class="title">${p.name}</div>
                    <div class="desc">${p.desc}</div>
                    <div class="price-row">
                        <div>
                            <div class="price">${formatIDR(p.price)}</div>
                            <div style="font-size:12px;color:var(--muted)">${Math.round(Math.random()*100)}+ terjual</div>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:.4rem;align-items:flex-end">
                            <button class="btn add" data-id="${p.id}">Tambah</button>
                            <button class="icon" data-id="${p.id}" title="Tambah 1">&plus;</button>
                        </div>
                    </div>
                `;
                catalogEl.appendChild(div);
            }

            // attach handlers
            catalogEl.querySelectorAll('.add').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    addToCart(btn.dataset.id, 1);
                });
            });
            catalogEl.querySelectorAll('.icon[data-id]').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    addToCart(btn.dataset.id, 1);
                });
            });
        }

        function renderBadge(){
            const totalItems = Object.values(cart).reduce((s,n)=>s+n,0);
            countBadge.textContent = `${totalItems} item${totalItems!==1?'s':''}`;
        }

        function renderCart(){
            const items = getCartItems();
            cartItemsEl.innerHTML = '';
            if (!items.length){
                emptyState.style.display = 'block';
                cartItemsEl.appendChild(emptyState);
                summaryCount.textContent = '0 items';
                totalPriceEl.textContent = formatIDR(0);
                checkoutBtn.disabled = true;
                return;
            }
            emptyState.style.display = 'none';
            let total = 0;
            for (const it of items){
                const p = it.product;
                const qty = it.qty;
                total += p.price * qty;
                const el = document.createElement('div');
                el.className = 'item';
                el.innerHTML = `
                    <div style="width:56px;height:56px;border-radius:8px;background:${p.color};display:grid;place-items:center;font-size:22px">${p.emoji}</div>
                    <div style="flex:1">
                        <div style="font-weight:700">${p.name}</div>
                        <div style="font-size:13px;color:var(--muted)">${formatIDR(p.price)}</div>
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.5rem">
                        <div class="qty">
                            <button class="dec" data-id="${p.id}">−</button>
                            <div style="padding:.2rem .4rem;border-radius:6px;background:#f8fafc">${qty}</div>
                            <button class="inc" data-id="${p.id}">+</button>
                        </div>
                        <button class="icon remove" data-id="${p.id}" title="Remove">🗑</button>
                    </div>
                `;
                cartItemsEl.appendChild(el);
            }
            summaryCount.textContent = `${items.reduce((s,i)=>s+i.qty,0)} items`;
            totalPriceEl.textContent = formatIDR(total);
            checkoutBtn.disabled = false;

            cartItemsEl.querySelectorAll('.inc').forEach(b => {
                b.addEventListener('click', () => {
                    addToCart(b.dataset.id, 1);
                });
            });
            cartItemsEl.querySelectorAll('.dec').forEach(b => {
                b.addEventListener('click', () => {
                    const id = b.dataset.id;
                    setQty(id, (cart[id]||1) - 1);
                });
            });
            cartItemsEl.querySelectorAll('.remove').forEach(b => {
                b.addEventListener('click', () => {
                    removeItem(b.dataset.id);
                });
            });
        }

        function flashBadge(){
            countBadge.animate([{transform:'scale(1)'},{transform:'scale(1.08)'},{transform:'scale(1)'}],{duration:220});
        }

        // UI interactions
        toggleCart.addEventListener('click', () => {
            const open = cartDrawer.classList.toggle('hidden');
            cartDrawer.setAttribute('aria-hidden', open ? 'true' : 'false');
            renderCart();
        });

        qInput.addEventListener('input', (e) => {
            const v = qInput.value || '';
            renderProducts(v);
            clearSearch.style.display = v ? 'inline-block' : 'none';
        });
        clearSearch.addEventListener('click', () => {
            qInput.value = '';
            clearSearch.style.display = 'none';
            renderProducts('');
        });

        checkoutBtn.addEventListener('click', () => {
            const items = getCartItems();
            if (!items.length) return;
            // Small checkout flow - prompt for name & address
            const name = prompt('Nama pembeli (untuk demo):', '');
            if (!name) return alert('Checkout dibatalkan.');
            const address = prompt('Alamat pengiriman:', '');
            if (!address) return alert('Checkout dibatalkan.');
            // Simulate order created
            const orderTotal = Object.entries(cart).reduce((s,[id,qty])=>{
                const p = PRODUCTS.find(x=>x.id===id);
                return s + (p.price * qty);
            },0);
            alert(`Terima kasih, ${name}! Pesanan Anda (${Object.values(cart).reduce((a,b)=>a+b,0)} item) berhasil.\nTotal: ${formatIDR(orderTotal)}\nAlamat: ${address}\n\n(Ini hanya demo, tidak ada pembayaran diproses.)`);
            // clear cart
            for (const k of Object.keys(cart)) delete cart[k];
            saveCart();
            cartDrawer.classList.add('hidden');
        });

        // init render
        renderProducts();
        renderCart();
        renderBadge();
    </script>
</body>
</html></div>
