<?php
/**
 * Vérification des erreurs PHP
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<h1>Vérification des erreurs</h1>";

// Test 1: Includes
echo "<h2>Test 1: Includes</h2>";
try {
    require_once __DIR__ . '/includes/db.php';
    echo "<p style='color: green;'>✓ includes/db.php OK</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erreur db.php: " . $e->getMessage() . "</p>";
}

try {
    require_once __DIR__ . '/includes/auth.php';
    echo "<p style='color: green;'>✓ includes/auth.php OK</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erreur auth.php: " . $e->getMessage() . "</p>";
}

// Test 2: Syntaxe des fichiers gestion
echo "<h2>Test 2: Syntaxe fichiers gestion</h2>";
$files = [
    'gestion/login.php',
    'gestion/logout.php',
    'gestion/inscription_auteur.php'
];

foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    if (file_exists($path)) {
        // Vérifier la syntaxe
        $output = [];
        $return = 0;
        exec("php -l " . escapeshellarg($path) . " 2>&1", $output, $return);
        if ($return === 0) {
            echo "<p style='color: green;'>✓ $file - Syntaxe OK</p>";
        } else {
            echo "<p style='color: red;'>✗ $file - Erreur de syntaxe:</p>";
            echo "<pre>" . implode("\n", $output) . "</pre>";
        }
    } else {
        echo "<p style='color: orange;'>⚠ $file n'existe pas</p>";
    }
}

// Test 3: Syntaxe des fichiers pages
echo "<h2>Test 3: Syntaxe fichiers pages</h2>";
$pageFiles = [
    'pages/login.php',
    'pages/inscription-auteur.php',
    'pages/index.php'
];

foreach ($pageFiles as $file) {
    $path = __DIR__ . '/' . $file;
    if (file_exists($path)) {
        $output = [];
        $return = 0;
        exec("php -l " . escapeshellarg($path) . " 2>&1", $output, $return);
        if ($return === 0) {
            echo "<p style='color: green;'>✓ $file - Syntaxe OK</p>";
        } else {
            echo "<p style='color: red;'>✗ $file - Erreur de syntaxe:</p>";
            echo "<pre>" . implode("\n", $output) . "</pre>";
        }
    }
}

// Test 4: Test connexion DB
echo "<h2>Test 4: Connexion base de données</h2>";
try {
    if (isset($pdo)) {
        $stmt = $pdo->query("SELECT 1");
        echo "<p style='color: green;'>✓ Connexion DB OK</p>";
    } else {
        echo "<p style='color: orange;'>⚠ PDO non initialisé</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erreur DB: " . $e->getMessage() . "</p>";
}

// Test 5: Variables serveur
echo "<h2>Test 5: Variables serveur</h2>";
echo "<pre>";
echo "PHP_SELF: " . ($_SERVER['PHP_SELF'] ?? 'N/A') . "\n";
echo "SCRIPT_NAME: " . ($_SERVER['SCRIPT_NAME'] ?? 'N/A') . "\n";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
echo "</pre>";
?>

