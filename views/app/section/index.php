<?php $sections = $data['sections']; ?>

<?php include_once __DIR__ . '/../../_base.php'; // chemin à ajuster selon votre structure de dossiers ?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <?php include_once __DIR__ . '/../_sidebar.php'; // Assurez-vous que le chemin est correct ?>

        <main class="flex-1 overflow-y-auto bg-neutral-800">
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    <h1 class="text-2xl font-semibold text-white">Sections</h1>
                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($sections as $section): ?>
                            <div class="bg-neutral-700 shadow-lg sm:rounded-lg p-6">
                                <h2 class="text-lg font-semibold text-white"><?= htmlspecialchars($section->getTitle()) ?></h2>
                                <a href="<?= htmlspecialchars($path('section_id', ['id' => $section->getId()])) ?>" class="mt-4 inline-block bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded">
                                    Voir les leçons
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once __DIR__ . '/../_rightbar.php'; // Assurez-vous que le chemin est correct ?>
    </div>
</body>
