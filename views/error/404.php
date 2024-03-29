<?php include_once __DIR__ . '/../_base.php'; // Assurez-vous que le chemin est correct ?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="flex h-screen">
        <!-- La sidebar peut être incluse ou non, selon si vous voulez la garder pour une page d'erreur -->

        <main class="flex-1 flex items-center justify-center">
            <div class="text-center">
                <h1 class="text-6xl font-bold text-white mb-8">404</h1>
                <h2 class="text-2xl font-semibold text-white mb-4">Oups! Page non trouvée.</h2>
                <p class="text-lg text-gray-400 mb-8">Nous ne pouvons pas trouver la page que vous cherchez.</p>
                <a href="<?= htmlspecialchars($path('home')) ?>" class="hover:bg-light-purple bg-base-purple delay-75 duration-100 text-white text-sm font-bold rounded-2xl w-full p-3 mt-7 border-b-4 border-b-base-purple">
                    Retourner à l'accueil
                </a>
            </div>
        </main>
    </div>
</body>
