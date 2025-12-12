<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Auteur - Revue de Théologie UPC</title>
    <link rel="stylesheet" href="<?= Router\Router::$defaultUri ?>css/styles.css">
    <link rel="stylesheet" href="<?= Router\Router::$defaultUri ?>css/dashboard-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="dashboard-layout">
        <!-- Sidebar -->
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

                <div class="nav-section">
                    <div class="nav-section-title">Principal</div>
                    <div class="nav-item active">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Tableau de bord</span>
                    </div>
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
                    <a href="<?= Router\Router::route("author") ?>/articles" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Articles publiés</span>
                    </a>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Compte</div>
                    <a href="<?= Router\Router::route("author") ?>/abonnement" class="nav-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        <span>Abonnement & Paiements</span>
                    </a>
                    <a href="<?= Router\Router::route("author") ?>/profil" class="nav-item">
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

        <!-- Main Content -->
        <main class="dashboard-main">
            <!-- Header -->
            <div class="dashboard-header fade-up">
                <div class="header-title">
                    <h1>Mes soumissions</h1>
                    <p>Suivez l'état de vos articles</p>
                </div>
                <div class="header-actions">
                    <button class="notification-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="notification-badge"></span>
                    </button>
                    <button class="btn btn-primary" onclick="window.location.href='#submit-form'">+ Soumettre un article</button>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card fade-up">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value"><?= isset($stats) ? $stats['total'] : 0 ?></div>
                    <div class="stat-label">Articles soumis</div>
                </div>

                <div class="stat-card fade-up">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value"><?= isset($stats) ? $stats['en_evaluation'] : 0 ?></div>
                    <div class="stat-label">En évaluation</div>
                </div>

                <div class="stat-card fade-up">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value"><?= isset($stats) ? $stats['publie'] : 0 ?></div>
                    <div class="stat-label">Publiés</div>
                </div>

                <div class="stat-card fade-up">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">$150</div>
                    <div class="stat-label">Paiements effectués</div>
                </div>
            </div>

            <!-- Submissions Table -->
            <div class="content-card fade-up" style="margin-bottom: var(--spacing-xl);" id="submissions-table">
                <div class="card-header">
                    <h2>Historique des soumissions</h2>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date de soumission</th>
                            <th>Statut</th>
                            <th>Workflow</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($articles) && !empty($articles)): ?>
                            <?php foreach ($articles as $article): ?>
                                <?php
                                $statut = strtolower($article['statut'] ?? 'soumis');
                                $statutClass = 'soumis';
                                if (strpos($statut, 'évaluation') !== false || strpos($statut, 'evaluation') !== false) {
                                    $statutClass = 'in-review';
                                } elseif (strpos($statut, 'accept') !== false) {
                                    $statutClass = 'accepted';
                                } elseif (strpos($statut, 'publi') !== false || strpos($statut, 'publish') !== false) {
                                    $statutClass = 'published';
                                } elseif (strpos($statut, 'rejet') !== false || strpos($statut, 'reject') !== false) {
                                    $statutClass = 'rejected';
                                }
                                
                                $dateFormatted = date('d M Y', strtotime($article['date_soumission']));
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($article['titre']) ?></td>
                                    <td><?= $dateFormatted ?></td>
                                    <td><span class="status-badge <?= $statutClass ?>"><?= htmlspecialchars($article['statut_display']) ?></span></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.75rem;">
                                            <span style="color: #10b981;">✓ Reçu</span>
                                            <span>→</span>
                                            <?php if ($statutClass === 'in-review'): ?>
                                                <span style="color: #2563eb; font-weight: 600;">● En évaluation</span>
                                                <span>→</span>
                                                <span style="color: #9ca3af;">○ Révisions</span>
                                                <span>→</span>
                                                <span style="color: #9ca3af;">○ Accepté</span>
                                                <span>→</span>
                                                <span style="color: #9ca3af;">○ Publié</span>
                                            <?php elseif ($statutClass === 'accepted'): ?>
                                                <span style="color: #10b981;">✓ En évaluation</span>
                                                <span>→</span>
                                                <span style="color: #10b981;">✓ Révisions</span>
                                                <span>→</span>
                                                <span style="color: #059669; font-weight: 600;">● Accepté</span>
                                                <span>→</span>
                                                <span style="color: #9ca3af;">○ Publié</span>
                                            <?php elseif ($statutClass === 'published'): ?>
                                                <span style="color: #10b981;">✓ Reçu</span>
                                                <span>→</span>
                                                <span style="color: #10b981;">✓ En évaluation</span>
                                                <span>→</span>
                                                <span style="color: #10b981;">✓ Révisions</span>
                                                <span>→</span>
                                                <span style="color: #10b981;">✓ Accepté</span>
                                                <span>→</span>
                                                <span style="color: #7c3aed; font-weight: 600;">● Publié</span>
                                            <?php else: ?>
                                                <span style="color: #2563eb; font-weight: 600;">● <?= htmlspecialchars($article['statut_display']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="action-btn view" title="Voir les détails" onclick="window.location.href='<?= Router\Router::route('articles') ?>/<?= $article['id'] ?>'">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 2rem;">
                                    <p>Aucun article soumis pour le moment.</p>
                                    <a href="#submit-form" class="btn btn-primary" style="margin-top: 1rem;">Soumettre votre premier article</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Submission Form -->
            <div class="content-card fade-up" id="submit-form">
                <div class="card-header">
                    <h2>Soumettre un nouvel article</h2>
                </div>
                <form class="auth-form" method="post" action="<?= Router\Router::route('articles') ?>" enctype="multipart/form-data" id="article-submission-form">
                    <input type="hidden" name="auteur_id" value="<?= isset($user) ? $user['id'] : '' ?>">
                    <div class="form-section">
                        <h3>Informations de l'article</h3>
                        <div class="form-field">
                            <label>Titre de l'article *</label>
                            <input type="text" placeholder="Titre complet de votre article" required name="titre">
                        </div>
                        <div class="form-row">
                            <div class="form-field">
                                <label>Catégorie *</label>
                                <select name="categorie" required>
                                    <option value="">Sélectionnez une catégorie</option>
                                    <option value="systematic">Théologie Systématique</option>
                                    <option value="biblical">Études Bibliques</option>
                                    <option value="ethics">Éthique Chrétienne</option>
                                    <option value="history">Histoire de l'Église</option>
                                    <option value="practical">Théologie Pratique</option>
                                </select>
                            </div>
                            <div class="form-field">
                                <label>Type de publication *</label>
                                <select name="type_publication" required>
                                    <option value="">Sélectionnez un type</option>
                                    <option value="article">Article de recherche</option>
                                    <option value="note">Note de recherche</option>
                                    <option value="review">Recension</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-field">
                            <label>Résumé (250 mots max) *</label>
                            <textarea name="contenu" placeholder="Résumé de votre article en français" required></textarea>
                        </div>
                        <div class="form-field">
                            <label>Mots-clés (5-7 mots) *</label>
                            <input type="text" name="mots_cles" placeholder="Séparés par des virgules" required>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3>Fichiers</h3>
                        <div class="form-field">
                            <label>Manuscrit (PDF, Word ou LaTeX) *</label>
                            <div class="file-upload">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p id="file-name-display">Glissez-déposez votre fichier ici ou</p>
                                <span>Parcourir</span>
                                <input type="file" name="doc" id="fichier-input" required accept=".pdf,.doc,.docx,.tex">
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; gap: var(--spacing-md); justify-content: flex-end;">
                        <button type="button" class="btn btn-outline">Sauvegarder le brouillon</button>
                        <button type="submit" class="btn btn-primary">Soumettre l'article</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobile-menu-btn">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <script src="<?= Router\Router::$defaultUri ?>js/script.js"></script>
    <!-- <script src="<?= Router\Router::$defaultUri ?>js/dashboard-script.js"></script> -->
   <script src="<?= Router\Router::$defaultUri ?>js/user-dropdown.js"></script>
    <!-- 
    <script>
        // Gérer l'affichage du nom du fichier
        document.getElementById('fichier-input')?.addEventListener('change', function(e) {
            const fileNameDisplay = document.getElementById('file-name-display');
            if (this.files.length > 0) {
                fileNameDisplay.textContent = 'Fichier sélectionné : ' + this.files[0].name;
                fileNameDisplay.style.color = 'var(--color-blue)';
                fileNameDisplay.style.fontWeight = '600';
            } else {
                fileNameDisplay.textContent = 'Glissez-déposez votre fichier ici ou';
                fileNameDisplay.style.color = '';
                fileNameDisplay.style.fontWeight = '';
            }
        });

        // Gérer la soumission du formulaire
        document.getElementById('article-submission-form')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            // Désactiver le bouton pendant la soumission
            submitBtn.disabled = true;
            submitBtn.textContent = 'Soumission en cours...';
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message) {
                    alert(data.message || 'Article soumis avec succès !');
                    this.reset();
                    document.getElementById('file-name-display').textContent = 'Glissez-déposez votre fichier ici ou';
                    document.getElementById('file-name-display').style.color = '';
                    document.getElementById('file-name-display').style.fontWeight = '';
                    // Recharger la page pour voir le nouvel article
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    alert(data.error || 'Une erreur est survenue lors de la soumission');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la soumission de l\'article');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    </script> -->
</body>
</html>