@extends('front.layouts.app')

@section('content')
<style>
    .checkout-container {
        padding-top: 35px;
        min-height: 80vh;
        background-color: #fcf7f1;
        color: #333;
        padding-bottom: 50px;
    }
    .checkout-header {
        text-align: center;
        margin-bottom: 30px;
    }
    .checkout-header h1 {
        font-family: 'Playfair Display', serif;
        color: var(--primary);
        font-size: 2.2rem;
        font-weight: 700;
    }
    .checkout-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }
    .checkout-section {
        background: #fff;
        border: 1px solid #efe2d3;
        box-shadow: 0 4px 18px rgba(0,0,0,0.04);
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 25px;
    }
    .checkout-section h3 {
        font-family: 'Playfair Display', serif;
        color: var(--primary);
        margin-bottom: 20px;
        font-size: 1.4rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    .address-card {
        border: 2px solid #eee;
        border-radius: 12px;
        padding: 15px 90px 15px 15px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: 0.3s;
        position: relative;
    }
    .address-card:hover {
        border-color: #ddd;
    }
    .address-card.selected {
        border-color: var(--primary);
        background-color: rgba(122, 75, 46, 0.04);
    }
    .address-card input[type="radio"] {
        position: absolute;
        top: 20px;
        right: 20px;
        transform: scale(1.2);
        accent-color: var(--primary);
    }
    .address-label {
        font-weight: 700;
        font-size: 1.05rem;
        color: #222;
        margin-bottom: 4px;
        word-break: break-word;
    }
    .address-details {
        font-size: 0.9rem;
        color: #666;
        line-height: 1.5;
    }
    .payment-option {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 14px 16px;
        border: 2px solid #eee;
        border-radius: 12px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: 0.3s;
    }
    .payment-option:hover {
        border-color: #ddd;
    }
    .payment-option.selected {
        border-color: var(--primary);
        background-color: rgba(122, 75, 46, 0.04);
    }
    .payment-option input[type="radio"] {
        accent-color: var(--primary);
        transform: scale(1.2);
    }
    .payment-icon {
        font-size: 1.4rem;
        color: var(--primary);
    }
    
    .cart-summary {
        background: #fff;
        border: 1px solid #efe2d3;
        box-shadow: 0 4px 18px rgba(0,0,0,0.04);
        border-radius: 16px;
        padding: 25px;
        height: fit-content;
        position: sticky;
        top: 100px;
    }
    .cart-summary h3 {
        font-family: 'Playfair Display', serif;
        color: var(--primary);
        margin-bottom: 20px;
        font-size: 1.4rem;
    }
    .summary-items {
        margin-bottom: 15px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.92rem;
        gap: 10px;
    }
    .summary-item-name {
        color: #333;
        font-weight: 500;
        word-break: break-word;
    }
    .summary-item-price {
        color: #555;
        white-space: nowrap;
        font-weight: 600;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        color: #666;
        font-size: 0.92rem;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 2px dashed #eee;
        font-size: 1.15rem;
        font-weight: bold;
        color: #222;
    }
    .place-order-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--primary), #5a3821);
        border: none;
        border-radius: 10px;
        color: #fff;
        font-weight: bold;
        font-size: 1.05rem;
        margin-top: 18px;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 4px 14px rgba(122, 75, 46, 0.25);
    }
    .place-order-btn:hover {
        opacity: 0.93;
        transform: translateY(-1px);
    }
    .place-order-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    /* Mobile Responsiveness Override */
    @media (max-width: 991px) {
        .checkout-container {
            padding-top: 20px;
            padding-bottom: 30px;
        }
        .checkout-header {
            margin-bottom: 20px;
        }
        .checkout-header h1 {
            font-size: 1.6rem;
        }
        .checkout-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        .checkout-section, .cart-summary {
            padding: 18px 15px !important;
            border-radius: 14px !important;
            margin-bottom: 16px !important;
            position: relative !important;
            top: 0 !important;
        }
        .checkout-section h3, .cart-summary h3 {
            font-size: 1.2rem !important;
            margin-bottom: 14px !important;
        }
        .address-card {
            padding: 12px 85px 12px 12px !important;
            margin-bottom: 10px !important;
            border-radius: 10px !important;
        }
        .address-label {
            font-size: 0.92rem !important;
        }
        .address-details {
            font-size: 0.82rem !important;
        }
        .payment-option {
            padding: 12px !important;
            gap: 10px !important;
            margin-bottom: 10px !important;
            border-radius: 10px !important;
        }
        .payment-icon {
            font-size: 1.2rem !important;
        }
        .place-order-btn {
            padding: 13px !important;
            font-size: 1rem !important;
            border-radius: 10px !important;
        }
    }
    
    /* Loading Spinner */
    .loader-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255,255,255,0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 15px;
    }
    .spinner {
        border: 4px solid #eee;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border-left-color: var(--primary);
        animation: spin 1s linear infinite;
    }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(122, 75, 46, 0.2);
    }
</style>

<div class="checkout-container">
    <div class="container">
        <div class="checkout-header">
            <h1>Secure Checkout</h1>
        </div>

        <div class="checkout-grid">
            <div class="checkout-main">
                <!-- Delivery Address Section -->
                <div class="checkout-section" style="position: relative;">
                    <div id="addressesLoader" class="loader-overlay" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                    
                    <h3>
                        Delivery Address
                        <button class="btn btn-sm btn-outline-dark" onclick="openAddAddress()">
                            <i class="fas fa-plus"></i> New Address
                        </button>
                    </h3>
                    
                    <div class="text-center py-4 text-muted" id="noAddressesMsg" style="display: none;">
                        You don't have any saved addresses. Please add a new one.
                    </div>
                    <div id="addressesList">
                        <!-- Addresses will be loaded here -->
                    </div>
                </div>

                <!-- Payment Method Section -->
                <div class="checkout-section">
                    <h3>Payment Method</h3>
                    
                    <label class="payment-option selected" id="optCash">
                        <div class="payment-icon"><i class="fas fa-money-bill-wave"></i></div>
                        <div style="flex:1;">
                            <strong>Cash on Delivery</strong>
                            <div class="text-muted small">Pay when you receive your order</div>
                        </div>
                        <input type="radio" name="payment_method" value="cash" checked>
                    </label>

                    <label class="payment-option" id="optCard">
                        <div class="payment-icon"><i class="fas fa-credit-card"></i></div>
                        <div style="flex:1;">
                            <strong>Credit/Debit Card</strong>
                            <div class="text-muted small">Pay securely online</div>
                        </div>
                        <input type="radio" name="payment_method" value="card">
                    </label>

                    <div id="savedCardsContainer" style="display: none; padding: 15px; border: 1px solid #eee; border-radius: 10px; margin-bottom: 15px; margin-top: -10px; border-top: none; border-top-left-radius: 0; border-top-right-radius: 0;">
                        <div id="savedCardsLoader" class="text-center py-2" style="display: none;">
                            <div class="spinner-border spinner-border-sm text-primary" role="status"></div> Loading cards...
                        </div>
                        <div id="savedCardsList">
                            <!-- Saved cards will be injected here -->
                        </div>
                        <button class="btn btn-sm btn-outline-dark mt-2" onclick="openAddCardModal()">
                            <i class="fas fa-plus"></i> Add New Card
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Summary Section -->
            <div>
                <div class="cart-summary" style="position: relative;">
                    <div id="summaryLoader" class="loader-overlay" style="display: none;">
                        <div class="spinner"></div>
                    </div>
                    
                    <h3>Order Summary</h3>
                    
                    <div class="summary-items" id="summaryItemsList">
                        <!-- Cart items will be loaded here -->
                    </div>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="summarySubtotal">0.00 EGP</span>
                    </div>
                    <div class="summary-row" id="deliveryFeeRow" style="display: none;">
                        <span>Delivery Fee</span>
                        <span id="summaryDeliveryFee">0.00 EGP</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (0%)</span>
                        <span>0.00 EGP</span>
                    </div>
                    
                    <div class="summary-total">
                        <span>Total</span>
                        <span id="summaryTotal" style="color: var(--primary);">0.00 EGP</span>
                    </div>
                    
                    <div id="orderError" class="alert alert-danger mt-3" style="display: none;"></div>
                    
                    <button class="place-order-btn" id="placeOrderBtn">
                        Place Order <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add New Address Modal -->
<div class="modal fade" id="newAddressModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="addressModalTitle" style="color: var(--primary); font-family: 'Playfair Display', serif; font-size: 1.5rem;">Add New Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="newAddressForm" novalidate>
                    <input type="hidden" id="editAddressId" value="">
                    <div id="addressFormError" class="alert alert-danger" style="display: none;"></div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Delivery Zone *</label>
                        <select class="form-select" id="zoneId" required>
                            <option value="">Select a zone...</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Street Name / Area *</label>
                        <input type="text" class="form-control" id="street" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">Building No. *</label>
                            <input type="text" class="form-control" id="buildingNo" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">Phone Number *</label>
                            <input type="text" class="form-control" id="phone" required placeholder="01...">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">Floor</label>
                            <input type="text" class="form-control" id="floor">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">Apartment</label>
                            <input type="text" class="form-control" id="apartment">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Address Label (Optional)</label>
                        <input type="text" class="form-control" id="label" placeholder="e.g. Home, Work">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-dark w-100 mt-2" id="saveAddressBtn" style="background-color: var(--primary); border: none;">
                        Save Address
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add New Card Modal -->
<div class="modal fade" id="newCardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" style="color: var(--primary); font-family: 'Playfair Display', serif; font-size: 1.5rem;">Add New Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="newCardForm" novalidate>
                    <div id="cardFormError" class="alert alert-danger" style="display: none;"></div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Card Type *</label>
                        <select class="form-select" id="cardType" required>
                            <option value="">Select card type...</option>
                            <option value="Visa">Visa</option>
                            <option value="MasterCard">MasterCard</option>
                            <option value="Amex">American Express</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Name on Card *</label>
                        <input type="text" class="form-control" id="cardName" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">Card Number *</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="0000 0000 0000 0000" maxlength="19" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">Expiry Date *</label>
                            <input type="text" class="form-control" id="cardExpiry" placeholder="MM/YY" maxlength="5" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small fw-bold">CVV *</label>
                            <input type="password" class="form-control" id="cardCvv" placeholder="***" maxlength="4" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-dark w-100 mt-2" id="saveCardBtn" style="background-color: var(--primary); border: none;">
                        Save Card
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Order Success Modal -->
<div class="modal fade" id="orderSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center" style="padding: 40px 20px;">
            <div style="font-size: 4rem; color: var(--green); margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 style="font-family: 'Playfair Display', serif; color: var(--primary);">Order Placed Successfully!</h2>
            <p class="text-muted mt-3 mb-4">Your order has been received and is being prepared. Thank you for choosing Sip & Snug.</p>
            <div class="d-flex flex-column gap-2" style="max-width: 280px; margin: 0 auto;">
                <button type="button" id="downloadInvoiceBtn" onclick="triggerInPageInvoiceDownload()" class="btn btn-outline-dark" style="border-color: var(--primary); color: var(--primary); font-weight: 600; padding: 10px 25px; border-radius: 25px; display: none;">
                    <i class="fas fa-file-invoice me-2"></i>Download Invoice
                </button>
                <a href="{{ route('home') }}" class="btn btn-dark" style="background-color: var(--primary); border: none; padding: 10px 25px; border-radius: 25px;">Back to Home</a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            <div class="modal-body text-center p-4">
                <div class="text-danger mb-3" style="font-size: 3rem;">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h5 class="mb-3" style="font-family: 'Playfair Display', serif; color: var(--primary);">Delete Address?</h5>
                <p class="text-muted mb-4 small">Are you sure you want to delete this address? This action cannot be undone.</p>
                
                <input type="hidden" id="deleteAddressId" value="">
                
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger px-4" onclick="confirmDeleteAddress()" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let addresses = [];
let savedCards = [];
let cartData = null;
let selectedAddressId = null;
let selectedCardId = null;
let currentSubtotal = 0;

document.addEventListener('DOMContentLoaded', function() {
    loadAddresses();
    loadCartSummary();
    loadDeliveryZones();
    
    // Payment method selection
    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
            this.closest('.payment-option').classList.add('selected');
            
            if(this.value === 'card') {
                document.getElementById('savedCardsContainer').style.display = 'block';
                loadSavedCards();
            } else {
                document.getElementById('savedCardsContainer').style.display = 'none';
            }
        });
    });
});

function getHeaders() {
    return {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
}

function loadAddresses() {
    document.getElementById('addressesLoader').style.display = 'flex';
    fetch('/api/v1/addresses', { headers: getHeaders() })
    .then(res => {
        if(res.status === 401) { window.location.href = '/login'; throw new Error('Unauth'); }
        return res.json();
    })
    .then(data => {
        document.getElementById('addressesLoader').style.display = 'none';
        addresses = data.data || [];
        renderAddresses();
    })
    .catch(err => {
        document.getElementById('addressesLoader').style.display = 'none';
        console.error(err);
    });
}

function renderAddresses() {
    const list = document.getElementById('addressesList');
    list.innerHTML = '';
    
    if (addresses.length === 0) {
        document.getElementById('noAddressesMsg').style.display = 'block';
        return;
    }
    
    document.getElementById('noAddressesMsg').style.display = 'none';
    
    addresses.forEach((addr, index) => {
        // Auto-select first address or default address
        if (selectedAddressId === null && (index === 0 || addr.is_default)) {
            selectedAddressId = addr.id;
        }
        
        const isSelected = selectedAddressId === addr.id;
        
        let labelHtml = addr.label ? `<span class="badge bg-secondary ms-2">${addr.label}</span>` : '';
        let zoneHtml = addr.delivery_zone ? addr.delivery_zone.name : '';
        
        const html = `
            <div class="address-card ${isSelected ? 'selected' : ''}" onclick="selectAddress('${addr.id}', event)" style="position: relative; cursor: pointer;">
                <div class="address-label">${addr.street}, Bldg ${addr.building_number} ${labelHtml}</div>
                <div class="address-details">
                    Zone: ${zoneHtml} <br>
                    Phone: ${addr.phone_number} <br>
                    ${addr.floor ? 'Floor: ' + addr.floor : ''} ${addr.apartment ? '| Apt: ' + addr.apartment : ''}
                </div>
                <input type="radio" name="address_id" value="${addr.id}" ${isSelected ? 'checked' : ''} style="display:none;">
                <div class="address-actions" style="position: absolute; right: 15px; top: 15px;">
                    <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="openEditAddress('${addr.id}', event)"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteAddress('${addr.id}', event)"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
        list.insertAdjacentHTML('beforeend', html);
    });
    
    updateTotalWithDeliveryFee();
}

function selectAddress(id, event) {
    if (event && event.target.closest('button')) {
        return; // Ignore if clicking a button
    }
    selectedAddressId = id;
    renderAddresses();
}

function loadCartSummary() {
    document.getElementById('summaryLoader').style.display = 'flex';
    fetch('/api/v1/cart', { headers: getHeaders() })
    .then(res => res.json())
    .then(data => {
        document.getElementById('summaryLoader').style.display = 'none';
        
        if(!data.data || !data.data.items || data.data.items.length === 0) {
            window.location.href = '/cart'; // Redirect back if empty
            return;
        }
        
        cartData = data.data;
        const list = document.getElementById('summaryItemsList');
        list.innerHTML = '';
        
        cartData.items.forEach(item => {
            list.insertAdjacentHTML('beforeend', `
                <div class="summary-item">
                    <span class="summary-item-name">${item.quantity}x ${item.product.name}</span>
                    <span class="summary-item-price">${item.total_price} EGP</span>
                </div>
            `);
        });
        
        document.getElementById('summarySubtotal').textContent = cartData.subtotal + ' EGP';
        
        // Parse numerical subtotal for calculations
        currentSubtotal = parseFloat(cartData.subtotal.replace(/[^0-9.]/g, ''));
        document.getElementById('summaryTotal').textContent = currentSubtotal.toFixed(2) + ' EGP';
        updateTotalWithDeliveryFee();
    })
    .catch(err => {
        console.error(err);
        document.getElementById('summaryLoader').style.display = 'none';
    });
}

function updateTotalWithDeliveryFee() {
    if(!cartData || addresses.length === 0 || !selectedAddressId) return;
    
    const selectedAddr = addresses.find(a => a.id === selectedAddressId);
    if(selectedAddr && selectedAddr.delivery_zone) {
        const feeStr = selectedAddr.delivery_zone.delivery_fee;
        const feeVal = parseFloat(feeStr.replace(/[^0-9.]/g, '')) || 0;
        
        document.getElementById('deliveryFeeRow').style.display = 'flex';
        document.getElementById('summaryDeliveryFee').textContent = feeStr;
        
        const total = currentSubtotal + feeVal;
        document.getElementById('summaryTotal').textContent = total.toFixed(2) + ' EGP';
    } else {
        document.getElementById('deliveryFeeRow').style.display = 'none';
        document.getElementById('summaryTotal').textContent = currentSubtotal.toFixed(2) + ' EGP';
    }
}

function loadDeliveryZones() {
    fetch('/api/v1/delivery-zones', { headers: getHeaders() })
    .then(res => res.json())
    .then(data => {
        const select = document.getElementById('zoneId');
        if(data.data) {
            data.data.forEach(zone => {
                select.insertAdjacentHTML('beforeend', `<option value="${zone.id}">${zone.name} (${zone.delivery_fee})</option>`);
            });
        }
    });
}

document.getElementById('newAddressForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('saveAddressBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    const payload = {
        delivery_zone_id: parseInt(document.getElementById('zoneId').value),
        street: document.getElementById('street').value,
        building_number: document.getElementById('buildingNo').value,
        phone_number: document.getElementById('phone').value,
        floor: document.getElementById('floor').value,
        apartment: document.getElementById('apartment').value,
        label: document.getElementById('label').value
    };
    
    // Clear previous errors
    document.querySelectorAll('#newAddressForm .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.getElementById('addressFormError').style.display = 'none';
    
    const editId = document.getElementById('editAddressId').value;
    const url = editId ? `/api/v1/addresses/${editId}` : '/api/v1/addresses';
    const method = editId ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: getHeaders(),
        body: JSON.stringify(payload)
    })
    .then(res => res.json().then(data => ({status: res.status, body: data})))
    .then(res => {
        btn.disabled = false;
        btn.innerHTML = 'Save Address';
        
        if (res.status === 200 || res.status === 201) {
            // Close modal
            var modalEl = document.getElementById('newAddressModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            
            // Reset form and clear validation
            document.getElementById('newAddressForm').reset();
            document.querySelectorAll('#newAddressForm .is-invalid').forEach(el => el.classList.remove('is-invalid'));
            
            // Auto select new address
            selectedAddressId = res.body.data.id;
            loadAddresses(); // Reload addresses
        } else {
            if (res.body.errors) {
                const fieldMap = {
                    'delivery_zone_id': 'zoneId',
                    'street': 'street',
                    'building_number': 'buildingNo',
                    'phone_number': 'phone',
                    'floor': 'floor',
                    'apartment': 'apartment',
                    'label': 'label'
                };
                
                let unmappedErrors = [];
                for (const [field, messages] of Object.entries(res.body.errors)) {
                    const inputId = fieldMap[field];
                    const inputEl = document.getElementById(inputId);
                    if (inputEl) {
                        inputEl.classList.add('is-invalid');
                        inputEl.nextElementSibling.textContent = messages[0];
                    } else {
                        unmappedErrors.push(messages[0]);
                    }
                }
                
                if (unmappedErrors.length > 0) {
                    document.getElementById('addressFormError').style.display = 'block';
                    document.getElementById('addressFormError').innerHTML = unmappedErrors.join('<br>');
                }
            } else {
                document.getElementById('addressFormError').style.display = 'block';
                document.getElementById('addressFormError').textContent = res.body.message || 'Validation error occurred.';
            }
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = 'Save Address';
        console.error(err);
    });
});

function openAddAddress() {
    document.getElementById('addressModalTitle').innerText = 'Add New Address';
    document.getElementById('editAddressId').value = '';
    document.getElementById('newAddressForm').reset();
    document.querySelectorAll('#newAddressForm .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.getElementById('addressFormError').style.display = 'none';
    
    var modal = new bootstrap.Modal(document.getElementById('newAddressModal'));
    modal.show();
}

function openEditAddress(id, event) {
    event.stopPropagation();
    
    const addr = addresses.find(a => a.id === id);
    if (!addr) return;
    
    document.getElementById('addressModalTitle').innerText = 'Edit Address';
    document.getElementById('editAddressId').value = addr.id;
    document.getElementById('newAddressForm').reset();
    document.querySelectorAll('#newAddressForm .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.getElementById('addressFormError').style.display = 'none';
    
    // Populate form
    document.getElementById('zoneId').value = addr.delivery_zone ? addr.delivery_zone.id : '';
    document.getElementById('street').value = addr.street;
    document.getElementById('buildingNo').value = addr.building_number;
    document.getElementById('phone').value = addr.phone_number;
    document.getElementById('floor').value = addr.floor || '';
    document.getElementById('apartment').value = addr.apartment || '';
    document.getElementById('label').value = addr.label || '';
    
    var modal = new bootstrap.Modal(document.getElementById('newAddressModal'));
    modal.show();
}

function deleteAddress(id, event) {
    event.stopPropagation();
    
    // Set the ID in the modal and show it
    document.getElementById('deleteAddressId').value = id;
    var modal = new bootstrap.Modal(document.getElementById('deleteAddressModal'));
    modal.show();
}

function confirmDeleteAddress() {
    const id = document.getElementById('deleteAddressId').value;
    if (!id) return;
    
    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Deleting...';
    
    fetch(`/api/v1/addresses/${id}`, {
        method: 'DELETE',
        headers: getHeaders()
    })
    .then(res => {
        btn.disabled = false;
        btn.innerHTML = 'Delete';
        
        if (res.status === 200 || res.status === 204) {
            // Close modal
            var modalEl = document.getElementById('deleteAddressModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            
            if (selectedAddressId === id) {
                selectedAddressId = null; // reset if deleted
            }
            loadAddresses();
        } else {
            alert('Failed to delete address.');
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = 'Delete';
        console.error(err);
        alert('An error occurred.');
    });
}

let currentPlacedOrderId = null;

function triggerInPageInvoiceDownload() {
    if (!currentPlacedOrderId) return;
    
    const btn = document.getElementById('downloadInvoiceBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Downloading PDF...';

    let iframe = document.getElementById('pdfDownloadIframe');
    if (!iframe) {
        iframe = document.createElement('iframe');
        iframe.id = 'pdfDownloadIframe';
        iframe.style.position = 'fixed';
        iframe.style.right = '0';
        iframe.style.bottom = '0';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = '0';
        document.body.appendChild(iframe);
    }

    iframe.src = '/orders/' + currentPlacedOrderId + '/invoice?download=pdf';

    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-file-invoice me-2"></i>Download Invoice';
    }, 4500);
}

document.getElementById('placeOrderBtn').addEventListener('click', function() {
    if(!selectedAddressId) {
        const err = document.getElementById('orderError');
        err.style.display = 'block';
        err.textContent = 'Please select a delivery address.';
        return;
    }
    
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    if(paymentMethod === 'card' && !selectedCardId) {
        const err = document.getElementById('orderError');
        err.style.display = 'block';
        err.textContent = 'Please select a saved card to proceed with card payment.';
        return;
    }
    
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    document.getElementById('orderError').style.display = 'none';
    
    let payload = {
        address_id: selectedAddressId.toString(),
        payment_method: paymentMethod
    };
    
    if(paymentMethod === 'card') {
        payload.saved_card_id = selectedCardId;
    }
    
    fetch('/api/v1/orders', {
        method: 'POST',
        headers: getHeaders(),
        body: JSON.stringify(payload)
    })
    .then(res => res.json().then(data => ({status: res.status, body: data})))
    .then(res => {
        if(res.status === 200 || res.status === 201) {
            // Success
            if(typeof updateGlobalCartCount === 'function') {
                document.getElementById('cartCount').textContent = '0'; // Optimistic reset
            }
            currentPlacedOrderId = (res.body && res.body.data) ? res.body.data.id : null;
            const invoiceBtn = document.getElementById('downloadInvoiceBtn');
            if (currentPlacedOrderId && invoiceBtn) {
                invoiceBtn.style.display = 'inline-block';
            }
            var modal = new bootstrap.Modal(document.getElementById('orderSuccessModal'));
            modal.show();
        } else {
            btn.disabled = false;
            btn.innerHTML = 'Place Order <i class="fas fa-arrow-right ms-2"></i>';
            const err = document.getElementById('orderError');
            err.style.display = 'block';
            err.textContent = res.body.message || 'Failed to place order. Please try again.';
        }
    })
    .catch(err => {
        console.error(err);
        btn.disabled = false;
        btn.innerHTML = 'Place Order <i class="fas fa-arrow-right ms-2"></i>';
    });
});

// Saved Cards logic
function loadSavedCards() {
    document.getElementById('savedCardsLoader').style.display = 'block';
    fetch('/api/v1/saved-cards', { headers: getHeaders() })
    .then(res => res.json())
    .then(data => {
        document.getElementById('savedCardsLoader').style.display = 'none';
        savedCards = data.data || [];
        renderSavedCards();
    })
    .catch(err => {
        document.getElementById('savedCardsLoader').style.display = 'none';
        console.error(err);
    });
}

function renderSavedCards() {
    const list = document.getElementById('savedCardsList');
    list.innerHTML = '';
    
    if (savedCards.length === 0) {
        list.innerHTML = '<div class="text-muted small mb-2">No saved cards found. Please add a new card.</div>';
        return;
    }
    
    savedCards.forEach((card, index) => {
        if (selectedCardId === null && index === 0) {
            selectedCardId = card.id;
        }
        
        const isSelected = selectedCardId === card.id;
        
        // Mask card number
        const masked = card.card_number.replace(/\d(?=\d{4})/g, "*");
        
        let iconClass = 'fa-credit-card';
        if(card.card_type.toLowerCase() === 'visa') iconClass = 'fa-cc-visa';
        if(card.card_type.toLowerCase() === 'mastercard') iconClass = 'fa-cc-mastercard';
        if(card.card_type.toLowerCase() === 'amex') iconClass = 'fa-cc-amex';
        
        const html = `
            <div class="address-card ${isSelected ? 'selected' : ''}" onclick="selectCard(${card.id})" style="padding: 10px 15px; margin-bottom: 10px;">
                <div class="d-flex align-items-center">
                    <i class="fab ${iconClass} fs-3 me-3" style="color: var(--primary);"></i>
                    <div>
                        <div class="fw-bold">${card.card_type} ending in ${card.card_number.slice(-4)}</div>
                        <div class="small text-muted">Expires ${card.expiry_date}</div>
                    </div>
                </div>
                <input type="radio" name="saved_card_id" value="${card.id}" ${isSelected ? 'checked' : ''} style="display:none;">
            </div>
        `;
        list.insertAdjacentHTML('beforeend', html);
    });
}

function selectCard(id) {
    selectedCardId = id;
    renderSavedCards();
}

function openAddCardModal() {
    document.getElementById('newCardForm').reset();
    document.querySelectorAll('#newCardForm .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.getElementById('cardFormError').style.display = 'none';
    
    var modal = new bootstrap.Modal(document.getElementById('newCardModal'));
    modal.show();
}

document.getElementById('newCardForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('saveCardBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    
    const payload = {
        card_type: document.getElementById('cardType').value,
        card_name: document.getElementById('cardName').value,
        card_number: document.getElementById('cardNumber').value,
        expiry_date: document.getElementById('cardExpiry').value,
        cvv: document.getElementById('cardCvv').value
    };
    
    document.querySelectorAll('#newCardForm .is-invalid').forEach(el => el.classList.remove('is-invalid'));
    document.getElementById('cardFormError').style.display = 'none';
    
    fetch('/api/v1/saved-cards', {
        method: 'POST',
        headers: getHeaders(),
        body: JSON.stringify(payload)
    })
    .then(res => res.json().then(data => ({status: res.status, body: data})))
    .then(res => {
        btn.disabled = false;
        btn.innerHTML = 'Save Card';
        
        if (res.status === 201) {
            var modalEl = document.getElementById('newCardModal');
            var modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            
            selectedCardId = res.body.data.id;
            loadSavedCards(); // Reload cards
        } else {
            if (res.body.errors) {
                const fieldMap = {
                    'card_type': 'cardType',
                    'card_name': 'cardName',
                    'card_number': 'cardNumber',
                    'expiry_date': 'cardExpiry',
                    'cvv': 'cardCvv'
                };
                
                let unmappedErrors = [];
                for (const [field, messages] of Object.entries(res.body.errors)) {
                    const inputId = fieldMap[field];
                    const inputEl = document.getElementById(inputId);
                    if (inputEl) {
                        inputEl.classList.add('is-invalid');
                        inputEl.nextElementSibling.textContent = messages[0];
                    } else {
                        unmappedErrors.push(messages[0]);
                    }
                }
                
                if (unmappedErrors.length > 0) {
                    document.getElementById('cardFormError').style.display = 'block';
                    document.getElementById('cardFormError').innerHTML = unmappedErrors.join('<br>');
                }
            } else {
                document.getElementById('cardFormError').style.display = 'block';
                document.getElementById('cardFormError').textContent = res.body.message || 'Validation error occurred.';
            }
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = 'Save Card';
        console.error(err);
    });
});


</script>
@endsection
