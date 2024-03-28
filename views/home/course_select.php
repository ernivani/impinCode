<?php include __DIR__ . '/../_base.php'; ?>

<body class="bg-neutral-950 text-white font-sans leading-normal tracking-normal">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="bg-neutral-800 p-6 rounded-lg shadow-xl max-w-md w-full">
            <h1 class="text-2xl font-semibold mb-4"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h1>

            <?php if (!empty($courses)): ?>
                <div class="space-y-2">
                    <?php foreach ($courses as $course): ?>
                        <a href="<?= $path('select_course', ['id' => $course->getId()]) ?>" class="block bg-neutral-700 p-4 rounded hover:bg-neutral-600">
                            <?php echo htmlspecialchars($course->getTitle(), ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-400">Aucun cours disponible pour l'instant.</p>
            <?php endif; ?>

            <?php if ($this->isGranted('ROLE_ADMIN')): ?>
                <a href="<?= $path('admin_courses') ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Gérer les cours (admin)
                </a>
            <?php endif; ?>
        </div>
    </div>
</body>
