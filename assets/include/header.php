<?php
// assets/include/header.php
require_once __DIR__ . '/config.php';

function getMenuTree(): array {
    $cacheFile = __DIR__ . '/../cache/menu_tree.json';
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 600) {
        $data = json_decode(file_get_contents($cacheFile), true);
        if ($data && isset($data['menu'])) return $data['menu'];
    }
    try {
        $pdo  = getDB();
        $cats = $pdo->query("SELECT * FROM menu_categories WHERE is_active=1 ORDER BY sort_order")->fetchAll();
        $menu = [];

        foreach ($cats as $cat) {
            $s = $pdo->prepare("SELECT * FROM menu_subcategories WHERE category_id=? AND is_active=1 ORDER BY sort_order");
            $s->execute([$cat['id']]);
            $subs = $s->fetchAll();
            $subList = [];

            foreach ($subs as $sub) {
                $s2 = $pdo->prepare("SELECT * FROM menu_subcategories2 WHERE subcategory_id=? AND is_active=1 ORDER BY sort_order");
                $s2->execute([$sub['id']]);
                $subs2 = $s2->fetchAll();

                if (!empty($subs2)) {
                    $sub2List = [];
                    foreach ($subs2 as $sub2) {
                        $p = $pdo->prepare("SELECT COUNT(*) as cnt FROM products WHERE subcategory2_id=? AND is_active=1");

                        $p->execute([$sub2['id']]);
                        $cnt = $p->fetchColumn();
                        $sub2List[] = [
                            'id'            => (int)$sub2['id'],
                            'name'          => $sub2['name'],
                            'slug'          => $sub2['slug'],
                            'product_count' => (int)$cnt,
                        ];
                    }
                    $subList[] = [
                        'id'            => (int)$sub['id'],
                        'name'          => $sub['name'],
                        'slug'          => $sub['slug'],
                        'has_sub2'      => true,
                        'sub2s'         => $sub2List,
                        'product_count' => 0,
                    ];
                } else {
                   $p = $pdo->prepare("SELECT COUNT(*) as cnt FROM products WHERE subcategory_id=? AND subcategory2_id IS NULL AND is_active=1");
                    $p->execute([$sub['id']]);
                    $cnt = $p->fetchColumn();
                    $subList[] = [
                        'id'            => (int)$sub['id'],
                        'name'          => $sub['name'],
                        'slug'          => $sub['slug'],
                        'has_sub2'      => false,
                        'sub2s'         => [],
                        'product_count' => (int)$cnt,
                    ];
                }
            }

            $menu[] = [
                'id'   => (int)$cat['id'],
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'subs' => $subList,
            ];
        }

        if (!is_dir(__DIR__.'/../cache')) mkdir(__DIR__.'/../cache', 0755, true);
        file_put_contents($cacheFile, json_encode(['menu' => $menu], JSON_UNESCAPED_UNICODE));
        return $menu;
    } catch (Exception $e) {
        return [];
    }
}

$menuTree = getMenuTree();
$base = './';
?>

    <style>
        /* ══ Hide scrollbars ══ */
        .mega-col-cat,
        .mega-col-sub,
        .mega-col-sub2 {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .mega-col-cat::-webkit-scrollbar,
        .mega-col-sub::-webkit-scrollbar,
        .mega-col-sub2::-webkit-scrollbar { display: none; }

        /* ══════════════════════════════════════
           MEGA MENU
           FIX 1: top:100% (no gap), padding-top
           creates invisible hover bridge so menu
           doesn't flicker when mouse moves down.
        ══════════════════════════════════════ */
        .mega-parent { position: relative; }

        .mega-panel {
            display: none;
            position: absolute;
            /* FIX: top:100% + padding-top:8px = no gap,
               but panel visually still sits 8px below.
               The padding area is hoverable → no flicker. */
            top: 100%;
            padding-top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: min(440px, 96vw);
            background: transparent; /* transparent wrapper */
            z-index: 9999;
            /* no overflow:hidden here — inner div handles it */
            flex-direction: column;
        }

        /* The actual visible card sits inside */
        .mega-panel-inner {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 24px 64px rgba(0,0,0,.18);
            border: 1px solid #e8edf5;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: width .2s ease;
        }

        .mega-panel.has-sub2-open {
            width: min(660px, 96vw);
        }

        /* FIX 2: Show panel on hover of parent,
           AND keep it open when mouse is inside panel
           (using JS-controlled .is-open class instead
           of pure CSS :hover so X button can close it) */
        .mega-parent:hover .mega-panel,
        .mega-panel.is-open { display: flex; }

        .mega-panel.align-right { left: auto; right: 0; transform: none; }
        .mega-panel.align-left  { left: 0;    transform: none; }

        /* ── Header bar ── */
        .mega-header-bar {
            background: linear-gradient(135deg, #0a2463, #1a3a7a);
            color: #fff;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .mega-header-bar span { font-size:11px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; opacity:.85; }
        .mega-header-bar a    { font-size:11px; font-weight:700; color:#fbbf24; text-decoration:none; }

        /* FIX 3: X close button */
        .mega-close-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
            line-height: 1;
            flex-shrink: 0;
            transition: background .15s;
            margin-left: 10px;
        }
        .mega-close-btn:hover { background: rgba(255,255,255,0.3); }

        .mega-header-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── Body ── */
        .mega-body { display:flex; flex:1; overflow:hidden; }

        /* Col 1 — Categories */
        .mega-col-cat {
            width: 200px; min-width: 200px;
            background: #e8eef8;
            border-right: 1px solid #d0d9f0;
            padding: 10px 0;
            overflow-y: auto;
            max-height: 420px;
        }

        /* Col 2 — Subcategories */
        .mega-col-sub {
            width: 220px; min-width: 220px;
            background: #f8faff;
            border-right: 1px solid #e8edf5;
            padding: 10px 0;
            overflow-y: auto;
            max-height: 420px;
        }
        .cat-sub-panel        { display:none; flex-direction:column; }
        .cat-sub-panel.active { display:flex; }

        /* Col 3 — Sub2 */
        .mega-col-sub2 {
            width: 0;
            min-width: 0;
            background: #f0f4ff;
            padding: 0;
            overflow-y: auto;
            max-height: 420px;
            overflow: hidden;
            transition: width .18s ease, padding .18s ease;
        }
        .mega-col-sub2.visible {
            width: 220px;
            min-width: 220px;
            padding: 10px 0;
            overflow-y: auto;
        }

        .sub2-list-panel        { display:none; flex-direction:column; }
        .sub2-list-panel.active { display:flex; }

        /* Shared item style */
        .mega-sub-btn {
            display: flex; align-items: center; justify-content: space-between;
            width: 100%; padding: 10px 16px;
            font-size: 12.5px; font-weight: 600; color: #334155;
            cursor: pointer; transition: all .15s;
            border-left: 3px solid transparent;
            background: none;
            border-top: none; border-right: none; border-bottom: none;
            text-align: left;
            text-decoration: none;
        }
        .mega-sub-btn:hover,
        .mega-sub-btn.active {
            background: #fff; color: #0a2463;
            border-left-color: #c0392b;
        }
        .mega-sub-btn .count-badge {
            font-size: 10px; font-weight: 700;
            background: #e0e7ff; color: #0a2463;
            padding: 1px 7px; border-radius: 20px; flex-shrink: 0;
        }
        .mega-sub-btn.active .count-badge { background: #fee2e2; color: #c0392b; }

        /* Arrow for sub2 */
        .mega-sub-btn .sub2-arrow { font-size:14px; color:#cbd5e1; flex-shrink:0; }
        .mega-sub-btn.active .sub2-arrow { color:#c0392b; }

        /* ══════════════════════════════════════
           SEARCH DROPDOWN
        ══════════════════════════════════════ */
        .search-header-bar { display:flex; align-items:center; justify-content:space-between; padding:10px 16px; background:linear-gradient(135deg,#0a2463,#1a3a7a); color:#fff; }
        .search-header-bar span { font-size:11px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; opacity:.85; }
        .search-header-bar a    { font-size:11px; font-weight:700; color:#fbbf24; text-decoration:none; }
        .search-item { display:flex; align-items:center; border-bottom:1px solid #f1f5f9; cursor:pointer; transition:background .15s; }
        .search-item:hover { background:#f8faff; }
        .search-item-img-wrap { width:68px; min-width:68px; height:68px; background:#f8faff; display:flex; align-items:center; justify-content:center; border-right:1px solid #f1f5f9; padding:8px; }
        .search-item-img-wrap img { width:100%; height:100%; object-fit:contain; }
        .search-item-body { flex:1; padding:10px 14px; min-width:0; }
        .search-item-category { font-size:10px; font-weight:700; color:#0a2463; text-transform:uppercase; letter-spacing:.06em; margin-bottom:3px; opacity:.7; }
        .search-item-name { font-size:13px; font-weight:700; color:#1e293b; line-height:1.35; margin-bottom:3px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .search-item-sub  { font-size:11px; color:#94a3b8; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .search-footer { display:flex; align-items:center; justify-content:space-between; padding:10px 16px; background:#f8faff; border-top:1px solid #e8edf5; }
        .search-footer-left { font-size:11px; color:#94a3b8; }
        .search-footer-btn { font-size:12px; font-weight:700; color:#0a2463; background:#fff; border:1.5px solid #0a2463; padding:5px 14px; border-radius:20px; cursor:pointer; transition:all .2s; }
        .search-footer-btn:hover { background:#0a2463; color:#fff; }
        .search-empty { padding:32px 20px; text-align:center; }
        .search-empty-title { font-size:14px; font-weight:700; color:#475569; margin-bottom:6px; }
        .search-empty-sub   { font-size:12px; color:#94a3b8; }
        mark.sh { background:#fef08a; color:#1e293b; padding:0 2px; border-radius:2px; }

        /* ══════════════════════════════════════
           MOBILE ACCORDION
        ══════════════════════════════════════ */
        .mob-sub-panel      { display:none; }
        .mob-sub-panel.open { display:block; }
    </style>
</head>
<body>

<header class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-4 relative">
        <div class="flex items-center justify-between">

            <!-- ── Logo ── -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <a href="<?= $base ?>index.php">
                    <img src="<?= $base ?>assets/images/ITC LOGO.png" alt="Indian Traders Corp Logo" class="h-12 w-12">
                </a>
                <div>
                    <h1 class="text-xl font-bold text-primary">Indian Traders Corp</h1>
                    <p class="text-xs text-gray-600">Since 1969</p>
                </div>
            </div>

            <!-- ── Desktop Search ── -->
            <div class="hidden lg:flex items-center flex-1 max-w-xl mx-8 relative" id="desktopSearchWrapper">
                <div class="relative w-full group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-secondary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search for products, categories..."
                           autocomplete="off"
                           class="w-full pl-12 pr-6 py-3 bg-gray-50 border-2 border-gray-200 rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-secondary focus:ring-4 focus:ring-secondary/10 transition-all duration-300">
                </div>
                <div id="searchDropdown"
                     class="hidden absolute top-full left-0 right-0 mt-3 bg-white rounded-2xl z-[9999] overflow-hidden"
                     style="box-shadow:0 20px 60px rgba(0,0,0,.15);border:1px solid #e8edf5;"></div>
            </div>

            <!-- ── Desktop Nav ── -->
            <div class="hidden md:flex items-center space-x-6">

                <a href="<?= $base ?>index.php" class="text-gray-700 hover:text-secondary font-semibold transition">Home</a>

                <!-- About dropdown -->
                <div class="relative group">
                    <button class="text-gray-700 hover:text-secondary font-semibold transition flex items-center space-x-1">
                        <span>About</span>
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <?php foreach([
                                ['documentation.php',    'Documentation'],
                                ['industry-we-serve.php','Industry We Serve'],
                                ['why-itc.php',          'Why ITC'],
                                ['mission-vision.php',   'Mission & Vision']
                            ] as [$href, $label]): ?>
                            <a href="<?= $base.$href ?>" class="block px-6 py-3 text-gray-700 hover:bg-red-50 hover:text-secondary font-medium transition-all border-l-4 border-transparent hover:border-secondary">
                                <?= htmlspecialchars($label) ?>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- ════════════════════════════════════════
                     PRODUCTS MEGA MENU
                ════════════════════════════════════════ -->
                <div class="mega-parent" id="megaParentProducts">
                    <button class="text-gray-700 hover:text-secondary font-semibold transition flex items-center space-x-1"
                            id="megaProductsBtn">
                        <span>Products</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- FIX: wrapper div is the full panel (top:100%, padding-top:8px creates hover bridge) -->
                    <div class="mega-panel" id="megaPanelProducts">

                        <!-- FIX: inner card — this is what is visible -->
                        <div class="mega-panel-inner" id="megaPanelInner">

                            <!-- Header bar with X close button -->
                            <div class="mega-header-bar">
                                <span>All Products &mdash; <?= count($menuTree) ?> Categories</span>
                                <div class="mega-header-right">
                                    <a href="<?= $base ?>product_details.php">View All &rarr;</a>
                                    <!-- FIX: X close button -->
                                    <button class="mega-close-btn" id="megaCloseBtn" title="Close menu">&#x2715;</button>
                                </div>
                            </div>

                            <div class="mega-body">

                                <!-- Col 1: Categories -->
                                <div class="mega-col-cat">
                                    <?php foreach ($menuTree as $ci => $cat): ?>
                                    <button
                                        class="mega-sub-btn <?= $ci === 0 ? 'active' : '' ?>"
                                        data-target="cat-sub-<?= $cat['id'] ?>"
                                        data-cat="all-cats"
                                        onmouseenter="showCatPanel(this)">
                                        <span><?= htmlspecialchars($cat['name']) ?></span>
                                        <span class="count-badge"><?= count($cat['subs']) ?></span>
                                    </button>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Col 2: Subcategories -->
                                <div class="mega-col-sub">
                                    <?php foreach ($menuTree as $ci => $cat): ?>
                                    <div class="cat-sub-panel <?= $ci === 0 ? 'active' : '' ?>"
                                         id="cat-sub-<?= $cat['id'] ?>">
                                        <?php foreach ($cat['subs'] as $si => $sub): ?>

                                        <?php if ($sub['has_sub2']): ?>
                                            <a href="<?= $base ?>product_details.php?sub=<?= urlencode($sub['slug']) ?>"
                                               class="mega-sub-btn <?= ($si === 0 && $ci === 0) ? 'active' : '' ?>"
                                               data-target="sub-right-<?= $cat['id'] ?>-<?= $sub['id'] ?>"
                                               data-cat="sub-cat-<?= $cat['id'] ?>"
                                               data-hassub2="1"
                                               onmouseenter="showSubRight(this)">
                                                <span><?= htmlspecialchars($sub['name']) ?></span>
                                                <span class="sub2-arrow">&#8250;</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= $base ?>product_details.php?sub=<?= urlencode($sub['slug']) ?>"
                                               class="mega-sub-btn <?= ($si === 0 && $ci === 0) ? 'active' : '' ?>"
                                               data-target="sub-right-<?= $cat['id'] ?>-<?= $sub['id'] ?>"
                                               data-cat="sub-cat-<?= $cat['id'] ?>"
                                               data-hassub2="0"
                                               onmouseenter="showSubRight(this)">
                                                <span><?= htmlspecialchars($sub['name']) ?></span>
                                                <span class="count-badge"><?= $sub['product_count'] ?></span>
                                            </a>
                                        <?php endif; ?>

                                        <?php endforeach; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Col 3: Sub2 -->
                                <div class="mega-col-sub2" id="megaColSub2">
                                    <?php foreach ($menuTree as $ci => $cat): ?>
                                    <?php foreach ($cat['subs'] as $si => $sub): ?>
                                    <?php if ($sub['has_sub2']): ?>
                                    <div class="sub2-list-panel"
                                         id="sub2-list-<?= $cat['id'] ?>-<?= $sub['id'] ?>">
                                        <?php foreach ($sub['sub2s'] as $s2i => $sub2): ?>
                                        <a href="<?= $base ?>product_details.php?sub=<?= urlencode($sub['slug']) ?>&sub2=<?= urlencode($sub2['slug']) ?>"
                                           class="mega-sub-btn <?= $s2i === 0 ? 'active' : '' ?>"
                                           data-cat="sub2-cat-<?= $sub['id'] ?>">
                                            <span><?= htmlspecialchars($sub2['name']) ?></span>
                                            <span class="count-badge"><?= $sub2['product_count'] ?></span>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </div>

                            </div><!-- /mega-body -->
                        </div><!-- /mega-panel-inner -->
                    </div><!-- /mega-panel -->
                </div>
                <!-- ════ END MEGA MENU ════ -->

                <a href="<?= $base ?>gallery.php" class="text-gray-700 hover:text-secondary font-semibold transition">Gallery</a>
                <a href="<?= $base ?>blog.php"    class="text-gray-700 hover:text-secondary font-semibold transition">Blog</a>
                <a href="<?= $base ?>contact.php" class="text-gray-700 hover:text-secondary font-semibold transition">Contact</a>

                <button onclick="openQuoteModal()"
                        class="bg-red-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-800 transition-all transform hover:scale-105 shadow-lg">
                    Get Quote
                </button>
            </div>

            <!-- Mobile hamburger -->
            <button id="mobileMenuBtn" class="md:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- ══════════════════════════════════════
             MOBILE MENU
        ══════════════════════════════════════ -->
        <div id="mobileMenu"
             class="hidden md:hidden absolute left-0 right-0 bg-white shadow-xl border-t border-gray-100 px-4 py-4 space-y-2 z-50"
             style="top:100%;max-height:82vh;overflow-y:auto;">

            <!-- Mobile Search -->
            <div class="relative w-full mb-2" id="mobileSearchWrapper">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="mobileSearchInput" placeholder="Search products..." autocomplete="off"
                           class="w-full pl-12 pr-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-full text-gray-700 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-secondary transition-all">
                </div>
                <div id="mobileSearchDropdown"
                     class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl z-[9999] overflow-hidden"
                     style="box-shadow:0 20px 60px rgba(0,0,0,.15);border:1px solid #e8edf5;max-height:360px;overflow-y:auto;"></div>
            </div>

            <a href="<?= $base ?>index.php" class="block text-gray-700 hover:text-secondary font-semibold py-2 border-b border-gray-100">Home</a>

            <!-- Mobile About -->
            <div class="border-b border-gray-100">
                <button id="mobileAboutBtn"
                        class="w-full text-left text-gray-700 font-semibold flex items-center justify-between py-2">
                    <span>About</span>
                    <svg id="mobileAboutIcon" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="mobileAboutMenu" class="hidden mb-2 bg-gray-50 rounded-lg overflow-hidden">
                    <?php foreach([
                        ['documentation.php',    'Documentation'],
                        ['industry-we-serve.php','Industry We Serve'],
                        ['why-itc.php',          'Why ITC'],
                        ['mission-vision.php',   'Mission & Vision']
                    ] as [$href, $label]): ?>
                    <a href="<?= $base.$href ?>" class="block px-5 py-3 text-gray-600 hover:text-secondary font-medium border-l-4 border-transparent hover:border-secondary text-sm transition-all">
                        <?= htmlspecialchars($label) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Mobile Products Accordion -->
            <div class="border-b border-gray-100">
                <button id="mobileProductsBtn"
                        class="w-full text-left text-gray-700 font-semibold flex items-center justify-between py-2">
                    <span>Products</span>
                    <svg id="mobileProductsIcon" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="mobileProductsMenu" class="hidden mb-2">
                    <?php foreach ($menuTree as $cat): ?>
                    <div class="mb-1">
                        <button class="mob-cat-btn w-full text-left px-3 py-2.5 text-sm font-bold text-primary flex items-center justify-between bg-blue-50 rounded-lg border-l-4 border-primary"
                                data-target="mob-cat-<?= $cat['id'] ?>">
                            <span><?= htmlspecialchars($cat['name']) ?></span>
                            <svg class="mob-cat-icon w-4 h-4 transition-transform flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div class="mob-sub-panel" id="mob-cat-<?= $cat['id'] ?>">
                            <?php foreach ($cat['subs'] as $sub): ?>
                            <div class="ml-3 mt-1">

                                <?php if ($sub['has_sub2']): ?>
                                <button class="mob-sub-btn w-full text-left px-4 py-2 text-sm text-gray-600 font-semibold flex items-center justify-between bg-gray-50 rounded-lg"
                                        data-target="mob-sub2-group-<?= $sub['id'] ?>">
                                    <span><?= htmlspecialchars($sub['name']) ?></span>
                                    <svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div class="mob-sub-panel" id="mob-sub2-group-<?= $sub['id'] ?>">
                                    <?php foreach ($sub['sub2s'] as $sub2): ?>
                                    <div class="ml-3 mt-1">
                                        <a href="<?= $base ?>product_details.php?sub=<?= urlencode($sub['slug']) ?>&sub2=<?= urlencode($sub2['slug']) ?>"
                                           class="flex items-center justify-between w-full px-4 py-2 text-sm text-indigo-700 font-semibold bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-all">
                                            <span><?= htmlspecialchars($sub2['name']) ?></span>
                                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full flex-shrink-0"><?= $sub2['product_count'] ?></span>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php else: ?>
                                <a href="<?= $base ?>product_details.php?sub=<?= urlencode($sub['slug']) ?>"
                                   class="flex items-center justify-between w-full px-4 py-2 text-sm text-gray-600 font-semibold bg-gray-50 rounded-lg hover:bg-gray-100 transition-all">
                                    <span><?= htmlspecialchars($sub['name']) ?></span>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full flex-shrink-0"><?= $sub['product_count'] ?></span>
                                </a>
                                <?php endif; ?>

                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <a href="<?= $base ?>products.php"
                       class="block text-center text-sm font-bold text-primary bg-blue-50 border border-blue-200 rounded-lg py-2 mt-2 hover:bg-primary hover:text-white transition-all">
                        View All Products &rarr;
                    </a>
                </div>
            </div>

            <a href="<?= $base ?>gallery.php" class="block text-gray-700 hover:text-secondary font-semibold py-2 border-b border-gray-100">Gallery</a>
            <a href="<?= $base ?>blog.php"    class="block text-gray-700 hover:text-secondary font-semibold py-2 border-b border-gray-100">Blog</a>
            <a href="<?= $base ?>contact.php" class="block text-gray-700 hover:text-secondary font-semibold py-2 border-b border-gray-100">Contact</a>

            <button onclick="openQuoteModal()"
                    class="w-full bg-red-700 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-red-800 shadow-lg mt-1">
                Get Quote
            </button>
        </div>
    </nav>
</header>

<script>
// ══════════════════════════════════════════════════
// MEGA MENU — STABLE HOVER SYSTEM
// ══════════════════════════════════════════════════
(function() {
    var parent  = document.getElementById('megaParentProducts');
    var panel   = document.getElementById('megaPanelProducts');
    var closeBtn = document.getElementById('megaCloseBtn');
    if (!parent || !panel) return;

    var isForcedClosed = false;  // set true when X is clicked
    var leaveTimer = null;

    // ── Open / Close helpers ──────────────────────

    function openPanel() {
        isForcedClosed = false;
        clearTimeout(leaveTimer);
        panel.style.display = 'flex';
        repositionPanel();
    }

    function closePanel() {
        panel.style.display = 'none';
    }

    // ── Hover: parent button area ─────────────────
    // We use JS mouseenter/mouseleave instead of pure
    // CSS :hover so the X button can force-close it.

    // Override CSS hover — remove .mega-parent:hover rule effect
    // by controlling display manually
    parent.addEventListener('mouseenter', function() {
        if (!isForcedClosed) openPanel();
    });

    parent.addEventListener('mouseleave', function(e) {
        // FIX: delay close — gives mouse time to reach panel
        // (the padding-top bridge handles the gap, but this
        //  is a safety net for fast mouse moves)
        leaveTimer = setTimeout(function() {
            if (!panel.matches(':hover')) closePanel();
        }, 100);
    });

    panel.addEventListener('mouseenter', function() {
        clearTimeout(leaveTimer);
        if (!isForcedClosed) panel.style.display = 'flex';
    });

    panel.addEventListener('mouseleave', function() {
        leaveTimer = setTimeout(function() {
            if (!parent.matches(':hover')) closePanel();
        }, 80);
    });

    // ── X close button ────────────────────────────
    if (closeBtn) {
        closeBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            isForcedClosed = true;
            closePanel();
            // Reset after mouse fully leaves parent zone
            setTimeout(function() { isForcedClosed = false; }, 800);
        });
    }

    // ── Click outside closes panel ────────────────
    document.addEventListener('click', function(e) {
        if (!parent.contains(e.target)) {
            isForcedClosed = false;
            closePanel();
        }
    });

    // ── Reposition so panel doesn't overflow ──────
    function repositionPanel() {
        panel.style.left      = '50%';
        panel.style.right     = 'auto';
        panel.style.transform = 'translateX(-50%)';

        requestAnimationFrame(function() {
            var rect = panel.getBoundingClientRect();
            if (rect.right > window.innerWidth - 8) {
                panel.style.left      = 'auto';
                panel.style.right     = '0';
                panel.style.transform = 'none';
            } else if (rect.left < 8) {
                panel.style.left      = '0';
                panel.style.right     = 'auto';
                panel.style.transform = 'none';
            }
        });
    }

    // ── Init: set correct sub2 state on load ──────
    var firstActiveSub = document.querySelector('#megaPanelProducts .mega-col-sub .mega-sub-btn.active');
    if (firstActiveSub) {
        if (firstActiveSub.getAttribute('data-hassub2') === '1') {
            showSub2Col();
            var t = firstActiveSub.getAttribute('data-target');
            var p2id = t ? t.replace('sub-right-', 'sub2-list-') : null;
            if (p2id) {
                var p2 = document.getElementById(p2id);
                if (p2) p2.classList.add('active');
            }
        } else {
            hideSub2Col();
        }
    } else {
        hideSub2Col();
    }

    // Start hidden (JS controls display now, not CSS :hover)
    panel.style.display = 'none';

})();

// ══════════════════════════════════════════════════
// MEGA MENU — Col 1 → Col 2 (Category hover)
// ══════════════════════════════════════════════════
function showCatPanel(btn) {
    var target = btn.getAttribute('data-target');

    document.querySelectorAll('[data-cat="all-cats"]').forEach(function(b) {
        b.classList.remove('active');
    });
    btn.classList.add('active');

    document.querySelectorAll('.cat-sub-panel').forEach(function(p) {
        p.classList.remove('active');
    });

    var subPanel = document.getElementById(target);
    if (!subPanel) return;
    subPanel.classList.add('active');

    var firstSubBtn = subPanel.querySelector('.mega-sub-btn');
    if (firstSubBtn) {
        showSubRight(firstSubBtn);
    } else {
        hideSub2Col();
    }
}

// ══════════════════════════════════════════════════
// MEGA MENU — Col 2 → Col 3 (Subcategory hover)
// ══════════════════════════════════════════════════
function showSubRight(btn) {
    var catId   = btn.getAttribute('data-cat');
    var target  = btn.getAttribute('data-target');
    var hasSub2 = btn.getAttribute('data-hassub2') === '1';

    if (catId) {
        document.querySelectorAll('[data-cat="' + catId + '"]').forEach(function(b) {
            b.classList.remove('active');
        });
    }
    btn.classList.add('active');

    if (hasSub2) {
        showSub2Col();
        var sub2PanelId = target.replace('sub-right-', 'sub2-list-');
        document.querySelectorAll('.sub2-list-panel').forEach(function(p) {
            p.classList.remove('active');
        });
        var sub2Panel = document.getElementById(sub2PanelId);
        if (sub2Panel) sub2Panel.classList.add('active');
    } else {
        hideSub2Col();
    }
}

function showSub2Col() {
    var col   = document.getElementById('megaColSub2');
    var panel = document.getElementById('megaPanelProducts');
    if (col)   col.classList.add('visible');
    if (panel) panel.classList.add('has-sub2-open');
}

function hideSub2Col() {
    var col   = document.getElementById('megaColSub2');
    var panel = document.getElementById('megaPanelProducts');
    if (col)   col.classList.remove('visible');
    if (panel) panel.classList.remove('has-sub2-open');
    document.querySelectorAll('.sub2-list-panel').forEach(function(p) {
        p.classList.remove('active');
    });
}

// ══════════════════════════════════════════════════
// MOBILE MENU
// ══════════════════════════════════════════════════
document.getElementById('mobileMenuBtn').addEventListener('click', function() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
});

document.getElementById('mobileAboutBtn').addEventListener('click', function() {
    document.getElementById('mobileAboutMenu').classList.toggle('hidden');
    document.getElementById('mobileAboutIcon').classList.toggle('rotate-180');
});

document.getElementById('mobileProductsBtn').addEventListener('click', function() {
    document.getElementById('mobileProductsMenu').classList.toggle('hidden');
    document.getElementById('mobileProductsIcon').classList.toggle('rotate-180');
});

document.querySelectorAll('.mob-cat-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var target = document.getElementById(this.getAttribute('data-target'));
        if (target) target.classList.toggle('open');
        var icon = this.querySelector('.mob-cat-icon');
        if (icon) icon.classList.toggle('rotate-180');
    });
});

document.querySelectorAll('.mob-sub-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var target = document.getElementById(this.getAttribute('data-target'));
        if (target) target.classList.toggle('open');
    });
});

// ══════════════════════════════════════════════════
// SEARCH
// ══════════════════════════════════════════════════
var searchProducts = [], searchLoaded = false;

function loadSearchData() {
    if (searchLoaded) return;
    try {
        var ts = localStorage.getItem('itc_db_ts'), cached = localStorage.getItem('itc_db_products');
        if (ts && cached && (Date.now() - parseInt(ts)) < 1800000) {
            searchProducts = JSON.parse(cached); searchLoaded = true; return;
        }
    } catch(e) {}
    fetch('./api/get_products.php')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            var p = (data && data.products) ? data.products : data;
            if (!Array.isArray(p) || !p.length) return;
            searchProducts = p; searchLoaded = true;
            try {
                localStorage.setItem('itc_db_products', JSON.stringify(p));
                localStorage.setItem('itc_db_ts', Date.now()+'');
            } catch(e) {}
        }).catch(function(e) { console.warn('Search API failed:', e); });
}

function doFilter(q) {
    if (!q || q.trim().length < 2) return [];
    var ql = q.toLowerCase().trim();
    return searchProducts.filter(function(p) {
        return (p.name     && p.name.toLowerCase().includes(ql))
            || (p.subtitle && p.subtitle.toLowerCase().includes(ql))
            || (p.category && p.category.toLowerCase().includes(ql));
    }).slice(0, 6);
}

function hlText(text, query) {
    if (!text || !query) return text || '';
    var safe = query.replace(/[.*+?^${}()|[\]\\]/g,'\\$&');
    return text.replace(new RegExp('('+safe+')','gi'),'<mark class="sh">$1</mark>');
}

function closeAllDropdowns() {
    ['searchDropdown','mobileSearchDropdown'].forEach(function(id) {
        var el = document.getElementById(id); if (el) el.classList.add('hidden');
    });
}

function goToProductFromSearch(id) {
    closeAllDropdowns();
    var p = searchProducts.find(function(x) { return x.id === id; });
    if (!p) return;
    window.location.href = 'product_page.php?slug=' + encodeURIComponent(p.slug || '') + (p.slug ? '' : '&id='+p.id);
}

function renderDropdown(results, query, ddId) {
    var dd = document.getElementById(ddId); if (!dd) return;
    if (!results.length) {
        dd.innerHTML = '<div class="search-empty"><p class="search-empty-title">No results for &ldquo;'+query+'&rdquo;</p><p class="search-empty-sub">Try different keywords</p></div>';
        dd.classList.remove('hidden'); return;
    }
    var html = '<div class="search-header-bar"><span>'+results.length+' Found</span><a href="products.php">View All &rarr;</a></div>';
    results.forEach(function(p) {
        var img = p.image || './assets/images/Gate-Valve-1.png';
        html += '<div class="search-item" onclick="goToProductFromSearch('+p.id+')">'
              + '<div class="search-item-img-wrap"><img src="'+img+'" onerror="this.src=\'./assets/images/Gate-Valve-1.png\'"></div>'
              + '<div class="search-item-body">'
              + '<div class="search-item-category">'+(p.category||'')+'</div>'
              + '<div class="search-item-name">'+hlText(p.name,query)+'</div>'
              + '<div class="search-item-sub">'+(p.subtitle||'')+'</div>'
              + '</div></div>';
    });
    html += '<div class="search-footer">'
          + '<span class="search-footer-left">Showing '+results.length+' of '+searchProducts.length+'</span>'
          + '<button class="search-footer-btn" onclick="window.location.href=\'products.php?search='+encodeURIComponent(query)+'\'">See all &rarr;</button>'
          + '</div>';
    dd.innerHTML = html; dd.classList.remove('hidden');
}

(function() {
    ['searchInput','mobileSearchInput'].forEach(function(inputId, i) {
        var inp  = document.getElementById(inputId);
        var ddId = i === 0 ? 'searchDropdown' : 'mobileSearchDropdown';
        if (!inp) return;
        var timer;
        inp.addEventListener('focus', function() { loadSearchData(); });
        inp.addEventListener('input', function() {
            clearTimeout(timer);
            var q = this.value.trim();
            if (q.length < 2) { document.getElementById(ddId).classList.add('hidden'); return; }
            timer = setTimeout(function() { renderDropdown(doFilter(q), q, ddId); }, 220);
        });
        inp.addEventListener('keydown', function(e) {
            if (e.key === 'Enter')  { closeAllDropdowns(); window.location.href = 'products.php?search=' + encodeURIComponent(inp.value.trim()); }
            if (e.key === 'Escape') closeAllDropdowns();
        });
    });
})();

document.addEventListener('click', function(e) {
    var dw = document.getElementById('desktopSearchWrapper');
    var mw = document.getElementById('mobileSearchWrapper');
    if (dw && !dw.contains(e.target)) document.getElementById('searchDropdown').classList.add('hidden');
    if (mw && !mw.contains(e.target)) document.getElementById('mobileSearchDropdown').classList.add('hidden');
});

document.addEventListener('DOMContentLoaded', function() { loadSearchData(); });
</script>