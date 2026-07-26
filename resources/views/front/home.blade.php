@extends('front.layouts.app')

@section('content')
    <!-- ============================================================
             HERO
             ============================================================ -->
    <section id="hero">
        <div class="hs hs1"></div>
        <div class="hs hs2"></div>
        <div class="container">
            <div class="row align-items-center g-4 hero-row">
                <div class="col-lg-6 col-12">
                    <div class="hbadge" data-aos="fade-down" data-aos-delay="100">
                        <div class="hbi"><i class="fas fa-mug-hot"></i></div>
                        <span>Cozy coffee house • Freshly brewed every morning</span>
                    </div>
                    <h1 class="htitle" data-aos="fade-up" data-aos-delay="200">Freshly Brewed <span class="hl">Coffee</span><br />and Cozy Vibes</h1>
                    <p class="hdesc" data-aos="fade-up" data-aos-delay="300">From velvety lattes and bright matcha to refreshing juices and smoothies, every cup is
                        made for your slow moments and sweet cravings.</p>
                    <div class="d-flex flex-wrap gap-3 mb-2" data-aos="fade-up" data-aos-delay="400">
                        <a href="#menu" class="btn-red"><i class="fas fa-coffee"></i>Explore Menu</a>
                    </div>
                    <div class="hstats d-flex gap-3 flex-wrap mt-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="hstat"><span class="snum">850<em>+</em></span><small>Happy Guests</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">90<em>+</em></span><small>Drinks</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">12<em>+</em></span><small>Expert Baristas</small></div>
                        <div class="sdiv"></div>
                        <div class="hstat"><span class="snum">8<em>yr</em></span><small>Crafting Coffee</small></div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left" data-aos-delay="250">
                    <div style="position:relative;text-align:center; max-width: 100%;">
                        <div class="hcircle" data-aos="fade-left" data-aos-delay="350">
                            <img src="{{ asset('front/photos/coffee/hot latte.jpg') }}" alt="Latte" />
                        </div>
                        <div class="fcard fc1" data-aos="fade-down" data-aos-delay="450">
                            <div class="fcoi r"><i class="fas fa-fire"></i></div>
                            <div><span class="fcnum">Hot Deal</span><span class="fcsm">30% off today</span></div>
                        </div>
                        <div class="fcard fc2" data-aos="fade-left" data-aos-delay="550">
                            <div class="fcoi y"><i class="fas fa-star"></i></div>
                            <div><span class="fcnum">4.9/5</span><span class="fcsm">2k+ reviews</span></div>
                        </div>
                        <div class="fcard fc3" data-aos="fade-up" data-aos-delay="650">
                            <div class="fcoi g"><i class="fas fa-clock"></i></div>
                            <div><span class="fcnum">20 min</span><span class="fcsm">Fast delivery</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MARQUEE -->
    <div class="mqsec">
        <div class="mqtrack">
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Espresso</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Signature Latte</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Matcha Magic</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Berry Refreshers</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Mango Smoothies</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Juice</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Cozy Morning Brew</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Espresso</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Signature Latte</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Matcha Magic</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Berry Refreshers</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Mango Smoothies</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Fresh Juice</div>
            <div class="mqitem"><i class="fas fa-circle"></i>Cozy Morning Brew</div>
        </div>
    </div>
    <!-- CATEGORY -->
    <section id="category">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">What We Offer</span>
                <h2 class="stitle">Browse by <span>Category</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">From velvety coffee to bright matcha and fresh juices,
                    find your favorite sip in our cafe menu.</p>
            </div>
            <div class="row g-2 g-sm-3 justify-content-center">
                <div class="col-4 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="0">
                    <div class="catcard active" data-filter="all">
                        <img class="catimg" src="{{ asset('front/photos/coffee/coffee cate.jpg') }}" alt="" />
                        <div class="catnm">All Drinks</div>
                        <div class="catct">{{ $products->count() }} favorites</div>
                    </div>
                </div>
                @foreach ($categories as $category)
                    <div class="col-4 col-sm-4 col-md-3 col-lg-2" data-aos="zoom-in" data-aos-delay="70">
                        <div class="catcard" data-filter="{{ strtolower($category->name) }}">
                            <img class="catimg"
                                src="{{ $category->image ? asset($category->image) : asset('front/photos/coffee/esspresso.jpg') }}"
                                alt="{{ $category->name }}" />
                            <div class="catnm">{{ $category->name }}</div>
                            <div class="catct">{{ $category->products_count ?? 0 }} items</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 col-12" data-aos="fade-right">
                    <div class="astack">
                        <div class="aexp"><span class="anum">12+</span><small>Years of<br />Coffee Craft</small></div>
                        <div class="amain"><img src="{{ asset('front/photos/coffee/hot coffee category .jpg') }}"
                                alt="Cafe interior" /></div>
                        <div class="asm"><img src="{{ asset('front/photos/coffee/iced coffee category .jpg') }}"
                                alt="Coffee drinks" /></div>
                    </div>
                </div>
                <div class="col-lg-7 col-12" data-aos="fade-left">
                    <span class="slbl">Our Story</span>
                    <h2 class="stitle text-start">We Invite You to Visit<br />Our <span>Cozy Cafe</span></h2>
                    <div class="sline lft"></div>
                    <p class="sdesc mb-4">Sip & Snug Cafe began as a warm corner spot for coffee lovers, now it is the
                        place for handcrafted drinks, fresh juices and sweet treats shared with friends and neighbors.</p>
                    <div class="mb-4">
                        <div class="fti">
                            <div class="ftico r"><i class="fas fa-leaf"></i></div>
                            <div>
                                <h6>Freshly Crafted Daily</h6>
                                <p>Every cup is prepared with fresh ingredients and a little extra care for your favorite
                                    daily ritual.</p>
                            </div>
                        </div>
                        <div class="fti">
                            <div class="ftico y"><i class="fas fa-award"></i></div>
                            <div>
                                <h6>Signature Drinks</h6>
                                <p>From smooth espresso to vibrant matcha and fruity refreshers, our menu is designed to
                                    delight.</p>
                            </div>
                        </div>
                        <div class="fti">
                            <div class="ftico g"><i class="fas fa-mug-hot"></i></div>
                            <div>
                                <h6>Warm Atmosphere</h6>
                                <p>Come for the coffee, stay for the comfort, the conversation and the cozy corners.</p>
                            </div>
                        </div>
                    </div>
                    <a href="#menu" class="btn-red"><i class="fas fa-book-open"></i>View Full Menu</a>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================
             MENU � FIX 3 (filter works) + FIX 4 (plus opens popup)
             ============================================================ -->
    <section id="menu">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">What's Brewing</span>
                <h2 class="stitle">Our Cozy <span>Cafe Menu</span></h2>
                <div class="sline"></div>
            </div>
            <div class="text-center mb-4" data-aos="fade-up">
                <button class="filtbtn {{ request('category', 'all') === 'all' ? 'active' : '' }}"
                    data-f="all">All</button>
                @foreach ($categories as $category)
                    <button
                        class="filtbtn {{ strtolower(request('category')) === strtolower($category->name) ? 'active' : '' }}"
                        data-f="{{ strtolower($category->name) }}">{{ $category->name }}</button>
                @endforeach
            </div>
            <div class="row g-2 g-sm-4" id="mgrid">
                @foreach ($products as $product)
                    <div class="col-6 col-md-6 col-lg-4 mwrap"
                        data-c="{{ strtolower($product->subcategory->category->name ?? 'uncategorized') }}"
                        data-aos="fade-up">
                        <div class="mcard" data-id="{{ $product->id }}"
                            data-img="{{ $product->image ? asset($product->image) : asset('front/photos/coffee/esspresso.jpg') }}"
                            data-title="{{ $product->name }}"
                            data-cat="{{ $product->subcategory->category->name ?? 'Uncategorized' }}"
                            data-price="EGP {{ number_format($product->effective_price, 2) }}"
                            data-old="{{ $product->discount_price ? 'EGP ' . number_format($product->price, 2) : '' }}" 
                            data-rating="{{ number_format($product->average_rating, 1) }}"
                            data-reviews="{{ $product->reviews_count }}" 
                            data-cal="{{ $product->calories ?? 180 }}" 
                            data-time="{{ $product->prep_time ?? 5 }}" 
                            data-desc="{{ $product->description }}"
                            data-tags="{{ $product->is_bestseller ? 'Bestseller,' : '' }}{{ $product->is_featured ? 'Hot' : '' }}"
                            data-addons="{{ json_encode($product->applicableAddOns()) }}">
                            <div class="mimg">
                                <img src="{{ $product->image ? asset($product->image) : asset('front/photos/coffee/esspresso.jpg') }}"
                                    alt="{{ $product->name }}" loading="lazy" />
                                @if ($product->is_featured)
                                    <div class="mbdg hot"><i class="fas fa-star"></i> Hot</div>
                                @endif
                                @auth
                                    <div class="mhrt fav-toggle-btn" data-id="{{ $product->id }}">
                                        <i
                                            class="{{ Auth::user()->favorites->contains($product->id) ? 'fas' : 'far' }} fa-heart"></i>
                                    </div>
                                @else
                                    <div class="mhrt" onclick="window.location.href='{{ route('login') }}'">
                                        <i class="far fa-heart"></i>
                                    </div>
                                @endauth
                            </div>
                            <div class="mbody">
                                <div class="mcat">{{ $product->subcategory->category->name ?? 'Uncategorized' }}</div>
                                <div class="mtit">{{ $product->name }}</div>
                                <div class="mdesc">{{ Str::limit($product->description, 50) }}</div>
                                <div class="mfoot">
                                    <div>
                                        <div class="mprice">EGP {{ number_format($product->effective_price, 2) }} 
                                            @if($product->discount_price)
                                                <small>EGP {{ number_format($product->price, 2) }}</small>
                                            @endif
                                        </div>
                                        <div class="mstars"><i class="fas fa-star"></i> <span
                                                style="color:#bbb;font-size:.7rem;">({{ $product->reviews_count }})</span></div>
                                    </div>
                                    <button class="madd" title="View Details"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center custom-pagination">
                {{ $products->links() }}
            </div>
            <style>
                .custom-pagination .pagination {
                    gap: 10px;
                    align-items: center;
                }

                .custom-pagination .page-link {
                    color: #e8281a;
                    border-radius: 50px !important;
                    padding: 10px 24px;
                    border: none;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
                    font-weight: 600;
                    transition: all 0.3s ease;
                }

                .custom-pagination .page-item.active .page-link,
                .custom-pagination .page-link:hover {
                    background: linear-gradient(135deg, #e8281a, #c01e12);
                    color: #fff;
                    box-shadow: 0 8px 20px rgba(232, 40, 26, 0.3);
                    transform: translateY(-2px);
                }

                .custom-pagination .page-item.disabled .page-link {
                    color: #999;
                    background: #f8f9fa;
                    box-shadow: none;
                    transform: none;
                }

                .custom-pagination p.text-muted {
                    display: none;
                }

                /* Hide 'Showing X to Y' text */
            </style>
        </div>
    </section>


    <!-- ============================================================
             FIX 4 � MENU DETAIL POPUP MODAL
             ============================================================ -->
    <div id="menuPop">
        <div class="mpbox">
            <button class="mpclose" id="mpClose"><i class="fas fa-times"></i></button>
            <div class="mpimg"><img id="mpImg" src="" alt="" /></div>
            <div class="mpbody">
                <div id="mpCat"></div>
                <div id="mpTitle"></div>
                <div id="mpStars"></div>
                <div id="mpDesc"></div>
                <div id="mpPrice"></div>
                <div class="mpmeta" id="mpMeta"></div>
                <div class="mpqty">
                    <button class="mpqbtn" id="mpMinus">-</button>
                    <span class="mpqnum" id="mpQnum">1</span>
                    <button class="mpqbtn" id="mpPlus">+</button>
                    <span style="font-size:.82rem;color:#aaa;margin-left:9px;">portion</span>
                </div>
                <div class="mptags" id="mpTags"></div>
                
                @auth
                    @if(Auth::user()->role !== 'admin')
                        <div id="reviewSection" style="margin-top: 15px; margin-bottom: 15px; background: #f9f9f9; padding: 12px; border-radius: 8px;">
                            <h6 style="margin-bottom:8px;font-weight:600;font-size:.9rem;">Rate this Product</h6>
                            <div class="d-flex align-items-center mb-2" id="starRatingSystem">
                                <i class="far fa-star rating-star" data-val="1" style="cursor:pointer; color:#ffd700; font-size:1.2rem; margin-right:3px;"></i>
                                <i class="far fa-star rating-star" data-val="2" style="cursor:pointer; color:#ffd700; font-size:1.2rem; margin-right:3px;"></i>
                                <i class="far fa-star rating-star" data-val="3" style="cursor:pointer; color:#ffd700; font-size:1.2rem; margin-right:3px;"></i>
                                <i class="far fa-star rating-star" data-val="4" style="cursor:pointer; color:#ffd700; font-size:1.2rem; margin-right:3px;"></i>
                                <i class="far fa-star rating-star" data-val="5" style="cursor:pointer; color:#ffd700; font-size:1.2rem; margin-right:3px;"></i>
                                <span id="ratingValue" style="margin-left:8px; font-weight:bold; font-size:0.9rem;">0</span>
                            </div>
                            <button id="submitReviewBtn" class="btn btn-sm text-white w-100 mt-1" style="background:var(--primary); font-size:0.8rem;">Submit Rating</button>
                        </div>
                    @endif
                @endauth

                <div class="mpaddons" id="mpAddOns" style="margin-top: 15px; margin-bottom: 15px;">
                    <h6 style="margin-bottom:10px;font-weight:600;font-size:.9rem;">Extras & Add-Ons</h6>
                    @if (isset($addOns) && $addOns->count() > 0)
                        @foreach ($addOns as $addon)
                            <div class="form-check" style="font-size: 0.85rem; margin-bottom: 5px;">
                                <input class="form-check-input mp-addon-checkbox" type="checkbox"
                                    value="{{ $addon->id }}" id="addon-{{ $addon->id }}"
                                    data-addon-id="{{ $addon->id }}" data-addon-name="{{ $addon->name }}"
                                    data-addon-price="{{ $addon->price_adjustment }}">
                                <label class="form-check-label d-flex justify-content-between w-100"
                                    for="addon-{{ $addon->id }}" style="cursor: pointer;">
                                    <span style="text-transform: capitalize;">{{ $addon->name }}</span>
                                    <span style="color: var(--secondary); font-weight: 600;">+EGP
                                        {{ number_format($addon->price_adjustment, 2) }}</span>
                                </label>
                            </div>
                        @endforeach
                    @else
                        <p style="font-size: 0.8rem; color: #888;">No extras available.</p>
                    @endif
                </div>
                <button class="mpaddcart" id="mpAddCart"><i class="fas fa-shopping-cart"></i>Add to Cart</button>
            </div>
        </div>
    </div>
    <!-- SPECIAL OFFER -->
    <section id="special">
        <div class="spbg"></div>
        <div class="container" style="position:relative;z-index:2;">
            <div class="row align-items-center g-4">
                <div class="col-lg-6 col-12 text-lg-start text-center" data-aos="fade-right">
                    <div class="sptag"><i class="fas fa-bolt me-1"></i>Limited Time Offer</div>
                    <h2 class="sptitle">Get 20% Off<br />Our Seasonal<br /><span>Latte</span> Special</h2>
                    <p class="spdesc">Don't miss our weekend treat - enjoy a creamy honey latte, a fresh pastry and a cozy
                        corner table at a sweet price.</p>
                    <div class="cdwrap justify-content-center justify-content-lg-start">
                        <div class="cditem"><span class="cdnum" id="cdH">08</span><span
                                class="cdlbl">Hours</span></div>
                        <div class="cditem"><span class="cdnum" id="cdM">45</span><span
                                class="cdlbl">Minutes</span></div>
                        <div class="cditem"><span class="cdnum" id="cdS">30</span><span
                                class="cdlbl">Seconds</span></div>
                    </div>
                    <a href="#menu" class="btn-red"><i class="fas fa-shopping-cart"></i>Grab the Deal</a>
                </div>
                <div class="col-lg-6 col-10 offset-1 offset-lg-0 mx-auto mx-lg-0" data-aos="fade-left">
                    <div class="spimgw">
                        <div class="spglow"></div>
                        <div class="sppbdg"><span class="old">$6.20</span><span class="np">$4.95</span></div>
                        <img src="{{ asset('front/photos/coffee/hot dark mocha.jpg') }}" alt="Latte special" />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================================
             GALLERY � FIX 7 (click opens detail popup)
             ============================================================ -->
    <section id="gallery">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Cafe Showcase</span>
                <h2 class="stitle">Let's See Our <span>Cafe Favorites</span></h2>
                <div class="sline"></div>
            </div>
            <div class="ggrid" data-aos="fade-up">
                <div class="gitem" data-gi="0" data-gimg="{{ asset('front/photos/coffee/hot latte.jpg') }}"
                    data-gtitle="Signature Latte"
                    data-gdesc="Creamy espresso and steamed milk topped with comfort in every sip.">
                    <img src="{{ asset('front/photos/coffee/hot latte.jpg') }}" alt="Latte" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Signature Latte</span></div>
                </div>
                <div class="gitem" data-gi="1" data-gimg="{{ asset('front/photos/matcha/pink matcha.jpg') }}"
                    data-gtitle="Pink Matcha"
                    data-gdesc="A colorful and refreshing matcha made for bright afternoons and Instagram moments.">
                    <img src="{{ asset('front/photos/matcha/pink matcha.jpg') }}" alt="Matcha" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Pink Matcha</span></div>
                </div>
                <div class="gitem" data-gi="2"
                    data-gimg="{{ asset('front/photos/fresh juice/Beet-Apple Juice.jpg') }}" data-gtitle="Fresh Juice"
                    data-gdesc="Cold-pressed blends packed with natural sweetness and vibrant color.">
                    <img src="{{ asset('front/photos/fresh juice/Beet-Apple Juice.jpg') }}" alt="Juice" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Fresh Juice</span></div>
                </div>
                <div class="gitem" data-gi="3" data-gimg="{{ asset('front/photos/refreshers/mojito.jpg') }}"
                    data-gtitle="Refreshing Mojito"
                    data-gdesc="A bright iced refresher with tropical notes that feel like summer in a glass.">
                    <img src="{{ asset('front/photos/refreshers/mojito.jpg') }}" alt="Refresher" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Refreshing Mojito</span></div>
                </div>
                <div class="gitem" data-gi="4" data-gimg="{{ asset('front/photos/smoothies/berry.jpg') }}"
                    data-gtitle="Berry Smoothie"
                    data-gdesc="A creamy smoothie made with fresh berries and a soft, sweet finish.">
                    <img src="{{ asset('front/photos/smoothies/berry.jpg') }}" alt="Smoothie" />
                    <div class="gover"><span><i class="fas fa-expand-alt"></i> Berry Smoothie</span></div>
                </div>
            </div>
        </div>
    </section>
    <!-- FIX 7 � GALLERY POPUP -->
    <div id="galPop">
        <div class="gpbox">
            <button class="gpclose" id="gpClose"><i class="fas fa-times"></i></button>
            <img id="gpImg" src="" alt="" />
            <div class="gpcap">
                <h5 id="gpTitle"></h5>
                <p id="gpDesc"></p>
            </div>
            <div class="gpnav">
                <button id="gpPrev"><i class="fas fa-chevron-left me-1"></i>Prev</button>
                <button id="gpNext">Next <i class="fas fa-chevron-right ms-1"></i></button>
            </div>
        </div>
    </div>


    <!-- ============================================================
             HISTORY � FIX 8 (alternating left/right text)
             ============================================================ -->
    <section id="history">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Our Journey</span>
                <h2 class="stitle">A History of <span>Our Cafe</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">From a small coffee corner to a favorite cozy spot for
                    drinks, conversation and warm mornings.</p>
            </div>
            <div class="timeline" data-aos="fade-up">
                <!-- ODD ? text on LEFT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2012</div>
                        <h5>Birth of a Coffee Corner</h5>
                        <p>Sip & Snug opens its first cozy coffee corner on Nasrcity, EG , where neighbors meet for
                            espresso, fresh juice and warm conversation.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2012</div>
                        <h5>Birth of a Coffee Corner</h5>
                        <p>Sip & Snug opens its first cozy coffee corner on Nasrcity, EG, where neighbors meet for espresso,
                            fresh juice and warm conversation.</p>
                    </div>
                </div>
                <!-- EVEN ? text on RIGHT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2015</div>
                        <h5>Crafted Drinks &amp; Cozy Vibes</h5>
                        <p>We expanded the menu with signature lattes, bright matcha and fresh refreshers, turning our cafe
                            into a place to slow down and enjoy.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2015</div>
                        <h5>Crafted Drinks &amp; Cozy Vibes</h5>
                        <p>We expanded the menu with signature lattes, bright matcha and fresh refreshers, turning our cafe
                            into a place to slow down and enjoy.</p>
                    </div>
                </div>
                <!-- ODD ? text on LEFT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2019</div>
                        <h5>Modern Cafe Origins</h5>
                        <p>We launched a signature line of cold brews, smoothies and fresh juices that paired beautifully
                            with our warm atmosphere and quick service.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2019</div>
                        <h5>Modern Cafe Origins</h5>
                        <p>We launched a signature line of cold brews, smoothies and fresh juices that paired beautifully
                            with our warm atmosphere and quick service.</p>
                    </div>
                </div>
                <!-- EVEN ? text on RIGHT -->
                <div class="tli">
                    <div class="tl-left">
                        <div class="tlyear">2026</div>
                        <h5>Growing with the Community</h5>
                        <p>Now welcoming guests across the city with warm service, handmade drinks and a menu that keeps
                            getting better every season.</p>
                    </div>
                    <div class="tl-center">
                        <div class="tldot"></div>
                    </div>
                    <div class="tl-right">
                        <div class="tlyear">2026</div>
                        <h5>Growing with the Community</h5>
                        <p>Now welcoming guests across the city with warm service, handmade drinks and a menu that keeps
                            getting better every season.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CHEFS -->
    <section id="chefs">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">The Coffee Team</span>
                <h2 class="stitle">Meet Our Expert <span>Baristas</span></h2>
                <div class="sline"></div>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('front/photos/baristas/anna.jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">Anna Mortal</div>
                            <div class="chrole">Head Barista</div>
                            <div class="chexp">6 years experience</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="80">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('front/photos/baristas/Michael.jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">Michael Corn</div>
                            <div class="chrole">Coffee Specialist</div>
                            <div class="chexp">5 years experience</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="160">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('front/photos/baristas/Faz .jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">Faz Chowdel</div>
                            <div class="chrole">Matcha Artist</div>
                            <div class="chexp">10 years experience</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="240">
                    <div class="chcard">
                        <div class="chimg">
                            <img src="{{ asset('front/photos/baristas/William.jpg') }}" alt="" />
                            <div class="chsoc"><a href="#"><i class="fab fa-instagram"></i></a><a
                                    href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                                        class="fab fa-twitter"></i></a></div>
                        </div>
                        <div class="chbody">
                            <div class="chnm">William Latnum</div>
                            <div class="chrole">Smoothie Creator</div>
                            <div class="chexp">4 years experience</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- HOURS -->
    <section id="hours">
        <div class="hrsbg"></div>
        <div class="container" style="position:relative;z-index:2;">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl" style="color:#a5d6bc;">Opening Hours</span>
                <h2 class="stitle" style="color:#fff;">We're Open <span style="color:var(--secondary);">For You</span>
                </h2>
                <div class="sline"></div>
            </div>
            <div class="row g-4 align-items-start">
                <div class="col-lg-5 col-12" data-aos="fade-right">
                    <div class="hrscard">
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Monday - Tuesday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot off"></div>
                                <span class="hrstime" style="color:#ff6b6b;">Closed</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Wednesday - Thursday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">09:00 AM - 10:00 PM</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Friday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">09:00 AM - 11:00 PM</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Saturday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">10:00 AM - 11:30 PM</span>
                            </div>
                        </div>
                        <div class="hrsrow">
                            <span class="hrsday"><i class="fas fa-calendar-day me-2"
                                    style="color:var(--secondary);"></i>Sunday</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="hdot on"></div>
                                <span class="hrstime">11:00 AM - 09:00 PM</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 col-sm-6" data-aos="zoom-in">
                    <div class="hrscta">
                        <i class="fas fa-truck-fast fa-2x mb-3" style="color:rgba(255,255,255,.8);"></i>
                        <h4>Order Online</h4>
                        <p>Get hot food delivered in 25 minutes</p>
                        <a href="#menu" class="btnw">Order Now ?</a>
                    </div>
                </div>
                <div class="col-lg-4 col-12" data-aos="fade-left">
                    <div class="hrscard">
                        <h5
                            style="color:#fff;margin-bottom:18px;font-family:'Poppins',sans-serif;font-size:.95rem;font-weight:700;">
                            <i class="fas fa-map-marker-alt me-2" style="color:var(--secondary);"></i>Find Us</h5>
                        <div class="hrsrow"><span class="hrsday"><i class="fas fa-location-dot me-2"
                                    style="color:var(--secondary);"></i>Address</span><span class="hrstime"
                                style="font-size:.8rem;">Nasrcity, EG</span></div>
                        <div class="hrsrow"><span class="hrsday"><i class="fas fa-phone me-2"
                                    style="color:var(--secondary);"></i>Phone</span><span class="hrstime"
                                style="font-size:.8rem;">19696</span></div>
                        <div class="hrsrow"><span class="hrsday"><i class="fas fa-envelope me-2"
                                    style="color:var(--secondary);"></i>Gmail</span><span class="hrstime"
                                style="font-size:.8rem;">SipnSnug@gmail.com</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- TESTIMONIALS -->
    <section id="testimonials">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">What People Say</span>
                <h2 class="stitle">Our Customers <span>Feedback</span></h2>
                <div class="sline"></div>
            </div>
            <div class="swiper tesSwiper" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">The honey latte is the perfect comfort drink. It is cozy, smooth and exactly
                                what I want on a slow morning.</p>
                            <div class="tesauth">
                                <img src="{{ asset('front/photos/blogs/monica.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">Monica Wilber</div>
                                    <div class="tesrl">Regular Customer</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">The delivery was quick and the drinks arrived fresh and perfectly chilled.
                                Sip & Snug has become my go-to comfort spot without question.</p>
                            <div class="tesauth">
                                <img src="{{ asset('front/photos/blogs/cameron.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">Cameron Fox</div>
                                    <div class="tesrl">Food Blogger</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">The matcha here is so fresh and balanced. The ambiance is calm and beautiful,
                                and the staff always make you feel welcome.</p>
                            <div class="tesauth">
                                <img src="{{ asset('front/photos/blogs/priya.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">Priya Sharma</div>
                                    <div class="tesrl">Food Enthusiast</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="tescard">
                            <div class="tesq">"</div>
                            <div class="tess"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <p class="testxt">We ordered fresh juices and smoothies for our office meeting and everything
                                was perfect. Bright, tasty and beautifully presented.</p>
                            <div class="tesauth">
                                <img src="{{ asset('front/photos/blogs/david.jpg') }}" alt="" />
                                <div>
                                    <div class="tesnm">David Park</div>
                                    <div class="tesrl">Corporate Client</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination mt-4" style="position:static;"></div>
            </div>
        </div>
    </section>

    <!-- RESERVATION FORM -->
    <section id="reservation">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Book a Table</span>
                <h2 class="stitle">Make a <span>Reservation</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Reserve your table for a memorable dining experience. We
                    recommend booking 24 hours in advance for weekend evenings.</p>
            </div>
            <div class="row g-4 align-items-start">
                <!-- Reservation Form (First on Mobile, Second on Desktop) -->
                <div class="col-lg-8 col-12 order-1 order-lg-2" data-aos="fade-left">
                    <div class="fcard">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="flbl">Full Name *</label>
                                <input type="text" class="fctrl" placeholder="John Doe" />
                            </div>
                            <div class="col-6">
                                <label class="flbl">Phone *</label>
                                <input type="tel" class="fctrl" placeholder="+20 100 000 0000" />
                            </div>
                            <div class="col-6">
                                <label class="flbl">Email *</label>
                                <input type="email" class="fctrl" placeholder="john@gmail.com" />
                            </div>
                            <div class="col-6">
                                <label class="flbl">Guests *</label>
                                <select class="fctrl">
                                    <option>1 Person</option>
                                    <option>2 People</option>
                                    <option>3 - 4 People</option>
                                    <option>5 - 6 People</option>
                                    <option>7 - 10 People</option>
                                    <option>10+ People</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="flbl">Date *</label>
                                <input type="date" class="fctrl" />
                            </div>
                            <div class="col-12">
                                <label class="flbl">Time *</label>
                                <select class="fctrl">
                                    <option>09:00 AM</option>
                                    <option>10:00 AM</option>
                                    <option>11:00 AM</option>
                                    <option>12:00 PM</option>
                                    <option>01:00 PM</option>
                                    <option>02:00 PM</option>
                                    <option>06:00 PM</option>
                                    <option>07:00 PM</option>
                                    <option>08:00 PM</option>
                                    <option>09:00 PM</option>
                                    <option>10:00 PM</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="flbl">Special Requests</label>
                                <textarea class="fctrl" rows="2" placeholder="Allergies, dietary needs, special occasions..."></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn-red w-100 justify-content-center" id="resBtn">
                                    <i class="fas fa-calendar-check me-2"></i>Confirm Reservation
                                </button>
                            </div>
                        </div>
                        <div class="sucmsg" id="resOk">
                            <i class="fas fa-check-circle"></i>
                            <p>Table reserved! We'll confirm via email shortly.</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Card (Second on Mobile, First on Desktop) -->
                <div class="col-lg-4 col-12 order-2 order-lg-1" data-aos="fade-right">
                    <div style="background:var(--dark);border-radius:18px;padding:28px 24px;">
                        <h4 style="color:#fff;font-size:1.2rem;margin-bottom:6px;">Contact Info</h4>
                        <p style="color:rgba(255,255,255,.55);font-size:.82rem;margin-bottom:20px;">We're happy to help you plan the perfect dining experience.</p>
                        <div class="row g-3">
                            <div class="col-6 col-lg-12">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1rem;flex-shrink:0;">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div>
                                        <strong style="display:block;color:#ccc;font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;">Opening Hours</strong>
                                        <span style="color:#fff;font-size:.8rem;">Wed - Sun: 9AM - 11PM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-12">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1rem;flex-shrink:0;">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div>
                                        <strong style="display:block;color:#ccc;font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;">Call for Booking</strong>
                                        <span style="color:#fff;font-size:.8rem;">19696</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-12">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1rem;flex-shrink:0;">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div>
                                        <strong style="display:block;color:#ccc;font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;">Group Dining</strong>
                                        <span style="color:#fff;font-size:.8rem;">Special menus 10+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-12">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:38px;height:38px;border-radius:10px;background:rgba(232,40,26,.2);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1rem;flex-shrink:0;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <strong style="display:block;color:#ccc;font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;">Location</strong>
                                        <span style="color:#fff;font-size:.8rem;">Nasrcity, EG</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG -->
    <section id="blog">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">News &amp; Updates</span>
                <h2 class="stitle">Our Latest <span>Blog</span> Posts</h2>
                <div class="sline"></div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('front/photos/blog posts/healthy.jpg') }}" alt="" />
                            <div class="bldatebdg"><span class="bd">14</span><span class="bm">Mar</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Food &amp; Health</div>
                            <div class="bltit"><a href="#">Healthy Cafe Drinks: A Myth or a Beautiful Reality</a>
                            </div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>James Writer</span><span><i
                                        class="fas fa-comment"></i>24 Comments</span></div>
                            <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="80">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('front/photos/blog posts/cafe culture.jpg') }}" alt="" />
                            <div class="bldatebdg"><span class="bd">28</span><span class="bm">Feb</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Food Science</div>
                            <div class="bltit"><a href="#">Is Cafe Culture Getting Healthier? Here's What We
                                    Found</a></div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>Sarah Grain</span><span><i
                                        class="fas fa-comment"></i>18 Comments</span></div>
                            <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="160">
                    <div class="blcard">
                        <div class="blimg">
                            <img src="{{ asset('front/photos/blog posts/homemade.jpg') }}" alt="" />
                            <div class="bldatebdg"><span class="bd">05</span><span class="bm">Jan</span></div>
                        </div>
                        <div class="blbody">
                            <div class="bltag">Recipes</div>
                            <div class="bltit"><a href="#">Creative Homemade Coffee Recipes to Try This Weekend</a>
                            </div>
                            <div class="blmeta"><span><i class="fas fa-user"></i>Barista Marcus</span><span><i
                                        class="fas fa-comment"></i>32 Comments</span></div>
                            <a href="#" class="blmore">Read More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->
    <section id="newsletter">
        <div class="nlbg"></div>
        <div class="container">
            <div class="nlw text-center" data-aos="zoom-in">
                <span class="slbl" style="color:rgba(255,255,255,.7);">Stay Connected</span>
                <h2 class="mb-3" style="color:#fff;">Subscribe &amp; Get Exclusive <span
                        style="color:var(--secondary);">Deals</span></h2>
                <p class="mb-4" style="color:rgba(255,255,255,.78);">Get 15% off your first order plus early access to
                    new menu items</p>
                <div class="nl-form-wrap">
                    <input class="nlinput" type="email" id="nlEmail" placeholder="Enter your email address..." />
                    <button class="nlbtn" id="nlBtn"><i class="fas fa-paper-plane me-1"></i>Subscribe</button>
                </div>
                <p style="color:rgba(255,255,255,.45);font-size:.76rem;margin-top:11px;"><i
                        class="fas fa-lock me-1"></i>No spam, unsubscribe anytime.</p>
            </div>
        </div>
    </section>

    <!-- ============================================================
             FIX 6 � CONTACT FORM
             ============================================================ -->
    <section id="contact-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="slbl">Get In Touch</span>
                <h2 class="stitle">Contact <span>Us</span></h2>
                <div class="sline"></div>
                <p class="sdesc mx-auto" style="max-width:480px;">Have a question, feedback, or want to plan a special
                    event? We'd love to hear from you.</p>
            </div>
            <div class="row g-4">
                <!-- Contact Form (First on Mobile, Second on Desktop) -->
                <div class="col-lg-8 col-12 order-1 order-lg-2" data-aos="fade-left">
                    <div class="fcard">
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="flbl">Your Name *</label>
                                <input type="text" class="fctrl" placeholder="John Doe" />
                            </div>
                            <div class="col-6">
                                <label class="flbl">Email *</label>
                                <input type="email" class="fctrl" placeholder="john@gmail.com" />
                            </div>
                            <div class="col-6">
                                <label class="flbl">Phone Number</label>
                                <input type="tel" class="fctrl" placeholder="+20 100 000 0000" />
                            </div>
                            <div class="col-6">
                                <label class="flbl">Subject *</label>
                                <select class="fctrl">
                                    <option>General Inquiry</option>
                                    <option>Catering &amp; Events</option>
                                    <option>Feedback</option>
                                    <option>Partnership</option>
                                    <option>Media &amp; Press</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="flbl">Message *</label>
                                <textarea class="fctrl" rows="3" placeholder="Write your message here..."></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn-red w-100 justify-content-center" id="ctcBtn">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                        <div class="sucmsg" id="ctcOk">
                            <i class="fas fa-check-circle"></i>
                            <p>Message sent! We'll reply within 2 hours.</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info (Second on Mobile, First on Desktop) -->
                <div class="col-lg-4 col-12 order-2 order-lg-1" data-aos="fade-right">
                    <div class="ctdark">
                        <h4>Let's Talk</h4>
                        <p class="ctsub">We typically respond within 2 hours during business hours.</p>
                        <div class="row g-3 mb-3">
                            <div class="col-6 col-lg-12">
                                <div class="ctitem mb-0">
                                    <div class="cticon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="ctinfo"><strong>Address</strong><span>Nasr city, Cairo, EG</span></div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-12">
                                <div class="ctitem mb-0">
                                    <div class="cticon"><i class="fas fa-phone-alt"></i></div>
                                    <div class="ctinfo"><strong>Phone</strong><span>19696</span></div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-12">
                                <div class="ctitem mb-0">
                                    <div class="cticon"><i class="fas fa-envelope"></i></div>
                                    <div class="ctinfo"><strong>Email</strong><span>SipnSnug@gmail.com</span></div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-12">
                                <div class="ctitem mb-0">
                                    <div class="cticon"><i class="fas fa-clock"></i></div>
                                    <div class="ctinfo"><strong>Hours</strong><span>Wed-Sun: 9AM-11PM</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="ctsocrow mt-2">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuSection = document.getElementById('menu');

            menuSection.addEventListener('click', function(e) {
                // Check if clicked element is a pagination link
                const paginationLink = e.target.closest('.custom-pagination a');
                if (paginationLink) {
                    e.preventDefault(); // Prevent full page reload
                    const url = paginationLink.href;

                    // Optional: Show a loading state (opacity)
                    const productsGrid = menuSection.querySelector('.row.g-4:not(.mb-5)');
                    if (productsGrid) productsGrid.style.opacity = '0.5';

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            // Parse the fetched HTML
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            // Get the new menu section content
                            const newMenuContent = doc.getElementById('menu').innerHTML;

                            // Replace current menu section with new content
                            menuSection.innerHTML = newMenuContent;

                            // Re-bind Filter Buttons
                            menuSection.querySelectorAll('.filtbtn').forEach(function(btn) {
                                btn.addEventListener('click', function() {
                                    if (typeof filterMenu === 'function') filterMenu(
                                        this.getAttribute('data-f'));
                                });
                            });

                            // Re-bind Card Click
                            menuSection.querySelectorAll('.mcard').forEach(function(card) {
                                card.addEventListener('click', function() {
                                    if (typeof openMenuPop === 'function') openMenuPop(
                                        this);
                                });
                            });

                            // Re-bind Add Button (+)
                            menuSection.querySelectorAll('.madd').forEach(function(btn) {
                                btn.addEventListener('click', function(e) {
                                    e.stopPropagation();
                                    if (typeof openMenuPop === 'function') openMenuPop(
                                        this.closest('.mcard'));
                                });
                            });

                            // Re-bind Favorites Toggle
                            menuSection.querySelectorAll('.fav-toggle-btn').forEach(function(btn) {
                                // We clone the button to remove old listeners (if any) and attach the generic logic
                                // But since these are new DOM elements, we just attach it
                                btn.addEventListener("click", function(e) {
                                    e.preventDefault();
                                    e.stopPropagation();
                                    const btnEl = this;
                                    const productId = btnEl.getAttribute('data-id');
                                    const icon = btnEl.querySelector('i');

                                    if (!productId) return;

                                    btnEl.style.pointerEvents = 'none';
                                    btnEl.style.opacity = '0.5';

                                    fetch(`/favorites/toggle/${productId}`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document
                                                    .querySelector(
                                                        'meta[name="csrf-token"]')
                                                    .getAttribute('content')
                                            },
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                if (data.is_favorited) {
                                                    icon.classList.remove('far');
                                                    icon.classList.add('fas');
                                                    icon.style.color = '#dc3545';
                                                } else {
                                                    icon.classList.remove('fas');
                                                    icon.classList.add('far');
                                                    icon.style.color = '';
                                                }
                                            }
                                            btnEl.style.pointerEvents = 'auto';
                                            btnEl.style.opacity = '1';
                                        })
                                        .catch(error => {
                                            btnEl.style.pointerEvents = 'auto';
                                            btnEl.style.opacity = '1';
                                        });
                                });
                            });

                            // Smooth scroll to top of menu
                            menuSection.scrollIntoView({
                                behavior: 'smooth'
                            });

                            // Re-initialize AOS or other plugins if necessary
                            if (typeof AOS !== 'undefined') AOS.refresh();
                        });
                }
            });
        });
    </script>

@endsection
