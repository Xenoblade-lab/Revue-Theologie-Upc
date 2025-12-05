<?php
/**
 * Fichier de test pour vérifier la configuration
 */
echo "<h1>Test PHP</h1>";
echo "<p>PHP fonctionne !</p>";
echo "<p>Chemin actuel : " . __DIR__ . "</p>";
echo "<p>Script : " . $_SERVER['PHP_SELF'] . "</p>";

// Test des includes
echo "<h2>Test des includes</h2>";
if (file_exists(__DIR__ . '/includes/db.php')) {
    echo "<p style='color: green;'>✓ includes/db.php existe</p>";
    require_once __DIR__ . '/includes/db.php';
    echo "<p style='color: green;'>✓ includes/db.php chargé</p>";
} else {
    echo "<p style='color: red;'>✗ includes/db.php n'existe pas</p>";
}

if (file_exists(__DIR__ . '/includes/auth.php')) {
    echo "<p style='color: green;'>✓ includes/auth.php existe</p>";
} else {
    echo "<p style='color: red;'>✗ includes/auth.php n'existe pas</p>";
}

echo "<h2>Test base de données</h2>";
try {
    if (isset($pdo)) {
        echo "<p style='color: green;'>✓ Connexion PDO établie</p>";
    } else {
        echo "<p style='color: orange;'>⚠ PDO non initialisé</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erreur : " . $e->getMessage() . "</p>";
}
?>

