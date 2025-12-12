<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'article - Dashboard Auteur</title>
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
                    <a href="<?= Router\Router::route("author") ?>" class="back-link" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--color-blue); text-decoration: none; margin-bottom: 0.5rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                        Retour au tableau de bord
                    </a>
                    <h1>Détails de l'article</h1>
                    <p>Informations complètes sur votre soumission</p>
                </div>
                <div class="header-actions">
                    <?php if (isset($article) && $article['statut'] === 'soumis'): ?>
                        <a href="<?= Router\Router::route("author") ?>/article/<?= $article['id'] ?>/edit" class="btn btn-primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Modifier
                        </a>
                        <button onclick="deleteArticle(<?= $article['id'] ?>)" class="btn btn-outline" style="color: var(--color-red); border-color: var(--color-red);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                            Supprimer
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (isset($article) && $article): ?>
                <!-- Article Details -->
                <div class="content-card fade-up">
                    <div class="card-header">
                        <h2><?= htmlspecialchars($article['titre']) ?></h2>
                        <span class="status-badge <?= 
                            strpos(strtolower($article['statut']), 'publi') !== false ? 'published' : 
                            (strpos(strtolower($article['statut']), 'accept') !== false ? 'accepted' : 
                            (strpos(strtolower($article['statut']), 'évaluation') !== false || strpos(strtolower($article['statut']), 'evaluation') !== false ? 'in-review' : 
                            (strpos(strtolower($article['statut']), 'rejet') !== false ? 'rejected' : 'soumis')))
                        ?>">
                            <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $article['statut']))) ?>
                        </span>
                    </div>

                    <div class="article-details-content">
                        <!-- Informations générales -->
                        <div class="detail-section">
                            <h3>Informations générales</h3>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <label>Date de soumission</label>
                                    <p><?= date('d M Y à H:i', strtotime($article['date_soumission'] ?? $article['created_at'])) ?></p>
                                </div>
                                <div class="detail-item">
                                    <label>Dernière modification</label>
                                    <p><?= date('d M Y à H:i', strtotime($article['updated_at'])) ?></p>
                                </div>
                                <div class="detail-item">
                                    <label>Auteur</label>
                                    <p><?= htmlspecialchars(($article['auteur_prenom'] ?? '') . ' ' . ($article['auteur_nom'] ?? '')) ?></p>
                                </div>
                                <div class="detail-item">
                                    <label>Email</label>
                                    <p><?= htmlspecialchars($article['auteur_email'] ?? '') ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Résumé -->
                        <?php if (!empty($article['contenu'])): ?>
                            <div class="detail-section">
                                <h3>Résumé</h3>
                                <p class="article-content"><?= nl2br(htmlspecialchars($article['contenu'])) ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Fichier -->
                        <?php if (!empty($article['fichier_path'])): ?>
                            <div class="detail-section">
                                <h3>Fichier joint</h3>
                                <div class="file-info">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    <div>
                                        <p><strong><?= htmlspecialchars(basename($article['fichier_path'])) ?></strong></p>
                                        <a href="<?= Router\Router::$defaultUri . htmlspecialchars($article['fichier_path']) ?>" class="btn btn-outline" target="_blank" style="margin-top: 0.5rem;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="7 10 12 15 17 10"></polyline>
                                                <line x1="12" y1="15" x2="12" y2="3"></line>
                                            </svg>
                                            Télécharger le fichier
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Workflow -->
                        <div class="detail-section">
                            <h3>État du workflow</h3>
                            <div class="workflow-steps">
                                <?php
                                $statut = strtolower($article['statut'] ?? 'soumis');
                                $steps = [
                                    ['name' => 'Reçu', 'completed' => true],
                                    ['name' => 'En évaluation', 'completed' => in_array($statut, ['en évaluation', 'en_evaluation', 'en evaluation', 'accepté', 'accepte', 'accepted', 'publié', 'publie', 'published'])],
                                    ['name' => 'Révisions', 'completed' => in_array($statut, ['accepté', 'accepte', 'accepted', 'publié', 'publie', 'published'])],
                                    ['name' => 'Accepté', 'completed' => in_array($statut, ['accepté', 'accepte', 'accepted', 'publié', 'publie', 'published'])],
                                    ['name' => 'Publié', 'completed' => in_array($statut, ['publié', 'publie', 'published'])]
                                ];
                                $currentStep = 0;
                                foreach ($steps as $index => $step) {
                                    if ($step['completed']) $currentStep = $index;
                                }
                                ?>
                                <?php foreach ($steps as $index => $step): ?>
                                    <div class="workflow-step <?= $step['completed'] ? 'completed' : '' ?> <?= $index === $currentStep && !$step['completed'] ? 'current' : '' ?>">
                                        <div class="step-icon">
                                            <?php if ($step['completed']): ?>
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            <?php elseif ($index === $currentStep && !$step['completed']): ?>
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                            <?php else: ?>
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                        <span><?= $step['name'] ?></span>
                                    </div>
                                    <?php if ($index < count($steps) - 1): ?>
                                        <div class="workflow-arrow <?= $step['completed'] ? 'completed' : '' ?>">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="9 18 15 12 9 6"></polyline>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="content-card fade-up">
                    <div class="empty-state">
                        <h3>Article introuvable</h3>
                        <p>L'article que vous recherchez n'existe pas ou vous n'avez pas les droits pour le consulter.</p>
                        <a href="<?= Router\Router::route("author") ?>" class="btn btn-primary">Retour au tableau de bord</a>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script src="<?= Router\Router::$defaultUri ?>js/script.js"></script>
    <script src="<?= Router\Router::$defaultUri ?>js/dashboard-script.js"></script>
    <script src="<?= Router\Router::$defaultUri ?>js/user-dropdown.js"></script>
    <script>
        function deleteArticle(id) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.')) {
                return;
            }
            
            fetch('<?= Router\Router::route("author") ?>/article/' + id + '/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message) {
                    alert(data.message || 'Article supprimé avec succès');
                    window.location.href = '<?= Router\Router::route("author") ?>';
                } else {
                    alert(data.error || 'Une erreur est survenue lors de la suppression');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la suppression de l\'article');
            });
        }
    </script>
</body>
</html>

