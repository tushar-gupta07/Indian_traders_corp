<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details - Indian Traders Corp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Open+Sans:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: { DEFAULT: '#0a2463', dark: '#071940', light: '#1e3a8a' },
                    secondary: { DEFAULT: '#c0392b', dark: '#b71c1c', light: '#e53935' },
                },
                fontFamily: {
                    heading: ['Montserrat', 'sans-serif'],
                    body: ['Open Sans', 'sans-serif'],
                }
            }
        }
    }
    </script>
    <style>
        body { font-family: 'Open Sans', sans-serif; background: #f8f9fa; }
        h1, h2, h3, h4, h5 { font-family: 'Montserrat', sans-serif; }

        /* Blog hero */
        .detail-hero {
            background: linear-gradient(135deg, #0a2463 0%, #1535a0 50%, #0a2463 100%);
            position: relative;
            overflow: hidden;
            padding-bottom: 0;
        }
        .detail-hero::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -1px;
            left: 0; right: 0;
            height: 80px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 80'%3E%3Cpath fill='%23f8f9fa' d='M0,60 C360,0 1080,80 1440,30 L1440,80 L0,80 Z'/%3E%3C/svg%3E") no-repeat bottom center;
            background-size: cover;
            z-index: 2;
        }
        .hero-stat-card {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(4px);
            border-radius: 16px;
            padding: 20px 32px;
            min-width: 150px;
            text-align: center;
        }

        /* Content article styles */
        .article-content p {
            color: #4b5563;
            line-height: 1.85;
            margin-bottom: 1.25rem;
            font-size: 15px;
        }
        .article-content h2 {
            color: #0a2463;
            font-size: 1.5rem;
            font-weight: 800;
            margin: 2rem 0 1rem;
            font-family: 'Montserrat', sans-serif;
        }
        .article-content h3 {
            color: #0a2463;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 1.5rem 0 0.75rem;
            font-family: 'Montserrat', sans-serif;
        }
        .article-content ul {
            list-style: none;
            margin: 1rem 0 1.5rem;
            padding: 0;
        }
        .article-content ul li {
            color: #4b5563;
            font-size: 15px;
            padding: 0.3rem 0 0.3rem 1.5rem;
            position: relative;
        }
        .article-content ul li::before {
            content: '→';
            position: absolute;
            left: 0;
            color: #c0392b;
            font-weight: bold;
        }

        /* Blockquote */
        .article-blockquote {
            background: #f0f4ff;
            border-left: 4px solid #0a2463;
            border-radius: 0 12px 12px 0;
            padding: 1.5rem 2rem;
            margin: 2rem 0;
            font-style: italic;
            color: #374151;
            font-size: 15px;
            line-height: 1.8;
        }

        /* Tags */
        .tag-btn {
            border: 1.5px solid #d1d5db;
            color: #374151;
            font-family: 'Montserrat', sans-serif;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .tag-btn:hover { border-color: #0a2463; color: #0a2463; background: #f0f4ff; }

        /* Share icons */
        .share-icon {
            width: 38px; height: 38px;
            border-radius: 50%; border: 2px solid #e5e7eb;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s ease;
            color: #6b7280;
        }
        .share-icon:hover { border-color: #0a2463; color: #0a2463; background: #f0f4ff; }

        /* Sidebar */
        .sidebar-section {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.06);
            border: 1px solid #e5e7eb;
        }
        .sidebar-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 17px;
            color: #0a2463;
            padding-bottom: 12px;
            border-bottom: 3px solid #c0392b;
            margin-bottom: 16px;
        }

        /* Sidebar service links */
        .service-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            background: #f9fafb;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .service-link:hover {
            border-color: #0a2463;
            background: #f0f4ff;
            color: #0a2463;
        }
        .service-link svg { color: #c0392b; transition: transform 0.2s ease; }
        .service-link:hover svg { transform: translateX(3px); }

        /* Recent posts in sidebar */
        .recent-post {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .recent-post:last-child { border-bottom: none; }
        .recent-post:hover .recent-post-title { color: #c0392b; }
        .recent-post-img {
            width: 72px; height: 60px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        /* Gallery grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        .gallery-grid img {
            width: 100%; height: 70px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.2s ease;
            cursor: pointer;
        }
        .gallery-grid img:hover { transform: scale(1.05); }

        /* Tag cloud in sidebar */
        .tag-cloud {
            display: flex; flex-wrap: wrap; gap: 8px;
        }
        .tag-cloud-item {
            font-family: 'Montserrat', sans-serif;
            font-size: 12px; font-weight: 600;
            padding: 6px 14px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px; color: #374151;
            transition: all 0.2s ease; cursor: pointer;
        }
        .tag-cloud-item:hover { border-color: #0a2463; color: #0a2463; background: #f0f4ff; }

        /* Author box */
        .author-box {
            background: #f8faff;
            border: 1.5px solid #dbeafe;
            border-radius: 16px;
            padding: 24px;
        }

        /* Leave a Reply */
        .reply-input {
            width: 100%; padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px; font-size: 14px;
            font-family: 'Open Sans', sans-serif;
            transition: border-color 0.2s ease;
            outline: none;
            background: white;
        }
        .reply-input:focus { border-color: #0a2463; }

        /* Related cards */
        .related-card { transition: all 0.3s ease; }
        .related-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(10,36,99,0.12); }
        .related-card .img-wrap img { transition: transform 0.4s ease; }
        .related-card:hover .img-wrap img { transform: scale(1.05); }

        /* Scroll to top btn */
        #scrollTop {
            position: fixed; bottom: 24px; right: 24px;
            width: 48px; height: 48px; background: #c0392b;
            color: white; border-radius: 50%; display: flex;
            align-items: center; justify-content: center;
            cursor: pointer; z-index: 999;
            box-shadow: 0 4px 15px rgba(192,57,43,0.4);
            transition: all 0.3s ease; opacity: 0;
        }
        #scrollTop.visible { opacity: 1; }
        #scrollTop:hover { background: #0a2463; transform: translateY(-2px); }
    </style>
</head>
<body>

    <!-- HEADER -->
    <?php include 'assets/include/header.php'; ?>
    <?php include 'assets/include/modal.php'; ?>

    <!-- HERO BANNER -->
    <section class="detail-hero pt-16 pb-24 sm:pt-20 sm:pb-28">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/15 border border-white/25 text-white px-5 py-2 rounded-full text-xs font-heading font-bold mb-6 tracking-widest uppercase">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Our Blog Article
            </div>

            <h1 class="font-heading font-black text-3xl sm:text-4xl md:text-5xl leading-tight mb-4 max-w-3xl mx-auto">
                <span class="text-white">Premium Industrial</span><br>
                <span style="color: #f5c518;">Products &amp; Solutions</span>
            </h1>

            <p class="text-white/75 text-base sm:text-lg max-w-2xl mx-auto mb-10">
                High-quality valves, pipes, and fittings for all your industrial needs
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <div class="hero-stat-card">
                    <div class="font-heading font-black text-3xl sm:text-4xl" style="color:#f5c518;">500+</div>
                    <div class="text-white/80 text-sm font-semibold mt-1">Products</div>
                </div>
                <div class="hero-stat-card">
                    <div class="font-heading font-black text-3xl sm:text-4xl" style="color:#f5c518;">100%</div>
                    <div class="text-white/80 text-sm font-semibold mt-1">Quality</div>
                </div>
                <div class="hero-stat-card">
                    <div class="font-heading font-black text-3xl sm:text-4xl" style="color:#f5c518;">ISO</div>
                    <div class="text-white/80 text-sm font-semibold mt-1">Certified</div>
                </div>
            </div>
        </div>
    </section>

    <!-- MAIN CONTENT AREA -->
    <section class="py-10 sm:py-14">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8 max-w-7xl mx-auto">

                <!-- ============================================ -->
                <!-- LEFT: ARTICLE CONTENT -->
                <!-- ============================================ -->
                <main class="flex-1 min-w-0">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                        <!-- Featured Image -->
                        <div class="relative">
                            <img src="https://picsum.photos/seed/valve1/1200/500"
                                alt="Top 10 Industrial Valves" class="w-full h-72 sm:h-80 md:h-96 object-cover">
                        </div>

                        <div class="p-6 sm:p-8 md:p-10">
                            <!-- Article Body -->
                            <div class="article-content">
                                <p>
                                    According to a newly adopted definition of cities proposed by the European Commission and now shared by a number of major international organizations such as the OECD, the World Bank and UN-Habitat, an estimated 75% of the world's population live in urbanized areas. While many of today's most pressing issues are compounded in cities, the demand for reliable industrial infrastructure has never been greater.
                                </p>

                                <p>
                                    Whether your facility is old or new, the existing valve infrastructure won't always suit current or future operational needs. For example, older plants typically feature more standard-pressure setups with basic gate valves that cannot handle modern high-pressure requirements without major upgrades.
                                </p>

                                <!-- Blockquote -->
                                <blockquote class="article-blockquote">
                                    "To create a successful industrial installation, we believe in the power of the right valve selection, quality materials, and adherence to standards. Our team is dedicated to delivering excellence, tailored to meet your specific operational requirements."
                                </blockquote>

                                <h2>Understanding High-Pressure Valve Requirements</h2>
                                <p>
                                    High-pressure applications demand valves engineered to strict tolerances. Material selection is paramount — forged steel, stainless steel grades like SS304 and SS316, and duplex stainless are common choices for pressures exceeding 150 bar. Each material offers distinct advantages depending on the media being handled.
                                </p>

                                <!-- Inline image -->
                                <div class="rounded-xl overflow-hidden my-6 shadow-md">
                                    <img src="https://picsum.photos/seed/valve2/900/400"
                                        alt="High Pressure Valve Installation" class="w-full h-64 object-cover" loading="lazy">
                                </div>

                                <h3>Leave Room for System Upgrades</h3>
                                <p>
                                    Most plant operators want the flexibility to upgrade their valve systems as operational demands evolve. While it can be tempting to install the cheapest option available, keeping your focus on valves that support future retrofitting — like flanged end connections, extended bonnet designs, and modular actuators — will yield significant long-term savings.
                                </p>

                                <h2>Top Valve Types for High-Pressure Service</h2>
                                <ul>
                                    <li>Gate Valves — ideal for full-bore, low pressure-drop isolation</li>
                                    <li>Globe Valves — precise flow control in high-pressure steam lines</li>
                                    <li>Ball Valves — quick shut-off with minimal turbulence</li>
                                    <li>Check Valves — prevent backflow in high-pressure pump discharge lines</li>
                                    <li>Safety / Relief Valves — critical for overpressure protection</li>
                                    <li>Needle Valves — fine control in instrumentation lines</li>
                                    <li>Angle Valves — corrosive and high-velocity fluid service</li>
                                </ul>

                                <p>
                                    Selecting the right valve requires evaluating pressure-temperature ratings, end connection types (flanged, butt-weld, socket-weld), body material, and compliance with applicable standards. Indian Traders Corp stocks valves certified to ASTM, DIN, JIS, and ASME standards to meet your project specifications precisely.
                                </p>

                                <h2>Certification and Standards Compliance</h2>
                                <p>
                                    Every valve supplied by Indian Traders Corp comes with full mill test certificates, material test reports, and third-party inspection reports where required. IBR-approved products are available for steam service applications in boilers and pressure vessels regulated under the Indian Boiler Act.
                                </p>
                            </div>

                            <!-- Divider -->
                            <hr class="my-8 border-gray-200">

                            <!-- Tags + Share -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-sm font-heading font-bold text-gray-700 mr-1">Tags :</span>
                                    <button class="tag-btn">Service</button>
                                    <button class="tag-btn">Business</button>
                                    <button class="tag-btn">Design</button>
                                    <button class="tag-btn">Valves</button>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-heading font-bold text-gray-700">Share :</span>
                                    <a href="#" class="share-icon" title="Facebook">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                                    </a>
                                    <a href="#" class="share-icon" title="Twitter">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                                    </a>
                                    <a href="#" class="share-icon" title="Instagram">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke-width="2"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke-width="2"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" stroke-width="2" stroke-linecap="round"/></svg>
                                    </a>
                                    <a href="#" class="share-icon" title="LinkedIn">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/><circle cx="4" cy="4" r="2"/></svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Divider -->
                            <hr class="my-8 border-gray-200">

                            <!-- Author Box -->
                            <div class="author-box flex flex-col sm:flex-row gap-5 items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-20 h-20 rounded-full overflow-hidden border-3 border-primary/20">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Author" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-heading font-bold text-secondary uppercase tracking-wider">Industrial Expert</span>
                                    <h4 class="text-xl font-heading font-black text-primary mt-1 mb-2">Rajesh Kumar</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        Senior technical consultant at Indian Traders Corp with over 15 years of experience in industrial valve and piping systems. Specializes in high-pressure applications for power, chemical, and process industries.
                                    </p>
                                </div>
                            </div>

                            <!-- Divider -->
                            <hr class="my-8 border-gray-200">

                            <!-- Leave a Reply -->
                            <div>
                                <h3 class="text-2xl font-heading font-black text-primary mb-6 flex items-center gap-3">
                                    <span class="w-1 h-7 bg-secondary rounded-full inline-block"></span>
                                    Leave a Reply
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-xs font-heading font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Your Name *</label>
                                        <input type="text" placeholder="Enter your name" class="reply-input">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-heading font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Email Address *</label>
                                        <input type="email" placeholder="Enter your email" class="reply-input">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-xs font-heading font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Website (Optional)</label>
                                    <input type="url" placeholder="https://" class="reply-input">
                                </div>
                                <div class="mb-6">
                                    <label class="block text-xs font-heading font-bold text-gray-600 mb-1.5 uppercase tracking-wide">Your Comment *</label>
                                    <textarea rows="5" placeholder="Write your comment here..." class="reply-input resize-none"></textarea>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-heading font-bold px-8 py-3.5 rounded-xl transition-all duration-300 hover:shadow-lg transform hover:scale-[1.02]">
                                    Post Comment
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================ -->
                    <!-- RELATED POSTS -->
                    <!-- ============================================ -->
                    <div class="mt-10">
                        <h3 class="text-xl font-heading font-black text-primary mb-6 flex items-center gap-3">
                            <span class="w-1 h-6 bg-secondary rounded-full inline-block"></span>
                            Related Articles
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <article class="related-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                                <a href="blog-details1.php?id=2">
                                    <div class="img-wrap overflow-hidden h-44">
                                        <img src="https://picsum.photos/seed/valve3/600/300" alt="Related" class="w-full h-full object-cover" loading="lazy">
                                    </div>
                                </a>
                                <div class="p-5">
                                    <span class="text-xs text-gray-400 font-semibold">Jan 20, 2026 • 7 min read</span>
                                    <a href="blog-details1.php?id=2">
                                        <h4 class="font-heading font-bold text-gray-900 text-base mt-1.5 hover:text-primary transition-colors line-clamp-2">
                                            Essential Maintenance Guide for Gate Valves
                                        </h4>
                                    </a>
                                    <a href="blog-details1.php?id=2" class="inline-flex items-center gap-1 text-secondary font-heading font-bold text-sm mt-3 hover:gap-2 transition-all">
                                        Read More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </article>

                            <article class="related-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                                <a href="blog-details1.php?id=3">
                                    <div class="img-wrap overflow-hidden h-44">
                                        <img src="https://picsum.photos/seed/valve4/600/300" alt="Related" class="w-full h-full object-cover" loading="lazy">
                                    </div>
                                </a>
                                <div class="p-5">
                                    <span class="text-xs text-gray-400 font-semibold">Jan 28, 2026 • 6 min read</span>
                                    <a href="blog-details1.php?id=3">
                                        <h4 class="font-heading font-bold text-gray-900 text-base mt-1.5 hover:text-primary transition-colors line-clamp-2">
                                            Understanding ISO and ASTM Standards for Industrial Valves
                                        </h4>
                                    </a>
                                    <a href="blog-details1.php?id=3" class="inline-flex items-center gap-1 text-secondary font-heading font-bold text-sm mt-3 hover:gap-2 transition-all">
                                        Read More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </article>
                        </div>
                    </div>
                </main>

                <!-- ============================================ -->
                <!-- RIGHT: SIDEBAR -->
                <!-- ============================================ -->
                <aside class="lg:w-80 flex-shrink-0">

                    <!-- Search -->
                    <div class="sidebar-section">
                        <div class="relative">
                            <input type="text" placeholder="Enter Keyword"
                                class="w-full pl-4 pr-12 py-3 border-2 border-gray-200 rounded-xl text-sm font-body focus:border-primary outline-none transition-colors">
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-secondary hover:text-primary transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </button>
                        </div>
                    </div>

                    <!-- All Services -->
                    <div class="sidebar-section">
                        <div class="sidebar-title">All Services</div>
                        <a href="#" class="service-link">
                            01. Gate Valves
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#" class="service-link">
                            02. Ball Valves
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#" class="service-link">
                            03. Butterfly Valves
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#" class="service-link">
                            04. Pipe Fittings
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#" class="service-link">
                            05. Flanges &amp; Pipes
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                        <a href="#" class="service-link">
                            06. Safety Valves
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    <!-- Recent Posts -->
                    <div class="sidebar-section">
                        <div class="sidebar-title">Recent Posts</div>

                        <a href="blog-details1.php?id=2" class="recent-post">
                            <img src="https://picsum.photos/seed/recent1/150/120" alt="Recent" class="recent-post-img">
                            <div>
                                <div class="flex items-center gap-1 text-xs text-gray-400 mb-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    15 July, 2023
                                </div>
                                <p class="recent-post-title text-sm font-heading font-bold text-gray-800 leading-snug line-clamp-2 transition-colors">
                                    Essential Maintenance Guide for Gate Valves
                                </p>
                            </div>
                        </a>

                        <a href="blog-details1.php?id=3" class="recent-post">
                            <img src="https://picsum.photos/seed/recent2/150/120" alt="Recent" class="recent-post-img">
                            <div>
                                <div class="flex items-center gap-1 text-xs text-gray-400 mb-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    15 July, 2023
                                </div>
                                <p class="recent-post-title text-sm font-heading font-bold text-gray-800 leading-snug line-clamp-2 transition-colors">
                                    Understanding ISO and ASTM Standards
                                </p>
                            </div>
                        </a>

                        <a href="blog-details1.php?id=4" class="recent-post">
                            <img src="https://picsum.photos/seed/recent3/150/120" alt="Recent" class="recent-post-img">
                            <div>
                                <div class="flex items-center gap-1 text-xs text-gray-400 mb-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    20 Jan, 2026
                                </div>
                                <p class="recent-post-title text-sm font-heading font-bold text-gray-800 leading-snug line-clamp-2 transition-colors">
                                    Complete Buyer's Guide: Choosing the Right Ball Valve
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Gallery Posts -->
                    <div class="sidebar-section">
                        <div class="sidebar-title">Gallery Posts</div>
                        <div class="gallery-grid">
                            <img src="https://picsum.photos/seed/gal1/200/150" alt="Gallery" loading="lazy">
                            <img src="https://picsum.photos/seed/gal2/200/150" alt="Gallery" loading="lazy">
                            <img src="https://picsum.photos/seed/gal3/200/150" alt="Gallery" loading="lazy">
                            <img src="https://picsum.photos/seed/gal4/200/150" alt="Gallery" loading="lazy">
                            <img src="https://picsum.photos/seed/gal5/200/150" alt="Gallery" loading="lazy">
                            <img src="https://picsum.photos/seed/gal6/200/150" alt="Gallery" loading="lazy">
                        </div>
                    </div>

                    <!-- Tags Cloud -->
                    <div class="sidebar-section">
                        <div class="sidebar-title">Popular Tags</div>
                        <div class="tag-cloud">
                            <span class="tag-cloud-item">Growth</span>
                            <span class="tag-cloud-item">Kitchen</span>
                            <span class="tag-cloud-item">Interior Design</span>
                            <span class="tag-cloud-item">Solution</span>
                            <span class="tag-cloud-item">Urban</span>
                            <span class="tag-cloud-item">Buildings</span>
                            <span class="tag-cloud-item">Architecture</span>
                            <span class="tag-cloud-item">Valves</span>
                            <span class="tag-cloud-item">IBR</span>
                            <span class="tag-cloud-item">Industrial</span>
                        </div>
                    </div>

                    <!-- CTA Banner -->
                    <div class="bg-gradient-to-br from-primary to-primary-dark rounded-2xl p-6 text-white text-center shadow-xl">
                        <svg class="w-12 h-12 mx-auto mb-3 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <h4 class="font-heading font-black text-lg mb-2">Need Help?</h4>
                        <p class="text-white/70 text-sm mb-4">Get expert consultation for your industrial valve requirements</p>
                        <a href="#" class="inline-block bg-secondary hover:bg-secondary-dark text-white font-heading font-bold px-6 py-2.5 rounded-xl text-sm transition-colors">
                            Get Free Quote
                        </a>
                    </div>

                </aside>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <?php include 'assets/include/footer.php'; ?>

    <script>
    window.addEventListener('scroll', () => {
        const btn = document.getElementById('scrollTop');
        btn.classList.toggle('visible', window.scrollY > 300);
    });
    </script>
</body>
</html>