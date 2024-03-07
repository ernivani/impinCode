<?php include __DIR__ . '/../_base.php'; ?>

<div class="container">
    <h1><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>

    <?php if (!empty($courses)): ?>
        <ul>
            <?php foreach ($courses as $course): ?>
                <li>
                    <a href="<?= $path('select_course', ['id' => $course->getId()]) ?>">
                        <?php echo htmlspecialchars($course->getTitle(), ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun cours disponible pour l'instant.</p>
    <?php endif; ?>
</div>
