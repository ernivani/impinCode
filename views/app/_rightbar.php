<?php
$lastLogin = $user->getLastLogin();
$createdAt = $user->getCreatedAt();

date_default_timezone_set('Europe/Paris');

?>

<div class="w-1/4 overflow-hidden hidden lg:block">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class='text-2xl font-semibold text-white'>Mon compte</h1>
            
            <!-- Section Informations de l'utilisateur -->
            <div class='mt-6 bg-gray-800 shadow sm:rounded-lg p-6'>
                <div class="flex items-center space-x-4">
                   <?php if (!empty($user->getUrlimage())): ?>
                            <img class="w-24 h-24 rounded-full" src="<?= htmlspecialchars($user->getUrlimage()) ?>" alt="Profil utilisateur">
                        <?php else: ?>
                            <div class="w-24 h-24 bg-gray-400 rounded-full flex items-center justify-center text-center">
                                <span class="text-white text-4xl"><?= strtoupper($user->getUsername()[0]) ?></span>
                            </div>
                        <?php endif; ?>
                    <div>
                        <h2 class='text-lg leading-6 font-medium text-white'><?= htmlspecialchars($user->getUsername()) ?></h2>
                        <p class='text-sm text-gray-400'><?= htmlspecialchars($user->getEmail()) ?></p>
                    </div>
                </div>
                <div class='mt-4 text-sm text-gray-400'>
                    <p>Dernière connexion : <?= $lastLogin->format('d/m/Y H:i') ?></p>
                    <p>Compte créé le : <?= $createdAt->format('d/m/Y') ?></p>
                </div>
                
                <?php if ($this->isGranted('ROLE_ADMIN')): ?>
                    <div class='mt-6'>
                        <a href='<?= htmlspecialchars($path('admin_home')) ?>' class='block w-full py-3 px-4 text-center bg-neutral-700 rounded-md text-white font-medium hover:bg-blue-700 transition duration-150'>
                            Administration
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Bouton Sélectionner un cours -->
                <div class='mt-6'>
                    <a href='<?= htmlspecialchars($path('course_select')) ?>' class='block w-full py-3 px-4 text-center bg-neutral-700 rounded-md text-white font-medium hover:bg-green-700 transition duration-150'>
                        Sélectionner un cours
                    </a>
                </div>

                <div class='mt-6'>
                    <a href='<?= htmlspecialchars($path('logout')) ?>' class='block w-full py-3 px-4 text-center bg-neutral-800 rounded-md text-white font-medium hover:bg-neutral-700 transition duration-150'>
                        Se déconnecter
                    </a>
                </div>

            </div>
            
        </div>
    </div>
</div>
