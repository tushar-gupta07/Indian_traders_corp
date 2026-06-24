<?php
require_once 'assets/include/config.php';
$conn = getConn();

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
$id   = isset($_GET['id'])   ? (int)$_GET['id']   : 0;
$product = null;

if ($slug) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE slug = ? AND is_active = 1 LIMIT 1");
    $stmt->bind_param("s", $slug); $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
} elseif ($id) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ? AND is_active = 1 LIMIT 1");
    $stmt->bind_param("i", $id); $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
}
if (!$product) {
    $result = $conn->query("SELECT * FROM products WHERE is_active = 1 ORDER BY sort_order LIMIT 1");
    $product = $result->fetch_assoc();
}
if (!$product) { die('<div style="padding:40px;text-align:center"><h2>Database empty!</h2><p>Import itc_db.sql first.</p></div>'); }

$pid = $product['id'];

$specs = [];
$s = $conn->prepare("SELECT spec_key, spec_value FROM product_specifications WHERE product_id = ? ORDER BY sort_order");
$s->bind_param("i", $pid); $s->execute(); $sResult = $s->get_result();
while ($row = $sResult->fetch_assoc()) $specs[] = $row;

$features = [];
$f = $conn->prepare("SELECT feature FROM product_features WHERE product_id = ? ORDER BY sort_order");
$f->bind_param("i", $pid); $f->execute(); $fResult = $f->get_result();
while ($row = $fResult->fetch_assoc()) $features[] = $row['feature'];
// ── GET BRAND FOR THIS PRODUCT ──────────────────────────
$brandInfo = null;
if (!empty($product['brand_id'])) {
    $br = $conn->prepare("SELECT id, name, slug, logo FROM brands WHERE id = ? AND is_active = 1 LIMIT 1");
    $br->bind_param("i", $product['brand_id']);
    $br->execute();
    $brandInfo = $br->get_result()->fetch_assoc();
}
$applications = [];
$a = $conn->prepare("SELECT application FROM product_applications WHERE product_id = ? ORDER BY sort_order");
$a->bind_param("i", $pid); $a->execute(); $aResult = $a->get_result();
while ($row = $aResult->fetch_assoc()) $applications[] = $row['application'];

$offers = [];
$o = $conn->prepare("SELECT icon, offer_text, valid_note FROM product_offers WHERE (product_id = ? OR (product_id IS NULL AND category = ?)) AND is_active = 1 ORDER BY sort_order");
$o->bind_param("is", $pid, $product['category']); $o->execute(); $oResult = $o->get_result();
while ($row = $oResult->fetch_assoc()) $offers[] = $row;
// ── VARIANT GROUPS FETCH ──────────────────────────────
$variantGroups = [];
$vg = $conn->prepare(
    "SELECT id, group_name, sort_order FROM product_variant_groups 
     WHERE product_id = ? ORDER BY sort_order"
);
$vg->bind_param("i", $pid);
$vg->execute();
$vgResult = $vg->get_result();

while ($grp = $vgResult->fetch_assoc()) {
    $vo = $conn->prepare(
        "SELECT id, option_label, is_default, sort_order 
         FROM product_variant_options 
         WHERE group_id = ? ORDER BY sort_order"
    );
    $vo->bind_param("i", $grp['id']);
    $vo->execute();
    $grp['options'] = $vo->get_result()->fetch_all(MYSQLI_ASSOC);
    $variantGroups[] = $grp;
}

$variantGroupsJSON = json_encode(
    $variantGroups,
    JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT
);
function renderVariants(array $groups, string $ctx): void {
    foreach ($groups as $grp) {
        $name = htmlspecialchars($grp['group_name']);
        $opts = $grp['options'];

        if (empty($opts)) continue;

        // Always render as a range: First Option – Last Option
        $first = htmlspecialchars($opts[0]['option_label']);
        $last  = htmlspecialchars($opts[count($opts) - 1]['option_label']);

        if ($ctx === 'desktop') {
            echo '<div style="margin-bottom:16px;">';
            echo '<div style="font-size:13px;font-weight:800;color:#fff;font-family:Inter,sans-serif;">';
            echo $name . ': <span style="font-weight:600;color:rgba(255,255,255,.7);">' . $first . ' – ' . $last . '</span>';
            echo '</div>';
            echo '</div>';

        } else { // mobile
            echo '<div class="mob-variant-block">';
            echo '<div class="mob-variant-lbl">' . $name . ': ';
            echo '<span class="mob-variant-selected">' . $first . ' – ' . $last . '</span></div>';
            echo '</div>';
        }
    }
}
$images = [];
$i = $conn->prepare("SELECT image_path, alt_text FROM product_images WHERE product_id = ? ORDER BY sort_order");
$i->bind_param("i", $pid); $i->execute(); $iResult = $i->get_result();
while ($row = $iResult->fetch_assoc()) $images[] = $row;
if (empty($images)) $images[] = ['image_path' => $product['image'], 'alt_text' => $product['name']];

$related = [];
$r = $conn->prepare("SELECT id, name, slug, subtitle, image, price_min, price_max FROM products WHERE category = ? AND id != ? AND is_active = 1 ORDER BY sort_order LIMIT 6");
$r->bind_param("si", $product['category'], $pid); $r->execute(); $rResult = $r->get_result();
while ($row = $rResult->fetch_assoc()) $related[] = $row;

$allProducts = [];
$ap = $conn->query("SELECT id, name, slug, subtitle, image, price_min, price_max, category FROM products WHERE is_active = 1 ORDER BY sort_order LIMIT 12");
while ($row = $ap->fetch_assoc()) $allProducts[] = $row;

function formatINR($price) { return '₹' . number_format($price, 0, '.', ','); }

$mrpDisplay = $product['mrp'] > 0 ? $product['mrp'] : round($product['price_min'] * 1.17);
$savings    = $mrpDisplay - $product['price_min'];
// TEMP: force 3 demo images for thumbnail testing — remove when DB has real gallery images
$images = [];
if (!empty($product['image1'])) $images[] = ['image_path' => $product['image1'], 'alt_text' => $product['name']];
if (!empty($product['image2'])) $images[] = ['image_path' => $product['image2'], 'alt_text' => $product['name']];
if (!empty($product['image3'])) $images[] = ['image_path' => $product['image3'], 'alt_text' => $product['name']];
if (empty($images)) $images[] = ['image_path' => $product['image'], 'alt_text' => $product['name']];
$productJSON      = json_encode($product,      JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
$specsJSON        = json_encode($specs,         JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
$featuresJSON     = json_encode($features,      JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
$applicationsJSON = json_encode($applications,  JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
$offersJSON       = json_encode($offers,        JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
$imagesJSON       = json_encode($images,        JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
$relatedJSON      = json_encode($related,       JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
$allProductsJSON  = json_encode($allProducts,   JSON_UNESCAPED_UNICODE|JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title><?= htmlspecialchars($product['name']) ?> – Indian Traders Corp</title>
    <meta name="description" content="<?= htmlspecialchars(substr($product['description'] ?? '', 0, 160)) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#b71c1c',
                    secondary: '#0a2463'
                },
                fontFamily: {
                    sans: ['Sora', 'sans-serif'],
                    display: ['sora', 'sans-serif']
                }
            }
        }
    }
    </script>
    <style>
    #backToTop {
        display: none !important;
    }


    /* ═══════════════════════════════════════════════════════════════
   COMPLETE FIXED CSS — product page (cart.php)
   Fixes:
   1. dbar → single column on mobile (all 4 tiles stack vertically)
   2. Floating arrow / cart btn overlap fixed
   3. Related products + right sidebar overflow / cut-off fixed
   4. pcard qty-box overflow fixed
   5. General horizontal scroll prevention hardened
═══════════════════════════════════════════════════════════════ */

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0
    }

    body {
        font-family: 'Sora', sans-serif;
        background: #f0f2f7;
        color: #1a1e2e
    }
/* ── HERO EQUAL HEIGHT FIX ── */
.hero-inner {
    align-items: stretch !important;
}

.hero-left {
    display: flex;
    flex-direction: column;
    justify-content: center;
}
/* ── IMAGE SIZE LIMIT FIX ── */
@media(min-width:861px) {
    .hero-img-wrap {
        min-height: 320px !important;
        max-height: 420px !important;
    }
   
}


.hero-img-card {
    flex: 1;
    display: flex;
    flex-direction: column;
    border-radius: 20px 20px 0 0;
}

.hero-img-wrap {
    flex: 1;
    min-height: 300px;
}
    /* ════════════════════════════════
   REVIEW SEARCH + SORT BAR (NAYA)
════════════════════════════════ */
    .rev-toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        border-bottom: 1px solid var(--border);
        background: #fff;
        flex-wrap: wrap;
    }

    .rev-search-wrap {
        flex: 1;
        min-width: 200px;
        position: relative;
    }

    .rev-search-wrap svg {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: var(--faint);
        pointer-events: none;
    }

    .rev-search-input {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 10px 14px 10px 38px;
        font-size: 13px;
        font-family: 'Sora', sans-serif;
        color: var(--text);
        outline: none;
        background: #f8fafc;
        transition: border-color .2s, background .2s;
    }

    .rev-search-input:focus {
        border-color: #0a2463;
        background: #fff;
    }

    .rev-sort-wrap {
        flex-shrink: 0;
    }

    .rev-sort-select {
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 10px 32px 10px 14px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'Sora', sans-serif;
        color: var(--text);
        background-color: #f8fafc;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3e%3cpath d='M6 9l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 14px;
        cursor: pointer;
        outline: none;
    }

    .rev-sort-select:focus {
        border-color: #0a2463;
    }

    @media(max-width:640px) {
        .rev-toolbar {
            padding: 12px 16px;
            gap: 8px;
        }

        .rev-search-input,
        .rev-sort-select {
            font-size: 12px;
            padding: 9px 12px 9px 34px;
        }

        .rev-sort-select {
            padding: 9px 28px 9px 12px;
        }
    }

    /* ── AVATAR PHOTO OVERRIDE ── */
    .rev-avatar {
        overflow: hidden;
    }

    .rev-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    @media(min-width:861px) {
        .page-body {
            grid-template-columns: 1fr 300px;
            max-width: 1320px;
            margin: 0 auto;
            padding-left: 28px;
            padding-right: 28px;
            width: auto;
        }

        .left-col,
        .review-block,
        #reviewSection {
            width: 100%;
            max-width: 100%;
            margin-left: 0;
            margin-right: 0;
        }
    }

    :root {
        --red: #b71c1c;
        --red-dark: #8b0000;
        --navy: #0a2463;
        --navy-dark: #061540;
        --green: #16a34a;
        --orange: #f97316;
        --bg: #f0f2f7;
        --surface: #ffffff;
        --border: #e2e8f0;
        --text: #1a1e2e;
        --muted: #64748b;
        --faint: #94a3b8;
        --r8: 8px;
        --r12: 12px;
        --r16: 16px;
        --r20: 20px;
        --r24: 24px;
        --sh1: 0 1px 4px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
        --sh2: 0 4px 20px rgba(0, 0, 0, .08), 0 2px 8px rgba(0, 0, 0, .04);
        --sh3: 0 12px 48px rgba(0, 0, 0, .12), 0 4px 16px rgba(0, 0, 0, .06);
    }

    /* Prevent ALL horizontal overflow */
    html,
    body {
        overflow-x: hidden;
        width: 100%;
        max-width: 100%;
    }

    /* ── SCROLLBAR ── */
    ::-webkit-scrollbar {
        width: 5px;
        height: 5px
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px
    }


    /* ═══════════════════════════════════
   BREADCRUMB BAR
═══════════════════════════════════ */
    .bc-bar {
        background: var(--navy);
        padding: 10px 0
    }

    .bc-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 28px;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 600
    }

    .bc-inner a {
        color: rgba(255, 255, 255, .55);
        text-decoration: none;
        transition: color .2s
    }

    .bc-inner a:hover {
        color: #fff
    }

    .bc-inner .sep {
        color: rgba(255, 255, 255, .25)
    }

    .bc-inner .cur {
        color: #fff
    }

    @media(max-width:640px) {
        .bc-bar {
            padding: 8px 0
        }

        .bc-inner {
            padding: 0 16px;
            font-size: 10px;
            gap: 4px;
            overflow-x: auto;
            scrollbar-width: none;
            flex-wrap: nowrap
        }

        .bc-inner::-webkit-scrollbar {
            display: none
        }
    }


    /* ═══════════════════════════════════
   HERO BAND
═══════════════════════════════════ */
    .hero-band {
        background: linear-gradient(135deg, #0a2463 0%, #0d2d7a 60%, #1a3a9a 100%);
        padding: 36px 0 0
    }

    .hero-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 28px;
        display: grid;
        grid-template-columns: 420px 1fr;
        gap: 40px;
        align-items: end
    }

    @media(max-width:1100px) {
        .hero-inner {
            grid-template-columns: 1fr 360px;
            gap: 28px
        }
    }

    @media(max-width:860px) {
        .hero-band {
            padding: 24px 0 0
        }

        .hero-inner {
            grid-template-columns: 1fr;
            gap: 0;
            padding: 0 20px
        }
    }

    @media(max-width:640px) {
        .hero-band {
            padding: 20px 0 0
        }

        .hero-inner {
            padding: 0 16px
        }
    }

    /* LEFT */
    .hero-left {
        padding-bottom: 32px
    }

    .hero-cat {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .2);
        color: rgba(255, 255, 255, .85);
        font-size: 10px;
        font-weight: 800;
        padding: 4px 14px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: .1em;
        margin-bottom: 16px
    }

    .hero-title {
        font-family: 'Sora', sans-serif;
        font-size: 30px;
        font-weight: 800;
        color: #fff;
        line-height: 1.25;
        margin-bottom: 8px
    }

    .hero-sub {
        font-size: 13px;
        color: rgba(255, 255, 255, .6);
        font-weight: 400;
        margin-bottom: 18px;
        line-height: 1.6
    }

    @media(max-width:680px) {
        .hero-left {
            padding-bottom: 20px
        }

        .hero-cat {
            font-size: 9px;
            padding: 3px 12px;
            gap: 4px;
            margin-bottom: 12px
        }

        .hero-title {
            font-size: 22px;
            margin-bottom: 6px
        }

        .hero-sub {
            font-size: 12px;
            margin-bottom: 14px
        }
    }

    @media(max-width:480px) {
        .hero-title {
            font-size: 20px;
            line-height: 1.3
        }

        .hero-sub {
            font-size: 11px
        }
    }

    .hero-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px
    }

    .stars {
        display: flex;
        gap: 2px
    }

    .stars svg {
        width: 14px;
        height: 14px
    }

    .r-text {
        font-size: 12px;
        color: rgba(255, 255, 255, .65);
        font-weight: 600
    }

    .r-div {
        color: rgba(255, 255, 255, .2)
    }

    .stock-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(22, 163, 74, .2);
        border: 1px solid rgba(22, 163, 74, .4);
        color: #4ade80;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 20px;
        letter-spacing: .04em
    }

    @media(max-width:640px) {
        .hero-rating {
            gap: 8px;
            margin-bottom: 16px
        }

        .stars svg {
            width: 13px;
            height: 13px
        }

        .r-text {
            font-size: 11px
        }

        .stock-pill {
            font-size: 9px;
            padding: 2px 8px
        }
    }

    /* PRICE BLOCK */
    .hero-price-block {
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: var(--r16);
        padding: 18px 20px;
        margin-bottom: 20px;
        backdrop-filter: blur(8px)
    }

    .hero-mrp {
        font-size: 12px;
        color: rgba(255, 255, 255, .45);
        text-decoration: line-through;
        margin-bottom: 6px
    }

    .hero-price-row {
        display: flex;
        align-items: baseline;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 6px
    }

    .hero-price {
        font-family: 'Sora', sans-serif;
        font-size: 38px;
        color: #fff;
        line-height: 1
    }

    .hero-price-calc {
        font-size: 12px;
        color: rgba(255, 255, 255, .5)
    }

    .hero-gst {
        font-size: 11px;
        color: rgba(255, 255, 255, .4);
        margin-bottom: 10px
    }

    .hero-save {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(22, 163, 74, .15);
        border: 1px solid rgba(22, 163, 74, .3);
        color: #4ade80;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px
    }

    @media(max-width:680px) {
        .hero-price-block {
            padding: 14px 16px;
            margin-bottom: 16px;
            border-radius: var(--r12)
        }

        .hero-mrp {
            font-size: 11px;
            margin-bottom: 4px
        }

        .hero-price {
            font-size: 28px
        }

        .hero-price-calc {
            font-size: 11px
        }

        .hero-gst {
            font-size: 10px;
            margin-bottom: 8px
        }

        .hero-save {
            font-size: 10px;
            padding: 3px 10px
        }
    }

    @media(max-width:480px) {
        .hero-price {
            font-size: 24px
        }

        .hero-price-row {
            gap: 8px
        }
    }

    /* QTY + CTA */
    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px
    }

    .qty-box {
        display: flex;
        align-items: center;
        border: 2px solid rgba(255, 255, 255, .3);
        border-radius: var(--r8);
        overflow: hidden;
        background: rgba(255, 255, 255, .08)
    }

    .qty-box button {
        width: 36px;
        height: 42px;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: background .15s;
        -webkit-tap-highlight-color: transparent
    }

    .qty-box button:hover {
        background: rgba(255, 255, 255, .15)
    }

    .qty-box input {
        width: 46px;
        height: 42px;
        text-align: center;
        background: transparent;
        border: none;
        border-left: 1px solid rgba(255, 255, 255, .2);
        border-right: 1px solid rgba(255, 255, 255, .2);
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        outline: none;
        font-family: 'Sora', sans-serif
    }

    .cta-cart {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--green);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        padding: 12px 24px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        transition: background .2s, transform .15s, box-shadow .2s;
        letter-spacing: .04em;
        box-shadow: 0 4px 16px rgba(22, 163, 74, .4);
        -webkit-tap-highlight-color: transparent
    }

    .cta-cart:hover {
        background: #15803d;
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(22, 163, 74, .45)
    }

    .cta-quote {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, .12);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        padding: 12px 22px;
        border-radius: var(--r8);
        border: 2px solid rgba(255, 255, 255, .3);
        cursor: pointer;
        transition: background .2s, border-color .2s;
        letter-spacing: .04em;
        -webkit-tap-highlight-color: transparent
    }

    .cta-quote:hover {
        background: rgba(255, 255, 255, .2);
        border-color: rgba(255, 255, 255, .5)
    }

    @media(max-width:640px) {
        .hero-actions {
            gap: 10px;
            margin-bottom: 12px
        }

        .qty-box button {
            width: 34px;
            height: 40px;
            font-size: 16px
        }

        .qty-box input {
            width: 42px;
            height: 40px;
            font-size: 13px
        }

        .cta-cart {
            font-size: 12px;
            padding: 11px 20px;
            gap: 6px
        }

        .cta-quote {
            font-size: 12px;
            padding: 11px 18px;
            gap: 6px
        }
    }

    @media(max-width:480px) {
        .hero-actions {
            flex-direction: column;
            width: 100%;
            gap: 8px
        }

        .qty-box {
            width: 100%;
            justify-content: center
        }

        .cta-cart,
        .cta-quote {
            width: 100%;
            justify-content: center
        }
    }

    /* HERO LINKS */
    .hero-links {
        display: flex;
        gap: 8px;
        flex-wrap: wrap
    }

    .hero-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 255, 255, .6);
        border: 1px solid rgba(255, 255, 255, .15);
        padding: 6px 14px;
        border-radius: 20px;
        cursor: pointer;
        transition: background .2s, color .2s, border-color .2s;
        background: transparent;
        -webkit-tap-highlight-color: transparent
    }

    .hero-link:hover {
        background: rgba(255, 255, 255, .1);
        color: #fff;
        border-color: rgba(255, 255, 255, .3)
    }

    .hero-link.wa {
        color: #4ade80;
        border-color: rgba(74, 222, 128, .3)
    }

    .hero-link.wa:hover {
        background: rgba(74, 222, 128, .1)
    }

    .hero-link svg {
        width: 13px;
        height: 13px;
        flex-shrink: 0
    }

    @media(max-width:640px) {
        .hero-links {
            gap: 6px
        }

        .hero-link {
            font-size: 10px;
            padding: 5px 12px;
            gap: 5px
        }

        .hero-link svg {
            width: 12px;
            height: 12px
        }
    }

    @media(max-width:480px) {
        .hero-links {
            justify-content: center
        }

        .hero-link {
            flex: 1;
            min-width: calc(50% - 3px);
            justify-content: center
        }
    }

    /* RIGHT IMAGE CARD */
    .hero-right {
        position: relative;
        align-self: end
    }

    .hero-img-card {
        background: #fff;
        border-radius: var(--r20) var(--r20) 0 0;
        padding: 24px 24px 0;
        box-shadow: var(--sh3);
        position: relative;
        overflow: hidden
    }

    .hero-img-wrap {
        position: relative;
        height: 340px;
        cursor: zoom-in;
        overflow: hidden;
        border-radius: var(--r12);
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .hero-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 12px;
        transition: transform .5s cubic-bezier(.25, .46, .45, .94)
    }

    .hero-img-wrap:hover img {
        transform: scale(1.08)
    }

    @media(max-width:860px) {
        .hero-right {
            margin-top: 20px
        }

        .hero-img-card {
            border-radius: var(--r16) var(--r16) 0 0;
            padding: 20px 20px 0
        }

        .hero-img-wrap {
            height: 280px
        }
    }

    @media(max-width:640px) {
        .hero-img-card {
            padding: 16px 16px 0;
            border-radius: var(--r12) var(--r12) 0 0
        }

        .hero-img-wrap {
            height: 240px;
            border-radius: var(--r8)
        }

        .hero-img-wrap img {
            padding: 8px
        }
    }

    @media(max-width:480px) {
        .hero-img-wrap {
            height: 200px
        }
    }

    .img-badge-tl {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 5
    }

    .img-badge-tr {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 5
    }

    .b-stock {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--green);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: .04em
    }

    .b-best {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--red);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: .04em
    }

    .hero-ships {
        position: absolute;
        top: 12px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(22, 163, 74, .1);
        border: 1px solid rgba(22, 163, 74, .25);
        color: var(--green);
        font-size: 10px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        white-space: nowrap;
        z-index: 5
    }

    @media(max-width:640px) {

        .img-badge-tl,
        .img-badge-tr {
            top: 8px
        }

        .img-badge-tl {
            left: 8px
        }

        .img-badge-tr {
            right: 8px
        }

        .b-stock,
        .b-best {
            font-size: 9px;
            padding: 3px 8px
        }

        .hero-ships {
            font-size: 9px;
            padding: 3px 10px;
            top: 8px
        }
    }

    .thumb-strip {
        display: flex;
        gap: 8px;
        padding: 14px 0 20px;
        overflow-x: auto;
        scrollbar-width: none
    }

    .thumb-strip::-webkit-scrollbar {
        display: none
    }

    .thumb-item {
        flex-shrink: 0;
        width: 54px;
        height: 54px;
        border: 2px solid var(--border);
        border-radius: var(--r8);
        overflow: hidden;
        background: #f8fafc;
        cursor: pointer;
        transition: border-color .2s, box-shadow .2s;
        -webkit-tap-highlight-color: transparent
    }

    .thumb-item:hover {
        border-color: var(--navy)
    }

    .thumb-item.on {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(10, 36, 99, .12)
    }

    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 4px
    }

    @media(max-width:640px) {
        .thumb-strip {
            gap: 6px;
            padding: 12px 0 16px
        }

        .thumb-item {
            width: 48px;
            height: 48px;
            border-width: 1.5px
        }

        .thumb-item img {
            padding: 3px
        }
    }


    /* ═══════════════════════════════════════════════════
   FIX 1 — DELIVERY INFO BAR
   Desktop: 4 columns
   ≤700px:  2 columns
   ≤480px:  1 SINGLE COLUMN  ← THIS IS THE KEY FIX
═══════════════════════════════════════════════════ */
    .dbar {
        background: #fff;
        border-bottom: 1px solid var(--border);
        box-shadow: var(--sh1)
    }

    .dbar-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 28px;
        display: grid;
        grid-template-columns: repeat(4, 1fr)
    }

    .dbar-tile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        border-right: 1px solid var(--border)
    }

    .dbar-tile:last-child {
        border-right: none
    }

    .dbar-icon {
        width: 36px;
        height: 36px;
        border-radius: var(--r8);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0
    }

    .dbar-icon svg {
        width: 18px;
        height: 18px
    }

    .dbar-lbl {
        font-size: 10px;
        font-weight: 600;
        color: var(--faint);
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 2px
    }

    .dbar-val {
        font-size: 12px;
        font-weight: 800;
        color: var(--text)
    }

    @media(max-width:900px) {
        .dbar-inner {
            padding: 0 20px
        }

        .dbar-tile {
            padding: 14px 16px;
            gap: 10px
        }

        .dbar-icon {
            width: 32px;
            height: 32px
        }

        .dbar-icon svg {
            width: 16px;
            height: 16px
        }

        .dbar-lbl {
            font-size: 9px
        }

        .dbar-val {
            font-size: 11px
        }
    }

    @media(max-width:700px) {
        .dbar-inner {
            grid-template-columns: repeat(4, 1fr);
            padding: 0 8px;
            overflow-x: auto;
        }

        .dbar-tile {
            padding: 10px 8px;
            gap: 6px;
            border-right: 1px solid var(--border);
            border-bottom: none;
            min-width: 80px;
        }

        .dbar-tile:last-child {
            border-right: none;
        }

        .dbar-lbl {
            font-size: 8px;
        }

        .dbar-val {
            font-size: 10px;
        }

        .dbar-icon {
            width: 26px;
            height: 26px;
        }

        .dbar-icon svg {
            width: 13px;
            height: 13px;
        }
    }

    @media(max-width:480px) {
        .dbar-inner {
            grid-template-columns: repeat(4, 1fr);
            padding: 0 6px;
            overflow-x: auto;
        }

        .dbar-tile {
            padding: 8px 6px;
            gap: 4px;
            border-right: 1px solid var(--border);
            border-bottom: none;
            min-width: 75px;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .dbar-tile:last-child {
            border-right: none;
        }

        .dbar-lbl {
            font-size: 7px;
        }

        .dbar-val {
            font-size: 10px;
        }

        .dbar-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
        }

        .dbar-icon svg {
            width: 12px;
            height: 12px;
        }
    }


    /* ═══════════════════════════════════════════════════
   PAGE BODY — 2-col layout
═══════════════════════════════════════════════════ */
    .page-body {
        max-width: 1320px;
        margin: 0 auto;
        padding: 28px 28px 60px;
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 24px;
        align-items: start;
        /* FIX: prevent any child from blowing out */
        min-width: 0
    }

    @media(max-width:1100px) {
        .page-body {
            grid-template-columns: 1fr 300px;
            padding: 24px 20px 60px;
            gap: 20px
        }
    }

    @media(max-width:860px) {
        .page-body {
            grid-template-columns: 1fr;
            padding: 20px 16px 60px
        }
    }

    @media(max-width:640px) {
        .page-body {
            padding: 16px 12px 60px
        }
    }

    /* FIX: left & right col must never overflow */
    .left-col {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-width: 0;
        width: 100%
    }

    @media(max-width:640px) {
        .left-col {
            gap: 16px
        }
    }


    /* ═══════════════════════════════════════════════════
   OFFERS ROW
═══════════════════════════════════════════════════ */
    .offers-row {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--r16);
        box-shadow: var(--sh1);
        overflow: hidden;
        width: 100%
    }

    .offers-row-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 18px;
        border-bottom: 1px solid var(--border);
        background: #fffbeb
    }

    .offers-row-title {
        font-size: 11px;
        font-weight: 800;
        color: #78350f;
        text-transform: uppercase;
        letter-spacing: .08em;
        display: flex;
        align-items: center;
        gap: 7px
    }

    .offers-row-title svg {
        width: 13px;
        height: 13px;
        color: var(--orange)
    }

    .see-all {
        font-size: 11px;
        font-weight: 700;
        color: var(--navy);
        border: 1px solid rgba(10, 36, 99, .2);
        padding: 3px 12px;
        border-radius: 20px;
        background: transparent;
        cursor: pointer;
        transition: background .2s, color .2s;
        flex-shrink: 0
    }

    .see-all:hover {
        background: var(--navy);
        color: #fff
    }

    @media(max-width:640px) {
        .offers-row {
            border-radius: var(--r12)
        }

        .offers-row-head {
            padding: 10px 14px
        }

        .offers-row-title {
            font-size: 10px;
            gap: 6px
        }

        .offers-row-title svg {
            width: 12px;
            height: 12px
        }

        .see-all {
            font-size: 10px;
            padding: 3px 10px
        }
    }

    .offers-scroll {
        display: flex;
        gap: 12px;
        padding: 14px 18px;
        overflow-x: auto;
        scrollbar-width: none
    }

    .offers-scroll::-webkit-scrollbar {
        display: none
    }

    .offer-chip {
        flex-shrink: 0;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: var(--r12);
        padding: 10px 14px;
        min-width: 220px;
        max-width: 280px
    }

    .offer-chip-icon {
        font-size: 18px;
        line-height: 1;
        flex-shrink: 0;
        margin-top: 1px
    }

    .offer-chip-text {
        font-size: 12px;
        color: #44403c;
        line-height: 1.5;
        font-weight: 500
    }

    .offer-chip-note {
        font-size: 10px;
        color: #a16207;
        margin-top: 3px;
        font-weight: 600
    }

    @media(max-width:640px) {
        .offers-scroll {
            gap: 10px;
            padding: 12px 14px
        }

        .offer-chip {
            gap: 6px;
            padding: 8px 12px;
            min-width: 200px;
            border-radius: var(--r8)
        }

        .offer-chip-icon {
            font-size: 16px
        }

        .offer-chip-text {
            font-size: 11px
        }

        .offer-chip-note {
            font-size: 9px
        }
    }


    /* ═══════════════════════════════════════════════════
   BLOCK (Specs / Tabs / Related)
   FIX: min-width:0 prevents overflow
═══════════════════════════════════════════════════ */
    .block {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--r16);
        box-shadow: var(--sh1);
        overflow: hidden;
        min-width: 0;
        width: 100%
    }

    .block-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 20px;
        border-bottom: 1px solid var(--border);
        background: #f8fafc
    }

    .block-head-title {
        font-size: 12px;
        font-weight: 800;
        color: var(--text);
        text-transform: uppercase;
        letter-spacing: .07em;
        display: flex;
        align-items: center;
        gap: 8px
    }

    .block-head-title svg {
        width: 15px;
        height: 15px;
        color: var(--navy)
    }

    .block-body {
        padding: 0
    }

    @media(max-width:640px) {
        .block {
            border-radius: var(--r12)
        }

        .block-head {
            padding: 12px 16px
        }

        .block-head-title {
            font-size: 11px;
            gap: 6px
        }

        .block-head-title svg {
            width: 14px;
            height: 14px
        }
    }

    /* SPEC ROWS */
    .spec-row {
        display: grid;
        grid-template-columns: 180px 1fr;
        border-bottom: 1px solid #f1f5f9
    }

    .spec-row:last-child {
        border-bottom: none
    }

    .spec-row:nth-child(even) {
        background: #fafbfe
    }

    .sk {
        padding: 11px 18px;
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .05em;
        border-right: 1px solid #f1f5f9
    }

    .sv {
        padding: 11px 18px;
        font-size: 13px;
        font-weight: 600;
        color: var(--text)
    }

    .spec-2col {
        display: grid;
        grid-template-columns: 1fr 1fr
    }

    .spec-2col .spec-row:nth-child(n) {
        border-right: 1px solid #f1f5f9
    }

    .spec-2col .spec-row:nth-child(2n) {
        border-right: none
    }

    @media(max-width:900px) {
        .spec-row {
            grid-template-columns: 140px 1fr
        }

        .sk {
            padding: 10px 14px;
            font-size: 10px
        }

        .sv {
            padding: 10px 14px;
            font-size: 12px
        }
    }

    @media(max-width:620px) {
        .spec-2col {
            grid-template-columns: 1fr
        }

        .spec-row {
            grid-template-columns: 120px 1fr
        }

        .sk {
            padding: 9px 12px
        }

        .sv {
            padding: 9px 12px
        }

        .spec-2col .spec-row:nth-child(n) {
            border-right: none
        }
    }

    @media(max-width:480px) {
        .spec-row {
            grid-template-columns: 100px 1fr
        }

        .sk {
            font-size: 9px;
            padding: 8px 10px
        }

        .sv {
            font-size: 11px;
            padding: 8px 10px
        }
    }

    /* TABS */
    .tabs-bar {
        display: flex;
        border-bottom: 1px solid var(--border);
        background: #f8fafc;
        overflow-x: auto;
        scrollbar-width: none
    }

    .tabs-bar::-webkit-scrollbar {
        display: none
    }

    .tab-btn {
        padding: 13px 22px;
        font-size: 11px;
        font-weight: 800;
        color: var(--muted);
        border: none;
        background: transparent;
        cursor: pointer;
        white-space: nowrap;
        border-bottom: 3px solid transparent;
        letter-spacing: .07em;
        text-transform: uppercase;
        transition: color .2s, background .2s;
        -webkit-tap-highlight-color: transparent
    }

    .tab-btn:hover {
        color: var(--text);
        background: #fff
    }

    .tab-btn.on {
        color: var(--red);
        border-bottom-color: var(--red);
        background: #fff
    }

    @media(max-width:640px) {
        .tab-btn {
            padding: 11px 18px;
            font-size: 10px
        }
    }

    .tab-pane {
        display: none;
        padding: 24px
    }

    .tab-pane.on {
        display: block
    }

    @media(max-width:640px) {
        .tab-pane {
            padding: 16px
        }
    }

    .desc-title {
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border)
    }

    .desc-text {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.85;
        margin-bottom: 18px
    }

    @media(max-width:640px) {
        .desc-title {
            font-size: 18px;
            margin-bottom: 10px;
            padding-bottom: 10px
        }

        .desc-text {
            font-size: 12px;
            line-height: 1.75;
            margin-bottom: 14px
        }
    }

    .why-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px
    }

    .why-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 9px 12px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: var(--r8);
        font-size: 12px;
        color: var(--text);
        font-weight: 500;
        line-height: 1.5
    }

    .why-item svg {
        width: 14px;
        height: 14px;
        color: var(--green);
        flex-shrink: 0;
        margin-top: 1px
    }

    @media(max-width:580px) {
        .why-grid {
            grid-template-columns: 1fr
        }
    }

    @media(max-width:640px) {
        .why-item {
            padding: 8px 10px;
            gap: 6px;
            font-size: 11px
        }

        .why-item svg {
            width: 13px;
            height: 13px
        }
    }

    .feat-apps {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px
    }

    .fa-col-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 2px solid;
        display: flex;
        align-items: center;
        gap: 7px
    }

    .fa-col-title.blue {
        color: var(--navy);
        border-color: var(--navy)
    }

    .fa-col-title.green {
        color: var(--green);
        border-color: var(--green)
    }

    .fa-col-title svg {
        width: 13px;
        height: 13px
    }

    .fa-item {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        padding: 8px 0;
        font-size: 13px;
        color: var(--text);
        border-bottom: 1px solid #f1f5f9;
        line-height: 1.5
    }

    .fa-item:last-child {
        border-bottom: none
    }

    .fa-item svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
        margin-top: 2px
    }

    @media(max-width:580px) {
        .feat-apps {
            grid-template-columns: 1fr;
            gap: 20px
        }
    }

    @media(max-width:640px) {
        .feat-apps {
            gap: 16px
        }

        .fa-col-title {
            font-size: 10px;
            margin-bottom: 10px;
            padding-bottom: 6px;
            gap: 6px
        }

        .fa-col-title svg {
            width: 12px;
            height: 12px
        }

        .fa-item {
            font-size: 12px;
            gap: 7px;
            padding: 6px 0
        }

        .fa-item svg {
            width: 13px;
            height: 13px
        }
    }


    /* ═══════════════════════════════════════════════════
   FIX 3 — RELATED PRODUCTS GRID
   Was cutting off on right side on mobile
═══════════════════════════════════════════════════ */
    .related-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        padding: 20px;
        /* FIX: ensures grid never overflows block */
        width: 100%;
        box-sizing: border-box
    }

    .r-card {
        border: 1.5px solid var(--border);
        border-radius: var(--r12);
        overflow: hidden;
        cursor: pointer;
        transition: border-color .2s, box-shadow .2s, transform .2s;
        background: #fff;
        min-width: 0;
        /* FIX */
        width: 100%;
        /* FIX */
        -webkit-tap-highlight-color: transparent
    }

    .r-card:hover {
        border-color: var(--navy);
        box-shadow: 0 6px 28px rgba(10, 36, 99, .12);
        transform: translateY(-3px)
    }

    .r-card-img {
        width: 100%;
        height: 120px;
        object-fit: contain;
        background: #f8fafc;
        padding: 12px;
        display: block
    }

    .r-card-body {
        padding: 10px 12px 12px
    }

    .r-card-name {
        font-size: 13px;
        font-weight: 800;
        color: var(--navy);
        line-height: 1.4;
        margin-bottom: 4px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 28px;
        word-break: break-word
            /* FIX: long product names won't overflow */
    }

    .r-card-price {
        font-family: 'Sora', sans-serif;
        font-size: 15px;
        font-weight: 600;
        color: var(--red);
        margin-bottom: 8px;
        word-break: break-word
            /* FIX: long price ranges */
    }

    .r-card-btn {
        width: 100%;
        background: var(--navy);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 7px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        letter-spacing: .04em;
        transition: background .2s;
        -webkit-tap-highlight-color: transparent
    }

    .r-card-btn:hover {
        background: var(--navy-dark)
    }

    @media(max-width:900px) {
        .related-grid {
            padding: 16px;
            gap: 12px
        }

        .r-card-img {
            height: 100px;
            padding: 10px
        }

        .r-card-name {
            font-size: 12px;
            min-height: 26px
        }

        .r-card-price {
            font-size: 14px font-weight: 600;
        }
    }

    @media(max-width:620px) {

        /* 2 columns on small screens */
        .related-grid {
            grid-template-columns: repeat(2, 1fr)
        }
    }

    @media(max-width:480px) {
        .related-grid {
            padding: 12px;
            gap: 10px
        }

        .r-card-img {
            height: 90px;
            padding: 8px
        }

        .r-card-body {
            padding: 8px 10px 10px
        }

        .r-card-name {
            font-size: 12px;
            min-height: 24px
        }

        .r-card-price {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px
        }

        .r-card-btn {
            font-size: 9px;
            padding: 6px
        }
    }


    /* ═══════════════════════════════════════════════════
   RIGHT SIDEBAR
   FIX: sticky works, no overflow
═══════════════════════════════════════════════════ */
    .right-col {
        display: flex;
        flex-direction: column;
        gap: 18px;
        position: sticky;
        top: 80px;
        min-width: 0;
        /* FIX */
        width: 100%
            /* FIX */
    }

    @media(max-width:860px) {
        .right-col {
            position: static;
            gap: 16px
        }
    }


    /* PRICE CARD */
    .pcard {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--r16);
        box-shadow: var(--sh2);
        overflow: hidden;
        width: 100%
            /* FIX */
    }

    .pcard-top {
        background: linear-gradient(135deg, var(--navy), #1a3a9a);
        padding: 18px 20px
    }

    .pcard-mrp {
        font-size: 11px;
        color: rgba(255, 255, 255, .45);
        text-decoration: line-through;
        margin-bottom: 4px
    }

    .pcard-price {
        font-family: 'Sora', sans-serif;
        font-size: 32px;
        font-weight: 600;
        color: #fff;
        line-height: 1;
        margin-bottom: 4px
    }

    .pcard-gst {
        font-size: 11px;
        color: rgba(255, 255, 255, .5)
    }

    .pcard-save {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(74, 222, 128, .15);
        border: 1px solid rgba(74, 222, 128, .3);
        color: #4ade80;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        margin-top: 8px
    }

    @media(max-width:860px) {
        .pcard {
            border-radius: var(--r12)
        }

        .pcard-top {
            padding: 16px 18px
        }

        .pcard-price {
            font-size: 28px font-weight: 600;
        }
    }

    @media(max-width:640px) {
        .pcard-top {
            padding: 14px 16px
        }

        .pcard-mrp {
            font-size: 10px
        }

        .pcard-price {
            font-size: 24px font-weight: 600;
        }

        .pcard-gst {
            font-size: 10px
        }

        .pcard-save {
            font-size: 10px;
            padding: 3px 10px
        }
    }

    .pcard-body {
        padding: 16px 18px
    }

    .pcard-qty-lbl {
        font-size: 10px;
        font-weight: 800;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .07em;
        margin-bottom: 8px
    }

    /* ═══════════════════════════════════════════════════
   FIX 3 — PCARD QTY BOX overflow
   The qty-box was spilling outside the card on mobile
═══════════════════════════════════════════════════ */
    .pcard-qty {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        flex-wrap: wrap
            /* FIX */
    }

    .pcard-qty .qty-box {
        border: 2px solid var(--navy);
        background: #fff;
        flex-shrink: 0
            /* don't squash */
    }

    .pcard-qty .qty-box button {
        color: var(--navy);
        font-size: 16px;
        width: 32px;
        height: 36px
    }

    .pcard-qty .qty-box input {
        color: var(--navy);
        font-size: 13px;
        width: 38px;
        height: 36px;
        border-left: 2px solid var(--navy);
        border-right: 2px solid var(--navy)
    }

    .pcard-min {
        font-size: 11px;
        color: var(--faint)
    }

    @media(max-width:640px) {
        .pcard-body {
            padding: 14px 16px
        }

        .pcard-qty-lbl {
            font-size: 9px;
            margin-bottom: 6px
        }

        .pcard-qty {
            gap: 8px;
            margin-bottom: 12px
        }

        .pcard-min {
            font-size: 10px
        }
    }

    .pcard-btn-cart {
        width: 100%;
        background: var(--green);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        padding: 13px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 9px;
        transition: background .2s, box-shadow .2s;
        letter-spacing: .04em;
        box-shadow: 0 4px 14px rgba(22, 163, 74, .25);
        -webkit-tap-highlight-color: transparent
    }

    .pcard-btn-cart:hover {
        background: #15803d;
        box-shadow: 0 6px 20px rgba(22, 163, 74, .35)
    }

    .pcard-btn-quote {
        width: 100%;
        background: var(--navy);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        padding: 13px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 16px;
        transition: background .2s;
        -webkit-tap-highlight-color: transparent
    }

    .pcard-btn-quote:hover {
        background: var(--navy-dark)
    }

    @media(max-width:640px) {

        .pcard-btn-cart,
        .pcard-btn-quote {
            font-size: 12px;
            padding: 12px;
            gap: 6px
        }
    }

    .pcard-links {
        display: flex;
        flex-direction: column;
        gap: 7px
    }

    .pcard-link {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 11px;
        font-weight: 700;
        padding: 9px 12px;
        border-radius: var(--r8);
        border: 1px solid var(--border);
        background: #f8fafc;
        cursor: pointer;
        color: var(--muted);
        transition: all .2s;
        text-align: left;
        -webkit-tap-highlight-color: transparent
    }

    .pcard-link:hover {
        border-color: #94a3b8;
        background: #fff;
        color: var(--text)
    }

    .pcard-link.wa {
        color: var(--green);
        border-color: rgba(22, 163, 74, .25);
        background: #f0fdf4
    }

    .pcard-link.wa:hover {
        background: #dcfce7
    }

    .pcard-link svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0
    }

    @media(max-width:640px) {
        .pcard-links {
            gap: 6px
        }

        .pcard-link {
            font-size: 10px;
            padding: 8px 10px;
            gap: 7px
        }

        .pcard-link svg {
            width: 13px;
            height: 13px
        }
    }

    /* META TILES */
    .meta-tiles {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px
    }

    .meta-tile {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--r12);
        padding: 12px;
        text-align: center
    }

    .mt-lbl {
        font-size: 10px;
        font-weight: 600;
        color: var(--faint);
        margin-bottom: 4px
    }

    .mt-val {
        font-size: 12px;
        font-weight: 800;
        color: var(--text)
    }

    @media(max-width:640px) {
        .meta-tiles {
            gap: 6px
        }

        .meta-tile {
            padding: 10px;
            border-radius: var(--r8)
        }

        .mt-lbl {
            font-size: 9px;
            margin-bottom: 3px
        }

        .mt-val {
            font-size: 11px
        }
    }

    /* ═══════════════════════════════════════════
   MOBILE META TILES — single column stack
═══════════════════════════════════════════ */
    @media(max-width:860px) {
        .meta-tiles {
            grid-template-columns: 1fr;
            gap: 0;
            border: 1px solid var(--border);
            border-radius: var(--r12);
            overflow: hidden
        }

        .meta-tile {
            display: flex;
            align-items: center;
            gap: 12px;
            text-align: left;
            padding: 13px 16px;
            border-radius: 0;
            border-bottom: 1px solid var(--border);
            border: none;
            border-bottom: 1px solid var(--border)
        }

        .meta-tile:last-child {
            border-bottom: none
        }

        .mt-lbl {
            font-size: 10px;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: .06em
        }

        .mt-val {
            font-size: 13px
        }
    }

    /* TRUST NUMBERS */
    .trust-nums {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--r16);
        padding: 16px 18px;
        box-shadow: var(--sh1)
    }

    .tn-title {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #1A1E2E;
        margin-bottom: 12px
    }

    .tn-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px
    }

    .tn-item {
        text-align: center;
        padding: 12px 6px;
        border-radius: var(--r8);
        border: 1px solid
    }

    .tn-item.g {
        background: #f0fdf4;
        border-color: #bbf7d0
    }

    .tn-item.b {
        background: #eff6ff;
        border-color: #bfdbfe
    }

    .tn-item.p {
        background: #faf5ff;
        border-color: #e9d5ff
    }

    .tn-val {
        font-family: 'Sora', sans-serif;
        font-size: 20px;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 3px;
    }

    .tn-item.g .tn-val {
        color: var(--green)
    }

    .tn-item.b .tn-val {
        color: #2563eb
    }

    .tn-item.p .tn-val {
        color: #9333ea
    }

    .tn-lbl {
        font-size: 10px;
        font-weight: 600;
        color: var(--muted)
    }

    @media(max-width:640px) {
        .trust-nums {
            padding: 14px 16px;
            border-radius: var(--r12)
        }

        .tn-title {
            font-size: 12px;
            margin-bottom: 10px
        }

        .tn-grid {
            gap: 6px
        }

        .tn-item {
            padding: 10px 4px
        }

        .tn-val {
            font-size: 18px
        }

        .tn-lbl {
            font-size: 9px
        }
    }

    /* DESCRIPTION SIDEBAR CARD */
    .desc-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--r16);
        padding: 18px;
        box-shadow: var(--sh1)
    }

    .desc-card-title {

        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #232736;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .desc-card-title svg {
        width: 20px;
        height: 20px;
        color: var(--navy)
    }

    .desc-card-text {
        font-size: 12px;
        color: var(--muted);
        line-height: 1.75
    }

    @media(max-width:640px) {
        .desc-card {
            padding: 14px 16px;
            border-radius: var(--r12)
        }

        .desc-card-title {
            font-size: 10px;
            margin-bottom: 8px;
            gap: 6px
        }

        .desc-card-title svg {
            width: 12px;
            height: 12px
        }

        .desc-card-text {
            font-size: 11px
        }
    }

    /* TRUST BADGES ROW */
    .tbadges {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px
    }

    .tbadge {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--r12);
        padding: 10px 6px;
        text-align: center
    }

    .tbadge svg {
        width: 18px;
        height: 18px;
        margin: 0 auto 5px;
        display: block;
        color: var(--navy)
    }

    .tbadge p {
        font-size: 9px;
        font-weight: 700;
        color: var(--muted);
        line-height: 1.3;
        text-align: center;
    }

    @media(max-width:640px) {
        .tbadges {
            gap: 6px
        }

        .tbadge {
            padding: 8px 4px;
            border-radius: var(--r8)
        }

        .tbadge svg {
            width: 16px;
            height: 16px;
            margin-bottom: 4px
        }

        .tbadge p {
            font-size: 8px
        }
    }


    /* ═══════════════════════════════════
   TRUST STRIP
═══════════════════════════════════ */
    .tstrip {
        background: var(--navy);
        margin: 0
    }

    .tstrip-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 28px;
        display: flex;
        overflow-x: auto;
        scrollbar-width: none
    }

    .tstrip-inner::-webkit-scrollbar {
        display: none
    }

    .ts-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 28px;
        flex: 1;
        min-width: 160px;
        border-right: 1px solid rgba(255, 255, 255, .1)
    }

    .ts-item:last-child {
        border-right: none
    }

    .ts-item svg {
        width: 22px;
        height: 22px;
        color: var(--orange);
        flex-shrink: 0
    }

    .ts-text {
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 255, 255, .8);
        line-height: 1.4
    }

    @media(max-width:900px) {
        .tstrip-inner {
            padding: 0 20px
        }

        .ts-item {
            padding: 14px 20px;
            gap: 8px;
            min-width: 140px
        }

        .ts-item svg {
            width: 20px;
            height: 20px
        }

        .ts-text {
            font-size: 10px
        }
    }

    @media(max-width:640px) {
        .tstrip-inner {
            padding: 0 16px
        }

        .ts-item {
            padding: 12px 16px;
            min-width: 130px
        }

        .ts-item svg {
            width: 18px;
            height: 18px
        }

        .ts-text {
            font-size: 9px
        }
    }


    /* ═══════════════════════════════════════════════════
   FIX 2 — MOBILE BOTTOM BAR + FLOATING CART
   Arrow was hiding behind cart button — fixed z-index
   and bottom spacing
═══════════════════════════════════════════════════ */
    #mobileBar {
        display: none;
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 60;
        background: #fff;
        border-top: 1px solid var(--border);
        padding: 10px 16px;
        gap: 10px;
        box-shadow: 0 -4px 24px rgba(0, 0, 0, .1)
    }

    @media(max-width:1023px) {
        #mobileBar {
            display: flex
        }

        body {
            padding-bottom: 80px
        }
    }

    @media(max-width:640px) {
        #mobileBar {
            padding: 8px 12px;
            gap: 8px
        }
    }

    .mob-cart {
        flex: 1;
        background: var(--green);
        color: #fff;
        font-weight: 800;
        font-size: 13px;
        padding: 12px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        letter-spacing: .04em;
        -webkit-tap-highlight-color: transparent;
        min-height: 48px
    }

    .mob-quote {
        flex: 1;
        background: var(--navy);
        color: #fff;
        font-weight: 800;
        font-size: 13px;
        padding: 12px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        letter-spacing: .04em;
        -webkit-tap-highlight-color: transparent;
        min-height: 48px
    }

    @media(max-width:640px) {

        .mob-cart,
        .mob-quote {
            font-size: 12px;
            padding: 10px;
            gap: 6px
        }

        .mob-cart svg,
        .mob-quote svg {
            width: 16px;
            height: 16px
        }
    }

    /* FLOATING CART BUTTON
   FIX: was overlapping arrow button below it.
   Raised bottom so it sits ABOVE the mobile bar (80px)
   + extra 12px breathing room = 92px */
    #floatingCartBtn {
        position: fixed;
        bottom: 92px;
        /* FIX: was 90px, now clears the bar cleanly */
        right: 20px;
        z-index: 55;
        /* FIX: below modals (100+) but above page content */
        display: flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--red), #c62828);
        color: #fff;
        font-weight: 800;
        padding: 11px 18px;
        border-radius: 50px;
        box-shadow: 0 8px 32px rgba(183, 28, 28, .35);
        transition: transform .2s;
        border: none;
        cursor: pointer;
        font-size: 13px;
        font-family: 'Sora', sans-serif;
        -webkit-tap-highlight-color: transparent
    }

    @media(min-width:1024px) {
        #floatingCartBtn {
            display: none !important
        }
    }

    #floatingCartBtn:hover {
        transform: scale(1.06)
    }

    .cart-badge {
        background: #fff;
        color: var(--red);
        border-radius: 50px;
        padding: 2px 8px;
        font-size: 11px;
        font-weight: 900
    }

    p {
        text-align: justify;
    }

    @media(max-width:640px) {
        #floatingCartBtn {
            bottom: 80px;
            /* FIX: matches exact mobile bar height */
            right: 16px;
            padding: 10px 16px;
            gap: 6px;
            font-size: 12px
        }

        .cart-badge {
            padding: 2px 7px;
            font-size: 10px
        }
    }

    /* HEADER CART BTN */
    #headerCartBtn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--red), #c62828);
        color: #fff;
        font-weight: 800;
        padding: 10px 18px;
        border-radius: 50px;
        box-shadow: 0 4px 16px rgba(183, 28, 28, .3);
        border: none;
        cursor: pointer;
        font-size: 13px;
        white-space: nowrap;
        transition: transform .15s;
        font-family: 'Sora', sans-serif;
        -webkit-tap-highlight-color: transparent
    }

    #headerCartBtn:hover {
        transform: scale(1.04)
    }

    .hcart-badge {
        background: #fff;
        color: var(--red);
        border-radius: 50px;
        padding: 1px 8px;
        font-size: 11px;
        font-weight: 900
    }

    @media(max-width:640px) {
        #headerCartBtn {
            padding: 8px 14px;
            gap: 6px;
            font-size: 12px
        }

        #headerCartBtn svg {
            width: 14px;
            height: 14px
        }

        .hcart-badge {
            padding: 1px 7px;
            font-size: 10px
        }
    }


    /* ═══════════════════════════════════
   MODALS
═══════════════════════════════════ */
    #checkoutModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .6);
        backdrop-filter: blur(6px);
        z-index: 100;
        overflow-y: auto
    }

    #checkoutModal.open {
        display: flex;
        align-items: flex-end;
        justify-content: center
    }

    @media(min-width:640px) {
        #checkoutModal.open {
            align-items: center
        }
    }

    .modal-sheet {
        background: #fff;
        width: 100%;
        max-width: 600px;
        border-radius: var(--r24) var(--r24) 0 0;
        overflow: hidden;
        max-height: 92vh;
        display: flex;
        flex-direction: column
    }

    @media(min-width:640px) {
        .modal-sheet {
            border-radius: var(--r20);
            max-height: 85vh;
            margin: 16px
        }
    }

    .modal-hdr {
        background: linear-gradient(135deg, var(--navy), #1a3a7a);
        color: #fff;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0
    }

    .modal-hdr h2 {
        font-size: 18px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 10px
    }

    .modal-x {
        background: rgba(255, 255, 255, .15);
        border: none;
        color: #fff;
        width: 34px;
        height: 34px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .2s;
        -webkit-tap-highlight-color: transparent;
        flex-shrink: 0
    }

    .modal-x:hover {
        background: rgba(255, 255, 255, .25)
    }

    @media(max-width:640px) {
        .modal-sheet {
            border-radius: var(--r20) var(--r20) 0 0
        }

        .modal-hdr {
            padding: 16px 20px
        }

        .modal-hdr h2 {
            font-size: 16px;
            gap: 8px
        }

        .modal-hdr h2 svg {
            width: 18px;
            height: 18px
        }

        .modal-x {
            width: 32px;
            height: 32px;
            font-size: 16px
        }
    }

    .cart-items-area {
        flex: 1;
        overflow-y: auto;
        padding: 16px
    }

    @media(max-width:640px) {
        .cart-items-area {
            padding: 12px
        }
    }

    .citem {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        background: #f8fafc;
        border: 1.5px solid var(--border);
        border-radius: var(--r12);
        padding: 14px;
        margin-bottom: 10px
    }

    .citem-img {
        width: 68px;
        height: 68px;
        min-width: 68px;
        object-fit: contain;
        background: #fff;
        border-radius: var(--r8);
        padding: 6px;
        border: 1px solid var(--border)
    }

    .citem-name {
        font-weight: 800;
        font-size: 13px;
        color: var(--navy);
        line-height: 1.4;
        margin-bottom: 3px
    }

    .citem-sub {
        font-size: 11px;
        color: var(--faint);
        margin-bottom: 5px
    }

    .citem-unit {
        font-size: 11px;
        color: var(--faint)
    }

    .citem-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        gap: 8px;
        flex-shrink: 0;
        min-width: 80px
    }

    .citem-price {
        font-family: 'Sora', sans-serif;
        font-size: 18px;
        color: var(--red)
    }

    .citem-rm {
        background: none;
        border: 1px solid #fca5a5;
        color: #dc2626;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 6px;
        cursor: pointer;
        transition: background .15s, color .15s;
        -webkit-tap-highlight-color: transparent
    }

    .citem-rm:hover {
        background: #dc2626;
        color: #fff
    }

    @media(max-width:640px) {
        .citem {
            gap: 10px;
            padding: 12px;
            border-radius: var(--r8)
        }

        .citem-img {
            width: 60px;
            height: 60px;
            min-width: 60px
        }

        .citem-name {
            font-size: 12px
        }

        .citem-sub {
            font-size: 10px;
            margin-bottom: 4px
        }

        .citem-unit {
            font-size: 10px
        }

        .citem-right {
            min-width: 70px;
            gap: 6px
        }

        .citem-price {
            font-size: 16px
        }

        .citem-rm {
            font-size: 9px;
            padding: 3px 8px
        }
    }

    .empty-cart {
        padding: 48px 24px;
        text-align: center;
        color: var(--faint)
    }

    @media(max-width:640px) {
        .empty-cart {
            padding: 36px 20px
        }

        .empty-cart svg {
            width: 56px !important;
            height: 56px !important;
            margin-bottom: 12px !important
        }

        .empty-cart p:first-of-type {
            font-size: 16px
        }

        .empty-cart p:last-of-type {
            font-size: 12px
        }
    }

    .cart-sum {
        border-top: 1px solid var(--border);
        padding: 16px 20px;
        background: linear-gradient(135deg, #f8fafc, #eff3ff);
        flex-shrink: 0
    }

    .cart-btns {
        display: flex;
        gap: 10px;
        margin-top: 14px
    }

    .btn-wa {
        flex: 1;
        background: linear-gradient(135deg, var(--green), #15803d);
        color: #fff;
        font-weight: 800;
        font-size: 14px;
        padding: 14px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        letter-spacing: .03em;
        -webkit-tap-highlight-color: transparent
    }

    .btn-clr {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: #fff;
        font-weight: 800;
        font-size: 13px;
        padding: 14px 18px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        -webkit-tap-highlight-color: transparent
    }

    @media(max-width:640px) {
        .cart-sum {
            padding: 14px 16px
        }

        .cart-btns {
            gap: 8px;
            margin-top: 12px
        }

        .btn-wa {
            font-size: 13px;
            padding: 12px;
            gap: 6px
        }

        .btn-clr {
            font-size: 12px;
            padding: 12px 16px
        }

        .btn-wa svg,
        .btn-clr svg {
            width: 16px;
            height: 16px
        }
    }

    .drag-handle {
        width: 40px;
        height: 4px;
        background: #cbd5e1;
        border-radius: 2px;
        margin: 10px auto 0
    }

    @media(min-width:640px) {
        .drag-handle {
            display: none
        }
    }

    /* OFFERS MODAL */
    #offersModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .55);
        backdrop-filter: blur(6px);
        z-index: 150;
        align-items: center;
        justify-content: center;
        padding: 16px
    }

    #offersModal.open {
        display: flex
    }

    .om-sheet {
        background: #fff;
        border-radius: var(--r20);
        max-width: 460px;
        width: 100%;
        overflow: hidden;
        box-shadow: var(--sh3)
    }

    .om-hdr {
        background: linear-gradient(135deg, var(--orange), #ea580c);
        color: #fff;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between
    }

    .om-hdr h3 {
        font-weight: 800;
        font-size: 15px
    }

    .om-x {
        width: 28px;
        height: 28px;
        background: rgba(255, 255, 255, .2);
        border: none;
        color: #fff;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        -webkit-tap-highlight-color: transparent
    }

    @media(max-width:640px) {
        #offersModal {
            padding: 12px
        }

        .om-sheet {
            border-radius: var(--r16)
        }

        .om-hdr {
            padding: 16px 18px
        }

        .om-hdr h3 {
            font-size: 14px
        }

        .om-x {
            width: 26px;
            height: 26px;
            font-size: 13px
        }
    }

    .om-item {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: var(--r12);
        padding: 12px 14px;
        margin-bottom: 10px
    }

    .om-item:last-child {
        margin-bottom: 0
    }

    .om-title {
        font-weight: 800;
        font-size: 13px;
        color: #1c1917;
        margin-bottom: 4px
    }

    .om-note {
        font-size: 11px;
        color: #78716c
    }

    @media(max-width:640px) {
        .om-item {
            padding: 10px 12px;
            border-radius: var(--r8);
            margin-bottom: 8px
        }

        .om-title {
            font-size: 12px;
            margin-bottom: 3px
        }

        .om-note {
            font-size: 10px
        }
    }

    /* LIGHTBOX */
    #imageLightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .93);
        backdrop-filter: blur(10px);
        z-index: 300;
        align-items: center;
        justify-content: center
    }

    #imageLightbox.open {
        display: flex
    }

    #lightboxImg {
        max-width: 82vw;
        max-height: 82vh;
        object-fit: contain;
        border-radius: var(--r12);
        background: #fff;
        padding: 20px
    }

    .lb-x {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .2);
        color: #fff;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: background .2s;
        -webkit-tap-highlight-color: transparent
    }

    .lb-x:hover {
        background: rgba(255, 255, 255, .22)
    }

    .lb-nav {
        position: fixed;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .2);
        color: #fff;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 22px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        transition: background .2s;
        -webkit-tap-highlight-color: transparent
    }

    .lb-nav:hover {
        background: rgba(255, 255, 255, .22)
    }

    #lbPrev {
        left: 20px
    }

    #lbNext {
        right: 20px
    }

    .lb-ctr {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(255, 255, 255, .12);
        color: #fff;
        padding: 6px 18px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 700;
        border: 1px solid rgba(255, 255, 255, .2)
    }

    @media(max-width:640px) {
        #lightboxImg {
            max-width: 90vw;
            max-height: 70vh;
            padding: 12px;
            border-radius: var(--r8)
        }

        .lb-x {
            top: 12px;
            right: 12px;
            width: 40px;
            height: 40px;
            font-size: 18px
        }

        .lb-nav {
            width: 44px;
            height: 44px;
            font-size: 20px
        }

        #lbPrev {
            left: 12px
        }

        #lbNext {
            right: 12px
        }

        .lb-ctr {
            bottom: 16px;
            padding: 5px 14px;
            font-size: 12px
        }
    }

    /* MINI MODAL */
    #miniDetailModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .6);
        backdrop-filter: blur(6px);
        z-index: 200;
        align-items: center;
        justify-content: center;
        padding: 16px
    }

    @media(max-width:860px) {
        .mob-about {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--r12);
            margin: 12px 12px 0;
            padding: 14px 16px;
            box-shadow: var(--sh1);
            border-bottom: 1px solid var(--border);
        }

        .mob-about-title {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .mob-about-text {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.75;
            text-align: left !important;
        }
    }

    #miniDetailModal.open {
        display: flex
    }

    .mm-sheet {
        background: #fff;
        border-radius: var(--r20);
        max-width: 520px;
        width: 100%;
        max-height: 88vh;
        overflow-y: auto;
        box-shadow: var(--sh3)
    }

    @media(max-width:640px) {
        #miniDetailModal {
            padding: 12px
        }

        .mm-sheet {
            border-radius: var(--r16);
            max-height: 90vh
        }
    }

    /* SUCCESS NOTIF */
    #successNotif {
        position: fixed;
        top: 80px;
        right: 16px;
        background: var(--green);
        color: #fff;
        padding: 14px 20px;
        border-radius: var(--r12);
        box-shadow: var(--sh3);
        z-index: 200;
        transform: translateX(calc(100% + 32px));
        opacity: 0;
        transition: transform .35s cubic-bezier(.34, 1.56, .64, 1), opacity .35s;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        font-size: 14px;
        letter-spacing: .02em
    }

    #successNotif.show {
        transform: translateX(0);
        opacity: 1
    }

    @media(max-width:640px) {
        #successNotif {
            top: 70px;
            right: 12px;
            left: 12px;
            padding: 12px 16px;
            font-size: 13px;
            gap: 8px;
            border-radius: var(--r8)
        }

        #successNotif svg {
            width: 16px !important;
            height: 16px !important
        }
    }

    /* ANIMATIONS */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    .au {
        animation: fadeUp .45s ease both
    }

    .au1 {
        animation-delay: .05s
    }

    .au2 {
        animation-delay: .1s
    }

    .au3 {
        animation-delay: .15s
    }

    .au4 {
        animation-delay: .2s
    }

    /* Touch improvements */
    @media(hover:none) {

        .cta-cart:hover,
        .cta-quote:hover,
        .hero-link:hover,
        .see-all:hover,
        .tab-btn:hover,
        .pcard-link:hover,
        .pcard-btn-cart:hover,
        .pcard-btn-quote:hover,
        .r-card:hover,
        .r-card-btn:hover,
        .thumb-item:hover,
        .mob-cart:active,
        .mob-quote:active {
            transform: none
        }
    }

    .mob-product-section {
        display: none;
    }

    @media(max-width:860px) {

        .hero-band {
            display: none !important;
        }


        .mob-product-section {
            display: flex;
            flex-direction: column;
            background: #fff;
            padding: 0 0 16px;
        }

        .mob-img-wrap {
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 260px;
            border-bottom: 1px solid var(--border);
        }

        .mob-img-wrap img {
            max-height: 240px;
            max-width: 100%;
            object-fit: contain;
            padding: 16px;
        }

        .mob-title {
            font-family: 'Sora', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--text);
            padding: 16px 16px 6px;
            line-height: 1.3;
        }

        .mob-desc {
            font-size: 12px;
            color: var(--muted);
            padding: 0 16px 14px;
            line-height: 1.6;
            border-bottom: 1px solid var(--border);
        }

        .mob-price-block {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
        }

        .mob-mrp {
            font-size: 11px;
            color: var(--faint);
            text-decoration: line-through;
            margin-bottom: 4px;
        }

        .mob-price-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }

        .mob-price {
            font-family: 'Sora', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--text);
        }

        .mob-save {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: var(--green);
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .mob-gst {
            font-size: 10px;
            color: var(--faint);
        }

        .mob-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }

        .mob-rating .stars {
            display: flex;
            gap: 2px;
        }

        .mob-rating-text {
            font-size: 12px;
            color: var(--muted);
            font-weight: 600;
        }

        .mob-rating-div {
            color: var(--border);
        }

        .mob-stock {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: var(--green);
            font-size: 10px;
            font-weight: 800;
            padding: 2px 10px;
            border-radius: 20px;
        }

        .mob-btns {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 14px 16px 0;
        }

        .mob-btn-cart {
            background: var(--green);
            color: #fff;
            font-weight: 800;
            font-size: 13px;
            padding: 13px;
            border-radius: var(--r8);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            letter-spacing: .04em;
            box-shadow: 0 4px 14px rgba(22, 163, 74, .25);
        }

        .mob-btn-wa {
            background: #16a34a;
            color: #fff;
            font-weight: 800;
            font-size: 13px;
            padding: 13px;
            border-radius: var(--r8);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .mob-btn-quote {
            background: var(--navy);
            color: #fff;
            font-weight: 800;
            font-size: 13px;
            padding: 13px;
            border-radius: var(--r8);
            border: none;
            cursor: pointer;
        }
    }

    .mob-about {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
    }

    .mob-about-title {
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: #1A1E2E;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .mob-about-text {
        font-size: 12px;
        color: #1A1E2E;
        line-height: 1.75;
    }

    @media(max-width:860px) {
        .desc-card {
            display: none;
        }
    }

    .pcard-links-desk {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .pcard-link-desk {
        display: flex;
        align-items: center;
        gap: 9px;
        font-size: 11px;
        font-weight: 700;
        padding: 9px 12px;
        border-radius: var(--r8);
        border: 1px solid var(--border);
        background: #f8fafc;
        cursor: pointer;
        color: var(--muted);
        transition: all .2s;
        text-align: left;
    }

    .pcard-link-desk:hover {
        border-color: #94a3b8;
        background: #fff;
        color: var(--text);
    }

    .pcard-link-desk.wa {
        color: var(--green);
        border-color: rgba(22, 163, 74, .25);
        background: #f0fdf4;
    }

    .pcard-link-desk.wa:hover {
        background: #dcfce7;
    }

    .pcard-link-desk svg {
        width: 14px;
        height: 14px;
        flex-shrink: 0;
    }

    @media(max-width:860px) {
        .pcard-links-desk {
            display: none;
        }
    }

    @media(max-width:860px) {
        .meta-tiles {
            display: none;
        }
    }

    .mob-about {
        display: none;
    }

    @media(max-width:860px) {
        .mob-about {
            display: block;
        }
    }

    #floatingCartBtn {
        display: none !important;
    }

    #wa-float-btn {
        position: fixed;
        bottom: 22px;
        right: 18px;
        z-index: 9999;
        background: #25D366;
        color: #fff;
        bottom: 100px !important;
        right: 30px !important;
        width: 59px;
        height: 59px;

        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;

        box-shadow: 0 4px 24px rgba(37, 211, 102, 0.45);
        text-decoration: none;
        transition: transform .2s, box-shadow .2s;
    }

    #wa-float-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 30px rgba(37, 211, 102, 0.55);
    }

    #wa-float-btn svg {
        width: 26px;
        height: 26px;
        flex-shrink: 0;
    }

    @media (max-width: 1023px) {
        #wa-float-btn {
            bottom: 150px !important;
            right: 14px !important;
        }
    }

    /* ═══════════════════════════════════
   MOB-DBAR — Mobile delivery tiles
═══════════════════════════════════ */
    .mob-dbar {
        display: none;
    }

    @media(max-width:860px) {
        .mob-dbar {
            display: block;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .dbar {
            display: none !important;
        }

        .mob-dbar-inner {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            overflow-x: auto;
        }

        .mob-dbar-tile {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 8px;
            border-right: 1px solid var(--border);
            flex-direction: column;
            text-align: center;
        }

        .mob-dbar-icon {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mob-dbar-icon svg {
            width: 14px;
            height: 14px;
        }

        .mob-dbar-lbl {
            font-size: 8px;
            font-weight: 600;
            color: var(--faint);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 1px;
        }

        .mob-dbar-val {
            font-size: 10px;
            font-weight: 800;
            color: var(--text);
        }
    }
    </style>

    <style>
    @media(min-width:861px) {
        .page-body {
            grid-template-columns: 1fr 280px;
            /* right sidebar chhota, left (review) bada */
            gap: 20px;
        }

        .right-col {
            width: 280px;
        }
    }

    @media(max-width:860px) {

        .mob-ships-strip {
            background: #fde047;
            color: #1a1e2e;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
            padding: 9px 12px;
            letter-spacing: .02em;
        }

        .mob-img-row {
            display: flex;
            gap: 10px;
            padding: 14px;
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        .mob-img-main {
            position: relative;
            flex: 1;
            min-width: 0;
            height: 230px;
            background: #f8fafc;
            border-radius: var(--r8);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mob-img-main img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            padding: 10px;
        }

        .mob-instock-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            z-index: 5;
        }

        .mob-img-thumbs {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex-shrink: 0;
            width: 58px;
        }

        .mob-img-thumbs .thumb-item {
            width: 58px;
            height: 64px;
            border: 1.5px solid var(--border);
            border-radius: var(--r8);
            overflow: hidden;
            background: #f8fafc;
            cursor: pointer;
        }

        .mob-img-thumbs .thumb-item.on {
            border-color: var(--navy);
            box-shadow: 0 0 0 2px rgba(10, 36, 99, .15);
        }

        .mob-img-thumbs .thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 3px;
        }

        .mob-title {
            font-family: 'Sora', sans-serif;
            font-size: 19px;
            font-weight: 800;
            color: var(--text);
            padding: 14px 16px 0;
            line-height: 1.3;
        }

        .mob-desc {
            font-size: 12px;
            color: var(--muted);
            padding: 4px 16px 0;
            line-height: 1.6;
        }

        .mob-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 10px 16px 0;
            border-bottom: none;
        }

        .mob-price-block {
            padding: 12px 16px 0;
            border-bottom: none;
        }

        .mob-price-row {
            display: flex;
            align-items: baseline;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 4px;
        }

        .mob-price {
            font-family: 'Sora', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--text);
        }

        .mob-qty-gst-row {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            padding: 12px 16px 0;
        }

        .mob-gst-pill {
            font-size: 10px;
            font-weight: 700;
            color: var(--muted);
            border: 1px solid var(--border);
            padding: 6px 12px;
            border-radius: 20px;
            background: #f8fafc;
            white-space: nowrap;
        }

        .mob-min-order-txt {
            font-size: 10px;
            color: var(--faint);
            padding: 6px 16px 0;
        }

        .mob-variant-block {
            padding: 14px 16px 0;
        }

        .mob-variant-lbl {
            font-size: 12px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 6px;
        }

        .mob-variant-selected {
            font-weight: 600;
            color: var(--muted);
        }

        .mob-variant-select {
            width: 100%;
            border: 1.5px solid var(--navy);
            border-radius: var(--r8);
            padding: 10px 36px 10px 12px;
            font-size: 13px;
            font-weight: 700;
            color: var(--navy);
            background-color: #fff;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%230a2463' stroke-width='2'%3e%3cpath d='M6 9l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            cursor: pointer;
            font-family: 'Sora', sans-serif;
        }

        .mob-product-section .mob-btns {
            padding: 16px 16px 16px;
        }
    }

    /* ===== FONT OVERRIDE — Industrywaala style sans-serif ===== */
    .mob-title,
    .mob-price,
    .mob-mrp,
    .mob-desc,
    .mob-rating-text,
    .mob-gst,
    .mob-save,
    .mob-stock,
    .mob-variant-lbl,
    .mob-variant-selected,
    .mob-variant-select,
    .mob-gst-pill,
    .mob-min-order-txt {
        font-family: 'Sora', sans-serif !important;
    }

    .mob-title {
        font-size: 17px !important;
        font-weight: 700 !important;
        line-height: 1.35 !important;
    }

    .mob-price {
        font-size: 22px !important;
        font-weight: 700 !important;
    }

    @media(max-width:860px) {
        .mob-qty-gst-row {
            flex-wrap: nowrap !important;
            gap: 10px !important;
        }

        .mob-qty-gst-row .qty-box {
            flex: 1 !important;
            max-width: none !important;
            display: flex !important;
        }

        .mob-qty-gst-row .qty-box button {
            flex-shrink: 0 !important;
            width: 36px !important;
            height: 40px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        .mob-qty-gst-row .qty-box input {
            flex: 1 !important;
            width: auto !important;
            height: 40px !important;
            min-width: 0 !important;
        }

        .mob-gst-pill {
            flex: 1 !important;
            text-align: center !important;
            white-space: nowrap !important;
            padding: 10px 8px !important;
        }
    }

    @media(max-width:860px) {
        .mob-title {
            margin-bottom: 2px !important;
        }

        .mob-desc {
            margin-bottom: 4px !important;
        }

        .mob-rating {
            padding-bottom: 6px !important;
            margin-bottom: 2px !important;
        }

        .mob-price-block {
            padding-bottom: 6px !important;
        }

        .mob-variant-block {
            margin-bottom: 2px !important;
            padding-bottom: 2px !important;
        }

        .mob-variant-block:last-of-type {
            margin-bottom: 4px !important;
        }
    }

    @media(max-width:860px) {
        .mob-ships-strip {
            background: transparent !important;
            padding: 10px 16px 0 !important;
            text-align: left !important;
        }

        .mob-ships-strip span {
            display: inline-flex;
            align-items: center;
            background: rgba(22, 163, 74, .1);
            border: 1px solid rgba(22, 163, 74, .25);
            color: var(--green);
            font-size: 10px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            letter-spacing: 0;
        }
    }

    .mob-size-slider {
        width: 100%;
        margin: 6px 0 4px;
        accent-color: var(--navy);
        height: 4px;
    }

    .mob-size-slider-labels {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        font-weight: 800;
        color: var(--muted);
        margin-top: 4px;
    }

    /* ═══════════════════════════════════
   HERO BAND
═══════════════════════════════════ */
    .hero-band {
        background: linear-gradient(135deg, #0a2463 0%, #0d2d7a 60%, #1a3a9a 100%);
        padding: 36px 0 0
    }

    .hero-inner {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 28px;
        display: grid;
        grid-template-columns: 480px 1fr;
        gap: 40px;
        align-items: stretch
    }

    @media(max-width:1100px) {
        .hero-inner {
            grid-template-columns: 1fr 360px;
            gap: 28px
        }
    }

    @media(max-width:860px) {
        .hero-band {
            padding: 24px 0 0
        }

        .hero-inner {
            grid-template-columns: 1fr;
            gap: 0;
            padding: 0 20px
        }
    }

    @media(max-width:640px) {
        .hero-band {
            padding: 20px 0 0
        }

        .hero-inner {
            padding: 0 16px
        }
    }

    /* LEFT */
    .hero-left {
        padding-bottom: 32px
    }

    .hero-cat {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .2);
        color: rgba(255, 255, 255, .85);
        font-size: 10px;
        font-weight: 800;
        padding: 4px 14px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: .1em;
        margin-bottom: 16px
    }

    .hero-title {
        font-family: 'Sora', sans-serif;
        font-size: 30px;
        font-weight: 800;
        color: #fff;
        line-height: 1.25;
        margin-bottom: 8px
    }

    .hero-sub {
        font-size: 13px;
        color: rgba(255, 255, 255, .6);
        font-weight: 400;
        margin-bottom: 18px;
        line-height: 1.6
    }

    @media(max-width:680px) {
        .hero-left {
            padding-bottom: 20px
        }

        .hero-cat {
            font-size: 9px;
            padding: 3px 12px;
            gap: 4px;
            margin-bottom: 12px
        }

        .hero-title {
            font-size: 22px;
            margin-bottom: 6px
        }

        .hero-sub {
            font-size: 12px;
            margin-bottom: 14px
        }
    }

    @media(max-width:480px) {
        .hero-title {
            font-size: 20px;
            line-height: 1.3
        }

        .hero-sub {
            font-size: 11px
        }
    }

    .hero-rating {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px
    }

    .stars {
        display: flex;
        gap: 2px
    }

    .stars svg {
        width: 14px;
        height: 14px
    }

    .r-text {
        font-size: 12px;
        color: rgba(255, 255, 255, .65);
        font-weight: 600
    }

    .r-div {
        color: rgba(255, 255, 255, .2)
    }

    .stock-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: rgba(22, 163, 74, .2);
        border: 1px solid rgba(22, 163, 74, .4);
        color: #4ade80;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 20px;
        letter-spacing: .04em
    }

    @media(max-width:640px) {
        .hero-rating {
            gap: 8px;
            margin-bottom: 16px
        }

        .stars svg {
            width: 13px;
            height: 13px
        }

        .r-text {
            font-size: 11px
        }

        .stock-pill {
            font-size: 9px;
            padding: 2px 8px
        }
    }

    /* PRICE BLOCK */
    .hero-price-block {
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: var(--r16);
        padding: 18px 20px;
        margin-bottom: 20px;
        backdrop-filter: blur(8px)
    }

    .hero-mrp {
        font-size: 12px;
        color: rgba(255, 255, 255, .45);
        text-decoration: line-through;
        margin-bottom: 6px
    }

    .hero-price-row {
        display: flex;
        align-items: baseline;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 6px
    }

    .hero-price {
        font-family: 'Sora', sans-serif;
        font-size: 38px;
        color: #fff;
        line-height: 1
    }

    .hero-price-calc {
        font-size: 12px;
        color: rgba(255, 255, 255, .5)
    }

    .hero-gst {
        font-size: 11px;
        color: rgba(255, 255, 255, .4);
        margin-bottom: 10px
    }

    .hero-save {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(22, 163, 74, .15);
        border: 1px solid rgba(22, 163, 74, .3);
        color: #4ade80;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px
    }

    @media(max-width:680px) {
        .hero-price-block {
            padding: 14px 16px;
            margin-bottom: 16px;
            border-radius: var(--r12)
        }

        .hero-mrp {
            font-size: 11px;
            margin-bottom: 4px
        }

        .hero-price {
            font-size: 28px
        }

        .hero-price-calc {
            font-size: 11px
        }

        .hero-gst {
            font-size: 10px;
            margin-bottom: 8px
        }

        .hero-save {
            font-size: 10px;
            padding: 3px 10px
        }
    }

    @media(max-width:480px) {
        .hero-price {
            font-size: 24px
        }

        .hero-price-row {
            gap: 8px
        }
    }

    /* QTY + CTA */
    .hero-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px
    }

    .qty-box {
        display: flex;
        align-items: center;
        border: 2px solid rgba(255, 255, 255, .3);
        border-radius: var(--r8);
        overflow: hidden;
        background: rgba(255, 255, 255, .08)
    }

    .qty-box button {
        width: 36px;
        height: 42px;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: background .15s;
        -webkit-tap-highlight-color: transparent
    }

    .qty-box button:hover {
        background: rgba(255, 255, 255, .15)
    }

    .qty-box input {
        width: 46px;
        height: 42px;
        text-align: center;
        background: transparent;
        border: none;
        border-left: 1px solid rgba(255, 255, 255, .2);
        border-right: 1px solid rgba(255, 255, 255, .2);
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        outline: none;
        font-family: 'Inter', sans-serif
    }

    .cta-cart {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--green);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        padding: 12px 24px;
        border-radius: var(--r8);
        border: none;
        cursor: pointer;
        transition: background .2s, transform .15s, box-shadow .2s;
        letter-spacing: .04em;
        box-shadow: 0 4px 16px rgba(22, 163, 74, .4);
        -webkit-tap-highlight-color: transparent
    }

    .cta-cart:hover {
        background: #15803d;
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(22, 163, 74, .45)
    }

    .cta-quote {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, .12);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        padding: 12px 22px;
        border-radius: var(--r8);
        border: 2px solid rgba(255, 255, 255, .3);
        cursor: pointer;
        transition: background .2s, border-color .2s;
        letter-spacing: .04em;
        -webkit-tap-highlight-color: transparent
    }

    .cta-quote:hover {
        background: rgba(255, 255, 255, .2);
        border-color: rgba(255, 255, 255, .5)
    }

    @media(max-width:640px) {
        .hero-actions {
            gap: 10px;
            margin-bottom: 12px
        }

        .qty-box button {
            width: 34px;
            height: 40px;
            font-size: 16px
        }

        .qty-box input {
            width: 42px;
            height: 40px;
            font-size: 13px
        }

        .cta-cart {
            font-size: 12px;
            padding: 11px 20px;
            gap: 6px
        }

        .cta-quote {
            font-size: 12px;
            padding: 11px 18px;
            gap: 6px
        }
    }

    @media(max-width:480px) {
        .hero-actions {
            flex-direction: column;
            width: 100%;
            gap: 8px
        }

        .qty-box {
            width: 100%;
            justify-content: center
        }

        .cta-cart,
        .cta-quote {
            width: 100%;
            justify-content: center
        }
    }

    /* HERO LINKS */
    .hero-links {
        display: flex;
        gap: 8px;
        flex-wrap: wrap
    }

    .hero-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 255, 255, .6);
        border: 1px solid rgba(255, 255, 255, .15);
        padding: 6px 14px;
        border-radius: 20px;
        cursor: pointer;
        transition: background .2s, color .2s, border-color .2s;
        background: transparent;
        -webkit-tap-highlight-color: transparent
    }

    .hero-link:hover {
        background: rgba(255, 255, 255, .1);
        color: #fff;
        border-color: rgba(255, 255, 255, .3)
    }

    .hero-link.wa {
        color: #4ade80;
        border-color: rgba(74, 222, 128, .3)
    }

    .hero-link.wa:hover {
        background: rgba(74, 222, 128, .1)
    }

    .hero-link svg {
        width: 13px;
        height: 13px;
        flex-shrink: 0
    }

    @media(max-width:640px) {
        .hero-links {
            gap: 6px
        }

        .hero-link {
            font-size: 10px;
            padding: 5px 12px;
            gap: 5px
        }

        .hero-link svg {
            width: 12px;
            height: 12px
        }
    }

    @media(max-width:480px) {
        .hero-links {
            justify-content: center
        }

        .hero-link {
            flex: 1;
            min-width: calc(50% - 3px);
            justify-content: center
        }
    }

    /* RIGHT IMAGE CARD */
    .hero-right {
        position: relative;
        align-self: stretch;
        display: flex;
        flex-direction: column;
    }

    .hero-img-card {
        background: #fff;
        border-radius: var(--r20) var(--r20) 0 0;
        padding: 24px 24px 0;
        box-shadow: var(--sh3);
        position: relative;
        overflow: hidden;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .hero-img-wrap {
        position: relative;
        flex: 1;
        min-height: 480px;
        cursor: zoom-in;
        overflow: hidden;
        border-radius: var(--r12);
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .hero-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 12px;
        transition: transform .5s cubic-bezier(.25, .46, .45, .94)
    }

    .hero-img-wrap:hover img {
        transform: scale(1.08)
    }

    @media(max-width:860px) {
        .hero-right {
            margin-top: 20px
        }

        .hero-img-card {
            border-radius: var(--r16) var(--r16) 0 0;
            padding: 20px 20px 0
        }

        .hero-img-wrap {
            min-height: 280px
        }
    }

    @media(max-width:640px) {
        .hero-img-card {
            padding: 16px 16px 0;
            border-radius: var(--r12) var(--r12) 0 0
        }

        .hero-img-wrap {
            min-height: 240px;
            border-radius: var(--r8)
        }

        .hero-img-wrap img {
            padding: 8px
        }
    }

    @media(max-width:480px) {
        .hero-img-wrap {
            min-height: 200px
        }
    }

    .img-badge-tl {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 5
    }

    .img-badge-tr {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 5
    }

    .b-stock {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--green);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: .04em
    }

    .b-best {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--red);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: .04em
    }

    .hero-ships {
        position: absolute;
        top: 12px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(22, 163, 74, .1);
        border: 1px solid rgba(22, 163, 74, .25);
        color: var(--green);
        font-size: 10px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        white-space: nowrap;
        z-index: 5
    }

    @media(max-width:640px) {

        .img-badge-tl,
        .img-badge-tr {
            top: 8px
        }

        .img-badge-tl {
            left: 8px
        }

        .img-badge-tr {
            right: 8px
        }

        .b-stock,
        .b-best {
            font-size: 9px;
            padding: 3px 8px
        }

        .hero-ships {
            font-size: 9px;
            padding: 3px 10px;
            top: 8px
        }
    }

    .thumb-strip {
        display: flex;
        gap: 8px;
        padding: 14px 0 20px;
        overflow-x: auto;
        scrollbar-width: none
    }

    .thumb-strip::-webkit-scrollbar {
        display: none
    }

    .thumb-item {
        flex-shrink: 0;
        width: 54px;
        height: 54px;
        border: 2px solid var(--border);
        border-radius: var(--r8);
        overflow: hidden;
        background: #f8fafc;
        cursor: pointer;
        transition: border-color .2s, box-shadow .2s;
        -webkit-tap-highlight-color: transparent
    }

    .thumb-item:hover {
        border-color: var(--navy)
    }

    .thumb-item.on {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(10, 36, 99, .12)
    }

    .thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 4px
    }

    @media(max-width:640px) {
        .thumb-strip {
            gap: 6px;
            padding: 12px 0 16px
        }

        .thumb-item {
            width: 48px;
            height: 48px;
            border-width: 1.5px
        }

        .thumb-item img {
            padding: 3px
        }
    }

    .variant-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .variant-pill-dark {
        padding: 9px 16px;
        border: 1.5px solid rgba(255, 255, 255, .25);
        border-radius: var(--r8);
        background: rgba(255, 255, 255, .06);
        color: rgba(255, 255, 255, .75);
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: all .15s;
        font-family: 'Inter', sans-serif;
        -webkit-tap-highlight-color: transparent;
    }

    .variant-pill-dark:hover {
        border-color: #fff;
        color: #fff;
    }

    .variant-pill-dark.selected {
        border-color: var(--navy);
        background: var(--navy);
        color: #fff;
    }

    .hero-size-slider-wrap {
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .15);
        border-radius: var(--r8);
        padding: 10px 14px;
    }

    .hero-size-slider {
        width: 100%;
        height: 5px;
        border-radius: 4px;
        background: rgba(255, 255, 255, .25);
        outline: none;
        -webkit-appearance: none;
        appearance: none;
        cursor: pointer;
    }

    .hero-size-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid var(--navy);
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .3);
        transition: transform .15s;
    }

    .hero-size-slider::-webkit-slider-thumb:hover {
        transform: scale(1.15);
    }

    .hero-size-slider::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid var(--navy);
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, .3);
    }

    .write-review-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #0a2463;
        color: #fff;
        font-size: 11px;
        font-weight: 800;
        padding: 8px 16px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        letter-spacing: .04em;
        transition: background .2s, transform .15s;
        -webkit-tap-highlight-color: transparent;
    }

    .write-review-btn:hover {
        background: #061540;
        transform: translateY(-1px);
    }

    /* ── SUMMARY ── */
    .review-summary {
        display: flex;
        gap: 24px;
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        background: #fafbff;
        flex-wrap: wrap;
    }

    .rev-avg-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 100px;
        flex-shrink: 0;
    }

    .rev-avg-num {
        font-family: 'Sora', sans-serif;
        font-size: 52px;
        font-weight: 800;
        color: #0a2463;
        line-height: 1;
        margin-bottom: 6px;
    }

    .rev-stars-big {
        display: flex;
        gap: 3px;
        margin-bottom: 6px;
    }

    .rev-star-svg {
        width: 18px;
        height: 18px;
    }

    .rev-total-count {
        font-size: 11px;
        color: var(--faint);
        font-weight: 600;
    }

    /* ── RATING BARS ── */
    .rev-bars {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 6px;
        justify-content: center;
        min-width: 180px;
    }

    .rev-bar-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rev-bar-lbl {
        font-size: 11px;
        font-weight: 700;
        color: var(--muted);
        width: 30px;
        flex-shrink: 0;
    }

    .rev-bar-track {
        flex: 1;
        height: 8px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }

    .rev-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #f59e0b, #fbbf24);
        border-radius: 4px;
        transition: width .6s cubic-bezier(.25, .46, .45, .94);
    }

    .rev-bar-cnt {
        font-size: 11px;
        font-weight: 700;
        color: var(--faint);
        width: 20px;
        text-align: right;
        flex-shrink: 0;
    }

    /* ── REVIEW LIST ── */
    .review-list {
        padding: 0;
    }

    .rev-item {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        transition: background .15s;
    }

    .rev-item:last-child {
        border-bottom: none;
    }

    .rev-item:hover {
        background: #fafbff;
    }

    .rev-item-hdr {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
        flex-wrap: wrap;
    }

    .rev-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0a2463, #1a3a9a);
        color: #fff;
        font-size: 15px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-family: 'Sora', sans-serif;
    }

    .rev-name-block {
        flex: 1;
        min-width: 0;
    }

    .rev-name {
        font-size: 13px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 3px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .rev-verified {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #16a34a;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 20px;
        letter-spacing: .04em;
    }

    .rev-verified svg {
        width: 10px;
        height: 10px;
    }

    .rev-date {
        font-size: 10px;
        color: var(--faint);
    }

    .rev-item-stars {
        display: flex;
        gap: 2px;
    }

    .rev-item-stars svg {
        width: 13px;
        height: 13px;
    }

    .rev-text {
        font-size: 13px;
        color: #374151;
        line-height: 1.7;
        margin-top: 8px;
    }

    .rev-photo {
        margin-top: 10px;
        max-height: 120px;
        border-radius: 8px;
        object-fit: cover;
        cursor: zoom-in;
        border: 1px solid var(--border);
    }

    /* ── EMPTY STATE ── */
    .rev-empty {
        padding: 48px 24px;
        text-align: center;
        color: var(--faint);
    }

    .rev-empty svg {
        width: 48px;
        height: 48px;
        margin: 0 auto 14px;
        opacity: .3;
        display: block;
    }

    .rev-empty p:first-of-type {
        font-size: 15px;
        font-weight: 800;
        color: #64748b;
        margin-bottom: 6px;
    }

    .rev-empty p:last-of-type {
        font-size: 12px;
        color: #94a3b8;
    }

    /* ── LOADING ── */
    .rev-loading {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 40px 24px;
        color: var(--faint);
        font-size: 13px;
    }

    .rev-spinner {
        width: 20px;
        height: 20px;
        border: 2px solid #e2e8f0;
        border-top-color: #0a2463;
        border-radius: 50%;
        animation: spin .7s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* ── PAGINATION ── */
    .rev-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 16px;
        border-top: 1px solid var(--border);
    }

    .rev-page-btn {
        background: #0a2463;
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background .2s, opacity .2s;
        font-family: 'Sora', sans-serif;
    }

    .rev-page-btn:disabled {
        opacity: .4;
        cursor: not-allowed;
    }

    .rev-page-btn:not(:disabled):hover {
        background: #061540;
    }

    .rev-page-info {
        font-size: 12px;
        color: var(--muted);
        font-weight: 600;
    }


    /* ════════════════════════════════
   REVIEW MODAL
════════════════════════════════ */
    .rev-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .6);
        backdrop-filter: blur(6px);
        z-index: 400;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .rev-modal-overlay.open {
        display: flex;
    }

    .rev-modal-sheet {
        background: #fff;
        border-radius: 20px;
        max-width: 500px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 24px 80px rgba(0, 0, 0, .2);
        animation: modalSlideUp .3s cubic-bezier(.34, 1.56, .64, 1);
    }

    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(.96);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .rev-modal-hdr {
        background: linear-gradient(135deg, #0a2463, #1a3a9a);
        color: #fff;
        padding: 18px 22px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        flex-shrink: 0;
    }

    .rev-modal-x {
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, .15);
        border: none;
        color: #fff;
        border-radius: 50%;
        cursor: pointer;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background .2s;
        -webkit-tap-highlight-color: transparent;
    }

    .rev-modal-x:hover {
        background: rgba(255, 255, 255, .25);
    }

    .rev-modal-body {
        padding: 20px 22px;
    }

    .rev-field {
        margin-bottom: 16px;
    }

    .rev-label {
        display: block;
        font-size: 10px;
        font-weight: 800;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: .07em;
        margin-bottom: 7px;
    }

    .rev-req {
        color: #b71c1c;
    }

    /* STAR PICKER */
    .rev-star-picker {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .star-pick-svg {
        width: 34px;
        height: 34px;
        color: #e2e8f0;
        cursor: pointer;
        transition: color .12s, transform .12s;
    }

    .star-pick-svg:hover,
    .star-pick-svg.active {
        color: #f59e0b;
        transform: scale(1.15);
    }

    .rev-rating-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--muted);
        margin-left: 4px;
    }

    /* INPUTS */
    .rev-textarea,
    .rev-input {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: 10px;
        padding: 11px 13px;
        font-size: 13px;
        font-family: 'Sora', sans-serif;
        color: var(--text);
        outline: none;
        background: #fff;
        transition: border-color .2s, box-shadow .2s;
        resize: vertical;
    }

    .rev-textarea:focus,
    .rev-input:focus {
        border-color: #0a2463;
        box-shadow: 0 0 0 3px rgba(10, 36, 99, .1);
    }

    .rev-char-count {
        font-size: 10px;
        color: var(--faint);
        text-align: right;
        margin-top: 4px;
    }

    .rev-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 16px;
    }

    /* PHOTO */
    .rev-photo-label {
        display: flex;
        align-items: center;
        gap: 10px;
        border: 2px dashed var(--border);
        border-radius: 10px;
        padding: 12px 16px;
        cursor: pointer;
        font-size: 12px;
        color: var(--muted);
        font-weight: 600;
        transition: border-color .2s, background .2s;
    }

    .rev-photo-label:hover {
        border-color: #0a2463;
        background: #f0f4ff;
    }

    /* ERROR */
    .rev-error {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        color: #b71c1c;
        font-size: 12px;
        font-weight: 600;
        padding: 10px 14px;
        border-radius: 8px;
        margin-bottom: 12px;
    }

    /* SUBMIT BTN */
    .rev-submit-btn {
        flex: 1;
        background: linear-gradient(135deg, #0a2463, #1a3a9a);
        color: #fff;
        border: none;
        padding: 13px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        letter-spacing: .04em;
        transition: opacity .2s, transform .15s;
        font-family: 'Sora', sans-serif;
        box-shadow: 0 4px 14px rgba(10, 36, 99, .3);
    }

    .rev-submit-btn:hover {
        opacity: .92;
        transform: translateY(-1px);
    }

    .rev-submit-btn:disabled {
        opacity: .55;
        cursor: not-allowed;
        transform: none;
    }

    .rev-cancel-btn {
        padding: 13px 20px;
        border-radius: 10px;
        border: 1.5px solid var(--border);
        background: #f8fafc;
        font-size: 13px;
        font-weight: 700;
        color: var(--muted);
        cursor: pointer;
        font-family: 'Sora', sans-serif;
        transition: background .2s;
    }

    .rev-cancel-btn:hover {
        background: #fff;
        color: var(--text);
    }

    /* SUCCESS STATE */
    .rev-success {
        text-align: center;
        padding: 32px 24px;
    }

    .rev-success-icon {
        width: 64px;
        height: 64px;
        background: #f0fdf4;
        border: 2px solid #bbf7d0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .rev-success-icon svg {
        width: 32px;
        height: 32px;
        color: #16a34a;
    }

    .rev-success h3 {
        font-size: 18px;
        font-weight: 800;
        color: var(--text);
        margin-bottom: 8px;
    }

    .rev-success p {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
    }

    /* ── RESPONSIVE ── */
    @media(max-width:640px) {
        .review-summary {
            padding: 14px 16px;
            gap: 16px;
        }

        .rev-avg-num {
            font-size: 40px;
        }

        .rev-item {
            padding: 14px 16px;
        }

        .rev-avatar {
            width: 36px;
            height: 36px;
            font-size: 13px;
        }

        .rev-text {
            font-size: 12px;
        }

        .rev-row-2 {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .rev-modal-hdr {
            padding: 16px 18px;
        }

        .rev-modal-body {
            padding: 16px 18px;
        }

        .star-pick-svg {
            width: 30px;
            height: 30px;
        }

        .rev-modal-sheet {
            border-radius: 16px;
        }
    }

    @media(max-width:480px) {
        .rev-bars {
            min-width: 100%;
        }

        .write-review-btn {
            font-size: 10px;
            padding: 7px 12px;
        }
    }
    </style>
</head>

<body>
    <?php include 'assets/include/header.php'; ?>



    <?php include 'assets/include/modal.php'; ?>


    <!-- SUCCESS NOTIF -->
    <div id="successNotif">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Added to cart!
    </div>

    <!-- ════════════════════════ BREADCRUMB ════════════════════════ -->
    <div class="bc-bar">
        <div class="bc-inner">
            <a href="index.php">Home</a><span class="sep">›</span>
            <a href="products.php">Products</a><span class="sep">›</span>
            <span class="cur"><?= htmlspecialchars($product['category']) ?></span>
        </div>
    </div>
    <!-- ════ MOBILE ONLY PRODUCT SECTION ════ -->
    <!-- ════ MOBILE ONLY PRODUCT SECTION (Industrywaala sequence, logic 100% unchanged) ════ -->
    <div class="mob-product-section">

        <!-- 1. SHIPS WITHIN STRIP (full width, top) -->
        <div class="mob-ships-strip">
            <span><?= htmlspecialchars($product['ships_within']) ?></span>
        </div>

        <!-- 2. IMAGE (left) + 3 THUMBS (right, stack3ed) -->
        <div class="mob-img-row">
            <div class="mob-img-main">
                <?php if($product['in_stock']): ?>

                <?php else: ?>
                <span class="b-stock mob-instock-badge" style="background:#dc2626">Out of Stock</span>
                <?php endif; ?>
                <img src="<?= htmlspecialchars($images[0]['image_path']) ?>"
                    alt="<?= htmlspecialchars($product['name']) ?>" id="mob-main-img">
            </div>
            <?php if(count($images) > 1): ?>
            <div class="mob-img-thumbs">
                <?php foreach(array_slice($images,0,3) as $idx => $img): ?>
                <div onclick="document.getElementById('mob-main-img').src='<?= htmlspecialchars($img['image_path']) ?>';document.querySelectorAll('.mob-thumb').forEach(t=>t.classList.remove('on'));this.classList.add('on')"
                    class="thumb-item mob-thumb <?= $idx===0?'on':'' ?>">
                    <img src="<?= htmlspecialchars($img['image_path']) ?>" alt="">
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- 3. PRODUCT NAME -->
        <h1 class="mob-title"><?= htmlspecialchars($product['name']) ?></h1>

        <?php if(!empty($product['subtitle'])): ?>
        <p class="mob-desc"><?= htmlspecialchars($product['subtitle']) ?></p>
        <?php endif; ?>
        <?php if (!empty($brandInfo)): ?>
        <div style="padding:8px 16px 0;">
            <span
                style="font-size:13px;font-weight:700;color:#1A1E2E;text-transform:uppercase;letter-spacing:0.07em;margin-right:6px;">Brands
                :</span>
            <a href="brand-products.php?slug=<?= urlencode($brandInfo['slug']) ?>"
                style="font-size:13px;font-weight:800;color:#0a2463;text-decoration:none;border-bottom:1.5px solid #0a2463;">
                <?= htmlspecialchars($brandInfo['name']) ?>
            </a>
        </div>
        <?php endif; ?>
        <!-- 4. RATING + STOCK ROW -->
        <div class="mob-rating">
            <div class="stars">
                <?php $r=floatval($product['rating']); for($st=1;$st<=5;$st++): ?>
                <svg fill="currentColor" viewBox="0 0 20 20"
                    style="width:15px;height:15px;color:<?= $st<=$r?'#fbbf24':'#e2e8f0' ?>">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <?php endfor; ?>
            </div>
            <span class="mob-rating-text" id="mobRatingNum"><?= $product['rating'] ?>/5.0</span>
            <span class="mob-rating-div">|</span>
            <span class="mob-rating-text" id="mobReviewCount" style="display:none;"></span>
            <span class="mob-rating-text"><?= htmlspecialchars($product['orders_count']) ?> Orders</span>
            <?php if($product['in_stock']): ?>
            <span class="mob-stock"><?= htmlspecialchars($product['stock_label']) ?></span>
            <?php endif; ?>
        </div>

        <!-- 5. PRICE — single line -->
        <div class="mob-price-block">
            <div class="mob-price-row">
                <span class="mob-price"><?= formatINR($product['price_min']) ?></span>
                <span class="mob-mrp" style="margin:0;"><?= formatINR($mrpDisplay) ?></span>
                <?php if($savings > 0): ?>
                <span class="mob-save">Save <?= formatINR($savings) ?></span>
                <?php endif; ?>
                <?php if($product['best_price']): ?>
                <span class="b-best" style="font-size:9px;">Best Price ✓</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- 6. QTY (same #quantity id, same onclick — JS untouched) + GST pill, same row -->
        <div class="mob-qty-gst-row">
            <div class="qty-box"
                style="border:2px solid var(--navy);border-radius:var(--r8);overflow:hidden;background:#fff;display:inline-flex;">
                <button onclick="decreaseQuantity()"
                    style="width:30px;height:34px;background:#f8fafc;border:none;color:var(--navy);font-size:16px;font-weight:700;cursor:pointer;">−</button>
                <input type="number" id="quantity" value="1" min="1" readonly
                    style="width:34px;height:34px;text-align:center;font-size:13px;font-weight:800;color:var(--navy);border:none;border-left:2px solid var(--navy);border-right:2px solid var(--navy);outline:none;background:#fff;font-family:'Sora',sans-serif;">
                <button onclick="increaseQuantity()"
                    style="width:30px;height:34px;background:#f8fafc;border:none;color:var(--navy);font-size:16px;font-weight:700;cursor:pointer;">+</button>
            </div>
            <span class="mob-gst-pill">+ <?= $product['gst_percent'] ?>% GST applicable</span>
        </div>
        <p class="mob-min-order-txt">Min: <?= $product['min_order'] ?>
            <?= htmlspecialchars($product['min_order_unit']) ?></p>

        <!-- 7. VARIANTS — Size / Disc MOC / Pressure Rating (STATIC for now — no DB data wired yet, per your instruction) -->
        <?php renderVariants($variantGroups, 'mobile'); ?>

        <!-- 8. PCARD LINKS ROW (Call / WhatsApp / Bulk Quote) — same onclick handlers as before -->
        <div class="pcard-links" style="display:flex;flex-direction:row;gap:8px;padding:14px 16px 0;">
            <a href="tel:+918468851160" class="pcard-link"
                style="flex:1;flex-direction:column;justify-content:center;align-items:center;text-align:center;gap:4px;padding:10px 6px;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    style="width:18px;height:18px;flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span style="font-size:10px;font-weight:800;">Call Us</span>
            </a>
            <button onclick="buyOnChat()" class="pcard-link wa"
                style="flex:1;flex-direction:column;justify-content:center;align-items:center;text-align:center;gap:4px;padding:10px 6px;">
                <svg fill="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;flex-shrink:0;">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                <span style="font-size:10px;font-weight:800;">WhatsApp</span>
            </button>
            <button onclick="openQuoteModal()" class="pcard-link"
                style="flex:1;flex-direction:column;justify-content:center;align-items:center;text-align:center;gap:4px;padding:10px 6px;">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    style="width:18px;height:18px;flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span style="font-size:10px;font-weight:800;">Bulk Quote</span>
            </button>
        </div>

        <!-- 9. DELIVERY INFO TILES -->
        <div class="mob-dbar">
            <div class="mob-dbar-inner">
                <div class="mob-dbar-tile">
                    <div class="mob-dbar-icon" style="background:#dbeafe">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#2563eb">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <div class="mob-dbar-lbl">Min. Order</div>
                        <div class="mob-dbar-val"><?= $product['min_order'] ?>
                            <?= htmlspecialchars($product['min_order_unit']) ?></div>
                    </div>
                </div>
                <div class="mob-dbar-tile">
                    <div class="mob-dbar-icon" style="background:#dbeafe">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#2563eb">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM3 4h13l3 8H3z" />
                        </svg>
                    </div>
                    <div>
                        <div class="mob-dbar-lbl">Delivery</div>
                        <div class="mob-dbar-val"><?= htmlspecialchars($product['delivery_days']) ?></div>
                    </div>
                </div>
                <div class="mob-dbar-tile">
                    <div class="mob-dbar-icon" style="background:#dbeafe">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#2563eb">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="mob-dbar-lbl">Warranty</div>
                        <div class="mob-dbar-val"><?= htmlspecialchars($product['warranty']) ?></div>
                    </div>
                </div>
                <div class="mob-dbar-tile" style="border-right:none">
                    <div class="mob-dbar-icon" style="background:#dbeafe">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#2563eb">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <div class="mob-dbar-lbl">Certification</div>
                        <div class="mob-dbar-val"><?= htmlspecialchars($product['certification']) ?></div>
                    </div>
                </div>
            </div>
        </div>



    </div><!-- END mob-product-section -->
    <!-- END mob-product-section -->
    <!-- ════════════════════════ HERO BAND ════════════════════════ -->
    <div class="hero-band">
        <div class="hero-inner">
            <!-- RIGHT: Image card -->
            <div class="hero-right au au1">
                <div class="hero-img-card">
                    <div class="hero-img-wrap" onclick="openLightbox(0)" id="product-image-wrap">
                        <img id="product-image" src="<?= htmlspecialchars($images[0]['image_path']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="img-badge-tl">
                            <?php if($product['in_stock']): ?>
                            <span class="b-stock">
                                <svg fill="currentColor" viewBox="0 0 20 20" style="width:10px;height:10px">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <?= htmlspecialchars($product['stock_label']) ?>
                            </span>
                            <?php else: ?>
                            <span class="b-stock" style="background:#dc2626">Out of Stock</span>
                            <?php endif; ?>
                        </div>
                        <?php if($product['best_price']): ?>
                        <div class="img-badge-tr"><span class="b-best">Best Price ✓</span></div>
                        <?php endif; ?>
                        <div class="hero-ships"><?= htmlspecialchars($product['ships_within']) ?></div>
                    </div>
                    <!-- Thumbs -->
                    <div class="thumb-strip" id="thumbRow">
                        <?php foreach($images as $idx=>$img): ?>
                        <div class="thumb-item <?= $idx===0?'on':'' ?>"
                            onclick="switchImage('<?= htmlspecialchars($img['image_path']) ?>',this)">
                            <img src="<?= htmlspecialchars($img['image_path']) ?>"
                                alt="<?= htmlspecialchars($img['alt_text']??'') ?>">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Trust badges inside card bottom -->
                    
                </div>
            </div>
            <!-- LEFT: Info + Price + Actions -->
            <div class="hero-left au">

                <!-- 2. PRODUCT NAME -->
                <h1 class="hero-title"
                    style="font-family:'Inter',sans-serif;font-size:26px;font-weight:800;margin-top:10px;">
                    <?= htmlspecialchars($product['name']) ?>
                </h1>
                <?php if(!empty($product['subtitle'])): ?>
                <p class="hero-sub" style="font-family:'Inter',sans-serif;">
                    <?= htmlspecialchars($product['subtitle']) ?></p>
                <?php endif; ?>
                <?php if (!empty($brandInfo)): ?>
                <div style="margin-bottom:12px;">
                    <span
                        style="font-size:13px;font-weight:700;color:rgba(255, 255, 255, 0.8);text-transform:uppercase;letter-spacing:0.08em;margin-right:8px;">Brands
                        :</span>
                    <a href="brand-products.php?slug=<?= urlencode($brandInfo['slug']) ?>"
                        style="font-size:15px;font-weight:800;color:#fff;text-decoration:none;border-bottom:1.5px solid rgba(255,255,255,0.35);padding-bottom:1px;transition:border-color 0.2s;"
                        onmouseover="this.style.borderColor='#fff'"
                        onmouseout="this.style.borderColor='rgba(255,255,255,0.35)'">
                        <?= htmlspecialchars($brandInfo['name']) ?>
                    </a>
                </div>
                <?php endif; ?>
                <!-- 3. RATING + ORDERS + IN STOCK -->
                <div class="hero-rating" style="font-family:'Inter',sans-serif;">
                    <div class="stars">
                        <?php $r=floatval($product['rating']); for($st=1;$st<=5;$st++): ?>
                        <svg fill="currentColor" viewBox="0 0 20 20"
                            style="color:<?= $st<=$r?'#fbbf24':'rgba(255,255,255,.2)' ?>">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="r-text" id="heroRatingNum"><?= $product['rating'] ?>/5.0</span>
                    <span class="r-div">|</span>
                    <span class="r-text" id="heroReviewCount" style="display:none;"></span>
                    <span class="r-text"><?= htmlspecialchars($product['orders_count']) ?> Orders</span>
                    <?php if($product['in_stock']): ?>
                    <span class="stock-pill">
                        <svg fill="currentColor" viewBox="0 0 20 20" style="width:10px;height:10px">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <?= htmlspecialchars($product['stock_label']) ?>
                    </span>
                    <?php endif; ?>
                </div>

                <!-- 4. PRICE + MRP + GST, single line -->
                <div
                    style="display:flex;align-items:baseline;gap:10px;flex-wrap:wrap;margin-bottom:16px;font-family:'Inter',sans-serif;">
                    <span id="product-total-price"
                        style="font-family:'Inter',sans-serif;font-weight:800;font-size:32px;color:#fff;"><?= formatINR($product['price_min']) ?></span>
                    <span
                        style="font-size:14px;color:rgba(255,255,255,.45);text-decoration:line-through;"><?= formatINR($mrpDisplay) ?></span>
                    <?php if($savings > 0): ?>
                    <span class="hero-save">
                        <svg fill="currentColor" viewBox="0 0 20 20" style="width:12px;height:12px">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <?= round((($mrpDisplay - $product['price_min']) / $mrpDisplay) * 100) ?>% OFF
                    </span>
                    <?php endif; ?>
                    <span
                        style="font-family:'Inter',sans-serif;font-size:11px;border:1px solid rgba(255,255,255,.3);border-radius:20px;padding:4px 12px;color:rgba(255,255,255,.7);">
                        + <?= $product['gst_percent'] ?>% GST applicable
                    </span>
                </div>

                <!-- 5. QTY + ADD TO CART + REQUEST QUOTE -->
                <div class="hero-actions">
                    <div class="qty-box">
                        <button onclick="decreaseQuantity()">−</button>
                        <input type="number" id="qty-hero" value="1" min="1" readonly>
                        <button onclick="increaseQuantity()">+</button>
                    </div>
                    <button onclick="addToCart()" class="cta-cart" style="font-family:'Inter',sans-serif;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        ADD TO CART
                    </button>
                    <button onclick="openQuoteModal()" class="cta-quote" style="font-family:'Inter',sans-serif;">REQUEST
                        QUOTE</button>
                </div>
                <p style="font-size:11px;color:rgba(255,255,255,.4);margin-bottom:20px;font-family:'Inter',sans-serif;">
                    Min. Order: <?= $product['min_order'] ?> <?= htmlspecialchars($product['min_order_unit']) ?>
                </p>

                <?php renderVariants($variantGroups, 'desktop'); ?>

                <!-- Secondary links -->
                <div class="hero-links">
                    <button class="hero-link" style="font-family:'Inter',sans-serif;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        +91 84688-51160
                    </button>
                    <button onclick="buyOnChat()" class="hero-link wa" style="font-family:'Inter',sans-serif;">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Buy on WhatsApp
                    </button>
                </div>
            </div>



        </div>
    </div><!-- /hero-band -->

    <!-- ════════════════════════ DELIVERY INFO BAR ════════════════════════ -->
    <div class="dbar au au2">
        <div class="dbar-inner">
            <div class="dbar-tile">
                <div class="dbar-icon" style="background:#dbeafe"><svg fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" style="color:#2563eb">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg></div>
                <div>
                    <div class="dbar-lbl">Min. Order</div>
                    <div class="dbar-val"><?= $product['min_order'] ?>
                        <?= htmlspecialchars($product['min_order_unit']) ?></div>
                </div>
            </div>
            <div class="dbar-tile">
                <div class="dbar-icon" style="background:#dbeafe"><svg fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" style="color:#2563eb">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM3 4h13l3 8H3z" />
                    </svg></div>
                <div>
                    <div class="dbar-lbl">Delivery</div>
                    <div class="dbar-val"><?= htmlspecialchars($product['delivery_days']) ?></div>
                </div>
            </div>
            <div class="dbar-tile">
                <div class="dbar-icon" style="background:#dbeafe"><svg fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" style="color:#2563eb">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg></div>
                <div>
                    <div class="dbar-lbl">Warranty</div>
                    <div class="dbar-val"><?= htmlspecialchars($product['warranty']) ?></div>
                </div>
            </div>
            <div class="dbar-tile">
                <div class="dbar-icon" style="background:#dbeafe"><svg fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" style="color:#2563eb">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg></div>
                <div>
                    <div class="dbar-lbl">Certification</div>
                    <div class="dbar-val"><?= htmlspecialchars($product['certification']) ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ════════════════════════ PAGE BODY ════════════════════════ -->
    <div class="page-body">

        <!-- ══ LEFT COLUMN ══ -->
        <div class="left-col">


            <!-- SPECIFICATIONS BLOCK -->
            <?php if(!empty($specs)): ?>
            <div class="block au au3">
                <div class="block-head">
                    <span class="block-head-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Technical Specifications
                    </span>
                </div>
                <div class="block-body">
                    <div class="spec-2col">
                        <?php foreach($specs as $sp): ?>
                        <div class="spec-row">
                            <div class="sk"><?= htmlspecialchars($sp['spec_key']) ?></div>
                            <div class="sv"><?= htmlspecialchars($sp['spec_value']) ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- 6. LONG DESCRIPTION -->
            <?php if(!empty($product['description'])): ?>
            <div class="mob-about">
                <div class="mob-about-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="width:13px;height:13px;color:var(--navy)">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    About This Product
                </div>
                <p class="mob-about-text"><?= htmlspecialchars($product['description']) ?></p>
            </div>
            <?php endif; ?>
            <!-- DESCRIPTION + FEATURES + APPLICATIONS TABS -->
            <div class="block au au4">
                <div class="tabs-bar">
                    <button class="tab-btn on" onclick="switchTab('desc',this)">Description</button>
                    <button class="tab-btn" onclick="switchTab('feat',this)">Features & Applications</button>
                </div>

                <!-- DESC TAB -->
                <div id="tab-desc" class="tab-pane on">
                    <p class="desc-title"><?= htmlspecialchars($product['name']) ?></p>
                    <?php if(!empty($product['description'])): ?>
                    <p class="desc-text"><?= htmlspecialchars($product['description']) ?></p>
                    <?php endif; ?>
                    <?php if(!empty($features)): ?>
                    <p
                        style="font-size:12px;font-weight:800;color:#1a1e2e;margin-bottom:12px;display:flex;align-items:center;gap:7px">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="width:14px;height:14px;color:#16a34a">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        WHY CHOOSE THIS PRODUCT
                    </p>
                    <div class="why-grid">
                        <?php foreach($features as $feat): ?>
                        <div class="why-item">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <?= htmlspecialchars($feat) ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- FEAT + APPS TAB -->
                <div id="tab-feat" class="tab-pane">
                    <div class="feat-apps">
                        <div>
                            <div class="fa-col-title blue">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Key Features
                            </div>
                            <?php foreach($features as $feat): ?>
                            <div class="fa-item">
                                <svg fill="currentColor" viewBox="0 0 20 20" style="color:#16a34a">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <?= htmlspecialchars($feat) ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div>
                            <div class="fa-col-title green">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Applications
                            </div>
                            <?php foreach($applications as $app): ?>
                            <div class="fa-item">
                                <svg fill="currentColor" viewBox="0 0 20 20" style="color:#0a2463">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <?= htmlspecialchars($app) ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RELATED PRODUCTS -->
            <?php if(!empty($related)): ?>
            <div class="block au">
                <div class="block-head">
                    <span class="block-head-title">
                        <svg fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        Related Products
                    </span>
                    <span style="font-size:11px;color:var(--faint)"><?= htmlspecialchars($product['category']) ?></span>
                </div>
                <div class="related-grid">
                    <?php foreach($related as $rel): ?>
                    <div class="r-card" onclick="window.location.href='cart.php?slug=<?= urlencode($rel['slug']) ?>'">
                        <img src="<?= htmlspecialchars($rel['image']) ?>" alt="<?= htmlspecialchars($rel['name']) ?>"
                            class="r-card-img" onerror="this.style.background='#f1f5f9'">
                        <div class="r-card-body">
                            <div class="r-card-name"><?= htmlspecialchars($rel['name']) ?></div>
                            <div class="r-card-price">
                                ₹<?= number_format($rel['price_min'],0,'.',',') ?><?= $rel['price_max']>0?' – ₹'.number_format($rel['price_max'],0,'.',','):'' ?>
                            </div>
                            <button class="r-card-btn">View Details</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>


        </div><!-- /left-col -->

        <!-- ══ RIGHT SIDEBAR ══ -->
        <div class="right-col">




            <!-- TRUST NUMBERS -->
            <div class="trust-nums au au2">
                <div class="tn-title">Why 1000+ clients trust us</div>
                <div class="tn-grid">
                    <div class="tn-item b">
                        <div class="tn-val">55+</div>
                        <div class="tn-lbl">Years Trust</div>
                    </div>
                    <div class="tn-item b">
                        <div class="tn-val">1000+</div>
                        <div class="tn-lbl">Clients</div>
                    </div>
                    <div class="tn-item b">
                        <div class="tn-val">100%</div>
                        <div class="tn-lbl">Genuine</div>
                    </div>
                </div>
            </div>

            <!-- DESCRIPTION SIDEBAR -->
            <?php if(!empty($product['description'])): ?>
            <div class="desc-card au au3">
                <div class="desc-card-title">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    About This Product
                </div>
                <p class="desc-card-text"><?= htmlspecialchars($product['description']) ?></p>
            </div>
            <?php endif; ?>

        </div><!-- /right-col -->
             <div class="block review-block au" id="reviewSection">

        <!-- Header -->
        <div class="block-head" style="background:#f0f4ff;border-bottom:1px solid #dce4ff;">
            <span class="block-head-title" style="color:#0a2463;">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width:15px;height:15px;color:#f59e0b">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Customer Reviews
            </span>
            <button class="write-review-btn" onclick="openReviewModal()">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:13px;height:13px">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Write a Review
            </button>
        </div>
        <!-- Search + Sort Toolbar -->
        <div class="rev-toolbar">
            <div class="rev-search-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" id="revSearchInput" class="rev-search-input" placeholder="Search customer reviews"
                    oninput="filterReviews()">
            </div>
            <div class="rev-sort-wrap">
                <select id="revSortSelect" class="rev-sort-select" onchange="loadReviews(1)">
                    <option value="recent">Most Recent</option>
                    <option value="highest">Highest Rating</option>
                    <option value="lowest">Lowest Rating</option>
                </select>
            </div>
        </div>
        <!-- Rating Summary -->
        <div class="review-summary" id="reviewSummary">
            <div class="rev-avg-block">
                <div class="rev-avg-num" id="revAvgNum">—</div>
                <div class="rev-stars-big" id="revStarsBig">
                    <?php for($s=1;$s<=5;$s++): ?>
                    <svg fill="currentColor" viewBox="0 0 20 20" class="rev-star-svg" style="color:#e2e8f0">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <?php endfor; ?>
                </div>
                <div class="rev-total-count" id="revTotalCount">0 Reviews</div>
            </div>
            <div class="rev-bars">
                <?php for($s=5;$s>=1;$s--): ?>
                <div class="rev-bar-row">
                    <span class="rev-bar-lbl"><?= $s ?> ★</span>
                    <div class="rev-bar-track">
                        <div class="rev-bar-fill" id="revBar<?= $s ?>" style="width:0%"></div>
                    </div>
                    <span class="rev-bar-cnt" id="revBarCnt<?= $s ?>">0</span>
                </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Reviews List -->
        <div class="review-list" id="reviewList">
            <div class="rev-loading" id="revLoading">
                <div class="rev-spinner"></div>
                <span>Loading reviews…</span>
            </div>
        </div>

        <!-- Pagination -->
        <div class="rev-pagination" id="revPagination" style="display:none">
            <button class="rev-page-btn" id="revPrevBtn" onclick="loadReviews(revPage-1)" disabled>‹
                Prev</button>
            <span class="rev-page-info" id="revPageInfo">1 of 1</span>
            <button class="rev-page-btn" id="revNextBtn" onclick="loadReviews(revPage+1)">Next ›</button>
        </div>

    </div>
    </div><!-- /page-body -->

    <!-- /review-block -->
     

    <!-- ════ WRITE REVIEW MODAL ════ -->
    <div id="reviewModal" class="rev-modal-overlay" onclick="handleRevModalClick(event)">
        <div class="rev-modal-sheet">

            <!-- Header -->
            <div class="rev-modal-hdr">
                <div>
                    <div style="font-size:11px;color:rgba(255,255,255,.6);font-weight:600;margin-bottom:2px;">
                        <?= htmlspecialchars($product['name']) ?>
                    </div>
                    <h2 style="font-size:17px;font-weight:800;display:flex;align-items:center;gap:8px;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        Write Your Review
                    </h2>
                </div>
                <button class="rev-modal-x" onclick="closeReviewModal()">✕</button>
            </div>

            <!-- Body -->
            <div class="rev-modal-body">

                <!-- Star Rating Picker -->
                <div class="rev-field">
                    <label class="rev-label">RATING <span class="rev-req">*</span></label>
                    <div class="rev-star-picker" id="starPicker">
                        <?php for($s=1;$s<=5;$s++): ?>
                        <svg data-val="<?= $s ?>" onclick="setRating(<?= $s ?>)" onmouseover="hoverRating(<?= $s ?>)"
                            onmouseout="hoverRating(0)" fill="currentColor" viewBox="0 0 20 20" class="star-pick-svg">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <?php endfor; ?>
                        <span class="rev-rating-label" id="ratingLabel">0 / 5</span>
                    </div>
                    <input type="hidden" id="selectedRating" value="0">
                </div>

                <!-- Review Text -->
                <div class="rev-field">
                    <label class="rev-label">YOUR REVIEW <span class="rev-req">*</span></label>
                    <textarea id="reviewText" class="rev-textarea"
                        placeholder="Share your experience with this product…" rows="4"></textarea>
                    <div class="rev-char-count" id="charCount">0 / 500</div>
                </div>

                <!-- Name + Email -->
                <div class="rev-row-2">
                    <div class="rev-field">
                        <label class="rev-label">NAME</label>
                        <input type="text" id="reviewName" class="rev-input" placeholder="Your name">
                    </div>
                    <div class="rev-field">
                        <label class="rev-label">EMAIL <span
                                style="color:var(--faint);font-size:9px;">(optional)</span></label>
                        <input type="email" id="reviewEmail" class="rev-input" placeholder="your@email.com">
                    </div>
                </div>

                <!-- Photo Upload -->
                <div class="rev-field">
                    <label class="rev-label">ADD PHOTO <span
                            style="color:var(--faint);font-size:9px;">(optional)</span></label>
                    <label class="rev-photo-label" id="photoLabel" for="reviewPhoto">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="width:20px;height:20px;color:#94a3b8">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span id="photoLabelText">Click to upload photo</span>
                        <input type="file" id="reviewPhoto" accept="image/*" style="display:none"
                            onchange="handlePhotoChange(this)">
                    </label>
                    <img id="photoPreview" src="" alt=""
                        style="display:none;margin-top:8px;max-height:100px;border-radius:8px;object-fit:cover;">
                </div>

                <!-- Error message -->
                <div id="revError" class="rev-error" style="display:none"></div>

                <!-- Submit Buttons -->
                <div style="display:flex;gap:10px;margin-top:4px;">
                    <button class="rev-submit-btn" id="revSubmitBtn" onclick="submitReview()">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:15px;height:15px">
                            <path stroke-linecap="round" stroke-linejo in="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Submit Review
                    </button>
                    <button class="rev-cancel-btn" onclick="closeReviewModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ════════════════════════ TRUST STRIP ════════════════════════ -->
    <div class="tstrip">
        <div class="tstrip-inner">
            <div class="ts-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg><span class="ts-text">Warranty as per Brand</span></div>
            <div class="ts-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg><span class="ts-text">100% Original Products</span></div>
            <div class="ts-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg><span class="ts-text">Secure Payments</span></div>
            <div class="ts-item"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg><span class="ts-text">100% Buyer Protection</span></div>
            <div class="ts-item" style="border-right:none"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg><span class="ts-text">Top Brands Available</span></div>
        </div>
    </div>

    <!-- ════════════════════════ MOBILE BAR ════════════════════════ -->
    <div id="mobileBar">
        <button class="mob-cart" onclick="addToCart()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            ADD TO CART
        </button>
        <button class="mob-quote" onclick="openQuoteModal()">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            REQUEST QUOTE
        </button>
    </div>

    <!-- FLOATING CART -->
    <button id="floatingCartBtn" onclick="openCheckout()">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span>Cart</span><span id="cart-count" class="cart-badge">0</span>
    </button>

    <!-- ════════════════ CHECKOUT MODAL ════════════════ -->
    <div id="checkoutModal">
        <div class="modal-sheet">
            <div class="drag-handle"></div>
            <div class="modal-hdr">
                <h2><svg style="width:20px;height:20px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>Your Cart</h2>
                <button class="modal-x" onclick="closeCheckout()">✕</button>
            </div>
            <div class="cart-items-area" id="cartItemsContainer"></div>
            <div class="cart-sum" id="checkoutSummary" style="display:none">
                <div style="display:flex;justify-content:space-between;margin-bottom:6px"><span
                        style="font-size:13px;font-weight:600;color:#64748b">Total Items</span><span
                        style="font-size:13px;font-weight:700;color:#0a2463" id="totalItems">0</span></div>
                <div style="display:flex;justify-content:space-between;margin-bottom:14px"><span
                        style="font-size:17px;font-weight:800;color:#1e293b">Grand Total</span><span
                        style="font-family:'Sora',sans-serif;font-size:26px;color:#b71c1c" id="grandTotal">₹0</span>
                </div>
                <div class="cart-btns">
                    <button class="btn-wa" onclick="proceedToWhatsApp()">
                        <svg style="width:18px;height:18px" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        Checkout via WhatsApp
                    </button>
                    <button class="btn-clr" onclick="clearCart()"><svg style="width:16px;height:16px" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg> Clear</button>
                </div>
            </div>
        </div>
    </div>

    <!-- OFFERS MODAL -->
    <div id="offersModal">
        <div class="om-sheet">
            <div class="om-hdr">
                <h3>🏷 Available Offers</h3><button onclick="closeOffersModal()" class="om-x">✕</button>
            </div>
            <div style="padding:16px">
                <?php foreach($offers as $offer): ?>
                <div class="om-item">
                    <div class="om-title"><?= htmlspecialchars($offer['icon']) ?>
                        <?= htmlspecialchars($offer['offer_text']) ?></div>
                    <?php if(!empty($offer['valid_note'])): ?><div class="om-note">
                        <?= htmlspecialchars($offer['valid_note']) ?></div><?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- LIGHTBOX -->
    <div id="imageLightbox">
        <button class="lb-x" onclick="closeLightbox()">✕</button>
        <button class="lb-nav" id="lbPrev" onclick="lightboxNav(-1)">‹</button>
        <div style="display:flex;align-items:center;justify-content:center"><img id="lightboxImg"
                src="<?= htmlspecialchars($images[0]['image_path']) ?>" alt="Zoom"></div>
        <button class="lb-nav" id="lbNext" onclick="lightboxNav(1)">›</button>
        <div class="lb-ctr" id="lbCtr">1 / <?= count($images) ?></div>
    </div>

    <!-- MINI DETAIL MODAL -->
    <div id="miniDetailModal">
        <div class="mm-sheet">
            <div
                style="background:#0a2463;color:#fff;padding:16px;display:flex;align-items:center;justify-content:space-between">
                <h3 style="font-weight:800;font-size:14px" id="miniModalTitle">Product Details</h3>
                <button onclick="closeMiniModal()"
                    style="width:28px;height:28px;background:rgba(255,255,255,.2);border:none;color:#fff;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center">✕</button>
            </div>
            <div id="miniModalBody" style="padding:16px"></div>
        </div>
    </div>

    <a href="https://wa.me/918468851160?text=Hi%2C%20I%20am%20interested%20in%20your%20products.%20Please%20share%20details."
        id="wa-float-btn" target="_blank" rel="noopener noreferrer" onclick="proceedToWhatsApp()">
        <svg fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>

    </a>

    <!-- ═══════════════════════ JAVASCRIPT (Logic 100% unchanged) ═══════════════════════ -->
    <script>
    const WHATSAPP_NUMBER = '8468851160';
    const dbProduct = <?= $productJSON ?>;
    const dbImages = <?= $imagesJSON ?>;
    const dbAllProducts = <?= $allProductsJSON ?>;

    let unitPriceValue = parseFloat(dbProduct.price_min) || 0;
    let lightboxImages = dbImages.map(i => i.image_path);
    let lightboxIndex = 0;
    let cart = [];

    function loadCartFromStorage() {
        try {
            const s = localStorage.getItem('itc_cart');
            if (s) {
                const p = JSON.parse(s);
                if (Array.isArray(p)) cart = p;
            }
        } catch (e) {
            cart = [];
        }
        updateCartCount();
    }

    function saveCartToStorage() {
        try {
            localStorage.setItem('itc_cart', JSON.stringify(cart));
        } catch (e) {}
    }
    loadCartFromStorage();

    function formatPrice(p) {
        return p.toLocaleString('en-IN');
    }

    function updateTotalPrice() {
        const qtyEl = document.getElementById('quantity');
        const qty = parseInt(qtyEl ? qtyEl.value : 1) || 1;

        const totalPriceEl = document.getElementById('product-total-price');
        if (totalPriceEl) totalPriceEl.textContent = '₹' + formatPrice(unitPriceValue * qty);

        const curQtyEl = document.getElementById('current-quantity');
        if (curQtyEl) curQtyEl.textContent = qty;

        const unitPriceEl = document.getElementById('unit-price-display');
        if (unitPriceEl) unitPriceEl.textContent = '₹' + formatPrice(unitPriceValue);

        const sd = document.getElementById('sideQtyDisplay');
        if (sd) sd.value = qty;
        const sp = document.getElementById('side-price');
        if (sp) sp.textContent = '₹' + formatPrice(unitPriceValue * qty);
        // mob-quantity sync
        const mq = document.getElementById('mob-quantity');
        if (mq) mq.value = qty;
        // mob price sync
        const mobPrice = document.querySelector('.mob-price');
        if (mobPrice) mobPrice.textContent = '₹' + formatPrice(unitPriceValue * qty);
    }

    function increaseQuantity() {
        const mob = document.getElementById('quantity');
        const hero = document.getElementById('qty-hero');
        mob.value = parseInt(mob.value) + 1;
        if (hero) hero.value = mob.value;
        updateTotalPrice();
    }

    function decreaseQuantity() {
        const mob = document.getElementById('quantity');
        const hero = document.getElementById('qty-hero');
        if (parseInt(mob.value) > 1) {
            mob.value = parseInt(mob.value) - 1;
            if (hero) hero.value = mob.value;
            updateTotalPrice();
        }
    }

    function addToCart() {
        const qty = parseInt(document.getElementById('quantity').value);
        const product = {
            name: dbProduct.name,
            subtitle: dbProduct.subtitle || '',
            category: dbProduct.category,
            image: dbImages[0]?.image_path || dbProduct.image,
            unitPrice: unitPriceValue,
            quantity: qty,
            totalPrice: unitPriceValue * qty
        };
        const idx = cart.findIndex(i => i.name === product.name);
        if (idx > -1) {
            cart[idx].quantity += qty;
            cart[idx].totalPrice = cart[idx].unitPrice * cart[idx].quantity;
        } else {
            cart.push(product);
        }
        saveCartToStorage();
        updateCartCount();
        showSuccessNotif();
    }

    function showSuccessNotif() {
        const n = document.getElementById('successNotif');
        n.classList.add('show');
        setTimeout(() => n.classList.remove('show'), 3000);
    }

    function updateCartCount() {
        const total = cart.reduce((s, i) => s + i.quantity, 0);
        ['cart-count', 'headerCartCount'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.textContent = total;
        });
        document.querySelectorAll('.hcart-badge,.cart-badge').forEach(el => el.textContent = total);
    }

    function openCheckout() {
        document.getElementById('checkoutModal').classList.add('open');
        document.body.style.overflow = 'hidden';
        renderCart();
    }

    function closeCheckout() {
        document.getElementById('checkoutModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    function renderCart() {
        const container = document.getElementById('cartItemsContainer');
        const summary = document.getElementById('checkoutSummary');
        if (!cart.length) {
            container.innerHTML =
                `<div class="empty-cart"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:64px;height:64px;margin:0 auto 16px;opacity:.3"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg><p style="font-size:17px;font-weight:800;color:#64748b;margin-bottom:6px">Your cart is empty</p><p style="font-size:13px;color:#94a3b8">Add products to get started</p></div>`;
            summary.style.display = 'none';
            return;
        }
        summary.style.display = 'block';
        container.innerHTML = cart.map((item, i) => `
        <div class="citem">
            <img src="${item.image||''}" alt="${item.name}" class="citem-img" onerror="this.style.display='none'">
            <div style="flex:1;min-width:0">
                <div class="citem-name">${item.name}</div>
                <div class="citem-sub">${item.subtitle||''}</div>
                <div class="citem-unit">₹${formatPrice(item.unitPrice)} × ${item.quantity} pcs</div>
            </div>
            <div class="citem-right">
                <div class="citem-price">₹${formatPrice(item.totalPrice)}</div>
                <button class="citem-rm" onclick="removeFromCart(${i})">Remove</button>
            </div>
        </div>`).join('');
        const totalItems = cart.reduce((s, i) => s + i.quantity, 0);
        const grandTotal = cart.reduce((s, i) => s + i.totalPrice, 0);
        document.getElementById('totalItems').textContent = totalItems + ' items';
        document.getElementById('grandTotal').textContent = '₹' + formatPrice(grandTotal);
    }

    function removeFromCart(index) {
        if (confirm('Remove this item?')) {
            cart.splice(index, 1);
            saveCartToStorage();
            updateCartCount();
            renderCart();
        }
    }

    function clearCart() {
        if (confirm('Clear all items?')) {
            cart = [];
            saveCartToStorage();
            updateCartCount();
            renderCart();
        }
    }

    function proceedToWhatsApp() {
        if (!cart.length) {
            alert('Cart is empty!');
            return;
        }
        let msg = '*🛒 NEW ORDER REQUEST*\n\n━━━━━━━━━━━━\n*📦 Cart Items:*\n━━━━━━━━━━━━\n\n';
        cart.forEach((item, i) => {
            msg +=
                `*${i+1}. ${item.name}*\n   Qty: ${item.quantity} pcs\n   Unit Price: ₹${formatPrice(item.unitPrice)}\n   Total: ₹${formatPrice(item.totalPrice)}\n\n`;
        });
        const grand = cart.reduce((s, i) => s + i.totalPrice, 0);
        msg +=
            `━━━━━━━━━━━━\n*Grand Total:* ₹${formatPrice(grand)}\n\nPlease confirm availability and delivery. Thank you! 🙏`;
        window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
    }

    function switchImage(src, thumbEl) {
        document.getElementById('product-image').src = src;
        document.querySelectorAll('#thumbRow .thumb-item').forEach(d => d.classList.remove('on'));
        thumbEl.classList.add('on');
        const idx = lightboxImages.indexOf(src);
        if (idx > -1) lightboxIndex = idx;
    }

    function openLightbox(idx = 0) {
        lightboxIndex = idx;
        updateLightboxImg();
        document.getElementById('imageLightbox').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('imageLightbox').classList.remove('open');
        document.body.style.overflow = '';
    }

    function lightboxNav(dir) {
        lightboxIndex = (lightboxIndex + dir + lightboxImages.length) % lightboxImages.length;
        updateLightboxImg();
    }

    function updateLightboxImg() {
        document.getElementById('lightboxImg').src = lightboxImages[lightboxIndex];
        document.getElementById('lbCtr').textContent = (lightboxIndex + 1) + ' / ' + lightboxImages.length;
        document.getElementById('lbPrev').style.display = lightboxImages.length > 1 ? 'flex' : 'none';
        document.getElementById('lbNext').style.display = lightboxImages.length > 1 ? 'flex' : 'none';
    }
    document.getElementById('imageLightbox').addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });

    function openOffersModal() {
        document.getElementById('offersModal').classList.add('open');
    }

    function closeOffersModal() {
        document.getElementById('offersModal').classList.remove('open');
    }
    document.getElementById('offersModal').addEventListener('click', function(e) {
        if (e.target === this) closeOffersModal();
    });

    function closeMiniModal() {
        document.getElementById('miniDetailModal').classList.remove('open');
        document.body.style.overflow = '';
    }
    document.getElementById('miniDetailModal').addEventListener('click', function(e) {
        if (e.target === this) closeMiniModal();
    });
    document.getElementById('checkoutModal').addEventListener('click', function(e) {
        if (e.target === this) closeCheckout();
    });

    function switchTab(id, btn) {
        document.querySelectorAll('.tab-pane').forEach(t => t.classList.remove('on'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('on'));
        document.getElementById('tab-' + id).classList.add('on');
        if (btn) btn.classList.add('on');
    }

    function openQuoteModal() {
        const modal = document.getElementById('quoteModal');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function buyOnChat() {
        const qty = document.getElementById('quantity').value;
        const price = unitPriceValue * parseInt(qty);
        const msg =
            `*🛒 PRODUCT ENQUIRY*\n\n*Product:* ${dbProduct.name}\n*Category:* ${dbProduct.category}\n*Qty:* ${qty} pcs\n*Price:* ₹${formatPrice(price)}\n\nPlease confirm availability and delivery. Thank you! 🙏`;
        window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeCheckout();
            closeOffersModal();
            closeLightbox();
            closeMiniModal();
        }
        if (e.key === 'ArrowLeft') lightboxNav(-1);
        if (e.key === 'ArrowRight') lightboxNav(1);
    });

    updateTotalPrice();
    </script>
    <!-- HEADER CART INJECT -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const b = document.createElement('button');
        b.id = 'headerCartBtn';
        b.onclick = openCheckout;
        b.innerHTML =
            `<svg style="width:16px;height:16px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg><span>Cart</span><span id="headerCartCount" class="hcart-badge">0</span>`;
        const sels = ['button[onclick*="openQuoteModal"]', 'a[href*="quote"]', 'header a.bg-secondary',
            'header button.bg-secondary', 'nav a[href*="quote"]'
        ];
        let q = null;
        for (const s of sels) {
            q = document.querySelector(s);
            if (q) break;
        }
        if (q) q.parentNode.replaceChild(b, q);
        else {
            const h = document.querySelector('header') || document.querySelector('nav');
            if (h) {
                const w = document.createElement('div');
                w.style.cssText = 'display:flex;align-items:center;margin-left:auto;padding-right:16px;';
                w.appendChild(b);
                h.appendChild(w);
            }
        }
        setTimeout(loadCartFromStorage, 200);
    });
    // NAYA (daal):
    function selectVariantDesktop(slug, value, btnEl) {
        document.querySelectorAll('.' + slug + ' .variant-pill-dark')
            .forEach(b => b.classList.remove('selected'));
        btnEl.classList.add('selected');
        document.querySelectorAll('.' + slug + '-label')
            .forEach(lbl => lbl.textContent = value);
    }

    function updateMobLabel(slug, value) {
        document.querySelectorAll('.' + slug + '-mob-label')
            .forEach(lbl => lbl.textContent = value);
    }
    </script>

    <script>
    (function() {
        /* ── CONFIG ── */
        const PRODUCT_ID = <?= $pid ?>;
        const HANDLER_URL = 'review_handler.php';

        /* ── STATE ── */
        let revPage = 1;
        let revTotal = 0;
        let revPer = 5;
        let selRating = 0;
        let submitting = false;

        /* ── LABELS ── */
        const RATING_LABELS = ['', 'Terrible', 'Poor', 'Average', 'Good', 'Excellent'];

        /* ═══════════════════════════════
           LOAD REVIEWS
        ═══════════════════════════════ */
        window.loadReviews = function(page) {
            page = Math.max(1, page || 1);
            revPage = page;

            const list = document.getElementById('reviewList');
            list.innerHTML =
                `<div class="rev-loading"><div class="rev-spinner"></div><span>Loading reviews…</span></div>`;

            const sortVal = document.getElementById('revSortSelect')?.value || 'recent';
            fetch(`${HANDLER_URL}?action=get&product_id=${PRODUCT_ID}&page=${page}&sort=${sortVal}`)
                .then(r => r.json())
                .then(data => {
                    if (!data.success) throw new Error(data.message || 'Error');

                    revTotal = data.total;
                    revPer = data.per;

                    /* Update summary */
                    updateSummary(data.avg, data.total, data.breakdown);

                    /* Render reviews */
                    if (!data.reviews.length && page === 1) {
                        list.innerHTML = `
                        <div class="rev-empty">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                            <p>No reviews yet</p>
                            <p>Be the first to review this product!</p>
                        </div>`;
                    } else {
                        list.innerHTML = data.reviews.map(rv => renderReviewItem(rv)).join('');
                    }

                    /* Pagination */
                    const totalPages = Math.ceil(revTotal / revPer);
                    const pg = document.getElementById('revPagination');
                    if (totalPages > 1) {
                        pg.style.display = 'flex';
                        document.getElementById('revPrevBtn').disabled = (page <= 1);
                        document.getElementById('revNextBtn').disabled = (page >= totalPages);
                        document.getElementById('revPageInfo').textContent = `${page} of ${totalPages}`;
                    } else {
                        pg.style.display = 'none';
                    }
                })
                .catch(err => {
                    document.getElementById('reviewList').innerHTML =
                        `<div class="rev-empty"><p>Failed to load reviews.</p><p>${err.message}</p></div>`;
                });
        };

        function updateSummary(avg, total, breakdown) {
            document.getElementById('revAvgNum').textContent = avg > 0 ? avg.toFixed(1) : '—';
            document.getElementById('revTotalCount').textContent = total + (total === 1 ? ' Review' : ' Reviews');

            /* Stars — bottom review block */
            const starsEl = document.getElementById('revStarsBig');
            starsEl.querySelectorAll('.rev-star-svg').forEach((s, i) => {
                s.style.color = (i + 1) <= Math.round(avg) ? '#f59e0b' : '#e2e8f0';
            });

            /* FIX: Stars — hero (desktop) + mobile badge bhi sync karo */
            if (total > 0) {
                document.querySelectorAll('.hero-rating .stars svg').forEach((s, i) => {
                    s.style.color = (i + 1) <= Math.round(avg) ? '#fbbf24' : 'rgba(255,255,255,.2)';
                });
                document.querySelectorAll('.mob-rating .stars svg').forEach((s, i) => {
                    s.style.color = (i + 1) <= Math.round(avg) ? '#fbbf24' : '#e2e8f0';
                });
            }

            /* Bars */
            for (let s = 1; s <= 5; s++) {
                const cnt = breakdown[s] || 0;
                const pct = total > 0 ? Math.round((cnt / total) * 100) : 0;
                const barEl = document.getElementById('revBar' + s);
                const cntEl = document.getElementById('revBarCnt' + s);
                if (barEl) barEl.style.width = pct + '%';
                if (cntEl) cntEl.textContent = cnt;
            }


            const ratingText = total > 0 ? avg.toFixed(1) + '/5.0' : (avg > 0 ? avg.toFixed(1) + '/5.0' : null);
            const reviewText = total > 0 ? (total === 1 ? '1 Review' : total + ' Reviews') : '';

            if (ratingText) {
                const heroR = document.getElementById('heroRatingNum');
                const mobR = document.getElementById('mobRatingNum');
                if (heroR) heroR.textContent = ratingText;
                if (mobR) mobR.textContent = ratingText;
            }

            const heroRev = document.getElementById('heroReviewCount');
            const mobRev = document.getElementById('mobReviewCount');
            if (total > 0) {
                if (heroRev) {
                    heroRev.textContent = reviewText;
                    heroRev.style.display = '';
                }
                if (mobRev) {
                    mobRev.textContent = reviewText;
                    mobRev.style.display = '';
                }
            }
        }

        function renderReviewItem(rv) {
            const initials = rv.name.trim().split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();
            const date = new Date(rv.created_at).toLocaleDateString('en-IN', {
                day: 'numeric',
                month: 'short',
                year: 'numeric'
            });
            const stars = [1, 2, 3, 4, 5].map(s =>
                `<svg fill="currentColor" viewBox="0 0 20 20" style="width:13px;height:13px;color:${s<=rv.rating?'#f59e0b':'#e2e8f0'}">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>`
            ).join('');

            const verBadge = rv.is_verified ?
                `<span class="rev-verified"><svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Verified</span>` :
                '';

            /* Photo: agar hai to avatar isi se bhar jata hai, alag photo block nahi dikhega */
            const avatarHtml = rv.photo ?
                `<img src="${escHtml(rv.photo)}" alt="${escHtml(rv.name)}">` :
                escHtml(initials);

            return `
<div class="rev-item" data-review-text="${escHtml(rv.review_text.toLowerCase())}" data-review-name="${escHtml(rv.name.toLowerCase())}">
    <div class="rev-item-hdr">
        <div style="display:flex;align-items:flex-start;gap:10px;flex:1;min-width:0;">
            <div class="rev-avatar">${avatarHtml}</div>
                    <div class="rev-name-block">
                        <div class="rev-name">
                            ${escHtml(rv.name)}
                            ${verBadge}
                        </div>
                        <div class="rev-date">${date}</div>
                    </div>
                </div>
                <div class="rev-item-stars">${stars}</div>
            </div>
         <div class="rev-text">${escHtml(rv.review_text)}</div>
        </div>`;
        }

        function escHtml(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g,
                '&quot;');
        }

        /* ═══════════════════════════════
           MODAL OPEN / CLOSE
        ═══════════════════════════════ */
        window.openReviewModal = function() {
            resetForm();
            document.getElementById('reviewModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        };

        window.closeReviewModal = function() {
            document.getElementById('reviewModal').classList.remove('open');
            document.body.style.overflow = '';
        };

        window.handleRevModalClick = function(e) {
            if (e.target === document.getElementById('reviewModal')) closeReviewModal();
        };

        function resetForm() {
            selRating = 0;
            submitting = false;
            document.getElementById('reviewText').value = '';
            document.getElementById('reviewName').value = '';
            document.getElementById('reviewEmail').value = '';
            document.getElementById('reviewPhoto').value = '';
            document.getElementById('selectedRating').value = 0;
            document.getElementById('ratingLabel').textContent = '0 / 5';
            document.getElementById('charCount').textContent = '0 / 500';
            document.getElementById('photoPreview').style.display = 'none';
            document.getElementById('photoLabelText').textContent = 'Click to upload photo';
            document.getElementById('revError').style.display = 'none';
            document.getElementById('revSubmitBtn').disabled = false;
            document.getElementById('revSubmitBtn').innerHTML =
                `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Submit Review`;
            updateStarPicker(0);
            /* Restore form if it was in success state */
            const body = document.querySelector('.rev-modal-body');
            if (body.querySelector('.rev-success')) {
                location.reload(); /* simplest — reloads reviews */
            }
        }

        /* ═══════════════════════════════
           STAR PICKER
        ═══════════════════════════════ */
        window.hoverRating = function(val) {
            const stars = document.querySelectorAll('.star-pick-svg');
            stars.forEach((s, i) => {
                s.style.color = (i + 1) <= (val || selRating) ? '#f59e0b' : '#e2e8f0';
            });
        };

        window.setRating = function(val) {
            selRating = val;
            document.getElementById('selectedRating').value = val;
            document.getElementById('ratingLabel').textContent = RATING_LABELS[val] + ' (' + val + '/5)';
            updateStarPicker(val);
        };

        function updateStarPicker(val) {
            document.querySelectorAll('.star-pick-svg').forEach((s, i) => {
                s.style.color = (i + 1) <= val ? '#f59e0b' : '#e2e8f0';
            });
        }

        /* ── CHAR COUNT ── */
        document.getElementById('reviewText').addEventListener('input', function() {
            const len = this.value.length;
            document.getElementById('charCount').textContent = len + ' / 500';
            if (len > 500) this.value = this.value.slice(0, 500);
        });

        /* ── PHOTO PREVIEW ── */
        window.handlePhotoChange = function(input) {
            if (!input.files[0]) return;
            const file = input.files[0];
            document.getElementById('photoLabelText').textContent = file.name;
            const reader = new FileReader();
            reader.onload = e => {
                const prev = document.getElementById('photoPreview');
                prev.src = e.target.result;
                prev.style.display = 'block';
            };
            reader.readAsDataURL(file);
        };

        /* ═══════════════════════════════
           SUBMIT
        ═══════════════════════════════ */
        window.submitReview = function() {
            if (submitting) return;

            const name = document.getElementById('reviewName').value.trim();
            const email = document.getElementById('reviewEmail').value.trim();
            const text = document.getElementById('reviewText').value.trim();
            const rating = parseInt(document.getElementById('selectedRating').value);
            const photo = document.getElementById('reviewPhoto').files[0];

            /* Client-side validation */
            let err = '';
            if (rating < 1 || rating > 5) err = 'Please select a rating (1–5 stars).';
            else if (text.length < 10) err = 'Review must be at least 10 characters.';
            else if (name.length < 2) err = 'Please enter your name.';
            else if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) err = 'Please enter a valid email.';

            if (err) {
                const errEl = document.getElementById('revError');
                errEl.textContent = err;
                errEl.style.display = 'block';
                errEl.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
                return;
            }

            document.getElementById('revError').style.display = 'none';
            submitting = true;
            const btn = document.getElementById('revSubmitBtn');
            btn.disabled = true;
            btn.innerHTML =
                `<div class="rev-spinner" style="border-top-color:#fff;width:14px;height:14px;border-width:2px;margin:0;"></div> Submitting…`;

            const fd = new FormData();
            fd.append('product_id', PRODUCT_ID);
            fd.append('name', name);
            fd.append('email', email);
            fd.append('rating', rating);
            fd.append('review_text', text);
            if (photo) fd.append('photo', photo);

            fetch(HANDLER_URL, {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        /* Show success */
                        const body = document.querySelector('.rev-modal-body');
                        body.innerHTML = `
                        <div class="rev-success">
                            <div class="rev-success-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3>Thank You! 🎉</h3>
                            <p>${data.message}</p>
                            <button onclick="closeReviewModal();loadReviews(1);" style="margin-top:18px;background:#0a2463;color:#fff;border:none;padding:11px 28px;border-radius:20px;font-size:13px;font-weight:800;cursor:pointer;font-family:'Sora',sans-serif;">
                                View Reviews
                            </button>
                        </div>`;
                    } else {
                        submitting = false;
                        btn.disabled = false;
                        btn.innerHTML =
                            `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:15px;height:15px"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Submit Review`;
                        const errEl = document.getElementById('revError');
                        if (errEl) {
                            errEl.textContent = data.message;
                            errEl.style.display = 'block';
                        }
                    }
                })
                .catch(() => {
                    submitting = false;
                    btn.disabled = false;
                    btn.innerHTML = `Submit Review`;
                    alert('Network error. Please try again.');
                });
        };

        /* ── INIT ── */
        loadReviews(1);

    })();
    window.filterReviews = function() {
        const q = (document.getElementById('revSearchInput').value || '').toLowerCase().trim();
        const items = document.querySelectorAll('#reviewList .rev-item');
        let visibleCount = 0;
        items.forEach(item => {
            const text = item.getAttribute('data-review-text') || '';
            const name = item.getAttribute('data-review-name') || '';
            const match = !q || text.includes(q) || name.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        const list = document.getElementById('reviewList');
        let noMatchEl = document.getElementById('revNoMatch');
        if (visibleCount === 0 && items.length > 0) {
            if (!noMatchEl) {
                noMatchEl = document.createElement('div');
                noMatchEl.id = 'revNoMatch';
                noMatchEl.className = 'rev-empty';
                noMatchEl.innerHTML = '<p>No matching reviews</p><p>Try a different search term</p>';
                list.appendChild(noMatchEl);
            }
            noMatchEl.style.display = '';
        } else if (noMatchEl) {
            noMatchEl.style.display = 'none';
        }
    };
    </script>





    <?php include 'assets/include/footer.php'; ?>
</body>

</html>