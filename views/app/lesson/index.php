<?php include_once __DIR__ . '/../../_base.php'; ?>

<h1 class="text-2xl font-semibold text-gray-900"><?= htmlspecialchars($data['lesson']->getTitle()) ?></h1>

<div id="question-container"></div>
<button id="next-question" style="display: none;">Next Question</button>

<a href="<?= $path('app') ?>" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back</a>


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
