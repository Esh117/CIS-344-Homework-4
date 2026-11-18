<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/db.php';
if (!is_admin()) { header('Location: login.php'); exit; }
$requests = $pdo->query("SELECT * FROM requests ORDER BY created_at DESC")->fetchAll();
$page_title = 'Request dashboard';
require_once __DIR__ . '/../includes/header.php';
?>
<section class="section container">
    <div class="dashboard-top">
        <div><p class="eyebrow">CAMPUSFIX ADMINISTRATION</p><h1>Service requests</h1><p>Welcome, <?= e($_SESSION['admin_username']) ?>. Review requests and update their status.</p></div>
        <a class="button button-outline" href="logout.php">Log out</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>ID / Date</th><th>Submitted by</th><th>Issue</th><th>Details</th><th>Status</th><th>Update</th></tr></thead>
            <tbody>
            <?php if (!$requests): ?>
                <tr><td colspan="6">No requests have been submitted yet.</td></tr>
            <?php else: foreach ($requests as $request): ?>
                <tr>
                    <td>#<?= e($request['id']) ?><br><small><?= e($request['created_at']) ?></small></td>
                    <td><?= e($request['full_name']) ?><br><small><?= e($request['email']) ?></small><br><small><?= e($request['location']) ?></small></td>
                    <td><?= e($request['category']) ?><br><span class="priority"><?= e($request['priority']) ?> priority</span></td>
                    <td class="description-cell"><?= e($request['description']) ?></td>
                    <td><span class="status"><?= e($request['status']) ?></span></td>
                    <td>
                        <form method="POST" action="update-status.php" class="status-form">
                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                            <input type="hidden" name="request_id" value="<?= e($request['id']) ?>">
                            <select name="status">
                                <?php foreach (['Pending', 'In Progress', 'Completed'] as $status): ?>
                                    <option value="<?= e($status) ?>" <?= $request['status'] === $status ? 'selected' : '' ?>><?= e($status) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="button button-small" type="submit">Save</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
