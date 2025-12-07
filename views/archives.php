<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Numéros & Archives - Revue de Théologie UPC</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/numeros-styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <?php include __DIR__ .  DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'header.php'; ?>
    <!-- Mobile Navigation -->
    <nav class="mobile-nav">
        <a href="<?= Router\Router::route('') ?>">Accueil</a>
        <a href="<?= Router\Router::route('archives') ?>" class="active">Numéros & Archives</a>
        <a href="<?= Router\Router::route('submit') ?>">Soumettre</a>
        <a href="<?= Router\Router::route('instructions') ?>">Instructions</a>
        <a href="<?= Router\Router::route('comite') ?>">Comité</a>
        <a href="<?= Router\Router::route('research') ?>">Recherche</a>
        <a href="<?= Router\Router::route('submit') ?>" class="btn btn-primary btn-submit-mobile">Soumettre un article</a>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="fade-up">Numéros & Archives</h1>
            <p class="fade-up">Explorez nos publications scientifiques en théologie africaine</p>
        </div>
    </section>

    <!-- Archives Navigation -->
    <section class="archives-section">
        <div class="container">
            <div class="archives-nav fade-up">
                <button class="year-btn active" data-year="2025">2025</button>
                <button class="year-btn" data-year="2024">2024</button>
                <button class="year-btn" data-year="2023">2023</button>
                <button class="year-btn" data-year="2022">2022</button>
                <button class="year-btn" data-year="2021">2021</button>
            </div>

            <!-- 2025 Issues -->
            <div class="year-content active" data-year="2025">
                <div class="issues-grid">
                    <div class="issue-card fade-up">
                        <div class="issue-cover-small">
                            <img src="logo_upc.png" alt="Volume 28, No 1">
                            <span class="issue-badge-small">Nouveau</span>
                        </div>
                        <div class="issue-info">
                            <div class="issue-meta-small">
                                <span>Vol. 28</span>
                                <span>No 1</span>
                                <span>2025</span>
                            </div>
                            <h3>Théologie Contextuelle et Défis Contemporains</h3>
                            <p>Exploration des perspectives théologiques africaines face aux enjeux modernes...</p>
                            <div class="issue-stats-small">
                                <span>12 articles</span>
                                <span>250 pages</span>
                            </div>
                            <div class="issue-actions-small">
                                <button class="btn btn-primary">Lire</button>
                                <button class="btn btn-outline">PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2024 Issues -->
            <div class="year-content" data-year="2024">
                <div class="issues-grid">
                    <div class="issue-card fade-up">
                        <div class="issue-cover-small">
                            <img src="/placeholder.svg?height=300&width=210" alt="Volume 27, No 2">
                        </div>
                        <div class="issue-info">
                            <div class="issue-meta-small">
                                <span>Vol. 27</span>
                                <span>No 2</span>
                                <span>2024</span>
                            </div>
                            <h3>Ecclésiologie et Mission en Afrique</h3>
                            <p>Réflexions sur l'Église africaine et son rôle missionnaire dans le monde contemporain...</p>
                            <div class="issue-stats-small">
                                <span>10 articles</span>
                                <span>220 pages</span>
                            </div>
                            <div class="issue-actions-small">
                                <button class="btn btn-primary">Lire</button>
                                <button class="btn btn-outline">PDF</button>
                            </div>
                        </div>
                    </div>

                    <div class="issue-card fade-up">
                        <div class="issue-cover-small">
                            <img src="/placeholder.svg?height=300&width=210" alt="Volume 27, No 1">
                        </div>
                        <div class="issue-info">
                            <div class="issue-meta-small">
                                <span>Vol. 27</span>
                                <span>No 1</span>
                                <span>2024</span>
                            </div>
                            <h3>Éthique Chrétienne et Justice Sociale</h3>
                            <p>Perspectives bibliques et théologiques sur la justice, l'équité et la transformation sociale...</p>
                            <div class="issue-stats-small">
                                <span>11 articles</span>
                                <span>235 pages</span>
                            </div>
                            <div class="issue-actions-small">
                                <button class="btn btn-primary">Lire</button>
                                <button class="btn btn-outline">PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>Revue de Théologie UPC</h3>
                    <p>
                        Université Protestante au Congo<br>
                        Faculté de Théologie<br>
                        Kinshasa, RD Congo
                    </p>
                </div>
                <div class="footer-col">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="<?= Router\Router::route('') ?>">Accueil</a></li>
                        <li><a href="<?= Router\Router::route('archives') ?>">Numéros & Archives</a></li>
                        <li><a href="soumettre.html">Soumettre un article</a></li>
                        <li><a href="instructions.html">Instructions aux auteurs</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Ressources</h4>
                    <ul>
                        <li><a href="comite.html">Comité éditorial</a></li>
                        <li><a href="recherche.html">Recherche avancée</a></li>
                        <li><a href="#">Politique éditoriale</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Suivez-nous</h4>
                    <div class="social-links">
                        <a href="#">Facebook</a>
                        <a href="#">Twitter</a>
                        <a href="#">LinkedIn</a>
                        <a href="#">ResearchGate</a>
                    </div>
                    <p class="footer-issn">ISSN: 1234-5678</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Revue de la Faculté de Théologie - UPC. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="./js/script.js"></script>
    <script src="./js/numeros-script.js"></script>
</body>
</html>
