<?php
require_once 'config.php'; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? '')); $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT id,name,email,password_hash,role FROM users WHERE email=?');
    $stmt->execute([$email]); $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id'=>$user['id'],'name'=>$user['name'],'email'=>$user['email'],'role'=>$user['role']];
        header('Location: index.php'); exit;
    }
    $error = 'Invalid email or password.';
}
include 'header.php';
?>
<main class="container"><div class="panel"><h1>Login</h1>
<?php if (isset($_GET['registered'])): ?><p class="success">Account created. Please log in.</p><?php endif; ?>
<?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
<form method="post"><label>Email</label><input type="email" name="email" required>
<label>Password</label><input type="password" name="password" required><button>Login</button></form>
<p>New here? <a href="register.php">Create an account</a></p></div></main>
<?php include 'footer.php'; ?>
