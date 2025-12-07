<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revue de la Faculté de Théologie – UPC</title>
     <link rel="stylesheet" href="./css/styles.css">
     <link rel="stylesheet" href="./css/recherche-styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <?php include __DIR__ .  DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'header.php'; ?>

    <!-- Mobile Navigation -->
    <nav class="mobile-nav">
        <a href="index.html">Accueil</a>
        <a href="numeros.html">Numéros & Archives</a>
        <a href="soumettre.html">Soumettre</a>
        <a href="instructions.html">Instructions</a>
        <a href="comite.html">Comité</a>
        <a href="recherche.html" class="active">Recherche</a>
        <a href="soumettre.html" class="btn btn-primary btn-submit-mobile">Soumettre un article</a>
    </nav>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="fade-up">Recherche avancée</h1>
            <p class="fade-up">Affinez votre recherche par auteur, mot-clé, année et type de publication</p>
        </div>
    </section>

    <!-- Search Section --> 
    <section class="search-section">
        <div class="container">
            <div class="advanced-search-layout">
                <form class="search-panel fade-up" id="advanced-search-form">
                    <div class="form-group">
                        <label for="search-author">Auteur</label>
                        <input type="text" id="search-author" name="author"
                               placeholder="Nom, prénom de l'auteur" />
                    </div>

                    <div class="form-group">
                        <label for="search-keyword">Mot-clé</label>
                        <input type="text" id="search-keyword" name="keyword"
                               placeholder="Mot-clé, concept, thème…" />
                    </div>

                    <div class="form-group form-group-inline">
                        <div>
                            <label for="year-from">Année (de)</label>
                            <input type="number" id="year-from" name="year_from" min="1900" max="2100" placeholder="1997" />
                        </div>
                        <div>
                            <label for="year-to">Année (à)</label>
                            <input type="number" id="year-to" name="year_to" min="1900" max="2100" placeholder="2025" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Type de publication</label>
                        <div class="filters-chips">
                            <button type="button" class="chip is-selected" data-filter="all">
                                Tous les types
                            </button>
                            <button type="button" class="chip" data-filter="article">
                                Articles
                            </button>
                            <button type="button" class="chip" data-filter="note">
                                Notes de recherche
                            </button>
                            <button type="button" class="chip" data-filter="recension">
                                Recensions
                            </button>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Lancer la recherche
                        </button>
                        <button type="reset" class="btn btn-ghost">
                            Réinitialiser
                        </button>
                    </div>
                </form>

                <div class="results-panel fade-up">
                    <h2>Résultats</h2>
                    <p class="results-summary">
                        Saisissez vos critères puis lancez la recherche pour afficher les résultats.
                    </p>
                    <ul class="results-list" id="search-results">
                        <!-- Résultats dynamiques seront affichés ici -->
                    </ul>
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
                        <li><a href="index.html">Accueil</a></li>
                        <li><a href="numeros.html">Numéros & Archives</a></li>
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
    <script src="./js/recherche-script.js"></script>
</body>
</html>
   