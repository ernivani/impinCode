<?php include __DIR__ . '/../_base.php'; ?>

<?= $form ?>

<?php foreach ($units as $unit): ?>
    <div class="bg-gray-400 rounded-lg overflow-hidden shadow-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold"><?= $unit->getTitle() ?></h2>
            <a href="<?= $path('admin_course', ['id' => $unit->getId()]) ?>" class="text-blue-500">
                Ajouter une course
            </a>

        </div>
    </div>
<?php endforeach; ?>