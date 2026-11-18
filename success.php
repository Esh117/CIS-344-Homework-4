<?php
$page_title = 'Request submitted';
require_once __DIR__ . '/includes/header.php';
$request_id = $_SESSION['new_request_id'] ?? null;
unset($_SESSION['new_request_id']);
?>
<section class="section container narrow">
    <div class="success-card">
        <div class="success-icon">✓</div>
        <p class="eyebrow">SUBMISSION COMPLETE</p>
        <h1>Thank you!</h1>
        <p>Your campus service request was successfully saved in the database.</p>
        <?php if ($request_id): ?>
            <p class="reference">Your request number: <strong>#<?= e($request_id) ?></strong></p>
        <?php endif; ?>
        <a class="button" href="index.php">Return to home</a>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
