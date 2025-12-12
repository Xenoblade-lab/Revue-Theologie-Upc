<?php
// Utiliser le chemin absolu depuis la racine publique
$baseUrl = Router\Router::$defaultUri;
?>
 <!-- Header -->
 <header class="site-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="<?= Router\Router::route("") ?>">
                        <img src="<?= $baseUrl ?>assets/logo_upc.png" alt="UPC Logo">
                        <div class="logo-text">
                            <h1>Revue de la Faculté de Théologie</h1>
                            <p>Université Protestante au Congo</p>
                        </div>
                    </a>
                </div>
                <nav class="main-nav">
                    <a href="<?= Router\Router::route("") ?>" class=<?= App\Html::class('/') ?>>Accueil</a>
                    <a href="<?= Router\Router::route("archives") ?>" class=<?= App\Html::class('/archives') ?>>Numéros & Archives</a>
                    <a href="<?= Router\Router::route("instructions") ?>" class=<?= App\Html::class('/instructions') ?>>Instructions</a>
                    <a href="<?= Router\Router::route('comite') ?>" class=<?= App\Html::class('/comite') ?>>Comité</a>
                    <a href="<?= Router\Router::route('search') ?> " class=<?= App\Html::class('/search') ?>>Recherche</a>
                </nav>
                <div class="header-actions">
                    <?php if(!Service\AuthService::isLoggedIn()): ?>
                        <a href="<?= Router\Router::route("login") ?>" class="btn-login">Se connecter</a>
                    <?php else: 
                        $user = $_SESSION['user'] ?? null;
                        $userName = $user ? ($user['prenom'] . ' ' . $user['nom']) : 'Utilisateur';
                        $userInitials = $user ? (strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1))) : 'U';
                    ?>
                        <!-- Notifications Dropdown -->
                        <div class="notifications-dropdown">
                            <button class="notification-btn" id="notificationBtn" aria-label="Notifications">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <span class="notification-badge" id="notificationBadge">0</span>
                            </button>
                            <div class="notifications-menu" id="notificationsMenu">
                                <div class="notifications-header">
                                    <h3>Notifications</h3>
                                    <button class="mark-all-read" id="markAllRead">Tout marquer comme lu</button>
                                </div>
                                <div class="notifications-list" id="notificationsList">
                                    <div class="notification-empty">Aucune notification</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="user-dropdown">
                            <button class="user-btn" id="userBtn" aria-label="Menu utilisateur">
                                <div class="user-avatar">
                                    <?= htmlspecialchars($userInitials) ?>
                                </div>
                                <span class="user-name"><?= htmlspecialchars($userName) ?></span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div class="user-menu" id="userMenu">
                                <div class="user-info">
                                    <div class="user-avatar-large">
                                        <?= htmlspecialchars($userInitials) ?>
                                    </div>
                                    <div class="user-details">
                                        <div class="user-name-full"><?= htmlspecialchars($userName) ?></div>
                                        <div class="user-email"><?= htmlspecialchars($user['email'] ?? '') ?></div>
                                    </div>
                                </div>
                                <div class="user-menu-divider"></div>
                                <a href="<?= Router\Router::route("author") ?>" class="user-menu-item">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Dashboard Auteur
                                </a>
                                <a href="<?= Router\Router::route("author") ?>" class="user-menu-item">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Mon profil
                                </a>
                                <a href="<?= Router\Router::route("submit") ?>" class="user-menu-item">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    Soumettre un article
                                </a>
                                <a href="<?= Router\Router::route("instructions") ?>" class="user-menu-item">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                    Instructions
                                </a>
                                <div class="user-menu-divider"></div>
                                <a href="<?= Router\Router::route("logout") ?>" class="user-menu-item logout-item" id="logoutBtn">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    Se déconnecter
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!Service\AuthService::isLoggedIn()): ?>
                        <a href="<?= Router\Router::route("submit") ?>" class="btn-submit">Soumettre un article</a>
                    <?php endif; ?>
                </div>
                <button class="mobile-menu-toggle" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
</header>
<script src="<?= $baseUrl ?>js/user-dropdown.js"></script>