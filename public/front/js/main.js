// Universal smooth AOS & Scroll Reveal Initializer
if (typeof AOS !== 'undefined') {
    AOS.init({
        duration: 750,
        once: true,
        offset: 35,
        easing: 'cubic-bezier(0.16, 1, 0.3, 1)',
        disable: false
    });
}

// Intersection Observer for smooth cascading Scroll Reveal
document.addEventListener('DOMContentLoaded', function() {
    var revealObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed', 'aos-animate');
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -30px 0px'
    });

    var targets = document.querySelectorAll('[data-aos], .snug-reveal, .snug-reveal-left, .snug-reveal-right, .snug-reveal-zoom, .catcard, .mwrap, .fti, .hstat, .gitem, .tli');
    targets.forEach(function(el, idx) {
        if (!el.hasAttribute('data-aos-delay') && !el.hasAttribute('data-delay')) {
            var delay = (idx % 6) * 60;
            el.style.transitionDelay = delay + 'ms';
        }
        revealObserver.observe(el);
    });
});

/* NAVBAR SCROLL & ACTIVE LINK  */
window.addEventListener('scroll', function() {
    document.getElementById('nav').classList.toggle('scrolled', window.scrollY > 60);
    document.getElementById('btt').classList.toggle('show', window.scrollY > 300);
    document.querySelectorAll('section[id]').forEach(function(sec) {
        var top = sec.offsetTop - 110,
            bot = top + sec.offsetHeight;
        if (window.scrollY >= top && window.scrollY < bot) {
            document.querySelectorAll('.nav-link').forEach(function(l) {
                l.classList.remove('active');
            });
            var lnk = document.querySelector('.nav-link[href="#' + sec.id + '"]');
            if (lnk) lnk.classList.add('active');
        }
    });
});

/*  SMOOTH SCROLL + MOBILE NAV CLOSE  */
document.querySelectorAll('a[href^="#"]').forEach(function(a) {
    a.addEventListener('click', function(e) {
        var href = this.getAttribute('href');
        if (href === '#') return;
        var t = document.querySelector(href);
        if (t) {
            e.preventDefault();
            // Close Bootstrap mobile navbar if open
            var navCollapse = document.getElementById('navmenu');
            if (navCollapse && navCollapse.classList.contains('show')) {
                var bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                } else {
                    navCollapse.classList.remove('show');
                }
            }
            // Scroll after slight delay to let navbar close
            setTimeout(function() {
                window.scrollTo({
                    top: t.offsetTop - 78,
                    behavior: 'smooth'
                });
            }, 50);
        }
    });
});


var searchOv = document.getElementById('searchOv');

document.getElementById('navSearchBtn').addEventListener('click', function() {
    searchOv.classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function() {
        document.getElementById('searchInput').focus();
    }, 220);
});

document.getElementById('searchClose').addEventListener('click', closeSearch);

// Close when clicking backdrop
searchOv.addEventListener('click', function(e) {
    if (e.target === searchOv) closeSearch();
});

function closeSearch() {
    searchOv.classList.remove('open');
    document.body.style.overflow = '';
}

// Category buttons inside search box
document.querySelectorAll('.sovcat').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.sovcat').forEach(function(b) {
            b.classList.remove('active');
        });
        this.classList.add('active');
        var f = this.getAttribute('data-cat');
        closeSearch();
        setTimeout(function() {
            filterMenu(f);
            document.getElementById('menu').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 300);
    });
});

// Trending tags fill the search input
document.querySelectorAll('.sovtrend .ttag').forEach(function(t) {
    t.addEventListener('click', function() {
        document.getElementById('searchInput').value = this.textContent.trim();
        document.getElementById('searchInput').focus();
    });
});

// Perform search from the input
var searchInput = document.getElementById('searchInput');
if (searchInput) {
    var searchSubmitBtn = searchInput.nextElementSibling;

    function execSearch() {
        var query = searchInput.value.trim();
        closeSearch();

        setTimeout(function() {
            var url = new URL(window.location.href);
            if (query) {
                url.searchParams.set('search', query);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.set('page', 1);

            var menuSection = document.getElementById('menu');
            if (!menuSection) {
                window.location.href = '/?search=' + encodeURIComponent(query) + '#menu';
                return;
            }

            var productsGrid = menuSection.querySelector('.row.g-4:not(.mb-5)');
            if (productsGrid) productsGrid.style.opacity = '0.5';

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, 'text/html');
                    var newMenuContent = doc.getElementById('menu').innerHTML;
                    menuSection.innerHTML = newMenuContent;

                    menuSection.querySelectorAll('.filtbtn').forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            filterMenu(this.getAttribute('data-f'));
                        });
                    });

                    menuSection.querySelectorAll('.mcard').forEach(function(card) {
                        card.addEventListener('click', function() {
                            if(typeof openMenuPop === 'function') openMenuPop(this);
                        });
                    });

                    menuSection.querySelectorAll('.madd').forEach(function(btn) {
                        btn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            if(typeof openMenuPop === 'function') openMenuPop(this.closest('.mcard'));
                        });
                    });

                    menuSection.querySelectorAll('.fav-toggle-btn').forEach(function(btn) {
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
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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

                    if(typeof AOS !== 'undefined') AOS.refresh();
                });

            document.getElementById('menu').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 300);
    }

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') execSearch();
    });

    if (searchSubmitBtn && searchSubmitBtn.tagName === 'BUTTON') {
        searchSubmitBtn.addEventListener('click', execSearch);
    }
}


$(document).ready(function() {
	$('.magnific_popup').magnificPopup({
	  disableOn: 700,
	  type: 'iframe',
	  mainClass: 'mfp-fade',
	  removalDelay: 160,
	  preloader: false,
	  fixedContentPos: false,
	  disableOn: 300
	});
});


function filterMenu(cat) {
    // sync filter buttons visually
    document.querySelectorAll('.filtbtn').forEach(function(b) {
        b.classList.toggle('active', b.getAttribute('data-f') === cat);
    });

    // Determine the URL for fetching
    var url = new URL(window.location.href);
    url.searchParams.set('category', cat);
    url.searchParams.set('page', 1); // Reset to page 1

    var menuSection = document.getElementById('menu');
    if (!menuSection) return;

    var productsGrid = menuSection.querySelector('.row.g-4:not(.mb-5)');
    if (productsGrid) productsGrid.style.opacity = '0.5';

    fetch(url)
        .then(response => response.text())
        .then(html => {
            var parser = new DOMParser();
            var doc = parser.parseFromString(html, 'text/html');
            var newMenuContent = doc.getElementById('menu').innerHTML;
            menuSection.innerHTML = newMenuContent;

            // Re-bind events (using the function we defined or manually)
            // Re-bind Filter Buttons
            menuSection.querySelectorAll('.filtbtn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    filterMenu(this.getAttribute('data-f'));
                });
            });

            // Re-bind Card Click
            menuSection.querySelectorAll('.mcard').forEach(function(card) {
                card.addEventListener('click', function() {
                    if(typeof openMenuPop === 'function') openMenuPop(this);
                });
            });

            // Re-bind Add Button (+)
            menuSection.querySelectorAll('.madd').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if(typeof openMenuPop === 'function') openMenuPop(this.closest('.mcard'));
                });
            });

            // Re-bind Favorites Toggle
            menuSection.querySelectorAll('.fav-toggle-btn').forEach(function(btn) {
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
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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

            if(typeof AOS !== 'undefined') AOS.refresh();
        });
}

// Filter buttons
document.querySelectorAll('.filtbtn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        filterMenu(this.getAttribute('data-f'));
    });
});

// Category section cards â†’ scroll + filter
document.querySelectorAll('.catcard').forEach(function(card) {
    card.addEventListener('click', function() {
        var f = this.getAttribute('data-filter');
        window.scrollTo({
            top: document.getElementById('menu').offsetTop - 80,
            behavior: 'smooth'
        });
        setTimeout(function() {
            filterMenu(f);
        }, 480);
    });
});


var menuPop = document.getElementById('menuPop');
var mpQty = 1;
var mpBasePrice = 0;

function openMenuPop(card) {
    var img = card.getAttribute('data-img');
    var title = card.getAttribute('data-title');
    var cat = card.getAttribute('data-cat');
    var price = card.getAttribute('data-price');
    var old = card.getAttribute('data-old');
    var rating = parseFloat(card.getAttribute('data-rating'));
    var reviews = card.getAttribute('data-reviews');
    var cal = card.getAttribute('data-cal');
    var time = card.getAttribute('data-time');
    var desc = card.getAttribute('data-desc');
    var tags = card.getAttribute('data-tags') || '';
    var productId = card.getAttribute('data-id');

    menuPop.setAttribute('data-product-id', productId);

    document.getElementById('mpImg').setAttribute('src', img);
    document.getElementById('mpCat').textContent = cat;
    document.getElementById('mpTitle').textContent = title;

    var parsedRating = parseFloat(rating) || 0;
    var full = Math.round(parsedRating),
        empty = 5 - full;
    if (empty < 0) empty = 0;
    document.getElementById('mpStars').innerHTML =
        '<i class="fas fa-star" style="color:var(--secondary);"></i>'.repeat(full) + '<i class="far fa-star" style="color:var(--secondary);"></i>'.repeat(empty) +
        ' <span style="color:#bbb;font-size:.78rem;margin-left:5px;">' + parsedRating + ' (' + (reviews || 0) + ' reviews)</span>';

    document.getElementById('mpDesc').textContent = desc;

    mpBasePrice = parseFloat(price.replace(/[^0-9.]/g, ''));
    menuPop.setAttribute('data-old-price', old || '');

    document.getElementById('mpPrice').innerHTML =
        price + (old ? '<small style="color:#ccc;text-decoration:line-through;margin-left:8px;font-size:1rem;">' + old + '</small>' : '');

    document.getElementById('mpMeta').innerHTML =
        '<div class="mpm"><div class="mpmv">' + cal + ' kcal</div><div class="mpml">Calories</div></div>' +
        '<div class="mpm"><div class="mpmv">' + time + ' min</div><div class="mpml">Prep Time</div></div>' +
        '<div class="mpm"><div class="mpmv">' + rating + '/5</div><div class="mpml">Rating</div></div>';

    document.getElementById('mpTags').innerHTML =
        tags.split(',').filter(Boolean).map(function(t) {
            return '<span class="mptag">' + t.trim() + '</span>';
        }).join('');

    mpQty = 1;
    document.getElementById('mpQnum').textContent = 1;
    document.getElementById('mpAddCart').innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
    document.getElementById('mpAddCart').style.background = '';

    // Render Add-ons dynamically for this product
    var addonsContainer = document.getElementById('mpAddOns');
    if (addonsContainer) {
        var rawAddons = card.getAttribute('data-addons');
        var addons = [];
        try {
            addons = JSON.parse(rawAddons) || [];
        } catch(e) {
            addons = [];
        }

        var addonsHtml = '<h6 style="margin-bottom:10px;font-weight:600;font-size:.9rem;">Extras & Add-Ons</h6>';
        if (Array.isArray(addons) && addons.length > 0) {
            addons.forEach(function(addon) {
                var price = parseFloat(addon.price_adjustment) || 0;
                addonsHtml += '<div class="form-check" style="font-size: 0.85rem; margin-bottom: 5px;">' +
                    '<input class="form-check-input mp-addon-checkbox" type="checkbox" value="' + addon.id + '" id="addon-' + addon.id + '" data-addon-id="' + addon.id + '" data-addon-name="' + addon.name + '" data-addon-price="' + price + '">' +
                    '<label class="form-check-label d-flex justify-content-between w-100" for="addon-' + addon.id + '" style="cursor: pointer;">' +
                        '<span style="text-transform: capitalize;">' + addon.name + '</span>' +
                        '<span style="color: var(--secondary); font-weight: 600;">+EGP ' + price.toFixed(2) + '</span>' +
                    '</label>' +
                '</div>';
            });
        } else {
            addonsHtml += '<p style="font-size: 0.8rem; color: #888;">No extras available for this product.</p>';
        }
        addonsContainer.innerHTML = addonsHtml;

        document.querySelectorAll('.mp-addon-checkbox').forEach(function(cb) {
            cb.addEventListener('change', updateMpPriceDisplay);
        });
    }

    menuPop.classList.add('open');
    document.body.style.overflow = 'hidden';
}

// Card click open popup
document.querySelectorAll('.mcard').forEach(function(card) {
    card.addEventListener('click', function() {
        openMenuPop(this);
    });
});

// + button  open popup (stop propagation to avoid double firing)
document.querySelectorAll('.madd').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        openMenuPop(this.closest('.mcard'));
    });
});

// Heart toggle (no popup)
document.querySelectorAll('.mhrt').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        var ico = this.querySelector('i');
        ico.classList.toggle('far');
        ico.classList.toggle('fas');
        this.style.color = ico.classList.contains('fas') ? 'var(--primary)' : '#ccc';
    });
});

// Close popup
const mpCloseBtn = document.getElementById('mpClose');
if (mpCloseBtn) {
    mpCloseBtn.addEventListener('click', closeMenuPop);
}
if (typeof menuPop !== 'undefined' && menuPop) {
    menuPop.addEventListener('click', function(e) {
        if (e.target === this) closeMenuPop();
    });
}

function closeMenuPop() {
    menuPop.classList.remove('open');
    document.body.style.overflow = '';
}

// Review System
let selectedRating = 0;
document.querySelectorAll('.rating-star').forEach(star => {
    star.addEventListener('click', function() {
        selectedRating = parseInt(this.getAttribute('data-val'));
        document.getElementById('ratingValue').textContent = selectedRating;
        document.querySelectorAll('.rating-star').forEach(s => {
            if (parseInt(s.getAttribute('data-val')) <= selectedRating) {
                s.classList.remove('far');
                s.classList.add('fas');
            } else {
                s.classList.remove('fas');
                s.classList.add('far');
            }
        });
    });
});

const submitReviewBtn = document.getElementById('submitReviewBtn');
if (submitReviewBtn) {
    submitReviewBtn.addEventListener('click', async function() {
        if (selectedRating === 0) {
            Swal.fire({ title: 'Error', text: 'Please select a rating first.', icon: 'error', confirmButtonColor: '#9C7A5B' });
            return;
        }

        const productId = menuPop.getAttribute('data-product-id');
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            submitReviewBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitReviewBtn.disabled = true;

            const res = await fetch(`/api/v1/products/${productId}/reviews`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ rating: selectedRating })
            });

            if (res.ok) {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    title: 'Success!',
                    text: 'Thank you for your rating!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
                closeMenuPop();
            } else {
                const err = await res.json();
                Swal.fire({ title: 'Oops', text: err.message || 'Something went wrong.', icon: 'error', confirmButtonColor: '#9C7A5B' });
            }
        } catch (e) {
            Swal.fire({ title: 'Error', text: 'Network error.', icon: 'error', confirmButtonColor: '#9C7A5B' });
        } finally {
            submitReviewBtn.innerHTML = 'Submit Rating';
            submitReviewBtn.disabled = false;
        }
    });
}

function updateMpPriceDisplay() {
    var addOnTotal = 0;
    document.querySelectorAll('.mp-addon-checkbox:checked').forEach(function(cb) {
        addOnTotal += parseFloat(cb.getAttribute('data-addon-price')) || 0;
    });
    var total = (mpBasePrice + addOnTotal) * mpQty;

    var oldStr = menuPop.getAttribute('data-old-price');
    var oldHTML = oldStr ? '<small style="color:#ccc;text-decoration:line-through;margin-left:8px;font-size:1rem;">' + oldStr + '</small>' : '';

    document.getElementById('mpPrice').innerHTML = 'EGP ' + total.toFixed(2) + oldHTML;
}

// Add-on checkbox change
document.querySelectorAll('.mp-addon-checkbox').forEach(function(cb) {
    cb.addEventListener('change', updateMpPriceDisplay);
});

// Qty +/-
const mpPlusBtn = document.getElementById('mpPlus');
if (mpPlusBtn) {
    mpPlusBtn.addEventListener('click', function() {
        const qnum = document.getElementById('mpQnum');
        if (qnum) qnum.textContent = ++mpQty;
        updateMpPriceDisplay();
    });
}
const mpMinusBtn = document.getElementById('mpMinus');
if (mpMinusBtn) {
    mpMinusBtn.addEventListener('click', function() {
        if (mpQty > 1) {
            const qnum = document.getElementById('mpQnum');
            if (qnum) qnum.textContent = --mpQty;
            updateMpPriceDisplay();
        }
    });
}

// Add to cart button
const mpAddCartBtn = document.getElementById('mpAddCart');
if (mpAddCartBtn) {
    mpAddCartBtn.addEventListener('click', function() {
        var productId = (typeof menuPop !== 'undefined' && menuPop) ? menuPop.getAttribute('data-product-id') : null;
        if (!productId) return;

    var btn = this;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

    // Check if user is authenticated (CSRF token exists)
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    if(!csrfToken) {
        window.location.href = '/login';
        return;
    }

    var selectedAddOns = [];
    document.querySelectorAll('.mp-addon-checkbox:checked').forEach(function(cb) {
        selectedAddOns.push({
            id: cb.getAttribute('data-addon-id'),
            name: cb.getAttribute('data-addon-name'),
            price_adjustment: parseFloat(cb.getAttribute('data-addon-price'))
        });
    });

    fetch('/api/v1/cart/items', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken.getAttribute('content')
        },
        body: JSON.stringify({
            product_id: parseInt(productId),
            quantity: mpQty,
            add_ons: selectedAddOns
        })
    })
    .then(response => {
        if (response.status === 401) {
            window.location.href = '/login';
            throw new Error('Unauthorized');
        }
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        btn.innerHTML = '<i class="fas fa-check"></i> Added to Cart!';
        btn.style.background = 'linear-gradient(135deg,var(--green),#1a4a35)';

        if(typeof updateGlobalCartCount === 'function') {
            updateGlobalCartCount();
        }

        setTimeout(function() {
            closeMenuPop();
            btn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
            btn.style.background = '';
        }, 1000);
    })
    .catch(error => {
        if(error.message !== 'Unauthorized') {
            btn.innerHTML = '<i class="fas fa-times"></i> Error';
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
            }, 2000);
        }
    });
    });
}


const resBtn = document.getElementById('resBtn');
if (resBtn) {
    resBtn.addEventListener('click', function() {
        var btn = this;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Booking...';
        btn.disabled = true;
        setTimeout(function() {
            btn.innerHTML = '<i class="fas fa-calendar-check"></i> Confirm Reservation';
            btn.disabled = false;
            var ok = document.getElementById('resOk');
            if (ok) {
                ok.style.display = 'block';
                ok.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
        }, 1500);
    });
}

const ctcBtn = document.getElementById('ctcBtn');
if (ctcBtn) {
    ctcBtn.addEventListener('click', function() {
        var btn = this;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        btn.disabled = true;
        setTimeout(function() {
            btn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
            btn.disabled = false;
            var ok = document.getElementById('ctcOk');
            if (ok) {
                ok.style.display = 'block';
                ok.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            }
        }, 1500);
    });
}


var galPop = document.getElementById('galPop');
var galData = [];
var galIdx = 0;

document.querySelectorAll('.gitem').forEach(function(item) {
    galData.push({
        img: item.getAttribute('data-gimg'),
        title: item.getAttribute('data-gtitle'),
        desc: item.getAttribute('data-gdesc')
    });
    item.addEventListener('click', function() {
        openGal(parseInt(this.getAttribute('data-gi')));
    });
});

function openGal(i) {
    galIdx = i;
    var g = galData[i];
    document.getElementById('gpImg').setAttribute('src', g.img);
    document.getElementById('gpTitle').textContent = g.title;
    document.getElementById('gpDesc').innerHTML = g.desc;
    galPop.classList.add('open');
    document.body.style.overflow = 'hidden';
}

if (galPop) {
    document.getElementById('gpClose').addEventListener('click', closeGal);
    galPop.addEventListener('click', function(e) {
        if (e.target === this) closeGal();
    });

    function closeGal() {
        galPop.classList.remove('open');
        document.body.style.overflow = '';
    }

    document.getElementById('gpPrev').addEventListener('click', function() {
        openGal((galIdx - 1 + galData.length) % galData.length);
    });
    document.getElementById('gpNext').addEventListener('click', function() {
        openGal((galIdx + 1) % galData.length);
    });
}


/*  ESC key closes everything */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSearch();
        closeMenuPop();
        closeGal();
        if (typeof $.magnificPopup !== 'undefined') $.magnificPopup.close();
    }
});


new Swiper('.tesSwiper', {
    slidesPerView: 1,
    spaceBetween: 22,
    loop: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true
    },
    breakpoints: {
        640: {
            slidesPerView: 2
        },
        1024: {
            slidesPerView: 3
        }
    }
});


var cH = 8,
    cM = 45,
    cS = 30;
setInterval(function() {
    cS--;
    if (cS < 0) {
        cS = 59;
        cM--;
    }
    if (cM < 0) {
        cM = 59;
        cH--;
    }
    if (cH < 0) {
        cH = 8;
        cM = 45;
        cS = 30;
    }
    document.getElementById('cdH').textContent = String(cH).padStart(2, '0');
    document.getElementById('cdM').textContent = String(cM).padStart(2, '0');
    document.getElementById('cdS').textContent = String(cS).padStart(2, '0');
}, 1000);

/* â”€â”€ NEWSLETTER â”€â”€ */
document.getElementById('nlBtn').addEventListener('click', function() {
    var email = document.getElementById('nlEmail').value;
    if (email && email.includes('@')) {
        var btn = this;
        btn.textContent = 'âœ“ Subscribed!';
        btn.style.background = '#4ade80';
        btn.style.color = '#222';
        document.getElementById('nlEmail').value = '';
        setTimeout(function() {
            btn.textContent = 'Subscribe';
            btn.style.background = '';
            btn.style.color = '';
        }, 3000);
    }
});

/*  NUMBER COUNTER ANIMATION*/
var numAnimated = false;
window.addEventListener('scroll', function() {
    var hero = document.getElementById('hero');
    if (!numAnimated && hero && window.scrollY > hero.offsetHeight - 300) {
        numAnimated = true;
        document.querySelectorAll('.snum').forEach(function(el) {
            var txt = el.textContent;
            var num = parseInt(txt);
            var suf = txt.replace(/[0-9]/g, '');
            if (isNaN(num)) return;
            var start = 0;
            var step = Math.ceil(num / 55);
            var iv = setInterval(function() {
                start += step;
                if (start >= num) {
                    start = num;
                    clearInterval(iv);
                }
                el.textContent = start + suf;
            }, 1400 / 55);
        });
    }
});
/* ============================================================
   SIDE MENU DRAWER LOGIC
   ============================================================ */
document.addEventListener("DOMContentLoaded", function() {
    const hamburgerBtn = document.getElementById("hamburgerBtn");
    const hamburgerBtnDesktop = document.getElementById("hamburgerBtnDesktop");
    const sideMenuDrawer = document.getElementById("sideMenuDrawer");
    const sideMenuOverlay = document.getElementById("sideMenuOverlay");
    const sideMenuClose = document.getElementById("sideMenuClose");

    if (sideMenuDrawer && sideMenuOverlay && sideMenuClose) {
        function openDrawer() {
            sideMenuDrawer.classList.add("active");
            sideMenuOverlay.classList.add("active");
            document.body.style.overflow = "hidden";
        }

        function closeDrawer() {
            sideMenuDrawer.classList.remove("active");
            sideMenuOverlay.classList.remove("active");
            document.body.style.overflow = "";
        }

        if (hamburgerBtn) hamburgerBtn.addEventListener("click", openDrawer);
        if (hamburgerBtnDesktop) hamburgerBtnDesktop.addEventListener("click", openDrawer);
        sideMenuClose.addEventListener("click", closeDrawer);
        sideMenuOverlay.addEventListener("click", closeDrawer);
    }

    // Handle both search buttons
    const navSearchBtnDesktop = document.getElementById("navSearchBtnDesktop");
    if (navSearchBtnDesktop) {
        navSearchBtnDesktop.addEventListener("click", function() {
            const searchOv = document.getElementById("searchOv");
            if (searchOv) {
                searchOv.classList.add("active");
                document.getElementById("searchInput").focus();
            }
        });
    }

    // Accordion Logic for Side Menu
    const accordionBtns = document.querySelectorAll(".sm-accordion-btn");
    accordionBtns.forEach(btn => {
        btn.addEventListener("click", function() {
            const item = this.closest(".sm-accordion-item");
            // Optional: Close others
            // document.querySelectorAll('.sm-accordion-item').forEach(other => {
            //     if(other !== item) other.classList.remove('active');
            // });
            item.classList.toggle("active");
        });
    });
    // Auto-close Bootstrap navbar on mobile when a link is clicked
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const menuToggle = document.getElementById('navmenu');
    navLinks.forEach(l => {
        l.addEventListener('click', () => {
            if (menuToggle.classList.contains('show')) {
                document.querySelector('.navbar-toggler').click();
            }
        });
    });
});

/* ============================================================
   CUSTOM MODALS LOGIC
   ============================================================ */
document.addEventListener("DOMContentLoaded", function() {
    const modalTriggers = document.querySelectorAll('[data-cm-target]');
    const modalCloses = document.querySelectorAll('[data-cm-close]');
    const modals = document.querySelectorAll('.cm-overlay');

    modalTriggers.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = btn.getAttribute('data-cm-target');
            const modal = document.getElementById(targetId);
            if (modal) {
                // Auto-close side menu drawer when a modal is opened from it
                const sideMenuDrawer = document.getElementById("sideMenuDrawer");
                const sideMenuOverlay = document.getElementById("sideMenuOverlay");
                if (sideMenuDrawer) sideMenuDrawer.classList.remove("active");
                if (sideMenuOverlay) sideMenuOverlay.classList.remove("active");

                modal.classList.add('open');
                document.body.style.overflow = "hidden";
            }
        });
    });

    modalCloses.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const modal = btn.closest('.cm-overlay');
            if (modal) {
                modal.classList.remove('open');
                document.body.style.overflow = "";
            }
        });
    });

    modals.forEach(modal => {
        let isMouseDownOnBackdrop = false;

        modal.addEventListener('mousedown', (e) => {
            isMouseDownOnBackdrop = (e.target === modal);
        });

        modal.addEventListener('mouseup', (e) => {
            if (isMouseDownOnBackdrop && e.target === modal) {
                modal.classList.remove('open');
                document.body.style.overflow = "";
            }
            isMouseDownOnBackdrop = false;
        });
    });
});

/* ============================================================
   FAQ MODAL LOGIC
   ============================================================ */
document.addEventListener("DOMContentLoaded", function() {
    // FAQ Accordion
    const faqQuestions = document.querySelectorAll(".faq-q");
    faqQuestions.forEach(btn => {
        btn.addEventListener("click", function() {
            const item = this.parentElement;

            // Close others if desired
            // document.querySelectorAll('.faq-item').forEach(other => {
            //    if(other !== item) other.classList.remove('active');
            // });

            item.classList.toggle("active");
        });
    });

    // FAQ Search Logic
    const faqSearchInput = document.getElementById("faqSearchInput");
    const faqItems = document.querySelectorAll(".faq-item");

    if (faqSearchInput) {
        faqSearchInput.addEventListener("keyup", function() {
            const val = this.value.toLowerCase().trim();
            faqItems.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(val)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    }
});

/* ============================================================
   CHAT MODAL LOGIC
   ============================================================ */
document.addEventListener("DOMContentLoaded", function() {
    const chatInput = document.getElementById("chatInput");
    const chatSendBtn = document.getElementById("chatSendBtn");
    const chatMessages = document.getElementById("chatMessages");
    const chatChips = document.querySelectorAll(".chat-chip");

    function addMessage(text, isUser = true) {
        if (!text || !chatMessages) return;
        const msgDiv = document.createElement("div");
        msgDiv.className = isUser ? "chat-msg chat-msg-user" : "chat-msg chat-msg-bot";
        msgDiv.textContent = text;
        chatMessages.appendChild(msgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function handleSend() {
        if (!chatInput) return;
        const text = chatInput.value.trim();
        if (text) {
            addMessage(text, true);
            chatInput.value = "";

            // Show typing indicator
            const typingId = 'typing-' + Date.now();
            const typingDiv = document.createElement("div");
            typingDiv.className = "chat-msg chat-msg-bot text-muted";
            typingDiv.id = typingId;
            typingDiv.innerHTML = '<i class="fas fa-ellipsis-h fa-fade"></i>';
            chatMessages.appendChild(typingDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;

            fetch('/api/v1/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: text })
            })
            .then(res => res.json())
            .then(data => {
                document.getElementById(typingId).remove();
                addMessage(data.response, false);
            })
            .catch(err => {
                document.getElementById(typingId).remove();
                addMessage("Sorry, I'm having trouble connecting right now.", false);
            });
        }
    }

    if (chatSendBtn && chatInput) {
        chatSendBtn.addEventListener("click", handleSend);
        chatInput.addEventListener("keypress", function(e) {
            if (e.key === "Enter") handleSend();
        });
    }

    if (chatChips) {
        chatChips.forEach(chip => {
            chip.addEventListener("click", function() {
                const msg = this.getAttribute("data-msg");
                chatInput.value = msg;
                handleSend();
            });
        });
    }
});

/* ============================================================
   FAVORITES MODAL LOGIC
   ============================================================ */
document.addEventListener("DOMContentLoaded", function() {
    const favRemoveBtns = document.querySelectorAll(".fav-remove");
    favRemoveBtns.forEach(btn => {
        btn.addEventListener("click", function() {
            const btn = this;
            const productId = btn.getAttribute('data-id');
            const card = btn.closest(".fav-card");

            if (!productId) return;

            // Optional: disable button while loading
            btn.style.opacity = '0.5';
            btn.style.pointerEvents = 'none';

            fetch(`/favorites/toggle/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && !data.is_favorited) {
                    if (card) {
                        card.style.opacity = '0';
                        setTimeout(() => {
                            card.remove();
                            // check if grid is empty now
                            const grid = document.querySelector('.fav-grid');
                            if (grid && grid.querySelectorAll('.fav-card').length === 0) {
                                grid.innerHTML = `
                                <div class="text-center py-4 text-muted" style="grid-column: 1 / -1;">
                                    <i class="fas fa-heart-broken mb-3" style="font-size: 2rem; opacity: 0.5;"></i>
                                    <p>You haven't added any favorite drinks yet!</p>
                                </div>`;
                            }
                        }, 300);
                    }
                }
            })
            .catch(error => {
                console.error('Error toggling favorite:', error);
                btn.style.opacity = '1';
                btn.style.pointerEvents = 'auto';
            });
        });
    });
});

/* ============================================================
   FAVORITES TOGGLE (HOME PAGE)
   ============================================================ */
document.addEventListener("DOMContentLoaded", function() {
    const favToggleBtns = document.querySelectorAll(".fav-toggle-btn");
    favToggleBtns.forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const btn = this;
            const productId = btn.getAttribute('data-id');
            const icon = btn.querySelector('i');

            if (!productId) return;

            btn.style.pointerEvents = 'none';
            btn.style.opacity = '0.5';

            fetch(`/favorites/toggle/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.is_favorited) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        icon.style.color = '#dc3545';

                        // Append to modal
                        if (data.product) {
                            appendToFavoritesModal(data.product);
                        }
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        icon.style.color = '';

                        // Remove from modal
                        const modalFavCard = document.querySelector(`#fav-card-${productId}`);
                        if (modalFavCard) {
                            modalFavCard.style.opacity = '0';
                            setTimeout(() => {
                                modalFavCard.remove();
                                checkEmptyFavoritesGrid();
                            }, 300);
                        }
                    }
                }
                btn.style.pointerEvents = 'auto';
                btn.style.opacity = '1';
            })
            .catch(error => {
                console.error('Error toggling favorite:', error);
                btn.style.pointerEvents = 'auto';
                btn.style.opacity = '1';
            });
        });
    });

    function checkEmptyFavoritesGrid() {
        const grid = document.querySelector('.fav-grid');
        if (grid && grid.querySelectorAll('.fav-card').length === 0) {
            grid.innerHTML = `
            <div class="text-center py-4 text-muted" style="grid-column: 1 / -1;">
                <i class="fas fa-heart-broken mb-3" style="font-size: 2rem; opacity: 0.5;"></i>
                <p>You haven't added any favorite drinks yet!</p>
            </div>`;
        }
    }

    function appendToFavoritesModal(product) {
        const grid = document.querySelector('.fav-grid');
        if (!grid) return;

        const emptyState = grid.querySelector('.text-center.py-4');
        if (emptyState) emptyState.remove();

        const cardHtml = `
        <div class="fav-card" id="fav-card-${product.id}">
            <div class="fav-img">
                <img src="${product.image}" alt="${product.name}" />
                <button class="fav-remove" data-id="${product.id}" title="Remove"><i class="fas fa-heart"></i></button>
            </div>
            <div class="fav-info">
                <h6>${product.name}</h6>
                <small class="text-muted d-block mb-2">${product.category} • $${product.price}</small>
                <button class="btn btn-sm btn-danger w-100 rounded-pill fav-order-btn"><i class="fas fa-shopping-bag me-1"></i>Order Now</button>
            </div>
        </div>`;

        grid.insertAdjacentHTML('beforeend', cardHtml);

        // Re-attach event listener to new remove button
        const newBtn = grid.querySelector(`#fav-card-${product.id} .fav-remove`);
        if (newBtn) {
            newBtn.addEventListener('click', function() {
                const btn = this;
                const pId = btn.getAttribute('data-id');
                const card = btn.closest(".fav-card");

                if (!pId) return;

                btn.style.opacity = '0.5';
                btn.style.pointerEvents = 'none';

                fetch(`/favorites/toggle/${pId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(r => r.json())
                .then(d => {
                    if (d.success && !d.is_favorited) {
                        if (card) {
                            card.style.opacity = '0';
                            setTimeout(() => {
                                card.remove();
                                checkEmptyFavoritesGrid();
                                // Also update heart icon on home page if it exists
                                const homeBtn = document.querySelector(`.fav-toggle-btn[data-id="${pId}"] i`);
                                if (homeBtn) {
                                    homeBtn.classList.remove('fas');
                                    homeBtn.classList.add('far');
                                    homeBtn.style.color = '';
                                }
                            }, 300);
                        }
                    }
                });
            });
        }
    }
});
