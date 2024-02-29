<?php include_once __DIR__ . '/../_base.php'; ?>

<h1>Home</h1>

<?php foreach ($users as $user): ?>
    <li><?php echo htmlspecialchars($user->getName(), ENT_QUOTES, 'UTF-8'); ?></li>
<?php endforeach; ?>