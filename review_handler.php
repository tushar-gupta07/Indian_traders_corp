<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'assets/include/config.php';
$conn = getConn();

function sendJson($data) {
    echo json_encode($data);
    exit;
}

if (!$conn) {
    sendJson([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
}

$method = $_SERVER['REQUEST_METHOD'];

/* ================= GET REVIEWS ================= */
if ($method === 'GET') {
    $action = $_GET['action'] ?? '';
    $product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $sort = $_GET['sort'] ?? 'recent';

    $per = 5;
    $offset = ($page - 1) * $per;

    if ($action !== 'get' || $product_id <= 0) {
        sendJson([
            'success' => false,
            'message' => 'Invalid request'
        ]);
    }

    $orderBy = "created_at DESC";

    if ($sort === 'highest') {
        $orderBy = "rating DESC, created_at DESC";
    } elseif ($sort === 'lowest') {
        $orderBy = "rating ASC, created_at DESC";
    }

    /* Summary */
    $stmt = $conn->prepare("
        SELECT COUNT(*) AS total, COALESCE(AVG(rating), 0) AS avg_rating
        FROM product_reviews
        WHERE product_id = ? AND is_approved = 1
    ");

    if (!$stmt) {
        sendJson([
            'success' => false,
            'message' => 'Summary query failed: ' . $conn->error
        ]);
    }

    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $summary = $stmt->get_result()->fetch_assoc();

    $total = (int)$summary['total'];
    $avg = round((float)$summary['avg_rating'], 1);

    /* Rating breakdown */
    $breakdown = [
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0
    ];

    $stmt = $conn->prepare("
        SELECT rating, COUNT(*) AS cnt
        FROM product_reviews
        WHERE product_id = ? AND is_approved = 1
        GROUP BY rating
    ");

    if (!$stmt) {
        sendJson([
            'success' => false,
            'message' => 'Breakdown query failed: ' . $conn->error
        ]);
    }

    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $res = $stmt->get_result();

    while ($row = $res->fetch_assoc()) {
        $breakdown[(int)$row['rating']] = (int)$row['cnt'];
    }

    /* Review list */
    $sql = "
        SELECT id, product_id, name, email, rating, review_text, photo, is_verified, is_approved, created_at
        FROM product_reviews
        WHERE product_id = ? AND is_approved = 1
        ORDER BY $orderBy
        LIMIT ? OFFSET ?
    ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        sendJson([
            'success' => false,
            'message' => 'Review query failed: ' . $conn->error
        ]);
    }

    $stmt->bind_param("iii", $product_id, $per, $offset);
    $stmt->execute();
    $res = $stmt->get_result();

    $reviews = [];

    while ($row = $res->fetch_assoc()) {
        $reviews[] = [
            'id' => (int)$row['id'],
            'product_id' => (int)$row['product_id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'rating' => (int)$row['rating'],
            'review_text' => $row['review_text'],
            'photo' => $row['photo'],
            'is_verified' => (int)$row['is_verified'],
            'is_approved' => (int)$row['is_approved'],
            'created_at' => $row['created_at']
        ];
    }

    sendJson([
        'success' => true,
        'total' => $total,
        'per' => $per,
        'avg' => $avg,
        'breakdown' => $breakdown,
        'reviews' => $reviews
    ]);
}

/* ================= SUBMIT REVIEW ================= */
if ($method === 'POST') {
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $review_text = trim($_POST['review_text'] ?? '');

    if ($product_id <= 0) {
        sendJson([
            'success' => false,
            'message' => 'Invalid product id'
        ]);
    }

    if ($rating < 1 || $rating > 5) {
        sendJson([
            'success' => false,
            'message' => 'Please select rating'
        ]);
    }

    if (strlen($name) < 2) {
        sendJson([
            'success' => false,
            'message' => 'Please enter your name'
        ]);
    }

    if (strlen($review_text) < 10) {
        sendJson([
            'success' => false,
            'message' => 'Review must be at least 10 characters'
        ]);
    }

    $photoPath = null;

    if (!empty($_FILES['photo']['name'])) {
        $uploadDir = 'assets/uploads/reviews/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($ext, $allowed)) {
            $fileName = 'review_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $target = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
                $photoPath = $target;
            }
        }
    }

    $stmt = $conn->prepare("
        INSERT INTO product_reviews
        (product_id, name, email, rating, review_text, photo, is_verified, is_approved, created_at)
        VALUES (?, ?, ?, ?, ?, ?, 0, 1, NOW())
    ");

    if (!$stmt) {
        sendJson([
            'success' => false,
            'message' => 'Insert query failed: ' . $conn->error
        ]);
    }

    $stmt->bind_param("ississ", $product_id, $name, $email, $rating, $review_text, $photoPath);

    if (!$stmt->execute()) {
        sendJson([
            'success' => false,
            'message' => 'Review save failed: ' . $conn->error
        ]);
    }

    sendJson([
        'success' => true,
        'message' => 'Review submitted successfully'
    ]);
}

sendJson([
    'success' => false,
    'message' => 'Invalid request method'
]);