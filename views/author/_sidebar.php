<aside class="dashboard-sidebar" id="sidebar">
    <nav class="sidebar-nav">
        <div class="user-panel user-dropdown">
            <?php
            // Récupérer les données utilisateur depuis les variables passées par le contrôleur
            $userName = isset($user) ? trim(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? '')) : 'Utilisateur';
            $userEmail = isset($user) ? ($user['email'] ?? '') : '';
            $userInitials = isset($user) ? strtoupper(substr($user['prenom'] ?? '', 0, 1) . substr($user['nom'] ?? '', 0, 1)) : 'U';
            ?>
            <button class="user-btn" id="userBtn" aria-label="Menu utilisateur">
                <div class="user-avatar">
                    <?= htmlspecialchars($userInitials) ?>
                </div>
                <div class="user-details">
                    <h3><?= htmlspecialchars($userName) ?></h3>
                    <p><?= htmlspecialchars($userEmail) ?></p>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <div class="user-menu" id="userMenu">
                <div class="user-info">
                    <div class="user-avatar-large"><?= htmlspecialchars($userInitials) ?></div>
                    <div class="user-details">
                        <div class="user-name-full"><?= htmlspecialchars($userName) ?></div>
                        <div class="user-email"><?= htmlspecialchars($userEmail) ?></div>
                    </div>
                </div>
                <div class="user-menu-divider"></div>
                <a href="<?= Router\Router::route("author") ?>" class="user-menu-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Tableau de bord
                </a>
                <a href="<?= Router\Router::route("author") ?>/profil" class="user-menu-item">
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

        <div class="nav-section">
            <div class="nav-section-title">Principal</div>
            <a href="<?= Router\Router::route("author") ?>" class="nav-item <?= basename($_SERVER['PHP_SELF'], '.php') === 'index' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Tableau de bord</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Mes articles</div>
            <a href="<?= Router\Router::route("author") ?>#submit-form" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Nouvelle soumission</span>
            </a>
            <a href="<?= Router\Router::route("author") ?>#submissions-table" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Mes soumissions</span>
                <?php if (isset($stats) && isset($stats['total'])): ?>
                    <span class="badge"><?= $stats['total'] ?></span>
                <?php else: ?>
                    <span class="badge">0</span>
                <?php endif; ?>
            </a>
            <a href="<?= Router\Router::route("author") ?>/articles" class="nav-item <?= basename($_SERVER['PHP_SELF'], '.php') === 'articles' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Articles publiés</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Compte</div>
            <a href="<?= Router\Router::route("author") ?>/abonnement" class="nav-item <?= basename($_SERVER['PHP_SELF'], '.php') === 'abonnement' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span>Abonnement & Paiements</span>
            </a>
            <a href="<?= Router\Router::route("author") ?>/profil" class="nav-item <?= basename($_SERVER['PHP_SELF'], '.php') === 'profil' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Mon profil</span>
            </a>
            <a href="<?= Router\Router::route("logout") ?>" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Déconnexion</span>
            </a>
        </div>
    </nav>
</aside>

