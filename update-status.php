<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/db.php';
if (!is_admin()) { header('Location: login.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: dashboard.php'); exit; }
check_csrf();
$id = filter_input(INPUT_POST, 'request_id', FILTER_VALIDATE_INT);
$status = $_POST['status'] ?? '';
$allowed = ['Pending', 'In Progress', 'Completed'];
if ($id && in_array($status, $allowed, true)) {
    $stmt = $pdo->prepare("UPDATE requests SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
}
header('Location: dashboard.php');
exit;
