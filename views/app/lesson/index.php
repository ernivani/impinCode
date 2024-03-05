<?php include_once __DIR__ . '/../../_base.php'; ?>

<h1 class="text-2xl font-semibold text-gray-900 "><?= htmlspecialchars($data['lesson']->getTitle()) ?></h1>
<p class="mt-4 text-sm text-neutral-700"><?= htmlspecialchars($data['lesson']->getDescription()) ?></p>
