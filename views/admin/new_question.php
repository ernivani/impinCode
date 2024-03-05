<?php include __DIR__ . '/../_base.php'; ?>

<?= $form ?>

<?php foreach ($questions as $question): ?>
    <div class="bg-gray-400 rounded-lg overflow-hidden shadow-lg">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($question->getContent()) ?></h2>
            <div class="mt-6">
                <a href="<?= $path('admin_answers', ['id' => $question->getId()]) ?>" class="text-blue-500">
                    Ajouter une réponse
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>