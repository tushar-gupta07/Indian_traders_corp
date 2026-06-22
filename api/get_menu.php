<?php
// api/get_menu.php
require_once '../assets/include/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$cacheFile = '../assets/cache/api_menu_tree.json';
if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 600) {
    echo file_get_contents($cacheFile);
    exit;
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
                // 4-level: sub2 ke under products
                $sub2List = [];
                foreach ($subs2 as $sub2) {
                    // ✅ CHANGED: menu_products → products
                    $p = $pdo->prepare("SELECT id,name,slug,subtitle,image FROM products WHERE subcategory2_id=? AND is_active=1 ORDER BY sort_order");
                    $p->execute([$sub2['id']]);
                    $sub2List[] = [
                        'id'       => (int)$sub2['id'],
                        'name'     => $sub2['name'],
                        'slug'     => $sub2['slug'],
                        'products' => $p->fetchAll(),
                    ];
                }
                $subList[] = [
                    'id'       => (int)$sub['id'],
                    'name'     => $sub['name'],
                    'slug'     => $sub['slug'],
                    'has_sub2' => true,
                    'sub2s'    => $sub2List,
                    'products' => [],
                ];
            } else {
                // ✅ CHANGED: menu_products → products
                $p = $pdo->prepare("SELECT id,name,slug,subtitle,image FROM products WHERE subcategory_id=? AND subcategory2_id IS NULL AND is_active=1 ORDER BY sort_order");
                $p->execute([$sub['id']]);
                $subList[] = [
                    'id'       => (int)$sub['id'],
                    'name'     => $sub['name'],
                    'slug'     => $sub['slug'],
                    'has_sub2' => false,
                    'sub2s'    => [],
                    'products' => $p->fetchAll(),
                ];
            }
        }

        $menu[] = [
            'id'   => (int)$cat['id'],
            'name' => $cat['name'],
            'slug' => $cat['slug'],
            'icon' => $cat['icon'] ?? '',
            'subs' => $subList,
        ];
    }

    $json = json_encode(['success' => true, 'menu' => $menu], JSON_UNESCAPED_UNICODE);

    if (!is_dir('../assets/cache')) mkdir('../assets/cache', 0755, true);
    file_put_contents($cacheFile, $json);

    echo $json;

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}