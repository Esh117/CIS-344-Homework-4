<?php
$page_title = 'Campus support made simple';
require_once __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="container hero-content">
        <div>
            <p class="eyebrow">CAMPUS SERVICE PORTAL</p>
            <h1>Report a problem.<br><span>Get back to learning.</span></h1>
            <p class="hero-copy">Use CampusFix to report classroom, technology, Wi-Fi, and facility problems. Your request is saved so the support team can review it.</p>
            <a class="button button-light" href="#request-form">Create a request</a>
        </div>
        <div class="hero-card">
            <div class="hero-icon">✓</div>
            <h3>One place for campus issues</h3>
            <p>Submit your issue, receive a reference number, and let the support team take it from there.</p>
            <div class="mini-stat"><strong>Simple</strong><span>Quick online reporting</span></div>
            <div class="mini-stat"><strong>Organized</strong><span>Requests stored in a database</span></div>
        </div>
    </div>
</section>

<section class="section container" id="request-form">
    <div class="section-heading">
        <p class="eyebrow">NEW SERVICE REQUEST</p>
        <h2>How can we help?</h2>
        <p>Complete all fields below. Please provide enough detail for the support team to understand the problem.</p>
    </div>

    <form class="form-card" action="submit.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <div class="form-grid">
            <div class="form-group">
                <label for="full_name">Full name *</label>
                <input type="text" id="full_name" name="full_name" maxlength="100" required>
            </div>
            <div class="form-group">
                <label for="email">Email address *</label>
                <input type="email" id="email" name="email" maxlength="150" required>
            </div>
            <div class="form-group">
                <label for="location">Building / room *</label>
                <input type="text" id="location" name="location" maxlength="100" placeholder="Example: Library, Room 204" required>
            </div>
            <div class="form-group">
                <label for="category">Issue category *</label>
                <select id="category" name="category" required>
                    <option value="">Choose a category</option>
                    <option>Computer / Technology</option>
                    <option>Wi-Fi / Network</option>
                    <option>Classroom Equipment</option>
                    <option>Building Maintenance</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Priority *</label>
                <select id="priority" name="priority" required>
                    <option value="">Choose priority</option>
                    <option>Low</option>
                    <option>Normal</option>
                    <option>High</option>
                </select>
            </div>
            <div class="form-group full">
                <label for="description">Describe the problem *</label>
                <textarea id="description" name="description" rows="5" maxlength="2000" placeholder="Explain what happened and any steps you already tried..." required></textarea>
                <small>Maximum 2,000 characters.</small>
            </div>
        </div>
        <button class="button" type="submit">Submit request</button>
        <p class="form-note">Fields marked * are required. Your information is used to respond to this request.</p>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
