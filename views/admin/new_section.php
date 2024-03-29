<?php include __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950 min-h-screen">
    <a href="<?= $path('admin_courses') ?>" class="absolute top-4 left-4 bg-gray-800 hover:bg-gray-700 text-white p-2 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
        </svg>
    </a>
    <div class="flex">
        <main class="flex-1">
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-2xl font-semibold text-white mb-6">Dashboard Administrateur</h1>
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white">
                        <h2 class="text-xl font-semibold mb-4">Votre Formulaire</h2>
                        <?= $form ?>
                    </div>

                    <?php foreach ($sections as $section): ?>
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg mt-6">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-white"><?= htmlspecialchars($section->getTitle()) ?></h2>
                                <div class="mt-6">
                                    <a href="<?= $path('admin_units', ['id' => $section->getId()]) ?>" class="text-blue-500 hover:text-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                         Ajouter une unité
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

            </div>
        </main>
    </div>
</body>
