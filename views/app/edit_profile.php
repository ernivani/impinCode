<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <?php include_once __DIR__ . '/_sidebar.php'; ?>

        <div class="flex-1 overflow-y-auto">
            <div class="px-6 py-4">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-neutral-800 p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-semibold text-white mb-4">Éditer le Profil</h2>
                        
                        <form action="<?= htmlspecialchars($path('edit_profile')) ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-400">Nom d'utilisateur</label>
                                <input type="text" name="username" id="username" value="<?= htmlspecialchars($user->getUsername()) ?>" class="mt-1 block
                                w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-base-purple focus:border-base-purple sm:text-sm" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->getEmail()) ?>" class="mt-1 block
                                w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-base-purple focus:border-base-purple sm:text-sm" required>
                            </div>
                            <div>
                                <label for="avatar" class="block text-sm font-medium text-gray-400">Avatar</label>
                                <input type="file" name="avatar" id="avatar" accept="image/png, image/gif, image/jpeg" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-base-purple focus:border-base-purple sm:text-sm">
                            </div>
                            <div>
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-150">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
