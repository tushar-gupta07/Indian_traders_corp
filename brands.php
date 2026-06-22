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

        /* ===== HERO BANNER - EXACT MATCH TO SCREENSHOT ===== */
        .brands-hero {
            background: radial-gradient(ellipse at 30% 50%, #1a3a8f 0%, #0d2060 40%, #071540 100%);
            position: relative;
            overflow: hidden;
            padding: 70px 20px 130px;
            text-align: center;
        }

        /* Subtle dot texture like screenshot */
        .brands-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.055) 1px, transparent 1px);
            background-size: 26px 26px;
            pointer-events: none;
        }

        /* Curved white bottom - EXACT like screenshot */
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

        .hero-grid-bg { display: none; }

        /* Pill badge */
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

        /* Big WHITE main title */
        .hero-title-white {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            color: #ffffff;
            font-size: clamp(30px, 5.5vw, 66px);
            line-height: 1.1;
            display: block;
        }

        /* YELLOW accent title line */
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

        /* Stat boxes - EXACT style from screenshot */
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

        /* ===== CATEGORY FILTER TABS ===== */
        .filter-tab {
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.25s ease;
            white-space: nowrap;
            background: #fff;
            color: #374151;
            border-color: #e5e7eb;
        }
        .filter-tab:hover {
            border-color: var(--primary);
            color: var(--primary);
        }
        .filter-tab.active {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
            box-shadow: 0 4px 15px rgba(10,36,99,0.3);
        }
        .filter-tab.cat-hydraulics.active { background: #1e40af; border-color: #1e40af; }
        .filter-tab.cat-pneumatics.active { background: #0f766e; border-color: #0f766e; }
        .filter-tab.cat-valves.active { background: #b91c1c; border-color: #b91c1c; }
        .filter-tab.cat-fire.active { background: #dc2626; border-color: #dc2626; }
        .filter-tab.cat-instruments.active { background: #7c3aed; border-color: #7c3aed; }
        .filter-tab.cat-fittings.active { background: #b45309; border-color: #b45309; }

        /* ===== BRAND CARDS ===== */
        .brand-card {
            background: #fff;
            border-radius: 16px;
            border: 2px solid #e8ecf4;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            cursor: pointer;
            position: relative;
        }

        .brand-card:hover {
            transform: translateY(-6px) scale(1.01);
            border-color: var(--primary);
            box-shadow: 0 20px 50px rgba(10,36,99,0.15);
        }

        .brand-card .cat-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
        }

        .brand-card .visit-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary);
            text-decoration: none;
            transition: all 0.2s;
            padding: 5px 12px;
            border-radius: 6px;
            border: 1.5px solid var(--primary);
        }

        .brand-card .visit-btn:hover {
            background: var(--primary);
            color: #fff;
        }

        .brand-card .visit-btn svg {
            width: 12px;
            height: 12px;
        }

        /* ===== HIDDEN CLASS ===== */
        .brand-item { transition: opacity 0.3s, transform 0.3s; }
        .brand-item.hidden-brand {
            display: none;
        }

        /* stat-pill removed - using hero-stat-box now */

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

        /* ===== SCROLL TO TOP ===== */
        #scrollTop {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 48px;
            height: 48px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(10,36,99,0.4);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s;
            border: none;
            z-index: 999;
        }
        #scrollTop.visible { opacity: 1; transform: translateY(0); }
        #scrollTop:hover { background: var(--secondary); }

        /* ===== CATEGORY BADGE COLORS ===== */
        .badge-hydraulics { background: #dbeafe; color: #1e40af; }
        .badge-pneumatics { background: #d1fae5; color: #065f46; }
        .badge-valves     { background: #fee2e2; color: #991b1b; }
        .badge-fire       { background: #ffedd5; color: #9a3412; }
        .badge-instruments{ background: #ede9fe; color: #5b21b6; }
        .badge-fittings   { background: #fef3c7; color: #92400e; }
        .badge-all        { background: #f3f4f6; color: #374151; }

        @media (max-width: 640px) {
            .brands-hero { padding: 60px 0 40px; }
            .filter-tabs-wrap { overflow-x: auto; padding-bottom: 8px; }
            .filter-tabs-wrap::-webkit-scrollbar { display: none; }
        }

        .no-results { display: none; }
        .no-results.show { display: flex; }
    </style>
</head>

<body class="bg-gray-50">

    <?php include 'assets/include/header.php'; ?>
    <?php include 'assets/include/modal.php'; ?>

    <!-- ============================================================ -->
    <!-- HERO BANNER - EXACT STYLE FROM SCREENSHOT                    -->
    <!-- Navy blue bg + white title + yellow accent + curved bottom   -->
    <!-- ============================================================ -->
    <section class="brands-hero">

        <!-- Breadcrumb top-left -->
        <nav class="flex items-center justify-center gap-2 mb-10 relative z-10" aria-label="Breadcrumb">
            <a href="index.php" class="breadcrumb-link">Home</a>
            <svg class="w-3 h-3" style="color:rgba(255,255,255,0.35)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span style="color:rgba(255,255,255,0.85); font-size:13px; font-weight:600;">Brand Partners</span>
        </nav>

        <!-- Badge pill - like "OUR PRODUCT RANGE" in screenshot -->
        <div class="relative z-10">
            <div class="hero-badge">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                OUR BRAND PARTNERS
            </div>
        </div>

        <!-- Main Heading - White + Yellow like screenshot -->
        <div class="relative z-10 mt-4">
            <h1>
                <span class="hero-title-white">Trusted Industrial</span>
                <span class="hero-title-yellow">Brands &amp; Partners</span>
            </h1>
            <p class="hero-subtitle">
                High-quality valves, pipes, fittings &amp; hydraulics from 50+ certified brands across India
            </p>
        </div>

        <!-- Stat Boxes - EXACT like screenshot (3 boxes) -->
        <div class="hero-stats relative z-10">
            <div class="hero-stat-box">
                <span class="stat-num">50+</span>
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
    <!-- FILTER + SEARCH BAR                                          -->
    <!-- ============================================================ -->
    <section class="bg-white border-b-2 border-gray-100 sticky top-0 z-40 shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">

                <!-- Category Filter Tabs -->
                <div class="filter-tabs-wrap flex items-center gap-2 flex-nowrap overflow-x-auto w-full sm:w-auto pb-1">
                    <button class="filter-tab active" onclick="filterBrands('all', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                        All Brands
                    </button>
                    <button class="filter-tab cat-hydraulics" onclick="filterBrands('hydraulics', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                        Hydraulics
                    </button>
                    <button class="filter-tab cat-pneumatics" onclick="filterBrands('pneumatics', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.59 4.59A2 2 0 1 1 11 8H2m10.59 11.41A2 2 0 1 0 14 16H2m15.73-8.27A2.5 2.5 0 1 1 19.5 12H2"/></svg>
                        Pneumatics
                    </button>
                    <button class="filter-tab cat-valves" onclick="filterBrands('valves', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        Valves
                    </button>
                    <button class="filter-tab cat-fire" onclick="filterBrands('fire', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>
                        Fire Safety
                    </button>
                    <button class="filter-tab cat-instruments" onclick="filterBrands('instruments', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        Instruments
                    </button>
                    <button class="filter-tab cat-fittings" onclick="filterBrands('fittings', this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        Fittings
                    </button>
                </div>

                <!-- Search -->
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
    <!-- BRANDS GRID                                                  -->
    <!-- ============================================================ -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4">

            <!-- Count indicator -->
            <div class="flex items-center justify-between mb-6">
                <p class="text-gray-500 text-sm">Showing <span id="brandCount" class="font-bold text-primary">55</span> brands</p>
                <p class="text-xs text-gray-400 hidden sm:block">Click on any brand to explore products</p>
            </div>

            <!-- Brand Grid -->
            <div id="brandsGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">

                <!-- AEROFLEX PNEUMATICS -->
                <div class="brand-item" data-category="pneumatics" data-name="aeroflex pneumatics">
                    <div class="brand-card">
                        <span class="cat-badge badge-pneumatics">Pneumatics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Aeroflex pneumatics logo.png" alt="Aeroflex Pneumatics - Industrial Pneumatic Components Distributor India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Aeroflex Pneumatics</h3>
                            <p>Premium pneumatic components & systems for industrial automation.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- AIRA EURO AUTOMATION -->
                <div class="brand-item" data-category="valves" data-name="aira euro automation valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Aira euro automation logo.png" alt="Aira Euro Automation - Ball Valves Butterfly Valves Manufacturer India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Aira Euro Automation</h3>
                            <p>Ball valves, butterfly valves & actuators. ISO certified manufacturer.</p>
                            <a href="https://www.airaeuroindia.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- AIRMAX PNEUMATICS -->
                <div class="brand-item" data-category="pneumatics" data-name="airmax pneumatics">
                    <div class="brand-card">
                        <span class="cat-badge badge-pneumatics">Pneumatics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Airmax pneumatics.png" alt="Airmax Pneumatics - Pneumatic Cylinders and Fittings India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Airmax Pneumatics</h3>
                            <p>Pneumatic cylinders, valves & accessories for automation.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- AKARI PNEUMATICS -->
                <div class="brand-item" data-category="pneumatics" data-name="akari pneumatics">
                    <div class="brand-card">
                        <span class="cat-badge badge-pneumatics">Pneumatics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Akari Pneumatics.png" alt="Akari Pneumatics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Akari Pneumatics</h3>
                            <p>Reliable pneumatic solutions for industrial manufacturing applications.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- AKVALO -->
                <div class="brand-item" data-category="valves" data-name="akvalo valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Akvalo-Photoroom.png" alt="Akvalo Industrial Valves" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Akvalo</h3>
                            <p>Specialized industrial valve solutions for high-pressure applications.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ALTO VALVES -->
                <div class="brand-item" data-category="valves" data-name="alto valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Alto Valves.png" alt="Alto Valves - Industrial Gate Globe Ball Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Alto Valves</h3>
                            <p>Gate, globe & ball valves compliant with ASTM, IBR & DIN standards.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ARBUDA INSTRUMENTS -->
                <div class="brand-item" data-category="instruments" data-name="arbuda instruments gauges">
                    <div class="brand-card">
                        <span class="cat-badge badge-instruments">Instruments</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Arbuda Instruments logo-Photoroom.png" alt="Arbuda Instruments - Pressure Gauges Flow Meters India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Arbuda Instruments</h3>
                            <p>Pressure gauges, flow meters & industrial instrumentation solutions.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ARMOR FIRE -->
                <div class="brand-item" data-category="fire" data-name="armor fire safety firefighting">
                    <div class="brand-card">
                        <span class="cat-badge badge-fire">Fire Safety</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Armor Fire logo 2.png" alt="Armor Fire - Fire Fighting Equipment India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Armor Fire</h3>
                            <p>Fire fighting valves, hoses & suppression systems for industrial safety.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- B&M FORGE -->
                <div class="brand-item" data-category="fittings" data-name="b&m forge fittings flanges">
                    <div class="brand-card">
                        <span class="cat-badge badge-fittings">Fittings</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/B&M Forge fittings.png" alt="B&M Forge Fittings - Forged Pipe Fittings India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>B&M Forge Fittings</h3>
                            <p>Forged flanges, elbows & pipe fittings in SS, CS & Alloy Steel.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- BAUMER -->
                <div class="brand-item" data-category="instruments" data-name="baumer sensors instruments automation">
                    <div class="brand-card">
                        <span class="cat-badge badge-instruments">Instruments</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Baumer_Logo.svg.png" alt="Baumer - Industrial Sensors and Automation Components" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Baumer</h3>
                            <p>World-class sensors, encoders & measurement instruments for automation.</p>
                            <a href="https://www.baumer.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CAIR -->
                <div class="brand-item" data-category="valves" data-name="cair actuators valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Cair.png" alt="Cair Euromatic Automation - Actuators and Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Cair Euromatic</h3>
                            <p>Pneumatic & electric actuators for automated valve control systems.</p>
                            <a href="https://www.cairindia.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KIMAX -->
                <div class="brand-item" data-category="fittings" data-name="kimax pipe fittings">
                    <div class="brand-card">
                        <span class="cat-badge badge-fittings">Fittings</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/cropped-kimax-logo-1-1-162x54.png" alt="Kimax - Pipe Fittings India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Kimax</h3>
                            <p>High-quality pipe fittings and connectors for industrial piping systems.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- DANFOSS -->
                <div class="brand-item" data-category="valves" data-name="danfoss valves industrial">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Danfoss Logo.png" alt="Danfoss - Global Leader in Industrial Valves and Controls" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Danfoss</h3>
                            <p>Global leader in heating, cooling & industrial valve control solutions.</p>
                            <a href="https://www.danfoss.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- DOWTY HYDRAULICS -->
                <div class="brand-item" data-category="hydraulics" data-name="dowty hydraulics seals">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Dowty Hydraulics-Photoroom.png" alt="Dowty Hydraulics - Hydraulic Seals and Components India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Dowty Hydraulics</h3>
                            <p>Precision hydraulic seals, bonded seals & retention washers.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- EASYFLEX -->
                <div class="brand-item" data-category="fittings" data-name="easyflex flexible hose">
                    <div class="brand-card">
                        <span class="cat-badge badge-fittings">Fittings</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Easyflex.png" alt="Easyflex - Flexible Metal Hose India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Easyflex</h3>
                            <p>Flexible metal hoses, expansion bellows & SS corrugated pipes.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- EATON -->
                <div class="brand-item" data-category="hydraulics" data-name="eaton hydraulics power management">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Eaton Logo.png" alt="Eaton - Hydraulics Power Management Solutions India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Eaton</h3>
                            <p>Power management solutions — hydraulics, electrical & aerospace systems.</p>
                            <a href="https://www.eaton.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- FESTO -->
                <div class="brand-item" data-category="pneumatics" data-name="festo pneumatics automation">
                    <div class="brand-card">
                        <span class="cat-badge badge-pneumatics">Pneumatics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/festo.png" alt="Festo - Global Leader Industrial Automation Pneumatics" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Festo</h3>
                            <p>Global leader in pneumatic & electrical automation since 1925. ISO certified.</p>
                            <a href="https://www.festo.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- GOKUL POLY VALVES -->
                <div class="brand-item" data-category="valves" data-name="gokul poly valves plastic">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Gokul Poly Valves.png" alt="Gokul Poly Valves - PVC CPVC Ball Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Gokul Poly Valves</h3>
                            <p>PVC, CPVC & PP industrial valves for chemical & water treatment plants.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- HAWA ENGINEERING -->
                <div class="brand-item" data-category="valves" data-name="hawa engineering valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/hawa engineering.png" alt="Hawa Engineering - Industrial Valve Manufacturer India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Hawa Engineering</h3>
                            <p>Trusted Indian valve manufacturer with ISI & IBR certified product range.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- HYDINT -->
                <div class="brand-item" data-category="hydraulics" data-name="hydint hydraulics">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/hydint-Photoroom.png" alt="Hydint Hydraulics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Hydint</h3>
                            <p>Hydraulic cylinders, power packs & accessories for heavy industry.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- HYDROLINE -->
                <div class="brand-item" data-category="hydraulics" data-name="hydroline hydraulic products">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Hydroline products logo.png" alt="Hydroline Products - Hydraulic Cylinders India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Hydroline Products</h3>
                            <p>Precision hydraulic cylinders & components for demanding applications.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- JACKTECH -->
                <div class="brand-item" data-category="hydraulics" data-name="jacktech hydraulics">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Jacktech Hydraulics.png" alt="Jacktech Hydraulics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Jacktech Hydraulics</h3>
                            <p>High-pressure hydraulic jacks, cylinders & lifting equipment.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- JANATICS -->
                <div class="brand-item" data-category="pneumatics" data-name="janatics pneumatics cylinders">
                    <div class="brand-card">
                        <span class="cat-badge badge-pneumatics">Pneumatics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/janatics.png" alt="Janatics Pneumatics - Cylinders and Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Janatics</h3>
                            <p>India's leading pneumatics brand — cylinders, valves & FRL units.</p>
                            <a href="https://www.janatics.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KARTAR -->
                <div class="brand-item" data-category="valves" data-name="kartar valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Kartar.png" alt="Kartar Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Kartar</h3>
                            <p>ISI certified gate & globe valves widely used in Indian industry.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KOOJAN HYDRAULICS -->
                <div class="brand-item" data-category="hydraulics" data-name="koojan hydraulics">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Koojan Hydraulcis logo 2.png" alt="Koojan Hydraulics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Koojan Hydraulics</h3>
                            <p>Hydraulic power packs, motors & precision control components.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KRANTI -->
                <div class="brand-item" data-category="valves" data-name="kranti valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/kranti.png" alt="Kranti Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Kranti</h3>
                            <p>Industrial valves built for durability in oil, gas & petrochemical sectors.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- MAHAVIR VALVES -->
                <div class="brand-item" data-category="valves" data-name="mahavir valves industrial">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Mahavir Valves Logo.png" alt="Mahavir Valves - Industrial Valve Manufacturer India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Mahavir Valves</h3>
                            <p>Complete range of cast & forged valves for process industries.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- MARCK -->
                <div class="brand-item" data-category="valves" data-name="marck valves industrial">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/marck logos.png" alt="Marck Industrial Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Marck</h3>
                            <p>High-performance industrial valves for chemical, power & water sectors.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- MERCURY -->
                <div class="brand-item" data-category="valves" data-name="mercury valves india">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Mercury Logo.png" alt="Mercury Industrial Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Mercury</h3>
                            <p>Butterfly & gate valves with ASME, DIN & BS compliance for heavy industry.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- MSL -->
                <div class="brand-item" data-category="fittings" data-name="msl pipes fittings">
                    <div class="brand-card">
                        <span class="cat-badge badge-fittings">Fittings</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/MSL Logo.png" alt="MSL Pipes and Fittings India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>MSL</h3>
                            <p>Precision pipe fittings and flanges for industrial piping systems.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- NEWAGE FIRE -->
                <div class="brand-item" data-category="fire" data-name="newage fire fighting safety">
                    <div class="brand-card">
                        <span class="cat-badge badge-fire">Fire Safety</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Newage Fire fighting co. ltd logo.png" alt="Newage Fire Fighting Co India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Newage Fire Fighting</h3>
                            <p>Complete fire fighting equipment — hoses, nozzles, monitors & hydrants.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- NORMEX VALVES -->
                <div class="brand-item" data-category="valves" data-name="normex valves india">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Normex Valves Logo.png" alt="Normex Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Normex Valves</h3>
                            <p>Needle, globe & check valves for high-pressure steam & industrial use.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- PMW -->
                <div class="brand-item" data-category="fittings" data-name="pmw pipe fittings">
                    <div class="brand-card">
                        <span class="cat-badge badge-fittings">Fittings</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/PMW .png" alt="PMW Industrial Fittings India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>PMW</h3>
                            <p>Premium pipe fittings — elbows, tees, reducers in various grades.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- POLYHOSE -->
                <div class="brand-item" data-category="hydraulics" data-name="polyhose hydraulic hose fittings">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Polyhose logo.png" alt="Polyhose - Hydraulic Hose and Fittings India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Polyhose</h3>
                            <p>Hydraulic & industrial hoses, couplings and fluid transfer solutions.</p>
                            <a href="https://www.polyhose.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- POLYHYDRON -->
                <div class="brand-item" data-category="hydraulics" data-name="polyhydron hydraulics valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Polyhydron Logo.png" alt="Polyhydron Hydraulic Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Polyhydron</h3>
                            <p>Cartridge valves, proportional valves & hydraulic control systems.</p>
                            <a href="https://www.polyhydron.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- QINN -->
                <div class="brand-item" data-category="valves" data-name="qinn valves">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Qinn Logo.png" alt="Qinn Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Qinn</h3>
                            <p>Industrial valve solutions for water, steam & chemical applications.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- RAJDEEP -->
                <div class="brand-item" data-category="valves" data-name="rajdeep valves india">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Rajdeep.png" alt="Rajdeep Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Rajdeep</h3>
                            <p>Quality assured valves for oil, gas, power & process industries.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SHITAL METAL -->
                <div class="brand-item" data-category="fittings" data-name="shital metal products fittings">
                    <div class="brand-card">
                        <span class="cat-badge badge-fittings">Fittings</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Shital metal products.png" alt="Shital Metal Products Fittings India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Shital Metal Products</h3>
                            <p>Precision machined metal fittings for industrial & commercial applications.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SUPREMO GEAR PUMPS -->
                <div class="brand-item" data-category="hydraulics" data-name="supremo gear pumps hydraulics">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Supremo Gear Pumps.png" alt="Supremo Gear Pumps Hydraulics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Supremo Gear Pumps</h3>
                            <p>Gear pumps & hydraulic power units for machine tools & presses.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SURYA PRAKASH -->
                <div class="brand-item" data-category="fittings" data-name="surya prakash steel tubes pipes">
                    <div class="brand-card">
                        <span class="cat-badge badge-fittings">Fittings</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Surya Prakash steel tubes logo.png" alt="Surya Prakash Steel Tubes India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Surya Prakash Tubes</h3>
                            <p>MS, GI & SS tubes and pipes for industrial & structural applications.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- SUZHIK VALVES -->
                <div class="brand-item" data-category="valves" data-name="suzhik valves india">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Suzhik Valves (2).png" alt="Suzhik Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Suzhik Valves</h3>
                            <p>Industrial valves engineered for high-pressure steam & process lines.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TECHNO PNEUMATICS -->
                <div class="brand-item" data-category="pneumatics" data-name="techno pneumatics automation">
                    <div class="brand-card">
                        <span class="cat-badge badge-pneumatics">Pneumatics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Techno Pneumatics logo.png" alt="Techno Pneumatics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Techno Pneumatics</h3>
                            <p>Pneumatic actuators, solenoid valves & FRL units for automation.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- TORQUE -->
                <div class="brand-item" data-category="hydraulics" data-name="torque hydraulics">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Torque-Photoroom.png" alt="Torque Hydraulics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Torque</h3>
                            <p>Hydraulic torque wrenches & tightening systems for heavy bolting.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- UPC -->
                <div class="brand-item" data-category="valves" data-name="upc valves india">
                    <div class="brand-card">
                        <span class="cat-badge badge-valves">Valves</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/UPC Valves Logo.png" alt="UPC Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>UPC Valves</h3>
                            <p>Trusted industrial valve range for water, oil & gas pipelines.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- VBC HYDRAULICS -->
                <div class="brand-item" data-category="hydraulics" data-name="vbc hydraulics">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/VBC hydraulics.png" alt="VBC Hydraulics India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>VBC Hydraulics</h3>
                            <p>Hydraulic cylinders, power packs & directional control valves.</p>
                            <a href="#" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- VELJAN -->
                <div class="brand-item" data-category="hydraulics" data-name="veljan hydraulics pumps motors">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/veljan.png" alt="Veljan Hydraulics - Pumps Motors Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Veljan</h3>
                            <p>Hydraulic pumps, motors, valves & cylinders — Made in India, world-class.</p>
                            <a href="https://www.veljandenison.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- VICKERS -->
                <div class="brand-item" data-category="hydraulics" data-name="vickers hydraulics eaton">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Vickers logo.png" alt="Vickers Hydraulics - Eaton Vickers India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Vickers (Eaton)</h3>
                            <p>World-renowned hydraulic pumps, motors & valves by Eaton Vickers.</p>
                            <a href="https://www.eaton.com/vickers" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- YUKEN -->
                <div class="brand-item" data-category="hydraulics" data-name="yuken hydraulics pumps india">
                    <div class="brand-card">
                        <span class="cat-badge badge-hydraulics">Hydraulics</span>
                        <div class="img-wrap">
                            <img src="assets/images/ITClogos/Yuken Logo.png" alt="Yuken Hydraulics - Pumps Valves India" loading="lazy">
                        </div>
                        <div class="card-body">
                            <h3>Yuken</h3>
                            <p>Japanese precision hydraulics — piston pumps, proportional valves & systems.</p>
                            <a href="https://www.yukenindia.com" class="visit-btn" target="_blank" rel="noopener noreferrer">
                                Visit Brand
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- No Results -->
            <div id="noResults" class="no-results flex-col items-center justify-center py-20 text-center">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-400 mb-2">No brands found</h3>
                <p class="text-gray-400">Try a different search or category</p>
            </div>

        </div>
    </section>

    <!-- ============================================================ -->
    <!-- WHY WE CARRY THESE BRANDS - INFO SECTION                     -->
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
    <!-- SEO-RICH TEXT CONTENT SECTION                                -->
    <!-- ============================================================ -->
    <section class="py-12 bg-gray-50 border-t border-gray-200">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid md:grid-cols-2 gap-10">

                    <div>
                        <h2 class="text-2xl font-extrabold text-primary mb-4" style="font-family: 'Montserrat', sans-serif;">
                            Authorized Distributors for Industrial Brands in India
                        </h2>
                        <div class="space-y-3 text-gray-600 text-sm leading-relaxed">
                            <p>
                                Indian Traders Corp is one of India's most trusted authorized distributors for industrial valves, hydraulic components, pneumatic systems, and pipe fittings. With over <strong>20 years of experience</strong>, we have built a robust network of partnerships with India's leading manufacturers and international brands.
                            </p>
                            <p>
                                Our brand portfolio spans across <strong>hydraulics</strong> (Yuken, Veljan, Polyhydron, Eaton Vickers), <strong>pneumatics</strong> (Festo, Janatics, Aeroflex, Airmax), <strong>industrial valves</strong> (Danfoss, Cair, Aira Euro, Mahavir), and <strong>fire safety</strong> (Armor Fire, Newage) — ensuring you get the right product from the right brand, every time.
                            </p>
                            <p>
                                All products supplied by Indian Traders Corp come with <strong>factory test certificates</strong>, <strong>material certificates (MTC)</strong>, and are compliant with ISO 9001:2008, IBR, ASTM, DIN, ASME, JIS & ISI standards.
                            </p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-extrabold text-primary mb-4" style="font-family: 'Montserrat', sans-serif;">
                            Key Industries We Serve
                        </h2>
                        <div class="grid grid-cols-2 gap-3">
                            <?php
                            $industries = [
                                ['label' => 'Power Plants',     'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>'],
                                ['label' => 'Oil & Gas',        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/><path d="M12 8v8M8 12h8"/></svg>'],
                                ['label' => 'Water Treatment',  'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>'],
                                ['label' => 'Steel Plants',     'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>'],
                                ['label' => 'Chemical Plants',  'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v11M3 9h18m-6 0v11M3 9v10a2 2 0 0 0 2 2h4"/></svg>'],
                                ['label' => 'Shipbuilding',     'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20M4 20l2-8h12l2 8"/><path d="M12 4v8M8 8h8"/></svg>'],
                                ['label' => 'Pharmaceuticals',  'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h10M6 12h14M8 18h10"/><rect x="2" y="3" width="4" height="18" rx="2"/></svg>'],
                                ['label' => 'Food & Beverages', 'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>'],
                                ['label' => 'Construction',     'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>'],
                                ['label' => 'Aerospace',        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.8 19.2L16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/></svg>'],
                                ['label' => 'Agriculture',      'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>'],
                                ['label' => 'Refineries',       'svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>'],
                            ];
                            foreach ($industries as $ind): ?>
                                <div class="flex items-center gap-2 bg-white rounded-lg px-3 py-2 text-sm text-gray-700 border border-gray-100 font-medium">
                                    <?= $ind['svg'] ?>
                                    <?= $ind['label'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- CTA SECTION                                                  -->
    <!-- ============================================================ -->
    <section class="cta-section py-16">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4" style="font-family: 'Montserrat', sans-serif;">
                Can't Find Your Brand or Product?
            </h2>
            <p class="text-blue-200 text-lg mb-8 max-w-xl mx-auto">
                We stock 500+ products across 50+ brands. Call us or send an inquiry — our team will source it for you.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="tel:+917122345678"
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
    // ===== FILTER =====
    function filterBrands(category, btn) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        const items = document.querySelectorAll('.brand-item');
        let visible = 0;

        items.forEach(item => {
            const match = category === 'all' || item.dataset.category === category;
            item.classList.toggle('hidden-brand', !match);
            if (match) visible++;
        });

        document.getElementById('brandCount').textContent = visible;
        document.getElementById('noResults').classList.toggle('show', visible === 0);

        // Reset search
        document.getElementById('brandSearch').value = '';
    }

    // ===== SEARCH =====
    function searchBrands(query) {
        const q = query.toLowerCase().trim();
        const items = document.querySelectorAll('.brand-item');
        let visible = 0;

        // Reset filter tabs
        document.querySelectorAll('.filter-tab').forEach((t, i) => {
            t.classList.toggle('active', i === 0);
        });

        items.forEach(item => {
            const name = item.dataset.name || '';
            const match = !q || name.includes(q);
            item.classList.toggle('hidden-brand', !match);
            if (match) visible++;
        });

        document.getElementById('brandCount').textContent = visible;
        document.getElementById('noResults').classList.toggle('show', visible === 0);
    }

    // ===== SCROLL TO TOP =====
    window.addEventListener('scroll', () => {
        const btn = document.getElementById('scrollTop');
        btn.classList.toggle('visible', window.scrollY > 400);
    });

    // ===== COUNT ON LOAD =====
    document.addEventListener('DOMContentLoaded', () => {
        const total = document.querySelectorAll('.brand-item').length;
        document.getElementById('brandCount').textContent = total;
    });
    </script>

    <!-- Schema.org Structured Data for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Indian Traders Corp - Brand Partners",
        "description": "Authorized distributor for 50+ industrial brands including valves, hydraulics, pneumatics and pipe fittings",
        "url": "https://www.indiantradescorp.com/brands.php",
        "numberOfItems": 50,
        "itemListElement": [
            { "@type": "ListItem", "position": 1, "name": "Festo - Pneumatics & Automation" },
            { "@type": "ListItem", "position": 2, "name": "Danfoss - Industrial Valves & Controls" },
            { "@type": "ListItem", "position": 3, "name": "Eaton - Hydraulics & Power Management" },
            { "@type": "ListItem", "position": 4, "name": "Yuken - Hydraulic Pumps & Valves" },
            { "@type": "ListItem", "position": 5, "name": "Polyhydron - Hydraulic Control Systems" },
            { "@type": "ListItem", "position": 6, "name": "Janatics - Pneumatic Components" },
            { "@type": "ListItem", "position": 7, "name": "Veljan - Hydraulic Pumps & Motors" },
            { "@type": "ListItem", "position": 8, "name": "Baumer - Industrial Sensors" }
        ]
    }
    </script>

</body>
</html>