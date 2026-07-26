AOS.init({
    duration: 680,
    once: true,
    offset: 55
});

/* NAVBAR SCROLL & ACTIVE LINK  */
window.addEventListener('scroll', function () {
    document.getElementById('nav').classList.toggle('scrolled', window.scrollY > 60);
    document.getElementById('btt').classList.toggle('show', window.scrollY > 300);
    document.querySelectorAll('section[id]').forEach(function (sec) {
        var top = sec.offsetTop - 110,
            bot = top + sec.offsetHeight;
        if (window.scrollY >= top && window.scrollY < bot) {
            document.querySelectorAll('.nav-link').forEach(function (l) {
                l.classList.remove('active');
            });
            var lnk = document.querySelector('.nav-link[href="#' + sec.id + '"]');
            if (lnk) lnk.classList.add('active');
        }
    });
});

/*  SMOOTH SCROLL + MOBILE NAV CLOSE  */
document.querySelectorAll('a[href^="#"]').forEach(function (a) {
    a.addEventListener('click', function (e) {
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
            setTimeout(function () {
                window.scrollTo({
                    top: t.offsetTop - 78,
                    behavior: 'smooth'
                });
            }, 50);
        }
    });
});


var searchOv = document.getElementById('searchOv');

document.getElementById('navSearchBtn').addEventListener('click', function () {
    searchOv.classList.add('open');
    document.body.style.overflow = 'hidden';
    setTimeout(function () {
        document.getElementById('searchInput').focus();
    }, 220);
});

document.getElementById('searchClose').addEventListener('click', closeSearch);

// Close when clicking backdrop
searchOv.addEventListener('click', function (e) {
    if (e.target === searchOv) closeSearch();
});

function closeSearch() {
    searchOv.classList.remove('open');
    document.body.style.overflow = '';
}

// Category buttons inside search box
document.querySelectorAll('.sovcat').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.sovcat').forEach(function (b) {
            b.classList.remove('active');
        });
        this.classList.add('active');
        var f = this.getAttribute('data-cat');
        closeSearch();
        setTimeout(function () {
            filterMenu(f);
            document.getElementById('menu').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }, 300);
    });
});

// Trending tags fill the search input
document.querySelectorAll('.sovtrend .ttag').forEach(function (t) {
    t.addEventListener('click', function () {
        document.getElementById('searchInput').value = this.textContent.trim();
        document.getElementById('searchInput').focus();
    });
});


$(document).ready(function () {
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
    // sync filter buttons
    document.querySelectorAll('.filtbtn').forEach(function (b) {
        b.classList.toggle('active', b.getAttribute('data-f') === cat);
    });
    // sync category cards
    document.querySelectorAll('.catcard').forEach(function (c) {
        c.classList.toggle('active', c.getAttribute('data-filter') === cat);
    });
    // show/hide menu cards
    document.querySelectorAll('.mwrap').forEach(function (w) {
        var c = w.getAttribute('data-c');
        if (cat === 'all' || c === cat) {
            w.classList.remove('gone');
            w.style.opacity = '0';
            w.style.transform = 'translateY(16px)';
            setTimeout(function () {
                w.style.transition = 'opacity .38s,transform .38s';
                w.style.opacity = '1';
                w.style.transform = 'translateY(0)';
            }, 60);
        } else {
            w.classList.add('gone');
        }
    });
}

// Filter buttons
document.querySelectorAll('.filtbtn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        filterMenu(this.getAttribute('data-f'));
    });
});

// Category section cards â†’ scroll + filter
document.querySelectorAll('.catcard').forEach(function (card) {
    card.addEventListener('click', function () {
        var f = this.getAttribute('data-filter');
        window.scrollTo({
            top: document.getElementById('menu').offsetTop - 80,
            behavior: 'smooth'
        });
        setTimeout(function () {
            filterMenu(f);
        }, 480);
    });
});


var menuPop = document.getElementById('menuPop');
var mpQty = 1;

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

    document.getElementById('mpImg').setAttribute('src', img);
    document.getElementById('mpCat').textContent = cat;
    document.getElementById('mpTitle').textContent = title;

    var full = Math.round(rating),
        empty = 5 - full;
    document.getElementById('mpStars').innerHTML =
        '<i class="fas fa-star"></i>'.repeat(full) + 'â˜†'.repeat(empty) +
        ' <span style="color:#bbb;font-size:.78rem;">' + rating + ' (' + reviews + ' reviews)</span>';

    document.getElementById('mpDesc').textContent = desc;

    document.getElementById('mpPrice').innerHTML =
        price + (old ? '<small style="color:#ccc;text-decoration:line-through;margin-left:8px;font-size:1rem;">' + old + '</small>' : '');

    document.getElementById('mpMeta').innerHTML =
        '<div class="mpm"><div class="mpmv">' + cal + ' kcal</div><div class="mpml">Calories</div></div>' +
        '<div class="mpm"><div class="mpmv">' + time + ' min</div><div class="mpml">Prep Time</div></div>' +
        '<div class="mpm"><div class="mpmv">' + rating + '/5</div><div class="mpml">Rating</div></div>';

    document.getElementById('mpTags').innerHTML =
        tags.split(',').filter(Boolean).map(function (t) {
            return '<span class="mptag">' + t.trim() + '</span>';
        }).join('');

<<<<<<< HEAD
    mpQty = 1;
    document.getElementById('mpQnum').textContent = 1;
    document.getElementById('mpAddCart').innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
    document.getElementById('mpAddCart').style.background = '';
=======
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
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64

    menuPop.classList.add('open');
    document.body.style.overflow = 'hidden';
}

// Card click open popup
document.querySelectorAll('.mcard').forEach(function (card) {
    card.addEventListener('click', function () {
        openMenuPop(this);
    });
});

// + button  open popup (stop propagation to avoid double firing)
document.querySelectorAll('.madd').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        openMenuPop(this.closest('.mcard'));
    });
});

// Heart toggle (no popup)
document.querySelectorAll('.mhrt').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.stopPropagation();
        var ico = this.querySelector('i');
        ico.classList.toggle('far');
        ico.classList.toggle('fas');
        this.style.color = ico.classList.contains('fas') ? 'var(--primary)' : '#ccc';
    });
});

// Close popup
document.getElementById('mpClose').addEventListener('click', closeMenuPop);
menuPop.addEventListener('click', function (e) {
    if (e.target === this) closeMenuPop();
});

function closeMenuPop() {
    menuPop.classList.remove('open');
    document.body.style.overflow = '';
}

// Qty +/-
document.getElementById('mpPlus').addEventListener('click', function () {
    document.getElementById('mpQnum').textContent = ++mpQty;
});
document.getElementById('mpMinus').addEventListener('click', function () {
    if (mpQty > 1) document.getElementById('mpQnum').textContent = --mpQty;
});

// Add to cart button
document.getElementById('mpAddCart').addEventListener('click', function () {
    var cnt = parseInt(document.getElementById('cartCount').textContent) + mpQty;
    document.getElementById('cartCount').textContent = cnt;
    this.innerHTML = '<i class="fas fa-check"></i> Added to Cart!';
    this.style.background = 'linear-gradient(135deg,var(--green),#1a4a35)';
    var self = this;
    setTimeout(function () {
        closeMenuPop();
        self.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
        self.style.background = '';
    }, 1000);
});


document.getElementById('resBtn').addEventListener('click', function () {
    var btn = this;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Booking...';
    btn.disabled = true;
    setTimeout(function () {
        btn.innerHTML = '<i class="fas fa-calendar-check"></i> Confirm Reservation';
        btn.disabled = false;
        var ok = document.getElementById('resOk');
        ok.style.display = 'block';
        ok.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
        });
    }, 1500);
});


document.getElementById('ctcBtn').addEventListener('click', function () {
    var btn = this;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    btn.disabled = true;
    setTimeout(function () {
        btn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
        btn.disabled = false;
        var ok = document.getElementById('ctcOk');
        ok.style.display = 'block';
        ok.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
        });
    }, 1500);
});


var galPop = document.getElementById('galPop');
var galData = [];
var galIdx = 0;

document.querySelectorAll('.gitem').forEach(function (item) {
    galData.push({
        img: item.getAttribute('data-gimg'),
        title: item.getAttribute('data-gtitle'),
        desc: item.getAttribute('data-gdesc')
    });
    item.addEventListener('click', function () {
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

document.getElementById('gpClose').addEventListener('click', closeGal);
galPop.addEventListener('click', function (e) {
    if (e.target === this) closeGal();
});

function closeGal() {
    galPop.classList.remove('open');
    document.body.style.overflow = '';
}

document.getElementById('gpPrev').addEventListener('click', function () {
    openGal((galIdx - 1 + galData.length) % galData.length);
});
document.getElementById('gpNext').addEventListener('click', function () {
    openGal((galIdx + 1) % galData.length);
});

/*  ESC key closes everything */
document.addEventListener('keydown', function (e) {
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
setInterval(function () {
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
document.getElementById('nlBtn').addEventListener('click', function () {
    var email = document.getElementById('nlEmail').value;
    if (email && email.includes('@')) {
        var btn = this;
        btn.textContent = 'âœ“ Subscribed!';
        btn.style.background = '#4ade80';
        btn.style.color = '#222';
        document.getElementById('nlEmail').value = '';
        setTimeout(function () {
            btn.textContent = 'Subscribe';
            btn.style.background = '';
            btn.style.color = '';
        }, 3000);
    }
});

/*  NUMBER COUNTER ANIMATION*/
var numAnimated = false;
window.addEventListener('scroll', function () {
    var hero = document.getElementById('hero');
    if (!numAnimated && hero && window.scrollY > hero.offsetHeight - 300) {
        numAnimated = true;
        document.querySelectorAll('.snum').forEach(function (el) {
            var txt = el.textContent;
            var num = parseInt(txt);
            var suf = txt.replace(/[0-9]/g, '');
            if (isNaN(num)) return;
            var start = 0;
            var step = Math.ceil(num / 55);
            var iv = setInterval(function () {
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

/* ===================== HAMBURGER SIDE MENU DRAWER ===================== */
var sideMenuOverlay = document.getElementById('sideMenuOverlay');
var sideMenuDrawer = document.getElementById('sideMenuDrawer');
var hamburgerBtn = document.getElementById('hamburgerBtn');
var sideMenuClose = document.getElementById('sideMenuClose');

function openSideMenu() {
    if (sideMenuOverlay && sideMenuDrawer) {
        sideMenuOverlay.classList.add('active');
        sideMenuDrawer.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeSideMenu() {
    if (sideMenuOverlay && sideMenuDrawer) {
        sideMenuOverlay.classList.remove('active');
        sideMenuDrawer.classList.remove('active');
        document.body.style.overflow = '';
    }
}

if (hamburgerBtn) hamburgerBtn.addEventListener('click', openSideMenu);
if (sideMenuClose) sideMenuClose.addEventListener('click', closeSideMenu);
if (sideMenuOverlay) sideMenuOverlay.addEventListener('click', closeSideMenu);

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeSideMenu();
});

/* Accordion toggling */
document.querySelectorAll('.sm-accordion-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var item = this.closest('.sm-accordion-item');
        var isOpen = item.classList.contains('active');

        // Close other accordion items for clean single accordion effect
        document.querySelectorAll('.sm-accordion-item').forEach(function (i) {
            i.classList.remove('active');
        });

        if (!isOpen) {
            item.classList.add('active');
        }
    });
});

/* Subcategory links filter menu & scroll */
document.querySelectorAll('.sm-sub-link').forEach(function (lnk) {
    lnk.addEventListener('click', function (e) {
        var cat = this.getAttribute('data-cat');
        closeSideMenu();
        if (cat && typeof filterMenu === 'function') {
            setTimeout(function () {
                filterMenu(cat);
                var menuSec = document.getElementById('menu');
                if (menuSec) {
                    menuSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 300);
        }
    });
});

/* Logout Action */
var smLogoutBtn = document.getElementById('smLogoutBtn');
if (smLogoutBtn) {
    smLogoutBtn.addEventListener('click', function () {
        if (confirm('Are you sure you want to log out of Sip & Snug?')) {
            alert('You have been logged out successfully. Have a great day!');
            closeSideMenu();
        }
    });
}

/* ===================== FEATURE MODAL PAGES SYSTEM ===================== */
function openCustomModal(modalId) {
    var modal = document.getElementById(modalId);
    if (modal) {
        closeSideMenu(); // close drawer if open
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
}

function closeCustomModal(modal) {
    if (modal) {
        modal.classList.remove('open');
        document.body.style.overflow = '';
    }
}

// Global modal triggers
document.querySelectorAll('[data-cm-target]').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var targetId = this.getAttribute('data-cm-target');
        openCustomModal(targetId);
    });
});

// Close buttons & overlay backdrop clicks
document.querySelectorAll('.cm-overlay').forEach(function (overlay) {
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay || e.target.closest('[data-cm-close]')) {
            closeCustomModal(overlay);
        }
    });
});

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.cm-overlay.open').forEach(closeCustomModal);
    }
});

/* 1. FAQ Accordion & Search */
document.querySelectorAll('.faq-q').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var item = this.closest('.faq-item');
        item.classList.toggle('active');
    });
});

var faqSearchInput = document.getElementById('faqSearchInput');
if (faqSearchInput) {
    faqSearchInput.addEventListener('input', function () {
        var q = this.value.toLowerCase().trim();
        document.querySelectorAll('.faq-item').forEach(function (item) {
            var txt = item.textContent.toLowerCase();
            item.style.display = txt.includes(q) ? 'block' : 'none';
        });
    });
}

/* 2. Live Chat Assistant */
var chatMessages = document.getElementById('chatMessages');
var chatInput = document.getElementById('chatInput');
var chatSendBtn = document.getElementById('chatSendBtn');

function appendChatMessage(msg, sender) {
    if (!chatMessages) return;
    var bubble = document.createElement('div');
    bubble.className = 'chat-msg ' + (sender === 'user' ? 'chat-msg-user' : 'chat-msg-bot');
    bubble.textContent = msg;
    chatMessages.appendChild(bubble);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function handleUserChatMessage(userMsg) {
    if (!userMsg) return;
    appendChatMessage(userMsg, 'user');

    // Automated assistant responses
    setTimeout(function () {
        var reply = "Thank you for reaching out! Our team is here for you.";
        var lower = userMsg.toLowerCase();
        if (lower.includes('order') || lower.includes('track')) {
            reply = "📦 Your active order #SNUG-8921 is currently ON THE WAY! Estimated arrival: 10 minutes.";
        } else if (lower.includes('drink') || lower.includes('recommend')) {
            reply = "🌸 We highly recommend our Pink Matcha Latte or Signature Cold Brew today!";
        } else if (lower.includes('reward') || lower.includes('point')) {
            reply = "🎁 You currently have 340 Gold Member points! You can redeem a free Croissant or Medium Latte in the Rewards tab.";
        } else if (lower.includes('milk') || lower.includes('dairy')) {
            reply = "🥛 We offer Oat, Almond, Coconut, and Soy milk alternatives at no extra charge!";
        }
        appendChatMessage(reply, 'bot');
    }, 650);
}

if (chatSendBtn && chatInput) {
    chatSendBtn.addEventListener('click', function () {
        var txt = chatInput.value.trim();
        if (txt) {
            handleUserChatMessage(txt);
            chatInput.value = '';
        }
    });
    chatInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            chatSendBtn.click();
        }
    });
}

document.querySelectorAll('.chat-chip').forEach(function (chip) {
    chip.addEventListener('click', function () {
        var msg = this.getAttribute('data-msg');
        handleUserChatMessage(msg);
    });
});

/* 3. Rewards Points Redemption */
var userPoints = 340;
document.querySelectorAll('.redeem-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var cost = parseInt(this.getAttribute('data-pts'));
        if (userPoints >= cost) {
            userPoints -= cost;
            var display = document.getElementById('rewardPtsDisplay');
            if (display) display.textContent = userPoints;
            alert('🎉 Voucher redeemed successfully! Your new points balance is ' + userPoints + ' pts.');
            this.textContent = '✓ Redeemed';
            this.classList.remove('btn-warning');
            this.classList.add('btn-success');
            this.disabled = true;
        } else {
            alert('You need ' + (cost - userPoints) + ' more points to redeem this voucher!');
        }
    });
});

/* 4. Favorites & Reorder Actions */
document.querySelectorAll('.fav-remove').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var card = this.closest('.fav-card');
        card.style.opacity = '0';
        card.style.transform = 'scale(0.8)';
        setTimeout(function () { card.remove(); }, 300);
    });
});

document.querySelectorAll('.fav-order-btn, .reorder-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        alert('Item added to your order bag! Brewing now...');
        document.querySelectorAll('.cm-overlay.open').forEach(closeCustomModal);
        var menuSec = document.getElementById('menu');
        if (menuSec) menuSec.scrollIntoView({ behavior: 'smooth' });
    });
});

/* 5. Profile Save Handler */
var profileForm = document.getElementById('profileForm');
if (profileForm) {
    profileForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var name = document.getElementById('profName').value;
        var email = document.getElementById('profEmail').value;

        // Update header & drawer user names
        document.querySelectorAll('.sm-profile-info h5').forEach(function (el) {
            el.textContent = name;
        });
        document.querySelectorAll('.sm-email').forEach(function (el) {
            el.textContent = email;
        });

        alert('✨ Profile settings updated successfully!');
        closeCustomModal(document.getElementById('profileModal'));
    });
}