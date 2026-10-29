<?php
require_once 'config.php';
$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM vacancies WHERE is_active=1";
$params = [];
if ($q !== '') {
    $sql .= " AND (title LIKE ? OR company LIKE ? OR location LIKE ? OR category LIKE ?)";
    $like = "%$q%"; $params = [$like,$like,$like,$like];
}
$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql); $stmt->execute($params); $jobs = $stmt->fetchAll();
include 'header.php';
?>
<main class="container">
<section class="hero"><h1>Find your next opportunity</h1><p>Browse vacancies and track your job applications in one place.</p>
<form method="get"><input name="q" placeholder="Search job, company, location or category" value="<?= e($q) ?>"><button>Search Jobs</button></form></section>
<div class="grid">
<?php foreach ($jobs as $job): ?><article class="card">
<h2><?= e($job['title']) ?></h2><p><strong><?= e($job['company']) ?></strong></p>
<p class="muted"><?= e($job['location']) ?> · <?= e($job['category']) ?></p>
<p><?= nl2br(e($job['description'])) ?></p>
<a class="btn" href="apply.php?id=<?= (int)$job['id'] ?>">Apply Now</a>
</article><?php endforeach; ?>
<?php if (!$jobs): ?><div class="card">No vacancies found. Try a different search.</div><?php endif; ?>
</div></main>
<?php include 'footer.php'; ?>
