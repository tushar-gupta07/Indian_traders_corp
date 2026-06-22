<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Indian Traders Corp — Warehouse, Facilities & Bulk Supply</title>
    <meta name="description" content="Explore Indian Traders Corp's 20,000 sq.ft warehouse, quality inspection zone, bulk dispatch operations and industrial supply infrastructure in Nagpur, Maharashtra.">
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #0a2463;
            --primary-dark: #071940;
            --secondary: #d32f2f;
            --gold: #f5c518;
            --bg: #f8f9fb;
            --border: #e8ecf4;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: #111827;
            overflow-x: hidden;
            max-width: 100vw;
            -webkit-font-smoothing: antialiased;
        }

        /* ✅ Prevent grids from overflowing viewport */
        .infra-grid, .bulk-grid, .team-grid, .uniform-grid {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
        }

        /* ===== HERO ===== */
        .gallery-hero {
            background: radial-gradient(ellipse at 30% 50%, #1a3a8f 0%, #0d2060 40%, #071540 100%);
            position: relative;
            overflow: hidden;
            padding: 70px 20px 130px;
            text-align: center;
        }
        .gallery-hero::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.055) 1px, transparent 1px);
            background-size: 26px 26px;
            pointer-events: none;
        }
        .gallery-hero::after {
            content: '';
            position: absolute; bottom: -2px; left: 0; right: 0;
            height: 85px;
            background: var(--bg);
            border-radius: 50% 50% 0 0 / 85px 85px 0 0;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.25);
            color: rgba(255,255,255,0.92);
            padding: 8px 22px; border-radius: 50px;
            font-size: 13px; font-weight: 700;
            letter-spacing: 1.5px; text-transform: uppercase;
            margin-bottom: 24px;
            backdrop-filter: blur(8px);
        }

        .hero-title-white {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800; color: #fff;
            font-size: clamp(28px, 5.5vw, 66px);
            line-height: 1.1; display: block;
        }
        .hero-title-yellow {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800; color: #f5c518;
            font-size: clamp(28px, 5.5vw, 66px);
            line-height: 1.2; display: block;
        }
        .hero-subtitle {
            color: rgba(255,255,255,0.78);
            font-size: clamp(13px, 1.8vw, 18px);
            margin: 16px auto 38px; max-width: 540px;
        }

        .hero-stats {
            display: flex; justify-content: center;
            gap: 12px; flex-wrap: wrap;
            position: relative; z-index: 2;
        }
        .hero-stat-box {
            background: rgba(255,255,255,0.10);
            border: 1.5px solid rgba(255,255,255,0.18);
            border-radius: 18px; padding: 18px 28px;
            min-width: 120px;
            backdrop-filter: blur(12px);
            transition: transform 0.3s ease, background 0.3s;
        }
        .hero-stat-box:hover { background: rgba(255,255,255,0.18); transform: translateY(-4px); }
        .hero-stat-box .stat-num {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(22px, 3vw, 38px); font-weight: 800;
            color: #f5c518; display: block; line-height: 1;
        }
        .hero-stat-box .stat-label {
            font-size: 12px; color: rgba(255,255,255,0.7);
            margin-top: 6px; font-weight: 500; display: block;
        }

        .breadcrumb-link {
            color: rgba(255,255,255,0.6); transition: color 0.2s;
            text-decoration: none; font-size: 13px;
        }
        .breadcrumb-link:hover { color: #fff; }

        /* ===================================================
           TAB BAR — FULLY RESPONSIVE WITH SCROLL
           =================================================== */
        .tab-bar {
            background: #fff;
            border-bottom: 2px solid var(--border);
            position: sticky; top: 68px; z-index: 30;
            box-shadow: 0 2px 8px rgba(10,36,99,0.07);
        }

        .tab-inner {
            max-width: 1180px; margin: 0 auto; padding: 0 16px;
            display: flex; align-items: center;
            justify-content: space-between; gap: 12px;
            min-height: 62px;
        }

        /* Scrollable tabs group */
        .tabs-group {
            display: flex;
            gap: 6px;
            flex-wrap: nowrap;           /* ✅ NO wrap — scroll instead */
            overflow-x: auto;            /* ✅ horizontal scroll */
            -webkit-overflow-scrolling: touch;
            padding: 10px 0;
            flex: 1;
            min-width: 0;               /* ✅ allows shrink inside flex */
            /* Hide scrollbar */
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .tabs-group::-webkit-scrollbar { display: none; }

        .tab-btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 18px; border-radius: 50px;
            font-size: 13px; font-weight: 600;
            border: 2px solid var(--border);
            background: #fff; color: #6b7280;
            cursor: pointer; transition: all 0.22s ease;
            white-space: nowrap;         /* ✅ never wrap text */
            flex-shrink: 0;             /* ✅ never squeeze */
        }
        .tab-btn:hover { border-color: var(--primary); color: var(--primary); }
        .tab-btn.active {
            background: var(--primary); color: #fff;
            border-color: var(--primary);
            box-shadow: 0 4px 15px rgba(10,36,99,0.3);
        }
        .tab-btn .count {
            font-size: 10px; font-weight: 800;
            background: rgba(0,0,0,0.12);
            padding: 2px 6px; border-radius: 10px;
        }
        .tab-btn.active .count { background: rgba(255,255,255,0.2); }

        /* View toggle — shrinks on mobile */
        .view-toggle {
            display: flex; gap: 4px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: 8px; padding: 4px;
            flex-shrink: 0;
        }
        .vt-btn {
            width: 32px; height: 32px; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; border: none; background: transparent;
            color: #9ca3af; transition: all 0.2s;
        }
        .vt-btn.active { background: var(--primary); color: #fff; }

        /* ===== CONTENT ===== */
        .content-wrap { max-width: 1180px; margin: 0 auto; padding: 32px 16px 72px; }

        .panel { display: none; }
        .panel.active { display: block; }

        .sec-hd { margin-bottom: 24px; }
        .sec-pill {
            display: inline-flex; align-items: center; gap: 8px;
            font-size: 11px; font-weight: 800;
            letter-spacing: 2.5px; text-transform: uppercase;
            color: var(--secondary); margin-bottom: 10px;
        }
        .sec-pill::before, .sec-pill::after {
            content: ''; display: block;
            width: 28px; height: 2px;
            background: var(--secondary); border-radius: 2px;
        }
        .sec-hd h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(20px, 2.8vw, 30px);
            font-weight: 800; color: var(--primary);
            margin-bottom: 8px;
        }
        .sec-hd p { font-size: 13.5px; color: #6b7280; max-width: 560px; line-height: 1.65; }

        /* ===================================================
           GALLERY GRIDS — RESPONSIVE MASONRY STYLE
           =================================================== */

        /* Infrastructure: editorial 5-cell mosaic */
        .infra-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-template-rows: 240px 190px;
            gap: 10px;
        }
        .ii-1 { grid-column: 1/6;  grid-row: 1/3; }
        .ii-2 { grid-column: 6/9;  grid-row: 1; }
        .ii-3 { grid-column: 9/13; grid-row: 1; }
        .ii-4 { grid-column: 6/10; grid-row: 2; }
        .ii-5 { grid-column: 10/12;grid-row: 2; }
        .ii-6 { grid-column: 12/13;grid-row: 2; }

        /* Bulk: 4-col mosaic */
        .bulk-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: 210px 190px 175px;
            gap: 10px;
        }
        .bi-1 { grid-column: 1/3; grid-row: 1; }
        .bi-2 { grid-column: 3/5; grid-row: 1; }
        .bi-3 { grid-column: 1;   grid-row: 2; }
        .bi-4 { grid-column: 2/4; grid-row: 2; }
        .bi-5 { grid-column: 4;   grid-row: 2; }
        .bi-6 { grid-column: 1;   grid-row: 3; }
        .bi-7 { grid-column: 2;   grid-row: 3; }
        .bi-8 { grid-column: 3;   grid-row: 3; }
        .bi-9 { grid-column: 4;   grid-row: 3; }

        /* Team: 3-col */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: 250px 220px;
            gap: 10px;
        }
        .ti-1 { grid-column: 1/3; grid-row: 1; }
        .ti-2 { grid-column: 3;   grid-row: 1; }
        .ti-3 { grid-column: 1;   grid-row: 2; }
        .ti-4 { grid-column: 2;   grid-row: 2; }
        .ti-5 { grid-column: 3;   grid-row: 2; }

        /* Uniform view mode */
        .uniform-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 10px;
        }
        .uniform-grid .gc { height: 185px !important; }

        /* ===== GALLERY CARD ===== */
        .gc {
            position: relative; border-radius: 12px; overflow: hidden;
            cursor: pointer; background: #d8dde5;
            transition: transform 0.3s cubic-bezier(0.25,0.46,0.45,0.94), box-shadow 0.3s;
        }
        .gc:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(10,36,99,0.18); }
        .gc img {
            width: 100%; height: 100%; object-fit: cover; display: block;
            transition: transform 0.5s cubic-bezier(0.25,0.46,0.45,0.94);
        }
        .gc:hover img { transform: scale(1.07); }

        .gc-ov {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(7,25,64,0.88) 0%, rgba(7,25,64,0.18) 50%, transparent 75%);
            opacity: 0.3; transition: opacity 0.3s;
            display: flex; flex-direction: column;
            justify-content: flex-end; padding: 16px;
        }
        .gc:hover .gc-ov, .gc.feat .gc-ov { opacity: 1; }

        .gc-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 13px; font-weight: 700; color: #fff; line-height: 1.35;
            transform: translateY(8px); transition: transform 0.3s;
        }
        .gc:hover .gc-title, .gc.feat .gc-title { transform: translateY(0); }
        .gc-title small {
            display: block; font-size: 11px; font-weight: 400;
            color: rgba(255,255,255,0.6); margin-top: 3px;
        }

        .gc-bdg {
            position: absolute; top: 10px; left: 10px;
            font-size: 9px; font-weight: 800;
            letter-spacing: 1.2px; text-transform: uppercase;
            padding: 4px 10px; border-radius: 5px; z-index: 2;
        }
        .gc-bdg.red  { background: var(--secondary); color: #fff; }
        .gc-bdg.navy { background: var(--primary); color: #fff; }
        .gc-bdg.gold { background: #f5c518; color: #071940; }

        .gc-zico {
            position: absolute; top: 10px; right: 10px;
            width: 32px; height: 32px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.22);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transform: scale(0.8); transition: all 0.25s; z-index: 3;
        }
        .gc:hover .gc-zico { opacity: 1; transform: scale(1); }

        /* ===== STATS ROW ===== */
        .stats-row {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 12px; margin-bottom: 32px;
        }
        .stat-card {
            background: #fff; border: 1.5px solid var(--border);
            border-radius: 12px; padding: 16px 18px;
            display: flex; align-items: center; gap: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .stat-card:hover { border-color: var(--primary); box-shadow: 0 4px 20px rgba(10,36,99,0.1); }
        .stat-icon {
            width: 42px; height: 42px; border-radius: 10px;
            background: rgba(10,36,99,0.08);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-card-num {
            font-family: 'Montserrat', sans-serif;
            font-size: 20px; font-weight: 800; color: var(--primary);
        }
        .stat-card-label { font-size: 11px; color: #9ca3af; font-weight: 500; margin-top: 1px; }

        /* ===== CTA ===== */
        .cta-section {
            background: linear-gradient(135deg, #071940 0%, #0a2463 60%, #1e3a8a 100%);
            border-radius: 16px; position: relative; overflow: hidden;
            padding: 32px 28px;
            display: flex; align-items: center;
            justify-content: space-between; gap: 20px; flex-wrap: wrap;
            margin-top: 48px;
        }
        .cta-section::before {
            content: '';
            position: absolute; inset: 0;
            background-image: linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
        }

        /* ===== LIGHTBOX ===== */
        .lb {
            position: fixed; inset: 0;
            background: rgba(2,5,18,0.97);
            z-index: 9999;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden;
            transition: opacity 0.3s, visibility 0s 0.3s;
        }
        .lb.on { opacity: 1; visibility: visible; transition: opacity 0.3s, visibility 0s 0s; }
        .lb-box {
            max-width: 88vw; max-height: 88vh;
            display: flex; flex-direction: column; align-items: center;
            transform: scale(0.92); transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
        }
        .lb.on .lb-box { transform: scale(1); }
        .lb-box img {
            max-width: 88vw; max-height: 70vh;
            object-fit: contain; border-radius: 10px; display: block;
        }
        .lb-cap {
            margin-top: 16px; text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px; font-weight: 700; color: rgba(255,255,255,0.88);
        }
        .lb-cap small {
            display: block; font-size: 11.5px; font-weight: 400;
            color: rgba(255,255,255,0.4); margin-top: 4px;
        }
        .lb-x {
            position: fixed; top: 20px; right: 24px;
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            color: #fff; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s; z-index: 10000;
        }
        .lb-x:hover { background: var(--secondary); border-color: var(--secondary); }
        .lb-nav {
            position: fixed; top: 50%; transform: translateY(-50%);
            width: 46px; height: 46px; border-radius: 50%;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.14);
            color: #fff; font-size: 24px; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s; z-index: 10000;
        }
        .lb-nav:hover { background: var(--primary); transform: translateY(-50%) scale(1.08); }
        .lb-prev { left: 18px; }
        .lb-next { right: 18px; }
        .lb-ctr {
            position: fixed; top: 28px; left: 50%; transform: translateX(-50%);
            font-size: 10.5px; font-weight: 700; letter-spacing: 2px;
            color: rgba(255,255,255,0.35); text-transform: uppercase;
            background: rgba(255,255,255,0.05);
            padding: 5px 14px; border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1); z-index: 10000;
        }

        .lb-thumbs {
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            display: flex; gap: 7px;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; padding: 8px 12px;
            z-index: 10000;
            max-width: 90vw; overflow-x: auto;
        }
        .lb-thumbs::-webkit-scrollbar { display: none; }
        .lb-thumb {
            width: 48px; height: 34px; border-radius: 5px;
            object-fit: cover; cursor: pointer; opacity: 0.4;
            border: 2px solid transparent;
            transition: all 0.2s; flex-shrink: 0;
        }
        .lb-thumb.active { opacity: 1; border-color: var(--gold); }
        .lb-thumb:hover { opacity: 0.8; }

        /* scroll top */
        #scrollTop {
            position: fixed; bottom: 24px; right: 24px;
            width: 48px; height: 48px;
            background: var(--primary); color: #fff;
            border-radius: 50%; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 20px rgba(10,36,99,0.4);
            opacity: 0; transform: translateY(20px);
            transition: all 0.3s; z-index: 999;
        }
        #scrollTop.visible { opacity: 1; transform: translateY(0); }
        #scrollTop:hover { background: var(--secondary); }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .gc { animation: fadeUp 0.5s ease both; }

        /* ==============================================
           RESPONSIVE BREAKPOINTS — PROPERLY FIXED
           ============================================== */

        /* Tablet: 768px - 1024px */
        @media (max-width: 1024px) {
            .infra-grid {
                grid-template-columns: repeat(6, 1fr);
                grid-template-rows: 220px 180px 160px;
            }
            .ii-1 { grid-column: 1/4; grid-row: 1/3; }
            .ii-2 { grid-column: 4/7; grid-row: 1; }
            .ii-3 { grid-column: 4/7; grid-row: 2; }
            .ii-4 { grid-column: 1/3; grid-row: 3; }
            .ii-5 { grid-column: 3/5; grid-row: 3; }
            .ii-6 { grid-column: 5/7; grid-row: 3; }

            .stats-row { grid-template-columns: repeat(2, 1fr); }
        }

        /* =====================================================
           TABLET: 768px - 1024px
           ===================================================== */
        @media (max-width: 1024px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); }

            .infra-grid {
                grid-template-columns: repeat(6, 1fr) !important;
                grid-template-rows: 220px 180px 160px !important;
            }
            .ii-1 { grid-column: 1/4 !important; grid-row: 1/3 !important; }
            .ii-2 { grid-column: 4/7 !important; grid-row: 1 !important; }
            .ii-3 { grid-column: 4/7 !important; grid-row: 2 !important; }
            .ii-4 { grid-column: 1/3 !important; grid-row: 3 !important; }
            .ii-5 { grid-column: 3/5 !important; grid-row: 3 !important; }
            .ii-6 { grid-column: 5/7 !important; grid-row: 3 !important; }
        }

        /* =====================================================
           TABLET: 768px - 1024px
           ===================================================== */
        @media (max-width: 768px) {
            .gallery-hero { padding: 60px 16px 110px; }
            .tab-inner { padding: 0 12px; gap: 8px; }
            .stats-row { grid-template-columns: repeat(2, 1fr); gap: 8px; }
            .stat-card { padding: 12px 14px; gap: 10px; }
            .cta-section { padding: 24px 20px; flex-direction: column; align-items: flex-start; }

            /* ✅ INFRA — 2 col, all spans reset */
            .infra-grid {
                grid-template-columns: 1fr 1fr !important;
                grid-template-rows: auto !important;
            }
            .ii-1 { grid-column: 1 / 3 !important; grid-row: auto !important; height: 200px !important; }
            .ii-2, .ii-3, .ii-4, .ii-5, .ii-6 {
                grid-column: span 1 !important;
                grid-row: auto !important;
                height: 155px !important;
            }

            /* ✅ BULK — 2 col, ALL spans reset to 1 */
            .bulk-grid {
                grid-template-columns: 1fr 1fr !important;
                grid-template-rows: auto !important;
            }
            .bi-1, .bi-2, .bi-3, .bi-4, .bi-5,
            .bi-6, .bi-7, .bi-8, .bi-9 {
                grid-column: span 1 !important;
                grid-row: auto !important;
                height: 150px !important;
            }

            /* ✅ TEAM — 2 col, all spans reset */
            .team-grid {
                grid-template-columns: 1fr 1fr !important;
                grid-template-rows: auto !important;
            }
            .ti-1 { grid-column: 1 / 3 !important; grid-row: auto !important; height: 200px !important; }
            .ti-2, .ti-3, .ti-4, .ti-5 {
                grid-column: span 1 !important;
                grid-row: auto !important;
                height: 160px !important;
            }
        }

        /* =====================================================
           MOBILE: < 480px
           ===================================================== */
        @media (max-width: 480px) {
            .gallery-hero { padding: 50px 14px 100px; }
            .hero-stat-box { padding: 14px 18px; min-width: 90px; }
            .hero-stats { gap: 8px; }

            .tab-btn { padding: 7px 12px; font-size: 12px; gap: 5px; }
            .tab-btn svg { display: none; }

            .stats-row { grid-template-columns: 1fr 1fr; gap: 8px; }
            .stat-card-num { font-size: 17px; }

            /* ✅ INFRA — single col on small mobile */
            .infra-grid {
                grid-template-columns: 1fr !important;
                grid-template-rows: auto !important;
            }
            .ii-1, .ii-2, .ii-3, .ii-4, .ii-5, .ii-6 {
                grid-column: 1 !important;
                grid-row: auto !important;
                height: 180px !important;
            }

            /* ✅ BULK — 2 col on small mobile */
            .bulk-grid {
                grid-template-columns: 1fr 1fr !important;
                grid-template-rows: auto !important;
            }
            .bi-1, .bi-2, .bi-3, .bi-4, .bi-5,
            .bi-6, .bi-7, .bi-8, .bi-9 {
                grid-column: span 1 !important;
                grid-row: auto !important;
                height: 130px !important;
            }

            /* ✅ TEAM — single col on small mobile */
            .team-grid {
                grid-template-columns: 1fr !important;
                grid-template-rows: auto !important;
            }
            .ti-1, .ti-2, .ti-3, .ti-4, .ti-5 {
                grid-column: 1 !important;
                grid-row: auto !important;
                height: 175px !important;
            }

            .lb-nav { width: 36px; height: 36px; font-size: 18px; }
            .lb-prev { left: 8px; }
            .lb-next { right: 8px; }
            .cta-section { padding: 20px 16px; }
            .hint-text { display: none !important; }
        }
        /* ===================================================
   INFRA GRID — PROPER 6-IMAGE MOSAIC (DESKTOP)
   Layout:
   [ IMG-1 (tall) ][ IMG-2 ][ IMG-3 ]
   [ IMG-1 (tall) ][ IMG-4 ][ IMG-5 ]
   [ IMG-6 (full width bottom) ]
   =================================================== */
.infra-grid {
    display: grid;
    grid-template-columns: 2fr 1.2fr 1.2fr;
    grid-template-rows: 250px 200px 180px;
    gap: 10px;
}

.ii-1 { grid-column: 1 / 2;   grid-row: 1 / 3; }  /* Left tall hero */
.ii-2 { grid-column: 2 / 3;   grid-row: 1; }       /* Top middle */
.ii-3 { grid-column: 3 / 4;   grid-row: 1; }       /* Top right */
.ii-4 { grid-column: 2 / 3;   grid-row: 2; }       /* Bottom middle */
.ii-5 { grid-column: 3 / 4;   grid-row: 2; }       /* Bottom right */
.ii-6 { grid-column: 1 / 4;   grid-row: 3; }       /* Full width bottom */
        /* =====================================================
           VERY SMALL: < 360px
           ===================================================== */
        @media (max-width: 360px) {
            .tab-btn { padding: 6px 10px; font-size: 11px; }
            .hero-title-white, .hero-title-yellow { font-size: 24px; }
            .bi-1, .bi-2, .bi-3, .bi-4, .bi-5,
            .bi-6, .bi-7, .bi-8, .bi-9 { height: 115px !important; }
        }
        @media (max-width: 1024px) {
    .infra-grid {
        grid-template-columns: 1fr 1fr !important;
        grid-template-rows: 220px 180px 180px !important;
    }
    .ii-1 { grid-column: 1 / 3 !important; grid-row: 1 !important; }
    .ii-2 { grid-column: 1 / 2 !important; grid-row: 2 !important; }
    .ii-3 { grid-column: 2 / 3 !important; grid-row: 2 !important; }
    .ii-4 { grid-column: 1 / 2 !important; grid-row: 3 !important; }
    .ii-5 { grid-column: 2 / 3 !important; grid-row: 3 !important; }
    .ii-6 { grid-column: 1 / 3 !important; grid-row: 4 !important; height: 160px !important; }
}
    </style>
</head>
<body>
 <?php include 'assets/include/header.php'; ?>

   

    <?php include 'assets/include/modal.php'; ?>
<!-- ======================================================= -->
<!-- HERO                                                     -->
<!-- ======================================================= -->
<section class="gallery-hero">

    <nav class="flex items-center justify-center gap-2 mb-10 relative z-10" aria-label="Breadcrumb">
        <a href="index.php" class="breadcrumb-link">Home</a>
        <svg class="w-3 h-3" style="color:rgba(255,255,255,0.35)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span style="color:rgba(255,255,255,0.85);font-size:13px;font-weight:600;">Gallery</span>
    </nav>

    <div class="relative z-10">
        <div class="hero-badge">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            PHOTO GALLERY
        </div>
    </div>

    <div class="relative z-10 mt-4">
        <h1>
            <span class="hero-title-white">Our Facilities &amp;</span>
            <span class="hero-title-yellow">Supply Operations</span>
        </h1>
        <p class="hero-subtitle">
            Indian Traders Corp — Nagpur, Maharashtra · 20+ Years of Industrial Excellence
        </p>
    </div>

    <div class="hero-stats relative z-10">
        <div class="hero-stat-box">
            <span class="stat-num">20K+</span>
            <span class="stat-label">Sqft Warehouse</span>
        </div>
        <div class="hero-stat-box">
            <span class="stat-num">500+</span>
            <span class="stat-label">Products</span>
        </div>
        <div class="hero-stat-box">
            <span class="stat-num">5000+</span>
            <span class="stat-label">Orders Shipped</span>
        </div>
        <div class="hero-stat-box">
            <span class="stat-num">20+</span>
            <span class="stat-label">Years</span>
        </div>
    </div>

</section>

<!-- ======================================================= -->
<!-- STICKY TAB BAR — RESPONSIVE ✅                          -->
<!-- ======================================================= -->
<div class="tab-bar">
    <div class="tab-inner">

        <!-- ✅ Scrollable tabs — no line break on any screen -->
        <div class="tabs-group">
            <button class="tab-btn active" onclick="swTab('infra',this)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                Infrastructure
                <span class="count">6</span>
            </button>
            <button class="tab-btn" onclick="swTab('bulk',this)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Bulk Supply
                <span class="count">9</span>
            </button>
            <button class="tab-btn" onclick="swTab('team',this)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Team &amp; QC
                <span class="count">5</span>
            </button>
        </div>

        <!-- Right side: hint + view toggle -->
        <div class="flex items-center gap-8 flex-shrink-0">
            <span class="hint-text" style="font-size:11.5px;color:#b0b6c3;font-weight:500;white-space:nowrap;display:none;" id="hintText">
                Click to enlarge · ← → to navigate
            </span>
            <div class="view-toggle">
                <button class="vt-btn active" id="gridViewBtn" onclick="setView('grid')" title="Editorial grid">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                        <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
                    </svg>
                </button>
                <button class="vt-btn" id="listViewBtn" onclick="setView('list')" title="Uniform grid">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="4"/><rect x="3" y="10" width="18" height="4"/><rect x="3" y="17" width="18" height="4"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ======================================================= -->
<!-- MAIN CONTENT                                            -->
<!-- ======================================================= -->
<div class="content-wrap">

    <!-- Stats Row -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon">
                <svg class="w-5 h-5" fill="none" stroke="#0a2463" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                </svg>
            </div>
            <div><div class="stat-card-num">20,000</div><div class="stat-card-label">Sqft Warehouse</div></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg class="w-5 h-5" fill="none" stroke="#0a2463" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div><div class="stat-card-num">ISO</div><div class="stat-card-label">Certified QC Zone</div></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg class="w-5 h-5" fill="none" stroke="#0a2463" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <div><div class="stat-card-num">5000+</div><div class="stat-card-label">Orders Dispatched</div></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <svg class="w-5 h-5" fill="none" stroke="#0a2463" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div><div class="stat-card-num">50+</div><div class="stat-card-label">Staff Members</div></div>
        </div>
    </div>

    <!-- PANEL 1: INFRASTRUCTURE -->
    <div class="panel active" id="p-infra">
        <div class="sec-hd">
            <div class="sec-pill">Infrastructure</div>
            <h2>Our World-Class Facilities</h2>
            <p>State-of-the-art warehousing, quality inspection &amp; dispatch infrastructure built to handle India's most demanding industrial supply requirements.</p>
        </div>
        <div class="infra-grid" id="infraGrid">
            <div class="gc feat ii-1" onclick="oLb(0,'infra')" style="animation-delay:0s">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=900&q=85" alt="Central Warehouse" loading="lazy">
                <span class="gc-bdg red">Main Facility</span>
                <div class="gc-ov"><div class="gc-title">Central Warehouse<small>20,000 Sq.ft · Nagpur</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ii-2" onclick="oLb(1,'infra')" style="animation-delay:.06s">
                <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?w=640&q=85" alt="Valve Storage" loading="lazy">
                <span class="gc-bdg navy">Storage</span>
                <div class="gc-ov"><div class="gc-title">Valve Storage Racks<small>Heavy-duty organized racks</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ii-3" onclick="oLb(2,'infra')" style="animation-delay:.12s">
                <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=640&q=85" alt="QC Zone" loading="lazy">
                <span class="gc-bdg red">QC Zone</span>
                <div class="gc-ov"><div class="gc-title">Quality Inspection<small>Pre-dispatch testing area</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ii-4" onclick="oLb(3,'infra')" style="animation-delay:.18s">
                <img src="https://images.unsplash.com/photo-1545987796-200677ee1011?w=640&q=85" alt="Loading Bay" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Loading Bay<small>High-capacity dispatch</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ii-5" onclick="oLb(4,'infra')" style="animation-delay:.22s">
                <img src="https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=420&q=85" alt="Admin Office" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Admin Office</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ii-6" onclick="oLb(5,'infra')" style="animation-delay:.26s">
                <img src="https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=420&q=85" alt="Pipe Yard" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Pipe Storage Yard</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
        </div>
    </div>

    <!-- PANEL 2: BULK SUPPLY -->
    <div class="panel" id="p-bulk">
        <div class="sec-hd">
            <div class="sec-pill">Bulk Supply</div>
            <h2>Pan-India Bulk Dispatch</h2>
            <p>Serving large-scale industries with bulk orders of valves, pipes, flanges &amp; fittings — on time, every time, across India.</p>
        </div>
        <div class="bulk-grid" id="bulkGrid">
            <div class="gc feat bi-1" onclick="oLb(0,'bulk')">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=760&q=85" alt="Valve Bulk" loading="lazy">
                <span class="gc-bdg red">Valves</span>
                <div class="gc-ov"><div class="gc-title">Valve Bulk Orders<small>Gate, Globe, Ball, Butterfly</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc feat bi-2" onclick="oLb(1,'bulk')">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=760&q=85" alt="Pipe Dispatch" loading="lazy">
                <span class="gc-bdg navy">Pipes</span>
                <div class="gc-ov"><div class="gc-title">MS &amp; GI Pipe Dispatch<small>Pan-India bulk delivery</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc bi-3" onclick="oLb(2,'bulk')">
                <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=440&q=85" alt="Flanges" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Flanges<small>All sizes &amp; ratings</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc bi-4" onclick="oLb(3,'bulk')">
                <img src="https://images.unsplash.com/photo-1620714223084-8fcacc2dfd4d?w=660&q=85" alt="Fleet Loading" loading="lazy">
                <span class="gc-bdg red">Dispatch</span>
                <div class="gc-ov"><div class="gc-title">Fleet Loading<small>Daily bulk truck dispatch</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc bi-5" onclick="oLb(4,'bulk')">
                <img src="https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=440&q=85" alt="IBR Pipes" loading="lazy">
                <div class="gc-ov"><div class="gc-title">IBR Pipes</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc bi-6" onclick="oLb(5,'bulk')">
                <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=440&q=85" alt="Fittings" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Pipe Fittings</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc bi-7" onclick="oLb(6,'bulk')">
                <img src="https://images.unsplash.com/photo-1586528116493-a029325540fa?w=440&q=85" alt="SS Fittings" loading="lazy">
                <div class="gc-ov"><div class="gc-title">SS Fittings</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc bi-8" onclick="oLb(7,'bulk')">
                <img src="https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=440&q=85" alt="Safety Valves" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Safety Valves</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc bi-9" onclick="oLb(8,'bulk')">
                <img src="https://images.unsplash.com/photo-1599491143989-88c5d30e20d7?w=440&q=85" alt="GI Pipes" loading="lazy">
                <div class="gc-ov"><div class="gc-title">GI Pipes</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
        </div>
    </div>

    <!-- PANEL 3: TEAM & QC -->
    <div class="panel" id="p-team">
        <div class="sec-hd">
            <div class="sec-pill">Team &amp; QC</div>
            <h2>People Behind the Quality</h2>
            <p>Our experienced team ensures every order is checked, certified &amp; correctly packed — so you receive exactly what you ordered, every time.</p>
        </div>
        <div class="team-grid" id="teamGrid">
            <div class="gc feat ti-1" onclick="oLb(0,'team')">
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=900&q=85" alt="QC Team" loading="lazy">
                <span class="gc-bdg gold">QC Team</span>
                <div class="gc-ov"><div class="gc-title">Quality Control Team<small>Pre-dispatch inspection</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ti-2" onclick="oLb(1,'team')">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=500&q=85" alt="Management" loading="lazy">
                <span class="gc-bdg navy">Management</span>
                <div class="gc-ov"><div class="gc-title">Management Team</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ti-3" onclick="oLb(2,'team')">
                <img src="https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=440&q=85" alt="Testing Lab" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Testing Lab<small>Hydraulic pressure testing</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ti-4" onclick="oLb(3,'team')">
                <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=440&q=85" alt="Order Processing" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Order Processing<small>24-hr dispatch turnaround</small></div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
            <div class="gc ti-5" onclick="oLb(4,'team')">
                <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=440&q=85" alt="Customer Service" loading="lazy">
                <div class="gc-ov"><div class="gc-title">Customer Service</div></div>
                <div class="gc-zico"><svg width="13" height="13" fill="none" stroke="#fff" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="cta-section">
        <div class="relative z-10">
            <p style="font-size:10px;font-weight:800;letter-spacing:2.5px;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-bottom:6px;">READY TO ORDER?</p>
            <h3 style="font-family:'Montserrat',sans-serif;font-size:clamp(18px,3vw,22px);font-weight:800;color:#fff;margin-bottom:6px;">Request a Bulk Supply Quote</h3>
            <p style="font-size:13px;color:rgba(255,255,255,0.55);">Valves · Pipes · Flanges · Fittings — PAN India Delivery Guaranteed</p>
        </div>
        <div class="flex gap-3 flex-wrap relative z-10">
            <a href="tel:+917122345678"
               style="display:inline-flex;align-items:center;gap:8px;background:#d32f2f;color:#fff;font-family:'Montserrat',sans-serif;font-size:13px;font-weight:700;padding:12px 22px;border-radius:8px;text-decoration:none;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                Call Now
            </a>
            <button
               style="display:inline-flex;align-items:center;gap:8px;background:#fff;color:#0a2463;font-family:'Montserrat',sans-serif;font-size:13px;font-weight:700;padding:12px 22px;border-radius:8px;border:none;cursor:pointer;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Request a Quote
            </button>
        </div>
    </div>

</div><!-- /content-wrap -->

<!-- LIGHTBOX -->
<div class="lb" id="lb" onclick="lbBg(event)">
    <button class="lb-x" onclick="cLb()">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
    <button class="lb-nav lb-prev" onclick="lbP()">&#8249;</button>
    <button class="lb-nav lb-next" onclick="lbN()">&#8250;</button>
    <span class="lb-ctr" id="lbCtr"></span>
    <div class="lb-box">
        <img id="lbImg" src="" alt="">
        <div class="lb-cap"><span id="lbT"></span><small id="lbD"></small></div>
    </div>
    <div class="lb-thumbs" id="lbThumbs"></div>
</div>
  <?php include 'assets/include/footer.php'; ?>
<script>
const D = {
    infra: [
        {s:'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1600&q=90',t:'Central Warehouse',d:'20,000 Sq.ft · Nagpur, Maharashtra'},
        {s:'https://images.unsplash.com/photo-1553413077-190dd305871c?w=1600&q=90',t:'Valve Storage Racks',d:'Organized heavy-duty racking system'},
        {s:'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&q=90',t:'Quality Inspection Zone',d:'Pre-dispatch QC testing'},
        {s:'https://images.unsplash.com/photo-1545987796-200677ee1011?w=1600&q=90',t:'Loading & Dispatch Bay',d:'High-capacity loading dock'},
        {s:'https://images.unsplash.com/photo-1606761568499-6d2451b23c66?w=1600&q=90',t:'Admin Office',d:'Customer service wing'},
        {s:'https://images.unsplash.com/photo-1565008447742-97f6f38c985c?w=1600&q=90',t:'Pipe Storage Yard',d:'MS, GI, IBR, SS pipes & fittings'},
    ],
    bulk: [
        {s:'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1600&q=90',t:'Valve Bulk Orders',d:'Gate, Globe, Ball & Butterfly'},
        {s:'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=1600&q=90',t:'MS & GI Pipe Dispatch',d:'Pan-India bulk delivery'},
        {s:'https://images.unsplash.com/photo-1511578314322-379afb476865?w=1600&q=90',t:'Flange Bulk Supply',d:'All sizes and pressure ratings'},
        {s:'https://images.unsplash.com/photo-1620714223084-8fcacc2dfd4d?w=1600&q=90',t:'Fleet Loading',d:'Large-scale daily dispatch'},
        {s:'https://images.unsplash.com/photo-1570126618953-d437176e8c79?w=1600&q=90',t:'IBR Pipes',d:'Boiler-grade certified pipes'},
        {s:'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=1600&q=90',t:'Pipe Fittings',d:'Elbow, tee, reducer — bulk packs'},
        {s:'https://images.unsplash.com/photo-1586528116493-a029325540fa?w=1600&q=90',t:'SS Fittings Stock',d:'Stainless steel ready inventory'},
        {s:'https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=1600&q=90',t:'Safety Valve Bundles',d:'PRV & relief valves — bulk supply'},
        {s:'https://images.unsplash.com/photo-1587293852726-70cdb56c2866?w=1600&q=90',t:'GI Pipe Stock',d:'Galvanized iron — all schedules'},
    ],
    team: [
        {s:'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=1600&q=90',t:'Quality Control Team',d:'Pre-dispatch inspection'},
        {s:'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1600&q=90',t:'Management Team',d:'Leadership & operations'},
        {s:'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1600&q=90',t:'Testing Lab',d:'Hydraulic pressure testing'},
        {s:'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=1600&q=90',t:'Order Processing',d:'24-hr dispatch turnaround'},
        {s:'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1600&q=90',t:'Customer Service',d:'Dedicated support team'},
    ]
};
let cG = 'infra', cI = 0;

/* TABS */
function swTab(n, btn) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('p-' + n).classList.add('active');
    cG = n;
    document.querySelectorAll('#p-' + n + ' .gc').forEach((c, i) => {
        c.style.animation = 'none';
        c.offsetHeight;
        c.style.animation = '';
        c.style.animationDelay = (i * 0.06) + 's';
    });
}

/* VIEW MODE */
let viewMode = 'grid';
const gridClasses = { infraGrid:'infra-grid', bulkGrid:'bulk-grid', teamGrid:'team-grid' };

function setView(mode) {
    viewMode = mode;
    document.getElementById('gridViewBtn').classList.toggle('active', mode === 'grid');
    document.getElementById('listViewBtn').classList.toggle('active', mode === 'list');
    ['infraGrid','bulkGrid','teamGrid'].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;
        el.className = (mode === 'list') ? 'uniform-grid' : gridClasses[id];
    });
}

/* LIGHTBOX */
function buildThumbs() {
    const strip = document.getElementById('lbThumbs');
    strip.innerHTML = '';
    D[cG].forEach((item, i) => {
        const img = document.createElement('img');
        img.src = item.s.replace('w=1600', 'w=120');
        img.className = 'lb-thumb' + (i === cI ? ' active' : '');
        img.alt = item.t;
        img.onclick = (e) => { e.stopPropagation(); cI = i; upd(); };
        strip.appendChild(img);
    });
}

function oLb(i, g) {
    cG = g; cI = i;
    buildThumbs();
    upd();
    document.getElementById('lb').classList.add('on');
    document.body.style.overflow = 'hidden';
}

function cLb() {
    document.getElementById('lb').classList.remove('on');
    document.body.style.overflow = '';
}

function lbBg(e) { if (e.target === document.getElementById('lb')) cLb(); }
function lbP() { cI = (cI - 1 + D[cG].length) % D[cG].length; upd(); }
function lbN() { cI = (cI + 1) % D[cG].length; upd(); }

function upd() {
    const x = D[cG][cI];
    const im = document.getElementById('lbImg');
    im.style.opacity = '0';
    im.src = x.s;
    im.onload = () => { im.style.transition = 'opacity 0.25s'; im.style.opacity = '1'; };
    document.getElementById('lbT').textContent = x.t;
    document.getElementById('lbD').textContent = x.d;
    const label = cG === 'infra' ? 'Infrastructure' : cG === 'bulk' ? 'Bulk Supply' : 'Team & QC';
    document.getElementById('lbCtr').textContent = label + ' · ' + (cI + 1) + ' / ' + D[cG].length;
    document.querySelectorAll('.lb-thumb').forEach((t, i) => t.classList.toggle('active', i === cI));
    const active = document.querySelector('.lb-thumb.active');
    if (active) active.scrollIntoView({ inline: 'center', behavior: 'smooth', block: 'nearest' });
}

/* KEYBOARD */
document.addEventListener('keydown', e => {
    if (!document.getElementById('lb').classList.contains('on')) return;
    if (e.key === 'ArrowLeft')  lbP();
    if (e.key === 'ArrowRight') lbN();
    if (e.key === 'Escape')     cLb();
});

/* SCROLL TOP */
window.addEventListener('scroll', () => {
    document.getElementById('scrollTop').classList.toggle('visible', window.scrollY > 400);
});

/* Show hint text on desktop */
if (window.innerWidth > 768) {
    document.getElementById('hintText').style.display = 'block';
}
</script>

</body>
</html>