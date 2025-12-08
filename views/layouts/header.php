 <!-- Header -->
 <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="./assets/logo_upc.png" alt="UPC Logo">
                    <div class="logo-text">
                        <h1>Revue de la Faculté de Théologie</h1>
                        <p>Université Protestante au Congo</p>
                    </div>
                </div>
                <nav class="main-nav">
                    <a href="<?= Router\Router::route("") ?>" class=<?= App\Html::class('/') ?>>Accueil</a>
                    <a href="<?= Router\Router::route("archives") ?>" class=<?= App\Html::class('/archives') ?>>Numéros & Archives</a>
                    <a href="<?= Router\Router::route("instructions") ?>" class=<?= App\Html::class('/instructions') ?>>Instructions</a>
                    <a href="<?= Router\Router::route('comite') ?>" class=<?= App\Html::class('/comite') ?>>Comité</a>
                    <?php if(!Service\AuthService::isLoggedIn()): ?>
                        <a href="<?= Router\Router::route("login") ?>">Se connecter</a>
                    <?php else: ?>
                        <a href="<?= Router\Router::route("logout") ?>">Se deconnecter</a>
                    <?php endif; ?>
                    <a href="<?= Router\Router::route('search') ?> " class=<?= App\Html::class('/search') ?>>Recherche</a>
                </nav>
                <div class="header-actions">
                    <button class="btn-submit">
                     <a href="<?= Router\Router::route("submit") ?>">Soumettre un article</a></button>
                </div>
                <button class="mobile-menu-toggle" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
</header>