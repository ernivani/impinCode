<?php include_once __DIR__ . '/../_base.php'; ?>


<?php $userLastLesson = $user->getLastLesson(); ?> 

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <?php include_once __DIR__ . '/_sidebar.php'; ?>

        <main class="flex-1 overflow-y-auto bg-neutral-800">
            <div class="px-4 py-6 sm:px-6 lg:px-8 ">
                <div class="mx-auto shadow-xl sm:rounded-lg p-6 max-w-4xl flex items-center ">
                    <a href="<?= $path('choose_section') ?>" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none"><g clip-path="url(#clip0_1487_87799)"><path d="M3.58923 8.07617H15.7155" stroke="#AFAFAF" stroke-width="2" stroke-linecap="round"/><path d="M8.23363 2.07617L2.34863 7.96117L8.23363 13.8462" stroke="#AFAFAF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_1487_87799"><rect width="16" height="16" fill="white" transform="translate(0.692383 0.0761719)"/></clipPath></defs></svg>
                    </a>
                    <span class="ml-4 text-xl font-semibold text-white"><?= $data['section']->getTitle() ?></span>
                </div>
                <?php 
                $units = $data['section']->getUnits()->toArray();
                usort($units, function($a, $b) { return $a->getOrdre() - $b->getOrdre(); });
                foreach ($units as $unit): ?>
                    <div class="mt-6 max-w-4xl mx-auto">
                        <div class="bg-neutral-700 shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-white"><?= $unit->getTitle() ?></h2>
                                <p class="mt-2 text-sm text-gray-300"><?= $unit->getDescription() ?></p>
                            </div>
                        </div>
                        <?php $lessonCount = 0; ?>
                        <div class="mt-10">
                        <?php 
                            $lessons = $unit->getLessons()->toArray(); 
                            usort($lessons, function($a, $b) { return $a->getOrdre() - $b->getOrdre(); });      
                            $allPreviousUnitsCompleted = true; // Hypothèse de départ
                            foreach ($unit->getSection()->getUnits() as $previousUnit) {
                                if ($previousUnit->getOrdre() < $unit->getOrdre() && !$previousUnit->isCompleted($user, $data['entityManager'])) {
                                    $allPreviousUnitsCompleted = false;
                                    break;
                                }
                            }                      
                            foreach ($lessons as $lesson):  
                                $lessonCount++;
                                $isLessonUnlocked = $userLastLesson && $allPreviousUnitsCompleted && $lesson->getOrdre() <= $userLastLesson->getOrdre();
                                if ($lessonCount % 3 == 1):?>
                                    <div class="flex justify-center">
                                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center <?= $isLessonUnlocked ? 'bg-green-500 hover:bg-green-700' : 'bg-gray-400'; ?>">
                                            <?php if ($isLessonUnlocked): ?>
                                                <a href="<?= $lesson->getOrdre() < $userLastLesson->getOrdre() ?  $path('lesson_id', ['id' => $lesson->getOrdre()]) :$path('lesson')  ?>"
                                                 class="text-white flex items-center justify-center">
                                                    <?= htmlspecialchars($lesson->getTitle()) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-white flex items-center justify-center">
                                                    <?= htmlspecialchars($lesson->getTitle()) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php if ($lessonCount % 3 == 2): ?>
                                        <div class="flex justify-evenly  mt-6">
                                    <?php endif; ?>
                                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center <?= $userLastLesson && $lesson->getOrdre() <= $userLastLesson->getOrdre() ? 'bg-green-500 hover:bg-green-700' : 'bg-gray-400'; ?>">
                                            <?php if ($userLastLesson && $lesson->getOrdre() <= $userLastLesson->getOrdre()): ?>
                                                <a href="<?= $lesson->getOrdre() < $userLastLesson->getOrdre() ?  $path('lesson_id', ['id' => $lesson->getOrdre()]) :$path('lesson')  ?>" class="text-white flex items-center justify-center">
                                                    <?= htmlspecialchars($lesson->getTitle()) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-white flex items-center justify-center">
                                                    <?= htmlspecialchars($lesson->getTitle()) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php if ($lessonCount % 3 == 0 || $lessonCount == count($unit->getLessons())): ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
        
        <?php include_once __DIR__ . '/_rightbar.php'; ?>
    </div>
</body>
