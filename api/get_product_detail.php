<?php
// ============================================================
// api/get_product_detail.php
// Returns full product detail by slug
// ============================================================
require_once '../assets/include/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
if (!$slug) {
    echo json_encode(['success' => false, 'error' => 'No slug provided']);
    exit;
}

try {
    $pdo = getDB();

    // Get product with subcategory and category info
    $stmt = $pdo->prepare("
        SELECT
            p.*,
            s.name  AS subcategory_name,
            s.slug  AS subcategory_slug,
            c.name  AS category_name,
            c.slug  AS category_slug
        FROM menu_products p
        JOIN menu_subcategories s ON p.subcategory_id = s.id
        JOIN menu_categories    c ON s.category_id    = c.id
        WHERE p.slug = ? AND p.is_active = 1
        LIMIT 1
    ");
    $stmt->execute([$slug]);
    $product = $stmt->fetch();

    if (!$product) {
        echo json_encode(['success' => false, 'error' => 'Product not found']);
        exit;
    }

    // Get all unique model codes for this product
    $stmt2 = $pdo->prepare("
        SELECT model_code, spec_key, spec_value, sort_order
        FROM menu_product_specs
        WHERE product_id = ?
        ORDER BY model_code, sort_order
    ");
    $stmt2->execute([$product['id']]);
    $rawSpecs = $stmt2->fetchAll();

    // Group specs by model_code
    $specsGrouped = [];
    foreach ($rawSpecs as $row) {
        $mc = $row['model_code'] ?: 'General';
        if (!isset($specsGrouped[$mc])) {
            $specsGrouped[$mc] = ['model_code' => $mc, 'specs' => []];
        }
        $specsGrouped[$mc]['specs'][$row['spec_key']] = $row['spec_value'];
    }
    $product['specs_table'] = array_values($specsGrouped);

    // Get prev/next products in same subcategory
    $stmt3 = $pdo->prepare("
        SELECT id, name, slug FROM menu_products
        WHERE subcategory_id = ? AND is_active = 1 AND sort_order < ?
        ORDER BY sort_order DESC LIMIT 1
    ");
    $stmt3->execute([$product['subcategory_id'], $product['sort_order']]);
    $product['prev'] = $stmt3->fetch() ?: null;

    $stmt4 = $pdo->prepare("
        SELECT id, name, slug FROM menu_products
        WHERE subcategory_id = ? AND is_active = 1 AND sort_order > ?
        ORDER BY sort_order ASC LIMIT 1
    ");
    $stmt4->execute([$product['subcategory_id'], $product['sort_order']]);
    $product['next'] = $stmt4->fetch() ?: null;

    echo json_encode(['success' => true, 'product' => $product], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
