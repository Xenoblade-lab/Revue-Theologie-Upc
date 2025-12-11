<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement & Paiements - Dashboard Auteur</title>
    <link rel="stylesheet" href="<?= Router\Router::$defaultUri ?>css/styles.css">
    <link rel="stylesheet" href="<?= Router\Router::$defaultUri ?>css/dashboard-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <?php include __DIR__ . DIRECTORY_SEPARATOR . '_sidebar.php'; ?>
        
        <!-- Main Content -->
        <main class="dashboard-main">
            <!-- Header -->
            <div class="dashboard-header fade-up">
                <div class="header-title">
                    <h1>Abonnement & Paiements</h1>
                    <p>Gérez votre abonnement et consultez l'historique de vos paiements</p>
                </div>
            </div>

            <!-- Abonnement Status -->
            <?php if (isset($abonnement) && $abonnement): ?>
                <div class="content-card fade-up">
                    <div class="card-header">
                        <h2>Statut de l'abonnement</h2>
                    </div>
                    <div class="subscription-status">
                        <div class="status-badge <?= $abonnement['statut'] === 'actif' ? 'published' : ($abonnement['statut'] === 'expire' ? 'rejected' : 'in-review') ?>">
                            <?= ucfirst(str_replace('_', ' ', $abonnement['statut'])) ?>
                        </div>
                        <?php if ($abonnement['statut'] === 'actif'): ?>
                            <div class="subscription-dates">
                                <p><strong>Date de début:</strong> <?= date('d M Y', strtotime($abonnement['date_debut'])) ?></p>
                                <p><strong>Date de fin:</strong> <?= date('d M Y', strtotime($abonnement['date_fin'])) ?></p>
                                <?php 
                                $daysLeft = (strtotime($abonnement['date_fin']) - time()) / (60 * 60 * 24);
                                if ($daysLeft > 0):
                                ?>
                                    <p class="days-left"><strong><?= ceil($daysLeft) ?> jours</strong> restants</p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="content-card fade-up">
                    <div class="empty-state">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <h3>Aucun abonnement actif</h3>
                        <p>Vous n'avez pas d'abonnement actif pour le moment.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Paiements History -->
            <div class="content-card fade-up">
                <div class="card-header">
                    <h2>Historique des paiements</h2>
                </div>
                
                <?php if (isset($paiements) && !empty($paiements)): ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Moyen de paiement</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paiements as $paiement): ?>
                                <tr>
                                    <td><?= date('d M Y', strtotime($paiement['date_paiement'] ?? $paiement['created_at'])) ?></td>
                                    <td><strong><?= number_format($paiement['montant'], 2, ',', ' ') ?> $</strong></td>
                                    <td><?= ucfirst(str_replace('_', ' ', $paiement['moyen'])) ?></td>
                                    <td>
                                        <span class="status-badge <?= $paiement['statut'] === 'valide' ? 'published' : ($paiement['statut'] === 'refuse' ? 'rejected' : 'in-review') ?>">
                                            <?= ucfirst(str_replace('_', ' ', $paiement['statut'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($paiement['recu_path'])): ?>
                                            <a href="<?= Router\Router::$defaultUri . htmlspecialchars($paiement['recu_path']) ?>" class="btn btn-outline" target="_blank">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                    <polyline points="7 10 12 15 17 10"></polyline>
                                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                                </svg>
                                                Reçu
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-state">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        <h3>Aucun paiement enregistré</h3>
                        <p>Vous n'avez pas encore effectué de paiement.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script src="<?= Router\Router::$defaultUri ?>js/script.js"></script>
    <script src="<?= Router\Router::$defaultUri ?>js/dashboard-script.js"></script>
    <script src="<?= Router\Router::$defaultUri ?>js/user-dropdown.js"></script>
</body>
</html>

