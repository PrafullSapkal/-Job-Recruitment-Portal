<?php
require_once 'config.php'; require_login();
$stmt = $pdo->prepare('SELECT a.status,a.applied_at,v.title,v.company,v.location FROM applications a JOIN vacancies v ON v.id=a.vacancy_id WHERE a.user_id=? ORDER BY a.applied_at DESC');
$stmt->execute([$_SESSION['user']['id']]); $apps = $stmt->fetchAll();
include 'header.php';
?>
<main class="container"><div class="panel"><h1>My Applications</h1>
<?php if (!$apps): ?><p>You have not applied to any vacancies yet.</p><a class="btn" href="index.php">Browse Jobs</a>
<?php else: ?><table><thead><tr><th>Role</th><th>Company</th><th>Location</th><th>Status</th><th>Applied</th></tr></thead><tbody>
<?php foreach ($apps as $a): ?><tr><td><?= e($a['title']) ?></td><td><?= e($a['company']) ?></td><td><?= e($a['location']) ?></td><td><?= e($a['status']) ?></td><td><?= e($a['applied_at']) ?></td></tr><?php endforeach; ?>
</tbody></table><?php endif; ?></div></main>
<?php include 'footer.php'; ?>
