<?php
ob_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// ─── DIRECT DB CONNECTION ─────────────────────────────────────
$conn = new mysqli('localhost', 'root', '', 'itc');
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'DB Error: ' . $conn->connect_error]);
    exit;
}
$conn->set_charset('utf8mb4');

$action = $_GET['action'] ?? '';

// ─── GET REVIEWS ─────────────────────────────────────────────
if ($action === 'get' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $pid  = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;
    $page = max(1, (int)($_GET['page'] ?? 1));
    $per  = 5;
    $off  = ($page - 1) * $per;

    if (!$pid) {
        echo json_encode(['success' => false, 'message' => 'Invalid product']);
        exit;
    }

    $cStmt = $conn->prepare("SELECT COUNT(*) as cnt FROM product_reviews WHERE product_id=? AND is_approved=1");
    $cStmt->bind_param('i', $pid);
    $cStmt->execute();
    $total = $cStmt->get_result()->fetch_assoc()['cnt'];

    $rStmt = $conn->prepare("SELECT rating, COUNT(*) as cnt FROM product_reviews WHERE product_id=? AND is_approved=1 GROUP BY rating");
    $rStmt->bind_param('i', $pid);
    $rStmt->execute();
    $rRows = $rStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $breakdown = array_fill(1, 5, 0);
    foreach ($rRows as $r) $breakdown[(int)$r['rating']] = (int)$r['cnt'];

    $avgStmt = $conn->prepare("SELECT AVG(rating) as avg FROM product_reviews WHERE product_id=? AND is_approved=1");
    $avgStmt->bind_param('i', $pid);
    $avgStmt->execute();
    $avg = round((float)$avgStmt->get_result()->fetch_assoc()['avg'], 1);

    $stmt = $conn->prepare("SELECT id, name, rating, review_text, photo, is_verified, created_at FROM product_reviews WHERE product_id=? AND is_approved=1 ORDER BY created_at DESC LIMIT ? OFFSET ?");
    $stmt->bind_param('iii', $pid, $per, $off);
    $stmt->execute();
    $reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    echo json_encode([
        'success'   => true,
        'total'     => (int)$total,
        'avg'       => $avg,
        'breakdown' => $breakdown,
        'page'      => $page,
        'per'       => $per,
        'reviews'   => $reviews,
    ]);
    exit;
}

// ─── SUBMIT REVIEW ───────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // POST size exceeded check
    if (empty($_POST) && $_SERVER['CONTENT_LENGTH'] > 0) {
        echo json_encode(['success' => false, 'message' => 'File too large. Max 8MB allowed.']);
        exit;
    }

    $pid    = (int)($_POST['product_id'] ?? 0);
    $name   = trim($_POST['name']        ?? '');
    $email  = trim($_POST['email']       ?? '');
    $rating = (int)($_POST['rating']     ?? 0);
    $text   = trim($_POST['review_text'] ?? '');

    $errors = [];
    if (!$pid)                       $errors[] = 'Invalid product.';
    if (strlen($name) < 2)           $errors[] = 'Name is required.';
    if ($rating < 1 || $rating > 5)  $errors[] = 'Rating must be 1-5.';
    if (strlen($text) < 10)          $errors[] = 'Review must be at least 10 characters.';
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email.';

    if ($errors) {
        echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
        exit;
    }

    $photoPath = null;
    if (!empty($_FILES['photo']['tmp_name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $ftype = mime_content_type($_FILES['photo']['tmp_name']);
        if (in_array($ftype, $allowedTypes)) {
            $uploadDir = __DIR__ . '/assets/uploads/reviews/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $ext   = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $fname = 'rev_' . $pid . '_' . time() . '_' . mt_rand(100, 999) . '.' . strtolower($ext);
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $fname)) {
                $photoPath = 'assets/uploads/reviews/' . $fname;
            }
        }
    }

    $stmt = $conn->prepare("INSERT INTO product_reviews (product_id, name, email, rating, review_text, photo, is_approved) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $stmt->bind_param('ississ', $pid, $name, $email, $rating, $text, $photoPath);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Thank you! Your review has been submitted.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'DB Error: ' . $conn->error]);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request.']);