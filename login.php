<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/db.php';
if (is_admin()) { header('Location: dashboard.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf();
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare("SELECT id, username, password_hash FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Incorrect username or password.';
}
$page_title = 'Admin login';
require_once __DIR__ . '/../includes/header.php';
?>
<section class="section container narrow">
    <div class="form-card">
        <p class="eyebrow">STAFF ACCESS</p><h1>Administrator login</h1>
        <?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <div class="form-group"><label for="username">Username</label><input id="username" name="username" required></div>
            <div class="form-group"><label for="password">Password</label><input id="password" type="password" name="password" required></div>
            <button class="button" type="submit">Log in</button>
        </form>
        <p class="form-note">First time? Visit <a href="setup.php">initial admin setup</a>.</p>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
