<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/db.php';

$count = (int)$pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
$message = '';
if ($count === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username === '' || strlen($username) < 4 || strlen($password) < 10) {
        $message = 'Username must be at least 4 characters and password at least 10 characters.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
        $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
        $message = 'Admin account created. Delete admin/setup.php now, then log in.';
        $count = 1;
    }
}
$page_title = 'Create administrator';
require_once __DIR__ . '/../includes/header.php';
?>
<section class="section container narrow">
    <div class="form-card">
        <h1>Initial administrator setup</h1>
        <?php if ($message): ?><p class="notice"><?= e($message) ?></p><?php endif; ?>
        <?php if ($count > 0): ?>
            <p>An administrator account already exists. For security, this setup page is disabled.</p>
            <a class="button" href="login.php">Go to admin login</a>
        <?php else: ?>
            <p>Create the first administrator account. Use a strong, unique password.</p>
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <div class="form-group"><label>Username</label><input name="username" minlength="4" maxlength="50" required></div>
                <div class="form-group"><label>Password (at least 10 characters)</label><input type="password" name="password" minlength="10" required></div>
                <button class="button" type="submit">Create admin account</button>
            </form>
        <?php endif; ?>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
