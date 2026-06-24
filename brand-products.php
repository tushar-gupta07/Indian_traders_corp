<?php
require_once 'assets/include/config.php';
$conn = getConn();

// ── GET BRAND ──────────────────────────────────────────
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$brand = null;

if ($slug) {
    $stmt = $conn->prepare("SELECT * FROM brands WHERE slug = ? AND is_active = 1 LIMIT 1");
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $brand = $stmt->get_result()->fetch_assoc();
}

if (!$brand) {
    die('<div style="padding:60px;text-align:center;font-family:sans-serif"><h2>Brand not found</h2><p><a href="brands.php">← Back to all brands</a></p></div>');
}

$bid = $brand['id'];

// ── GET PRODUCTS FOR THIS BRAND ────────────────────────
$products = [];
$p = $conn->prepare("SELECT id, name, slug, subtitle, image, price_min, price_max, category FROM products WHERE brand_id = ? AND is_active = 1 ORDER BY sort_order");
$p->bind_param("i", $bid);
$p->execute();
$pResult = $p->get_result();
while ($row = $pResult->fetch_assoc()) $products[] = $row;

function formatINR($price) {
    if ($price === null || $price === '') return '';
    return '₹' . number_format($price, 0, '.', ',');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($brand['name']) ?> Products | Indian Traders Corp</title>
    <meta name="description" content="Shop genuine <?= htmlspecialchars($brand['name']) ?> products at Indian Traders Corp. <?= htmlspecialchars(substr($brand['description'] ?? '', 0, 120)) ?>">
    <link rel="canonical" href="https://www.indiantradescorp.com/brand-products.php?slug=<?= htmlspecialchars($brand['slug']) ?>">

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

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fb;
            color: #111;
            overflow-x: hidden;
        }

        :root {
            --primary: #0a2463;
            --primary-dark: #071940;
            --secondary: #d32f2f;
        }

        /* ===== BRAND HERO ===== */
        .brand-hero {
            background: radial-gradient(ellipse at 30% 50%, #1a3a8f 0%, #0d2060 40%, #071540 100%);
            position: relative;
            overflow: hidden;
            padding: 50px 20px 80px;
        }

        .brand-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.055) 1px, transparent 1px);
            background-size: 26px 26px;
            pointer-events: none;
        }

        .brand-hero::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 60px;
            background: #f8f9fb;
            border-radius: 50% 50% 0 0 / 60px 60px 0 0;
        }

        .breadcrumb-link {
            color: rgba(255,255,255,0.6);
            transition: color 0.2s;
            text-decoration: none;
            font-size: 13px;
        }
        .breadcrumb-link:hover { color: #fff; }

        .brand-hero-inner {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .brand-logo-card {
            background: #fff;
            border-radius: 20px;
            padding: 22px 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            width: 180px;
            height: 110px;
            flex-shrink: 0;
        }

        .brand-logo-card img {
            max-width: 100%;
            max-height: 65px;
            object-fit: contain;
        }

        .brand-hero-name {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            color: #fff;
            font-size: clamp(26px, 4vw, 40px);
            line-height: 1.15;
        }

        .brand-hero-desc {
            color: rgba(255,255,255,0.75);
            font-size: 14px;
            line-height: 1.6;
            max-width: 620px;
            margin-top: 10px;
        }

        .brand-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.25);
            color: rgba(255,255,255,0.9);
            padding: 5px 16px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 14px;
        }

        /* ===== PRODUCT CARDS ===== */
        .pgrid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 1100px) { .pgrid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px)  { .pgrid { grid-template-columns: repeat(1, 1fr); gap: 14px; } }
        @media (max-width: 480px)  { .pgrid { grid-template-columns: repeat(1, 1fr); gap: 10px; } }

        .pcard {
            background: #fff;
            border: 2px solid #e8ecf4;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            display: flex;
            flex-direction: column;
        }
        .pcard:hover {
            transform: translateY(-6px);
            border-color: var(--primary);
            box-shadow: 0 20px 50px rgba(4, 37, 116, 0.15);
        }

        .pcard .img-wrap {
            background: #f8f9fb61;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 230px;
            padding:16px;
            border-bottom: 1px solid #f0f2f87e;
            position: relative;
        }
        .pcard .img-wrap img {
            max-height: 160px;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.5s ease;
        }
        .pcard:hover .img-wrap img { transform: scale(1.06); }

        .pcard .brand-tag {
            position: absolute;
            top: 8px;
            left: 10px;
            z-index: 10;
            background: var(--primary);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .pcard .body { padding: 14px 16px 16px; flex: 1; display: flex; flex-direction: column; }

  .pcard h3{
    font-family: 'Montserrat', sans-serif;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.3;
    color: var(--primary);

    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
        .pcard .subtitle {
            font-size: 11px;
            font-weight: 800;
            color: #0c2b62;
            margin-bottom: 8px;
        }

        .pcard .price {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--secondary);
            margin-top: auto;
        }

        .pcard .cat-pill {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            color: #374151;
            background: #f3f4f6;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 8px;
            width: fit-content;
        }

        .pcard .view-btn {
            display: block;
            text-align: center;
            background: var(--primary);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 9px;
            border-radius: 8px;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .pcard:hover .view-btn { background: var(--secondary); }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 70px 20px;
        }
        .empty-state svg { width: 64px; height: 64px; color: #d1d5db; margin: 0 auto 16px; }
        .empty-state h3 { font-size: 20px; font-weight: 800; color: #6b7280; margin-bottom: 6px; font-family: 'Montserrat', sans-serif; }
        .empty-state p { color: #9ca3af; font-size: 14px; }

        /* ===== CTA STRIP ===== */
        .cta-strip {
            background: linear-gradient(135deg, #071940 0%, #0a2463 60%, #1e3a8a 100%);
        }
    </style>
</head>
<body class="bg-gray-50">

    <?php include 'assets/include/header.php'; ?>
    <?php include 'assets/include/modal.php'; ?>

    <!-- ============================================================ -->
    <!-- BRAND HERO                                                    -->
    <!-- ============================================================ -->
    <section class="brand-hero">
        <div class="brand-hero-inner px-4">

            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 mb-8" aria-label="Breadcrumb">
                <a href="index.php" class="breadcrumb-link">Home</a>
                <svg class="w-3 h-3" style="color:rgba(255,255,255,0.35)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="brands.php" class="breadcrumb-link">Brand Partners</a>
                <svg class="w-3 h-3" style="color:rgba(255,255,255,0.35)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span style="color:rgba(255,255,255,0.85); font-size:13px; font-weight:600;"><?= htmlspecialchars($brand['name']) ?></span>
            </nav>

            <!-- Brand identity row -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                <div class="brand-logo-card">
                    <img src="<?= htmlspecialchars($brand['logo']) ?>" alt="<?= htmlspecialchars($brand['name']) ?> logo">
                </div>
                <div>
                    <div class="brand-hero-badge">
                        <svg class="w-3 h-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Authorized Brand Partner
                    </div>
                    <h1 class="brand-hero-name mt-2"><?= htmlspecialchars($brand['name']) ?></h1>
                    <?php if (!empty($brand['description'])): ?>
                    <p class="brand-hero-desc"><?= htmlspecialchars($brand['description']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>

    <!-- ============================================================ -->
    <!-- PRODUCTS GRID                                                 -->
    <!-- ============================================================ -->
    <section class="py-10 md:py-14">
        <div class="container mx-auto px-4 max-w-7xl">

            <div class="flex items-center justify-between mb-6">
                <p class="text-gray-500 text-sm">
                    Showing <span class="font-bold text-primary"><?= count($products) ?></span> product<?= count($products) !== 1 ? 's' : '' ?> from <span class="font-bold text-primary"><?= htmlspecialchars($brand['name']) ?></span>
                </p>
                <a href="brands.php" class="text-sm font-semibold text-primary hover:underline flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    All Brands
                </a>
            </div>

            <?php if (!empty($products)): ?>
            <div class="pgrid">
                <?php foreach ($products as $prod): ?>
                <div class="pcard" onclick="window.location.href='cart.php?slug=<?= urlencode($prod['slug']) ?>'">
                    <div class="img-wrap">
                        <span class="brand-tag"><?= htmlspecialchars($brand['name']) ?></span>
                        <img src="<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>" loading="lazy" onerror="this.style.opacity='0.3'">
                    </div>
                    <div class="body">
                        <?php if (!empty($prod['category'])): ?>
                        <span class="cat-pill"><?= htmlspecialchars($prod['category']) ?></span>
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($prod['name']) ?></h3>
                        <?php if (!empty($prod['subtitle'])): ?>
                        <p class="subtitle"><?= htmlspecialchars($prod['subtitle']) ?></p>
                        <?php endif; ?>
                        <div class="price">
                            <?= formatINR($prod['price_min']) ?><?= ($prod['price_max'] ?? 0) > 0 ? ' – ' . formatINR($prod['price_max']) : '' ?>
                        </div>
                        <div class="view-btn">View Details</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <h3>No products listed yet</h3>
                <p>We're updating our <?= htmlspecialchars($brand['name']) ?> catalog. Please check back soon or contact us directly.</p>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ============================================================ -->
    <!-- CTA STRIP                                                     -->
    <!-- ============================================================ -->
    <section class="cta-strip py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white mb-3" style="font-family:'Montserrat',sans-serif;">
                Need a <?= htmlspecialchars($brand['name']) ?> Product Not Listed Here?
            </h2>
            <p class="text-blue-200 mb-6 max-w-xl mx-auto text-sm md:text-base">
                We can source it for you. Call us or send an inquiry — our team will get back with availability & pricing.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="tel:+918468851160"
                   class="inline-flex items-center justify-center gap-2 bg-secondary hover:bg-secondary-dark text-white font-bold px-7 py-3.5 rounded-lg transition-all shadow-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    Call Now
                </a>
                <a href="https://wa.me/918468851160?text=Hi%2C%20I%27m%20looking%20for%20<?= urlencode($brand['name']) ?>%20products."
                   target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center gap-2 bg-white hover:bg-gray-100 text-primary font-bold px-7 py-3.5 rounded-lg transition-all shadow-xl">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp Us
                </a>
            </div>
        </div>
    </section>

    <?php include 'assets/include/footer.php'; ?>

</body>
</html>