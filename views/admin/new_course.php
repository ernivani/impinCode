<?php include __DIR__ . '/../_base.php'; ?>

<?= $form ?>

<?php foreach ($courses as $course): ?>
    <div class="bg-gray-400 rounded-lg overflow-hidden shadow-lg">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($course->getTitle()) ?></h2>
            <div class="mt-6">
                <a href="<?= $path('admin_sections', ['id' => $course->getId()]) ?>" class="text-blue-500">
                    Ajouter une question
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>