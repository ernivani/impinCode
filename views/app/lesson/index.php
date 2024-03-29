<?php include_once __DIR__ . '/../../_base.php'; ?>

<body class="bg-neutral-950 text-white font-sans leading-normal tracking-normal">
    <div class="relative min-h-screen flex flex-col justify-center items-center">
        <a href="<?= $path('app') ?>" class="absolute top-4 left-4 bg-gray-800 hover:bg-gray-700 text-white p-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        <div class="bg-neutral-800 p-6 rounded-lg shadow-xl max-w-md w-full">
            <h1 class="text-2xl font-semibold text-white mb-4"><?= htmlspecialchars($data['lesson']->getTitle()) ?></h1>

            <div id="question-container" class="mb-4"></div>
            <button id="next-question" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded opacity-1">Next Question</button>

        </div>
    </div>

    <script>
        const lessonId = <?= $data['lesson']->getId() ?>;
        const questions = <?= json_encode(array_map(function($q) {
            return [
                'id' => $q->getId(), 
                'content' => $q->getContent(),
            ];
        }, $data['lesson']->getQuestions()->toArray()), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    </script>

    <script src="/js/learn.js"></script>
</body>
