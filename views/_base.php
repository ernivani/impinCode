<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <title><?php if (isset($title)) echo $title . ' - ' ?>ImpinCode</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'base-purple': '#6b4eff',
            'light-purple': '#8c7aff',
          }
        }
      }
    };
    </script>
<script>
if (<?= isset($_SESSION['flash']['success']) || isset($_SESSION['flash']['error']) || isset($_SESSION['flash']['warning']) ? 'true' : 'false' ?>) {
  document.addEventListener('DOMContentLoaded', function() {
    const flash = document.createElement('div');
    flash.classList.add('absolute', 'top-0', 'right-0', 'text-white', 'p-3', 'rounded', 'm-4', 'text-sm');
    
    if (<?= isset($_SESSION['flash']['success']) ? 'true' : 'false' ?>) {
        flash.classList.add('bg-green-500');
        flash.textContent = "<?= isset($_SESSION['flash']['success']) ? $_SESSION['flash']['success'] : '' ?>";
    } else if (<?= isset($_SESSION['flash']['error']) ? 'true' : 'false' ?>) {
        flash.classList.add('bg-red-500');
        flash.textContent = "<?= isset($_SESSION['flash']['error']) ? $_SESSION['flash']['error'] : '' ?>";
    } else if (<?= isset($_SESSION['flash']['warning']) ? 'true' : 'false' ?>) {
        flash.classList.add('bg-yellow-500');
        flash.textContent = "<?= isset($_SESSION['flash']['warning']) ? $_SESSION['flash']['warning'] : '' ?>";
    }
    
    document.body.appendChild(flash);

    setTimeout(() => {
      flash.classList.add('slide-out-right'); // Assurez-vous que cette classe effectue une animation de sortie vers la droite
      setTimeout(() => {
        flash.remove(); // Supprime le message après l'animation
      }, 500); // Cette durée devrait correspondre à celle de l'animation
    }, 10000); // Temps d'affichage du message avant début de l'animation de sortie
    
  });
}
</script>


</head>
