<?php
$page_title = $page_title ?? 'CampusFix';
require_once __DIR__ . '/functions.php';
$base_path = (strpos($_SERVER['SCRIPT_NAME'], '/admin/') !== false) ? '../' : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?> | CampusFix</title>
    <link rel="stylesheet" href="<?= e($base_path) ?>assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container nav">
        <a class="logo" href="<?= e($base_path) ?>index.php">Campus<span>Fix</span></a>
        <nav>
            <a href="<?= e($base_path) ?>index.php">Home</a>
            <a href="<?= e($base_path) ?>index.php#request-form">Submit a Request</a>
            <a href="<?= e($base_path) ?>admin/login.php">Admin</a>
        </nav>
    </div>
</header>
<main>
