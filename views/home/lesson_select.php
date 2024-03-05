<?php include __DIR__ . '/../_base.php'; ?>

<div class="container">
    <h1><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>

    <?php if (!empty($lessons)): ?>
        <ul>
            <?php foreach ($lessons as $lesson): ?>
                <li>
                    <a href="<?= $path('select_lesson', ['id' => $lesson->getId()]) ?>">
                        <?php echo htmlspecialchars($lesson->getTitle(), ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucune leçon disponible pour l'instant.</p>
    <?php endif; ?>
</div>
