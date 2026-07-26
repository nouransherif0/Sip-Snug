<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard — Sip & Snug Cafe</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}" />

    <style>
        :root {
            --primary: #7a4b2e;
            --secondary: #d8a96b;
            --cream: #f7efe6;
            --cream2: #efe2d3;
            --dark: #2c221d;
            --light: #fcf7f1;
            --accent-green: #137333;
            --accent-red: #d93025;
        }

        html {
            margin: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f4ef;
            color: var(--dark);
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .admin-sidebar {
            width: 270px;
            background: linear-gradient(180deg, var(--dark) 0%, #1a1411 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1200;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
        }

        .admin-brand {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .admin-brand-ico {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #fff;
            box-shadow: 0 4px 12px rgba(122, 75, 46, 0.4);
        }

        .admin-brand-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.15rem;
            margin: 0;
            color: #fff;
        }

        .admin-nav {
            padding: 20px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #ccc;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 6px;
            transition: all 0.25s ease;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .admin-nav-item:hover,
        .admin-nav-item.active {
            background: rgba(216, 169, 107, 0.15);
            color: var(--secondary);
            transform: translateX(4px);
        }

        .admin-nav-item i {
            width: 20px;
            font-size: 1rem;
            text-align: center;
        }

        .admin-user-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Main Content */
        .admin-main {
            margin-left: 270px;
            flex: 1;
            padding: 30px;
            background: #f8f4ef;
            min-width: 0;
            overflow-x: clip;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            position: sticky;
            top: 0;
            z-index: 999;
            background: #f8f4ef;
            padding: 16px 0;
            border-bottom: 1px solid #efe2d3;
        }

        .admin-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--dark);
            margin: 0;
        }

        .card-stat {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            border: 1px solid #efe2d3;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.25s;
        }

        .card-stat:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        .stat-icon.brown {
            background: rgba(122, 75, 46, 0.12);
            color: var(--primary);
        }

        .stat-icon.gold {
            background: rgba(216, 169, 107, 0.18);
            color: #b88339;
        }

        .stat-icon.green {
            background: rgba(19, 115, 51, 0.12);
            color: var(--accent-green);
        }

        .stat-icon.red {
            background: rgba(217, 48, 37, 0.12);
            color: var(--accent-red);
        }

        .stat-val {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 2px;
        }

        .stat-lbl {
            font-size: 0.8rem;
            color: #777;
            font-weight: 500;
        }

        /* Content Cards & Tables */
        .panel-card {
            background: #fff;
            border-radius: 20px;
            padding: 24px;
            border: 1px solid #efe2d3;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--dark);
            margin: 0;
        }

        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table-custom th {
            padding: 12px 16px;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #888;
            font-weight: 600;
            border: none;
        }

        .table-custom td {
            padding: 14px 16px;
            background: var(--light);
            border-top: 1px solid #efe2d3;
            border-bottom: 1px solid #efe2d3;
            font-size: 0.88rem;
            vertical-align: middle;
        }

        .table-custom tr td:first-child {
            border-left: 1px solid #efe2d3;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .table-custom tr td:last-child {
            border-right: 1px solid #efe2d3;
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-pending {
            background: #fef7e0;
            color: #b06000;
        }

        .badge-confirmed {
            background: #e8f0fe;
            color: #1a73e8;
        }

        .badge-preparing {
            background: #fce8e6;
            color: #c5221f;
        }

        .badge-delivered {
            background: #e6f4ea;
            color: #137333;
        }

        .badge-cancelled {
            background: #f1f3f4;
            color: #5f6368;
        }

        .btn-primary-snug {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.88rem;
            transition: opacity 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary-snug:hover {
            opacity: 0.9;
            color: #fff;
        }

        .btn-action {
            width: auto;
            min-width: 34px;
            height: 34px;
            padding: 0 10px;
            border-radius: 8px;
            border: 1px solid #e0d4c8;
            background: #fff;
            color: var(--dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .btn-action i {
            font-size: 0.82rem;
        }

        .btn-action:hover {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .btn-action.delete:hover {
            background: var(--accent-red);
            border-color: var(--accent-red);
            color: #fff;
        }

        .img-thumb {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
        }

        .tab-content-panel {
            display: none;
        }

        .tab-content-panel.active {
            display: block;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 991px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.active {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
                padding: 12px 12px 30px 12px;
                overflow: visible !important;
            }

            .admin-header {
                position: sticky !important;
                top: 0 !important;
                z-index: 1050 !important;
                background: #f8f4ef !important;
                flex-direction: row !important;
                flex-wrap: nowrap !important;
                justify-content: space-between !important;
                align-items: center !important;
                gap: 12px !important;
                margin: -12px -12px 16px -12px !important;
                padding: 14px 16px !important;
                border-bottom: 1px solid #efe2d3 !important;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06) !important;
            }

            .admin-header .d-flex {
                gap: 10px !important;
            }

            .admin-header .admin-title {
                font-size: 1.05rem !important;
                line-height: 1.2 !important;
                margin-bottom: 0 !important;
                white-space: nowrap !important;
                max-width: none !important;
            }

            .admin-header .header-actions {
                width: auto !important;
                display: flex !important;
                justify-content: flex-end !important;
                align-items: center !important;
                gap: 16px !important;
            }

            .admin-header .dropdown-menu {
                max-width: 90vw !important;
                width: 300px !important;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12) !important;
            }

            .admin-header .dropdown button {
                width: 38px !important;
                height: 38px !important;
                border-radius: 50% !important;
            }

            .admin-header .dropdown .badge {
                top: 0 !important;
                right: 0 !important;
                transform: none !important;
            }

            .admin-header .btn-primary-snug {
                width: 38px !important;
                height: 38px !important;
                padding: 0 !important;
                border-radius: 50% !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                font-size: 0.9rem !important;
            }

            @media (min-width: 576px) {
                .admin-header .btn-primary-snug {
                    width: auto !important;
                    height: auto !important;
                    padding: 8px 18px !important;
                    border-radius: 50px !important;
                }
            }

            .table-custom th,
            .table-custom td {
                white-space: nowrap;
            }
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: visible !important;
            }

            .table-custom {
                display: block !important;
                width: 100% !important;
                border-spacing: 0 !important;
            }

            .table-custom thead {
                display: none !important;
            }

            .table-custom tbody {
                display: grid !important;
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 10px !important;
                width: 100% !important;
            }

            .table-custom tr {
                display: flex !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                background: #fff !important;
                border: 1px solid #efe2d3 !important;
                border-radius: 14px !important;
                padding: 10px 8px !important;
                margin-bottom: 0 !important;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03) !important;
                height: 100% !important;
                box-sizing: border-box !important;
            }

            .table-custom td {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                padding: 5px 0 !important;
                border: none !important;
                border-bottom: 1px dashed #efe2d3 !important;
                background: transparent !important;
                font-size: 0.78rem !important;
                white-space: normal !important;
                text-align: center !important;
                box-sizing: border-box !important;
                word-break: break-word;
            }

            .table-custom td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #999;
                font-size: 0.64rem;
                text-transform: uppercase;
                letter-spacing: 0.4px;
                text-align: center;
                margin-right: 0;
                margin-bottom: 2px;
                display: block;
                width: 100%;
            }

            .table-custom td:not([data-label]) {
                justify-content: center !important;
            }

            .table-custom tr td:first-child {
                border-top-left-radius: 0 !important;
                border-bottom-left-radius: 0 !important;
                border-left: none !important;
                padding-top: 2px !important;
                font-size: 0.85rem !important;
                border-bottom: 1px solid #efe2d3 !important;
                padding-bottom: 8px !important;
                margin-bottom: 4px;
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
            }

            .table-custom tr td:first-child .d-flex {
                flex-direction: column !important;
                align-items: center !important;
                text-align: center !important;
                gap: 4px !important;
            }

            .table-custom tr td:first-child::before,
            .table-custom tr td:last-child::before {
                display: none !important;
                content: none !important;
                width: 0 !important;
                height: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .table-custom tr td:last-child {
                border-top-right-radius: 0 !important;
                border-bottom-right-radius: 0 !important;
                border-right: none !important;
                border-bottom: none !important;
                padding-bottom: 4px !important;
                padding-top: 8px !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                flex-direction: row !important;
                gap: 12px !important;
                margin-top: auto !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }

            .table-custom .btn-action {
                width: 36px !important;
                height: 36px !important;
                min-width: 36px !important;
                padding: 0 !important;
                border-radius: 10px !important;
                font-size: 0 !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                flex: 0 0 36px !important;
                white-space: nowrap !important;
                margin: 0 !important;
            }

            .table-custom .btn-action i {
                font-size: 0.85rem !important;
            }
        }

        .mobile-toggle {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.25rem;
            color: var(--dark);
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .admin-sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1150;
            display: none;
            backdrop-filter: blur(2px);
        }

        .admin-sidebar-backdrop.active {
            display: block;
        }

        @media (max-width: 991px) {
            .mobile-toggle {
                display: inline-flex !important;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR OVERLAY BACKDROP -->
    <div class="admin-sidebar-backdrop"
        onclick="document.querySelector('.admin-sidebar').classList.remove('active'); this.classList.remove('active');">
    </div>

    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <div class="admin-brand d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <div class="admin-brand-ico"><i class="fas fa-mug-hot"></i></div>
                <div>
                    <h5 class="admin-brand-title m-0">Sip & Snug</h5>
                    <small style="color:var(--secondary);font-size:0.75rem;">Admin Management</small>
                </div>
            </div>
            <button class="btn btn-sm text-white d-lg-none"
                onclick="document.querySelector('.admin-sidebar').classList.remove('active'); document.querySelector('.admin-sidebar-backdrop').classList.remove('active');"><i
                    class="fas fa-times"></i></button>
        </div>

        <nav class="admin-nav">
            <button class="admin-nav-item active" onclick="switchTab('overview', this)">
                <i class="fas fa-chart-line"></i> Dashboard Overview
            </button>
            <button class="admin-nav-item" onclick="switchTab('products', this)">
                <i class="fas fa-coffee"></i> Products
            </button>
            <button class="admin-nav-item" onclick="switchTab('categories', this)">
                <i class="fas fa-layer-group"></i> Categories
            </button>
            <button class="admin-nav-item" onclick="switchTab('subcategories', this)">
                <i class="fas fa-tags"></i> Subcategories
            </button>
            <button class="admin-nav-item" onclick="switchTab('addons', this)">
                <i class="fas fa-cookie-bite"></i> Add-Ons
            </button>
            <button class="admin-nav-item" onclick="switchTab('store-locations', this)">
                <i class="fas fa-map-marked-alt"></i> Store Locations
            </button>
            <button class="admin-nav-item" onclick="switchTab('delivery', this)">
                <i class="fas fa-truck"></i> Delivery Zones
            </button>
            <button class="admin-nav-item" onclick="switchTab('orders', this)">
                <i class="fas fa-shopping-bag"></i> Orders Management
            </button>
            <a href="{{ route('home') }}" class="admin-nav-item mt-4" style="color:#aaa;">
                <i class="fas fa-store"></i> Back to Main Site
            </a>
        </nav>

        <div class="admin-user-footer">
            <div class="d-flex align-items-center gap-2">
                <div
                    style="width:36px;height:36px;border-radius:50%;background:var(--secondary);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <div style="font-size:0.85rem;font-weight:600;">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div style="font-size:0.72rem;color:var(--secondary);">Administrator</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-link p-0 text-danger" title="Logout"><i
                        class="fas fa-sign-out-alt fs-5"></i></button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="admin-main">
        <!-- Top Header -->
        <div class="admin-header">
            <div class="d-flex align-items-center gap-3">
                <button class="mobile-toggle d-lg-none"
                    onclick="document.querySelector('.admin-sidebar').classList.add('active'); document.querySelector('.admin-sidebar-backdrop').classList.add('active');">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h2 class="admin-title" id="pageTitle">Dashboard Overview</h2>
                    <p class="text-muted m-0 d-none d-md-block" style="font-size:0.88rem;">Manage drinks, stock,
                        categories, add-ons and orders.</p>
                </div>
            </div>
            <div class="d-flex gap-3 align-items-center header-actions">
                @if (isset($lowStockCount) && $lowStockCount > 0)
                    <div class="dropdown">
                        <button class="btn btn-light position-relative border-0 rounded-circle shadow-sm" type="button"
                            data-bs-toggle="dropdown" style="width:45px;height:45px;background:#fff;">
                            <i class="fas fa-bell text-danger fs-5"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $lowStockCount }}
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-0"
                            style="max-height: 400px; overflow-y: auto;">
                            <li class="p-3 border-bottom bg-light d-flex align-items-center justify-content-between">
                                <h6 class="m-0 text-danger fw-bold" style="font-size:0.88rem;"><i
                                        class="fas fa-exclamation-circle me-2"></i>Low Stock Alerts</h6>
                                <span class="badge bg-danger rounded-pill px-2 py-1"
                                    style="font-size:0.72rem;">{{ $lowStockCount }} items</span>
                            </li>
                            @foreach ($lowStockProducts as $prod)
                                <li>
                                    <a class="dropdown-item py-2 px-3 border-bottom text-wrap" href="#"
                                        onclick="switchTab('products', document.querySelectorAll('.admin-nav-item')[1])">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <strong class="text-dark"
                                                style="font-size:0.86rem;">{{ $prod->name }}</strong>
                                            <span class="badge bg-danger text-white rounded-pill px-2 py-1 ms-2"
                                                style="font-size:0.7rem;">
                                                {{ $prod->stock }} left
                                            </span>
                                        </div>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">
                                            <i class="fas fa-box me-1 text-warning"></i>Product stock is running low!
                                        </small>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <a href="{{ route('home') }}" class="btn-primary-snug" title="View Live Store"><i
                        class="fas fa-store"></i><span class="d-none d-sm-inline ms-1">View Live Store</span></a>
            </div>
        </div>

        <!-- Flash Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm mb-4"
                role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- ================= 1. TAB: OVERVIEW ================= -->
        <div id="tab-overview" class="tab-content-panel active">
            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-stat">
                        <div>
                            <div class="stat-val">EGP {{ number_format($totalSales, 2) }}</div>
                            <div class="stat-lbl">Total Delivered Revenue</div>
                        </div>
                        <div class="stat-icon green"><i class="fas fa-dollar-sign"></i></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-stat">
                        <div>
                            <div class="stat-val">{{ $activeOrdersCount }}</div>
                            <div class="stat-lbl">Active Pending Orders</div>
                        </div>
                        <div class="stat-icon gold"><i class="fas fa-shopping-basket"></i></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-stat">
                        <div>
                            <div class="stat-val">{{ $products->count() }}</div>
                            <div class="stat-lbl">Total Products</div>
                        </div>
                        <div class="stat-icon brown"><i class="fas fa-coffee"></i></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card-stat">
                        <div>
                            <div class="stat-val">{{ $lowStockCount }}</div>
                            <div class="stat-lbl">Low Stock Alerts</div>
                        </div>
                        <div class="stat-icon red"><i class="fas fa-exclamation-triangle"></i></div>
                    </div>
                </div>
            </div>

            <!-- Row: Best Selling & High Rated -->
            <div class="row g-4 mb-4">
                <!-- Best Selling Products -->
                <div class="col-lg-6">
                    <div class="panel-card h-100">
                        <div class="panel-head">
                            <h5 class="panel-title"><i class="fas fa-fire text-warning me-2"></i>Best Selling Products
                            </h5>
                            <span class="badge bg-light text-dark rounded-pill">Top Picks</span>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            @forelse($bestSellingProducts as $item)
                                <div class="d-flex align-items-center justify-content-between p-2 rounded-3"
                                    style="background:var(--light);">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->image ? asset($item->image) : asset('front/photos/coffee/hot latte.jpg') }}"
                                            class="img-thumb" alt="" />
                                        <div>
                                            <strong
                                                style="font-size:0.9rem;display:block;">{{ $item->name }}</strong>
                                            <small class="text-muted">EGP {{ number_format($item->price, 2) }}</small>
                                        </div>
                                    </div>
                                    <span class="badge bg-success rounded-pill px-3 py-2"><i
                                            class="fas fa-star me-1"></i> Featured</span>
                                </div>
                            @empty
                                <p class="text-muted">No featured best selling items found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- High Rated & Favorites -->
                <div class="col-lg-6">
                    <div class="panel-card h-100">
                        <div class="panel-head">
                            <h5 class="panel-title"><i class="fas fa-heart text-danger me-2"></i>High Rated Favorites
                            </h5>
                            <span class="badge bg-light text-dark rounded-pill">Customer Favorites</span>
                        </div>
                        <div class="d-flex flex-column gap-3">
                            @forelse($highRatedProducts as $item)
                                <div class="d-flex align-items-center justify-content-between p-2 rounded-3"
                                    style="background:var(--light);">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $item->image ? asset($item->image) : asset('front/photos/matcha/iced matcha .jpg') }}"
                                            class="img-thumb" alt="" />
                                        <div>
                                            <strong
                                                style="font-size:0.9rem;display:block;">{{ $item->name }}</strong>
                                            <small
                                                class="text-muted">{{ $item->subcategory->name ?? 'Drinks' }}</small>
                                        </div>
                                    </div>
                                    <span class="fw-bold" style="color:var(--primary);">EGP
                                        {{ number_format($item->price, 2) }}</span>
                                </div>
                            @empty
                                <p class="text-muted">No rated items found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock Available Summary -->
            <div class="panel-card">
                <div class="panel-head">
                    <h5 class="panel-title"><i class="fas fa-boxes text-primary me-2"></i>Stock Availability &
                        Inventory</h5>
                    <button class="btn btn-sm btn-outline-secondary rounded-pill"
                        onclick="switchTab('products')">Manage Products</button>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Subcategory</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products->take(8) as $prod)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $prod->image ? asset($prod->image) : asset('front/photos/coffee/esspresso.jpg') }}"
                                                class="img-thumb" style="width:36px;height:36px;" />
                                            <strong>{{ $prod->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $prod->subcategory->name ?? 'General' }}</td>
                                    <td>EGP {{ number_format($prod->price, 2) }}</td>
                                    <td><strong>{{ $prod->stock }}</strong> units</td>
                                    <td>
                                        @if ($prod->stock > 10)
                                            <span class="badge bg-success rounded-pill px-3 py-1">In Stock</span>
                                        @elseif($prod->stock > 0)
                                            <span class="badge bg-warning text-dark rounded-pill px-3 py-1">Low
                                                Stock</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill px-3 py-1">Out of Stock</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= 2. TAB: PRODUCTS ================= -->
        <div id="tab-products" class="tab-content-panel">
            <div class="panel-card">
                <div class="panel-head d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5 class="panel-title mb-0"><i class="fas fa-coffee me-2"></i>Products Management</h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <span class="input-group-text bg-white border-end-0 rounded-start-3"><i
                                    class="fas fa-search text-muted"></i></span>
                            <input type="text" id="productTableSearch"
                                class="form-control border-start-0 rounded-end-3" placeholder="Search products..."
                                oninput="filterProductTable(this)">
                        </div>
                        <button class="btn-primary-snug" data-bs-toggle="modal"
                            data-bs-target="#createProductModal"><i class="fas fa-plus"></i> Add New Product</button>
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Subcategory</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $prod)
                                <tr
                                    @if ($prod->stock <= 10) style="background-color: #fff5f5; box-shadow: inset 4px 0 0 red;" @endif>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $prod->image ? asset($prod->image) : asset('front/photos/coffee/hot latte.jpg') }}"
                                                class="img-thumb"
                                                style="width:36px;height:36px;border-radius:8px;object-fit:cover;" />
                                            <strong>{{ $prod->name }}</strong>
                                        </div>
                                    </td>
                                    <td data-label="Subcategory">{{ $prod->subcategory->name ?? '-' }}</td>
                                    <td data-label="Price">EGP {{ number_format($prod->price, 2) }}</td>
                                    <td data-label="Stock">
                                        @if ($prod->stock <= 10)
                                            <span class="badge bg-danger px-2 py-1"><i
                                                    class="fas fa-exclamation-triangle me-1"></i> {{ $prod->stock }}
                                                left</span>
                                        @else
                                            <span class="badge bg-light text-dark border px-2 py-1">
                                                {{ $prod->stock }} in stock
                                            </span>
                                        @endif
                                    </td>
                                    <td data-label="Featured">
                                        @if ($prod->is_featured)
                                            <span class="badge bg-warning text-dark"><i class="fas fa-star"></i>
                                                Featured</span>
                                        @else
                                            <span class="text-muted">Standard</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn-action stock me-1"
                                            style="background:#eef2ff; color:#4f46e5; border-color:#c7d2fe;"
                                            title="Update Stock"
                                            onclick="openStockModal({{ json_encode($prod) }})"><i
                                                class="fas fa-boxes me-1"></i>Stock</button>
                                        <button class="btn-action" title="Edit"
                                            onclick="openEditProductModal({{ json_encode($prod) }})"><i
                                                class="fas fa-edit me-1"></i>Edit</button>
                                        <button class="btn-action delete" title="Delete"
                                            onclick="deleteItem('/admin/products/{{ $prod->id }}')"><i
                                                class="fas fa-trash-alt me-1"></i>Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No products created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= 3. TAB: CATEGORIES ================= -->
        <div id="tab-categories" class="tab-content-panel">
            <div class="panel-card">
                <div class="panel-head d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5 class="panel-title mb-0"><i class="fas fa-layer-group me-2"></i>Categories Management</h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <span class="input-group-text bg-white border-end-0 rounded-start-3"><i
                                    class="fas fa-search text-muted"></i></span>
                            <input type="text" id="categoryTableSearch"
                                class="form-control border-start-0 rounded-end-3" placeholder="Search categories..."
                                oninput="filterCategoryTable(this)">
                        </div>
                        <button class="btn-primary-snug" data-bs-toggle="modal"
                            data-bs-target="#createCategoryModal"><i class="fas fa-plus"></i> Add Category</button>
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>ID</th>
                                <th>Subcategories</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $cat)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $cat->image ? asset($cat->image) : asset('front/photos/coffee/hot latte.jpg') }}"
                                                class="img-thumb"
                                                style="width:36px;height:36px;border-radius:8px;object-fit:cover;" />
                                            <strong>{{ $cat->name }}</strong>
                                        </div>
                                    </td>
                                    <td data-label="Category ID">#{{ $cat->id }}</td>
                                    <td data-label="Subcategories"><span
                                            class="badge bg-secondary rounded-pill">{{ $cat->subcategories_count }}
                                            subcategories</span></td>
                                    <td data-label="Created At">{{ $cat->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <button class="btn-action" title="Edit"
                                            onclick="openEditCategoryModal({{ json_encode($cat) }})"><i
                                                class="fas fa-edit me-1"></i>Edit</button>
                                        <button class="btn-action delete" title="Delete"
                                            onclick="deleteItem('/admin/categories/{{ $cat->id }}')"><i
                                                class="fas fa-trash-alt me-1"></i>Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No categories created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= 4. TAB: SUBCATEGORIES ================= -->
        <div id="tab-subcategories" class="tab-content-panel">
            <div class="panel-card">
                <div class="panel-head d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5 class="panel-title mb-0"><i class="fas fa-tags me-2"></i>Subcategories Management</h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <span class="input-group-text bg-white border-end-0 rounded-start-3"><i
                                    class="fas fa-search text-muted"></i></span>
                            <input type="text" id="subcategoryTableSearch"
                                class="form-control border-start-0 rounded-end-3"
                                placeholder="Search subcategories..." oninput="filterSubcategoryTable(this)">
                        </div>
                        <button class="btn-primary-snug" data-bs-toggle="modal"
                            data-bs-target="#createSubcategoryModal"><i class="fas fa-plus"></i> Add
                            Subcategory</button>
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Subcategory</th>
                                <th>ID</th>
                                <th>Parent Category</th>
                                <th>Products Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subcategories as $sub)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ $sub->image ? asset($sub->image) : asset('front/photos/coffee/hot latte.jpg') }}"
                                                class="img-thumb"
                                                style="width:36px;height:36px;border-radius:8px;object-fit:cover;" />
                                            <strong>{{ $sub->name }}</strong>
                                        </div>
                                    </td>
                                    <td data-label="Subcategory ID">#{{ $sub->id }}</td>
                                    <td data-label="Parent Category"><span
                                            class="badge bg-light text-dark border">{{ $sub->category->name ?? '-' }}</span>
                                    </td>
                                    <td data-label="Products Count">{{ $sub->products_count }} products</td>
                                    <td>
                                        <button class="btn-action" title="Edit"
                                            onclick="openEditSubcategoryModal({{ json_encode($sub) }})"><i
                                                class="fas fa-edit me-1"></i>Edit</button>
                                        <button class="btn-action delete" title="Delete"
                                            onclick="deleteItem('/admin/subcategories/{{ $sub->id }}')"><i
                                                class="fas fa-trash-alt me-1"></i>Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No subcategories created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= 5. TAB: ADDONS ================= -->
        <div id="tab-addons" class="tab-content-panel">
            <div class="panel-card">
                <div class="panel-head d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5 class="panel-title mb-0"><i class="fas fa-cookie-bite me-2"></i>Add-Ons Management</h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <span class="input-group-text bg-white border-end-0 rounded-start-3"><i
                                    class="fas fa-search text-muted"></i></span>
                            <input type="text" id="addonTableSearch"
                                class="form-control border-start-0 rounded-end-3" placeholder="Search add-ons..."
                                oninput="filterAddonTable(this)">
                        </div>
                        <button class="btn-primary-snug" data-bs-toggle="modal" data-bs-target="#createAddonModal"><i
                                class="fas fa-plus"></i> Add Add-On</button>
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Add-On Name</th>
                                <th>ID</th>
                                <th>Applicability / Scope</th>
                                <th>Price Adjustment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($addOns as $addon)
                                <tr>
                                    <td><strong>{{ $addon->name }}</strong></td>
                                    <td data-label="Add-On ID">#{{ $addon->id }}</td>
                                    <td data-label="Scope">
                                        @if (($addon->scope ?? 'global') === 'global')
                                            <span class="badge bg-primary px-2 py-1"><i
                                                    class="fas fa-globe me-1"></i>Global (All Products)</span>
                                        @elseif($addon->scope === 'category')
                                            @php
                                                $cats = $addon->categories->pluck('name')->toArray();
                                                if (empty($cats) && $addon->category) {
                                                    $cats = [$addon->category->name];
                                                }
                                            @endphp
                                            <span class="badge bg-info text-dark px-2 py-1"
                                                title="{{ implode(', ', $cats) }}">
                                                <i class="fas fa-folder me-1"></i>Categories ({{ count($cats) }}):
                                                {{ \Illuminate\Support\Str::limit(implode(', ', $cats), 28) }}
                                            </span>
                                        @elseif($addon->scope === 'subcategory')
                                            @php
                                                $subcats = $addon->subcategories->pluck('name')->toArray();
                                                if (empty($subcats) && $addon->subcategory) {
                                                    $subcats = [$addon->subcategory->name];
                                                }
                                            @endphp
                                            <span class="badge bg-warning text-dark px-2 py-1"
                                                title="{{ implode(', ', $subcats) }}">
                                                <i class="fas fa-tags me-1"></i>Subcategories ({{ count($subcats) }}):
                                                {{ \Illuminate\Support\Str::limit(implode(', ', $subcats), 28) }}
                                            </span>
                                        @elseif($addon->scope === 'product')
                                            @php
                                                $prods = $addon->products->pluck('name')->toArray();
                                                if (empty($prods) && $addon->product) {
                                                    $prods = [$addon->product->name];
                                                }
                                            @endphp
                                            <span class="badge bg-secondary px-2 py-1"
                                                title="{{ implode(', ', $prods) }}">
                                                <i class="fas fa-mug-hot me-1"></i>Products ({{ count($prods) }}):
                                                {{ \Illuminate\Support\Str::limit(implode(', ', $prods), 28) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td data-label="Price Adjustment"><span class="fw-bold text-success">+EGP
                                            {{ number_format($addon->price_adjustment, 2) }}</span></td>
                                    <td>
                                        <button class="btn-action" title="Edit"
                                            onclick="openEditAddonModal({{ json_encode($addon) }})"><i
                                                class="fas fa-edit me-1"></i>Edit</button>
                                        <button class="btn-action delete" title="Delete"
                                            onclick="deleteItem('/admin/add-ons/{{ $addon->id }}')"><i
                                                class="fas fa-trash-alt me-1"></i>Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No add-ons created yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= TAB: STORE LOCATIONS ================= -->
        <div id="tab-store-locations" class="tab-content-panel">
            <div class="panel-card">
                <div class="panel-head d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5 class="panel-title mb-0"><i class="fas fa-map-marked-alt me-2"></i>Store Locations Management
                    </h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <span class="input-group-text bg-white border-end-0 rounded-start-3"><i
                                    class="fas fa-search text-muted"></i></span>
                            <input type="text" id="storeLocationTableSearch"
                                class="form-control border-start-0 rounded-end-3" placeholder="Search locations..."
                                oninput="filterStoreLocationTable(this)">
                        </div>
                        <button class="btn-primary-snug" data-bs-toggle="modal"
                            data-bs-target="#createStoreLocationModal"><i class="fas fa-plus"></i> Add
                            Location</button>
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Branch / Outlet Name</th>
                                <th>Badge / Tag</th>
                                <th>Address</th>
                                <th>Working Hours</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($storeLocations as $loc)
                                <tr>
                                    <td data-label="ID">#{{ $loc->id }}</td>
                                    <td><strong>{{ $loc->name }}</strong></td>
                                    <td data-label="Badge">
                                        @if ($loc->badge)
                                            <span class="badge bg-secondary px-2 py-1"><i
                                                    class="fas fa-tag me-1"></i>{{ $loc->badge }}</span>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td data-label="Address"><small class="text-muted"><i
                                                class="fas fa-map-marker-alt text-danger me-1"></i>{{ $loc->address }}</small>
                                    </td>
                                    <td data-label="Working Hours"><small><i
                                                class="fas fa-clock text-primary me-1"></i>{{ $loc->formatted_working_hours }}</small>
                                    </td>
                                    <td data-label="Phone"><small><i
                                                class="fas fa-phone text-success me-1"></i>{{ $loc->phone }}</small>
                                    </td>
                                    <td data-label="Status">
                                        @if (($loc->status ?? 'open') === 'open')
                                            <span class="badge bg-success px-2 py-1"><i
                                                    class="fas fa-door-open me-1"></i>Open</span>
                                        @else
                                            <span class="badge bg-danger px-2 py-1"><i
                                                    class="fas fa-door-closed me-1"></i>Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn-action" title="Edit"
                                            onclick="openEditStoreLocationModal({{ json_encode($loc) }})"><i
                                                class="fas fa-edit me-1"></i>Edit</button>
                                        <button class="btn-action delete" title="Delete"
                                            onclick="deleteItem('/admin/store-locations/{{ $loc->id }}')"><i
                                                class="fas fa-trash-alt me-1"></i>Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center p-4 text-muted">No store locations created
                                        yet. Click "Add Location" to create one.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= 6. TAB: DELIVERY ZONES ================= -->
        <div id="tab-delivery" class="tab-content-panel">
            <div class="panel-card">
                <div class="panel-head d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5 class="panel-title mb-0"><i class="fas fa-truck me-2"></i>Delivery Zones Management</h5>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="max-width: 250px;">
                            <span class="input-group-text bg-white border-end-0 rounded-start-3"><i
                                    class="fas fa-search text-muted"></i></span>
                            <input type="text" id="deliveryZoneTableSearch"
                                class="form-control border-start-0 rounded-end-3"
                                placeholder="Search delivery zones..." oninput="filterDeliveryZoneTable(this)">
                        </div>
                        <button class="btn-primary-snug" data-bs-toggle="modal"
                            data-bs-target="#createDeliveryZoneModal"><i class="fas fa-plus"></i> Add Delivery
                            Zone</button>
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Zone Name</th>
                                <th>Delivery Fee</th>
                                <th>Min Order Value</th>
                                <th>Estimated Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deliveryZones as $zone)
                                <tr>
                                    <td><strong>{{ $zone->name }}</strong></td>
                                    <td data-label="Delivery Fee">EGP {{ number_format($zone->delivery_fee, 2) }}</td>
                                    <td data-label="Min Order">EGP
                                        {{ number_format($zone->minimum_order_value ?? 0, 2) }}</td>
                                    <td data-label="Estimated Time"><i
                                            class="fas fa-clock me-1 text-muted"></i>{{ $zone->estimated_time ?? '20-30 mins' }}
                                    </td>
                                    <td>
                                        <button class="btn-action" title="Edit"
                                            onclick="openEditDeliveryModal({{ json_encode($zone) }})"><i
                                                class="fas fa-edit me-1"></i>Edit</button>
                                        <button class="btn-action delete" title="Delete"
                                            onclick="deleteItem('/admin/delivery-zones/{{ $zone->id }}')"><i
                                                class="fas fa-trash-alt me-1"></i>Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No delivery zones created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ================= 7. TAB: ORDERS ================= -->
        <div id="tab-orders" class="tab-content-panel">
            <div class="panel-card">
                <div class="panel-head d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <h5 class="panel-title mb-0"><i class="fas fa-shopping-bag me-2"></i>Customer Orders Management
                    </h5>
                    <div class="input-group input-group-sm" style="max-width: 250px;">
                        <span class="input-group-text bg-white border-end-0 rounded-start-3"><i
                                class="fas fa-search text-muted"></i></span>
                        <input type="text" id="orderTableSearch" class="form-control border-start-0 rounded-end-3"
                            placeholder="Search orders..." oninput="filterOrderTable(this)">
                    </div>
                </div>
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table-custom">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Payment</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $ord)
                                <tr>
                                    <td><strong>Order #{{ substr($ord->id, 0, 8) }}</strong></td>
                                    <td data-label="Customer">{{ $ord->user->name ?? 'Guest' }}</td>
                                    <td data-label="Payment"><span
                                            class="badge bg-light text-dark border">{{ strtoupper($ord->payment_method) }}</span>
                                    </td>
                                    <td data-label="Total"><strong style="color:var(--primary);">EGP
                                            {{ number_format($ord->total_price, 2) }}</strong></td>
                                    <td data-label="Date">{{ $ord->created_at->format('M d, g:i A') }}</td>
                                    <td data-label="Status">
                                        <select
                                            class="form-select form-select-sm rounded-pill fw-bold border-0 bg-light ms-auto"
                                            onchange="updateOrderStatus('{{ $ord->id }}', this.value)"
                                            style="width:140px;">
                                            <option value="pending" {{ $ord->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="confirmed"
                                                {{ $ord->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="preparing"
                                                {{ $ord->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                            <option value="out_for_delivery"
                                                {{ $ord->status == 'out_for_delivery' ? 'selected' : '' }}>Out For
                                                Delivery</option>
                                            <option value="delivered"
                                                {{ $ord->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="cancelled"
                                                {{ $ord->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="/orders/{{ $ord->id }}/invoice" target="_blank" class="btn-action" style="background:#f4ebe1; color:var(--primary); border-color:#e6ded6;" title="View Invoice">
                                            <i class="fas fa-file-invoice me-1"></i>Invoice
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- MODALS -->
    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form onsubmit="submitApiForm(event, '/admin/categories', 'POST')" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required
                                placeholder="e.g. Hot Coffees" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Image</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*"
                                required />
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Subcategory Modal -->
    <div class="modal fade" id="createSubcategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Add New Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form onsubmit="submitApiForm(event, '/admin/subcategories', 'POST')" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Parent Category</label>
                            <select name="category_id" class="form-select rounded-3" required>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subcategory Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required
                                placeholder="e.g. Espresso & Lattes" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subcategory Photo</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*"
                                required />
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Save Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Product Modal -->
    <div class="modal fade" id="createProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form onsubmit="submitApiForm(event, '/admin/products', 'POST')" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subcategory</label>
                            <select name="subcategory_id" class="form-select rounded-3" required>
                                @foreach ($subcategories as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}
                                        ({{ $s->category->name ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required
                                placeholder="e.g. Vanilla Bean Latte" />
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-bold">Price (EGP)</label>
                                <input type="number" step="0.01" name="price" class="form-control rounded-3"
                                    required placeholder="4.50" />
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Stock Available</label>
                                <input type="number" name="stock" class="form-control rounded-3" min="20"
                                    required value="20" />
                            </div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-4">
                                <label class="form-label fw-bold">Calories</label>
                                <input type="number" name="calories" class="form-control rounded-3" value="180"
                                    min="0" required />
                            </div>
                            <div class="col-4">
                                <label class="form-label fw-bold">Prep Time (min)</label>
                                <input type="number" name="prep_time" class="form-control rounded-3" value="5"
                                    min="0" required />
                            </div>
                            <div class="col-4">
                                <label class="form-label fw-bold">Discount Amount (EGP)</label>
                                <input type="number" step="0.01" name="discount_price"
                                    class="form-control rounded-3" placeholder="Optional" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control rounded-3" rows="2"
                                placeholder="Smooth espresso blended with sweet vanilla..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Image</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*"
                                required />
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch" style="font-size: 1.1rem;">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        name="is_featured" value="1" id="isFeaturedCheck"
                                        style="cursor: pointer;">
                                    <label class="form-check-label fw-bold ms-2" for="isFeaturedCheck"
                                        style="cursor: pointer;">Feature as Hot</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch" style="font-size: 1.1rem;">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        name="is_bestseller" value="1" id="isBestsellerCheck"
                                        style="cursor: pointer;">
                                    <label class="form-check-label fw-bold ms-2" for="isBestsellerCheck"
                                        style="cursor: pointer;">Category Bestseller</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editCategoryForm" onsubmit="submitApiForm(event, this.action, 'PUT')"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Name</label>
                            <input type="text" name="name" id="editCategoryName"
                                class="form-control rounded-3" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Image (Leave blank to keep current)</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*" />
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Subcategory Modal -->
    <div class="modal fade" id="editSubcategoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Subcategory</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editSubcategoryForm" onsubmit="submitApiForm(event, this.action, 'PUT')"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Parent Category</label>
                            <select name="category_id" id="editSubcategoryCategoryId" class="form-select rounded-3"
                                required>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subcategory Name</label>
                            <input type="text" name="name" id="editSubcategoryName"
                                class="form-control rounded-3" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subcategory Photo (Optional)</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*" />
                            <small class="text-muted">Leave blank to keep existing photo.</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Update Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editProductForm" onsubmit="submitApiForm(event, this.action, 'PUT')"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subcategory</label>
                            <select name="subcategory_id" id="editProductSubcategoryId" class="form-select rounded-3"
                                required>
                                @foreach ($subcategories as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}
                                        ({{ $s->category->name ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Name</label>
                            <input type="text" name="name" id="editProductName" class="form-control rounded-3"
                                required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Price (EGP)</label>
                            <input type="number" step="0.01" name="price" id="editProductPrice"
                                class="form-control rounded-3" required />
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-4">
                                <label class="form-label fw-bold">Calories</label>
                                <input type="number" name="calories" id="editProductCalories"
                                    class="form-control rounded-3" min="0" required />
                            </div>
                            <div class="col-4">
                                <label class="form-label fw-bold">Prep Time (min)</label>
                                <input type="number" name="prep_time" id="editProductPrepTime"
                                    class="form-control rounded-3" min="0" required />
                            </div>
                            <div class="col-4">
                                <label class="form-label fw-bold">Discount Amount (EGP)</label>
                                <input type="number" step="0.01" name="discount_price"
                                    id="editProductDiscountPrice" class="form-control rounded-3"
                                    placeholder="Optional" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" id="editProductDesc" class="form-control rounded-3" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Image (Leave blank to keep current)</label>
                            <input type="file" name="image" class="form-control rounded-3" accept="image/*" />
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch" style="font-size: 1.1rem;">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        name="is_featured" value="1" id="editProductFeatured"
                                        style="cursor: pointer;">
                                    <label class="form-check-label fw-bold ms-2" for="editProductFeatured"
                                        style="cursor: pointer;">Feature as Hot</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check form-switch" style="font-size: 1.1rem;">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        name="is_bestseller" value="1" id="editProductBestseller"
                                        style="cursor: pointer;">
                                    <label class="form-check-label fw-bold ms-2" for="editProductBestseller"
                                        style="cursor: pointer;">Category Bestseller</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Stock Modal -->
    <div class="modal fade" id="editStockModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fas fa-boxes text-primary me-2"></i>Update Product Stock
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editStockForm" onsubmit="submitStockForm(event)">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Product Name</label>
                            <input type="text" id="stockProductName" class="form-control rounded-3 bg-light"
                                readonly />
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">New Stock Quantity (Units)</label>
                            <input type="number" name="stock" id="stockProductQuantity"
                                class="form-control rounded-3" min="0" required
                                placeholder="Enter new stock quantity..." />
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100"><i class="fas fa-save me-1"></i>Update
                            Stock Quantity</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Create Addon Modal -->
    <div class="modal fade" id="createAddonModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fas fa-cookie-bite text-primary me-2"></i>Add New Add-On
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form onsubmit="submitApiForm(event, '/admin/add-ons', 'POST')">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Add-On Name</label>
                                <input type="text" name="name" class="form-control rounded-3" required
                                    placeholder="e.g. Extra Espresso Shot" />
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Price Adjustment (EGP)</label>
                                <input type="number" step="0.01" name="price_adjustment"
                                    class="form-control rounded-3" required placeholder="1.00" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Applicability / Scope</label>
                            <select name="scope" id="createAddonScope" class="form-select rounded-3"
                                onchange="toggleAddonScopeFields('createAddonScope', 'createAddonCategoryDiv', 'createAddonSubcategoryDiv', 'createAddonProductDiv')">
                                <option value="global" selected>Global (Applies to all products)</option>
                                <option value="category">Category Specific</option>
                                <option value="subcategory">Subcategory Specific</option>
                                <option value="product">Product Specific</option>
                            </select>
                        </div>
                        <!-- Multi Select Container: Categories -->
                        <div class="mb-3 d-none" id="createAddonCategoryDiv">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Select Target Categories <span
                                        class="badge bg-secondary ms-1" id="createCatBadge">0 selected</span></label>
                                <div>
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 me-2"
                                        onclick="selectAllMulti('createAddonCategoryList', 'createCatBadge')">Select
                                        All</button>
                                    <button type="button"
                                        class="btn btn-link btn-sm text-muted text-decoration-none p-0"
                                        onclick="clearAllMulti('createAddonCategoryList', 'createCatBadge')">Clear</button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm rounded-3"
                                    placeholder="🔍 Search categories..."
                                    oninput="filterMultiSelect(this, 'createAddonCategoryList')">
                            </div>
                            <div class="multi-select-card-container border rounded-3 p-2 bg-light"
                                id="createAddonCategoryList" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($categories as $cat)
                                    <label
                                        class="multi-select-card-item d-flex align-items-center p-2 rounded-2 mb-1 cursor-pointer"
                                        style="background:#fff; border:1px solid #e6ded6; transition:all 0.2s;"
                                        data-search="{{ strtolower($cat->name) }}">
                                        <input type="checkbox" name="category_ids[]" value="{{ $cat->id }}"
                                            class="form-check-input me-2 multi-cb"
                                            onchange="updateMultiBadge('createAddonCategoryList', 'createCatBadge')">
                                        <span class="fw-semibold text-dark">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- Multi Select Container: Subcategories -->
                        <div class="mb-3 d-none" id="createAddonSubcategoryDiv">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Select Target Subcategories <span
                                        class="badge bg-secondary ms-1" id="createSubcatBadge">0
                                        selected</span></label>
                                <div>
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 me-2"
                                        onclick="selectAllMulti('createAddonSubcategoryList', 'createSubcatBadge')">Select
                                        All</button>
                                    <button type="button"
                                        class="btn btn-link btn-sm text-muted text-decoration-none p-0"
                                        onclick="clearAllMulti('createAddonSubcategoryList', 'createSubcatBadge')">Clear</button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm rounded-3"
                                    placeholder="🔍 Search subcategories..."
                                    oninput="filterMultiSelect(this, 'createAddonSubcategoryList')">
                            </div>
                            <div class="multi-select-card-container border rounded-3 p-2 bg-light"
                                id="createAddonSubcategoryList" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($subcategories as $subcat)
                                    <label
                                        class="multi-select-card-item d-flex align-items-center p-2 rounded-2 mb-1 cursor-pointer"
                                        style="background:#fff; border:1px solid #e6ded6; transition:all 0.2s;"
                                        data-search="{{ strtolower($subcat->name . ' ' . ($subcat->category->name ?? '')) }}">
                                        <input type="checkbox" name="subcategory_ids[]" value="{{ $subcat->id }}"
                                            class="form-check-input me-2 multi-cb"
                                            onchange="updateMultiBadge('createAddonSubcategoryList', 'createSubcatBadge')">
                                        <span class="fw-semibold text-dark">{{ $subcat->name }} <small
                                                class="text-muted">({{ $subcat->category->name ?? '' }})</small></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- Multi Select Container: Products -->
                        <div class="mb-3 d-none" id="createAddonProductDiv">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Select Target Products <span
                                        class="badge bg-secondary ms-1" id="createProdBadge">0 selected</span></label>
                                <div>
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 me-2"
                                        onclick="selectAllMulti('createAddonProductList', 'createProdBadge')">Select
                                        All</button>
                                    <button type="button"
                                        class="btn btn-link btn-sm text-muted text-decoration-none p-0"
                                        onclick="clearAllMulti('createAddonProductList', 'createProdBadge')">Clear</button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm rounded-3"
                                    placeholder="🔍 Search products..."
                                    oninput="filterMultiSelect(this, 'createAddonProductList')">
                            </div>
                            <div class="multi-select-card-container border rounded-3 p-2 bg-light"
                                id="createAddonProductList" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($products as $prod)
                                    <label
                                        class="multi-select-card-item d-flex align-items-center p-2 rounded-2 mb-1 cursor-pointer"
                                        style="background:#fff; border:1px solid #e6ded6; transition:all 0.2s;"
                                        data-search="{{ strtolower($prod->name) }}">
                                        <input type="checkbox" name="product_ids[]" value="{{ $prod->id }}"
                                            class="form-check-input me-2 multi-cb"
                                            onchange="updateMultiBadge('createAddonProductList', 'createProdBadge')">
                                        <span class="fw-semibold text-dark">{{ $prod->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Save Add-On</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Delivery Zone Modal -->
    <div class="modal fade" id="createDeliveryZoneModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Add Delivery Zone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form onsubmit="submitApiForm(event, '/admin/delivery-zones', 'POST')">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Zone Name</label>
                            <input type="text" name="name" class="form-control rounded-3" required
                                placeholder="e.g. Nasr City & Fifth Settlement" />
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-bold">Delivery Fee (EGP)</label>
                                <input type="number" step="0.01" name="delivery_fee"
                                    class="form-control rounded-3" required placeholder="3.00" />
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Min Order (EGP)</label>
                                <input type="number" step="0.01" name="minimum_order_value"
                                    class="form-control rounded-3" placeholder="15.00" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Estimated Time</label>
                            <input type="text" name="estimated_time" class="form-control rounded-3"
                                placeholder="20-30 mins" />
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Save Delivery Zone</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Addon Modal -->
    <div class="modal fade" id="editAddonModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fas fa-edit text-primary me-2"></i>Edit Add-On</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editAddonForm" onsubmit="submitApiForm(event, this.action, 'PUT')">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Add-On Name</label>
                                <input type="text" name="name" id="editAddonName"
                                    class="form-control rounded-3" required />
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Price Adjustment (EGP)</label>
                                <input type="number" step="0.01" name="price_adjustment" id="editAddonPrice"
                                    class="form-control rounded-3" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Applicability / Scope</label>
                            <select name="scope" id="editAddonScope" class="form-select rounded-3"
                                onchange="toggleAddonScopeFields('editAddonScope', 'editAddonCategoryDiv', 'editAddonSubcategoryDiv', 'editAddonProductDiv')">
                                <option value="global">Global (Applies to all products)</option>
                                <option value="category">Category Specific</option>
                                <option value="subcategory">Subcategory Specific</option>
                                <option value="product">Product Specific</option>
                            </select>
                        </div>
                        <!-- Multi Select Container: Categories -->
                        <div class="mb-3 d-none" id="editAddonCategoryDiv">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Select Target Categories <span
                                        class="badge bg-secondary ms-1" id="editCatBadge">0 selected</span></label>
                                <div>
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 me-2"
                                        onclick="selectAllMulti('editAddonCategoryList', 'editCatBadge')">Select
                                        All</button>
                                    <button type="button"
                                        class="btn btn-link btn-sm text-muted text-decoration-none p-0"
                                        onclick="clearAllMulti('editAddonCategoryList', 'editCatBadge')">Clear</button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm rounded-3"
                                    placeholder="🔍 Search categories..."
                                    oninput="filterMultiSelect(this, 'editAddonCategoryList')">
                            </div>
                            <div class="multi-select-card-container border rounded-3 p-2 bg-light"
                                id="editAddonCategoryList" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($categories as $cat)
                                    <label
                                        class="multi-select-card-item d-flex align-items-center p-2 rounded-2 mb-1 cursor-pointer"
                                        style="background:#fff; border:1px solid #e6ded6; transition:all 0.2s;"
                                        data-search="{{ strtolower($cat->name) }}">
                                        <input type="checkbox" name="category_ids[]" value="{{ $cat->id }}"
                                            id="edit_cat_{{ $cat->id }}"
                                            class="form-check-input me-2 multi-cb"
                                            onchange="updateMultiBadge('editAddonCategoryList', 'editCatBadge')">
                                        <span class="fw-semibold text-dark">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- Multi Select Container: Subcategories -->
                        <div class="mb-3 d-none" id="editAddonSubcategoryDiv">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Select Target Subcategories <span
                                        class="badge bg-secondary ms-1" id="editSubcatBadge">0
                                        selected</span></label>
                                <div>
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 me-2"
                                        onclick="selectAllMulti('editAddonSubcategoryList', 'editSubcatBadge')">Select
                                        All</button>
                                    <button type="button"
                                        class="btn btn-link btn-sm text-muted text-decoration-none p-0"
                                        onclick="clearAllMulti('editAddonSubcategoryList', 'editSubcatBadge')">Clear</button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm rounded-3"
                                    placeholder="🔍 Search subcategories..."
                                    oninput="filterMultiSelect(this, 'editAddonSubcategoryList')">
                            </div>
                            <div class="multi-select-card-container border rounded-3 p-2 bg-light"
                                id="editAddonSubcategoryList" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($subcategories as $subcat)
                                    <label
                                        class="multi-select-card-item d-flex align-items-center p-2 rounded-2 mb-1 cursor-pointer"
                                        style="background:#fff; border:1px solid #e6ded6; transition:all 0.2s;"
                                        data-search="{{ strtolower($subcat->name . ' ' . ($subcat->category->name ?? '')) }}">
                                        <input type="checkbox" name="subcategory_ids[]"
                                            value="{{ $subcat->id }}" id="edit_subcat_{{ $subcat->id }}"
                                            class="form-check-input me-2 multi-cb"
                                            onchange="updateMultiBadge('editAddonSubcategoryList', 'editSubcatBadge')">
                                        <span class="fw-semibold text-dark">{{ $subcat->name }} <small
                                                class="text-muted">({{ $subcat->category->name ?? '' }})</small></span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- Multi Select Container: Products -->
                        <div class="mb-3 d-none" id="editAddonProductDiv">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="form-label fw-bold mb-0">Select Target Products <span
                                        class="badge bg-secondary ms-1" id="editProdBadge">0 selected</span></label>
                                <div>
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0 me-2"
                                        onclick="selectAllMulti('editAddonProductList', 'editProdBadge')">Select
                                        All</button>
                                    <button type="button"
                                        class="btn btn-link btn-sm text-muted text-decoration-none p-0"
                                        onclick="clearAllMulti('editAddonProductList', 'editProdBadge')">Clear</button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control form-control-sm rounded-3"
                                    placeholder="🔍 Search products..."
                                    oninput="filterMultiSelect(this, 'editAddonProductList')">
                            </div>
                            <div class="multi-select-card-container border rounded-3 p-2 bg-light"
                                id="editAddonProductList" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($products as $prod)
                                    <label
                                        class="multi-select-card-item d-flex align-items-center p-2 rounded-2 mb-1 cursor-pointer"
                                        style="background:#fff; border:1px solid #e6ded6; transition:all 0.2s;"
                                        data-search="{{ strtolower($prod->name) }}">
                                        <input type="checkbox" name="product_ids[]" value="{{ $prod->id }}"
                                            id="edit_prod_{{ $prod->id }}"
                                            class="form-check-input me-2 multi-cb"
                                            onchange="updateMultiBadge('editAddonProductList', 'editProdBadge')">
                                        <span class="fw-semibold text-dark">{{ $prod->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Update Add-On</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Delivery Zone Modal -->
    <div class="modal fade" id="editDeliveryZoneModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Delivery Zone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editDeliveryZoneForm" onsubmit="submitApiForm(event, this.action, 'PUT')">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Zone Name</label>
                            <input type="text" name="name" id="editDeliveryZoneName"
                                class="form-control rounded-3" required />
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-bold">Delivery Fee (EGP)</label>
                                <input type="number" step="0.01" name="delivery_fee"
                                    id="editDeliveryZoneFee" class="form-control rounded-3" required />
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold">Min Order (EGP)</label>
                                <input type="number" step="0.01" name="minimum_order_value"
                                    id="editDeliveryZoneMinOrder" class="form-control rounded-3" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Estimated Time</label>
                            <input type="text" name="estimated_time" id="editDeliveryZoneTime"
                                class="form-control rounded-3" />
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Update Delivery Zone</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Store Location Modal -->
    <div class="modal fade" id="createStoreLocationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fas fa-map-marked-alt text-primary me-2"></i>Add Store
                        Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form onsubmit="submitApiForm(event, '/admin/store-locations', 'POST')">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Branch / Outlet Name</label>
                                <input type="text" name="name" class="form-control rounded-3" required
                                    placeholder="e.g. Nasr City Branch" />
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Store Status</label>
                                <select name="status" class="form-select rounded-3" required>
                                    <option value="open" selected>🟢 Open</option>
                                    <option value="closed">🔴 Closed</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Full Address</label>
                                <input type="text" name="address" class="form-control rounded-3" required
                                    placeholder="e.g. Abbas El Akkad St, Nasr City, Cairo" />
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Badge / Tag (Optional)</label>
                                <input type="text" name="badge" class="form-control rounded-3"
                                    placeholder="e.g. Flagship Store, Co-Working Friendly" />
                            </div>
                        </div>

                        <!-- Professional Time Picker Component -->
                        <div class="card p-3 border-0 bg-light rounded-3 mb-3">
                            <label class="form-label fw-bold text-dark mb-2"><i
                                    class="fas fa-clock text-primary me-1"></i>Working Hours Picker</label>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Days Schedule</label>
                                    <select name="days_label" class="form-select form-select-sm rounded-3">
                                        <option value="Daily" selected>Daily</option>
                                        <option value="Mon - Fri">Mon - Fri</option>
                                        <option value="Sat - Sun">Sat - Sun</option>
                                        <option value="Weekdays">Weekdays</option>
                                        <option value="Weekends">Weekends</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Opening Time</label>
                                    <input type="time" name="opening_time"
                                        class="form-control form-control-sm rounded-3" required value="07:00" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Closing Time</label>
                                    <input type="time" name="closing_time"
                                        class="form-control form-control-sm rounded-3" required value="23:30" />
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone / Extension</label>
                                <input type="text" name="phone" class="form-control rounded-3" required
                                    placeholder="+20 19696 (Ext. 1)" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Google Maps Directions Link <span
                                        class="text-danger">*</span></label>
                                <input type="url" name="google_maps_url" class="form-control rounded-3"
                                    required placeholder="https://maps.google.com/?q=..." />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Save Location</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Store Location Modal -->
    <div class="modal fade" id="editStoreLocationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fas fa-edit text-primary me-2"></i>Edit Store Location
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editStoreLocationForm" onsubmit="submitApiForm(event, this.action, 'PUT')">
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Branch / Outlet Name</label>
                                <input type="text" name="name" id="editLocName"
                                    class="form-control rounded-3" required />
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Store Status</label>
                                <select name="status" id="editLocStatus" class="form-select rounded-3" required>
                                    <option value="open">🟢 Open</option>
                                    <option value="closed">🔴 Closed</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-7">
                                <label class="form-label fw-bold">Full Address</label>
                                <input type="text" name="address" id="editLocAddress"
                                    class="form-control rounded-3" required />
                            </div>
                            <div class="col-md-5">
                                <label class="form-label fw-bold">Badge / Tag (Optional)</label>
                                <input type="text" name="badge" id="editLocBadge"
                                    class="form-control rounded-3" />
                            </div>
                        </div>

                        <!-- Professional Time Picker Component -->
                        <div class="card p-3 border-0 bg-light rounded-3 mb-3">
                            <label class="form-label fw-bold text-dark mb-2"><i
                                    class="fas fa-clock text-primary me-1"></i>Working Hours Picker</label>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Days Schedule</label>
                                    <select name="days_label" id="editLocDaysLabel"
                                        class="form-select form-select-sm rounded-3">
                                        <option value="Daily">Daily</option>
                                        <option value="Mon - Fri">Mon - Fri</option>
                                        <option value="Sat - Sun">Sat - Sun</option>
                                        <option value="Weekdays">Weekdays</option>
                                        <option value="Weekends">Weekends</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Opening Time</label>
                                    <input type="time" name="opening_time" id="editLocOpeningTime"
                                        class="form-control form-control-sm rounded-3" required />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted mb-1">Closing Time</label>
                                    <input type="time" name="closing_time" id="editLocClosingTime"
                                        class="form-control form-control-sm rounded-3" required />
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone / Extension</label>
                                <input type="text" name="phone" id="editLocPhone"
                                    class="form-control rounded-3" required />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Google Maps Directions Link <span
                                        class="text-danger">*</span></label>
                                <input type="url" name="google_maps_url" id="editLocMapsUrl"
                                    class="form-control rounded-3" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn-primary-snug w-100">Update Location</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/sweetalert2.all.min.js') }}"></script>
    <script>
        function switchTab(tabId, btn) {
            document.querySelectorAll('.tab-content-panel').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.admin-nav-item').forEach(el => el.classList.remove('active'));

            const panel = document.getElementById('tab-' + tabId);
            if (panel) panel.classList.add('active');

            if (!btn) {
                btn = document.querySelector(`.admin-nav-item[onclick*="'${tabId}'"]`);
            }
            if (btn) btn.classList.add('active');

            const titles = {
                overview: 'Dashboard Overview',
                products: 'Products Management',
                categories: 'Categories Management',
                subcategories: 'Subcategories Management',
                addons: 'Add-Ons Management',
                'store-locations': 'Store Locations Management',
                delivery: 'Delivery Zones Management',
                orders: 'Orders Management'
            };
            document.getElementById('pageTitle').textContent = titles[tabId] || 'Admin Dashboard';

            localStorage.setItem('activeAdminTab', tabId);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedTab = localStorage.getItem('activeAdminTab');
            if (savedTab) {
                switchTab(savedTab, null);
            }
        });

        function closeAllModals() {
            document.querySelectorAll('.modal.show').forEach(m => {
                const modal = bootstrap.Modal.getInstance(m);
                if (modal) modal.hide();
            });
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                document.body.classList.remove('modal-open');
                document.body.style = '';
            }, 300);
        }

        async function reloadPageContent() {
            try {
                const res = await fetch(window.location.href);
                const html = await res.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                document.querySelectorAll('.tab-content-panel').forEach(panel => {
                    const newPanel = doc.getElementById(panel.id);
                    if (newPanel) {
                        panel.innerHTML = newPanel.innerHTML;
                    }
                });

                // Update the header to refresh notification bells
                const oldHeader = document.querySelector('.admin-header');
                const newHeader = doc.querySelector('.admin-header');
                if (oldHeader && newHeader) {
                    oldHeader.innerHTML = newHeader.innerHTML;
                }
            } catch (e) {
                console.error(e);
            }
        }

        async function submitApiForm(e, url, method) {
            e.preventDefault();
            const formData = new FormData(e.target);

            // In Laravel, PUT requests with files must use POST with _method=PUT
            if (method.toUpperCase() === 'PUT') {
                formData.append('_method', 'PUT');
                method = 'POST';
            }

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                if (res.ok) {
                    closeAllModals();
                    reloadPageContent();

                    Swal.fire({
                        title: 'Success!',
                        text: 'Action completed successfully!',
                        icon: 'success',
                        confirmButtonColor: '#9C7A5B',
                        timer: 1500
                    });
                } else {
                    const err = await res.json();
                    Swal.fire({
                        title: 'Error!',
                        text: err.message || JSON.stringify(err.errors) || 'Validation error',
                        icon: 'error',
                        confirmButtonColor: '#9C7A5B'
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Server error.',
                    icon: 'error',
                    confirmButtonColor: '#9C7A5B'
                });
            }
        }

        function openEditCategoryModal(cat) {
            document.getElementById('editCategoryName').value = cat.name;
            document.getElementById('editCategoryForm').action = '/admin/categories/' + cat.id;
            new bootstrap.Modal(document.getElementById('editCategoryModal')).show();
        }

        function openEditSubcategoryModal(sub) {
            document.getElementById('editSubcategoryName').value = sub.name;
            document.getElementById('editSubcategoryCategoryId').value = sub.category_id;
            document.getElementById('editSubcategoryForm').action = '/admin/subcategories/' + sub.id;
            new bootstrap.Modal(document.getElementById('editSubcategoryModal')).show();
        }

        let activeStockProductId = null;

        function openStockModal(prod) {
            activeStockProductId = prod.id;
            document.getElementById('stockProductName').value = prod.name;
            document.getElementById('stockProductQuantity').value = prod.stock;
            new bootstrap.Modal(document.getElementById('editStockModal')).show();
        }

        async function submitStockForm(e) {
            e.preventDefault();
            if (!activeStockProductId) return;

            const stockVal = document.getElementById('stockProductQuantity').value;
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('stock', stockVal);

            try {
                const res = await fetch('/admin/products/' + activeStockProductId, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                if (res.ok) {
                    closeAllModals();
                    await reloadPageContent();
                    Swal.fire({
                        title: 'Stock Updated!',
                        text: 'Product stock quantity updated successfully.',
                        icon: 'success',
                        confirmButtonColor: '#9C7A5B',
                        timer: 2000
                    });
                } else {
                    const err = await res.json();
                    Swal.fire({
                        title: 'Error!',
                        text: err.message || 'Failed to update stock quantity.',
                        icon: 'error',
                        confirmButtonColor: '#9C7A5B'
                    });
                }
            } catch (err) {
                console.error(err);
                Swal.fire({
                    title: 'Server Error!',
                    text: 'An error occurred while updating stock.',
                    icon: 'error',
                    confirmButtonColor: '#9C7A5B'
                });
            }
        }

        function openEditProductModal(prod) {
            document.getElementById('editProductName').value = prod.name;
            document.getElementById('editProductSubcategoryId').value = prod.subcategory_id;
            document.getElementById('editProductPrice').value = prod.price;
            document.getElementById('editProductDesc').value = prod.description || '';
            document.getElementById('editProductCalories').value = prod.calories !== null ? prod.calories : 180;
            document.getElementById('editProductPrepTime').value = prod.prep_time !== null ? prod.prep_time : 5;
            document.getElementById('editProductDiscountPrice').value = prod.discount_price || '';
            document.getElementById('editProductFeatured').checked = prod.is_featured;
            document.getElementById('editProductBestseller').checked = prod.is_bestseller;
            document.getElementById('editProductForm').action = '/admin/products/' + prod.id;
            new bootstrap.Modal(document.getElementById('editProductModal')).show();
        }

        function filterAddonTable(input) {
            const term = input.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tab-addons tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (!term || text.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filterProductTable(input) {
            const term = input.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tab-products tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = (!term || text.includes(term)) ? '' : 'none';
            });
        }

        function filterCategoryTable(input) {
            const term = input.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tab-categories tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = (!term || text.includes(term)) ? '' : 'none';
            });
        }

        function filterSubcategoryTable(input) {
            const term = input.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tab-subcategories tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = (!term || text.includes(term)) ? '' : 'none';
            });
        }

        function filterDeliveryZoneTable(input) {
            const term = input.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tab-delivery tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = (!term || text.includes(term)) ? '' : 'none';
            });
        }

        function filterOrderTable(input) {
            const term = input.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tab-orders tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = (!term || text.includes(term)) ? '' : 'none';
            });
        }

        function filterMultiSelect(input, containerId) {
            const term = input.value.toLowerCase().trim();
            const container = document.getElementById(containerId);
            if (!container) return;
            const items = container.querySelectorAll('.multi-select-card-item');
            items.forEach(item => {
                const text = item.getAttribute('data-search') || '';
                if (!term || text.includes(term)) {
                    item.classList.remove('d-none');
                } else {
                    item.classList.add('d-none');
                }
            });
        }

        function selectAllMulti(containerId, badgeId) {
            const container = document.getElementById(containerId);
            if (!container) return;
            const cbs = container.querySelectorAll('.multi-cb');
            cbs.forEach(cb => {
                const parent = cb.closest('.multi-select-card-item');
                if (!parent || !parent.classList.contains('d-none')) {
                    cb.checked = true;
                }
            });
            updateMultiBadge(containerId, badgeId);
        }

        function clearAllMulti(containerId, badgeId) {
            const container = document.getElementById(containerId);
            if (!container) return;
            const cbs = container.querySelectorAll('.multi-cb');
            cbs.forEach(cb => cb.checked = false);
            updateMultiBadge(containerId, badgeId);
        }

        function updateMultiBadge(containerId, badgeId) {
            const container = document.getElementById(containerId);
            const badge = document.getElementById(badgeId);
            if (!container || !badge) return;
            const count = container.querySelectorAll('.multi-cb:checked').length;
            badge.textContent = count + ' selected';
            if (count > 0) {
                badge.classList.remove('bg-secondary');
                badge.classList.add('bg-primary');
            } else {
                badge.classList.remove('bg-primary');
                badge.classList.add('bg-secondary');
            }
        }

        function toggleAddonScopeFields(scopeSelectId, catDivId, subcatDivId, prodDivId) {
            const scope = document.getElementById(scopeSelectId).value;
            const catDiv = document.getElementById(catDivId);
            const subcatDiv = document.getElementById(subcatDivId);
            const prodDiv = document.getElementById(prodDivId);

            catDiv.classList.add('d-none');
            subcatDiv.classList.add('d-none');
            prodDiv.classList.add('d-none');

            if (scope === 'category') {
                catDiv.classList.remove('d-none');
            } else if (scope === 'subcategory') {
                subcatDiv.classList.remove('d-none');
            } else if (scope === 'product') {
                prodDiv.classList.remove('d-none');
            }
        }

        function openEditAddonModal(addon) {
            document.getElementById('editAddonName').value = addon.name;
            document.getElementById('editAddonPrice').value = addon.price_adjustment;
            const scope = addon.scope || 'global';
            document.getElementById('editAddonScope').value = scope;

            // Clear checkboxes
            clearAllMulti('editAddonCategoryList', 'editCatBadge');
            clearAllMulti('editAddonSubcategoryList', 'editSubcatBadge');
            clearAllMulti('editAddonProductList', 'editProdBadge');

            // Populate category IDs
            let catIds = [];
            if (addon.categories && addon.categories.length > 0) {
                catIds = addon.categories.map(c => c.id);
            } else if (addon.category_id) {
                catIds = [addon.category_id];
            }
            catIds.forEach(id => {
                const cb = document.getElementById('edit_cat_' + id);
                if (cb) cb.checked = true;
            });
            updateMultiBadge('editAddonCategoryList', 'editCatBadge');

            // Populate subcategory IDs
            let subcatIds = [];
            if (addon.subcategories && addon.subcategories.length > 0) {
                subcatIds = addon.subcategories.map(s => s.id);
            } else if (addon.subcategory_id) {
                subcatIds = [addon.subcategory_id];
            }
            subcatIds.forEach(id => {
                const cb = document.getElementById('edit_subcat_' + id);
                if (cb) cb.checked = true;
            });
            updateMultiBadge('editAddonSubcategoryList', 'editSubcatBadge');

            // Populate product IDs
            let prodIds = [];
            if (addon.products && addon.products.length > 0) {
                prodIds = addon.products.map(p => p.id);
            } else if (addon.product_id) {
                prodIds = [addon.product_id];
            }
            prodIds.forEach(id => {
                const cb = document.getElementById('edit_prod_' + id);
                if (cb) cb.checked = true;
            });
            updateMultiBadge('editAddonProductList', 'editProdBadge');

            toggleAddonScopeFields('editAddonScope', 'editAddonCategoryDiv', 'editAddonSubcategoryDiv',
                'editAddonProductDiv');

            document.getElementById('editAddonForm').action = '/admin/add-ons/' + addon.id;
            new bootstrap.Modal(document.getElementById('editAddonModal')).show();
        }

        function openEditDeliveryModal(zone) {
            document.getElementById('editDeliveryZoneName').value = zone.name;
            document.getElementById('editDeliveryZoneFee').value = zone.delivery_fee;
            document.getElementById('editDeliveryZoneMinOrder').value = zone.minimum_order_value || '';
            document.getElementById('editDeliveryZoneTime').value = zone.estimated_time || '';
            document.getElementById('editDeliveryZoneForm').action = '/admin/delivery-zones/' + zone.id;
            new bootstrap.Modal(document.getElementById('editDeliveryZoneModal')).show();
        }

        function filterStoreLocationTable(input) {
            const term = input.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#tab-store-locations tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (!term || text.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function openEditStoreLocationModal(loc) {
            document.getElementById('editLocName').value = loc.name;
            document.getElementById('editLocStatus').value = loc.status || 'open';
            document.getElementById('editLocAddress').value = loc.address;
            document.getElementById('editLocBadge').value = loc.badge || '';
            document.getElementById('editLocDaysLabel').value = loc.days_label || 'Daily';
            document.getElementById('editLocOpeningTime').value = loc.opening_time || '07:00';
            document.getElementById('editLocClosingTime').value = loc.closing_time || '23:30';
            document.getElementById('editLocPhone').value = loc.phone;
            document.getElementById('editLocMapsUrl').value = loc.google_maps_url || '';
            document.getElementById('editStoreLocationForm').action = '/admin/store-locations/' + loc.id;
            new bootstrap.Modal(document.getElementById('editStoreLocationModal')).show();
        }


        async function updateOrderStatus(orderId, status) {
            try {
                const res = await fetch('/admin/orders/' + orderId + '/status', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        status: status
                    })
                });

                if (res.ok) {
                    await reloadPageContent();
                    Swal.fire({
                        title: 'Updated!',
                        text: 'Order #' + orderId.substring(0, 8) + ' status updated to ' + status,
                        icon: 'success',
                        confirmButtonColor: '#9C7A5B'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to update status.',
                        icon: 'error',
                        confirmButtonColor: '#9C7A5B'
                    });
                }
            } catch (e) {
                console.error(e);
            }
        }

        // Auto-refresh stats & data every 10 seconds without page refresh
        setInterval(() => {
            if (!document.querySelector('.modal.show')) {
                reloadPageContent();
            }
        }, 10000);

        function deleteItem(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#9C7A5B',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const res = await fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        });
                        if (res.ok) {
                            reloadPageContent();
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Item has been deleted.',
                                icon: 'success',
                                confirmButtonColor: '#9C7A5B',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to delete item.',
                                icon: 'error',
                                confirmButtonColor: '#9C7A5B'
                            });
                        }
                    } catch (e) {
                        console.error(e);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Server error.',
                            icon: 'error',
                            confirmButtonColor: '#9C7A5B'
                        });
                    }
                }
            });
        }
    </script>
</body>

</html>
