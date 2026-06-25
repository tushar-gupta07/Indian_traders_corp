<?php header('X-Robots-Tag: index, follow'); ?>
<!DOCTYPE html>
<html lang="en">
<!-- ============================================================ -->
<!-- SEO-OPTIMIZED <head> for Indian Traders Corp                 -->
<!-- Replace your existing <head> block with this                 -->
<!-- ============================================================ -->
<head>
    <!-- ✅ Charset & Viewport (already had these) -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ FIX 1: Title — expanded to 65 chars with keywords -->
    <title>Indian Traders Corp | Industrial Valves, Pipes &amp; Fittings — Nagpur</title>

    <!-- ✅ FIX 2: Meta Description — critical for search snippets -->
   <meta name="description" content="Indian Traders Corp — Leading supplier of industrial valves, pipes & fittings in Nagpur. ISO, ISI, ASTM, IBR certified. 20+ years of trusted excellence.">

    <!-- ✅ FIX 3: Robots tag — tells Google to index and follow links -->
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <!-- ✅ FIX 4: Meta Keywords (less important today, but doesn't hurt) -->
    <meta name="keywords" content="industrial valves, pipes fittings, gate valve, ball valve, butterfly valve, flanges, IBR pipes, GI pipes, SS pipes, Nagpur, India, ISO certified valves">
    <meta name="publisher" content="Indian Traders Corp">
    <meta name="author" content="Indian Traders Corp">

    <!-- ✅ FIX 5: Canonical URL — prevent duplicate page issues -->
    <!-- IMPORTANT: Replace inndiantraderscorp.com with your actual domain -->
    <link rel="canonical" href="https://www.indiantraderscorp.com/">

    <!-- ✅ FIX 6: Open Graph tags — for WhatsApp, LinkedIn, Facebook sharing -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Indian Traders Corp | Industrial Valves, Pipes &amp; Fittings">
    <meta property="og:description" content="Leading supplier of industrial valves, pipes &amp; fittings in India. ISO, ISI, ASTM, IBR certified. 20+ years of excellence.">
    <meta property="og:url" content="https://www.indiantraderscorp.com/">
    <meta property="og:site_name" content="Indian Traders Corp">
    <!-- Replace with your actual OG image (1200x630px recommended) -->
    <meta property="og:image" content="https://www.indiantraderscorp.com/assets/images/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_IN">

    <!-- ✅ FIX 7: Twitter Card tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Indian Traders Corp | Industrial Valves, Pipes &amp; Fittings">
    <meta name="twitter:description" content="Leading supplier of industrial valves, pipes &amp; fittings in India. ISO, ISI, ASTM certified. 20+ years of excellence.">
    <meta name="twitter:image" content="https://www.indiantraderscorp.com/assets/images/og-image.jpg">

    <!-- ✅ FIX 8: Favicon (add your actual favicon file) -->
    <link rel="icon" type="image/x-icon" href="/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="/assets/images/apple-touch-icon.png">
 <style>
        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Brand card size chota */
        .animate-scroll>div {
            min-width: 110px !important;
            padding: 12px 16px !important;
            border-radius: 12px !important;
        }

        .animate-scroll>div img {
            height: 65px !important;
            width: 130px !important;
        }

        .animate-scroll {
            gap: 20px !important;
        }

        .brands-track:hover .animate-scroll {
            animation-play-state: paused;
        }


        .banner-section {
            height: auto;
            /* Default mobile */
            min-height: 150px;
        }


        .banner-slide {
            position: absolute !important;
            width: 100% !important;
            height: 100% !important;
            opacity: 0 !important;
            transition: opacity 1s ease-in-out !important;
        }

        .banner-slide.active {
            opacity: 1 !important;
            z-index: 1 !important;
        }

        .banner-img {
            width: 100%;
            height: auto;
            object-fit: fill;
            object-position: center;
            display: block;
        }

        .banner-arrow {
            width: 35px;
            height: 35px;
            padding: 8px;
            color: #333;
        }

        .banner-arrow svg {
            width: 20px;
            height: 20px;
        }

        .banner-arrow:hover {
            background: white !important;
            transform: translateY(-50%) scale(1.1) !important;
        }

        /* Dots - mobile size */
        .banner-dot {
            width: 8px;
            height: 8px;
        }

        .banner-dot:hover {
            opacity: 1 !important;
            transform: scale(1.2);
        }

        /* ============================================ */
        /* TABLET: 640px and above                     */
        /* ============================================ */
        @media (min-width: 640px) {
            .banner-section {
                height: 320px;
                /* Taller on tablet */
            }

            .banner-img {
                object-fit: cover;
                /* Fill space on tablet */
            }

            .banner-arrow {
                width: 45px;
                height: 45px;
                padding: 10px;
            }

            .banner-arrow svg {
                width: 24px;
                height: 24px;
            }

            .banner-arrow-left {
                left: 15px;
            }

            .banner-arrow-right {
                right: 15px;
            }

            .banner-dot {
                width: 10px;
                height: 10px;
            }
        }

        /* ============================================ */
        /* DESKTOP: 1024px and above                   */
        /* ============================================ */
        @media (min-width: 1024px) {
            .banner-section {
                height: 450px;
                /* Full height on desktop */
            }

            .banner-img {
                object-fit: cover;
                /* Fill space beautifully */
            }

            .banner-arrow {
                width: 50px;
                height: 50px;
                padding: 12px;
            }

            .banner-arrow svg {
                width: 26px;
                height: 26px;
            }

            .banner-arrow-left {
                left: 20px;
            }

            .banner-arrow-right {
                right: 20px;
            }

            .banner-dot {
                width: 12px;
                height: 12px;
            }
        }

        /* ============================================ */
        /* LARGE DESKTOP: 1440px and above             */
        /* ============================================ */
        @media (min-width: 1440px) {
            .banner-section {
                height: 550px;
                /* Even taller for large screens */
            }
        }

        /* ============================================ */
        /* PRODUCT SKELETON LOADING                    */
        /* ============================================ */
        .product-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s ease-in-out infinite;
            border-radius: 0.75rem;
        }

        @keyframes skeleton-loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .product-item {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Review Carousel Responsive Styles */
        @media (max-width: 767px) {
            .review-carousel-track {
                display: flex;
            }

            .review-card {
                width: 100% !important;
                flex-shrink: 0;
            }
        }

        @media (min-width: 768px) {
            .review-carousel-track {
                display: flex;
            }

            .review-card {
                width: 33.333333% !important;
                flex-shrink: 0;
            }
        }

        .brands-track img {
            width: 150px !important;
            height: 80px !important;
            max-width: 150px !important;
            max-height: 80px !important;
            object-fit: contain !important;
        }

        .brands-track img[alt="Hawa Engineering"],
        .brands-track img[alt="Hawa Engineering"][class] {
            width: 170px !important;
            height: 80px !important;
            max-width: 150px !important;
            max-height: 80px !important;
            object-fit: contain !important;
            transform: scale(1.2) !important;
        }

        .brands-track img[alt="Hydroline"],
        .brands-track img[alt="Hydroline"][class] {
            width: 150px !important;
            height: 80px !important;
            max-width: 150px !important;
            max-height: 80px !important;
            object-fit: contain !important;
            transform: scale(1.2) !important;
        }
        /* ============================================================ */
/* SECTION SPACING FIX - Desktop & Mobile                      */
/* Paste this in your style.css or add in <style> tag          */
/* ============================================================ */

/* --- Desktop (default) --- */
section {
    padding-top: 48px !important;
    padding-bottom: 48px !important;
}

/* Certification ribbon - thoda kam spacing */
section.bg-white.border-y-2 {
    padding-top: 24px !important;
    padding-bottom: 24px !important;
}

/* Banner section - no padding */
section.banner-section {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

/* --- Mobile (max 767px) --- */
@media (max-width: 767px) {
    section {
        padding-top: 32px !important;
        padding-bottom: 32px !important;
    }

    section.bg-white.border-y-2 {
        padding-top: 16px !important;
        padding-bottom: 16px !important;
    }

    section.banner-section {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }
}
    </style>
    <!-- ✅ FIX 9: JSON-LD Schema Markup (LocalBusiness + Organization) -->
    <!-- This enables rich results in Google: star ratings, address, phone, hours -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "LocalBusiness",
          "@id": "https://www.indiantraderscorp.com/#localbusiness",
          "name": "Indian Traders Corp",
          "description": "Leading supplier of industrial valves, pipes and fittings in India. ISO, ISI, ASTM, IBR certified products with 20+ years of excellence.",
          "url": "https://www.indiantraderscorp.com/",
          "telephone": "+91-712-2345678",
          "email": "info@indiantraderscorp.com",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "YOUR STREET ADDRESS HERE",
            "addressLocality": "Nagpur",
            "addressRegion": "Maharashtra",
            "postalCode": "440001",
            "addressCountry": "IN"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": "21.1458",
            "longitude": "79.0882"
          },
          "openingHoursSpecification": [
            {
              "@type": "OpeningHoursSpecification",
              "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
              "opens": "09:00",
              "closes": "18:00"
            }
          ],
          "image": "https://www.indiantraderscorp.com/assets/images/og-image.jpg",
          "priceRange": "$$",
          "currenciesAccepted": "INR",
          "paymentAccepted": "Cash, Bank Transfer, Cheque",
          "hasMap": "https://maps.google.com/?q=Indian+Traders+Corp+Nagpur",
          "sameAs": [
            "https://www.facebook.com/yourpage",
            "https://www.linkedin.com/company/yourcompany"
          ]
        },
        {
          "@type": "Organization",
          "@id": "https://www.indiantraderscorp.com/#organization",
          "name": "Indian Traders Corp",
          "url": "https://www.indiantraderscorp.com/",
          "logo": {
            "@type": "ImageObject",
            "url": "https://www.indiantraderscorp.com/assets/images/logo.png",
            "width": 200,
            "height": 60
          },
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91-712-2345678",
            "contactType": "sales",
            "availableLanguage": ["English", "Hindi"]
          }
        },
        {
          "@type": "WebSite",
          "@id": "https://www.indiantraderscorp.com/#website",
          "name": "Indian Traders Corp",
          "url": "https://www.indiantraderscorp.com/",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://www.indiantraderscorp.com/search?q={search_term_string}",
            "query-input": "required name=search_term_string"
          }
        }
      ]
    }
    </script>

    <!-- Tailwind CSS (keep as-is for now) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#0a2463', dark: '#071940', light: '#1e3a8a' },
                        secondary: { DEFAULT: '#0a2463', dark: '#b71c1c', light: '#e53935' },
                        accent: '#1e3a8a',
                    },
                    boxShadow: { 'custom': '0 10px 40px rgba(0, 0, 0, 0.15)' },
                    animation: {
                        'scroll': 'scroll 80s linear infinite',
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'skeleton': 'skeleton 1.5s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- ... rest of your existing <style> block here ... -->
</head>
  
<body class="bg-gray-50">

    <!-- ============================================================ -->
    <!-- RESPONSIVE BANNER - PERFECT FOR ALL DEVICES                 -->
    <!-- Mobile: Shows complete image | Desktop: Fills beautifully   -->
    <!-- ============================================================ -->

    <?php include 'assets/include/header.php'; ?>

    <?php include 'assets/include/modal.php'; ?>

    <!-- Responsive Banner Section -->
    <section class="banner-section" style="width: 100%; position: relative; overflow: hidden; margin: 0; padding: 0;">
        <!-- Slides Container -->
        <div style="position: relative; width: 100%; height: 100%;">

            <!-- Slide 1 - NO lazy loading for first visible slide -->
            <div class="banner-slide active"
                style="position: absolute; width: 100%; height: 100%; opacity: 1; transition: opacity 1s ease;">
                <img src="assets/images/crousel1.jpg" alt="Industrial Products" class="banner-img">
            </div>

            <!-- Slide 2 - WITH lazy loading -->
            <div class="banner-slide"
                style="position: absolute; width: 100%; height: 100%; opacity: 0; transition: opacity 1s ease;">
                <img src="assets/images/crousel2.jpg" alt="Industrial Products" class="banner-img" loading="lazy">
            </div>

            <!-- Slide 3 - WITH lazy loading -->
            <div class="banner-slide"
                style="position: absolute; width: 100%; height: 100%; opacity: 0; transition: opacity 1s ease;">
                <img src="assets/images/crousel3.jpg" alt="Industrial Products" class="banner-img" loading="lazy">
            </div>

            <!-- Slide 4 - WITH lazy loading -->
            <div class="banner-slide"
                style="position: absolute; width: 100%; height: 100%; opacity: 0; transition: opacity 1s ease;">
                <img src="assets/images/crousel4.jpg" alt="Industrial Products" class="banner-img" loading="lazy">
            </div>

            <!-- Slide 5 - WITH lazy loading -->
            <div class="banner-slide"
                style="position: absolute; width: 100%; height: 100%; opacity: 0; transition: opacity 1s ease;">
                <img src="assets/images/crousel5.jpg" alt="Industrial Products" class="banner-img" loading="lazy">
            </div>

            <!-- Slide 6 - WITH lazy loading -->
            <div class="banner-slide"
                style="position: absolute; width: 100%; height: 100%; opacity: 0; transition: opacity 1s ease;">
                <img src="assets/images/crousel6.jpg" alt="Industrial Products" class="banner-img" loading="lazy">
            </div>
        </div>

        <!-- Navigation Arrows -->
        <button onclick="bannerPrev()" class="banner-arrow banner-arrow-left"
            style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.9); border: none; border-radius: 50%; cursor: pointer; z-index: 10; transition: all 0.3s; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
            <svg style="display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        <button onclick="bannerNext()" class="banner-arrow banner-arrow-right"
            style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: rgba(255,255,255,0.9); border: none; border-radius: 50%; cursor: pointer; z-index: 10; transition: all 0.3s; box-shadow: 0 2px 10px rgba(0,0,0,0.2);">
            <svg style="display: block;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Slide Indicators -->
        <div class="banner-dots"
            style="position: absolute; bottom: 15px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 10;">
            <span class="banner-dot" onclick="bannerGoTo(0)"
                style="cursor: pointer; border-radius: 50%; background: white; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.3); opacity: 1;"></span>
            <span class="banner-dot" onclick="bannerGoTo(1)"
                style="cursor: pointer; border-radius: 50%; background: white; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.3); opacity: 0.5;"></span>
            <span class="banner-dot" onclick="bannerGoTo(2)"
                style="cursor: pointer; border-radius: 50%; background: white; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.3); opacity: 0.5;"></span>
            <span class="banner-dot" onclick="bannerGoTo(3)"
                style="cursor: pointer; border-radius: 50%; background: white; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.3); opacity: 0.5;"></span>
            <span class="banner-dot" onclick="bannerGoTo(4)"
                style="cursor: pointer; border-radius: 50%; background: white; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.3); opacity: 0.5;"></span>
            <span class="banner-dot" onclick="bannerGoTo(5)"
                style="cursor: pointer; border-radius: 50%; background: white; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.3); opacity: 0.5;"></span>
            <span class="banner-dot" onclick="bannerGoTo(6)"
                style="cursor: pointer; border-radius: 50%; background: white; transition: all 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.3); opacity: 0.5;"></span>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- RESPONSIVE BANNER CSS - ADAPTS TO ALL SCREEN SIZES          -->
    <!-- ============================================================ -->


    <!-- ============================================================ -->
    <!-- BANNER JAVASCRIPT - SELF-CONTAINED                          -->
    <!-- ============================================================ -->

    <!-- Certification Ribbon - Mobile Responsive -->


    <!-- Certification Ribbon - Mobile Responsive -->
    <section class="bg-white border-y-2 border-gray-200 py-6 sm:py-8 overflow-hidden">
        <div class="container mx-auto px-4 mb-3 sm:mb-4">
            <h2 class="text-center text-gray-700 font-bold text-sm sm:text-base md:text-lg">
                CERTIFIED & COMPLIANT WITH INTERNATIONAL STANDARDS
            </h2>
        </div>
        <div class="relative flex overflow-hidden">
            <div class="flex animate-scroll">
                <!-- First set of logos -->
                <div class="flex items-center space-x-8 sm:space-x-12 md:space-x-16 px-4 sm:px-8">

                    <!-- ISO -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/ISOn.png"
                                alt="ISO Certified" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-800">ISO</div>
                                    <div class="text-xs text-gray-600">9001:2008</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ISO 9001:2008</span>
                    </div>

                    <!-- ISI -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/isi2.png"
                                alt="ISI Certified" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-700">ISI</div>
                                    <div class="text-xs text-gray-600">CERTIFIED</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ISI Certified</span>
                    </div>

                    <!-- ASTM -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/astm.png"
                                alt="ASTM Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-red-700">ASTM</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ASTM Grade</span>
                    </div>

                    <!-- IBR -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/ibr.png"
                                alt="IBR Approved" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-700">IBR</div>
                                    <div class="text-xs text-gray-600">APPROVED</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">IBR Approved</span>
                    </div>

                    <!-- JIS -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/JIS.png"
                                alt="JIS Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-700">JIS</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">JIS Standard</span>
                    </div>

                    <!-- DIN -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/DIN2.png"
                                alt="DIN Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-900">DIN</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">DIN Standard</span>
                    </div>

                    <!-- ASME -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/asme.png"
                                alt="ASME Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-teal-700">ASME</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ASME Standard</span>
                    </div>

                </div>

                <!-- Duplicate set for seamless loop -->
                <div class="flex items-center space-x-8 sm:space-x-12 md:space-x-16 px-4 sm:px-8">

                    <!-- ISO -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/ISOn.png"
                                alt="ISO Certified" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-800">ISO</div>
                                    <div class="text-xs text-gray-600">9001:2008</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ISO 9001:2008</span>
                    </div>

                    <!-- ISI -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/isi2.png"
                                alt="ISI Certified" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-green-700">ISI</div>
                                    <div class="text-xs text-gray-600">CERTIFIED</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ISI Certified</span>
                    </div>

                    <!-- ASTM -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/astm.png"
                                alt="ASTM Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-red-700">ASTM</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ASTM Grade</span>
                    </div>

                    <!-- IBR -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/ibr.png"
                                alt="IBR Approved" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-700">IBR</div>
                                    <div class="text-xs text-gray-600">APPROVED</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">IBR Approved</span>
                    </div>

                    <!-- JIS -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/JIS.png"
                                alt="JIS Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-orange-700">JIS</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">JIS Standard</span>
                    </div>

                    <!-- DIN -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/DIN2.png"
                                alt="DIN Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-900">DIN</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">DIN Standard</span>
                    </div>

                    <!-- ASME -->
                    <div class="flex flex-col items-center min-w-[120px] sm:min-w-[140px] md:min-w-[160px]">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28 flex items-center justify-center bg-white rounded-xl p-2 border-2 border-gray-100 shadow-sm">
                            <img src="./assets/images/asme.png"
                                alt="ASME Standard" class="w-full h-full object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                            <div style="display:none" class="w-full h-full items-center justify-center">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-teal-700">ASME</div>
                                    <div class="text-xs text-gray-600">STANDARD</div>
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-600 mt-2 font-semibold text-center">ASME Standard</span>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================ -->
    <!-- PRODUCT GRID - 18 PRODUCTS ONLY                             -->
    <!-- Desktop: 6-6-6 (3 rows) | Mobile: 2-2-2-2-2-2 (6 rows)      -->
    <!-- With Skeleton Loading + Lazy Loading                        -->
    <!-- ============================================================ -->
    <!-- ============================================================ -->
    <!-- PRODUCT SECTION - 2 cols mobile, 6 cols desktop            -->
    <!-- ============================================================ -->
    <section class="py-12 sm:py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10 sm:mb-12 md:mb-16">
                <div class="inline-block bg-red-100 text-secondary px-3 py-1 sm:px-4 rounded-full text-xs sm:text-sm font-bold mb-3 sm:mb-4">
                    OUR SPECIALIZATION
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-primary mb-3 sm:mb-4 px-4">
                    Complete Product Range</h2>
                <p class="text-gray-600 text-sm sm:text-base md:text-lg max-w-2xl mx-auto px-4">
                    From valves to fittings, we provide everything you need for your industrial requirements
                </p>
            </div>

            <!-- Skeleton Loader -->
            <div id="productSkeleton" class="grid grid-cols-2 md:grid-cols-6 gap-3 sm:gap-4 max-w-full mx-auto">
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
                <div class="product-skeleton aspect-square"></div>
            </div>

            <!-- Actual Product Grid -->
            <div id="productGrid" class="grid grid-cols-2 md:grid-cols-6 gap-3 sm:gap-4 max-w-full mx-auto" style="display: none;">

                <!-- 1. Gate Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('gate-valve')" style="animation-delay: 0.05s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Gate-Valve-1.png" alt="Gate Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Gate Valve
                    </div>
                </div>

                <!-- 2. Globe Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('globe-valve')" style="animation-delay: 0.1s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Globe-Valve-1.png" alt="Globe Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Globe Valve
                    </div>
                </div>

                <!-- 3. Non Return Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('non-return-valve')" style="animation-delay: 0.15s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Non-return-Valve-1.png" alt="Non Return Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Non Return
                    </div>
                </div>

                <!-- 4. Ball Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('ball-valve')" style="animation-delay: 0.2s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Ball-Valve.png" alt="Ball Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Ball Valve
                    </div>
                </div>

                <!-- 5. Butterfly Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('butterfly-valve')" style="animation-delay: 0.25s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Butterfly-Valve.png" alt="Butterfly Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Butterfly
                    </div>
                </div>

                <!-- 6. Knife Edge Gate Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('knife-edge-gate-valve')" style="animation-delay: 0.3s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/knife-Edge-gate-valve.png" alt="Knife Edge Gate Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Knife Edge
                    </div>
                </div>

                <!-- 7. Piston Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('piston-valve')" style="animation-delay: 0.35s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/piston-valve.png" alt="Piston Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Piston Valve
                    </div>
                </div>

                <!-- 8. Plug Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('plug-valve')" style="animation-delay: 0.4s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Plug-Valve.png" alt="Plug Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Plug Valve
                    </div>
                </div>

                <!-- 9. Diaphragm Valve -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('diaphragm-valve')" style="animation-delay: 0.45s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Diaphagram-valves.jpg" alt="Diaphragm Valve" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Diaphragm
                    </div>
                </div>

                <!-- 10. Strainer -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('strainer')" style="animation-delay: 0.5s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Strainers.png" alt="Strainer" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Strainers
                    </div>
                </div>

                <!-- 11. Safety Valves -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('safety-valve')" style="animation-delay: 0.55s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Safety-Valves.png" alt="Safety Valves" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Safety Valve
                    </div>
                </div>

                <!-- 12. PRV -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('prv')" style="animation-delay: 0.6s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/PRV.png" alt="PRV" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        PRV
                    </div>
                </div>

                <!-- 13. Air Valves -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('air-valve')" style="animation-delay: 0.65s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Air-alves.png" alt="Air Valves" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Air Valves
                    </div>
                </div>

                <!-- 14. Flanges -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('flanges')" style="animation-delay: 0.7s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/Flanges.png" alt="Flanges" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        Flanges
                    </div>
                </div>

                <!-- 15. MS Pipes -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('ms-pipes')" style="animation-delay: 0.75s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/MS-pipes-Fittings.png" alt="MS Pipes Fittings" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        MS Pipes
                    </div>
                </div>

                <!-- 16. IBR Pipes -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('ibr-pipes')" style="animation-delay: 0.8s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/IBR-Pipes-Fittings.png" alt="IBR Pipes Fittings" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        IBR Pipes
                    </div>
                </div>

                <!-- 17. GI Pipes -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('gi-pipes')" style="animation-delay: 0.85s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/GI-pipes-Fittings.png" alt="GI Pipes Fittings" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        GI Pipes
                    </div>
                </div>

                <!-- 18. SS Pipes -->
                <div class="product-item group bg-gray-50 rounded-lg sm:rounded-xl overflow-hidden hover:shadow-2xl transition-all duration-300 border-2 border-red-200 hover:border-secondary cursor-pointer transform hover:scale-105"
                    onclick="viewProduct('ss-pipes')" style="animation-delay: 0.9s">
                    <div class="aspect-square bg-white flex items-center justify-center p-2 group-hover:bg-gray-50 transition">
                        <img src="./assets/images/SS-Pipes-Fittings.png" alt="SS Pipes Fittings" class="w-full h-full object-contain" loading="lazy">
                    </div>
                    <div class="bg-primary text-white text-center py-1.5 sm:py-2 text-[9px] sm:text-xs font-bold truncate px-1">
                        SS Pipes
                    </div>
                </div>

            </div>
        </div>
    </section>




    <!-- ============================================================ -->
    <!-- BRANDS SECTION - TEXT-BASED BADGES                           -->
    <!-- ============================================================ -->
    <!-- 
=================================================================
COPY-PASTE READY: Brands Section with Click → brands.php redirect
SIRF YEH 2 CHEEZEIN CHANGE KI HAIN:
1. Har brand div pe onclick="window.location.href='brands.php'" add kiya
2. cursor-pointer already tha, ab actually kaam karega
=================================================================
-->

    <section class="py-8 bg-gradient-to-br from-primary to-primary-dark">
        <div class="container mx-auto px-4">

            <!-- Section Header - "View All Brands" button bhi add kiya -->
            <div class="text-center mb-10 sm:mb-12">
                <div class="inline-block bg-white/20 text-white px-4 py-1 rounded-full text-sm font-bold mb-4">
                    TRUSTED BRANDS
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-3">
                    Our Brand Partners
                </h2>
                <p class="text-white/75 text-sm mt-2">Click any brand to explore our complete partner network</p>
            </div>

            <!-- Brands Slider -->
            <div class="relative overflow-hidden">
                <div class="brands-track flex items-center">

                    <!-- ===== FIRST SET ===== -->
                    <div class="flex items-center gap-10 sm:gap-14 animate-scroll">

                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Aeroflex pneumatics logo.png" alt="Aeroflex" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Aira euro automation logo.png" alt="Aira Euro Automation" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Airmax pneumatics.png" alt="Airmax Pneumatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Akari Pneumatics.png" alt="Akari Pneumatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Akvalo-Photoroom.png" alt="Akvalo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Alto Valves.png" alt="Alto Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Arbuda Instruments logo-Photoroom.png" alt="Arbuda Instruments" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Armor Fire logo 2.png" alt="Armor Fire" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Armor Fire Logo.png" alt="Armor Fire Logo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/B&M Forge fittings.png" alt="B&M Forge Fittings" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Baumer_Logo.svg.png" alt="Baumer" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Cair.png" alt="Cair" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/cropped-kimax-logo-1-1-162x54.png" alt="Kimax" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Danfoss Logo.png" alt="Danfoss" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Dowty Hydraulics-Photoroom.png" alt="Dowty Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Easyflex.png" alt="Easyflex" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Eaton Logo.png" alt="Eaton" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Elems -Photoroom.png" alt="Elems" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/festo.png" alt="Festo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Force logo-Photoroom.png" alt="Force" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Gokul Poly Valves.png" alt="Gokul Poly Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/hawa engineering.png" alt="Hawa Engineering" style="height:80px !important;width:150px !important;object-fit:contain;">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/hydint-Photoroom.png" alt="Hydint" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Hydroline products logo.png" alt="Hydroline" style="height:85px !important;width:160px !important;object-fit:contain;">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Jacktech Hydraulics.png" alt="Jacktech Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/janatics.png" alt="Janatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Kartar.png" alt="Kartar" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Koojan Hydraulcis logo 2.png" alt="Koojan Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/kranti.png" alt="Kranti" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Logo_Force.png" alt="Force" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Mahavir Valves Logo.png" alt="Mahavir Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/marck logos.png" alt="Marck" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Mercury logo 2.png" alt="Mercury" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Mercury Logo.png" alt="Mercury Logo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/MSL Logo.png" alt="MSL" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Newage Fire fighting co. ltd logo.png" alt="Newage Fire Fighting" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Normex Valves Logo.png" alt="Normex Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/PMW .png" alt="PMW" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Polyhose logo.png" alt="Polyhose" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Polyhydron Logo.png" alt="Polyhydron" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Qinn Logo.png" alt="Qinn" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Rajdeep.png" alt="Rajdeep" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Shital metal products.png" alt="Shital Metal Products" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Supremo Gear Pumps.png" alt="Supremo Gear Pumps" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Surya Prakash steel tubes logo.png" alt="Surya Prakash" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Suzhik Valves (2).png" alt="Suzhik Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Techno Pneumatics logo.png" alt="Techno Pneumatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Torque-Photoroom.png" alt="Torque" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/UPC Logo.png" alt="UPC" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/UPC Valves Logo.png" alt="UPC Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/VBC hydraulics.png" alt="VBC Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/veljan.png" alt="Veljan" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Vickers logo.png" alt="Vickers" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Yuken Logo.png" alt="Yuken" class="h-16 w-36 object-contain">
                        </div>

                    </div>
                    <!-- END FIRST SET -->

                    <!-- ===== DUPLICATE SET FOR SEAMLESS LOOP ===== -->
                    <div class="flex items-center gap-10 sm:gap-14 animate-scroll" aria-hidden="true">

                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Aeroflex pneumatics logo.png" alt="Aeroflex" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Aira euro automation logo.png" alt="Aira Euro Automation" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Airmax pneumatics.png" alt="Airmax Pneumatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Akari Pneumatics.png" alt="Akari Pneumatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Akvalo-Photoroom.png" alt="Akvalo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Alto Valves.png" alt="Alto Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Arbuda Instruments logo-Photoroom.png" alt="Arbuda Instruments" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Armor Fire logo 2.png" alt="Armor Fire" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Armor Fire Logo.png" alt="Armor Fire Logo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/B&M Forge fittings.png" alt="B&M Forge Fittings" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Baumer_Logo.svg.png" alt="Baumer" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Cair.png" alt="Cair" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/cropped-kimax-logo-1-1-162x54.png" alt="Kimax" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Danfoss Logo.png" alt="Danfoss" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Dowty Hydraulics-Photoroom.png" alt="Dowty Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Easyflex.png" alt="Easyflex" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Eaton Logo.png" alt="Eaton" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Elems-Photoroom.png" alt="Elems" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/festo.png" alt="Festo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Force logo-Photoroom.png" alt="Force" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Gokul Poly Valves.png" alt="Gokul Poly Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/hawa engineering.png" alt="Hawa Engineering" class="h-16 w-36 object-contain" style="height:85px !important; width:160px !important;">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/hydint-Photoroom.png" alt="Hydint" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Hydroline products logo.png" alt="Hydroline" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Jacktech Hydraulics.png" alt="Jacktech Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/janatics.png" alt="Janatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Kartar.png" alt="Kartar" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Koojan Hydraulcis logo 2.png" alt="Koojan Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/kranti.png" alt="Kranti" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Logo_Force.png" alt="Force" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Mahavir Valves Logo.png" alt="Mahavir Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/marck logos.png" alt="Marck" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Mercury logo 2.png" alt="Mercury" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Mercury Logo.png" alt="Mercury Logo" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/MSL Logo.png" alt="MSL" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Newage Fire fighting co. ltd logo.png" alt="Newage Fire Fighting" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Normex Valves Logo.png" alt="Normex Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/PMW.png" alt="PMW" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Polyhose logo.png" alt="Polyhose" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Polyhydron Logo.png" alt="Polyhydron" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Qinn Logo.png" alt="Qinn" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Rajdeep.png" alt="Rajdeep" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Shital metal products.png" alt="Shital Metal Products" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Supremo Gear Pumps.png" alt="Supremo Gear Pumps" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Surya Prakash steel tubes logo.png" alt="Surya Prakash" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Suzhik Valves (2).png" alt="Suzhik Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Techno Pneumatics logo.png" alt="Techno Pneumatics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Torque-Photoroom.png" alt="Torque" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/UPC Logo.png" alt="UPC" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/UPC Valves Logo.png" alt="UPC Valves" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/VBC hydraulics.png" alt="VBC Hydraulics" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/veljan.png" alt="Veljan" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Vickers logo.png" alt="Vickers" class="h-16 w-36 object-contain">
                        </div>
                        <div onclick="window.location.href='brands.php'" class="flex-shrink-0 bg-white rounded-2xl px-8 py-6 shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105 min-w-[160px] flex items-center justify-center cursor-pointer">
                            <img src="assets/images/ITClogos/Yuken Logo.png" alt="Yuken" class="h-16 w-36 object-contain">
                        </div>

                    </div>
                    <!-- END DUPLICATE SET -->

                </div>
            </div>

            <!-- View All Brands Button -->
            <div class="text-center mt-10">
                <a href="brands.php"
                    class="inline-flex items-center gap-2 bg-white text-primary font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    View All Brand Partners
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

        </div>
    </section>

    <!-- ============================================================ -->
    <!-- DIRECTOR'S MESSAGE SECTION                                   -->
    <!-- ============================================================ -->
    <section class="py-12 sm:py-16 md:py-20 bg-gradient-to-br from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">

                <!-- Section Header -->
                <div class="text-center mb-10 sm:mb-12">
                    <div class="inline-block bg-primary/10 text-primary px-4 py-1 rounded-full text-sm font-bold mb-4">
                        LEADERSHIP MESSAGE
                    </div>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-3">Director's Message</h2>
                </div>

                <!-- Content Container -->
                <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">

                    <!-- Left Side - Image -->
                    <div class="order-2 md:order-1" data-aos="fade-right">
                        <div class="relative">
                            <!-- Main Image Container -->
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                                <img src="https://media.istockphoto.com/id/1507456431/photo/efficient-factory-management-portrait-of-smiling-senior-manager-businessman-or-ceo-in.jpg?s=612x612&w=0&k=20&c=u7FTGoQaOD-LGLX6jd0l6_Ul1wBgaiPcsU7daSgQrto="
                                    alt="Director - Indian Traders Corp" class="w-full h-auto object-cover"
                                    loading="lazy">
                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent"></div>
                            </div>

                            <!-- Decorative Element -->
                            <div
                                class="absolute -bottom-4 -right-4 w-32 h-32 bg-secondary/10 rounded-full blur-3xl -z-10">
                            </div>
                            <div class="absolute -top-4 -left-4 w-32 h-32 bg-primary/10 rounded-full blur-3xl -z-10">
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Text Content -->
                    <div class="order-1 md:order-2" data-aos="fade-left">
                        <!-- Quote Icon -->
                        <div class="mb-6">
                            <svg class="w-12 h-12 text-secondary/30" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 17h3l2-4V7H5v6h3zm8 0h3l2-4V7h-6v6h3z" />
                            </svg>
                        </div>

                        <!-- Message Text -->
                        <div class="space-y-4 text-gray-700 text-base sm:text-lg leading-relaxed mb-6">
                            <p class="font-medium text-xl text-gray-900">
                                "At Indian Traders Corp, we are committed to excellence and innovation in industrial
                                solutions."
                            </p>

                            <p>
                                Since our inception, we have strived to provide the highest quality valves, pipes, and
                                fittings to industries across India. Our dedication to customer satisfaction and product
                                reliability has made us a trusted name in the industrial sector.
                            </p>




                        </div>

                        <!-- Director Info -->
                        <div class="border-l-4 border-secondary pl-6">
                            <h3 class="text-2xl font-bold text-primary mb-1">Mohammad Kapdawala</h3>
                            <p class="text-secondary font-semibold mb-2">Managing Director</p>
                            <p class="text-gray-600 text-sm">Indian Traders Corp</p>
                        </div>

                        <!-- Signature (Optional) -->
                        <div class="mt-6">
                            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAJQAygMBIgACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAABQYBBAcCA//EAD0QAAEEAQIDBAcGBAUFAAAAAAEAAgMEBQYREiExB0FRcRMUIjJhgaEVI0JDUpEWM2KxRHLB0eElJjRTY//EABcBAQEBAQAAAAAAAAAAAAAAAAACAQP/xAAfEQEBAAICAgMBAAAAAAAAAAAAAQIRITESYQNBUTL/2gAMAwEAAhEDEQA/AO4oiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAixvyUdmM7jMJAZstfgqRgdZXgb+Q6lJyJJFRX9ootu209pzM5Rv/ALW1/Qxn4gv5/Rb+nNXT5TLyYjK4a1ib4g9Yjjmc1wljBAJBHeCRy+Krxuha0WAsqQREQEREBERAREQEREBERAREQEREBEWCQOZQCVFah1DitO1DZzFyOuw+6083SHwa0cyfJVTUmu57GQfgtEVRk8sPZknHOCr8XO6Ej9vPotjTXZ/FWuDMamtOzWbPP08/OOH4MZ0Hnt5bKpjrnIawy2sNXHbBVPsHFO/x11gM8g/oj7vM+Kk8L2f4bHWBeuslyuS6m3kHmVwP9IPIfturaBttyXopcr1B4ADQAAAB4KlY132n2q5SzHzhxWOZUJ2/MkdxkfIN+qsmpMzWwGEt5S2QI60ZdsT7x7h8yoTsxw9nG6cFvJA/aeUlddtlw2PG/mBt3bDbkmPEtFuCyiKQREQEREBERAREQEREBERAREQEREHl7wxpc8hrQNySdgAud2r2V7QbUtLBSy0NNNdwT5NvKS2R1bDv+Hu4lZ9X4+1lqVbHQh3qliyxt4tds70A3LgPMgNPwJUzWrw1oI69eNkUUbQ1jGDYNA6ALZdcjR09gMbp7Hso4mqyCBvhzc4+Lj1JUmBsECys7BYd0WllMrQxFd1nJ3IKsI/HM8NHkN+p+C55qHtSjv7YfRNexeylsFkU3o+FjPFw36+fTkqxwuXQ3Mv/AN8ayixEZ48JhJBNfc33Z7H4Y/jw7EkLoY5DouV6U0braniI6BzVPDwBxc/1WD00z3Hq5zyeZW1n9Csp4e3kcnrHUZfXhc8yNtNjZuBy9kN8fiqyk3rY6Xusqs9nNm9d0Th7OTe6SzLXDnPf1cDvwk+Y2VmUWaugREWAiIgIiICIiAiIgIiICIiAiIgbBYWT0UVqLPY7T+Mfeyc4jibya0c3SO7mtHeU1sSM8scMTpZZGxxsBc97jsGgdST3Ln1zXGS1DbkxugKjbXA7hnytjcV4f8v6j3/6FIcJmNeSMu6pZJj8IHh8GGa725QOjpj9eFXynVr0a8dWpDHDBGNmRxtDQ0K+MfdFBk0dh8HVn1Jra9Lmrldhe+W1/LZ/THH069FIdn2IszPm1Tm4mx5HIMDa9YD2adYe6xvxPUnyWhKG9oGqzXHt6cwk332x9m3aH4T4tb/quhgePctyysmqMlc11TM/XuoGaVxrz9kUpBJl7TDycR0hB8d+v/C+2f1Lf1PlpdMaKmawsH/UMqPaZWae5ni48+/u+Yt+m8DQ03iYsdjIuCKMc3Hm6R3e5x7ysk8e+xJwxRwxMiiYGRsaGtaBsGgDYBfRa127VoVnWLtiKvC3rJI8NAVNn1+7JzOraLxNjMyA8Jsn7qqw/F597yH7qZLRelW85rrTmFkMNrJxPs9PV6/3shPhwt35qG/hDO588ess88V3jnjMZvFFt4Of7zuvw6KOyJq0rrtIdnWOrQZJwAuX2M3bRYepc7qXnuCqYzfYuGlNVY7VVWexizNw15fRSCWMsIdtv0Knj0VHjv4Ps/xlbBUxNfyT/abUgHHYsyHmXu8N+u55AL5jT+pdVES6nyDsVj3dMVjpPacPCSXr8gFlxm/QslvVGCp3oqNnL047crwxkRlHFxHoCB0+amAuRa67NLDXYhuisXTjirPMkvE4Bzngt4S4nm4cit06D1bqUcWsNUyQ13D2qOOHCPIu6fQqvDHUuxcc1rPTuELhkcxVjkH5bX8b/wBgqu7tVZfJZpfTuWzB6CVkRjiJ+Lue37KcwXZzpbB8JqYqKSUfm2PvHb/NWprQ0BrQA0dAFm8J9bHORl+1DItcaunsVjgenrU5e4fsdvogxnanN7cmcxMJ/S2Hcf2XSETz9Ciad1DqKlmocFrOrC2WyD6nkK38qZwG5YfB23MeOxV7Xh8bX7cTQ4A7jfuK9qcrLzoERFgIi1MnkK2Moz3rsrYq9dpfI93cEGnqXUFPTmKlv3+Itb7McUfN8zzyDWjvJVb03pu7lsrHqnWDGm91o48nijos7vN56k939vOl8fa1RlI9WZ+FzIW7nEUJPyWd0rh+t3X4K+bbKrfGagx7qpevczakkg0tgXgZjKN2c8H/AMWDo6U+HLkPopnV+o62msU63K0zWHkRVqzPenldya0fNcfyseoqGako2KGRt5HKxie9LT3YZC73a7ZNvYiaPe25kk9Aq+PHYuljV2ntCYluFwUD8hJQj+9ZXIDGHvdI/oCTvy5n4KJxmV1z2jVJmVG1sFiJWlrrXC5z5Ae5nME+BPLzW/pvs2ibFHc1YKxjh9uHFV+VWuPF2/vu8XH6gLcu6xvZuSXG6Bqwvhgbwz5ax7FWAD9H6tgPJXxP57EHip39kmTp4jLZOrYwl5ks3pWVjHJFI3h67Ekg7gD/AIVj/iLVOo/Z0vh24+keQyGW3aXDxZEOflv9FWey/Tj81qS9qXK3JctWgf6KlZtM/nvHvSBpJDWjo3bxXYWgbKfksl/aKZS7O6U1lt7U92xn7o5g2ztCw8vciHIDl8VcIoI4ImRQMbHGwbNYxoa0DwA7l9UXO23sUHtX1ZLp2hUp05xVs5GQx+tkb+rsG3E4Dvdt0UXp+lmrmPZjtK05MDiCeKbK3Wb3LR/E9rO4nxcf9l02WtBM9j5YY3vjO7HOaCW+R7l74QqmUk1IITTelMXp2J3qMRdZl5z25jxzTHxc881ObLKKN0EREBERAREQEREBERAVCzkX8ZawbgXAuw2I4bGQb0bPMRvHEfEAe0R5K9SuEbHPd0aCSqd2VwcWnJcpJs6xlbk9qR3jvIQPoFWN1LRcmta1oDQAB0AHRaOdy9LBYufJZKYQ1oBu5x6nwAHeSeQC95bKUsPjp7+SsNgrQt4nvd3fLvPwVKxGMu61y0Wf1DC+DDwO48Xi5OXF/wDaUd5PcD05fNJ90e9JYu9qLMDV+pIXQuA2xVB539WiP4yO57v36fK55C9UxlOW7fmZDXhaXSSPOwaF93ERRuc7YNaCSfABcedq3BaluS5rU+SijwlObhx2Ia7iksvbttLJG3mdztsDy8eXXZPLkTBgyvaLI6xkHzYrSLBuyAn0c14D8Tz+FnwXxIOuNtP6VZ9n6Qqu4LduFvB61t+XF4t8T3/32BVz3aK9ovQzYXSw/wANvw2Lv+bb3W/D+/d0LH0a2Oqw1KMEcFaJvCyNg2DQquWgxlGtjKUNKjC2GvA0MjjaOTQFtIi5AiIgIiICIiAiIgIiICIiAiIgIiIPErQ9jmu6EELmmnNUfwnjZNNZDG5GxlKViSOtBWrOcLMbnFzHB3ugbO7zyXTSN1jgC2XXYo2N0xk8/kYczrThAidx08PG7eGue5z/ANb/AKBXlreFZDdvFZS3Y8ubxDYqGq6R07Ut+t1sJj4rG5PpW12h256nfZTaLNjzsvSIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiIP/2Q=="
                                alt="Director Signature" class="h-16 w-auto" loading="lazy">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>





    <!-- ============================================================ -->
    <!-- QUALITY ASSURANCE - COMPACT & PROFESSIONAL                  -->
    <!-- ============================================================ -->
    <section class="pt-10 md:pt-10 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <!-- Section Header - Compact -->
            <div class="text-center mb-12">
                <div
                    class="inline-block bg-primary text-white px-5 py-1.5 rounded-full text-xs font-bold mb-3 shadow-lg uppercase tracking-wider">
                    Quality Guarantee
                </div>
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-primary mb-3">
                    Certified Quality, <span class="text-secondary">Guaranteed Performance</span>
                </h2>
                <div class="w-20 h-1 bg-secondary mx-auto mb-4 rounded-full"></div>
                <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                    Every product meets international standards and comes with manufacturer warranty
                </p>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-6xl mx-auto mb-12">

                <!-- Left: Why Our Quality Matters -->
                <div class="space-y-4">
                    <div
                        class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-primary">
                        <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 mb-1">100% Genuine Products</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Direct from authorized manufacturers with authenticity certificates. No counterfeit
                                items.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-secondary">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 mb-1">Factory Test Certificates</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Complete test reports and material certificates with every order.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-primary">
                        <div class="flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 mb-1">Extended Warranty Support</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Manufacturer warranty plus our after-sales support for defective products.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border-l-4 border-secondary">
                        <div
                            class="flex-shrink-0 w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-gray-900 mb-1">Pre-Delivery Inspection</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Every valve checked before dispatch. Zero defect delivery guarantee.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Certifications Grid -->
                <div>
                    <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-5 text-center">Our Certifications</h3>

                        <!-- Certifications Grid - Smaller -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <!-- ISO -->
                            <div
                                class="text-center p-3 bg-gradient-to-br from-blue-50 to-white rounded-lg border-2 border-blue-100 hover:border-blue-300 transition-colors">

                                <img src="./assets/images/ISOn.png"
                                    alt="ISO Certification"
                                    class="h-12 mx-auto mb-2 object-contain">
                                <div class="text-xs text-gray-600 font-semibold">9001:2008</div>
                                <div class="text-xs text-gray-500 mt-0.5">Quality Management</div>
                            </div>

                            <!-- IBR -->
                            <div
                                class="text-center p-3 bg-gradient-to-br from-purple-50 to-white rounded-lg border-2 border-purple-100 hover:border-purple-300 transition-colors">
                                <img src="./assets/images/ibr.png"
                                    alt="IBR Certification"
                                    class="h-12 mx-auto mb-2 object-contain">
                                <div class="text-xs text-gray-600 font-semibold">APPROVED</div>
                                <div class="text-xs text-gray-500 mt-0.5">Boiler Standards</div>
                            </div>

                            <!-- ASTM -->
                            <div
                                class="text-center p-3 bg-gradient-to-br from-red-50 to-white rounded-lg border-2 border-red-100 hover:border-red-300 transition-colors">
                                <img src="./assets/images/astm.png"
                                    alt="ASTM Certification"
                                    class="h-12 mx-auto mb-2 object-contain">
                                <div class="text-xs text-gray-600 font-semibold">STANDARD</div>
                                <div class="text-xs text-gray-500 mt-0.5">Material Grade</div>
                            </div>

                            <!-- ISI -->
                            <div
                                class="text-center p-3 bg-gradient-to-br from-green-50 to-white rounded-lg border-2 border-green-100 hover:border-green-300 transition-colors">
                                <img src="./assets/images/isi2.png"
                                    alt="ISI Certification"
                                    class="h-12 mx-auto mb-2 object-contain">
                                <div class="text-xs text-gray-600 font-semibold">CERTIFIED</div>
                                <div class="text-xs text-gray-500 mt-0.5">Indian Standards</div>
                            </div>

                            <!-- DIN -->
                            <div
                                class="text-center p-3 bg-gradient-to-br from-indigo-50 to-white rounded-lg border-2 border-indigo-100 hover:border-indigo-300 transition-colors">
                                <img src="./assets/images/DIN2.png"
                                    alt="DIN Certification"
                                    class="h-12 mx-auto mb-2 object-contain">
                                <div class="text-xs text-gray-600 font-semibold">STANDARD</div>
                                <div class="text-xs text-gray-500 mt-0.5">German Standards</div>
                            </div>

                            <!-- ASME -->
                            <div
                                class="text-center p-3 bg-gradient-to-br from-teal-50 to-white rounded-lg border-2 border-teal-100 hover:border-teal-300 transition-colors">
                                <img src="./assets/images/asme.png"
                                    alt="ASME Certification"
                                    class="h-12 mx-auto mb-2 object-contain">
                                <div class="text-xs text-gray-600 font-semibold">STANDARD</div>
                                <div class="text-xs text-gray-500 mt-0.5">Pressure Vessels</div>
                            </div>
                        </div>

                        <!-- Bottom Note -->
                        <div class="bg-gradient-to-r from-primary/5 to-secondary/5 rounded-lg p-3 text-center">
                            <p class="text-xs text-gray-700 font-semibold">
                                All products comply with international safety and quality standards
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Stats Banner - Compact -->

        </div>
    </section>

    <!-- ============================================================ -->
    <!-- WHY CHOOSE US SECTION - ICON GRID                            -->
    <!-- ============================================================ -->
    <section
        class="py-12 sm:py-16 md:py-20 bg-gradient-to-br from-primary to-primary-dark text-white relative overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">

            <!-- Section Header -->
            <div class="text-center mb-12 sm:mb-16">
                <div class="inline-block bg-white/20 text-white px-4 py-1 rounded-full text-sm font-bold mb-4">
                    WHY CHOOSE US
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4">Your Trusted Industrial Partner</h2>
                <p class="text-white/90 text-base sm:text-lg max-w-2xl mx-auto">
                    With over 20 years of experience, we deliver excellence in every product and service
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto mb-12">

                <!-- Feature 1 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Premium Quality</h3>
                    <p class="text-white/80 text-sm">
                        ISO certified products meeting international standards for reliability and performance
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Fast Delivery</h3>
                    <p class="text-white/80 text-sm">
                        On-time delivery across India with efficient logistics and tracking systems
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Best Prices</h3>
                    <p class="text-white/80 text-sm">
                        Competitive pricing without compromising on quality or service excellence
                    </p>
                </div>

                <!-- Feature 4 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Expert Support</h3>
                    <p class="text-white/80 text-sm">
                        Technical assistance and guidance from our experienced engineering team
                    </p>
                </div>
 
                <!-- Feature 5 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Wide Range</h3>
                    <p class="text-white/80 text-sm">
                        Comprehensive inventory of valves, pipes, and fittings for all applications
                    </p>
                </div>

                <!-- Feature 6 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Warranty</h3>
                    <p class="text-white/80 text-sm">
                        Comprehensive warranty coverage on all products for your peace of mind
                    </p>
                </div>

                <!-- Feature 7 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Trusted by 1000+</h3>
                    <p class="text-white/80 text-sm">
                        Serving leading industries with proven track record of excellence
                    </p>
                </div>

                <!-- Feature 8 -->
                <div
                    class="group bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105 transform">
                    <div
                        class="bg-white/20 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">24/7 Support</h3>
                    <p class="text-white/80 text-sm">
                        Round-the-clock customer support for urgent queries and assistance
                    </p>
                </div>

            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-5xl mx-auto">

                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-bold mb-2">20+</div>
                    <div class="text-white/80 text-sm sm:text-base">Years Experience</div>
                </div>

                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-bold mb-2">5000+</div>
                    <div class="text-white/80 text-sm sm:text-base">Happy Clients</div>
                </div>

                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-bold mb-2">500+</div>
                    <div class="text-white/80 text-sm sm:text-base">Products Range</div>
                </div>

                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-bold mb-2">99%</div>
                    <div class="text-white/80 text-sm sm:text-base">Satisfaction Rate</div>
                </div>

            </div>
    
        </div>
    </section>


    <!-- ============================================================ -->
    <!-- PROMOTIONAL SECTION - IMAGE CARDS ONLY                       -->
    <!-- ============================================================ -->
   <!-- ============================================================ -->
    <!-- PROMOTIONAL SECTION - IMAGE CARDS ONLY                       -->
    <!-- ============================================================ -->
<section class="py-10 sm:py-12 bg-gray-50">
    <div class="container mx-auto px-4">

        <!-- Full Width Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div class="group rounded-[30px] overflow-hidden shadow-xl">
                <img src="./assets/images/banner1.jpeg"
                    alt=""
                    class="w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    loading="lazy">
            </div>

            <!-- Card 2 -->
            <div class="group rounded-[30px] overflow-hidden shadow-xl">
                <img src="./assets/images/banner2.jpeg"
                    alt=""
                    class="w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    loading="lazy">
            </div>

            <!-- Card 3 -->
            <div class="group rounded-[30px] overflow-hidden shadow-xl">
                <img src="./assets/images/banner3.jpeg"
                    alt=""
                    class="w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    loading="lazy">
            </div>

        </div>
    </div>
</section>
    <!-- ============================================================ -->
    <!-- GOOGLE MAPS STYLE REVIEW CAROUSEL                            -->
    <!-- ============================================================ -->
    <section class="py-12 sm:py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-10 sm:mb-12">
                <div class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-bold mb-4">
                    CUSTOMER REVIEWS
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-3">What Our Clients Say</h2>
                <div class="flex items-center justify-center gap-2 mb-4">
                    <div class="flex">
                        <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                        <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path
                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                        </svg>
                    </div>
                    <span class="text-gray-700 font-bold text-lg">4.9</span>
                    <span class="text-gray-500">Based on 250+ reviews</span>
                </div>
            </div>

            <!-- Review Carousel Container -->
            <div class="relative max-w-6xl mx-auto">
                <!-- Carousel Wrapper -->
                <div class="review-carousel-wrapper overflow-hidden">
                    <div class="review-carousel-track flex transition-transform duration-500 ease-out">

                        <!-- Review Card 1 -->
                        <div class="review-card flex-shrink-0 w-full md:w-1/3 px-3">
                            <div
                                class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 h-full">
                                <!-- User Info -->
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                                        AK
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Amit Kumar</h4>
                                        <p class="text-gray-500 text-sm">2 weeks ago</p>
                                    </div>
                                </div>
                                <!-- Stars -->
                                <div class="flex mb-3">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <!-- Review Text -->
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Excellent quality products! The valve we ordered exceeded our expectations. Timely
                                    delivery and professional service. Highly recommended for industrial needs.
                                </p>
                            </div>
                        </div>

                        <!-- Review Card 2 -->
                        <div class="review-card flex-shrink-0 w-full md:w-1/3 px-3">
                            <div
                                class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                                        RS
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Rajesh Sharma</h4>
                                        <p class="text-gray-500 text-sm">1 month ago</p>
                                    </div>
                                </div>
                                <div class="flex mb-3">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Best supplier for industrial valves and fittings. The team is very knowledgeable and
                                    helped us choose the right products for our project. Quick response and competitive
                                    pricing.
                                </p>
                            </div>
                        </div>

                        <!-- Review Card 3 -->
                        <div class="review-card flex-shrink-0 w-full md:w-1/3 px-3">
                            <div
                                class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                                        PM
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Priya Mehta</h4>
                                        <p class="text-gray-500 text-sm">3 weeks ago</p>
                                    </div>
                                </div>
                                <div class="flex mb-3">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Outstanding service! We've been ordering from Indian Traders Corp for over 2 years
                                    now. Consistent quality, reliable delivery, and excellent customer support. A
                                    trusted partner.
                                </p>
                            </div>
                        </div>

                        <!-- Review Card 4 -->
                        <div class="review-card flex-shrink-0 w-full md:w-1/3 px-3">
                            <div
                                class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-red-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                                        VG
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Vikram Gupta</h4>
                                        <p class="text-gray-500 text-sm">1 week ago</p>
                                    </div>
                                </div>
                                <div class="flex mb-3">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Great experience! The gate valves and flanges we purchased are top quality.
                                    Professional packaging and fast shipping. Will definitely order again for future
                                    projects.
                                </p>
                            </div>
                        </div>

                        <!-- Review Card 5 -->
                        <div class="review-card flex-shrink-0 w-full md:w-1/3 px-3">
                            <div
                                class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                                        SK
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Suresh Kapoor</h4>
                                        <p class="text-gray-500 text-sm">2 months ago</p>
                                    </div>
                                </div>
                                <div class="flex mb-3">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Very satisfied with the butterfly valves. Excellent build quality and precise
                                    specifications. The technical team provided great support in selecting the right
                                    size. Highly professional.
                                </p>
                            </div>
                        </div>

                        <!-- Review Card 6 -->
                        <div class="review-card flex-shrink-0 w-full md:w-1/3 px-3">
                            <div
                                class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm hover:shadow-lg transition-shadow duration-300 h-full">
                                <div class="flex items-center mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                                        NP
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">Neha Patel</h4>
                                        <p class="text-gray-500 text-sm">5 days ago</p>
                                    </div>
                                </div>
                                <div class="flex mb-3">
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed">
                                    Perfect for our industrial setup. The IBR pipes and fittings are exactly as
                                    specified. Smooth transaction from inquiry to delivery. Great value for money.
                                    Recommended!
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button onclick="reviewPrev()"
                    class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-300 z-10 border border-gray-200 hover:border-primary">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button onclick="reviewNext()"
                    class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:shadow-xl transition-all duration-300 z-10 border border-gray-200 hover:border-primary">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                <!-- Dots Indicator -->
                <div class="flex justify-center gap-2 mt-8">
                    <span
                        class="review-dot w-2.5 h-2.5 rounded-full bg-primary cursor-pointer transition-all duration-300"
                        onclick="reviewGoTo(0)"></span>
                    <span
                        class="review-dot w-2.5 h-2.5 rounded-full bg-gray-300 cursor-pointer transition-all duration-300"
                        onclick="reviewGoTo(1)"></span>
                    <span
                        class="review-dot w-2.5 h-2.5 rounded-full bg-gray-300 cursor-pointer transition-all duration-300"
                        onclick="reviewGoTo(2)"></span>
                    <span
                        class="review-dot w-2.5 h-2.5 rounded-full bg-gray-300 cursor-pointer transition-all duration-300"
                        onclick="reviewGoTo(3)"></span>
                </div>
            </div>
        </div>
    </section>


    <!-- ============================================================ -->
    <!-- BLOG SECTION - MODERN GRID LAYOUT                            -->
    <!-- ============================================================ -->
    <section class="py-12 sm:py-16 md:py-20 bg-gray-100">
        <div class="container mx-auto px-4">

            <!-- Section Header -->
            <div class="text-center mb-10 sm:mb-12">
                <div class="inline-block bg-primary/10 text-primary px-4 py-1 rounded-full text-sm font-bold mb-4">
                    LATEST UPDATES
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-primary mb-3">Industry Insights & News</h2>
                <p class="text-gray-600 text-base sm:text-lg max-w-2xl mx-auto">
                    Stay updated with the latest trends, tips, and news from the industrial valve and fittings industry
                </p>
            </div>

            <!-- Blog Grid -->
          
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto mb-10">

                <!-- Blog Card 1 -->
                <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=600&h=400&fit=crop"
                            alt="Industrial Valves for High-Pressure Applications"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Blog+Post'">
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-secondary text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Industry News
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>Jan 15, 2026</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>5 min read</span>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                            Top 10 Industrial Valves for High-Pressure Applications
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Discover the best valve solutions for high-pressure industrial applications. Learn about
                            material selection, safety standards, and performance criteria.
                        </p>

                        <!-- Read More Button -->
                        <a href="blog.php"
                            class="inline-flex items-center text-primary font-semibold text-sm hover:text-secondary transition-colors duration-300 group">
                            <span>Read More</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- Blog Card 2 -->
                <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=600&h=400&fit=crop"
                            alt="Maintenance Guide for Gate Valves"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Blog+Post'">
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-primary text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Maintenance Tips
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>Jan 20, 2026</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>7 min read</span>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                            Essential Maintenance Guide for Gate Valves
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Learn the best practices for maintaining gate valves to ensure longevity and optimal
                            performance. Step-by-step maintenance procedures included.
                        </p>

                        <!-- Read More Button -->
                        <a href="blog.php"
                            class="inline-flex items-center text-primary font-semibold text-sm hover:text-secondary transition-colors duration-300 group">
                            <span>Read More</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- Blog Card 3 -->
                <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                    <!-- Image -->
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&h=400&fit=crop"
                            alt="ISO and ASTM Standards for Industrial Valves"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            loading="lazy"
                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/e2e8f0/64748b?text=Blog+Post'">
                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                                Standards
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>Jan 28, 2026</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>6 min read</span>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors duration-300 line-clamp-2">
                            Understanding ISO and ASTM Standards for Industrial Valves
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            A comprehensive guide to international standards for valve manufacturing. Learn why
                            compliance matters and how to choose certified products.
                        </p>

                        <!-- Read More Button -->
                        <a href="blog.php"
                            class="inline-flex items-center text-primary font-semibold text-sm hover:text-secondary transition-colors duration-300 group">
                            <span>Read More</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>

            </div>

            <!-- View All Button -->
            <div class="text-center">
                <a href="blog.php"
                    class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-bold px-8 py-4 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <span>View All Articles</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

        </div>
    </section>



    <!-- CTA Section - Mobile Responsive -->
    <section
        class="bg-gradient-to-r from-primary via-blue-900 to-blue-800 text-white py-12 sm:py-16 md:py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\" 60\"
                height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\"
                fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.4\"%3E%3Cpath d=\"M36
                34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6
                4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6 px-4">Ready to Get Started?
            </h2>
            <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 md:mb-10 text-blue-100 max-w-2xl mx-auto px-4">
                Contact us today for all your industrial valve and
                pipe fitting needs. Get expert consultation and competitive quotes.</p>
            <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-3 sm:gap-4 px-4">
                <a href="tel:+917122345678"
                    class="bg-secondary hover:bg-red-700 text-white font-bold px-6 sm:px-8 md:px-10 py-3 sm:py-4 rounded-lg transition transform hover:scale-105 shadow-2xl inline-flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    Call Now
                </a>
                <button onclick="openQuoteForm()"
                    class="bg-white hover:bg-gray-100 text-primary font-bold px-6 sm:px-8 md:px-10 py-3 sm:py-4 rounded-lg transition transform hover:scale-105 shadow-2xl inline-flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Get Quote
                </button>
            </div>
        </div>
    </section>



    <?php include 'assets/include/footer.php'; ?>

    <script src="./assets/js/main.js"></script>
    <script>
        (function() {
            let bannerCurrentSlide = 0;
            const bannerSlides = document.querySelectorAll('.banner-slide');
            const bannerDots = document.querySelectorAll('.banner-dot');
            let bannerAutoInterval;

            function bannerShow(index) {
                // Hide all slides
                bannerSlides.forEach(slide => {
                    slide.classList.remove('active');
                    slide.style.opacity = '0';
                });

                // Reset all dots
                bannerDots.forEach(dot => {
                    dot.style.opacity = '0.5';
                });

                // Update index
                bannerCurrentSlide = index;
                if (bannerCurrentSlide >= bannerSlides.length) bannerCurrentSlide = 0;
                if (bannerCurrentSlide < 0) bannerCurrentSlide = bannerSlides.length - 1;

                // Show current slide
                bannerSlides[bannerCurrentSlide].classList.add('active');
                bannerSlides[bannerCurrentSlide].style.opacity = '1';
                bannerDots[bannerCurrentSlide].style.opacity = '1';
            }

            window.bannerNext = function() {
                bannerShow(bannerCurrentSlide + 1);
                bannerResetAuto();
            };

            window.bannerPrev = function() {
                bannerShow(bannerCurrentSlide - 1);
                bannerResetAuto();
            };

            window.bannerGoTo = function(index) {
                bannerShow(index);
                bannerResetAuto();
            };

            function bannerStartAuto() {
                bannerAutoInterval = setInterval(() => {
                    bannerShow(bannerCurrentSlide + 1);
                }, 5000);
            }

            function bannerResetAuto() {
                clearInterval(bannerAutoInterval);
                bannerStartAuto();
            }

            // Initialize
            bannerShow(0);
            bannerStartAuto();

            console.log('âœ“ Responsive banner initialized - ' + bannerSlides.length + ' slides');
        })();
    </script>
    <!-- ============================================================ -->
    <!-- REVIEW CAROUSEL JAVASCRIPT                                   -->
    <!-- ============================================================ -->
    <script>
        (function() {
            let reviewCurrentIndex = 0;
            const reviewTrack = document.querySelector('.review-carousel-track');
            const reviewDots = document.querySelectorAll('.review-dot');
            const reviewCards = document.querySelectorAll('.review-card');
            let reviewCardsPerView = window.innerWidth >= 768 ? 3 : 1;
            const totalReviews = reviewCards.length;
            const maxIndex = Math.ceil(totalReviews / reviewCardsPerView) - 1;
            let reviewAutoInterval;

            function updateCardsPerView() {
                reviewCardsPerView = window.innerWidth >= 768 ? 3 : 1;
            }

            function reviewShow(index) {
                updateCardsPerView();
                const maxIdx = Math.ceil(totalReviews / reviewCardsPerView) - 1;

                if (index > maxIdx) reviewCurrentIndex = 0;
                else if (index < 0) reviewCurrentIndex = maxIdx;
                else reviewCurrentIndex = index;

                const offset = -(reviewCurrentIndex * (100 / reviewCardsPerView));
                reviewTrack.style.transform = `translateX(${offset}%)`;

                // Update dots
                reviewDots.forEach((dot, i) => {
                    dot.classList.toggle('bg-primary', i === reviewCurrentIndex);
                    dot.classList.toggle('bg-gray-300', i !== reviewCurrentIndex);
                    dot.classList.toggle('w-8', i === reviewCurrentIndex);
                    dot.classList.toggle('w-2.5', i !== reviewCurrentIndex);
                });
            }

            window.reviewNext = function() {
                reviewShow(reviewCurrentIndex + 1);
                reviewResetAuto();
            };

            window.reviewPrev = function() {
                reviewShow(reviewCurrentIndex - 1);
                reviewResetAuto();
            };

            window.reviewGoTo = function(index) {
                reviewShow(index);
                reviewResetAuto();
            };

            function reviewStartAuto() {
                reviewAutoInterval = setInterval(() => {
                    reviewShow(reviewCurrentIndex + 1);
                }, 5000);
            }

            function reviewResetAuto() {
                clearInterval(reviewAutoInterval);
                reviewStartAuto();
            }

            // Handle window resize
            window.addEventListener('resize', () => {
                reviewShow(reviewCurrentIndex);
            });

            // Initialize
            reviewShow(0);
            reviewStartAuto();

            console.log('✓ Review carousel initialized - ' + totalReviews + ' reviews');
        })();
    </script>
    <script>
        (function() {
            const track = document.querySelector('.brands-track');
            if (!track) return;

            const sets = track.querySelectorAll('.animate-scroll');
            sets.forEach(div => {
                div.style.animation = 'none';
                div.style.webkitAnimation = 'none';
            });


            track.style.display = 'flex';
            track.style.width = 'max-content';

            let position = 0;
            const speed = 1.2;
            let isPaused = false;

            track.addEventListener('mouseenter', () => isPaused = true);
            track.addEventListener('mouseleave', () => isPaused = false);

            function loop() {
                if (!isPaused) {
                    position -= speed;

                    const firstSetWidth = sets[0].scrollWidth;

                    if (Math.abs(position) >= firstSetWidth) {
                        position = 0;
                    }
                    track.style.transform = `translateX(${position}px)`;
                }
                requestAnimationFrame(loop);
            }

            loop();
            console.log('✓ Brand scroll continuous loop started');
        })();
    </script>

    <script>
        (function() {
            setTimeout(function() {
                document.getElementById('productSkeleton').style.display = 'none';
                document.getElementById('productGrid').style.display = 'grid';
            }, 800);
        })();

        function viewProduct(productSlug) {
            window.location.href = 'product_details.php?product=' + productSlug;
        }
    </script>


</body>

</html>