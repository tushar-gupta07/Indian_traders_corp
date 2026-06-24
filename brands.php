<?php
require_once 'assets/include/config.php';
$conn = getConn();

// ── FETCH ALL ACTIVE BRANDS ─────────────────────────────
$brands = [];
$res = $conn->query("SELECT id, name, slug, logo, description FROM brands WHERE is_active = 1 ORDER BY sort_order, name");
while ($row = $res->fetch_assoc()) $brands[] = $row;

$brandsJSON = json_encode($brands, JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Our Brand Partners | Indian Traders Corp - Authorized Distributors of Industrial Valves & Fittings</title>
    <meta name="description" content="Indian Traders Corp is an authorized distributor for 50+ premium industrial brands including Festo, Danfoss, Eaton, Yuken, Polyhydron and more. Explore our trusted brand partners for valves, fittings, hydraulics & pneumatics.">
    <meta name="keywords" content="industrial valve brands India, Festo distributor Pune, Danfoss valves, Eaton hydraulics, Yuken hydraulics, Polyhydron, pneumatics brands India, industrial fittings brands, authorized valve distributor India, IBR approved valves, ISO certified industrial suppliers">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Indian Traders Corp">

    <!-- Open Graph -->
    <meta property="og:title" content="Our Brand Partners | Indian Traders Corp">
    <meta property="og:description" content="Authorized distributor for 50+ premium industrial brands. Valves, fittings, hydraulics & pneumatics.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.indiantradescorp.com/brands.php">

    <!-- Canonical -->
    <link rel="canonical" href="https://www.indiantradescorp.com/brands.php">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: { DEFAULT: '#0a2463', dark: '#071940', light: '#1e3a8a' },
                    secondary: { DEFAULT: '#d32f2f', dark: '#b71c1c', light: '#e53935' },
                }
            }
        }
    }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap');

        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #0a2463;
            --primary-dark: #071940;
            --primary-light: #1e3a8a;
            --secondary: #d32f2f;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fb;
            color: #111;
            overflow-x: hidden;
        }

        /* ===== HERO BANNER ===== */
        .brands-hero {
            background: radial-gradient(ellipse at 30% 50%, #1a3a8f 0%, #0d2060 40%, #071540 100%);
            position: relative;
            overflow: hidden;
            padding: 70px 20px 130px;
            text-align: center;
        }

        .brands-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.055) 1px, transparent 1px);
            background-size: 26px 26px;
            pointer-events: none;
        }

        .brands-hero::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 85px;
            background: #f8f9fb;
            border-radius: 50% 50% 0 0 / 85px 85px 0 0;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.25);
            color: rgba(255,255,255,0.92);
            padding: 8px 22px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 24px;
            backdrop-filter: blur(8px);
        }

        .hero-title-white {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            color: #ffffff;
            font-size: clamp(30px, 5.5vw, 66px);
            line-height: 1.1;
            display: block;
        }

        .hero-title-yellow {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            color: #f5c518;
            font-size: clamp(30px, 5.5vw, 66px);
            line-height: 1.2;
            display: block;
        }

        .hero-subtitle {
            color: rgba(255,255,255,0.78);
            font-size: clamp(14px, 1.8vw, 18px);
            margin: 16px auto 38px;
            max-width: 540px;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 18px;
            flex-wrap: wrap;
            position: relative;
            z-index: 2;
        }

        .hero-stat-box {
            background: rgba(255,255,255,0.10);
            border: 1.5px solid rgba(255,255,255,0.18);
            border-radius: 18px;
            padding: 22px 44px;
            min-width: 150px;
            backdrop-filter: blur(12px);
            transition: transform 0.3s ease, background 0.3s;
        }

        .hero-stat-box:hover {
            background: rgba(255,255,255,0.18);
            transform: translateY(-4px);
        }

        .hero-stat-box .stat-num {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(26px, 3vw, 38px);
            font-weight: 800;
            color: #f5c518;
            display: block;
            line-height: 1;
        }

        .hero-stat-box .stat-label {
            font-size: 13px;
            color: rgba(255,255,255,0.7);
            margin-top: 6px;
            font-weight: 500;
            display: block;
        }

        .breadcrumb-link {
            color: rgba(255,255,255,0.6);
            transition: color 0.2s;
            text-decoration: none;
            font-size: 13px;
        }
        .breadcrumb-link:hover { color: #fff; }

        /* ===== SEARCH BAR ===== */
        .search-wrap {
            position: relative;
            max-width: 420px;
        }
        .search-wrap input {
            width: 100%;
            padding: 12px 20px 12px 44px;
            border-radius: 50px;
            border: 2px solid #e5e7eb;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
            font-family: 'Inter', sans-serif;
            background: #fff;
        }
        .search-wrap input:focus { border-color: var(--primary); }
        .search-wrap svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }

        /* ===== BRAND CARDS ===== */
        .brand-card {
            background: #fff;
            border-radius: 16px;
            border: 2px solid #e8ecf4;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            cursor: pointer;
            position: relative;
            text-decoration: none;
            display: block;
        }

        .brand-card:hover {
            transform: translateY(-6px) scale(1.01);
            border-color: var(--primary);
            box-shadow: 0 20px 50px rgba(10,36,99,0.15);
        }

        .brand-card .img-wrap {
            background: #f8f9fb;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 120px;
            padding: 20px;
            border-bottom: 1px solid #f0f2f8;
        }

        .brand-card .img-wrap img {
            max-height: 70px;
            max-width: 140px;
            object-fit: contain;
            transition: transform 0.3s ease;
            filter: grayscale(20%);
        }

        .brand-card:hover .img-wrap img {
            transform: scale(1.08);
            filter: grayscale(0%);
        }

        .brand-card .card-body {
            padding: 16px;
        }

        .brand-card h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 4px;
        }

        .brand-card p {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .brand-card .view-products-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            padding: 5px 0;
            transition: gap 0.2s;
        }

        .brand-card:hover .view-products-tag { gap: 8px; }

        .brand-card .view-products-tag svg {
            width: 13px;
            height: 13px;
        }

        /* ===== HIDDEN CLASS ===== */
        .brand-item { transition: opacity 0.3s, transform 0.3s; }
        .brand-item.hidden-brand { display: none; }

        /* ===== PARTNER TYPES SECTION ===== */
        .partner-type-card {
            border-radius: 16px;
            padding: 28px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .partner-type-card:hover { transform: translateY(-4px); }

        /* ===== CTA SECTION ===== */
        .cta-section {
            background: linear-gradient(135deg, #071940 0%, #0a2463 60%, #1e3a8a 100%);
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 50px 50px;
        }

        .no-results { display: none; }
        .no-results.show { display: flex; }

        @media (max-width: 640px) {
            .brands-hero { padding: 60px 0 40px; }
        }
    </style>
</head>

<body class="bg-gray-50">

    <?php include 'assets/include/header.php'; ?>
    <?php include 'assets/include/modal.php'; ?>

    <!-- ============================================================ -->
    <!-- HERO BANNER                                                   -->
    <!-- ============================================================ -->
    <section class="brands-hero">

        <nav class="flex items-center justify-center gap-2 mb-10 relative z-10" aria-label="Breadcrumb">
            <a href="index.php" class="breadcrumb-link">Home</a>
            <svg class="w-3 h-3" style="color:rgba(255,255,255,0.35)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span style="color:rgba(255,255,255,0.85); font-size:13px; font-weight:600;">Brand Partners</span>
        </nav>

        <div class="relative z-10">
            <div class="hero-badge">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                OUR BRAND PARTNERS
            </div>
        </div>

        <div class="relative z-10 mt-4">
            <h1>
                <span class="hero-title-white">Trusted Industrial</span>
                <span class="hero-title-yellow">Brands &amp; Partners</span>
            </h1>
            <p class="hero-subtitle">
                High-quality valves, pipes, fittings &amp; hydraulics from <?= count($brands) ?>+ certified brands across India
            </p>
        </div>

        <div class="hero-stats relative z-10">
            <div class="hero-stat-box">
                <span class="stat-num"><?= count($brands) ?>+</span>
                <span class="stat-label">Brand Partners</span>
            </div>
            <div class="hero-stat-box">
                <span class="stat-num">100%</span>
                <span class="stat-label">Genuine Quality</span>
            </div>
            <div class="hero-stat-box">
                <span class="stat-num">ISO</span>
                <span class="stat-label">Certified</span>
            </div>
        </div>

    </section>

    <!-- ============================================================ -->
    <!-- SEARCH BAR                                                    -->
    <!-- ============================================================ -->
    <section class="bg-white border-b-2 border-gray-100 sticky top-0 z-40 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">Showing <span id="brandCount" class="font-bold text-primary"><?= count($brands) ?></span> brands</p>
                <div class="search-wrap flex-shrink-0 w-full sm:w-auto">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="brandSearch" placeholder="Search brands..." oninput="searchBrands(this.value)">
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- BRANDS GRID (DYNAMIC FROM DATABASE)                           -->
    <!-- ============================================================ -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4">

            <div id="brandsGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                <?php foreach ($brands as $b): ?>
                <div class="brand-item" data-name="<?= htmlspecialchars(strtolower($b['name'])) ?>">
                    <a href="brand-products.php?slug=<?= urlencode($b['slug']) ?>" class="brand-card">
                        <div class="img-wrap">
                            <img src="<?= htmlspecialchars($b['logo']) ?>" alt="<?= htmlspecialchars($b['name']) ?> - Industrial Distributor India" loading="lazy" onerror="this.style.opacity='0.3'">
                        </div>
                        <div class="card-body">
                            <h3><?= htmlspecialchars($b['name']) ?></h3>
                            <p><?= htmlspecialchars($b['description'] ?? '') ?></p>
                            <span class="view-products-tag">
                                View Products
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- No Results -->
            <div id="noResults" class="no-results flex-col items-center justify-center py-20 text-center">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-400 mb-2">No brands found</h3>
                <p class="text-gray-400">Try a different search</p>
            </div>

        </div>
    </section>

    <!-- ============================================================ -->
    <!-- WHY WE CARRY THESE BRANDS                                     -->
    <!-- ============================================================ -->
    <section class="py-14 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">

                <div class="text-center mb-10">
                    <div class="inline-block bg-primary/10 text-primary px-4 py-1 rounded-full text-sm font-bold mb-3">
                        OUR SELECTION PROCESS
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-primary mb-3" style="font-family: 'Montserrat', sans-serif;">
                        Why We Partner with These Brands
                    </h2>
                    <p class="text-gray-500 max-w-2xl mx-auto">
                        Every brand on this page has been carefully vetted. We only carry products that meet our strict quality criteria.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="partner-type-card bg-gradient-to-br from-blue-50 to-white border border-blue-100">
                        <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2" style="font-family: 'Montserrat', sans-serif;">Certification First</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Every brand must have relevant certifications — ISO 9001, IBR, ISI, ASTM, or ASME — before we list them. No compromises on compliance.
                        </p>
                    </div>

                    <div class="partner-type-card bg-gradient-to-br from-red-50 to-white border border-red-100">
                        <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2" style="font-family: 'Montserrat', sans-serif;">Proven Track Record</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            We partner with brands that have proven themselves across 1000+ industrial installations in India. Market-tested, field-proven reliability.
                        </p>
                    </div>

                    <div class="partner-type-card bg-gradient-to-br from-green-50 to-white border border-green-100">
                        <div class="w-12 h-12 bg-green-700 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2" style="font-family: 'Montserrat', sans-serif;">Warranty & Support</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            All brand partners offer manufacturer warranty and technical support. You get the product PLUS the assurance of after-sales care.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- CTA SECTION                                                   -->
    <!-- ============================================================ -->
    <section class="cta-section py-16">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4" style="font-family: 'Montserrat', sans-serif;">
                Can't Find Your Brand or Product?
            </h2>
            <p class="text-blue-200 text-lg mb-8 max-w-xl mx-auto">
                We stock 500+ products across <?= count($brands) ?>+ brands. Call us or send an inquiry — our team will source it for you.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="tel:+918468851160"
                   class="inline-flex items-center justify-center gap-2 bg-secondary hover:bg-secondary-dark text-white font-bold px-8 py-4 rounded-lg transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Call Now
                </a>
                <button onclick="openQuoteForm()"
                   class="inline-flex items-center justify-center gap-2 bg-white hover:bg-gray-100 text-primary font-bold px-8 py-4 rounded-lg transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Request a Quote
                </button>
            </div>
        </div>
    </section>

    <?php include 'assets/include/footer.php'; ?>

    <script src="./assets/js/main.js"></script>

    <script>
    // ===== SEARCH (client-side, over server-rendered brand-item nodes) =====
    function searchBrands(query) {
        const q = query.toLowerCase().trim();
        const items = document.querySelectorAll('.brand-item');
        let visible = 0;

        items.forEach(item => {
            const name = item.dataset.name || '';
            const match = !q || name.includes(q);
            item.classList.toggle('hidden-brand', !match);
            if (match) visible++;
        });

        document.getElementById('brandCount').textContent = visible;
        document.getElementById('noResults').classList.toggle('show', visible === 0);
    }
    </script>

    <!-- Schema.org Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Indian Traders Corp - Brand Partners",
        "description": "Authorized distributor for premium industrial brands including valves, hydraulics, pneumatics and pipe fittings",
        "url": "https://www.indiantradescorp.com/brands.php",
        "numberOfItems": <?= count($brands) ?>
    }
    </script>

</body>
</html>