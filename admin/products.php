<?php
session_start();
require_once '../assets/include/config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php'); exit;
}

$pdo = getDB();
$msg = '';
$msgType = '';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ── ADD ──────────────────────────────────────────────────
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $subcategory_id  = (int)($_POST['subcategory_id']  ?? 0);
    $subcategory2_id = (int)($_POST['subcategory2_id'] ?? 0);
    $name            = trim($_POST['name']        ?? '');
    $slug            = trim($_POST['slug']        ?? '');
    $subtitle        = trim($_POST['subtitle']    ?? '');
    $description     = trim($_POST['description'] ?? '');
    $badge           = trim($_POST['badge']       ?? '');
    $badge_color     = trim($_POST['badge_color'] ?? '');
    $price_min       = floatval($_POST['price_min']    ?? 0);
    $price_max       = floatval($_POST['price_max']    ?? 0);
    $mrp             = floatval($_POST['mrp']          ?? 0);
    $gst_percent     = floatval($_POST['gst_percent']  ?? 18);
    $in_stock        = isset($_POST['in_stock'])   ? 1 : 0;
    $stock_label     = trim($_POST['stock_label']  ?? 'In Stock');
    $best_price      = isset($_POST['best_price']) ? 1 : 0;
    $min_order       = (int)($_POST['min_order']       ?? 1);
    $min_order_unit  = trim($_POST['min_order_unit']   ?? 'Piece');
    $delivery_days   = trim($_POST['delivery_days']    ?? '3-5 Days');
    $warranty        = trim($_POST['warranty']         ?? 'Mfr. Terms');
    $certification   = trim($_POST['certification']    ?? 'ISO • IBR');
    $ships_within    = trim($_POST['ships_within']     ?? 'Ships within 24 hrs');
    $rating          = floatval($_POST['rating']       ?? 4.8);
    $orders_count    = trim($_POST['orders_count']     ?? '1000+');
    $sort            = (int)($_POST['sort_order']      ?? 0);
    $active          = isset($_POST['is_active']) ? 1 : 0;
    $image           = '';

    // Fetch category name from subcategory
    $catRow = null;
    if ($subcategory_id) {
        $cs = $pdo->prepare("SELECT c.name FROM menu_subcategories s JOIN menu_categories c ON s.category_id=c.id WHERE s.id=?");
        $cs->execute([$subcategory_id]);
        $catRow = $cs->fetchColumn();
    }
    $category = $catRow ?: '';

    if (!$name || !$subcategory_id) {
        $msg = 'Product name and subcategory are required.'; $msgType = 'error';
    } else {
        if (!$slug) $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));

        // Image upload
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../assets/images/products/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
                $filename = $slug . '-' . time() . '.' . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                    $image = '/assets/images/products/' . $filename;
                }
            } else {
                $msg = 'Invalid image format (jpg/png/webp/gif only).'; $msgType = 'error';
            }
        }

        if ($msgType !== 'error') {
            try {
                $sub2val = $subcategory2_id > 0 ? $subcategory2_id : null;
                $stmt = $pdo->prepare("INSERT INTO products
                    (subcategory_id, subcategory2_id, name, slug, subtitle, description, image,
                     category, badge, badge_color,
                     price_min, price_max, mrp, gst_percent,
                     in_stock, stock_label, best_price,
                     min_order, min_order_unit, delivery_days,
                     warranty, certification, ships_within,
                     rating, orders_count, sort_order, is_active)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->execute([
                    $subcategory_id, $sub2val, $name, $slug, $subtitle, $description, $image,
                    $category, $badge, $badge_color,
                    $price_min, $price_max, $mrp, $gst_percent,
                    $in_stock, $stock_label, $best_price,
                    $min_order, $min_order_unit, $delivery_days,
                    $warranty, $certification, $ships_within,
                    $rating, $orders_count, $sort, $active
                ]);
                @unlink('../assets/cache/menu_tree.json');
                $msg = "Product '<strong>$name</strong>' added successsfully!"; $msgType = 'success';
            } catch (Exception $e) {
                $msg = 'Error: ' . $e->getMessage(); $msgType = 'error';
            }
        }
    }
}

// ── EDIT ─────────────────────────────────────────────────
if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id              = (int)($_POST['id']             ?? 0);
    $subcategory_id  = (int)($_POST['subcategory_id']  ?? 0);
    $subcategory2_id = (int)($_POST['subcategory2_id'] ?? 0);
    $name            = trim($_POST['name']        ?? '');
    $slug            = trim($_POST['slug']        ?? '');
    $subtitle        = trim($_POST['subtitle']    ?? '');
    $description     = trim($_POST['description'] ?? '');
    $badge           = trim($_POST['badge']       ?? '');
    $badge_color     = trim($_POST['badge_color'] ?? '');
    $price_min       = floatval($_POST['price_min']    ?? 0);
    $price_max       = floatval($_POST['price_max']    ?? 0);
    $mrp             = floatval($_POST['mrp']          ?? 0);
    $gst_percent     = floatval($_POST['gst_percent']  ?? 18);
    $in_stock        = isset($_POST['in_stock'])   ? 1 : 0;
    $stock_label     = trim($_POST['stock_label']  ?? 'In Stock');
    $best_price      = isset($_POST['best_price']) ? 1 : 0;
    $min_order       = (int)($_POST['min_order']       ?? 1);
    $min_order_unit  = trim($_POST['min_order_unit']   ?? 'Piece');
    $delivery_days   = trim($_POST['delivery_days']    ?? '3-5 Days');
    $warranty        = trim($_POST['warranty']         ?? 'Mfr. Terms');
    $certification   = trim($_POST['certification']    ?? 'ISO • IBR');
    $ships_within    = trim($_POST['ships_within']     ?? 'Ships within 24 hrs');
    $rating          = floatval($_POST['rating']       ?? 4.8);
    $orders_count    = trim($_POST['orders_count']     ?? '1000+');
    $sort            = (int)($_POST['sort_order']      ?? 0);
    $active          = isset($_POST['is_active']) ? 1 : 0;

    if (!$name || !$id || !$subcategory_id) {
        $msg = 'Invalid data.'; $msgType = 'error';
    } else {
        if (!$slug) $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));

        // Fetch category
        $cs = $pdo->prepare("SELECT c.name FROM menu_subcategories s JOIN menu_categories c ON s.category_id=c.id WHERE s.id=?");
        $cs->execute([$subcategory_id]);
        $category = $cs->fetchColumn() ?: '';

        // Existing image
        $ex = $pdo->prepare("SELECT image FROM products WHERE id=?");
        $ex->execute([$id]);
        $image = $ex->fetchColumn();

        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../assets/images/products/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','webp','gif'])) {
                $filename = $slug . '-' . time() . '.' . $ext;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                    if ($image && file_exists('../' . ltrim($image, '/'))) @unlink('../' . ltrim($image, '/'));
                    $image = '/assets/images/products/' . $filename;
                }
            }
        }

        try {
            $sub2val = $subcategory2_id > 0 ? $subcategory2_id : null;
            $stmt = $pdo->prepare("UPDATE products SET
                subcategory_id=?, subcategory2_id=?, name=?, slug=?, subtitle=?, description=?, image=?,
                category=?, badge=?, badge_color=?,
                price_min=?, price_max=?, mrp=?, gst_percent=?,
                in_stock=?, stock_label=?, best_price=?,
                min_order=?, min_order_unit=?, delivery_days=?,
                warranty=?, certification=?, ships_within=?,
                rating=?, orders_count=?, sort_order=?, is_active=?
                WHERE id=?");
            $stmt->execute([
                $subcategory_id, $sub2val, $name, $slug, $subtitle, $description, $image,
                $category, $badge, $badge_color,
                $price_min, $price_max, $mrp, $gst_percent,
                $in_stock, $stock_label, $best_price,
                $min_order, $min_order_unit, $delivery_days,
                $warranty, $certification, $ships_within,
                $rating, $orders_count, $sort, $active,
                $id
            ]);
            @unlink('../assets/cache/menu_tree.json');
            $msg = "Product updated successf!"; $msgType = 'success';
        } catch (Exception $e) {
            $msg = 'Error: ' . $e->getMessage(); $msgType = 'error';
        }
    }
}

// ── DELETE ───────────────────────────────────────────────
if ($action === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    try {
        $r = $pdo->prepare("SELECT image FROM products WHERE id=?");
        $r->execute([$id]); $img = $r->fetchColumn();
        $pdo->prepare("DELETE FROM products WHERE id=?")->execute([$id]);
        $pdo->prepare("DELETE FROM menu_product_specs WHERE product_id=?")->execute([$id]);
        if ($img && file_exists('../' . ltrim($img, '/'))) @unlink('../' . ltrim($img, '/'));
        @unlink('../assets/cache/menu_tree.json');
        $msg = 'Product deleted successfully!'; $msgType = 'success';
    } catch (Exception $e) {
        $msg = 'Error: ' . $e->getMessage(); $msgType = 'error';
    }
}

// ── TOGGLE ───────────────────────────────────────────────
if ($action === 'toggle' && isset($_GET['id'])) {
    $pdo->prepare("UPDATE products SET is_active = 1 - is_active WHERE id=?")->execute([(int)$_GET['id']]);
    @unlink('../assets/cache/menu_tree.json');
    header('Location: products.php?msg=toggled'); exit;
}

// ── FETCH DATA ────────────────────────────────────────────
$allCats = $pdo->query("SELECT id, name FROM menu_categories WHERE is_active=1 ORDER BY sort_order, name")->fetchAll();

$allSubs = $pdo->query("
    SELECT s.id, s.name, s.category_id, c.name AS cat_name
    FROM menu_subcategories s JOIN menu_categories c ON s.category_id=c.id
    WHERE s.is_active=1 ORDER BY c.sort_order, s.sort_order, s.name
")->fetchAll();

$allSub2s = $pdo->query("
    SELECT s2.id, s2.name, s2.subcategory_id, s.name AS sub_name
    FROM menu_subcategories2 s2 JOIN menu_subcategories s ON s2.subcategory_id=s.id
    WHERE s2.is_active=1 ORDER BY s2.sort_order, s2.name
")->fetchAll();

// Filters
$filterCat  = isset($_GET['cat'])  ? (int)$_GET['cat']  : 0;
$filterSub  = isset($_GET['sub'])  ? (int)$_GET['sub']  : 0;
$filterSub2 = isset($_GET['sub2']) ? (int)$_GET['sub2'] : 0;
$search     = trim($_GET['search'] ?? '');

$where = []; $params = [];
if ($filterSub2) { $where[] = 'p.subcategory2_id=?'; $params[] = $filterSub2; }
elseif ($filterSub) { $where[] = 'p.subcategory_id=?'; $params[] = $filterSub; }
elseif ($filterCat) { $where[] = 'c.id=?'; $params[] = $filterCat; }
if ($search) { $where[] = 'p.name LIKE ?'; $params[] = "%$search%"; }
$whereSQL = $where ? 'WHERE '.implode(' AND ', $where) : '';

$stmt = $pdo->prepare("
    SELECT p.*, s.name AS sub_name, c.name AS cat_name, c.id AS cat_id,
           s2.name AS sub2_name,
           (SELECT COUNT(*) FROM menu_product_specs WHERE product_id=p.id) AS spec_count
    FROM products p
    JOIN menu_subcategories s ON p.subcategory_id=s.id
    JOIN menu_categories c ON s.category_id=c.id
    LEFT JOIN menu_subcategories2 s2 ON p.subcategory2_id=s2.id
    $whereSQL
    ORDER BY c.sort_order, s.sort_order, p.sort_order, p.id
");
$stmt->execute($params);
$products = $stmt->fetchAll();

$totalProds  = count($products);
$activeProds = count(array_filter($products, fn($p) => $p['is_active']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - ITC Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { primary: '#b71c1c', secondary: '#0a2463' } } } }</script>
    <style>
        .sidebar { width:260px; min-height:100vh; background:linear-gradient(180deg,#0a2463 0%,#0d2d7a 100%); }
        .sidebar-link { display:flex;align-items:center;gap:10px;padding:10px 16px;border-radius:10px;color:rgba(255,255,255,0.7);font-weight:600;font-size:13px;transition:all 0.2s;text-decoration:none;margin-bottom:2px; }
        .sidebar-link:hover,.sidebar-link.active { background:rgba(255,255,255,0.12);color:white; }
        .sidebar-link.active { background:rgba(255,255,255,0.15);border-left:3px solid #f59e0b;padding-left:13px;color:white; }
        .main-content { flex:1;background:#f1f5f9;min-height:100vh;overflow-x:hidden; }
        .topbar { background:white;border-bottom:2px solid #e2e8f0;padding:0 24px;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:30;box-shadow:0 1px 8px rgba(0,0,0,0.06); }
        .sidebar-section { font-size:10px;font-weight:800;color:rgba(255,255,255,0.3);letter-spacing:0.1em;text-transform:uppercase;padding:16px 16px 6px; }
        .modal-overlay { display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:100;align-items:center;justify-content:center;padding:16px; }
        .modal-overlay.open { display:flex; }
        @keyframes fadeIn { from{opacity:0;transform:scale(0.95)} to{opacity:1;transform:scale(1)} }
        .modal-box { animation:fadeIn 0.2s ease;max-height:90vh;overflow-y:auto; }
        .badge-active { background:#dcfce7;color:#166534;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px; }
        .badge-inactive { background:#fee2e2;color:#991b1b;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px; }
        .form-label { display:block;font-size:11px;font-weight:700;color:#475569;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.05em; }
        .form-input { width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;box-sizing:border-box;transition:border-color 0.2s; }
        .form-input:focus { border-color:#0a2463; }
        .form-row { display:grid;gap:12px;margin-bottom:13px; }
        .form-row-2 { grid-template-columns:1fr 1fr; }
        .form-row-3 { grid-template-columns:1fr 1fr 1fr; }
        @media(max-width:768px){.sidebar{display:none}.sidebar.open{display:flex;flex-direction:column;position:fixed;z-index:50;height:100vh;overflow-y:auto;}}
    </style>
</head>
<body class="bg-gray-100">
<div style="display:flex;">

<!-- SIDEBAR -->
<div class="sidebar flex flex-col" id="sidebar">
    <div style="padding:20px 16px;border-bottom:1px solid rgba(255,255,255,0.1);">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:40px;height:40px;background:rgba(255,255,255,0.15);border-radius:10px;display:flex;align-items:center;justify-content:center;">
                <svg style="width:22px;height:22px;color:white;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <div style="font-weight:800;color:white;font-size:14px;">Indian Traders</div>
                <div style="font-size:10px;color:rgba(255,255,255,0.5);font-weight:600;">Admin Panel</div>
            </div>
        </div>
    </div>
    <nav style="flex:1;padding:12px 10px;overflow-y:auto;">
        <div class="sidebar-section">Main</div>
        <a href="index.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
            Dashboard
        </a>
        <div class="sidebar-section">Menu Structure</div>
        <a href="categories.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h7"/></svg>
            Categories
        </a>
        <a href="subcategories.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            Subcategories
        </a>
        <a href="subcategories2.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            Subcategories 2
        </a>
        <div class="sidebar-section">Products</div>
        <a href="products.php" class="sidebar-link active">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            All Products
        </a>
        <div class="sidebar-section">Details</div>
        <a href="specifications.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Specifications
        </a>
        <a href="features.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Features
        </a>
        <a href="applications.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            Applications
        </a>
        <a href="offers.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            Offers
        </a>
        <a href="images.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            Product Images
        </a>
        <div class="sidebar-section">System</div>
        <a href="../index.php" target="_blank" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            View Website
        </a>
        <a href="logout.php" class="sidebar-link" style="color:rgba(255,150,150,0.8);">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Logout
        </a>
    </nav>
    <div style="padding:12px 16px;border-top:1px solid rgba(255,255,255,0.1);display:flex;align-items:center;gap:10px;">
        <div style="width:32px;height:32px;background:#b71c1c;border-radius:8px;display:flex;align-items:center;justify-content:center;font-weight:800;color:white;font-size:13px;">A</div>
        <div>
            <div style="font-size:12px;font-weight:700;color:white;"><?php echo htmlspecialchars($_SESSION['admin_user'] ?? 'Admin'); ?></div>
            <div style="font-size:10px;color:rgba(255,255,255,0.4);">Administrator</div>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="main-content">
    <!-- TOPBAR -->
    <div class="topbar">
        <div style="display:flex;align-items:center;gap:12px;">
            <button onclick="document.getElementById('sidebar').classList.toggle('open')" style="background:none;border:none;cursor:pointer;padding:4px;">
                <svg style="width:20px;height:20px;color:#0a2463" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div>
                <h1 style="font-size:16px;font-weight:800;color:#0a2463;">Products</h1>
                <p style="font-size:11px;color:#94a3b8;font-weight:500;">Manage all products</p>
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
            <a href="../index.php" target="_blank" style="font-size:12px;font-weight:700;color:#0a2463;border:2px solid #0a2463;padding:6px 14px;border-radius:8px;text-decoration:none;">View Site</a>
            <a href="logout.php" style="font-size:12px;font-weight:700;color:white;background:#b71c1c;padding:6px 14px;border-radius:8px;text-decoration:none;">Logout</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div style="padding:24px;">

        <?php if ($msg): ?>
        <div style="padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:13px;font-weight:600;
            <?= $msgType==='success' ? 'background:#dcfce7;color:#166534;border:1px solid #bbf7d0;' : 'background:#fee2e2;color:#991b1b;border:1px solid #fecaca;' ?>">
            <?= $msg ?>
        </div>
        <?php endif; ?>

        <!-- Stats + Add -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <div style="background:white;border-radius:12px;padding:14px 20px;border:1px solid #e2e8f0;min-width:110px;">
                    <div style="font-size:22px;font-weight:800;color:#0a2463;"><?= $totalProds ?></div>
                    <div style="font-size:11px;color:#94a3b8;font-weight:600;">Total Products</div>
                </div>
                <div style="background:white;border-radius:12px;padding:14px 20px;border:1px solid #e2e8f0;min-width:110px;">
                    <div style="font-size:22px;font-weight:800;color:#16a34a;"><?= $activeProds ?></div>
                    <div style="font-size:11px;color:#94a3b8;font-weight:600;">Active</div>
                </div>
                <div style="background:white;border-radius:12px;padding:14px 20px;border:1px solid #e2e8f0;min-width:110px;">
                    <div style="font-size:22px;font-weight:800;color:#dc2626;"><?= $totalProds - $activeProds ?></div>
                    <div style="font-size:11px;color:#94a3b8;font-weight:600;">Inactive</div>
                </div>
            </div>
            <button onclick="openAddModal()" style="background:#0a2463;color:white;font-size:13px;font-weight:700;padding:10px 20px;border-radius:10px;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
                <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Product
            </button>
        </div>

        <!-- Filters -->
        <div style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:16px;margin-bottom:16px;">
            <form method="GET" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search products..."
                       style="flex:1;min-width:150px;padding:8px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;outline:none;">
                <select name="cat" id="fCat" onchange="fFilterSubs()" style="padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;outline:none;background:white;color:#334155;font-weight:600;">
                    <option value="">All Categories</option>
                    <?php foreach ($allCats as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $filterCat==$c['id']?'selected':'' ?>><?= htmlspecialchars($c['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="sub" id="fSub" onchange="fFilterSub2s()" style="padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;outline:none;background:white;color:#334155;font-weight:600;">
                    <option value="">All Subcategories</option>
                    <?php foreach ($allSubs as $s): ?>
                    <option value="<?= $s['id'] ?>" data-cat="<?= $s['category_id'] ?>" <?= $filterSub==$s['id']?'selected':'' ?>>[<?= htmlspecialchars($s['cat_name']) ?>] <?= htmlspecialchars($s['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="sub2" id="fSub2" style="padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;outline:none;background:white;color:#334155;font-weight:600;">
                    <option value="">All Sub2</option>
                    <?php foreach ($allSub2s as $s2): ?>
                    <option value="<?= $s2['id'] ?>" data-sub="<?= $s2['subcategory_id'] ?>" <?= $filterSub2==$s2['id']?'selected':'' ?>>[<?= htmlspecialchars($s2['sub_name']) ?>] <?= htmlspecialchars($s2['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" style="background:#0a2463;color:white;padding:8px 18px;border-radius:8px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Filter</button>
                <?php if ($search||$filterSub||$filterSub2||$filterCat): ?>
                <a href="products.php" style="padding:8px 14px;border-radius:8px;border:1.5px solid #e2e8f0;font-size:13px;color:#64748b;text-decoration:none;font-weight:600;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Table -->
        <div style="background:white;border-radius:16px;border:1px solid #e2e8f0;overflow:hidden;">
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                            <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">#</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Image</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Product</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Category Path</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Price</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Specs</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Sort</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Status</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                        <tr><td colspan="9" style="padding:48px;text-align:center;color:#94a3b8;font-size:14px;">
                            No product found
                            <button onclick="openAddModal()" style="display:block;margin:12px auto 0;background:#0a2463;color:white;padding:8px 18px;border-radius:8px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Add first product</button>
                        </td></tr>
                        <?php else: ?>
                        <?php foreach ($products as $i => $prod): ?>
                        <?php
                            $imgSrc = !empty($prod['image']) ? '../' . ltrim($prod['image'], '/') : '../assets/images/Gate-Valve-1.png';
                        ?>
                        <tr style="border-bottom:1px solid #f1f5f9;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                            <td style="padding:12px 16px;font-size:13px;font-weight:700;color:#94a3b8;"><?= $i+1 ?></td>
                            <td style="padding:12px 16px;">
                                <img src="<?= htmlspecialchars($imgSrc) ?>"
                                     style="width:52px;height:52px;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;background:#f8faff;padding:3px;"
                                     onerror="this.src='../assets/images/Gate-Valve-1.png'">
                            </td>
                            <td style="padding:12px 16px;max-width:220px;">
                                <div style="font-size:13px;font-weight:700;color:#1e293b;line-height:1.3;"><?= htmlspecialchars($prod['name']) ?></div>
                                <?php if (!empty($prod['subtitle'])): ?>
                                <div style="font-size:11px;color:#94a3b8;margin-top:2px;"><?= htmlspecialchars(substr($prod['subtitle'],0,45)) ?><?= strlen($prod['subtitle'])>45?'...':'' ?></div>
                                <?php endif; ?>
                                <code style="font-size:10px;color:#94a3b8;"><?= htmlspecialchars($prod['slug']) ?></code>
                                <?php if (!empty($prod['badge'])): ?>
                                <span style="margin-left:4px;background:#fef3c7;color:#92400e;font-size:10px;font-weight:700;padding:1px 7px;border-radius:10px;"><?= htmlspecialchars($prod['badge']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td style="padding:12px 16px;">
                                <div style="display:flex;align-items:center;gap:4px;flex-wrap:wrap;">
                                    <span style="background:#e0e7ff;color:#0a2463;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;"><?= htmlspecialchars($prod['cat_name']) ?></span>
                                    <span style="color:#94a3b8;">›</span>
                                    <span style="background:#fef3c7;color:#92400e;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;"><?= htmlspecialchars($prod['sub_name']) ?></span>
                                    <?php if (!empty($prod['sub2_name'])): ?>
                                    <span style="color:#94a3b8;">›</span>
                                    <span style="background:#f0fdf4;color:#166534;font-size:11px;font-weight:700;padding:2px 8px;border-radius:20px;border:1px solid #bbf7d0;"><?= htmlspecialchars($prod['sub2_name']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td style="padding:12px 16px;text-align:center;">
                                <?php if ($prod['price_min'] > 0): ?>
                                <div style="font-size:13px;font-weight:800;color:#b71c1c;">₹<?= number_format($prod['price_min'],0,'.',',') ?></div>
                                <?php if ($prod['price_max'] > 0): ?>
                                <div style="font-size:10px;color:#94a3b8;">– ₹<?= number_format($prod['price_max'],0,'.',',') ?></div>
                                <?php endif; ?>
                                <?php else: ?>
                                <span style="font-size:11px;color:#94a3b8;">—</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding:12px 16px;text-align:center;">
                                <a href="specifications.php?product_id=<?= $prod['id'] ?>"
                                   style="display:inline-block;background:#fef3c7;color:#92400e;font-size:12px;font-weight:700;padding:4px 10px;border-radius:20px;text-decoration:none;">
                                    <?= $prod['spec_count'] ?> specs
                                </a>
                            </td>
                            <td style="padding:12px 16px;text-align:center;font-size:13px;font-weight:700;color:#64748b;"><?= $prod['sort_order'] ?></td>
                            <td style="padding:12px 16px;text-align:center;">
                                <a href="products.php?action=toggle&id=<?= $prod['id'] ?>" onclick="return confirm('Toggle status?')"
                                   class="<?= $prod['is_active'] ? 'badge-active' : 'badge-inactive' ?>">
                                    <?= $prod['is_active'] ? 'Active' : 'Inactive' ?>
                                </a>
                            </td>
                            <td style="padding:12px 16px;text-align:center;">
                                <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;">
                                    <button onclick='openEditModal(<?= json_encode($prod) ?>)'
                                            style="background:#e0e7ff;color:#0a2463;border:none;padding:6px 10px;border-radius:8px;font-size:12px;font-weight:700;cursor:pointer;">✏️ Edit</button>
                                    <a href="specifications.php?product_id=<?= $prod['id'] ?>"
                                       style="background:#fef3c7;color:#92400e;padding:6px 10px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;">📋 Specs</a>
                                    <a href="products.php?action=delete&id=<?= $prod['id'] ?>"
                                       onclick="return confirm('Delete \'<?= addslashes($prod['name']) ?>\'? This cannot be undone!!')"
                                       style="background:#fee2e2;color:#991b1b;padding:6px 10px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;">🗑️</a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /content -->
</div><!-- /main -->
</div><!-- /flex -->

<!-- ══════════════════════════════════════════
     ADD MODAL
══════════════════════════════════════════ -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box" style="background:white;border-radius:20px;width:100%;max-width:700px;padding:28px;box-shadow:0 32px 80px rgba(0,0,0,0.2);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <h2 style="font-size:18px;font-weight:800;color:#0a2463;">Add New Product</h2>
            <button onclick="closeAddModal()" style="background:#f1f5f9;border:none;border-radius:8px;padding:6px 10px;cursor:pointer;font-size:16px;">✕</button>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">

            <!-- Category Filter + Sub + Sub2 -->
            <div class="form-row form-row-2">
                <div>
                    <label class="form-label">Filter by Category</label>
                    <select id="addCatF" onchange="mFilterSubs('add')"
                            style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;background:white;box-sizing:border-box;">
                        <option value="">All Categories</option>
                        <?php foreach ($allCats as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Subcategory *</label>
                    <select name="subcategory_id" id="addSubF" required onchange="mFilterSub2s('add')"
                            style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;background:white;box-sizing:border-box;">
                        <option value="">-- Select Subcategory--</option>
                        <?php foreach ($allSubs as $s): ?>
                        <option value="<?= $s['id'] ?>" data-cat="<?= $s['category_id'] ?>">[<?= htmlspecialchars($s['cat_name']) ?>] <?= htmlspecialchars($s['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div style="margin-bottom:13px;">
                <label class="form-label">Subcategory2 <span style="font-weight:400;color:#94a3b8;text-transform:none;">(Optional)</span></label>
                <select name="subcategory2_id" id="addSub2F"
                        style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;background:white;box-sizing:border-box;">
                    <option value="">-- None (3-level) --</option>
                    <?php foreach ($allSub2s as $s2): ?>
                    <option value="<?= $s2['id'] ?>" data-sub="<?= $s2['subcategory_id'] ?>">[<?= htmlspecialchars($s2['sub_name']) ?>] <?= htmlspecialchars($s2['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Name + Slug -->
            <div class="form-row form-row-2">
                <div>
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="name" id="addName" required oninput="autoSlug(this.value,'addSlug')" placeholder="e.g. Gate Valve PN16" class="form-input">
                </div>
                <div>
                    <label class="form-label">Slug (auto)</label>
                    <input type="text" name="slug" id="addSlug" class="form-input" style="background:#f8fafc;color:#64748b;">
                </div>
            </div>

            <!-- Subtitle + Description -->
            <div style="margin-bottom:13px;">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" placeholder="e.g. PN16 Series - Rising Stem" class="form-input">
            </div>
            <div style="margin-bottom:13px;">
                <label class="form-label">Description</label>
                <textarea name="description" style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;box-sizing:border-box;resize:vertical;min-height:70px;" placeholder="Product description..."></textarea>
            </div>

            <!-- Pricing -->
            <div class="form-row form-row-3">
                <div>
                    <label class="form-label">Min Price (₹)</label>
                    <input type="number" name="price_min" value="0" step="0.01" class="form-input" style="color:#b71c1c;font-weight:700;">
                </div>
                <div>
                    <label class="form-label">Max Price (₹)</label>
                    <input type="number" name="price_max" value="0" step="0.01" class="form-input" style="color:#b71c1c;font-weight:700;">
                </div>
                <div>
                    <label class="form-label">MRP (₹)</label>
                    <input type="number" name="mrp" value="0" step="0.01" class="form-input">
                </div>
            </div>

            <div class="form-row form-row-3">
                <div>
                    <label class="form-label">GST %</label>
                    <input type="number" name="gst_percent" value="18" step="0.01" class="form-input">
                </div>
                <div>
                    <label class="form-label">Min Order</label>
                    <input type="number" name="min_order" value="1" min="1" class="form-input">
                </div>
                <div>
                    <label class="form-label">Min Order Unit</label>
                    <input type="text" name="min_order_unit" value="Piece" class="form-input">
                </div>
            </div>

            <!-- Delivery fields -->
            <div class="form-row form-row-2">
                <div>
                    <label class="form-label">Delivery Days</label>
                    <input type="text" name="delivery_days" value="3-5 Days" class="form-input">
                </div>
                <div>
                    <label class="form-label">Ships Within</label>
                    <input type="text" name="ships_within" value="Ships within 24 hrs" class="form-input">
                </div>
            </div>
            <div class="form-row form-row-3">
                <div>
                    <label class="form-label">Warranty</label>
                    <input type="text" name="warranty" value="Mfr. Terms" class="form-input">
                </div>
                <div>
                    <label class="form-label">Certification</label>
                    <input type="text" name="certification" value="ISO • IBR" class="form-input">
                </div>
                <div>
                    <label class="form-label">Rating</label>
                    <input type="number" name="rating" value="4.8" step="0.1" min="0" max="5" class="form-input">
                </div>
            </div>
            <div class="form-row form-row-2">
                <div>
                    <label class="form-label">Orders Count</label>
                    <input type="text" name="orders_count" value="1000+" class="form-input">
                </div>
                <div>
                    <label class="form-label">Stock Label</label>
                    <input type="text" name="stock_label" value="In Stock" class="form-input">
                </div>
            </div>

            <!-- Badge + Badge Color + Sort -->
            <div class="form-row form-row-3">
                <div>
                    <label class="form-label">Badge Text</label>
                    <input type="text" name="badge" placeholder="IBR, HOT, NEW..." class="form-input">
                </div>
                <div>
                    <label class="form-label">Badge Color</label>
                    <input type="text" name="badge_color" placeholder="bg-orange-600" class="form-input">
                </div>
                <div>
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="0" min="0" class="form-input">
                </div>
            </div>

            <!-- Image -->
            <div style="margin-bottom:13px;">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" accept="image/*" onchange="previewImg(this,'addImgPrev')"
                       style="width:100%;padding:8px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;box-sizing:border-box;">
                <img id="addImgPrev" src="" style="display:none;margin-top:8px;width:80px;height:80px;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;background:#f8faff;">
            </div>

            <!-- Checkboxes -->
            <div style="margin-bottom:16px;display:flex;gap:20px;flex-wrap:wrap;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:600;color:#475569;">
                    <input type="checkbox" name="in_stock" checked style="width:15px;height:15px;accent-color:#16a34a;"> In Stock
                </label>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:600;color:#475569;">
                    <input type="checkbox" name="best_price" checked style="width:15px;height:15px;accent-color:#b71c1c;"> Best Price
                </label>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:600;color:#475569;">
                    <input type="checkbox" name="is_active" id="addActive" checked style="width:15px;height:15px;cursor:pointer;"> Active
                </label>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" style="flex:1;background:#0a2463;color:white;padding:12px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:700;">✅ Add Product</button>
                <button type="button" onclick="closeAddModal()" style="background:#f1f5f9;color:#64748b;padding:12px 20px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:600;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- ══════════════════════════════════════════
     EDIT MODAL
══════════════════════════════════════════ -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box" style="background:white;border-radius:20px;width:100%;max-width:700px;padding:28px;box-shadow:0 32px 80px rgba(0,0,0,0.2);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <h2 style="font-size:18px;font-weight:800;color:#0a2463;">Edit Product</h2>
            <button onclick="closeEditModal()" style="background:#f1f5f9;border:none;border-radius:8px;padding:6px 10px;cursor:pointer;font-size:16px;">✕</button>
        </div>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" id="eId">

            <div class="form-row form-row-2">
                <div>
                    <label class="form-label">Filter by Category</label>
                    <select id="editCatF" onchange="mFilterSubs('edit')"
                            style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;background:white;box-sizing:border-box;">
                        <option value="">All Categories</option>
                        <?php foreach ($allCats as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Subcategory *</label>
                    <select name="subcategory_id" id="editSubF" required onchange="mFilterSub2s('edit')"
                            style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;background:white;box-sizing:border-box;">
                        <?php foreach ($allSubs as $s): ?>
                        <option value="<?= $s['id'] ?>" data-cat="<?= $s['category_id'] ?>">[<?= htmlspecialchars($s['cat_name']) ?>] <?= htmlspecialchars($s['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div style="margin-bottom:13px;">
                <label class="form-label">Subcategory2 <span style="font-weight:400;color:#94a3b8;text-transform:none;">(Optional)</span></label>
                <select name="subcategory2_id" id="editSub2F"
                        style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;background:white;box-sizing:border-box;">
                    <option value="">-- None (3-level) --</option>
                    <?php foreach ($allSub2s as $s2): ?>
                    <option value="<?= $s2['id'] ?>" data-sub="<?= $s2['subcategory_id'] ?>">[<?= htmlspecialchars($s2['sub_name']) ?>] <?= htmlspecialchars($s2['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row form-row-2">
                <div>
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="name" id="eName" required class="form-input">
                </div>
                <div>
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" id="eSlug" class="form-input">
                </div>
            </div>
            <div style="margin-bottom:13px;">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" id="eSubtitle" class="form-input">
            </div>
            <div style="margin-bottom:13px;">
                <label class="form-label">Description</label>
                <textarea name="description" id="eDesc" style="width:100%;padding:9px 13px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;outline:none;box-sizing:border-box;resize:vertical;min-height:70px;"></textarea>
            </div>

            <div class="form-row form-row-3">
                <div><label class="form-label">Min Price (₹)</label><input type="number" name="price_min" id="ePmin" step="0.01" class="form-input" style="color:#b71c1c;font-weight:700;"></div>
                <div><label class="form-label">Max Price (₹)</label><input type="number" name="price_max" id="ePmax" step="0.01" class="form-input" style="color:#b71c1c;font-weight:700;"></div>
                <div><label class="form-label">MRP (₹)</label><input type="number" name="mrp" id="eMrp" step="0.01" class="form-input"></div>
            </div>
            <div class="form-row form-row-3">
                <div><label class="form-label">GST %</label><input type="number" name="gst_percent" id="eGst" step="0.01" class="form-input"></div>
                <div><label class="form-label">Min Order</label><input type="number" name="min_order" id="eMinOrd" min="1" class="form-input"></div>
                <div><label class="form-label">Min Order Unit</label><input type="text" name="min_order_unit" id="eMinOrdU" class="form-input"></div>
            </div>
            <div class="form-row form-row-2">
                <div><label class="form-label">Delivery Days</label><input type="text" name="delivery_days" id="eDelDays" class="form-input"></div>
                <div><label class="form-label">Ships Within</label><input type="text" name="ships_within" id="eShips" class="form-input"></div>
            </div>
            <div class="form-row form-row-3">
                <div><label class="form-label">Warranty</label><input type="text" name="warranty" id="eWarranty" class="form-input"></div>
                <div><label class="form-label">Certification</label><input type="text" name="certification" id="eCert" class="form-input"></div>
                <div><label class="form-label">Rating</label><input type="number" name="rating" id="eRating" step="0.1" min="0" max="5" class="form-input"></div>
            </div>
            <div class="form-row form-row-2">
                <div><label class="form-label">Orders Count</label><input type="text" name="orders_count" id="eOrdCnt" class="form-input"></div>
                <div><label class="form-label">Stock Label</label><input type="text" name="stock_label" id="eStockLbl" class="form-input"></div>
            </div>
            <div class="form-row form-row-3">
                <div><label class="form-label">Badge Text</label><input type="text" name="badge" id="eBadge" class="form-input"></div>
                <div><label class="form-label">Badge Color</label><input type="text" name="badge_color" id="eBadgeClr" class="form-input"></div>
                <div><label class="form-label">Sort Order</label><input type="number" name="sort_order" id="eSort" min="0" class="form-input"></div>
            </div>

            <div style="margin-bottom:13px;">
                <label class="form-label">New Image (optional)</label>
                <input type="file" name="image" accept="image/*" onchange="previewImg(this,'editImgPrev')"
                       style="width:100%;padding:8px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;box-sizing:border-box;">
                <img id="editImgPrev" src="" style="margin-top:8px;width:80px;height:80px;object-fit:contain;border-radius:8px;border:1px solid #e2e8f0;background:#f8faff;">
            </div>

            <div style="margin-bottom:16px;display:flex;gap:20px;flex-wrap:wrap;">
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:600;color:#475569;">
                    <input type="checkbox" name="in_stock" id="eInStock" style="width:15px;height:15px;accent-color:#16a34a;"> In Stock
                </label>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:600;color:#475569;">
                    <input type="checkbox" name="best_price" id="eBestPrice" style="width:15px;height:15px;accent-color:#b71c1c;"> Best Price
                </label>
                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13px;font-weight:600;color:#475569;">
                    <input type="checkbox" name="is_active" id="eActive" style="width:15px;height:15px;cursor:pointer;"> Active
                </label>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit" style="flex:1;background:#0a2463;color:white;padding:12px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:700;">💾 Save Changes</button>
                <button type="button" onclick="closeEditModal()" style="background:#f1f5f9;color:#64748b;padding:12px 20px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:600;">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
var allSubsData  = <?= json_encode(array_map(fn($s)=>['id'=>(int)$s['id'],'name'=>$s['name'],'cat_id'=>(int)$s['category_id'],'cat_name'=>$s['cat_name']], $allSubs)) ?>;
var allSub2Data  = <?= json_encode(array_map(fn($s)=>['id'=>(int)$s['id'],'name'=>$s['name'],'sub_id'=>(int)$s['subcategory_id'],'sub_name'=>$s['sub_name']], $allSub2s)) ?>;

function autoSlug(val, t) {
    document.getElementById(t).value = val.toLowerCase().trim().replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-');
}
function previewImg(input, id) {
    if (input.files && input.files[0]) {
        var r = new FileReader();
        r.onload = function(e){ var el=document.getElementById(id); el.src=e.target.result; el.style.display='block'; };
        r.readAsDataURL(input.files[0]);
    }
}

// Modal sub filtering
function mFilterSubs(prefix) {
    var catId = document.getElementById(prefix+'CatF').value;
    var sel   = document.getElementById(prefix+'SubF');
    var cur   = sel.value;
    sel.innerHTML = '<option value="">-- Select Subcategory --</option>';
    allSubsData.forEach(function(s) {
        if (!catId || s.cat_id == catId) {
            var o = document.createElement('option');
            o.value = s.id; o.setAttribute('data-cat', s.cat_id);
            o.textContent = (catId ? '' : '['+s.cat_name+'] ') + s.name;
            if (s.id == cur) o.selected = true;
            sel.appendChild(o);
        }
    });
    mFilterSub2s(prefix);
}
function mFilterSub2s(prefix) {
    var subId = document.getElementById(prefix+'SubF').value;
    var sel   = document.getElementById(prefix+'Sub2F');
    var cur   = sel.value;
    sel.innerHTML = '<option value="">-- None (3-level) --</option>';
    allSub2Data.forEach(function(s) {
        if (!subId || s.sub_id == subId) {
            var o = document.createElement('option');
            o.value = s.id; o.setAttribute('data-sub', s.sub_id);
            o.textContent = '['+s.sub_name+'] '+s.name;
            if (s.id == cur) o.selected = true;
            sel.appendChild(o);
        }
    });
}

// Page-level filter dropdowns
function fFilterSubs() {
    var catId = document.getElementById('fCat').value;
    var sel   = document.getElementById('fSub');
    var cur   = sel.value;
    sel.innerHTML = '<option value="">All Subcategories</option>';
    allSubsData.forEach(function(s) {
        if (!catId || s.cat_id == catId) {
            var o = document.createElement('option');
            o.value = s.id;
            o.textContent = '['+s.cat_name+'] '+s.name;
            if (s.id == cur) o.selected = true;
            sel.appendChild(o);
        }
    });
    fFilterSub2s();
}
function fFilterSub2s() {
    var subId = document.getElementById('fSub').value;
    var sel   = document.getElementById('fSub2');
    var cur   = sel.value;
    sel.innerHTML = '<option value="">All Sub2</option>';
    allSub2Data.forEach(function(s) {
        if (!subId || s.sub_id == subId) {
            var o = document.createElement('option');
            o.value = s.id;
            o.textContent = '['+s.sub_name+'] '+s.name;
            if (s.id == cur) o.selected = true;
            sel.appendChild(o);
        }
    });
}

// Open/Close Add Modal
function openAddModal() {
    document.getElementById('addModal').classList.add('open');
    setTimeout(function(){ document.getElementById('addName').focus(); }, 100);
}
function closeAddModal() { document.getElementById('addModal').classList.remove('open'); }

// Open/Close Edit Modal
function openEditModal(p) {
    document.getElementById('eId').value       = p.id;
    document.getElementById('eName').value     = p.name;
    document.getElementById('eSlug').value     = p.slug;
    document.getElementById('eSubtitle').value = p.subtitle    || '';
    document.getElementById('eDesc').value     = p.description || '';
    document.getElementById('ePmin').value     = p.price_min   || 0;
    document.getElementById('ePmax').value     = p.price_max   || 0;
    document.getElementById('eMrp').value      = p.mrp         || 0;
    document.getElementById('eGst').value      = p.gst_percent || 18;
    document.getElementById('eMinOrd').value   = p.min_order   || 1;
    document.getElementById('eMinOrdU').value  = p.min_order_unit  || 'Piece';
    document.getElementById('eDelDays').value  = p.delivery_days   || '3-5 Days';
    document.getElementById('eShips').value    = p.ships_within    || 'Ships within 24 hrs';
    document.getElementById('eWarranty').value = p.warranty        || 'Mfr. Terms';
    document.getElementById('eCert').value     = p.certification   || 'ISO • IBR';
    document.getElementById('eRating').value   = p.rating          || 4.8;
    document.getElementById('eOrdCnt').value   = p.orders_count    || '1000+';
    document.getElementById('eStockLbl').value = p.stock_label     || 'In Stock';
    document.getElementById('eBadge').value    = p.badge           || '';
    document.getElementById('eBadgeClr').value = p.badge_color     || '';
    document.getElementById('eSort').value     = p.sort_order      || 0;
    document.getElementById('eInStock').checked   = p.in_stock   == 1;
    document.getElementById('eBestPrice').checked = p.best_price == 1;
    document.getElementById('eActive').checked    = p.is_active  == 1;

    // Set image preview
    var imgEl = document.getElementById('editImgPrev');
    if (p.image) {
        imgEl.src = '../' + p.image.replace(/^\//, '');
        imgEl.style.display = 'block';
    } else {
        imgEl.style.display = 'none';
    }

    // Set sub dropdown
    var subData = allSubsData.find(function(s){ return s.id == p.subcategory_id; });
    if (subData) {
        document.getElementById('editCatF').value = subData.cat_id;
        mFilterSubs('edit');
    }
    document.getElementById('editSubF').value = p.subcategory_id;
    mFilterSub2s('edit');
    if (p.subcategory2_id) {
        document.getElementById('editSub2F').value = p.subcategory2_id;
    }

    document.getElementById('editModal').classList.add('open');
}
function closeEditModal() { document.getElementById('editModal').classList.remove('open'); }

// Close on overlay click
['addModal','editModal'].forEach(function(id){
    document.getElementById(id).addEventListener('click', function(e){
        if (e.target === this) this.classList.remove('open');
    });
});
// ESC key
document.addEventListener('keydown', function(e){
    if (e.key==='Escape'){ closeAddModal(); closeEditModal(); }
});
</script>
</body>
</html>