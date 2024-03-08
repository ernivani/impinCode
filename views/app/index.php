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
                <?php foreach ($data['section']->getUnits() as $unit): ?>
                    <div class="mt-6 max-w-4xl mx-auto">
                        <div class="bg-neutral-700 shadow-lg sm:rounded-lg p-6 flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-white"><?= $unit->getTitle() ?></h2>
                                <p class="mt-2 text-sm text-gray-300"><?= $unit->getDescription() ?></p>
                            </div>
                        </div>
                        <?php $lessonCount = 0; ?>
                        <div class="mt-10">
                            <?php foreach ($unit->getLessons() as $lesson): ?>
                                <?php $lessonCount++; ?>
                                <?php if ($lessonCount % 3 == 1):?>
                                    <div class="flex justify-center">
                                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center <?= $userLastLesson && $lesson->getId() <= $userLastLesson->getId() ? 'bg-green-500 hover:bg-green-700' : 'bg-gray-400'; ?>">
                                            <?php if ($userLastLesson && $lesson->getId() <= $userLastLesson->getId()): ?>
                                                <a href="<?= $lesson->getId() < $userLastLesson->getId() ?  $path('lesson_id', ['id' => $lesson->getId()]) :$path('lesson')  ?>"
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
                                        <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center <?= $userLastLesson && $lesson->getId() <= $userLastLesson->getId() ? 'bg-green-500 hover:bg-green-700' : 'bg-gray-400'; ?>">
                                            <?php if ($userLastLesson && $lesson->getId() <= $userLastLesson->getId()): ?>
                                                <a href="<?= $lesson->getId() < $userLastLesson->getId() ?  $path('lesson_id', ['id' => $lesson->getId()]) :$path('lesson')  ?>" class="text-white flex items-center justify-center">
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

        <div class="w-1/3 overflow-hidden hidden lg:block"> 
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <h1 class='text-2xl font-semibold text-white'>Right Sidebar</h1>
                    <div class='mt-6'>
                        <div class='bg-gray-500 shadow sm:rounded-lg p-6'>
                            <h2 class='text-lg leading-6 font-medium text-gray-900'>Section Title</h2>
                            <p class='mt-4 max-w-2xl text-sm text-gray-900'>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.
                            </p>
                            <div class='mt-6'>
                                <a href='<?= htmlspecialchars($path('logout')) ?>' class='block w-full py-3 px-4 text-center bg-neutral-800 rounded-md text-white font-medium hover:bg-neutral-700 transition duration-150 mt-3'>
                                    Se déconnecter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
