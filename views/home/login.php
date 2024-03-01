<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950">
    <div class="h-screen flex items-center justify-center px-4">
        <card class="w-full max-w-sm p-8 bg-neutral-800 rounded-2xl"> 
            <p class="text-2xl font-bold text-white text-center mb-8">Connexion</p>
            <?= $form ?>
            <p class="text-xs text-white text-center mt-4">Tu n'as pas de compte ? <a href="<?= $path('register') ?>" class="text-light-purple hover:underline">Inscris-toi !</a></p>
        </card>
    </div>
</body>
