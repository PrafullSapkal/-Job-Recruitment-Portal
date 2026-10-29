<?php
require_once 'config.php'; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? ''); $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
        $error = 'Enter your name, a valid email, and a password with at least 8 characters.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (name,email,password_hash) VALUES (?,?,?)');
            $stmt->execute([$name,$email,password_hash($password, PASSWORD_DEFAULT)]);
            header('Location: login.php?registered=1'); exit;
        } catch (PDOException $e) { $error = 'That email may already be registered.'; }
    }
}
include 'header.php';
?>
<main class="container"><div class="panel"><h1>Create Account</h1>
<?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
<form method="post"><label>Full name</label><input name="name" required>
<label>Email</label><input type="email" name="email" required>
<label>Password (minimum 8 characters)</label><input type="password" name="password" minlength="8" required>
<button>Create Account</button></form></div></main>
<?php include 'footer.php'; ?>
