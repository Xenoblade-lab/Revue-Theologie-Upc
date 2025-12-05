<?php
/**
 * Test simple sans includes
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Test Simple</h1>";
echo "<p>PHP fonctionne !</p>";
echo "<p>Version PHP: " . phpversion() . "</p>";

echo "<h2>Test includes</h2>";
try {
    require_once __DIR__ . '/includes/db.php';
    echo "<p style='color: green;'>✓ DB chargé</p>";
    
    if (isset($pdo)) {
        echo "<p style='color: green;'>✓ PDO initialisé</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erreur: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "<h2>Test pages</h2>";
echo "<p><a href='pages/login.php'>Test login.php</a></p>";
echo "<p><a href='pages/index.php'>Test index.php</a></p>";
?>

