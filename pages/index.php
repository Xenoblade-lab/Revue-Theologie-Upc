<?php
/**
 * Page d'accueil publique
 * Revue de la Faculté de Théologie - UPC
 */

$pageTitle = "Accueil";
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar-public.php';
?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content fade-up">
                <span class="hero-badge">Revue Académique Internationale</span>
                <h1 class="hero-title">Revue de la Faculté de Théologie</h1>
                <p class="hero-subtitle">Université Protestante au Congo</p>
                <p class="hero-description">
                    Publication scientifique de référence en théologie africaine et études bibliques. 
                    Nous publions des recherches innovantes qui contribuent au dialogue théologique mondial.
                </p>
                <div class="hero-actions">
                    <a href="numeros.php" class="btn btn-primary">Lire le dernier numéro</a>
                    <a href="soumettre-article.php" class="btn btn-secondary">Soumettre un article</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Issue Section -->
    <section class="latest-issue">
        <div class="container">
            <div class="section-header fade-up">
                <h2>Dernier numéro publié</h2>
                <a href="numeros.php" class="view-all">Voir tous les numéros →</a>
            </div>
            <div class="issue-featured fade-up">
                <div class="issue-cover">
                    <img src="../logo_upc.png" alt="Volume 28, Numéro 1">
                    <span class="issue-badge">Nouveau</span>
                </div>
                <div class="issue-details">
                    <div class="issue-meta">
                        <span class="volume">Volume 28</span>
                        <span class="number">Numéro 1</span>
                        <span class="year">2025</span>
                    </div>
                    <h3>Théologie Contextuelle et Défis Contemporains en Afrique</h3>
                    <p class="issue-description">
                        Ce numéro explore les nouvelles perspectives de la théologie africaine face aux défis sociaux, 
                        politiques et environnementaux du XXIe siècle. Des contributions majeures d'érudits africains 
                        et internationaux offrent des réflexions innovantes sur l'inculturation, l'herméneutique biblique 
                        et l'éthique chrétienne.
                    </p>
                    <div class="issue-stats">
                        <div class="stat">
                            <strong>12</strong>
                            <span>Articles</span>
                        </div>
                        <div class="stat">
                            <strong>8</strong>
                            <span>Pays</span>
                        </div>
                        <div class="stat">
                            <strong>250</strong>
                            <span>Pages</span>
                        </div>
                    </div>
                    <div class="issue-actions">
                        <a href="numero-detail.php?id=1" class="btn btn-primary">Lire le numéro</a>
                        <a href="#" class="btn btn-outline">Télécharger PDF</a>
                    </div>
                </div>
            </div>
            
            <!-- Featured Articles -->
            <div class="featured-articles">
                <h3 class="section-title fade-up">Articles en vedette</h3>
                <div class="articles-grid">
                    <article class="article-card fade-up">
                        <span class="article-category">Théologie Systématique</span>
                        <h4>La pneumatologie africaine : une réflexion trinitaire</h4>
                        <p class="article-authors">Dr. Jean-Baptiste Nkulu, Pr. Marie Kabongo</p>
                        <p class="article-excerpt">
                            Une exploration de la compréhension africaine de l'Esprit Saint dans le contexte 
                            de la théologie trinitaire contemporaine...
                        </p>
                        <div class="article-meta">
                            <span class="pages">pp. 15-42</span>
                            <span class="doi">DOI: 10.5281/zenodo.12345</span>
                        </div>
                        <a href="article.php?id=1" class="article-link">Lire l'article →</a>
                    </article>
                    
                    <article class="article-card fade-up">
                        <span class="article-category">Études Bibliques</span>
                        <h4>Herméneutique décoloniale et lecture africaine de l'Exode</h4>
                        <p class="article-authors">Pr. Samuel Mulamba</p>
                        <p class="article-excerpt">
                            Comment les communautés africaines lisent-elles le récit de l'Exode à travers 
                            leurs propres expériences historiques...
                        </p>
                        <div class="article-meta">
                            <span class="pages">pp. 43-68</span>
                            <span class="doi">DOI: 10.5281/zenodo.12346</span>
                        </div>
                        <a href="article.php?id=2" class="article-link">Lire l'article →</a>
                    </article>
                    
                    <article class="article-card fade-up">
                        <span class="article-category">Éthique Chrétienne</span>
                        <h4>Justice environnementale et responsabilité écologique chrétienne</h4>
                        <p class="article-authors">Dr. Grace Mwamba, Dr. Paul Ilunga</p>
                        <p class="article-excerpt">
                            L'urgence climatique interpelle la théologie africaine : quelle éthique 
                            environnementale pour les Églises congolaises...
                        </p>
                        <div class="article-meta">
                            <span class="pages">pp. 69-95</span>
                            <span class="doi">DOI: 10.5281/zenodo.12347</span>
                        </div>
                        <a href="article.php?id=3" class="article-link">Lire l'article →</a>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- News & Events -->
    <section class="news-section">
        <div class="container">
            <div class="section-header fade-up">
                <h2>Actualités & Événements</h2>
                <a href="#" class="view-all">Voir tout →</a>
            </div>
            <div class="news-grid">
                <article class="news-card fade-up">
                    <span class="news-date">15 Janvier 2025</span>
                    <h4>Appel à contributions : Numéro spécial sur l'ecclésiologie africaine</h4>
                    <p>Nous sollicitons des articles pour notre numéro thématique de décembre 2025...</p>
                    <a href="#" class="news-link">Lire la suite →</a>
                </article>
                
                <article class="news-card fade-up">
                    <span class="news-date">10 Janvier 2025</span>
                    <h4>Colloque international : Théologie et développement durable</h4>
                    <p>La Faculté organise un colloque du 15-17 mars 2025 à Kinshasa...</p>
                    <a href="#" class="news-link">Lire la suite →</a>
                </article>
                
                <article class="news-card fade-up">
                    <span class="news-date">5 Janvier 2025</span>
                    <h4>Nouvelles procédures de soumission</h4>
                    <p>Découvrez nos nouvelles directives simplifiées pour la soumission d'articles...</p>
                    <a href="consignes-auteurs.php" class="news-link">Lire la suite →</a>
                </article>
            </div>
        </div>
    </section>

    <!-- Submit Section -->
    <section class="submit-section">
        <div class="container">
            <div class="submit-content fade-up">
                <div class="submit-text">
                    <h2>Publiez votre recherche</h2>
                    <p>
                        Rejoignez une communauté de chercheurs internationaux et partagez vos contributions 
                        à la théologie africaine. Notre processus d'évaluation par les pairs garantit 
                        l'excellence académique.
                    </p>
                    <ul class="submit-benefits">
                        <li>Évaluation rigoureuse par des pairs</li>
                        <li>Visibilité internationale</li>
                        <li>Indexation dans les principales bases de données</li>
                        <li>Accès libre (Open Access option)</li>
                    </ul>
                    <a href="soumettre-article.php" class="btn btn-primary">Soumettre un article</a>
                </div>
                <div class="submit-image">
                    <img src="../logo_upc.png" alt="Recherche académique">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-text fade-up">
                    <h2>À propos de la revue</h2>
                    <p>
                        Fondée en 1997, la Revue de la Faculté de Théologie de l'Université Protestante 
                        au Congo est une publication semestrielle à comité de lecture qui promeut la recherche 
                        théologique en Afrique et dans le monde.
                    </p>
                    <p>
                        Notre mission est de fournir une plateforme académique de premier plan pour le dialogue 
                        théologique, l'innovation herméneutique et la réflexion critique sur les enjeux 
                        contemporains de la foi chrétienne.
                    </p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <strong>28</strong>
                            <span>Années de publication</span>
                        </div>
                        <div class="stat-item">
                            <strong>500+</strong>
                            <span>Articles publiés</span>
                        </div>
                        <div class="stat-item">
                            <strong>45</strong>
                            <span>Pays représentés</span>
                        </div>
                    </div>
                </div>
                <div class="about-image fade-up">
                    <img src="../logo_upc.png" alt="Université Protestante au Congo">
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content fade-up">
                <div class="newsletter-text">
                    <h2>Restez informé</h2>
                    <p>Recevez les notifications de nouveaux numéros, appels à contributions et événements.</p>
                </div>
                <form class="newsletter-form" method="POST" action="#">
                    <input type="email" name="email" placeholder="Votre adresse email" required>
                    <button type="submit" class="btn btn-primary">S'abonner</button>
                </form>
            </div>
        </div>
    </section>

<?php
require_once __DIR__ . '/../includes/footer.php';
?>
