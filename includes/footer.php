<?php
// Déterminer le chemin de base selon l'emplacement du fichier
$basePath = '';
if (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) {
    $basePath = '../';
} elseif (strpos($_SERVER['PHP_SELF'], '/gestion/') !== false) {
    $basePath = '../';
}
?>
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
                        <li><a href="<?php echo $basePath; ?>pages/index.php">Accueil</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/numeros.php">Numéros & Archives</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/soumettre-article.php">Soumettre un article</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/consignes-auteurs.php">Instructions aux auteurs</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Ressources</h4>
                    <ul>
                        <li><a href="<?php echo $basePath; ?>pages/comite-editorial.php">Comité éditorial</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/recherche.php">Recherche avancée</a></li>
                        <li><a href="<?php echo $basePath; ?>pages/politique-editoriale.php">Politique éditoriale</a></li>
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
                <p>&copy; <?php echo date('Y'); ?> Revue de la Faculté de Théologie - UPC. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="<?php echo $basePath; ?>js/main.js"></script>
    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>

