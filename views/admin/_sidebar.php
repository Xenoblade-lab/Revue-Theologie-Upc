<aside class="dashboard-sidebar" id="sidebar">
    <nav class="sidebar-nav">
        <?php
        $userName = isset($user) ? trim(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? '')) : 'Admin Principal';
        $userRole = 'Administrateur';
        $userInitials = isset($user) ? strtoupper(substr($user['prenom'] ?? 'A', 0, 1) . substr($user['nom'] ?? 'D', 0, 1)) : 'AD';
        ?>
        <div class="user-panel user-dropdown">
            <button class="user-btn" id="userBtn" aria-label="Menu utilisateur">
                <div class="user-avatar">
                    <?= htmlspecialchars($userInitials) ?>
                </div>
                <div class="user-details">
                    <h3><?= htmlspecialchars($userName) ?></h3>
                    <p><?= htmlspecialchars($userRole) ?></p>
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
                        <div class="user-email"><?= htmlspecialchars($user['email'] ?? '') ?></div>
                    </div>
                </div>
                <div class="user-menu-divider"></div>
                <a href="<?= Router\Router::route("admin") ?>" class="user-menu-item">Tableau de bord</a>
                <a href="<?= Router\Router::route("admin") ?>#stats" class="user-menu-item">Statistiques</a>
                <a href="<?= Router\Router::route("admin") ?>/users" class="user-menu-item">Utilisateurs</a>
                <a href="<?= Router\Router::route("admin") ?>/volumes" class="user-menu-item">Numéros/Volumes</a>
                <a href="<?= Router\Router::route("admin") ?>/paiements" class="user-menu-item">Paiements</a>
                <div class="user-menu-divider"></div>
                <a href="<?= Router\Router::route("admin") ?>/settings" class="user-menu-item">Configuration</a>
                <a href="<?= Router\Router::route("logout") ?>" class="user-menu-item logout-item">Déconnexion</a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Principal</div>
            <a href="<?= Router\Router::route("admin") ?>" class="nav-item <?= ($current_page ?? '') === 'dashboard' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Tableau de bord</span>
            </a>
            <a href="<?= Router\Router::route("admin") ?>#stats" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span>Statistiques</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Gestion</div>
            <a href="<?= Router\Router::route("admin") ?>#articles" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Articles</span>
            </a>
            <a href="<?= Router\Router::route("admin") ?>/users" class="nav-item <?= ($current_page ?? '') === 'users' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Utilisateurs</span>
            </a>
            <a href="<?= Router\Router::route("admin") ?>/volumes" class="nav-item <?= ($current_page ?? '') === 'volumes' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span>Numéros/Volumes</span>
            </a>
            <a href="<?= Router\Router::route("admin") ?>/paiements" class="nav-item <?= ($current_page ?? '') === 'paiements' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Paiements</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Paramètres</div>
            <a href="<?= Router\Router::route("admin") ?>/settings" class="nav-item <?= ($current_page ?? '') === 'settings' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Configuration</span>
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

