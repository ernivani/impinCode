<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO Optimizations -->
    <title><?= isset($title) ? htmlspecialchars($title) . ' - ' : '' ?>ImpinCode</title>
    <meta name="description" content="ImpinCode est un site de tutoriels pour apprendre la programmation et le développement.">
    <!--
    <meta name="keywords" content="mot-clé 1, mot-clé 2, mot-clé 3" />
    -->
    <meta name="author" content="ImpinCode">
    <meta name="keywords" content="ImpinCode, tutoriels, programmation, développement, code, informatique, programmation web, programmation mobile, développement web, développement mobile, impin, codeimpin">

    <link rel="canonical" href="https://code.impin.fr<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://code.impin.fr<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
    <meta property="og:title" content="<?= isset($title) ? htmlspecialchars($title) : 'Page Title' ?> - ImpinCode">
    <meta property="og:description" content="ImpinCode est un site de tutoriels pour apprendre la programmation et le développement.">
    
    <!-- Stylesheets -->
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/img/logo.svg">
    
    <!-- JavaScript -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- plausible stats -->
    <script defer data-domain="code.impin.fr" src="https://plausible.io/js/script.js"></script>

    
    
    <!-- Tailwind CSS Configuration (if necessary) -->
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-34FBSHPY8K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-34FBSHPY8K');
</script>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5901649144497688"
     crossorigin="anonymous"></script>
<meta name="google-adsense-account" content="ca-pub-5901649144497688">


</head>
