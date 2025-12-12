<aside class="dashboard-sidebar" id="sidebar">
    <nav class="sidebar-nav">
        <?php
        $userName = isset($user) ? trim(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? '')) : 'Évaluateur';
        $userEmail = $user['email'] ?? '';
        $userInitials = isset($user) ? strtoupper(substr($user['prenom'] ?? '', 0, 1) . substr($user['nom'] ?? '', 0, 1)) : 'EV';
        $pendingCount = $stats['pending'] ?? 0;
        $completedCount = $stats['completed'] ?? 0;
        ?>

        <div class="user-panel user-dropdown">
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
                <a href="<?= \Router\Router::route("reviewer") ?>" class="user-menu-item">Tableau de bord</a>
                <a href="<?= \Router\Router::route("reviewer") ?>#assigned" class="user-menu-item">Articles assignés</a>
                <a href="<?= \Router\Router::route("reviewer") ?>/terminees" class="user-menu-item">Évaluations terminées</a>
                <a href="<?= \Router\Router::route("reviewer") ?>/historique" class="user-menu-item">Historique</a>
                <div class="user-menu-divider"></div>
                <a href="<?= \Router\Router::route("reviewer") ?>/profil" class="user-menu-item">Mon profil</a>
                <a href="<?= \Router\Router::route("logout") ?>" class="user-menu-item logout-item">Déconnexion</a>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Principal</div>
            <a href="<?= \Router\Router::route("reviewer") ?>" class="nav-item <?= ($current_page ?? '') === 'dashboard' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Tableau de bord</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Évaluations</div>
            <a href="<?= \Router\Router::route("reviewer") ?>#assigned" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span>Articles assignés</span>
                <span class="badge"><?= htmlspecialchars($pendingCount) ?></span>
            </a>
            <a href="<?= \Router\Router::route("reviewer") ?>/terminees" class="nav-item <?= ($current_page ?? '') === 'terminees' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Évaluations terminées</span>
                <span class="badge"><?= htmlspecialchars($completedCount) ?></span>
            </a>
            <a href="<?= \Router\Router::route("reviewer") ?>/historique" class="nav-item <?= ($current_page ?? '') === 'historique' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Historique</span>
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-section-title">Compte</div>
            <a href="<?= \Router\Router::route("reviewer") ?>/profil" class="nav-item <?= ($current_page ?? '') === 'profil' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Mon profil</span>
            </a>
            <a href="<?= \Router\Router::route("logout") ?>" class="nav-item">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Déconnexion</span>
            </a>
        </div>
    </nav>
</aside>

