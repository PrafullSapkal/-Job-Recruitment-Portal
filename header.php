<?php require_once __DIR__ . '/config.php'; ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Job Recruitment Portal</title><link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <strong><a href="index.php">Job Recruitment Portal</a></strong>
  <nav>
    <a href="index.php">Jobs</a>
    <?php if (!empty($_SESSION['user'])): ?>
      <a href="my_applications.php">My Applications</a>
      <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?><a href="admin/index.php">Admin</a><?php endif; ?>
      <a href="logout.php">Logout (<?= e($_SESSION['user']['name']) ?>)</a>
    <?php else: ?>
      <a href="login.php">Login</a><a href="register.php">Register</a>
    <?php endif; ?>
  </nav>
</header>
