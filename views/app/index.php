<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <?php include_once __DIR__ . '/_sidebar.php'; ?>

        <main class="flex-1 overflow-y-auto">
            <div class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="mx-auto  shadow sm:rounded-lg p-6 max-w-4xl">
                    <h1 class="text-2xl font-semibold text-white">Bienvenue sur votre espace de formation</h1>
                    <div class="mt-6">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <?php foreach ($data['lessons'] as $lesson): ?>
                                <div class="bg-gray-400 rounded-lg overflow-hidden shadow-lg">
                                    <div class="p-6">
                                        <h2 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($lesson->getTitle()) ?></h2>
                                        <p class="mt-4 text-sm text-neutral-700"><?= htmlspecialchars($lesson->getDescription()) ?></p>
                                        <div class="mt-6">
                                            <a href="<?= $path('lesson_id', ['id' => $lesson->getId()]) ?>"
                                            class="block bg-neutral-800 rounded-md text-white text-center py-3 px-4 hover:bg-neutral-700 transition duration-150">
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
        </main>


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
                                    <a href='<?= $path('logout') ?>' class='block w-full py-3 px-4 text-center bg-neutral-800 rounded-md text-white font-medium hover:bg-neutral-700 transition duration-150 mt-3'>
                                        Se déconnecter
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
