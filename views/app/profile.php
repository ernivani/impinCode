<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <?php include_once __DIR__ . '/_sidebar.php'; ?>

        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            <div class="px-6 py-4 shadow-sm">
                <h1 class="text-2xl font-semibold text-white">Mon Profil</h1>
            </div>

            <div class="px-6 py-4">
                <div class="bg-neutral-800 p-6 rounded-lg shadow-lg">
                    <div class="flex items-center space-x-6 mb-6">
                        <?php if (!empty($user->getUrlimage())): ?>
                            <img class="w-24 h-24 rounded-full" src="<?= htmlspecialchars($user->getUrlimage()) ?>" alt="Profil utilisateur">
                        <?php else: ?>
                            <div class="w-24 h-24 bg-gray-400 rounded-full flex items-center justify-center text-center">
                                <span class="text-white text-4xl"><?= strtoupper($user->getUsername()[0]) ?></span>
                            </div>
                        <?php endif; ?>
                        <div>
                            <h2 class="text-xl font-semibold text-white">Informations Personnelles</h2>
                            <p class="text-gray-400">Nom d'utilisateur: <?= htmlspecialchars($user->getUsername()) ?></p>
                            <p class="text-gray-400">Email: <?= htmlspecialchars($user->getEmail()) ?></p>
                            <p class="text-gray-400">Dernière connexion: <?= $user->getLastLogin()->format('d/m/Y H:i') ?></p>
                        </div>
                    </div>

                    <?php if ($user->getIsTemporary()): ?>
                        <div class="mb-6">
                            <div class="bg-yellow-600 text-white p-4 rounded">
                                <p class="font-semibold">Attention</p>
                                <p>Votre compte est temporaire. Pour le rendre permanent, veuillez changer votre mot de passe si vous souhaitez continuer à l'utiliser.</p>
                                <p>Hésitez pas à changer de nom d'utilisateur et d'email si vous le souhaitez.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div>
                        <a href="<?= htmlspecialchars($path('edit_profile')) ?>" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-150">
                            Éditer le Profil
                        </a>
                        <a href="<?= htmlspecialchars($path('change_password')) ?>" class="inline-block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-150 ">
                            Changer le Mot de Passe
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
