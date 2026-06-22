<?php
// ============================================================
// product_details.php
// - Existing UI/tabs: 100% same as before
// - NEW: subcategory filter logic from menu_products added
//   If ?sub= or ?sub2= in URL → show only that subcategory's products
//   Otherwise → show all 250 products (original behavior)
// ============================================================
require_once 'assets/include/config.php';
$conn = getConn();

// ══════════════════════════════════════════════════
// NEW: Read sub/sub2 params (same logic as menu_products.php)
// ══════════════════════════════════════════════════
$subSlug  = isset($_GET['sub'])     ? trim($_GET['sub'])     : '';
$sub2Slug = isset($_GET['sub2'])    ? trim($_GET['sub2'])    : '';
$subId    = isset($_GET['sub_id'])  ? (int)$_GET['sub_id']  : 0;
$sub2Id   = isset($_GET['sub2_id']) ? (int)$_GET['sub2_id'] : 0;

$filterMode   = false;  // true when coming from mega menu with sub/sub2
$sub          = null;
$activeSub2   = null;
$allSub2s     = [];
$hasSub2      = false;
$displayName  = '';
$pageTitle    = 'Products - Indian Traders Corp | Valves, Pipes & Fittings';

try {
    $pdo = getDB();

    // ── Resolve subcategory if sub param given ──
    if ($subSlug || $subId) {
        if ($subSlug) {
            $stmt = $pdo->prepare("SELECT s.*, c.name AS category_name, c.slug AS category_slug FROM menu_subcategories s JOIN menu_categories c ON s.category_id = c.id WHERE s.slug = ? AND s.is_active = 1 LIMIT 1");
            $stmt->execute([$subSlug]);
        } else {
            $stmt = $pdo->prepare("SELECT s.*, c.name AS category_name, c.slug AS category_slug FROM menu_subcategories s JOIN menu_categories c ON s.category_id = c.id WHERE s.id = ? AND s.is_active = 1 LIMIT 1");
            $stmt->execute([$subId]);
        }
        $sub = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($sub) {
            $filterMode = true;

            // Check for sub2
            $s2Check = $pdo->prepare("SELECT * FROM menu_subcategories2 WHERE subcategory_id = ? AND is_active = 1 ORDER BY sort_order");
            $s2Check->execute([$sub['id']]);
            $allSub2s = $s2Check->fetchAll(PDO::FETCH_ASSOC);
            $hasSub2  = !empty($allSub2s);

            if ($hasSub2) {
                if ($sub2Slug) {
                    $s2stmt = $pdo->prepare("SELECT * FROM menu_subcategories2 WHERE slug = ? AND subcategory_id = ? AND is_active = 1 LIMIT 1");
                    $s2stmt->execute([$sub2Slug, $sub['id']]);
                    $activeSub2 = $s2stmt->fetch(PDO::FETCH_ASSOC);
                } elseif ($sub2Id) {
                    $s2stmt = $pdo->prepare("SELECT * FROM menu_subcategories2 WHERE id = ? AND subcategory_id = ? AND is_active = 1 LIMIT 1");
                    $s2stmt->execute([$sub2Id, $sub['id']]);
                    $activeSub2 = $s2stmt->fetch(PDO::FETCH_ASSOC);
                }
                if (!$activeSub2 && !empty($allSub2s)) {
                    $activeSub2 = $allSub2s[0];
                }
            }

            $displayName = ($hasSub2 && $activeSub2) ? $activeSub2['name'] : $sub['name'];
            $pageTitle   = htmlspecialchars($displayName) . ' | Indian Traders Corp';
        }
    }

} catch (Exception $e) {
    // If PDO fails, continue with $conn (MySQLi) for rest of page
}

// ══════════════════════════════════════════════════
// FETCH PRODUCTS
// Uses products table with subcategory_id/subcategory2_id
// ══════════════════════════════════════════════════
$allProducts = [];

if ($filterMode && $sub) {
    // ── FILTERED MODE: only this subcategory's products ──
    if ($hasSub2 && $activeSub2) {
        // sub2 filter
        $result = $conn->prepare("SELECT * FROM products WHERE subcategory2_id = ? AND is_active = 1 ORDER BY sort_order ASC, id ASC");
        $result->bind_param("i", $activeSub2['id']);
        $result->execute();
        $allProducts = $result->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
        // sub filter (no sub2)
        $result = $conn->prepare("SELECT * FROM products WHERE subcategory_id = ? AND subcategory2_id IS NULL AND is_active = 1 ORDER BY sort_order ASC, id ASC");
        $result->bind_param("i", $sub['id']);
        $result->execute();
        $allProducts = $result->get_result()->fetch_all(MYSQLI_ASSOC);
    }
} else {
    // ── DEFAULT MODE: all products (original behavior) ──
    $result = $conn->query("SELECT * FROM products WHERE is_active = 1 ORDER BY sort_order ASC");
    while ($row = $result->fetch_assoc()) {
        $allProducts[] = $row;
    }
}

// ── Category filter arrays (for tabs — original logic) ──
$valves = array_filter($allProducts, function($p) { return $p['category'] === 'Gate / Globe Valves'; });
$ball   = array_filter($allProducts, function($p) { return $p['category'] === 'Ball / Check Valves'; });
$pipes  = array_filter($allProducts, function($p) { return $p['category'] === 'Pipes & Fittings'; });

// ── Original helper functions ──
function priceRange($p) {
    if ((float)$p['price_min'] <= 0) return '';
    $min = 'Rs.' . number_format((float)$p['price_min'], 0, '.', ',');
    $max = 'Rs.' . number_format((float)$p['price_max'], 0, '.', ',');
    if ($p['price_max'] > 0) return $min . ' - ' . $max;
    return $min;
}

function stockLabel($p) {
    if ($p['in_stock']) {
        return (isset($p['stock_label']) && $p['stock_label'] != '') ? htmlspecialchars($p['stock_label']) : 'In Stock';
    }
    return 'Out of Stock';
}

function certLabel($p) {
    return (isset($p['certification']) && $p['certification'] != '') ? htmlspecialchars($p['certification']) : 'ISO Certified';
}

function renderCard($p) {
    $slug     = htmlspecialchars($p['slug']);
    $name     = htmlspecialchars($p['name']);
    $subtitle = (isset($p['subtitle']) && $p['subtitle'] != '') ? htmlspecialchars($p['subtitle']) : '';
    $image    = htmlspecialchars($p['image']);
    $category = htmlspecialchars($p['category']);
    $badge      = (isset($p['badge']) && $p['badge'] != '') ? htmlspecialchars($p['badge']) : '';
    $badgeColor = (isset($p['badge_color']) && $p['badge_color'] != '') ? htmlspecialchars($p['badge_color']) : 'bg-orange-600';
    $price    = priceRange($p);
    $stock    = stockLabel($p);
    $cert     = certLabel($p);

    if ($p['in_stock']) {
        $inStock   = 'text-green-600';
        $stockIcon = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>';
    } else {
        $inStock   = 'text-red-500';
        $stockIcon = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>';
    }

    $badgeHTML = $badge ? '<span class="absolute top-4 right-4 ' . $badgeColor . ' text-white px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wide shadow-lg z-20">' . $badge . '</span>' : '';

    // Link → cart.php (the new unified detail page)
    $detailUrl = 'cart.php?slug=' . $slug;

    echo '<div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border-2 border-gray-200 hover:border-secondary overflow-hidden transform hover:-translate-y-2">';

    echo '<div class="relative bg-gray-50 p-8 h-72 flex items-center justify-center overflow-hidden cursor-pointer" onclick="window.location.href=\'' . $detailUrl . '\'">';
    echo '<span class="absolute top-4 left-4 bg-white text-secondary px-3 py-1.5 rounded-lg text-xs font-bold border border-gray-300 shadow-md z-20">' . $category . '</span>';
    echo $badgeHTML;
    echo '<img src="' . $image . '" alt="' . $name . '" class="max-w-full h-56 object-contain transform group-hover:scale-110 transition-transform duration-700 relative z-10" loading="lazy" onerror="this.src=\'./assets/images/Globe-Valve-1.png\'">';
    echo '</div>';

    echo '<div class="p-6">';
    echo '<h3 class="text-lg font-bold text-secondary mb-2 cursor-pointer" onclick="window.location.href=\'' . $detailUrl . '\'">' . $name . '</h3>';
    echo '<p class="text-gray-600 text-sm mb-3">' . $subtitle . '</p>';
$priceClass = ((float)$p['price_min'] <= 0) ? 'text-lg font-bold text-gray-500' : 'text-2xl font-extrabold text-secondary';
echo '<p class="' . $priceClass . ' mb-5">' . $price . '</p>';
    echo '<div class="flex items-center gap-2 mb-5 text-xs text-gray-600">';
    echo '<svg class="w-4 h-4 ' . $inStock . '" fill="currentColor" viewBox="0 0 20 20">' . $stockIcon . '</svg>';
    echo '<span class="font-semibold ' . $inStock . '">' . $stock . '</span>';
    echo '<span class="mx-1">&#8226;</span>';
    echo '<span>' . $cert . '</span>';
    echo '</div>';

    echo '<div class="flex gap-3">';
    echo '<button onclick="window.location.href=\'' . $detailUrl . '\'" class="flex-1 bg-white border-2 border-secondary text-secondary hover:bg-secondary hover:text-white px-4 py-3 rounded-xl font-bold transition-all duration-300 text-sm">View Details</button>';
    echo '<button onclick="openQuoteModal()" class="flex-1 bg-secondary text-white px-4 py-3 rounded-xl font-bold transition-all duration-300 text-sm">Enquiry</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#b71c1c',
                        secondary: '#0a2463',
                    }
                }
            }
        }
    </script>
    <style>
        .tabs-scroll::-webkit-scrollbar { display: none; }
        .tabs-scroll { -ms-overflow-style: none; scrollbar-width: none; }

        /* Sub2 filter pills — same as menu_products.php */
        .sub2-pill {
            display: inline-flex; align-items: center;
            padding: 7px 18px; border-radius: 50px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            transition: all .18s ease; white-space: nowrap;
            border: 1.5px solid #d1d5db; background: #fff; color: #374151;
            text-decoration: none;
        }
        .sub2-pill:hover { border-color: #0a2463; color: #0a2463; }
        .sub2-pill.active { background: #0a2463; color: #fff; border-color: #0a2463; }
        .no-scroll::-webkit-scrollbar { display: none; }
        .no-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50">

<?php include 'assets/include/header.php'; ?>
<?php include 'assets/include/modal.php'; ?>

<?php if ($filterMode && $sub): ?>
<!-- ══════════════════════════════════════════════════
     FILTER MODE: Breadcrumb + Header (from menu_products)
══════════════════════════════════════════════════ -->


<!-- Page header -->
<div style="background:#0a2463;border-bottom:3px solid #c0392b;">
    <div style="max-width:1440px;margin:0 auto;padding:28px 24px 24px;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
            <div>
                <span style="display:inline-block;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-bottom:6px;">
                    <?= htmlspecialchars($sub['category_name'] ?? '') ?>
                    <?php if ($hasSub2 && $activeSub2): ?> › <?= htmlspecialchars($sub['name']) ?><?php endif; ?>
                </span>
                <h1 style="font-size:28px;font-weight:800;color:#fff;line-height:1.2;margin-bottom:10px;">
                    <?= htmlspecialchars($displayName) ?>
                </h1>
                <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
                    <span style="font-size:13px;font-weight:700;background:rgba(245,158,11,.15);color:#fcd34d;border:1px solid rgba(245,158,11,.3);padding:4px 12px;border-radius:20px;">
                        <?= count($allProducts) ?> Products
                    </span>
                    <span style="font-size:12px;color:rgba(255,255,255,.4);font-weight:500;">ISO 9001 Certified · IBR Approved</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sub2 filter pills -->
<?php if ($hasSub2 && !empty($allSub2s)): ?>
<div style="background:#fff;border-bottom:1px solid #e5e7eb;">
    <div style="max-width:1440px;margin:0 auto;padding:0 24px;">
        <div style="display:flex;align-items:center;gap:8px;overflow-x:auto;padding:12px 0;" class="no-scroll">
            <?php foreach ($allSub2s as $s2):
                $isActive = ($activeSub2 && $activeSub2['id'] == $s2['id']);
                $url = 'product_details.php?sub=' . urlencode($sub['slug']) . '&sub2=' . urlencode($s2['slug']);
            ?>
            <a href="<?= $url ?>" class="sub2-pill <?= $isActive ? 'active' : '' ?>">
                <?= htmlspecialchars($s2['name']) ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Products grid (filter mode) -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <?php if (!empty($allProducts)): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($allProducts as $p) { renderCard($p); } ?>
        </div>
        <?php else: ?>
        <div style="text-align:center;padding:80px 20px;">
            <p style="font-size:20px;font-weight:800;color:#9ca3af;margin-bottom:8px;">No products found</p>
            <p style="font-size:14px;color:#d1d5db;">Contact us for details.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php else: ?>
<!-- ══════════════════════════════════════════════════
     DEFAULT MODE: Original full page UI (100% unchanged)
══════════════════════════════════════════════════ -->

<section class="relative bg-secondary overflow-hidden flex items-center" style="min-height:500px;">
    <div class="container mx-auto px-4 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-5xl font-extrabold text-white mb-6">World-Class Industrial Solutions</h1>
            <p class="text-xl text-blue-100 mb-12 max-w-3xl mx-auto">
                ISO Certified Valves, Pipes &amp; Fittings for Your Industrial Excellence
            </p>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-6" style="background:rgba(255,255,255,0.1);">
                    <div class="text-4xl font-bold text-yellow-400 mb-2"><?= count($allProducts) ?>+</div>
                    <div class="text-sm text-white font-semibold">Products</div>
                </div>
                <div class="rounded-2xl p-6" style="background:rgba(255,255,255,0.1);">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">55+</div>
                    <div class="text-sm text-white font-semibold">Years Trust</div>
                </div>
                <div class="rounded-2xl p-6" style="background:rgba(255,255,255,0.1);">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">ISO</div>
                    <div class="text-sm text-white font-semibold">Certified</div>
                </div>
                <div class="rounded-2xl p-6" style="background:rgba(255,255,255,0.1);">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">1000+</div>
                    <div class="text-sm text-white font-semibold">Happy Clients</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FILTER BAR — original -->
<section class="sticky top-0 z-40 bg-white shadow-lg border-b-2 border-gray-200">
    <div class="container mx-auto px-4 py-4 md:py-6">
        <div class="tabs-scroll flex flex-nowrap md:flex-wrap md:justify-center gap-3 overflow-x-auto" style="-webkit-overflow-scrolling: touch;">
            <button id="btn-all"
                    class="flex-shrink-0 px-6 py-3 rounded-xl font-bold text-sm bg-secondary text-white shadow-lg whitespace-nowrap"
                    onclick="filterProducts('all')">All Products</button>
            <button id="btn-valves"
                    class="flex-shrink-0 px-6 py-3 rounded-xl font-bold text-sm bg-white text-secondary border-2 border-gray-300 shadow-md whitespace-nowrap"
                    onclick="filterProducts('valves')">Gate / Globe Valves</button>
            <button id="btn-ball"
                    class="flex-shrink-0 px-6 py-3 rounded-xl font-bold text-sm bg-white text-secondary border-2 border-gray-300 shadow-md whitespace-nowrap"
                    onclick="filterProducts('ball')">Ball / Check Valves</button>
            <button id="btn-pipes"
                    class="flex-shrink-0 px-6 py-3 rounded-xl font-bold text-sm bg-white text-secondary border-2 border-gray-300 shadow-md whitespace-nowrap"
                    onclick="filterProducts('pipes')">Pipes &amp; Fittings</button>
        </div>
    </div>
</section>

<!-- ALL PRODUCTS -->
<section id="all-section" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">All Industrial Products</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Browse our comprehensive range of premium quality industrial products</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($allProducts as $p) { renderCard($p); } ?>
        </div>
    </div>
</section>

<!-- GATE / GLOBE VALVES -->
<section id="valves-section" class="py-16 bg-white" style="display:none;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Gate / Globe Valves</h2>
            <p class="text-xl text-gray-600">Premium quality gate and globe valves for industrial applications</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($valves as $p) { renderCard($p); } ?>
        </div>
    </div>
</section>

<!-- BALL / CHECK VALVES -->
<section id="ball-section" class="py-16 bg-gray-50" style="display:none;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Ball / Check Valves</h2>
            <p class="text-xl text-gray-600">High-performance ball and check valves for precise control</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($ball as $p) { renderCard($p); } ?>
        </div>
    </div>
</section>

<!-- PIPES & FITTINGS -->
<section id="pipes-section" class="py-16 bg-white" style="display:none;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Pipes &amp; Fittings</h2>
            <p class="text-xl text-gray-600">Complete range of pipes and fittings for all applications</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($pipes as $p) { renderCard($p); } ?>
        </div>
    </div>
</section>

<?php endif; ?>

<!-- CTA — shown in both modes -->
<section class="py-24 bg-secondary text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-extrabold mb-6">Need Expert Assistance?</h2>
        <p class="text-xl text-blue-100 mb-12 max-w-3xl mx-auto">
            Our technical team is ready to help you select the perfect products for your requirements
        </p>
        <div class="flex flex-wrap justify-center gap-5">
            <a href="tel:+918468851160" class="bg-white text-secondary font-bold px-10 py-5 rounded-xl shadow-2xl text-lg">Call Now</a>
            <button onclick="openQuoteModal()" class="bg-blue-700 text-white font-bold px-10 py-5 rounded-xl shadow-2xl text-lg border-2 border-white">Request Quote</button>
        </div>
    </div>
</section>

<?php include 'assets/include/footer.php'; ?>

<script>
// Original filter logic — unchanged
function filterProducts(category) {
    var cats = ['all', 'valves', 'ball', 'pipes'];
    for (var i = 0; i < cats.length; i++) {
        var btn = document.getElementById('btn-' + cats[i]);
        var sec = document.getElementById(cats[i] + '-section');
        if (!btn || !sec) continue;
        if (cats[i] === category) {
            btn.style.backgroundColor = '#0a2463';
            btn.style.color = '#ffffff';
            sec.style.display = 'block';
        } else {
            btn.style.backgroundColor = '#ffffff';
            btn.style.color = '#0a2463';
            sec.style.display = 'none';
        }
    }
    window.scrollTo(0, 600);
}

function openQuoteModal() {
    var modal = document.getElementById('quoteModal');
    if (modal) { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
}
function closeQuoteModal() {
    var modal = document.getElementById('quoteModal');
    if (modal) { modal.classList.add('hidden'); document.body.style.overflow = ''; }
}

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('quoteModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeQuoteModal();
        });
    }
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeQuoteModal();
});
</script>
</body>
</html>