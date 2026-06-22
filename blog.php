<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Indian Traders Corp</title>
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
        header {
    position: sticky;
    top: 0;
    z-index: 50; 
}
        body { font-family: 'Open Sans', sans-serif; }
        h1, h2, h3, h4, h5 { font-family: 'Montserrat', sans-serif; }

        /* Hero Banner */
        .blog-hero {
            background: linear-gradient(135deg, #0a2463 0%, #1535a0 50%, #0a2463 100%);
            position: relative;
            overflow: hidden;
            padding-bottom: 0;
        }
        .blog-hero::after {
            content: '';
            display: block;
            position: absolute;
            bottom: -1px;
            left: 0; right: 0;
            height: 80px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 80'%3E%3Cpath fill='%23f9fafb' d='M0,60 C360,0 1080,80 1440,30 L1440,80 L0,80 Z'/%3E%3C/svg%3E") no-repeat bottom center;
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

        /* Blog card styles */
        .blog-card {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(10, 36, 99, 0.15);
        }
        .blog-card .card-img {
            overflow: hidden;
        }
        .blog-card .card-img img {
            transition: transform 0.5s ease;
        }
        .blog-card:hover .card-img img {
            transform: scale(1.06);
        }
        .blog-card .read-more-arrow {
            transition: transform 0.3s ease;
        }
        .blog-card:hover .read-more-arrow {
            transform: translateX(5px);
        }

        /* Category badge colors */
        .badge-news      { background: #c0392b; }
        .badge-tips      { background: #0a2463; }
        .badge-standards { background: #15803d; }
        .badge-guide     { background: #7c3aed; }
        .badge-product   { background: #b45309; }

        /* Pagination */
        .page-btn {
            width: 42px; height: 42px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; font-family: 'Montserrat', sans-serif;
            font-weight: 700; font-size: 14px;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .page-btn:hover { border-color: #0a2463; color: #0a2463; }
        .page-btn.active { background: #0a2463; color: white; }

        /* Search input */
        .search-input:focus { outline: none; box-shadow: 0 0 0 3px rgba(10,36,99,0.15); }

        /* Featured card */
        .featured-card {
            background: linear-gradient(135deg, #0a2463, #1e3a8a);
        }

        /* Filter tabs */
        .filter-tab {
            transition: all 0.2s ease;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            font-size: 13px;
            padding: 8px 16px;
            border-radius: 10px;
            background: #f3f4f6;
            color: #374151;
            border: none;
            cursor: pointer;
            /* KEY: prevent shrinking */
            flex-shrink: 0;
            white-space: nowrap;
        }
        .filter-tab.active, .filter-tab:hover {
            background: #0a2463;
            color: white;
        }

        /* =============================================
           SCROLLABLE TABS ROW - Hide scrollbar
           ============================================= */
        .tabs-scroll-row {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            flex-wrap: nowrap;          /* IMPORTANT: no wrapping */
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x proximity;
            padding-bottom: 2px;        /* tiny breathing room for focus ring */
        }
        /* Hide scrollbar – all browsers */
        .tabs-scroll-row::-webkit-scrollbar { display: none; }
        .tabs-scroll-row { -ms-overflow-style: none; scrollbar-width: none; }

        .tabs-scroll-row .filter-tab {
            scroll-snap-align: start;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php include 'assets/include/header.php'; ?>

<!-- Include Modal -->
<?php include 'assets/include/modal.php'; ?>

    <!-- ============================================ -->
    <!-- HERO BANNER                                 -->
    <!-- ============================================ -->
    <section class="blog-hero pt-16 pb-24 sm:pt-20 sm:pb-28">
        <div class="container mx-auto px-4 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 bg-white/15 border border-white/25 text-white px-5 py-2 rounded-full text-xs font-heading font-bold mb-6 tracking-widest uppercase">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Our Blog &amp; Insights
            </div>

            <h1 class="font-heading font-black text-4xl sm:text-5xl md:text-6xl leading-tight mb-4">
                <span class="text-white">Industry Insights &amp;</span><br>
                <span style="color: #f5c518;">News &amp; Updates</span>
            </h1>

            <p class="text-white/75 text-base sm:text-lg max-w-2xl mx-auto mb-10">
                Stay updated with the latest trends, tips, and news from the industrial valve and fittings industry
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <div class="hero-stat-card">
                    <div class="font-heading font-black text-3xl sm:text-4xl" style="color:#f5c518;">500+</div>
                    <div class="text-white/80 text-sm font-semibold mt-1">Articles</div>
                </div>
                <div class="hero-stat-card">
                    <div class="font-heading font-black text-3xl sm:text-4xl" style="color:#f5c518;">100%</div>
                    <div class="text-white/80 text-sm font-semibold mt-1">Expert Content</div>
                </div>
                <div class="hero-stat-card">
                    <div class="font-heading font-black text-3xl sm:text-4xl" style="color:#f5c518;">ISO</div>
                    <div class="text-white/80 text-sm font-semibold mt-1">Certified Info</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- SEARCH + FILTER BAR — RESPONSIVE FIXED ✅   -->
    <!-- ============================================ -->
   <section class="bg-white border-b-2 border-gray-100 sticky top-20 z-30 shadow-sm">

        <div class="container mx-auto px-4">

            <div class="flex flex-col md:flex-row items-center gap-4">

                <!-- Search -->
                <div class="relative w-full md:max-w-md md:flex-shrink-0">
                    <input id="blogSearch" type="text" placeholder="Search articles..."
                        class="search-input w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-xl text-sm font-body focus:border-primary transition-colors">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                <!-- Filter label + scrollable tabs row -->
                <div class="flex items-center gap-2 w-full min-w-0">
                    <!-- Label: never shrinks -->
                    <span class="text-xs text-gray-500 font-heading font-semibold whitespace-nowrap flex-shrink-0">Filter:</span>

                    <!-- ✅ Horizontally scrollable tabs — no line breaks on mobile -->
                    <div class="tabs-scroll-row flex-1 min-w-0">
                        <button class="filter-tab active" data-filter="all">All</button>
                        <button class="filter-tab" data-filter="industry-news">Industry News</button>
                        <button class="filter-tab" data-filter="maintenance">Maintenance</button>
                        <button class="filter-tab" data-filter="standards">Standards</button>
                        <button class="filter-tab" data-filter="product-guide">Product Guide</button>
                    </div>
                </div>

            </div>

            <!-- No results message -->
            <div id="noResults" class="hidden text-center py-3 text-gray-500 text-sm font-semibold mt-2">
                No articles found matching your search.
            </div>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- FEATURED BLOG POST                          -->
    <!-- ============================================ -->
    <section class="py-10 sm:py-14 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-sm font-heading font-bold text-gray-400 uppercase tracking-widest mb-5">📌 Featured Article</div>

            <a href="blog-details1.php?id=1" class="block group">
                <div class="featured-card rounded-2xl overflow-hidden shadow-xl flex flex-col lg:flex-row">
                    <div class="relative lg:w-1/2 overflow-hidden" style="min-height: 300px;">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=800&h=500&fit=crop&q=80"
                            alt="Featured Blog" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" style="min-height:300px;">
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent to-primary/30"></div>
                        <div class="absolute top-5 left-5">
                            <span class="badge-news text-white text-xs font-heading font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Industry News</span>
                        </div>
                    </div>
                    <div class="lg:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                        <div class="flex items-center gap-4 text-white/60 text-xs mb-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Jan 15, 2026
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                5 min read
                            </span>
                            <span>by Admin</span>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-heading font-black text-white mb-4 leading-tight group-hover:text-blue-200 transition-colors">
                            Top 10 Industrial Valves for High-Pressure Applications
                        </h2>
                        <p class="text-white/70 text-sm leading-relaxed mb-6">
                            Discover the best valve solutions for high-pressure industrial applications. Learn about material selection, safety standards, and performance criteria for demanding environments.
                        </p>
                        <div class="inline-flex items-center gap-2 bg-secondary text-white font-heading font-bold text-sm px-6 py-3 rounded-xl w-fit group-hover:bg-secondary-dark transition-colors">
                            Read Full Article
                            <svg class="w-4 h-4 read-more-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- ============================================ -->
    <!-- BLOG GRID - 3 COLUMNS                       -->
    <!-- ============================================ -->
    <section class="pb-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-heading font-bold text-primary">All Articles <span class="text-gray-400 font-normal text-base ml-2">( 6 posts )</span></h2>
            </div>

            <div id="blogGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                <!-- Card 1 -->
                <article class="blog-card bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100" data-category="industry-news" data-title="top 10 industrial valves for high-pressure applications">
                    <a href="blog-details1.php?id=1">
                        <div class="card-img relative h-52">
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&h=400&fit=crop&q=80"
                                alt="Blog 1" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="badge-news text-white text-[11px] font-heading font-bold px-3 py-1 rounded-full uppercase tracking-wide">Industry News</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-gray-400 text-xs mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Jan 15, 2026
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                5 min read
                            </span>
                        </div>
                        <a href="blog-details1.php?id=1">
                            <h3 class="text-base font-heading font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2 leading-snug">
                                Top 10 Industrial Valves for High-Pressure Applications
                            </h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                            Discover the best valve solutions for high-pressure industrial applications. Learn about material selection, safety standards, and performance criteria.
                        </p>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-xs font-bold">AD</div>
                                <span class="text-xs text-gray-600 font-semibold">Admin</span>
                            </div>
                            <a href="blog-details1.php?id=1" class="inline-flex items-center gap-1 text-primary font-heading font-bold text-sm hover:text-secondary transition-colors">
                                Read More
                                <svg class="w-4 h-4 read-more-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Card 2 -->
                <article class="blog-card bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100" data-category="maintenance" data-title="essential maintenance guide for gate valves">
                    <a href="blog-details1.php?id=2">
                        <div class="card-img relative h-52">
                              <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&h=400&fit=crop&q=80"
                                alt="Blog 1" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="badge-tips text-white text-[11px] font-heading font-bold px-3 py-1 rounded-full uppercase tracking-wide">Maintenance Tips</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-gray-400 text-xs mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Jan 20, 2026
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                7 min read
                            </span>
                        </div>
                        <a href="blog-details1.php?id=2">
                            <h3 class="text-base font-heading font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2 leading-snug">
                                Essential Maintenance Guide for Gate Valves
                            </h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                            Learn the best practices for maintaining gate valves to ensure longevity and optimal performance. Step-by-step maintenance procedures included.
                        </p>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white text-xs font-bold">RK</div>
                                <span class="text-xs text-gray-600 font-semibold">Rahul K.</span>
                            </div>
                            <a href="blog-details1.php?id=2" class="inline-flex items-center gap-1 text-primary font-heading font-bold text-sm hover:text-secondary transition-colors">
                                Read More
                                <svg class="w-4 h-4 read-more-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Card 3 -->
                <article class="blog-card bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100" data-category="standards" data-title="understanding iso and astm standards for industrial valves">
                    <a href="blog-details1.php?id=3">
                        <div class="card-img relative h-52">
                            <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&h=400&fit=crop&q=80"
                                alt="Blog 3" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="badge-standards text-white text-[11px] font-heading font-bold px-3 py-1 rounded-full uppercase tracking-wide">Standards</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-gray-400 text-xs mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Jan 28, 2026
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                6 min read
                            </span>
                        </div>
                        <a href="blog-details1.php?id=3">
                            <h3 class="text-base font-heading font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2 leading-snug">
                                Understanding ISO and ASTM Standards for Industrial Valves
                            </h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                            A comprehensive guide to international standards for valve manufacturing. Learn why compliance matters and how to choose certified products for your needs.
                        </p>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white text-xs font-bold">SM</div>
                                <span class="text-xs text-gray-600 font-semibold">Suresh M.</span>
                            </div>
                            <a href="blog-details1.php?id=3" class="inline-flex items-center gap-1 text-primary font-heading font-bold text-sm hover:text-secondary transition-colors">
                                Read More
                                <svg class="w-4 h-4 read-more-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Card 4 -->
                <article class="blog-card bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100" data-category="product-guide" data-title="complete buyer guide choosing the right ball valve">
                    <a href="blog-details1.php?id=4">
                        <div class="card-img relative h-52">
                            <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&h=400&fit=crop&q=80"
                                alt="Blog 4" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="badge-guide text-white text-[11px] font-heading font-bold px-3 py-1 rounded-full uppercase tracking-wide">Product Guide</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-gray-400 text-xs mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Feb 5, 2026
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                8 min read
                            </span>
                        </div>
                        <a href="blog-details1.php?id=4">
                            <h3 class="text-base font-heading font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2 leading-snug">
                                Complete Buyer's Guide: Choosing the Right Ball Valve
                            </h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                            Everything you need to know before purchasing ball valves for your industrial application. Material grades, pressure ratings, and size selection explained.
                        </p>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-xs font-bold">AD</div>
                                <span class="text-xs text-gray-600 font-semibold">Admin</span>
                            </div>
                            <a href="blog-details1.php?id=4" class="inline-flex items-center gap-1 text-primary font-heading font-bold text-sm hover:text-secondary transition-colors">
                                Read More
                                <svg class="w-4 h-4 read-more-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Card 5 -->
                <article class="blog-card bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100" data-category="product-guide" data-title="new butterfly valve range features and applications">
                    <a href="blog-details1.php?id=5">
                        <div class="card-img relative h-52">
                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&h=400&fit=crop&q=80"
                                alt="Blog 5" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="badge-product text-white text-[11px] font-heading font-bold px-3 py-1 rounded-full uppercase tracking-wide">Product Update</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-gray-400 text-xs mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Feb 12, 2026
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                4 min read
                            </span>
                        </div>
                        <a href="blog-details1.php?id=5">
                            <h3 class="text-base font-heading font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2 leading-snug">
                                New Butterfly Valve Range: Features &amp; Applications
                            </h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                            Explore our newly arrived butterfly valve range with improved sealing technology and extended temperature ratings for diverse industrial uses.
                        </p>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center text-white text-xs font-bold">VP</div>
                                <span class="text-xs text-gray-600 font-semibold">Vijay P.</span>
                            </div>
                            <a href="blog-details1.php?id=5" class="inline-flex items-center gap-1 text-primary font-heading font-bold text-sm hover:text-secondary transition-colors">
                                Read More
                                <svg class="w-4 h-4 read-more-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Card 6 -->
                <article class="blog-card bg-white rounded-2xl overflow-hidden shadow-md border border-gray-100" data-category="maintenance" data-title="ibr compliance what every plant engineer must know">
                    <a href="blog-details1.php?id=6">
                        <div class="card-img relative h-52">
                            <img src="https://images.unsplash.com/photo-1560472355-536de3962603?w=600&h=400&fit=crop&q=80"
                                alt="Blog 6" class="w-full h-full object-cover" loading="lazy">
                            <div class="absolute top-4 left-4">
                                <span class="badge-tips text-white text-[11px] font-heading font-bold px-3 py-1 rounded-full uppercase tracking-wide">Maintenance Tips</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <div class="flex items-center gap-4 text-gray-400 text-xs mb-3">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Feb 20, 2026
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                6 min read
                            </span>
                        </div>
                        <a href="blog-details1.php?id=6">
                            <h3 class="text-base font-heading font-bold text-gray-900 mb-2 hover:text-primary transition-colors line-clamp-2 leading-snug">
                                IBR Compliance: What Every Plant Engineer Must Know
                            </h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed">
                            An in-depth look at Indian Boiler Regulations and how they impact your pipe and valve procurement decisions in power and process plants.
                        </p>
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center text-white text-xs font-bold">NK</div>
                                <span class="text-xs text-gray-600 font-semibold">Nitin K.</span>
                            </div>
                            <a href="blog-details1.php?id=6" class="inline-flex items-center gap-1 text-primary font-heading font-bold text-sm hover:text-secondary transition-colors">
                                Read More
                                <svg class="w-4 h-4 read-more-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </article>

            </div>

            
        </div>
    </section>
<?php include 'assets/include/footer.php'; ?>

    <script>
    (function() {
        const searchInput = document.getElementById('blogSearch');
        const filterBtns = document.querySelectorAll('.filter-tab');
        const cards = document.querySelectorAll('#blogGrid .blog-card');
        const noResults = document.getElementById('noResults');

        let activeFilter = 'all';
        let searchQuery = '';

        function applyFilters() {
            let visibleCount = 0;
            cards.forEach(card => {
                const category = card.dataset.category || '';
                const title = card.dataset.title || '';
                const matchesFilter = activeFilter === 'all' || category === activeFilter;
                const matchesSearch = searchQuery === '' || title.includes(searchQuery.toLowerCase());
                if (matchesFilter && matchesSearch) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            noResults.classList.toggle('hidden', visibleCount > 0);
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                activeFilter = this.dataset.filter;
                applyFilters();
            });
        });

        searchInput.addEventListener('input', function() {
            searchQuery = this.value.trim();
            applyFilters();
        });
    })();
    </script>
</body>
</html>