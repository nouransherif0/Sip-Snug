@extends('front.layouts.app')

@section('content')
<style>
    .cart-container {
        padding-top: 50px;
        min-height: 80vh;
        background-color: #f8f9fa;
        color: #333;
        padding-bottom: 50px;
    }
    .cart-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .cart-header h1 {
        font-family: 'Playfair Display', serif;
        color: var(--primary);
        font-size: 2.5rem;
    }
    .cart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
    }
    @media(max-width: 991px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }
    }
    @media(max-width: 576px) {
        .cart-item {
            flex-direction: column;
            text-align: center;
        }
        .cart-item-img {
            margin-right: 0 !important;
            margin-bottom: 15px;
        }
        .cart-item-actions {
            margin-top: 15px;
            justify-content: center;
            width: 100%;
        }
    }
    .cart-items {
        background: #fff;
        border: 1px solid #eee;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border-radius: 15px;
        padding: 20px;
    }
    .cart-item {
        display: flex;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #eee;
    }
    .cart-item:last-child {
        border-bottom: none;
    }
    .cart-item-img {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        object-fit: cover;
        margin-right: 20px;
    }
    .cart-item-details {
        flex: 1;
    }
    .cart-item-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 5px;
        color: #222;
    }
    .cart-item-addons {
        font-size: 0.9rem;
        color: #aaa;
        margin-bottom: 10px;
    }
    .cart-item-price {
        font-size: 1.1rem;
        color: var(--primary);
        font-weight: bold;
    }
    .cart-item-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .qty-btn {
        background: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
        width: 30px;
        height: 30px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .qty-btn:hover {
        background: var(--primary);
        color: #fff;
    }
    .qty-input {
        width: 40px;
        background: transparent;
        border: none;
        color: #333;
        text-align: center;
        font-size: 1rem;
    }
    .remove-btn {
        background: transparent;
        border: none;
        color: #ff4757;
        cursor: pointer;
        font-size: 1.2rem;
        transition: 0.3s;
    }
    .remove-btn:hover {
        color: #ff6b81;
        transform: scale(1.1);
    }
    .cart-summary {
        background: #fff;
        border: 1px solid #eee;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        border-radius: 15px;
        padding: 30px;
        height: fit-content;
    }
    .cart-summary h3 {
        font-family: 'Playfair Display', serif;
        color: var(--primary);
        margin-bottom: 20px;
        font-size: 1.5rem;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #666;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        font-size: 1.2rem;
        font-weight: bold;
        color: #222;
    }
    .checkout-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, var(--primary), var(--green));
        border: none;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        font-size: 1.1rem;
        margin-top: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    .checkout-btn:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
    .empty-cart {
        text-align: center;
        padding: 50px 20px;
    }
    .empty-cart i {
        font-size: 4rem;
        color: #aaa;
        margin-bottom: 20px;
    }
    .empty-cart p {
        font-size: 1.2rem;
        color: #aaa;
        margin-bottom: 30px;
    }
    .empty-cart .btn {
        background: var(--primary);
        color: #fff;
        padding: 10px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
    }
    /* Loading Spinner */
    #cartLoader {
        text-align: center;
        padding: 50px;
    }
    .spinner {
        border: 4px solid #eee;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border-left-color: var(--primary);
        animation: spin 1s linear infinite;
        margin: 0 auto 20px auto;
    }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    /* Custom Modal */
    .custom-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }
    .custom-modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transform: scale(0.9);
        transition: transform 0.2s ease-out;
    }
    .custom-modal.show {
        display: flex;
    }
    .custom-modal.show .custom-modal-content {
        transform: scale(1);
    }
    .custom-modal h3 {
        color: var(--primary);
        margin-bottom: 15px;
        font-weight: 700;
    }
    .custom-modal p {
        color: #555;
        margin-bottom: 25px;
        font-size: 1.1rem;
    }
    .custom-modal-actions {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }
    .custom-modal-actions .btn {
        flex: 1;
        border-radius: 10px;
        padding: 10px;
        font-weight: bold;
    }
    .btn-secondary { background: #eee; color: #333; border: none; }
    .btn-secondary:hover { background: #e0e0e0; }
    .btn-danger { background: #e74c3c; color: white; border: none; }
    .btn-danger:hover { background: #c0392b; }
</style>

<div class="cart-container">
    <div class="container">
        <div class="cart-header">
            <h1>Your Cart</h1>
        </div>

        <!-- Custom Confirm Modal -->
        <div id="confirmModal" class="custom-modal">
            <div class="custom-modal-content">
                <h3>Remove Item</h3>
                <p>Are you sure you want to remove this item?</p>
                <div class="custom-modal-actions">
                    <button class="btn btn-secondary" onclick="closeConfirmModal()">Cancel</button>
                    <button class="btn btn-danger" id="confirmRemoveBtn">Remove</button>
                </div>
            </div>
        </div>

        <div id="cartLoader">
            <div class="spinner"></div>
            <p>Loading your cart...</p>
        </div>

        <div class="cart-grid" id="cartContent" style="display: none;">
            <div class="cart-items" id="cartItemsList">
                <!-- Items will be loaded here dynamically -->
            </div>

            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="summarySubtotal">0.00 EGP</span>
                </div>
                <div class="summary-row">
                    <span>Tax (0%)</span>
                    <span>0.00 EGP</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span id="summaryTotal" style="color: var(--primary);">0.00 EGP</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="checkout-btn text-center d-block text-decoration-none"><i class="fas fa-lock me-2"></i> Secure Checkout</a>
            </div>
        </div>

        <div class="empty-cart" id="emptyCartMessage" style="display: none;">
            <i class="fas fa-shopping-basket"></i>
            <p>Your cart is currently empty.</p>
            <a href="{{ route('home') }}#menu" class="btn">Explore Menu</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
});

function loadCart() {
    fetch('/api/v1/cart', {
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if(response.status === 401) {
            window.location.href = '/login';
            throw new Error('Not authenticated');
        }
        return response.json();
    })
    .then(data => {
        document.getElementById('cartLoader').style.display = 'none';

        if(data.data && data.data.items && data.data.items.length > 0) {
            document.getElementById('cartContent').style.display = 'grid';
            document.getElementById('emptyCartMessage').style.display = 'none';
            renderCartItems(data.data.items);
            updateSummary(data.data.subtotal);
        } else {
            document.getElementById('cartContent').style.display = 'none';
            document.getElementById('emptyCartMessage').style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error loading cart:', error);
    });
}

function renderCartItems(items) {
    const container = document.getElementById('cartItemsList');
    container.innerHTML = '';

    items.forEach(item => {
        // Fallback for image
        let imageUrl = item.product.image ? item.product.image : '/front/photos/coffee/esspresso.jpg';

        let addonsHtml = '';
        if(item.add_ons && item.add_ons.length > 0) {
            // Depending on how API returns add_ons, adapt this.
            // If API just returns array of IDs, we might not have names.
            // Assuming API might just return the IDs for now.
            addonsHtml = `<div class="cart-item-addons">Add-ons: ${item.add_ons.length} selected</div>`;
        }

        const html = `
            <div class="cart-item" data-id="${item.id}">
                <img src="${imageUrl}" class="cart-item-img" alt="${item.product.name}" onerror="this.src='/front/photos/coffee/esspresso.jpg'">
                <div class="cart-item-details">
                    <div class="cart-item-title">${item.product.name}</div>
                    ${addonsHtml}
                    <div class="cart-item-price">${item.item_price_with_addons} EGP</div>
                </div>
                <div class="cart-item-actions">
                    <button class="qty-btn" onclick="updateItem(${item.id}, ${item.quantity - 1})"><i class="fas fa-minus"></i></button>
                    <input type="text" class="qty-input" value="${item.quantity}" readonly>
                    <button class="qty-btn" onclick="updateItem(${item.id}, ${item.quantity + 1})"><i class="fas fa-plus"></i></button>
                    <button class="remove-btn" onclick="removeItem(${item.id})"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });
}

function updateSummary(subtotal) {
    document.getElementById('summarySubtotal').textContent = subtotal + ' EGP';
    document.getElementById('summaryTotal').textContent = subtotal + ' EGP';
}

function updateItem(itemId, newQty) {
    if(newQty < 1) {
        removeItem(itemId);
        return;
    }

    // Optimistic UI update
    const itemEl = document.querySelector(`.cart-item[data-id="${itemId}"]`);
    if(itemEl) itemEl.querySelector('.qty-input').value = newQty;

    fetch('/api/v1/cart/items/' + itemId, {
        method: 'PUT',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(response => response.json())
    .then(data => {
        loadCart(); // Reload to get fresh subtotal
        updateGlobalCartCount();
    })
    .catch(error => {
        console.error('Error updating cart:', error);
        loadCart(); // Revert on error
    });
}

let itemToRemove = null;

function showConfirmModal(itemId) {
    itemToRemove = itemId;
    const modal = document.getElementById('confirmModal');
    modal.classList.add('show');
}

function closeConfirmModal() {
    itemToRemove = null;
    const modal = document.getElementById('confirmModal');
    modal.classList.remove('show');
}

document.getElementById('confirmRemoveBtn').addEventListener('click', function() {
    if(itemToRemove) {
        processRemoveItem(itemToRemove);
        closeConfirmModal();
    }
});

function removeItem(itemId) {
    showConfirmModal(itemId);
}

function processRemoveItem(itemId) {
    const itemEl = document.querySelector(`.cart-item[data-id="${itemId}"]`);
    if(itemEl) itemEl.style.opacity = '0.5';

    fetch('/api/v1/cart/items/' + itemId, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        loadCart();
        updateGlobalCartCount();
    })
    .catch(error => {
        console.error('Error removing item:', error);
        loadCart(); // Revert
    });
    
}
</script>
@endsection
