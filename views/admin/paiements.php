<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiements - Admin</title>
    <link rel="stylesheet" href="<?= Router\Router::$defaultUri ?>css/styles.css">
    <link rel="stylesheet" href="<?= Router\Router::$defaultUri ?>css/dashboard-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-layout">
        <?php include __DIR__ . DIRECTORY_SEPARATOR . '_sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-header fade-up">
                <div class="header-title">
                    <h1>Paiements</h1>
                    <p>Gestion des paiements validés / en attente</p>
                </div>
            </div>

            <div class="content-card fade-up">
                <div class="card-header">
                    <h2>Liste des paiements</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Date paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($paiements)): ?>
                            <?php foreach ($paiements as $p): ?>
                                <tr>
                                    <td><?= htmlspecialchars($p['id']) ?></td>
                                    <td><?= htmlspecialchars(($p['prenom'] ?? '') . ' ' . ($p['nom'] ?? '')) ?></td>
                                    <td><?= htmlspecialchars($p['email'] ?? '') ?></td>
                                    <td><?= number_format($p['montant'] ?? 0, 2, ',', ' ') ?> $</td>
                                    <td><span class="status-badge <?= ($p['statut'] ?? '') === 'valide' ? 'published' : (($p['statut'] ?? '') === 'refuse' ? 'rejected' : 'pending') ?>"><?= htmlspecialchars($p['statut'] ?? '') ?></span></td>
                                    <td><?= !empty($p['date_paiement']) ? date('d M Y', strtotime($p['date_paiement'])) : '—' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" style="text-align:center; padding:1.5rem;">Aucun paiement trouvé.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <button class="mobile-menu-btn" id="mobile-menu-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <script src="<?= Router\Router::$defaultUri ?>js/script.js"></script>
    <script src="<?= Router\Router::$defaultUri ?>js/dashboard-script.js"></script>
    <script src="<?= Router\Router::$defaultUri ?>js/user-dropdown.js"></script>
</body>
</html>

