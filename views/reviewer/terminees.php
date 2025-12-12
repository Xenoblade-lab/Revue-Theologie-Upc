<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluations terminées - Reviewer</title>
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
                    <h1>Évaluations terminées</h1>
                    <p>Historique des articles que vous avez évalués</p>
                </div>
            </div>

            <div class="content-card fade-up" style="margin-bottom: var(--spacing-xl);">
                <div class="card-header">
                    <h2>Articles évalués</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Soumis le</th>
                            <th>Statut</th>
                            <th>Date d'échéance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($evaluations)): ?>
                            <?php foreach ($evaluations as $evaluation): ?>
                                <tr>
                                    <td><?= htmlspecialchars($evaluation['article_titre'] ?? 'Titre indisponible') ?></td>
                                    <td><?= !empty($evaluation['article_date']) ? date('d M Y', strtotime($evaluation['article_date'])) : '—' ?></td>
                                    <td><span class="status-badge published">Terminé</span></td>
                                    <td><?= !empty($evaluation['date_echeance']) ? date('d M Y', strtotime($evaluation['date_echeance'])) : '—' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align:center; padding:2rem;">Aucune évaluation terminée pour le moment.</td>
                            </tr>
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

