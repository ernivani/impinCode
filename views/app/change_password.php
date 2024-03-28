<?php include_once __DIR__ . '/../_base.php'; 
$error = $data['error'] ?? null;
?>

<body class="text-gray-800 font-inter bg-neutral-950 overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <?php include_once __DIR__ . '/_sidebar.php'; ?>
        
        <div class="flex-1 overflow-y-auto">
            <div class="px-6 py-4">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-neutral-800 p-6 rounded-lg shadow-lg">
                        <h2 class="text-xl font-semibold text-white mb-4">Changer le Mot de Passe</h2>

                        <form action="<?= $path('change_password') ?>" method="post">
                        <?php if (!$data['isTemporary']): ?>
                            <div class="mb-4">
                                <label for="current_password" class="block text-gray-400">Mot de Passe Actuel</label>
                                <input type="password" name="current_password" id="current_password" class="form-input">
                            </div>
                        <?php endif; ?>
                            <div class="mb-4">
                                <label for="new_password" class="block text-gray-400">Nouveau Mot de Passe</label>
                                <input type="password" name="new_password" id="new_password" class="form-input">
                            </div>
                            <div class="mb-4">
                                <label for="new_password_confirm" class="block text-gray-400">Confirmer le Nouveau Mot de Passe</label>
                                <input type="password" name="new_password_confirm" id="new_password_confirm" class="form-input">
                            </div>
                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-150">Changer le Mot de Passe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
