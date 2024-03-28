<?php include_once __DIR__ . '/../_base.php'; ?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="h-screen flex items-center justify-center px-4">
        <card class="w-full max-w-sm p-8 bg-neutral-800 rounded-2xl"> 
            <p class="text-2xl font-bold text-white text-center">Bienvenue sur</p>
            <p class="text-3xl font-bold text-white text-center">Impin<span class="text-base-purple">Code</span></p>

            <img src="/img/logo.svg" alt="Logo ImpinCode" class="mx-auto"> 

            <p class="text-l text-white text-center">Viens apprendre à coder avec nous !</p>
            
            <form method="POST" action="<?= $path('create_temporary_account') ?>" >
                <button type="submit" class="hover:bg-light-purple bg-base-purple delay-75 duration-100 text-white text-sm font-bold rounded-2xl w-full py-3 mt-7 border-b-4 border-b-base-purple">C'EST PARTI !</button>
            </form>
            <p class="text-xs text-white text-center mt-4">Tu as déjà un compte ? <a href="<?= $path('login') ?>" class="text-base-purple hover:underline">Connecte-toi !</a></p>
        </card>
    </div>
</body>
