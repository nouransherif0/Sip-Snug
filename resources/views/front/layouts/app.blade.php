



<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="author" content="Sip & Snug">
      <meta name="description" content="Sip & Snug - Coffee House, Fresh Drinks & Cozy Vibes">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Sip & Snug Cafe - Coffee House</title>
      <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet"/>
      <!-- Bootstrap 5.3 -->
      <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet"/>
      <!-- AOS Animate on Scroll -->
      <link href="{{ asset('front/css/aos.css') }}" rel="stylesheet"/>
      <!-- Swiper -->
      <link href="{{ asset('front/css/swiper-bundle.min.css') }}" rel="stylesheet"/>
      <!-- all min css -->
      <link rel="stylesheet" href="{{ asset('front/css/all.min.css') }}"/>
      <!-- magnific CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}"/>
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/style.css') }}" />
   </head>
   <body>
      <!-- ============================================================
         TOP BAR
         ============================================================ -->
      <div id="topbar">
         <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
               <div class="top-contact d-flex flex-wrap">
                  <span><i class="fas fa-phone-alt"></i>19696</span>
                  <span><i class="fas fa-envelope"></i>SipnSnug@gmail.com</span>
                  <span><i class="fas fa-map-marker-alt"></i>Nasrcity, cairo</span>
               </div>
               <div class="d-flex align-items-center gap-3">
                  <span class="ttag"><i class="fas fa-fire me-1"></i>Free Delivery Today!</span>
                  <div class="tsoc">
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-instagram"></i></a>
                     <a href="#"><i class="fab fa-tiktok"></i></a>
                     <a href="#"><i class="fab fa-youtube"></i></a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- ============================================================
         NAVBAR
         ============================================================ -->
      <nav class="navbar navbar-expand-lg" id="nav">
         <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <div class="blogo">
                  <div class="bico"><i class="fas fa-mug-hot"></i></div>
                  <div>
                     <div class="bname">Sip&<span>Snug</span></div>
                     <div class="bsub">Coffee House & Cafe</div>
                  </div>
               </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <i class="fas fa-bars" style="color:var(--primary);font-size:1.35rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
               <ul class="navbar-nav mx-auto">
                  <li class="nav-item"><a class="nav-link active" href="{{ url('/#hero') }}">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#about') }}">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#menu') }}">Menu</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#chefs') }}">Baristas</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#reservation') }}">Visit</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#testimonials') }}">Reviews</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/#contact-section') }}">Contact</a></li>
               </ul>
               <div class="d-flex align-items-center gap-2">
                  <!-- FIX 1: Search button -->
                  <button id="navSearchBtn" title="Search" class="btn" style="color:var(--primary);"><i class="fas fa-search"></i></button>

                  @guest
                      <a href="{{ route('login') }}" class="nav-link" style="color:var(--primary); font-weight:600;"><i class="fas fa-user"></i> Login</a>
                  @endguest

                  <a href="{{ url('/#menu') }}" class="nav-link nav-cta"><i class="fas fa-shopping-bag me-1"></i>Order Now</a>

                  @auth
                  @if(auth()->user()->isAdmin())
                     @php
                        $lowStockProducts = \App\Models\Product::where('stock', '<=', 10)->get();
                        $lowStockCount = $lowStockProducts->count();
                     @endphp
                     @if($lowStockCount > 0)
                        <div class="dropdown ms-2">
                           <button class="btn btn-light position-relative border-0 rounded-circle" type="button" data-bs-toggle="dropdown" style="width:40px;height:40px;background:transparent;">
                              <i class="fas fa-bell text-danger fs-5"></i>
                              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">
                                 {{ $lowStockCount }}
                              </span>
                           </button>
                           <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 p-0" style="width: 320px; max-height: 400px; overflow-y: auto;">
                              <li class="p-3 border-bottom bg-light">
                                 <h6 class="m-0 text-danger"><i class="fas fa-exclamation-circle me-2"></i>Low Stock Alerts</h6>
                              </li>
                              @foreach($lowStockProducts as $prod)
                                 <li>
                                    <a class="dropdown-item py-3 border-bottom text-wrap" href="{{ route('admin.dashboard') }}?tab=products">
                                       <strong class="d-block text-dark">{{ $prod->name }}</strong>
                                       <small class="text-danger">Alert: Product has only {{ $prod->stock }} left!</small>
                                    </a>
                                 </li>
                              @endforeach
                           </ul>
                        </div>
                     @endif
                  @endif
                  <!-- Hamburger Side Menu Trigger -->
                  <button id="hamburgerBtn" class="hamburger-btn ms-2" title="Open Menu Side Drawer">
                     <i class="fas fa-bars"></i>
                  </button>
                  @endauth
               </div>
            </div>
         </div>
      </nav>
      <!-- ============================================================
         FIX 1 � SEARCH OVERLAY POPUP
         ============================================================ -->
      <div id="searchOv">
         <button class="sovclose" id="searchClose"><i class="fas fa-times"></i></button>
         <div class="sovbox">
            <h4>What would you like to sip today?</h4>
            <div class="sovinput">
               <input type="text" id="searchInput" placeholder="Search coffee, matcha, smoothies..." autocomplete="off"/>
               <button><i class="fas fa-search"></i></button>
            </div>
            <div class="sovcats">
               <div class="sovcat active" data-cat="all">
                  <img src="{{ asset('front/photos/coffee/esspresso.jpg') }}" alt=""/>All Drinks
               </div>
               <div class="sovcat" data-cat="coffee">
                  <img src="{{ asset('front/photos/coffee/hot latte.jpg') }}" alt=""/>Coffee
               </div>
               <div class="sovcat" data-cat="matcha">
                  <img src="{{ asset('front/photos/matcha/iced matcha .jpg') }}" alt=""/>Matcha
               </div>
               <div class="sovcat" data-cat="fresh juice">
                  <img src="{{ asset('front/photos/fresh juice/orange juice.jpg') }}" alt=""/>Fresh Juice
               </div>
               <div class="sovcat" data-cat="refreshers">
                  <img src="{{ asset('front/photos/refreshers/refreshers.jpg') }}" alt=""/>Refreshers
               </div>
               <div class="sovcat" data-cat="smoothies">
                  <img src="{{ asset('front/photos/smoothies/mango smoothie.jpg') }}" alt=""/>Smoothies
               </div>
            </div>
            <div class="sovtrend">
               <p><i class="fas fa-fire me-1" style="color:var(--secondary);"></i>Trending Searches</p>
               <span class="ttag">Caramel Latte</span>
               <span class="ttag">Iced Matcha</span>
               <span class="ttag">Berry Refresher</span>
               <span class="ttag">Mango Smoothie</span>
               <span class="ttag">Orange Juice</span>
               <span class="ttag">Cold Brew</span>
            </div>
         </div>
      </div>






        @yield('content')











<!-- FOOTER -->
      <footer>
         <div class="container">
            <div class="row g-5">
               <div class="col-lg-4">
                  <div class="fnm">Sip&<span>Snug</span></div>
                  <p class="fdesc">We bring cozy comfort and crafted drinks together in a warm, welcoming space. Every cup is made with care.</p>
                  <div class="fsoc">
                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                     <a href="#"><i class="fab fa-instagram"></i></a>
                     <a href="#"><i class="fab fa-twitter"></i></a>
                     <a href="#"><i class="fab fa-youtube"></i></a>
                     <a href="#"><i class="fab fa-tiktok"></i></a>
                  </div>
               </div>
               <div class="col-sm-6 col-lg-2">
                  <div class="ftit">Quick Links</div>
                  <ul class="flinks ps-0">
                     <li><a href="{{ url('/#hero') }}"><i class="fas fa-chevron-right"></i>Home</a></li>
                     <li><a href="{{ url('/#about') }}"><i class="fas fa-chevron-right"></i>About Us</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Our Menu</a></li>
                     <li><a href="{{ url('/#reservation') }}"><i class="fas fa-chevron-right"></i>Reservation</a></li>
                     <li><a href="#blog"><i class="fas fa-chevron-right"></i>Blog</a></li>
                     <li><a href="{{ url('/#contact-section') }}"><i class="fas fa-chevron-right"></i>Contact</a></li>
                  </ul>
               </div>
               <div class="col-sm-6 col-lg-2">
                  <div class="ftit">Our Menu</div>
                  <ul class="flinks ps-0">
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Coffee</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Matcha</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Fresh Juice</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Refreshers</a></li>
                     <li><a href="{{ url('/#menu') }}"><i class="fas fa-chevron-right"></i>Smoothies</a></li>
                  </ul>
               </div>
               <div class="col-lg-4">
                  <div class="ftit">Get In Touch</div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-map-marker-alt"></i></div>
                     <div class="fciinfo"><strong>Address</strong>Nasrcity, EG</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-phone-alt"></i></div>
                     <div class="fciinfo"><strong>Phone</strong>19696</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-envelope"></i></div>
                     <div class="fciinfo"><strong>Email</strong>SipnSnug@gmail.com</div>
                  </div>
                  <div class="fci">
                     <div class="fciico"><i class="fas fa-clock"></i></div>
                     <div class="fciinfo"><strong>Hours</strong>Wed - Sun: 09 AM - 11 PM</div>
                  </div>
               </div>
            </div>
         </div>
         <div class="fbot">
            <div class="container">
               <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <p>&copy 2026 <span>Sip & Snug Cafe</span>. All Rights Reserved by <a target="_blank" class="mx-0 fw-bold text-success" href="https://bestwpware.com/">Bestwpware</a>. Made with <span><i class="fas fa-heart"></i></span>  <br>Distributed by <a target="_blank" class="mx-0 fw-bold text-success" href="https://themewagon.com">ThemeWagon</a></p>
                  <div><a href="#">Privacy Policy</a><a href="#">Terms</a><a href="#">Cookies</a></div>
               </div>
            </div>
         </div>
      </footer>
      <!-- Floating cart -->
      @auth
      <a href="{{ route('cart.index') }}" class="cartfl text-decoration-none">
          <i class="fas fa-shopping-cart"></i>
          <span>My Cart</span>
          <div class="ccount" id="cartCount">0</div>
      </a>
      @else
      <a href="{{ route('login') }}" class="cartfl text-decoration-none">
          <i class="fas fa-shopping-cart"></i>
          <span>My Cart</span>
      </a>
      @endauth
      <!-- Back to top -->
      <button id="btt" onclick="window.scrollTo({top:0,behavior:'smooth'})"><i class="fas fa-chevron-up"></i></button>

	<!-- jQuery -->
      <script src="{{ asset('front/js/jquery-3.7.1.min.js') }}"></script>
      <!-- Bootstrap 5 -->
      <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AOS -->
      <script src="{{ asset('front/js/aos.js') }}"></script>
      <!-- Swiper -->
      <script src="{{ asset('front/js/swiper-bundle.min.js') }}"></script>
      <!-- CounterUp -->
      <script src="{{ asset('front/js/jquery.magnific-popup.min.js') }}"></script>
      <!-- Main js -->
      <script src="{{ asset('front/js/main.js') }}"></script>

      @auth
      <script>
        function updateGlobalCartCount() {
            fetch('/api/v1/cart', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.data && data.data.items) {
                    let totalQty = 0;
                    data.data.items.forEach(item => totalQty += parseInt(item.quantity));
                    document.getElementById('cartCount').textContent = totalQty;
                }
            })
            .catch(console.error);
        }

        document.addEventListener('DOMContentLoaded', updateGlobalCartCount);
      </script>
      @endauth
@auth
      <!-- ============================================================
         HAMBURGER SIDE MENU DRAWER
         ============================================================ -->
      <div id="sideMenuOverlay" class="side-menu-overlay"></div>
      <aside id="sideMenuDrawer" class="side-menu-drawer">
         <!-- Drawer Header -->
         <div class="sm-header">
            <div class="blogo">
               <div class="bico"><i class="fas fa-mug-hot"></i></div>
               <div>
                  <div class="bname">Sip&<span>Snug</span></div>
                  <div class="bsub">Coffee House & Cafe</div>
               </div>
            </div>
            <button id="sideMenuClose" class="sm-close-btn" title="Close menu"><i class="fas fa-times"></i></button>
         </div>

         <!-- Scrollable Content -->
         <div class="sm-content">
            <!-- User Profile Card -->
            <div class="sm-profile-card">
               <div class="sm-profile-avatar">
                  <img src="{{ Auth::user()->profile_image_url }}" style="border-radius: 50%; object-fit: cover;" alt="User Avatar" />
                  <span class="sm-badge" title="Gold Member"><i class="fas fa-crown"></i></span>
               </div>
               <div class="sm-profile-info">
                  <h5>{{ Auth::user()->name }}</h5>
                  <p class="sm-role"><i class="fas fa-star me-1" style="color:var(--secondary);"></i>Gold Member • 340 pts</p>
                  <p class="sm-email">{{ Auth::user()->email }}</p>
               </div>
               <div class="sm-profile-actions">
                  @if(Auth::user()->isAdmin())
                     <a href="{{ route('admin.dashboard') }}" class="sm-btn sm-btn-primary mb-2 w-100"><i class="fas fa-chart-line me-1"></i> Admin Dashboard</a>
                  @endif
                  <div class="d-flex w-100 gap-2">
                     <a href="{{ route('profile.edit') }}" class="sm-btn sm-btn-outline" style="flex:1;"><i class="fas fa-user-gear me-1"></i> My Profile</a>
                     <form method="POST" action="{{ route('logout') }}" style="flex:1;">
                      @csrf
                      <button type="submit" id="smLogoutBtn" class="sm-btn sm-btn-danger w-100"><i class="fas fa-sign-out-alt me-1"></i> Log Out</button>
                  </form>
                  </div>
               </div>
            </div>

            <!-- Categories & Subcategories Section -->
            <div class="sm-section">
               <h6 class="sm-section-title"><i class="fas fa-layer-group me-2"></i>Categories & Subcategories</h6>
               <div class="sm-accordion">
                  <!-- Category 1: Coffee -->
                  <div class="sm-accordion-item">
                     <button class="sm-accordion-btn">
                        <span><i class="fas fa-coffee sm-icon"></i> Coffee & Espresso</span>
                        <i class="fas fa-chevron-down sm-arrow"></i>
                     </button>
                     <div class="sm-accordion-body">
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="coffee"><i class="fas fa-angle-right me-2"></i>Espresso & Ristretto</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="coffee"><i class="fas fa-angle-right me-2"></i>Hot Lattes & Cappuccinos</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="coffee"><i class="fas fa-angle-right me-2"></i>Cold Brew & Iced Coffee</a>
                     </div>
                  </div>

                  <!-- Category 2: Matcha -->
                  <div class="sm-accordion-item">
                     <button class="sm-accordion-btn">
                        <span><i class="fas fa-leaf sm-icon"></i> Matcha & Teas</span>
                        <i class="fas fa-chevron-down sm-arrow"></i>
                     </button>
                     <div class="sm-accordion-body">
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="matcha"><i class="fas fa-angle-right me-2"></i>Iced Matcha Latte</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="matcha"><i class="fas fa-angle-right me-2"></i>Pink & Lavender Matcha</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="matcha"><i class="fas fa-angle-right me-2"></i>Organic Green & Herbal Teas</a>
                     </div>
                  </div>

                  <!-- Category 3: Fresh Juice -->
                  <div class="sm-accordion-item">
                     <button class="sm-accordion-btn">
                        <span><i class="fas fa-glass-citrus sm-icon"></i> Fresh Juices</span>
                        <i class="fas fa-chevron-down sm-arrow"></i>
                     </button>
                     <div class="sm-accordion-body">
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="fresh juice"><i class="fas fa-angle-right me-2"></i>Citrus & Orange Boost</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="fresh juice"><i class="fas fa-angle-right me-2"></i>Beet-Apple Juice</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="fresh juice"><i class="fas fa-angle-right me-2"></i>Cold-Pressed Cleanser</a>
                     </div>
                  </div>

                  <!-- Category 4: Refreshers -->
                  <div class="sm-accordion-item">
                     <button class="sm-accordion-btn">
                        <span><i class="fas fa-cocktail sm-icon"></i> Refreshers</span>
                        <i class="fas fa-chevron-down sm-arrow"></i>
                     </button>
                     <div class="sm-accordion-body">
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="refreshers"><i class="fas fa-angle-right me-2"></i>Refreshing Iced Mojito</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="refreshers"><i class="fas fa-angle-right me-2"></i>Berry Hibiscus Sparkler</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="refreshers"><i class="fas fa-angle-right me-2"></i>Passionfruit Cooler</a>
                     </div>
                  </div>

                  <!-- Category 5: Smoothies -->
                  <div class="sm-accordion-item">
                     <button class="sm-accordion-btn">
                        <span><i class="fas fa-blender sm-icon"></i> Smoothies</span>
                        <i class="fas fa-chevron-down sm-arrow"></i>
                     </button>
                     <div class="sm-accordion-body">
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="smoothies"><i class="fas fa-angle-right me-2"></i>Creamy Berry Smoothie</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="smoothies"><i class="fas fa-angle-right me-2"></i>Mango Sunshine Shake</a>
                        <a href="{{ url('/#menu') }}" class="sm-sub-link" data-cat="smoothies"><i class="fas fa-angle-right me-2"></i>Banana Peanut Protein</a>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Quick Extras -->
            <div class="sm-section">
               <h6 class="sm-section-title"><i class="fas fa-th-large me-2"></i>Quick Extras</h6>
               <div class="sm-quick-grid">
                  <button class="sm-quick-item" data-cm-target="ordersModal"><i class="fas fa-shopping-bag"></i><span>My Orders</span></button>
                  <button class="sm-quick-item" data-cm-target="favoritesModal"><i class="fas fa-heart"></i><span>Favorites</span></button>
                  <button class="sm-quick-item" data-cm-target="rewardsModal"><i class="fas fa-gift"></i><span>Rewards</span></button>
                  <button class="sm-quick-item" data-cm-target="locationsModal"><i class="fas fa-map-marked-alt"></i><span>Locations</span></button>
               </div>
            </div>

            <!-- Help & Support -->
            <div class="sm-section">
               <h6 class="sm-section-title"><i class="fas fa-headset me-2"></i>Help & Support</h6>
               <ul class="sm-support-list">
                  <li><button class="sm-support-link w-100 border-0 bg-transparent text-start" data-cm-target="faqModal"><i class="fas fa-question-circle"></i> FAQ & Help Center</button></li>
                  <li><button class="sm-support-link w-100 border-0 bg-transparent text-start" data-cm-target="chatModal"><i class="fas fa-comments"></i> Live Chat Support</button></li>
                  <li><a href="tel:19696" class="sm-support-link"><i class="fas fa-phone-alt"></i> Hotline (19696)</a></li>
               </ul>
            </div>
         </div>

         <!-- Drawer Footer -->
         <div class="sm-footer">
            <div class="sm-socials">
               <a href="#"><i class="fab fa-facebook-f"></i></a>
               <a href="#"><i class="fab fa-instagram"></i></a>
               <a href="#"><i class="fab fa-tiktok"></i></a>
               <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <p class="sm-copy">Sip & Snug Cafe © 2026</p>
         </div>
      </aside>
@endauth
      <div id="ordersModal" class="cm-overlay">
         <div class="cm-dialog">
            <div class="cm-header">
               <div class="cm-title-wrap">
                  <div class="cm-icon-box"><i class="fas fa-shopping-bag"></i></div>
                  <div>
                     <h4>My Orders & Live Tracker</h4>
                     <p>Track your brewing coffee and view past purchases</p>
                  </div>
               </div>
               <button class="cm-close" data-cm-close><i class="fas fa-times"></i></button>
            </div>
            <div class="cm-body">
               <div id="myOrdersContainer">
                  <div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>
               </div>
            </div>
         </div>
      </div>

      <!-- 4. FAVORITES MODAL -->
      <div id="favoritesModal" class="cm-overlay">
         <div class="cm-dialog">
            <div class="cm-header">
               <div class="cm-title-wrap">
                  <div class="cm-icon-box"><i class="fas fa-heart"></i></div>
                  <div>
                     <h4>My Favorite Drinks</h4>
                     <p>Your saved brews & refreshers</p>
                  </div>
               </div>
               <button class="cm-close" data-cm-close><i class="fas fa-times"></i></button>
            </div>
            <div class="cm-body">
               <div class="fav-grid">
                  @auth
                  @forelse(Auth::user()->favorites as $favorite)
                  <div class="fav-card" id="fav-card-{{ $favorite->id }}">
                     <div class="fav-img">
                        <img src="{{ $favorite->image ? asset($favorite->image) : asset('front/photos/coffee/esspresso.jpg') }}" alt="{{ $favorite->name }}" />
                        <button class="fav-remove" data-id="{{ $favorite->id }}" title="Remove"><i class="fas fa-heart"></i></button>
                     </div>
                     <div class="fav-info">
                        <h6>{{ $favorite->name }}</h6>
                        <small class="text-muted d-block mb-2">{{ $favorite->subcategory->name ?? 'Drink' }} • EGP {{ number_format($favorite->price, 2) }}</small>
                        <button class="btn btn-sm btn-danger w-100 rounded-pill fav-order-btn"><i class="fas fa-shopping-bag me-1"></i>Order Now</button>
                     </div>
                  </div>
                  @empty
                  <div class="text-center py-4 text-muted" style="grid-column: 1 / -1;">
                      <i class="fas fa-heart-broken mb-3" style="font-size: 2rem; opacity: 0.5;"></i>
                      <p>You haven't added any favorite drinks yet!</p>
                  </div>
                  @endforelse
                  @else
                  <div class="text-center py-4 text-muted" style="grid-column: 1 / -1;">
                      <i class="fas fa-lock mb-3" style="font-size: 2rem; opacity: 0.5;"></i>
                      <p>Please <a href="{{ route('login') }}">login</a> to view your favorites.</p>
                  </div>
                  @endauth
               </div>
            </div>
         </div>
      </div>

      <!-- 5. REWARDS MODAL -->
      <div id="rewardsModal" class="cm-overlay">
         <div class="cm-dialog">
            <div class="cm-header">
               <div class="cm-title-wrap">
                  <div class="cm-icon-box"><i class="fas fa-gift"></i></div>
                  <div>
                     <h4>Loyalty Rewards & Coupons</h4>
                     <p>Earn points with every sip</p>
                  </div>
               </div>
               <button class="cm-close" data-cm-close><i class="fas fa-times"></i></button>
            </div>
            <div class="cm-body">
               <div class="rewards-banner">
                  <div class="d-flex justify-content-between align-items-center">
                     <div>
                        <span class="badge bg-warning text-dark uppercase fw-bold mb-2">Rewards Member</span>
                        <h5 class="mb-0 text-white">{{ Auth::check() ? Auth::user()->name : "Guest" }}</h5>
                     </div>
                     <div class="text-end">
                        <div class="rewards-pts" id="rewardPtsDisplay">0</div>
                        <small style="color:var(--secondary);">Available Points</small>
                     </div>
                  </div>
                  <div class="rewards-bar-wrap">
                     <div class="rewards-bar" style="width: 100%;"></div>
                  </div>
                  <small class="text-white-50">Earn 1 point for every 10 EGP spent!</small>
               </div>

               <h6 class="fw-bold mb-3"><i class="fas fa-ticket-alt me-2 text-warning"></i>Redeemable Vouchers</h6>
               <div id="redeemSuccessMsg" class="alert alert-success" style="display:none;"></div>
               <div id="redeemErrorMsg" class="alert alert-danger" style="display:none;"></div>
               
               <div class="voucher-card">
                  <div>
                     <h6 class="mb-1 fw-bold">Free French Croissant</h6>
                     <small class="text-muted">Requires 150 points</small>
                  </div>
                     <h6 class="mb-1 fw-bold">$5.00 Off Any Order</h6>
                     <small class="text-muted">Requires 300 points</small>
                  </div>
                  <button class="btn btn-sm btn-warning rounded-pill fw-bold redeem-btn" onclick="redeemReward(300)">Redeem (300 pts)</button>
               </div>
            </div>
         </div>
      </div>

      <!-- 6. LOCATIONS MODAL -->
      <div id="locationsModal" class="cm-overlay">
         <div class="cm-dialog">
            <div class="cm-header">
               <div class="cm-title-wrap">
                  <div class="cm-icon-box"><i class="fas fa-map-marked-alt"></i></div>
                  <div>
                     <h4>Cafe Locations & Outlets</h4>
                     <p>Visit us for cozy vibes and freshly brewed coffee</p>
                  </div>
               </div>
               <button class="cm-close" data-cm-close><i class="fas fa-times"></i></button>
            </div>
            <div class="cm-body">
               <div class="locations-grid">
                  <div class="loc-card">
                     <span class="loc-badge"><i class="fas fa-star me-1"></i>Flagship Store</span>
                     <h5 class="fw-bold mb-2">Nasr City Branch</h5>
                     <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i>Abbas El Akkad St, Nasr City, Cairo</p>
                     <p class="text-muted small mb-2"><i class="fas fa-clock text-primary me-2"></i>Daily: 07:00 AM - 12:00 AM</p>
                     <p class="text-muted small mb-3"><i class="fas fa-phone text-success me-2"></i>+20 19696 (Ext. 1)</p>
                     <a href="https://maps.google.com" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill w-100"><i class="fas fa-directions me-1"></i>Get Directions</a>
                  </div>
                  <div class="loc-card">
                     <span class="loc-badge"><i class="fas fa-wifi me-1"></i>Co-Working Friendly</span>
                     <h5 class="fw-bold mb-2">Zamalek Outlet</h5>
                     <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i>26th of July St, Zamalek, Cairo</p>
                     <p class="text-muted small mb-2"><i class="fas fa-clock text-primary me-2"></i>Daily: 08:00 AM - 11:30 PM</p>
                     <p class="text-muted small mb-3"><i class="fas fa-phone text-success me-2"></i>+20 19696 (Ext. 2)</p>
                     <a href="https://maps.google.com" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill w-100"><i class="fas fa-directions me-1"></i>Get Directions</a>
                  </div>
                  <div class="loc-card">
                     <span class="loc-badge"><i class="fas fa-leaf me-1"></i>Garden Seating</span>
                     <h5 class="fw-bold mb-2">New Cairo - Waterway</h5>
                     <p class="text-muted small mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i>Waterway Compound, 5th Settlement</p>
                     <p class="text-muted small mb-2"><i class="fas fa-clock text-primary me-2"></i>Daily: 07:30 AM - 01:00 AM</p>
                     <p class="text-muted small mb-3"><i class="fas fa-phone text-success me-2"></i>+20 19696 (Ext. 3)</p>
                     <a href="https://maps.google.com" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill w-100"><i class="fas fa-directions me-1"></i>Get Directions</a>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- 7. MY PROFILE MODAL -->
      <!-- 8. FAQ MODAL -->
      <div id="faqModal" class="cm-overlay">
         <div class="cm-dialog">
            <div class="cm-header">
               <div class="cm-title-wrap">
                  <div class="cm-icon-box"><i class="fas fa-question-circle"></i></div>
                  <div>
                     <h4>FAQ & Help Center</h4>
                     <p>Everything you need to know about Sip & Snug</p>
                  </div>
               </div>
               <button class="cm-close" data-cm-close><i class="fas fa-times"></i></button>
            </div>
            <div class="cm-body">
               <div class="faq-search-box">
                  <i class="fas fa-search"></i>
                  <input type="text" id="faqSearchInput" placeholder="Search questions (e.g. delivery, rewards, milk options)..." autocomplete="off"/>
               </div>
               <div class="faq-list">
                  <div class="faq-item">
                     <button class="faq-q"><span><i class="fas fa-motorcycle text-warning me-2"></i>How long does delivery take?</span><i class="fas fa-chevron-down"></i></button>
                     <div class="faq-a">Our average delivery time is 25-35 minutes across Cairo. Your drinks are prepared fresh upon order dispatch to guarantee optimal temperature and velvety milk froth!</div>
                  </div>
                  <div class="faq-item">
                     <button class="faq-q"><span><i class="fas fa-seedling text-success me-2"></i>Do you offer dairy-free milk alternatives?</span><i class="fas fa-chevron-down"></i></button>
                     <div class="faq-a">Yes! We offer Oat Milk, Almond Milk, Coconut Milk, and Soy Milk for all espresso, matcha, and latte beverages. Simply select your preference when customizing your order.</div>
                  </div>
                  <div class="faq-item">
                     <button class="faq-q"><span><i class="fas fa-crown text-warning me-2"></i>How do Gold Member loyalty points work?</span><i class="fas fa-chevron-down"></i></button>
                     <div class="faq-a">For every $1 spent, you earn 10 points! Points can be redeemed in your Rewards tab for free coffee drinks, freshly baked croissants, and exclusive coupons.</div>
                  </div>
                  <div class="faq-item">
                     <button class="faq-q"><span><i class="fas fa-undo text-danger me-2"></i>What is your cancellation and refund policy?</span><i class="fas fa-chevron-down"></i></button>
                     <div class="faq-a">Orders can be canceled within 5 minutes of placement via the Live Chat or hotline. If there's any issue with your drink, contact us immediately and we will replace it or issue a full refund.</div>
                  </div>
                  <div class="faq-item">
                     <button class="faq-q"><span><i class="fas fa-calendar-alt text-primary me-2"></i>Can I reserve a table or private booth for events?</span><i class="fas fa-chevron-down"></i></button>
                     <div class="faq-a">Absolutely! Visit our 'Visit' section on the homepage or call us at 19696 to reserve cozy study booths or private lounge tables for groups.</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- 2. LIVE CHAT SUPPORT MODAL -->
      <div id="chatModal" class="cm-overlay">
         <div class="cm-dialog">
            <div class="cm-header">
               <div class="cm-title-wrap">
                  <div class="cm-icon-box" style="position:relative;">
                     <i class="fas fa-comments"></i>
                     <span style="position:absolute;bottom:0;right:0;width:12px;height:12px;border-radius:50%;background:#4ade80;border:2px solid #fff;"></span>
                  </div>
                  <div>
                     <h4>Live Customer Support</h4>
                     <p>Coffee Care Assistant • Online</p>
                  </div>
               </div>
               <button class="cm-close" data-cm-close><i class="fas fa-times"></i></button>
            </div>
            <div class="cm-body">
               <div class="chat-messages" id="chatMessages">
                  <div class="chat-msg chat-msg-bot">
                     ☕ Hello {{ Auth::check() ? Auth::user()->name : "Guest" }}! Welcome to Sip & Snug Live Support. How can we assist your coffee journey today?
                  </div>
               </div>
               <div class="chat-chips">
                  <button class="chat-chip" data-msg="Where is my current order?"><i class="fas fa-truck me-1"></i>Track Current Order</button>
                  <button class="chat-chip" data-msg="Recommend a refreshing drink"><i class="fas fa-magic me-1"></i>Drink Recommendation</button>
                  <button class="chat-chip" data-msg="How do I use my rewards points?"><i class="fas fa-gift me-1"></i>Redeem Rewards</button>
               </div>
               <div class="chat-input-wrap">
                  <input type="text" id="chatInput" placeholder="Type your question here..." />
                  <button id="chatSendBtn" class="chat-send-btn"><i class="fas fa-paper-plane me-1"></i>Send</button>
               </div>
            </div>
         </div>
      </div>
@auth
      <script>
        function getHeaders() {
            return {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };
        }
        
        // Orders Logic
        document.querySelector('[data-cm-target="ordersModal"]').addEventListener('click', function() {
            fetchMyOrders();
        });

        function fetchMyOrders() {
            const container = document.getElementById('myOrdersContainer');
            container.innerHTML = '<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div></div>';
            
            fetch('/api/v1/orders', { headers: getHeaders() })
            .then(res => res.json())
            .then(res => {
                const orders = res.data || [];
                if (orders.length === 0) {
                    container.innerHTML = '<div class="text-center text-muted py-4"><i class="fas fa-box-open fs-1 mb-3"></i><p>No orders yet!</p></div>';
                    return;
                }
                
                container.innerHTML = '';
                orders.forEach(order => {
                    // Create status steps
                    const status = order.status; // pending, brewing, out_for_delivery, delivered
                    
                    let activeStep = 1;
                    if (status === 'processing' || status === 'brewing') activeStep = 2;
                    else if (status === 'out_for_delivery' || status === 'delivery') activeStep = 3;
                    else if (status === 'delivered') activeStep = 4;
                    
                    let html = `
                        <div class="order-tracker" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="order-badge ${status === 'pending' ? 'brewing' : (status === 'delivered' ? 'delivered' : 'brewing')} me-2">Order #${order.id.slice(-6).toUpperCase()}</span>
                                    <small class="text-muted">${order.created_at}</small>
                                </div>
                                <span class="fw-bold" style="color:var(--primary);">${order.total_price}</span>
                            </div>
                            
                            <!-- LIVE TRACKING UI -->
                            ${status !== 'cancelled' ? `
                            <div class="tracker-steps mt-3 mb-3">
                                <div class="tracker-progress"></div>
                                <div class="tracker-step ${activeStep >= 1 ? (activeStep > 1 ? 'done' : 'active') : ''}">
                                    <div class="tracker-icon"><i class="fas fa-check"></i></div>
                                    <div class="tracker-label">Order Placed</div>
                                </div>
                                <div class="tracker-step ${activeStep >= 2 ? (activeStep > 2 ? 'done' : 'active') : ''}">
                                    <div class="tracker-icon"><i class="fas fa-mug-hot"></i></div>
                                    <div class="tracker-label">Brewing</div>
                                </div>
                                <div class="tracker-step ${activeStep >= 3 ? (activeStep > 3 ? 'done' : 'active') : ''}">
                                    <div class="tracker-icon"><i class="fas fa-motorcycle"></i></div>
                                    <div class="tracker-label">On The Way</div>
                                </div>
                                <div class="tracker-step ${activeStep >= 4 ? 'done' : ''}">
                                    <div class="tracker-icon"><i class="fas fa-home"></i></div>
                                    <div class="tracker-label">Delivered</div>
                                </div>
                            </div>
                            ` : `<div class="alert alert-danger p-2 mb-3 mt-2"><small><i class="fas fa-times-circle"></i> This order was cancelled.</small></div>`}

                            <div class="small mb-3" style="color: var(--dark);">
                                <strong>Items:</strong> ${order.items ? order.items.map(i => i.quantity + 'x ' + (i.product ? i.product.name : 'Unknown')).join(', ') : 'No items found'}
                            </div>
                            <button class="btn btn-sm btn-outline-dark w-100" onclick="reorder('${order.id}', this)">
                                <i class="fas fa-redo-alt me-1"></i> Reorder Items
                            </button>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(err => console.error(err));
        }
        
        function reorder(id, btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding to cart...';
            
            fetch(`/api/v1/orders/${id}/reorder`, {
                method: 'POST',
                headers: getHeaders()
            })
            .then(res => res.json())
            .then(data => {
                btn.innerHTML = '<i class="fas fa-check text-success"></i> Added!';
                if (typeof updateGlobalCartCount === 'function') {
                    // Slight delay then update cart count
                    setTimeout(updateGlobalCartCount, 500);
                }
                setTimeout(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-redo-alt me-1"></i> Reorder Items';
                }, 2000);
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = 'Error. Try again';
            });
        }
        
        // Rewards Logic
        document.querySelector('[data-cm-target="rewardsModal"]').addEventListener('click', function() {
            fetchPoints();
        });
        
        function fetchPoints() {
            fetch('/api/v1/rewards/points', { headers: getHeaders() })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('rewardPtsDisplay').textContent = data.points;
                }
            })
            .catch(err => console.error(err));
        }

        function redeemReward(points) {
            const successMsg = document.getElementById('redeemSuccessMsg');
            const errorMsg = document.getElementById('redeemErrorMsg');
            
            successMsg.style.display = 'none';
            errorMsg.style.display = 'none';
            
            fetch('/api/v1/rewards/redeem', {
                method: 'POST',
                headers: getHeaders(),
                body: JSON.stringify({ points: points })
            })
            .then(res => res.json().then(data => ({status: res.status, body: data})))
            .then(res => {
                if (res.status === 200 && res.body.status === 'success') {
                    successMsg.textContent = res.body.message;
                    successMsg.style.display = 'block';
                    document.getElementById('rewardPtsDisplay').textContent = res.body.points;
                } else {
                    errorMsg.textContent = res.body.message || 'Error redeeming reward.';
                    errorMsg.style.display = 'block';
                }
            })
            .catch(err => {
                errorMsg.textContent = 'Network error.';
                errorMsg.style.display = 'block';
            });
        }
      </script>
@endauth
   </body>
</html>
