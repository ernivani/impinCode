<?php include __DIR__ . '/../_base.php'; ?>

<?= $form ?>

<?php foreach ($sections as $section): ?>
    <div class="bg-gray-400 rounded-lg overflow-hidden shadow-lg">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($section->getTitle()) ?></h2>
            <div class="mt-6">
                <a href="<?= $path('admin_units', ['id' => $section->getId()]) ?>" class="text-blue-500">
                    Ajouter une unité
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>