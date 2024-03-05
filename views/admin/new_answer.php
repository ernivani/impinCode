<?php include __DIR__ . '/../_base.php'; ?>

<?= $form ?>

<?php foreach ($answers as $answer): ?>
    <div class="bg-gray-400 rounded-lg overflow-hidden shadow-lg">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($answer->getContent()) ?></h2>
            <h2 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($answer->getIsCorrect()) ?></h2>
        </div>
    </div>
<?php endforeach; ?>