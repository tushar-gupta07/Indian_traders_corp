<?php
session_start();
require_once '../assets/include/config.php';

// Auth check
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php'); exit;
}

$pdo = getDB();
$msg = '';
$msgType = '';

// ── ACTIONS ──────────────────────────────────────────────
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ADD
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $slug  = trim($_POST['slug'] ?? '');
    $sort  = (int)($_POST['sort_order'] ?? 0);
    $active = isset($_POST['is_active']) ? 1 : 0;

    if (!$name) {
        $msg = 'Category name is required.'; $msgType = 'error';
    } else {
        // Auto-generate slug if empty
        if (!$slug) $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
        try {
            $stmt = $pdo->prepare("INSERT INTO menu_categories (name, slug, sort_order, is_active) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $sort, $active]);
            // Clear menu cache
            @unlink('../assets/cache/menu_tree.json');
            $msg = "Category '<strong>$name</strong>' added successfully!"; $msgType = 'success';
        } catch (Exception $e) {
            $msg = 'Error: ' . $e->getMessage(); $msgType = 'error';
        }
    }
}

// EDIT
if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = (int)($_POST['id'] ?? 0);
    $name  = trim($_POST['name'] ?? '');
    $slug  = trim($_POST['slug'] ?? '');
    $sort  = (int)($_POST['sort_order'] ?? 0);
    $active = isset($_POST['is_active']) ? 1 : 0;

    if (!$name || !$id) {
        $msg = 'Invalid data.'; $msgType = 'error';
    } else {
        if (!$slug) $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
        try {
            $stmt = $pdo->prepare("UPDATE menu_categories SET name=?, slug=?, sort_order=?, is_active=? WHERE id=?");
            $stmt->execute([$name, $slug, $sort, $active, $id]);
            @unlink('../assets/cache/menu_tree.json');
            $msg = "Category updated successfully!"; $msgType = 'success';
        } catch (Exception $e) {
            $msg = 'Error: ' . $e->getMessage(); $msgType = 'error';
        }
    }
}

// DELETE
if ($action === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    try {
        // Check if subcategories exist
        $check = $pdo->prepare("SELECT COUNT(*) FROM menu_subcategories WHERE category_id=?");
        $check->execute([$id]);
        if ($check->fetchColumn() > 0) {
            $msg = 'Cannot delete! This category has subcategories. Delete subcategories first.'; $msgType = 'error';
        } else {
            $pdo->prepare("DELETE FROM menu_categories WHERE id=?")->execute([$id]);
            @unlink('../assets/cache/menu_tree.json');
            $msg = 'Category deleted successfully!'; $msgType = 'success';
        }
    } catch (Exception $e) {
        $msg = 'Error: ' . $e->getMessage(); $msgType = 'error';
    }
}

// TOGGLE ACTIVE
if ($action === 'toggle' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $pdo->prepare("UPDATE menu_categories SET is_active = 1 - is_active WHERE id=?")->execute([$id]);
    @unlink('../assets/cache/menu_tree.json');
    header('Location: categories.php?msg=toggled'); exit;
}

// FETCH for edit modal
$editData = null;
if (isset($_GET['edit_id'])) {
    $s = $pdo->prepare("SELECT * FROM menu_categories WHERE id=?");
    $s->execute([(int)$_GET['edit_id']]);
    $editData = $s->fetch();
}

// FETCH ALL
$search = trim($_GET['search'] ?? '');
if ($search) {
    $cats = $pdo->prepare("SELECT c.*, (SELECT COUNT(*) FROM menu_subcategories WHERE category_id=c.id) as sub_count FROM menu_categories c WHERE c.name LIKE ? ORDER BY c.sort_order, c.id");
    $cats->execute(["%$search%"]);
} else {
    $cats = $pdo->query("SELECT c.*, (SELECT COUNT(*) FROM menu_subcategories WHERE category_id=c.id) as sub_count FROM menu_categories c ORDER BY c.sort_order, c.id");
}
$categories = $cats->fetchAll();

$pageTitle    = 'Categories';
$pageSubtitle = 'Manage all product categories';
$activePage   = 'categories';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - ITC Admin</title>
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
        .modal-overlay { display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:100;align-items:center;justify-content:center; }
        .modal-overlay.open { display:flex; }
        @keyframes fadeIn { from{opacity:0;transform:scale(0.95)} to{opacity:1;transform:scale(1)} }
        .modal-box { animation:fadeIn 0.2s ease; }
        .badge-active { background:#dcfce7;color:#166534;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px; }
        .badge-inactive { background:#fee2e2;color:#991b1b;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px; }
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
        <a href="categories.php" class="sidebar-link active">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h7"/></svg>
            Categories
        </a>
        <a href="subcategories.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            Subcategories
        </a>
        <div class="sidebar-section">Products</div>
        <a href="products.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            All Products
        </a>
        <a href="product_add.php" class="sidebar-link">
            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Product
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
                <h1 style="font-size:16px;font-weight:800;color:#0a2463;">Categories</h1>
                <p style="font-size:11px;color:#94a3b8;font-weight:500;">Manage all product categories</p>
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

        <!-- Stats + Add button row -->
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <div style="background:white;border-radius:12px;padding:14px 20px;border:1px solid #e2e8f0;min-width:120px;">
                    <div style="font-size:22px;font-weight:800;color:#0a2463;"><?= count($categories) ?></div>
                    <div style="font-size:11px;color:#94a3b8;font-weight:600;">Total Categories</div>
                </div>
                <div style="background:white;border-radius:12px;padding:14px 20px;border:1px solid #e2e8f0;min-width:120px;">
                    <div style="font-size:22px;font-weight:800;color:#16a34a;"><?= count(array_filter($categories, fn($c)=>$c['is_active'])) ?></div>
                    <div style="font-size:11px;color:#94a3b8;font-weight:600;">Active</div>
                </div>
                <div style="background:white;border-radius:12px;padding:14px 20px;border:1px solid #e2e8f0;min-width:120px;">
                    <div style="font-size:22px;font-weight:800;color:#dc2626;"><?= count(array_filter($categories, fn($c)=>!$c['is_active'])) ?></div>
                    <div style="font-size:11px;color:#94a3b8;font-weight:600;">Inactive</div>
                </div>
            </div>
            <button onclick="openAddModal()" style="background:#0a2463;color:white;font-size:13px;font-weight:700;padding:10px 20px;border-radius:10px;border:none;cursor:pointer;display:flex;align-items:center;gap:8px;">
                <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Category
            </button>
        </div>

        <!-- Search -->
        <div style="background:white;border-radius:12px;border:1px solid #e2e8f0;padding:16px;margin-bottom:16px;">
            <form method="GET" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                       placeholder="Search categories..."
                       style="flex:1;min-width:200px;padding:8px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;outline:none;">
                <button type="submit" style="background:#0a2463;color:white;padding:8px 18px;border-radius:8px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Search</button>
                <?php if ($search): ?>
                <a href="categories.php" style="padding:8px 14px;border-radius:8px;border:1.5px solid #e2e8f0;font-size:13px;color:#64748b;text-decoration:none;font-weight:600;">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Table -->
        <div style="background:white;border-radius:16px;border:1px solid #e2e8f0;overflow:hidden;">
            <div style="overflow-x:auto;">
                <table style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                            <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">#</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Name</th>
                            <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Slug</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Subcategories</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Sort Order</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Status</th>
                            <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:800;color:#64748b;text-transform:uppercase;letter-spacing:0.05em;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="7" style="padding:48px;text-align:center;color:#94a3b8;font-size:14px;">
                                No categories found.
                                <button onclick="openAddModal()" style="display:block;margin:12px auto 0;background:#0a2463;color:white;padding:8px 18px;border-radius:8px;border:none;cursor:pointer;font-size:13px;font-weight:600;">Add First Category</button>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($categories as $i => $cat): ?>
                        <tr style="border-bottom:1px solid #f1f5f9;transition:background 0.15s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                            <td style="padding:14px 16px;font-size:13px;font-weight:700;color:#94a3b8;"><?= $i+1 ?></td>
                            <td style="padding:14px 16px;">
                                <div style="font-size:14px;font-weight:700;color:#1e293b;"><?= htmlspecialchars($cat['name']) ?></div>
                            </td>
                            <td style="padding:14px 16px;">
                                <code style="font-size:12px;background:#f1f5f9;padding:3px 8px;border-radius:6px;color:#475569;"><?= htmlspecialchars($cat['slug']) ?></code>
                            </td>
                            <td style="padding:14px 16px;text-align:center;">
                                <a href="subcategories.php?cat=<?= $cat['id'] ?>" style="display:inline-block;background:#e0e7ff;color:#0a2463;font-size:12px;font-weight:700;padding:4px 12px;border-radius:20px;text-decoration:none;">
                                    <?= $cat['sub_count'] ?> subs
                                </a>
                            </td>
                            <td style="padding:14px 16px;text-align:center;font-size:13px;font-weight:700;color:#64748b;"><?= $cat['sort_order'] ?></td>
                            <td style="padding:14px 16px;text-align:center;">
                                <a href="categories.php?action=toggle&id=<?= $cat['id'] ?>" onclick="return confirm('Toggle status?')"
                                   class="<?= $cat['is_active'] ? 'badge-active' : 'badge-inactive' ?>">
                                    <?= $cat['is_active'] ? 'Active' : 'Inactive' ?>
                                </a>
                            </td>
                            <td style="padding:14px 16px;text-align:center;">
                                <div style="display:flex;gap:8px;justify-content:center;">
                                    <button onclick="openEditModal(<?= $cat['id'] ?>, '<?= addslashes($cat['name']) ?>', '<?= addslashes($cat['slug']) ?>', <?= $cat['sort_order'] ?>, <?= $cat['is_active'] ?>)"
                                            style="background:#e0e7ff;color:#0a2463;border:none;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;cursor:pointer;">
                                        ✏️ Edit
                                    </button>
                                    <a href="subcategories.php?cat=<?= $cat['id'] ?>"
                                       style="background:#f0fdf4;color:#166534;border:none;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;">
                                        📂 Subs
                                    </a>
                                    <a href="categories.php?action=delete&id=<?= $cat['id'] ?>"
                                       onclick="return confirm('Delete \'<?= addslashes($cat['name']) ?>\'? This cannot be undone!')"
                                       style="background:#fee2e2;color:#991b1b;border:none;padding:6px 12px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;">
                                        🗑️ Delete
                                    </a>
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

<!-- ══════════ ADD MODAL ══════════ -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box" style="background:white;border-radius:20px;width:100%;max-width:480px;padding:28px;margin:16px;box-shadow:0 32px 80px rgba(0,0,0,0.2);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <h2 style="font-size:18px;font-weight:800;color:#0a2463;">Add New Category</h2>
            <button onclick="closeAddModal()" style="background:#f1f5f9;border:none;border-radius:8px;padding:6px 10px;cursor:pointer;font-size:16px;">✕</button>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="add">
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Category Name *</label>
                <input type="text" name="name" id="addName" required
                       oninput="autoSlug(this.value,'addSlug')"
                       placeholder="e.g. Ball Valves"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;">
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Slug (auto-generated)</label>
                <input type="text" name="slug" id="addSlug"
                       placeholder="e.g. ball-valves"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;background:#f8fafc;color:#64748b;">
                <p style="font-size:11px;color:#94a3b8;margin-top:4px;">Leave blank to auto-generate from name</p>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Sort Order</label>
                <input type="number" name="sort_order" value="0" min="0"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;">
                <p style="font-size:11px;color:#94a3b8;margin-top:4px;">Lower number = appears first in menu</p>
            </div>
            <div style="margin-bottom:20px;display:flex;align-items:center;gap:10px;">
                <input type="checkbox" name="is_active" id="addActive" checked style="width:16px;height:16px;cursor:pointer;">
                <label for="addActive" style="font-size:13px;font-weight:600;color:#475569;cursor:pointer;">Active (visible in menu)</label>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" style="flex:1;background:#0a2463;color:white;padding:12px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:700;">
                    ✅ Add Category
                </button>
                <button type="button" onclick="closeAddModal()" style="background:#f1f5f9;color:#64748b;padding:12px 20px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:600;">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ══════════ EDIT MODAL ══════════ -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box" style="background:white;border-radius:20px;width:100%;max-width:480px;padding:28px;margin:16px;box-shadow:0 32px 80px rgba(0,0,0,0.2);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <h2 style="font-size:18px;font-weight:800;color:#0a2463;">Edit Category</h2>
            <button onclick="closeEditModal()" style="background:#f1f5f9;border:none;border-radius:8px;padding:6px 10px;cursor:pointer;font-size:16px;">✕</button>
        </div>
        <form method="POST">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" id="editId">
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Category Name *</label>
                <input type="text" name="name" id="editName" required
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;">
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Slug</label>
                <input type="text" name="slug" id="editSlug"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;">
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:700;color:#475569;margin-bottom:6px;text-transform:uppercase;letter-spacing:0.05em;">Sort Order</label>
                <input type="number" name="sort_order" id="editSort" min="0"
                       style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;">
            </div>
            <div style="margin-bottom:20px;display:flex;align-items:center;gap:10px;">
                <input type="checkbox" name="is_active" id="editActive" style="width:16px;height:16px;cursor:pointer;">
                <label for="editActive" style="font-size:13px;font-weight:600;color:#475569;cursor:pointer;">Active (visible in menu)</label>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" style="flex:1;background:#0a2463;color:white;padding:12px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:700;">
                    💾 Save Changes
                </button>
                <button type="button" onclick="closeEditModal()" style="background:#f1f5f9;color:#64748b;padding:12px 20px;border-radius:10px;border:none;cursor:pointer;font-size:14px;font-weight:600;">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Auto slug generator
function autoSlug(val, targetId) {
    var slug = val.toLowerCase().trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    document.getElementById(targetId).value = slug;
}

// Add Modal
function openAddModal() {
    document.getElementById('addModal').classList.add('open');
    setTimeout(function(){ document.getElementById('addName').focus(); }, 100);
}
function closeAddModal() {
    document.getElementById('addModal').classList.remove('open');
}

// Edit Modal
function openEditModal(id, name, slug, sort, active) {
    document.getElementById('editId').value   = id;
    document.getElementById('editName').value = name;
    document.getElementById('editSlug').value = slug;
    document.getElementById('editSort').value = sort;
    document.getElementById('editActive').checked = active == 1;
    document.getElementById('editModal').classList.add('open');
}
function closeEditModal() {
    document.getElementById('editModal').classList.remove('open');
}

// Close modal on overlay click
document.getElementById('addModal').addEventListener('click', function(e) {
    if (e.target === this) closeAddModal();
});
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) closeEditModal();
});

// ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeAddModal(); closeEditModal(); }
});

// Auto-open edit modal if edit_id in URL
<?php if ($editData): ?>
openEditModal(<?= $editData['id'] ?>, '<?= addslashes($editData['name']) ?>', '<?= addslashes($editData['slug']) ?>', <?= $editData['sort_order'] ?>, <?= $editData['is_active'] ?>);
<?php endif; ?>
</script>

</body>
</html>