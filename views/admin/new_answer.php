<?php include __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950 min-h-screen">
    
    <a href="<?= $path('admin_questions', ['id' => $questionId]) ?>" class="absolute top-4 left-4 bg-gray-800 hover:bg-gray-700 text-white p-2 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
        </svg>
    </a>
    <div class="flex">
        <main class="flex-1">
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-2xl font-semibold text-white mb-6">Dashboard Administrateur</h1>

                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white inet">
                        <h2 class="text-xl font-semibold text-white mb-4">Votre Formulaire</h2>
                        <?= $form ?>
                    </div>

                    <?php foreach ($answers as $answer): ?>
                        <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg mt-6">
                            <div class="p-6">
                                <h2 class="text-lg font-semibold text-white"><?= htmlspecialchars($answer->getContent()) ?></h2>
                                <h2 class="text-lg font-semibold text-white"><?= htmlspecialchars($answer->getIsCorrect() ? 'Correct' : 'Incorrect') ?></h2>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
    </div>
</body>
