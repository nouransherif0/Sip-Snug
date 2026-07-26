<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ substr($order->id, -8) }} - Sip & Snug</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4A3B32;
            --primary-dark: #2C221D;
            --secondary: #D8A96B;
            --light-bg: #FCF7F1;
            --accent-border: #EFE2D3;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: #333;
            padding: 20px 0;
            margin: 0;
        }

        /* Invoice Card Full Width Container */
        .invoice-card {
            background: #ffffff;
            border: 1px solid var(--accent-border);
            border-radius: 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 850px;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            page-break-inside: avoid;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header spans 100% full width */
        .invoice-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: #ffffff;
            padding: 25px 40px;
            width: 100%;
            box-sizing: border-box;
        }

        .invoice-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.5px;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.15);
            padding: 5px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 8px;
            backdrop-filter: blur(4px);
        }

        .invoice-body {
            padding: 30px 40px;
            box-sizing: border-box;
        }

        /* Improved Delivery Details & Customer Info Boxes */
        .info-box {
            background: #FAF5EF;
            border: 1px solid var(--accent-border);
            border-radius: 12px;
            padding: 16px 20px;
            height: 100%;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.6);
        }

        .info-box-title {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
            border-bottom: 1px solid var(--accent-border);
            padding-bottom: 6px;
        }

        .table-invoice {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-invoice th {
            background: #F4EBE1;
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.88rem;
            padding: 12px 16px;
            border-bottom: 2px solid var(--accent-border);
        }

        .table-invoice th:first-child { border-top-left-radius: 8px; }
        .table-invoice th:last-child { border-top-right-radius: 8px; text-align: right; }

        .table-invoice td {
            padding: 12px 16px;
            border-bottom: 1px solid #F0E6DC;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .table-invoice td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .addon-tag {
            display: inline-block;
            background: #EFE2D3;
            color: var(--primary);
            font-size: 0.75rem;
            padding: 2px 7px;
            border-radius: 4px;
            margin-top: 2px;
            margin-right: 4px;
        }

        /* 100% Full Width Summary & Totals Card */
        .summary-card {
            background: linear-gradient(135deg, #FAF5EF, #F5EBE0);
            border: 1px solid var(--accent-border);
            border-radius: 12px;
            padding: 18px 24px;
            width: 100%;
            box-sizing: border-box;
            margin-top: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            font-size: 0.92rem;
            color: #444;
        }

        .summary-row.total {
            border-top: 2px dashed #D8C7B5;
            margin-top: 8px;
            padding-top: 12px;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        /* Footer spans 100% full width */
        .invoice-footer {
            border-top: 1px solid #F0E6DC;
            padding: 18px 40px;
            background: #FAF6F0;
            text-align: center;
            font-size: 0.85rem;
            color: #666;
            width: 100%;
            box-sizing: border-box;
            margin-top: auto;
        }

        .no-print-actions {
            max-width: 850px;
            margin: 0 auto 15px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Print Media Styles */
        @media print {
            body {
                background-color: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print-actions {
                display: none !important;
            }
            .invoice-card {
                box-shadow: none !important;
                border: none !important;
                max-width: 100% !important;
                width: 100% !important;
                border-radius: 0 !important;
                min-height: 100vh !important;
            }
            .invoice-header {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .info-box, .summary-card, .table-invoice th {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>
<body>

    <!-- Action Bar (Top) -->
    <div class="no-print-actions px-2">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm" style="border-color:#888;">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
        <div class="d-flex gap-2">
            <a id="pdfDownloadBtn" href="{{ route('orders.invoice.download', $order->id) }}" class="btn text-white rounded-pill px-4 btn-sm shadow-sm" style="background-color: #9C7A5B; border:none;">
                <i class="fas fa-file-pdf me-2"></i>Download PDF File
            </a>
            <button onclick="window.print()" class="btn text-white rounded-pill px-4 btn-sm shadow-sm" style="background-color: var(--primary);">
                <i class="fas fa-print me-2"></i>Print Invoice
            </button>
        </div>
    </div>

    <!-- Main Printable Invoice Card (Full Width Document) -->
    <div class="invoice-card" id="invoiceCard">
        <!-- Header (100% Full Width) -->
        <div class="invoice-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <div class="brand-badge">
                        <i class="fas fa-mug-hot text-warning"></i>
                        <span>Sip & Snug Coffee House</span>
                    </div>
                    <h1>TAX INVOICE</h1>
                    <p class="mb-0 text-white-50 small">Order ID: #{{ substr($order->id, -8) }}</p>
                </div>
                <div class="text-md-end">
                    <span class="badge bg-warning text-dark px-3 py-1 fs-6 rounded-pill mb-1 d-inline-block">
                        <i class="fas fa-check-circle me-1"></i> {{ strtoupper($order->status) }}
                    </span>
                    <div class="small text-white-50">Date: {{ $order->created_at->format('M d, Y • h:i A') }}</div>
                    <div class="small text-white-50">Payment: {{ strtoupper(str_replace('_', ' ', $order->payment_method ?? 'Cash on Delivery')) }}</div>
                </div>
            </div>
        </div>

        <!-- Invoice Body -->
        <div class="invoice-body">
            <!-- Enhanced Customer & Delivery Details Grid -->
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <div class="info-box">
                        <div class="info-box-title">
                            <i class="fas fa-user-circle me-1"></i> Customer Information
                        </div>
                        <div class="fw-bold text-dark mb-1" style="font-size:0.95rem;">{{ $order->user->name ?? 'Guest Customer' }}</div>
                        <div class="text-muted small mb-1"><i class="fas fa-envelope me-1 text-secondary"></i>{{ $order->user->email ?? 'N/A' }}</div>
                        <div class="text-muted small"><i class="fas fa-phone me-1 text-secondary"></i>{{ $order->address->phone_number ?? ($order->user->phone ?? 'N/A') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="info-box">
                        <div class="info-box-title">
                            <i class="fas fa-truck-ramp-box me-1"></i> Delivery Details (تفاصيل التوصيل)
                        </div>
                        @if($order->address)
                            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                                <span class="badge bg-danger text-white px-2 py-1"><i class="fas fa-map-marker-alt me-1"></i> {{ $order->address->label ?? 'Address' }}</span>
                                <span class="badge bg-secondary text-white px-2 py-1"><i class="fas fa-city me-1"></i> Zone: {{ $order->address->deliveryZone->name ?? 'Standard Zone' }}</span>
                            </div>
                            @if($order->address->street)
                                <div class="text-dark small fw-semibold mb-1">
                                    <i class="fas fa-road text-muted me-1"></i> {{ $order->address->street }}
                                </div>
                            @endif
                            <div class="text-muted small d-flex flex-wrap gap-3">
                                @if($order->address->building_number) <span><i class="fas fa-building text-secondary me-1"></i>Bldg: <strong>{{ $order->address->building_number }}</strong></span> @endif
                                @if($order->address->floor) <span><i class="fas fa-layer-group text-secondary me-1"></i>Floor: <strong>{{ $order->address->floor }}</strong></span> @endif
                                @if($order->address->apartment) <span><i class="fas fa-door-closed text-secondary me-1"></i>Apt: <strong>{{ $order->address->apartment }}</strong></span> @endif
                            </div>
                            @if($order->address->landmark)
                                <div class="text-muted small mt-1"><i class="fas fa-location-arrow text-warning me-1"></i>Landmark: {{ $order->address->landmark }}</div>
                            @endif
                        @else
                            <div class="text-muted small">Standard Delivery Address</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <h6 class="fw-bold text-dark mb-2" style="font-family:'Playfair Display', serif; font-size:1.05rem;">Order Items & Quantities</h6>
            <table class="table-invoice">
                <thead>
                    <tr>
                        <th style="width: 50%;">Item & Specifications</th>
                        <th style="text-align: center;">Unit Price</th>
                        <th style="text-align: center;">Qty</th>
                        <th>Total Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->product->name ?? 'Item #'.$item->product_id }}</div>
                                @if($item->orderItemAddons && $item->orderItemAddons->count() > 0)
                                    <div>
                                        @foreach($item->orderItemAddons as $itemAddon)
                                            <span class="addon-tag">
                                                + {{ $itemAddon->addOn->name ?? 'Addon' }} (+{{ number_format($itemAddon->price_adjustment, 2) }} EGP)
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td style="text-align: center;" class="text-muted">
                                EGP {{ number_format($item->price, 2) }}
                            </td>
                            <td style="text-align: center;">
                                <span class="badge bg-light text-dark border px-2 py-1">{{ $item->quantity }}x</span>
                            </td>
                            <td>
                                EGP {{ number_format($item->price * $item->quantity, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- 100% Full Width Summary & Totals Breakdown -->
            <div class="row">
                <div class="col-12">
                    <div class="summary-card">
                        @php
                            $subtotal = $order->orderItems->sum(function($i) { return $i->price * $i->quantity; });
                        @endphp
                        <div class="summary-row">
                            <span class="fw-medium text-dark"><i class="fas fa-shopping-bag me-2 text-secondary"></i>Items Subtotal (إجمالي المنتجات):</span>
                            <span class="fw-bold text-dark fs-6">EGP {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span class="fw-medium text-dark"><i class="fas fa-truck me-2 text-secondary"></i>Delivery Fee (مصاريف التوصيل):</span>
                            <span class="fw-bold text-dark fs-6">EGP {{ number_format($order->delivery_fee ?? 0, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span class="fw-medium text-dark"><i class="fas fa-percent me-2 text-secondary"></i>Tax (الضريبة 0%):</span>
                            <span class="text-muted fs-6">EGP 0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span class="fw-bold fs-5 text-dark"><i class="fas fa-receipt me-2 text-warning"></i>Grand Total (المبلغ الإجمالي النهائي):</span>
                            <span class="fw-bold fs-4" style="color: var(--primary);">EGP {{ number_format($order->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer (100% Full Width) -->
        <div class="invoice-footer">
            <div class="fw-bold text-dark mb-1">Thank you for choosing Sip & Snug Coffee House! ☕</div>
            <div>Support Line: <strong>19696</strong> • Email: <strong>SipnSnug@gmail.com</strong></div>
        </div>
    </div>

    <!-- Auto direct download if requested via URL -->
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('download') === 'pdf') {
                const btn = document.getElementById('pdfDownloadBtn');
                if (btn) {
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Downloading...';
                    window.location.href = btn.href;
                }
            }
        });
    </script>
</body>
</html>
