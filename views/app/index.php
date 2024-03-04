<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950">
    <div class="flex h-screen overflow-hidden">
        <?php include_once __DIR__ . '/_sidebar.php'; ?>

        <div class="flex flex-1 overflow-y-auto overflow-x-hidden">
            
            <div class="flex-1 overflow-hidden">
                <div class="px-4 py-6 sm:px-6 lg:px-8 w-full">
                    <div class="mx-auto bg-gray-500 shadow sm:rounded-lg p-6 max-w-4xl ">
                        <h1 class="text-2xl font-semibold text-gray-900 text-center">Lessons</h1>
                        <div class="mt-6">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                                <?php foreach ($data['lessons'] as $lesson) : ?>
                                    <div class="w-full h-64 bg-gray-400 rounded-lg overflow-hidden shadow-lg">
                                        <div class="p-6">
                                            <h2 class="text-lg font-semibold text-gray-900"><?= $lesson->getTitle() ?></h2>
                                            <p class="mt-4 max-w * 2xl text-sm text-neutral-700">
                                                <?= $lesson->getDescription() ?>
                                            </p>
                                            <div class="mt-6">
                                                <a href="#<?= $lesson->getId() ?>" class="block w-full py-3 px-4 text-center bg-neutral-800 rounded-md text-white font-medium hover:bg-neutral-700 transition duration-150 mt-3">
                                                    Commencer
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-1/3 overflow-hidden hidden lg:block"> 
                <div class="px-4 py-6 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto">
                        <h1 class='text-2xl font-semibold text-white'>Right Sidebar</h1>
                        <div class='mt-6'>
                            <div class='bg-gray-500 shadow sm:rounded-lg p-6'>
                                <h2 class='text-lg leading-6 font-medium text-gray-900'>Section Title</h2>
                                <p class='mt-4 max-w-2xl text-sm text-gray-900'>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed
                                </p>
                                <div class='mt-6'>
                                    <a href='#' class='block w-full py-3 px-4 text-center bg-neutral-800 rounded-md text-white font-medium hover:bg-neutral-700 transition duration-150 mt-3'>
                                        Button
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
