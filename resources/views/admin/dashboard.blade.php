<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Admin Dashboard — Sip & Snug Cafe</title>
   
   <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
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
         box-shadow: 4px 0 20px rgba(0,0,0,0.15);
      }

      .admin-brand {
         padding: 24px 20px;
         display: flex;
         align-items: center;
         gap: 12px;
         border-bottom: 1px solid rgba(255,255,255,0.08);
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

      .admin-nav-item:hover, .admin-nav-item.active {
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
         border-top: 1px solid rgba(255,255,255,0.08);
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
         box-shadow: 0 4px 15px rgba(0,0,0,0.03);
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

      .stat-icon.brown { background: rgba(122, 75, 46, 0.12); color: var(--primary); }
      .stat-icon.gold { background: rgba(216, 169, 107, 0.18); color: #b88339; }
      .stat-icon.green { background: rgba(19, 115, 51, 0.12); color: var(--accent-green); }
      .stat-icon.red { background: rgba(217, 48, 37, 0.12); color: var(--accent-red); }

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
         box-shadow: 0 4px 15px rgba(0,0,0,0.03);
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

      .badge-pending { background: #fef7e0; color: #b06000; }
      .badge-confirmed { background: #e8f0fe; color: #1a73e8; }
      .badge-preparing { background: #fce8e6; color: #c5221f; }
      .badge-delivered { background: #e6f4ea; color: #137333; }
      .badge-cancelled { background: #f1f3f4; color: #5f6368; }

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
              box-shadow: 0 4px 15px rgba(0,0,0,0.06) !important;
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
              box-shadow: 0 10px 30px rgba(0,0,0,0.12) !important;
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
         .table-custom th, .table-custom td {
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.03) !important;
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
   <div class="admin-sidebar-backdrop" onclick="document.querySelector('.admin-sidebar').classList.remove('active'); this.classList.remove('active');"></div>

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
         <button class="btn btn-sm text-white d-lg-none" onclick="document.querySelector('.admin-sidebar').classList.remove('active'); document.querySelector('.admin-sidebar-backdrop').classList.remove('active');"><i class="fas fa-times"></i></button>
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
            <div style="width:36px;height:36px;border-radius:50%;background:var(--secondary);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">
               {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <div>
               <div style="font-size:0.85rem;font-weight:600;">{{ auth()->user()->name ?? 'Admin' }}</div>
               <div style="font-size:0.72rem;color:var(--secondary);">Administrator</div>
            </div>
         </div>
         <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link p-0 text-danger" title="Logout"><i class="fas fa-sign-out-alt fs-5"></i></button>
         </form>
      </div>
   </aside>

   <!-- MAIN CONTENT AREA -->
   <main class="admin-main">
      <!-- Top Header -->
      <div class="admin-header">
         <div class="d-flex align-items-center gap-3">
             <button class="mobile-toggle d-lg-none" onclick="document.querySelector('.admin-sidebar').classList.add('active'); document.querySelector('.admin-sidebar-backdrop').classList.add('active');">
               <i class="fas fa-bars"></i>
            </button>
            <div>
               <h2 class="admin-title" id="pageTitle">Dashboard Overview</h2>
               <p class="text-muted m-0 d-none d-md-block" style="font-size:0.88rem;">Manage drinks, stock, categories, add-ons and orders.</p>
            </div>
         </div>
         <div class="d-flex gap-3 align-items-center header-actions">
            @if(isset($lowStockCount) && $lowStockCount > 0)
            <div class="dropdown">
               <button class="btn btn-light position-relative border-0 rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" style="width:45px;height:45px;background:#fff;">
                  <i class="fas fa-bell text-danger fs-5"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                     {{ $lowStockCount }}
                  </span>
               </button>
               <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-0" style="max-height: 400px; overflow-y: auto;">
                  <li class="p-3 border-bottom bg-light d-flex align-items-center justify-content-between">
                     <h6 class="m-0 text-danger fw-bold" style="font-size:0.88rem;"><i class="fas fa-exclamation-circle me-2"></i>Low Stock Alerts</h6>
                     <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size:0.72rem;">{{ $lowStockCount }} items</span>
                  </li>
                  @foreach($lowStockProducts as $prod)
                     <li>
                        <a class="dropdown-item py-2 px-3 border-bottom text-wrap" href="#" onclick="switchTab('products', document.querySelectorAll('.admin-nav-item')[1])">
                           <div class="d-flex justify-content-between align-items-center mb-1">
                              <strong class="text-dark" style="font-size:0.86rem;">{{ $prod->name }}</strong>
                              <span class="badge bg-danger text-white rounded-pill px-2 py-1 ms-2" style="font-size:0.7rem;">
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
             <a href="{{ route('home') }}" class="btn-primary-snug" title="View Live Store"><i class="fas fa-store"></i><span class="d-none d-sm-inline ms-1">View Live Store</span></a>
         </div>
      </div>

      <!-- Flash Alert -->
      @if(session('success'))
         <div class="alert alert-success alert-dismissible fade show border-0 rounded-4 shadow-sm mb-4" role="alert">
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
                     <h5 class="panel-title"><i class="fas fa-fire text-warning me-2"></i>Best Selling Products</h5>
                     <span class="badge bg-light text-dark rounded-pill">Top Picks</span>
                  </div>
                  <div class="d-flex flex-column gap-3">
                     @forelse($bestSellingProducts as $item)
                        <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background:var(--light);">
                           <div class="d-flex align-items-center gap-3">
                              <img src="{{ $item->image ? asset($item->image) : asset('front/photos/coffee/hot latte.jpg') }}" class="img-thumb" alt="" />
                              <div>
                                 <strong style="font-size:0.9rem;display:block;">{{ $item->name }}</strong>
                                 <small class="text-muted">EGP {{ number_format($item->price, 2) }}</small>
                              </div>
                           </div>
                           <span class="badge bg-success rounded-pill px-3 py-2"><i class="fas fa-star me-1"></i> Featured</span>
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
                     <h5 class="panel-title"><i class="fas fa-heart text-danger me-2"></i>High Rated Favorites</h5>
                     <span class="badge bg-light text-dark rounded-pill">Customer Favorites</span>
                  </div>
                  <div class="d-flex flex-column gap-3">
                     @forelse($highRatedProducts as $item)
                        <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background:var(--light);">
                           <div class="d-flex align-items-center gap-3">
                              <img src="{{ $item->image ? asset($item->image) : asset('front/photos/matcha/iced matcha .jpg') }}" class="img-thumb" alt="" />
                              <div>
                                 <strong style="font-size:0.9rem;display:block;">{{ $item->name }}</strong>
                                 <small class="text-muted">{{ $item->subcategory->name ?? 'Drinks' }}</small>
                              </div>
                           </div>
                           <span class="fw-bold" style="color:var(--primary);">EGP {{ number_format($item->price, 2) }}</span>
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
               <h5 class="panel-title"><i class="fas fa-boxes text-primary me-2"></i>Stock Availability & Inventory</h5>
               <button class="btn btn-sm btn-outline-secondary rounded-pill" onclick="switchTab('products')">Manage Products</button>
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
                  @foreach($products->take(8) as $prod)
                     <tr>
                        <td>
                           <div class="d-flex align-items-center gap-2">
                              <img src="{{ $prod->image ? asset($prod->image) : asset('front/photos/coffee/esspresso.jpg') }}" class="img-thumb" style="width:36px;height:36px;" />
                              <strong>{{ $prod->name }}</strong>
                           </div>
                        </td>
                        <td>{{ $prod->subcategory->name ?? 'General' }}</td>
                        <td>EGP {{ number_format($prod->price, 2) }}</td>
                        <td><strong>{{ $prod->stock }}</strong> units</td>
                        <td>
                           @if($prod->stock > 10)
                              <span class="badge bg-success rounded-pill px-3 py-1">In Stock</span>
                           @elseif($prod->stock > 0)
                              <span class="badge bg-warning text-dark rounded-pill px-3 py-1">Low Stock</span>
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
            <div class="panel-head">
               <h5 class="panel-title"><i class="fas fa-coffee me-2"></i>Products Management</h5>
               <button class="btn-primary-snug" data-bs-toggle="modal" data-bs-target="#createProductModal"><i class="fas fa-plus"></i> Add New Product</button>
            </div>
            <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
               <table class="table-custom">
               <thead>
                  <tr>
                     <th>Image</th>
                     <th>Name</th>
                     <th>Subcategory</th>
                     <th>Price</th>
                     <th>Stock</th>
                     <th>Featured</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($products as $prod)
                     <tr @if($prod->stock <= 10) style="background-color: #fff5f5; box-shadow: inset 4px 0 0 red;" @endif>
                        <td>
                           <div class="d-flex align-items-center gap-2">
                              <img src="{{ $prod->image ? asset($prod->image) : asset('front/photos/coffee/hot latte.jpg') }}" class="img-thumb" style="width:36px;height:36px;border-radius:8px;object-fit:cover;" />
                              <strong>{{ $prod->name }}</strong>
                           </div>
                        </td>
                        <td data-label="Subcategory">{{ $prod->subcategory->name ?? '-' }}</td>
                        <td data-label="Price">EGP {{ number_format($prod->price, 2) }}</td>
                        <td data-label="Stock">
                           @if($prod->stock <= 10)
                               <span class="badge bg-danger px-2 py-1"><i class="fas fa-exclamation-triangle me-1"></i> {{ $prod->stock }} left</span>
                           @else
                               <span class="badge bg-light text-dark border px-2 py-1">
                                  {{ $prod->stock }} in stock
                               </span>
                           @endif
                        </td>
                        <td data-label="Featured">
                           @if($prod->is_featured)
                              <span class="badge bg-warning text-dark"><i class="fas fa-star"></i> Featured</span>
                           @else
                              <span class="text-muted">Standard</span>
                           @endif
                        </td>
                        <td>
                           <button class="btn-action" title="Edit" onclick="openEditProductModal({{ json_encode($prod) }})"><i class="fas fa-edit me-1"></i>Edit</button>
                           <button class="btn-action delete" title="Delete" onclick="deleteItem('/admin/products/{{ $prod->id }}')"><i class="fas fa-trash-alt me-1"></i>Delete</button>
                        </td>
                     </tr>
                  @empty
                     <tr><td colspan="6" class="text-center text-muted">No products created yet.</td></tr>
                  @endforelse
               </tbody>
            </table>
            </div>
         </div>
      </div>

      <!-- ================= 3. TAB: CATEGORIES ================= -->
      <div id="tab-categories" class="tab-content-panel">
         <div class="panel-card">
            <div class="panel-head">
               <h5 class="panel-title"><i class="fas fa-layer-group me-2"></i>Categories Management</h5>
               <button class="btn-primary-snug" data-bs-toggle="modal" data-bs-target="#createCategoryModal"><i class="fas fa-plus"></i> Add Category</button>
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
                              <img src="{{ $cat->image ? asset($cat->image) : asset('front/photos/coffee/hot latte.jpg') }}" class="img-thumb" style="width:36px;height:36px;border-radius:8px;object-fit:cover;" />
                              <strong>{{ $cat->name }}</strong>
                           </div>
                        </td>
                        <td data-label="Category ID">#{{ $cat->id }}</td>
                        <td data-label="Subcategories"><span class="badge bg-secondary rounded-pill">{{ $cat->subcategories_count }} subcategories</span></td>
                        <td data-label="Created At">{{ $cat->created_at->format('M d, Y') }}</td>
                        <td>
                           <button class="btn-action" title="Edit" onclick="openEditCategoryModal({{ json_encode($cat) }})"><i class="fas fa-edit me-1"></i>Edit</button>
                           <button class="btn-action delete" title="Delete" onclick="deleteItem('/admin/categories/{{ $cat->id }}')"><i class="fas fa-trash-alt me-1"></i>Delete</button>
                        </td>
                     </tr>
                  @empty
                     <tr><td colspan="5" class="text-center text-muted">No categories created yet.</td></tr>
                  @endforelse
               </tbody>
            </table>
            </div>
         </div>
      </div>

      <!-- ================= 4. TAB: SUBCATEGORIES ================= -->
      <div id="tab-subcategories" class="tab-content-panel">
         <div class="panel-card">
            <div class="panel-head">
               <h5 class="panel-title"><i class="fas fa-tags me-2"></i>Subcategories Management</h5>
               <button class="btn-primary-snug" data-bs-toggle="modal" data-bs-target="#createSubcategoryModal"><i class="fas fa-plus"></i> Add Subcategory</button>
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
                              <img src="{{ $sub->image ? asset($sub->image) : asset('front/photos/coffee/hot latte.jpg') }}" class="img-thumb" style="width:36px;height:36px;border-radius:8px;object-fit:cover;" />
                              <strong>{{ $sub->name }}</strong>
                           </div>
                        </td>
                        <td data-label="Subcategory ID">#{{ $sub->id }}</td>
                        <td data-label="Parent Category"><span class="badge bg-light text-dark border">{{ $sub->category->name ?? '-' }}</span></td>
                        <td data-label="Products Count">{{ $sub->products_count }} products</td>
                        <td>
                           <button class="btn-action" title="Edit" onclick="openEditSubcategoryModal({{ json_encode($sub) }})"><i class="fas fa-edit me-1"></i>Edit</button>
                           <button class="btn-action delete" title="Delete" onclick="deleteItem('/admin/subcategories/{{ $sub->id }}')"><i class="fas fa-trash-alt me-1"></i>Delete</button>
                        </td>
                     </tr>
                  @empty
                     <tr><td colspan="5" class="text-center text-muted">No subcategories created yet.</td></tr>
                  @endforelse
               </tbody>
            </table>
            </div>
         </div>
      </div>

      <!-- ================= 5. TAB: ADDONS ================= -->
      <div id="tab-addons" class="tab-content-panel">
         <div class="panel-card">
            <div class="panel-head">
               <h5 class="panel-title"><i class="fas fa-cookie-bite me-2"></i>Add-Ons Management</h5>
               <button class="btn-primary-snug" data-bs-toggle="modal" data-bs-target="#createAddonModal"><i class="fas fa-plus"></i> Add Add-On</button>
            </div>
            <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
               <table class="table-custom">
               <thead>
                  <tr>
                     <th>Add-On Name</th>
                     <th>ID</th>
                     <th>Price Adjustment</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($addOns as $addon)
                     <tr>
                        <td><strong>{{ $addon->name }}</strong></td>
                        <td data-label="Add-On ID">#{{ $addon->id }}</td>
                        <td data-label="Price Adjustment"><span class="fw-bold text-success">+EGP {{ number_format($addon->price_adjustment, 2) }}</span></td>
                        <td>
                           <button class="btn-action" title="Edit" onclick="openEditAddonModal({{ json_encode($addon) }})"><i class="fas fa-edit me-1"></i>Edit</button>
                           <button class="btn-action delete" title="Delete" onclick="deleteItem('/admin/add-ons/{{ $addon->id }}')"><i class="fas fa-trash-alt me-1"></i>Delete</button>
                        </td>
                     </tr>
                  @empty
                     <tr><td colspan="4" class="text-center text-muted">No add-ons created yet.</td></tr>
                  @endforelse
               </tbody>
            </table>
            </div>
         </div>
      </div>

      <!-- ================= 6. TAB: DELIVERY ZONES ================= -->
      <div id="tab-delivery" class="tab-content-panel">
         <div class="panel-card">
            <div class="panel-head">
               <h5 class="panel-title"><i class="fas fa-truck me-2"></i>Delivery Zones Management</h5>
               <button class="btn-primary-snug" data-bs-toggle="modal" data-bs-target="#createDeliveryZoneModal"><i class="fas fa-plus"></i> Add Delivery Zone</button>
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
                        <td data-label="Min Order">EGP {{ number_format($zone->minimum_order_value ?? 0, 2) }}</td>
                        <td data-label="Estimated Time"><i class="fas fa-clock me-1 text-muted"></i>{{ $zone->estimated_time ?? '20-30 mins' }}</td>
                        <td>
                           <button class="btn-action" title="Edit" onclick="openEditDeliveryModal({{ json_encode($zone) }})"><i class="fas fa-edit me-1"></i>Edit</button>
                           <button class="btn-action delete" title="Delete" onclick="deleteItem('/admin/delivery-zones/{{ $zone->id }}')"><i class="fas fa-trash-alt me-1"></i>Delete</button>
                        </td>
                     </tr>
                  @empty
                     <tr><td colspan="5" class="text-center text-muted">No delivery zones created yet.</td></tr>
                  @endforelse
               </tbody>
            </table>
            </div>
         </div>
      </div>

      <!-- ================= 7. TAB: ORDERS ================= -->
      <div id="tab-orders" class="tab-content-panel">
         <div class="panel-card">
            <div class="panel-head">
               <h5 class="panel-title"><i class="fas fa-shopping-bag me-2"></i>Customer Orders Management</h5>
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
                  </tr>
               </thead>
               <tbody>
                  @forelse($orders as $ord)
                     <tr>
                        <td><strong>Order #{{ substr($ord->id, 0, 8) }}</strong></td>
                        <td data-label="Customer">{{ $ord->user->name ?? 'Guest' }}</td>
                        <td data-label="Payment"><span class="badge bg-light text-dark border">{{ strtoupper($ord->payment_method) }}</span></td>
                        <td data-label="Total"><strong style="color:var(--primary);">EGP {{ number_format($ord->total_price, 2) }}</strong></td>
                        <td data-label="Date">{{ $ord->created_at->format('M d, g:i A') }}</td>
                        <td data-label="Status">
                           <select class="form-select form-select-sm rounded-pill fw-bold border-0 bg-light ms-auto" onchange="updateOrderStatus('{{ $ord->id }}', this.value)" style="width:140px;">
                              <option value="pending" {{ $ord->status == 'pending' ? 'selected' : '' }}>Pending</option>
                              <option value="confirmed" {{ $ord->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                              <option value="preparing" {{ $ord->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                              <option value="out_for_delivery" {{ $ord->status == 'out_for_delivery' ? 'selected' : '' }}>Out For Delivery</option>
                              <option value="delivered" {{ $ord->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                              <option value="cancelled" {{ $ord->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                           </select>
                        </td>
                     </tr>
                  @empty
                     <tr><td colspan="6" class="text-center text-muted">No orders found.</td></tr>
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
                     <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Hot Coffees" />
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Category Image</label>
                     <input type="file" name="image" class="form-control rounded-3" accept="image/*" required />
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
                        @foreach($categories as $c)
                           <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Subcategory Name</label>
                     <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Espresso & Lattes" />
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Subcategory Photo</label>
                     <input type="file" name="image" class="form-control rounded-3" accept="image/*" required />
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
                        @foreach($subcategories as $s)
                           <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->category->name ?? '-' }})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Product Name</label>
                     <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Vanilla Bean Latte" />
                  </div>
                  <div class="row g-2 mb-3">
                     <div class="col-6">
                        <label class="form-label fw-bold">Price (EGP)</label>
                        <input type="number" step="0.01" name="price" class="form-control rounded-3" required placeholder="4.50" />
                     </div>
                     <div class="col-6">
                        <label class="form-label fw-bold">Stock Available</label>
                        <input type="number" name="stock" class="form-control rounded-3" min="20" required value="20" />
                     </div>
                  </div>
                  <div class="row g-2 mb-3">
                     <div class="col-4">
                        <label class="form-label fw-bold">Calories</label>
                        <input type="number" name="calories" class="form-control rounded-3" value="180" min="0" required />
                     </div>
                     <div class="col-4">
                        <label class="form-label fw-bold">Prep Time (min)</label>
                        <input type="number" name="prep_time" class="form-control rounded-3" value="5" min="0" required />
                     </div>
                     <div class="col-4">
                        <label class="form-label fw-bold">Discount Amount (EGP)</label>
                        <input type="number" step="0.01" name="discount_price" class="form-control rounded-3" placeholder="Optional" />
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Description</label>
                     <textarea name="description" class="form-control rounded-3" rows="2" placeholder="Smooth espresso blended with sweet vanilla..."></textarea>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Product Image</label>
                     <input type="file" name="image" class="form-control rounded-3" accept="image/*" required />
                  </div>
                  <div class="row mt-3">
                     <div class="col-md-6 mb-2">
                        <div class="form-check form-switch" style="font-size: 1.1rem;">
                           <input class="form-check-input" type="checkbox" role="switch" name="is_featured" value="1" id="isFeaturedCheck" style="cursor: pointer;">
                           <label class="form-check-label fw-bold ms-2" for="isFeaturedCheck" style="cursor: pointer;">Feature as Hot</label>
                        </div>
                     </div>
                     <div class="col-md-6 mb-2">
                        <div class="form-check form-switch" style="font-size: 1.1rem;">
                           <input class="form-check-input" type="checkbox" role="switch" name="is_bestseller" value="1" id="isBestsellerCheck" style="cursor: pointer;">
                           <label class="form-check-label fw-bold ms-2" for="isBestsellerCheck" style="cursor: pointer;">Category Bestseller</label>
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
            <form id="editCategoryForm" onsubmit="submitApiForm(event, this.action, 'PUT')" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="mb-3">
                     <label class="form-label fw-bold">Category Name</label>
                     <input type="text" name="name" id="editCategoryName" class="form-control rounded-3" required />
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
            <form id="editSubcategoryForm" onsubmit="submitApiForm(event, this.action, 'PUT')" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="mb-3">
                     <label class="form-label fw-bold">Parent Category</label>
                     <select name="category_id" id="editSubcategoryCategoryId" class="form-select rounded-3" required>
                        @foreach($categories as $c)
                           <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Subcategory Name</label>
                     <input type="text" name="name" id="editSubcategoryName" class="form-control rounded-3" required />
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
            <form id="editProductForm" onsubmit="submitApiForm(event, this.action, 'PUT')" enctype="multipart/form-data">
               <div class="modal-body">
                  <div class="mb-3">
                     <label class="form-label fw-bold">Subcategory</label>
                     <select name="subcategory_id" id="editProductSubcategoryId" class="form-select rounded-3" required>
                        @foreach($subcategories as $s)
                           <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->category->name ?? '-' }})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Product Name</label>
                     <input type="text" name="name" id="editProductName" class="form-control rounded-3" required />
                  </div>
                  <div class="row g-2 mb-3">
                     <div class="col-6">
                        <label class="form-label fw-bold">Price (EGP)</label>
                        <input type="number" step="0.01" name="price" id="editProductPrice" class="form-control rounded-3" required />
                     </div>
                     <div class="col-6">
                        <label class="form-label fw-bold">Stock Available</label>
                        <input type="number" name="stock" id="editProductStock" class="form-control rounded-3" min="0" required />
                     </div>
                  </div>
                  <div class="row g-2 mb-3">
                     <div class="col-4">
                        <label class="form-label fw-bold">Calories</label>
                        <input type="number" name="calories" id="editProductCalories" class="form-control rounded-3" min="0" required />
                     </div>
                     <div class="col-4">
                        <label class="form-label fw-bold">Prep Time (min)</label>
                        <input type="number" name="prep_time" id="editProductPrepTime" class="form-control rounded-3" min="0" required />
                     </div>
                     <div class="col-4">
                        <label class="form-label fw-bold">Discount Amount (EGP)</label>
                        <input type="number" step="0.01" name="discount_price" id="editProductDiscountPrice" class="form-control rounded-3" placeholder="Optional" />
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
                           <input class="form-check-input" type="checkbox" role="switch" name="is_featured" value="1" id="editProductFeatured" style="cursor: pointer;">
                           <label class="form-check-label fw-bold ms-2" for="editProductFeatured" style="cursor: pointer;">Feature as Hot</label>
                        </div>
                     </div>
                     <div class="col-md-6 mb-2">
                        <div class="form-check form-switch" style="font-size: 1.1rem;">
                           <input class="form-check-input" type="checkbox" role="switch" name="is_bestseller" value="1" id="editProductBestseller" style="cursor: pointer;">
                           <label class="form-check-label fw-bold ms-2" for="editProductBestseller" style="cursor: pointer;">Category Bestseller</label>
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
   <!-- Create Addon Modal -->
   <div class="modal fade" id="createAddonModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0">
               <h5 class="modal-title fw-bold">Add New Add-On</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form onsubmit="submitApiForm(event, '/admin/add-ons', 'POST')">
               <div class="modal-body">
                  <div class="mb-3">
                     <label class="form-label fw-bold">Add-On Name</label>
                     <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Extra Espresso Shot" />
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Price Adjustment (EGP)</label>
                     <input type="number" step="0.01" name="price_adjustment" class="form-control rounded-3" required placeholder="1.00" />
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
                     <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Nasr City & Fifth Settlement" />
                  </div>
                  <div class="row g-2 mb-3">
                     <div class="col-6">
                        <label class="form-label fw-bold">Delivery Fee (EGP)</label>
                        <input type="number" step="0.01" name="delivery_fee" class="form-control rounded-3" required placeholder="3.00" />
                     </div>
                     <div class="col-6">
                        <label class="form-label fw-bold">Min Order (EGP)</label>
                        <input type="number" step="0.01" name="minimum_order_value" class="form-control rounded-3" placeholder="15.00" />
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Estimated Time</label>
                     <input type="text" name="estimated_time" class="form-control rounded-3" placeholder="20-30 mins" />
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
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0">
               <h5 class="modal-title fw-bold">Edit Add-On</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAddonForm" onsubmit="submitApiForm(event, this.action, 'PUT')">
               <div class="modal-body">
                  <div class="mb-3">
                     <label class="form-label fw-bold">Add-On Name</label>
                     <input type="text" name="name" id="editAddonName" class="form-control rounded-3" required />
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Price Adjustment (EGP)</label>
                     <input type="number" step="0.01" name="price_adjustment" id="editAddonPrice" class="form-control rounded-3" required />
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
                     <input type="text" name="name" id="editDeliveryZoneName" class="form-control rounded-3" required />
                  </div>
                  <div class="row g-2 mb-3">
                     <div class="col-6">
                        <label class="form-label fw-bold">Delivery Fee (EGP)</label>
                        <input type="number" step="0.01" name="delivery_fee" id="editDeliveryZoneFee" class="form-control rounded-3" required />
                     </div>
                     <div class="col-6">
                        <label class="form-label fw-bold">Min Order (EGP)</label>
                        <input type="number" step="0.01" name="minimum_order_value" id="editDeliveryZoneMinOrder" class="form-control rounded-3" />
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="form-label fw-bold">Estimated Time</label>
                     <input type="text" name="estimated_time" id="editDeliveryZoneTime" class="form-control rounded-3" />
                  </div>
               </div>
               <div class="modal-footer border-0">
                  <button type="submit" class="btn-primary-snug w-100">Update Delivery Zone</button>
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
         
         if(!btn) {
            btn = document.querySelector(`.admin-nav-item[onclick*="'${tabId}'"]`);
         }
         if(btn) btn.classList.add('active');
         
         const titles = {
            overview: 'Dashboard Overview',
            products: 'Products Management',
            categories: 'Categories Management',
            subcategories: 'Subcategories Management',
            addons: 'Add-Ons Management',
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
         } catch(e) {
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
               const resData = await res.json();
               let successTitle = 'Success!';
               let successMsg = 'Action completed successfully!';
               let timerVal = 1500;
               let showClose = false;
               
               // Check if this was a product edit
               if (url.includes('/admin/products') && method === 'POST') {
                   // If the product was restocked to > 10
                   if (resData && resData.data && resData.data.stock > 10) {
                       successTitle = 'Restocked!';
                       successMsg = 'Restocked successfully';
                       timerVal = 4000;
                       showClose = true;
                   }
               }

               closeAllModals();
               reloadPageContent();
               
               Swal.fire({
                   toast: showClose, // Use toast style for restock
                   position: showClose ? 'top-end' : 'center',
                   title: successTitle, 
                   text: successMsg, 
                   icon: 'success', 
                   confirmButtonColor: '#9C7A5B', 
                   timer: timerVal, 
                   timerProgressBar: showClose,
                   showConfirmButton: !showClose,
                   showCloseButton: showClose
               });
            } else {
               const err = await res.json();
               Swal.fire({ title: 'Error!', text: err.message || JSON.stringify(err.errors) || 'Validation error', icon: 'error', confirmButtonColor: '#9C7A5B' });
            }
         } catch (error) {
            Swal.fire({ title: 'Error!', text: 'Server error.', icon: 'error', confirmButtonColor: '#9C7A5B' });
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

      function openEditProductModal(prod) {
         document.getElementById('editProductName').value = prod.name;
         document.getElementById('editProductSubcategoryId').value = prod.subcategory_id;
         document.getElementById('editProductPrice').value = prod.price;
         document.getElementById('editProductStock').value = prod.stock;
         document.getElementById('editProductDesc').value = prod.description || '';
         document.getElementById('editProductCalories').value = prod.calories !== null ? prod.calories : 180;
         document.getElementById('editProductPrepTime').value = prod.prep_time !== null ? prod.prep_time : 5;
         document.getElementById('editProductDiscountPrice').value = prod.discount_price || '';
         document.getElementById('editProductFeatured').checked = prod.is_featured;
         document.getElementById('editProductBestseller').checked = prod.is_bestseller;
         document.getElementById('editProductForm').action = '/admin/products/' + prod.id;
         new bootstrap.Modal(document.getElementById('editProductModal')).show();
      }

      function openEditAddonModal(addon) {
         document.getElementById('editAddonName').value = addon.name;
         document.getElementById('editAddonPrice').value = addon.price_adjustment;
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


      async function updateOrderStatus(orderId, status) {
         try {
            const res = await fetch('/admin/orders/' + orderId + '/status', {
               method: 'PUT',
               headers: {
                  'Content-Type': 'application/json',
                  'Accept': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
               },
               body: JSON.stringify({ status: status })
            });

            if (res.ok) {
               Swal.fire({ title: 'Updated!', text: 'Order #' + orderId.substring(0, 8) + ' status updated to ' + status, icon: 'success', confirmButtonColor: '#9C7A5B' });
            } else {
               Swal.fire({ title: 'Error!', text: 'Failed to update status.', icon: 'error', confirmButtonColor: '#9C7A5B' });
            }
         } catch (e) {
            console.error(e);
         }
      }

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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                     }
                  });
                  if (res.ok) {
                     reloadPageContent();
                     Swal.fire({ title: 'Deleted!', text: 'Item has been deleted.', icon: 'success', confirmButtonColor: '#9C7A5B', timer: 1500, showConfirmButton: false });
                  } else {
                     Swal.fire({ title: 'Error!', text: 'Failed to delete item.', icon: 'error', confirmButtonColor: '#9C7A5B' });
                  }
               } catch(e) {
                  console.error(e);
                  Swal.fire({ title: 'Error!', text: 'Server error.', icon: 'error', confirmButtonColor: '#9C7A5B' });
               }
            }
         });
      }
   </script>
</body>
</html>
