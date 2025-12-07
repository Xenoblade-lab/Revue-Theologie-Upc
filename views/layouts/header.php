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
                    <a href="<?= Router\Router::route("") ?>">Accueil</a>
                    <a href="<?= Router\Router::route("archives") ?>">Numéros & Archives</a>
                    <a href="<?= Router\Router::route("instructions") ?>">Instructions</a>
                    <a href="<?= Router\Router::route('comite') ?>">Comité</a>
                    <a href="<?= Router\Router::route("login") ?>">Se connecter</a>
                    <a href="<?= Router\Router::route('search') ?>" class="active">Recherche</a>
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