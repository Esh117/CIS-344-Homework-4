<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}
check_csrf();

$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$location = trim($_POST['location'] ?? '');
$category = trim($_POST['category'] ?? '');
$priority = trim($_POST['priority'] ?? '');
$description = trim($_POST['description'] ?? '');

$allowed_categories = [
    'Computer / Technology', 'Wi-Fi / Network', 'Classroom Equipment',
    'Building Maintenance', 'Other'
];
$allowed_priorities = ['Low', 'Normal', 'High'];

$errors = [];
if ($full_name === '' || mb_strlen($full_name) > 100) $errors[] = 'Enter a name (up to 100 characters).';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) $errors[] = 'Enter a valid email address.';
if ($location === '' || mb_strlen($location) > 100) $errors[] = 'Enter a building or room (up to 100 characters).';
if (!in_array($category, $allowed_categories, true)) $errors[] = 'Choose a valid category.';
if (!in_array($priority, $allowed_priorities, true)) $errors[] = 'Choose a valid priority.';
if ($description === '' || mb_strlen($description) > 2000) $errors[] = 'Describe the problem (up to 2,000 characters).';

if ($errors) {
    $_SESSION['form_errors'] = $errors;
    header('Location: index.php#request-form');
    exit;
}

try {
    $sql = "INSERT INTO requests (full_name, email, location, category, priority, description)
            VALUES (:full_name, :email, :location, :category, :priority, :description)";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':full_name' => $full_name,
        ':email' => $email,
        ':location' => $location,
        ':category' => $category,
        ':priority' => $priority,
        ':description' => $description
    ]);

    $_SESSION['new_request_id'] = $pdo->lastInsertId();
    header('Location: success.php');
    exit;
} catch (PDOException $error) {
    error_log($error->getMessage());
    http_response_code(500);
    exit('Your request could not be saved. Please try again later.');
}
