<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revue de la Faculté de Théologie – UPC</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="comite-styles.css">
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
        <a href="comite.html" class="active">Comité</a>
        <a href="recherche.html">Recherche</a>
        <a href="soumettre.html" class="btn btn-primary btn-submit-mobile">Soumettre un article</a>
    </nav>
    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="fade-up">Comité éditorial</h1>
            <p class="fade-up">L'équipe en charge de l'évaluation scientifique et de la direction éditoriale de la revue</p>
        </div>
    </section>

    <!-- Committee Section -->
    <section class="committee-section">
        <div class="container">
            <div class="filters-bar fade-up">
                <button class="filter-btn is-active" data-role="all">Tous</button>
                <button class="filter-btn" data-role="direction">Direction</button>
                <button class="filter-btn" data-role="scientifique">Comité scientifique</button>
                <button class="filter-btn" data-role="redaction">Comité de rédaction</button>
            </div>

            <div class="committee-grid">
                <!-- Direction -->
                <article class="member-card fade-up" data-role="direction">
                    <div class="member-photo-container">
                        <div class="member-photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="member-info">
                        <span class="member-role-badge">Direction</span>
                        <h2 class="member-name">Dr. Jean-Baptiste Nkulu</h2>
                        <p class="member-title">Rédacteur en chef</p>
                        <p class="member-role">Direction générale de la revue et coordination éditoriale</p>
                        <a href="mailto:jb.nkulu@upc.ac.cd" class="member-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            jb.nkulu@upc.ac.cd
                        </a>
                    </div>
                </article>

                <article class="member-card fade-up" data-role="direction">
                    <div class="member-photo-container">
                        <div class="member-photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="member-info">
                        <span class="member-role-badge">Direction</span>
                        <h2 class="member-name">Pr. Marie Kabongo</h2>
                        <p class="member-title">Rédactrice en chef adjointe</p>
                        <p class="member-role">Coordination des évaluations et suivi éditorial</p>
                        <a href="mailto:m.kabongo@upc.ac.cd" class="member-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            m.kabongo@upc.ac.cd
                        </a>
                    </div>
                </article>

                <!-- Comité scientifique -->
                <article class="member-card fade-up" data-role="scientifique">
                    <div class="member-photo-container">
                        <div class="member-photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="member-info">
                        <span class="member-role-badge">Comité scientifique</span>
                        <h2 class="member-name">Pr. Samuel Mulamba</h2>
                        <p class="member-title">Président du comité scientifique</p>
                        <p class="member-role">Théologie systématique et herméneutique biblique</p>
                        <a href="mailto:s.mulamba@upc.ac.cd" class="member-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            s.mulamba@upc.ac.cd
                        </a>
                    </div>
                </article>

                <article class="member-card fade-up" data-role="scientifique">
                    <div class="member-photo-container">
                        <div class="member-photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="member-info">
                        <span class="member-role-badge">Comité scientifique</span>
                        <h2 class="member-name">Dr. Grace Mwamba</h2>
                        <p class="member-title">Membre du comité scientifique</p>
                        <p class="member-role">Éthique chrétienne et théologie pratique</p>
                        <a href="mailto:g.mwamba@upc.ac.cd" class="member-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            g.mwamba@upc.ac.cd
                        </a>
                    </div>
                </article>

                <article class="member-card fade-up" data-role="scientifique">
                    <div class="member-photo-container">
                        <div class="member-photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="member-info">
                        <span class="member-role-badge">Comité scientifique</span>
                        <h2 class="member-name">Pr. Paul Ilunga</h2>
                        <p class="member-title">Membre du comité scientifique</p>
                        <p class="member-role">Histoire de l'Église et missiologie</p>
                        <a href="mailto:p.ilunga@upc.ac.cd" class="member-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            p.ilunga@upc.ac.cd
                        </a>
                    </div>
                </article>

                <!-- Comité de rédaction -->
                <article class="member-card fade-up" data-role="redaction">
                    <div class="member-photo-container">
                        <div class="member-photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="member-info">
                        <span class="member-role-badge">Comité de rédaction</span>
                        <h2 class="member-name">Dr. Joseph Tshiamala</h2>
                        <p class="member-title">Secrétaire de rédaction</p>
                        <p class="member-role">Gestion des soumissions et révision éditoriale</p>
                        <a href="mailto:j.tshiamala@upc.ac.cd" class="member-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            j.tshiamala@upc.ac.cd
                        </a>
                    </div>
                </article>

                <article class="member-card fade-up" data-role="redaction">
                    <div class="member-photo-container">
                        <div class="member-photo-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="member-info">
                        <span class="member-role-badge">Comité de rédaction</span>
                        <h2 class="member-name">Dr. Esther Kalala</h2>
                        <p class="member-title">Membre du comité de rédaction</p>
                        <p class="member-role">Révision linguistique et mise en forme</p>
                        <a href="mailto:e.kalala@upc.ac.cd" class="member-contact">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            e.kalala@upc.ac.cd
                        </a>
                    </div>
                </article>
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

    <script src="script.js"></script>
    <script src="comite-script.js"></script>

</body></html>