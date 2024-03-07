<?php include __DIR__ . '/../_base.php'; ?>

<?= $form ?>

<?php foreach ($lessons as $lesson): ?>
    <div class="bg-gray-400 rounded-lg overflow-hidden shadow-lg">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($lesson->getTitle()) ?></h2>
            <div class="mt-6">
                <a href="<?= $path('admin_questions', ['id' => $lesson->getId()]) ?>" class="text-sm text-blue-600">
                    Ajouter une question
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>