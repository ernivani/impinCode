<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="h-screen flex items-center justify-center px-4">
        <card class="w-full max-w-sm p-8 bg-neutral-800 rounded-2xl relative">

            <a href="<?= $path('home') ?>" class="text-white absolute top-2 right-2 hover:bg-neutral-900 p-2 rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>


            <p class="text-2xl font-bold text-white text-center mb-8">Crée ton profil</p>
            <?= $form ?>
            <p class="text-xs text-white text-center mt-4">Déjà un compte ? <a href="<?= $path('login') ?>" class="text-light-purple hover:underline">Connectes-toi !</a></p>
        </card>
    </div>
</body>
