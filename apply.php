<?php
require_once 'config.php'; require_login();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $pdo->prepare('SELECT * FROM vacancies WHERE id=? AND is_active=1'); $stmt->execute([$id]); $job = $stmt->fetch();
if (!$job) { http_response_code(404); exit('Vacancy not found.'); }
$message = ''; $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = trim($_POST['cover_note'] ?? '');
    try {
        $stmt = $pdo->prepare('INSERT INTO applications (user_id,vacancy_id,cover_note) VALUES (?,?,?)');
        $stmt->execute([$_SESSION['user']['id'],$id,$note]);
        $message = 'Your application has been submitted.';
    } catch (PDOException $e) { $error = 'You have already applied for this vacancy.'; }
}
include 'header.php';
?>
<main class="container"><div class="panel"><h1>Apply for <?= e($job['title']) ?></h1>
<p><strong><?= e($job['company']) ?></strong> · <?= e($job['location']) ?></p><p><?= nl2br(e($job['description'])) ?></p>
<?php if ($message): ?><p class="success"><?= e($message) ?></p><a class="btn" href="my_applications.php">View Applications</a>
<?php else: ?>
<?php if ($error): ?><p class="error"><?= e($error) ?></p><?php endif; ?>
<form method="post"><label>Short cover note (optional)</label><textarea name="cover_note" rows="4" placeholder="Briefly describe your interest"></textarea><button>Submit Application</button></form>
<?php endif; ?></div></main>
<?php include 'footer.php'; ?>
