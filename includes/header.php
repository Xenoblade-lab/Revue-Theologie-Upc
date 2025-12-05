<?php
// Déterminer le chemin de base selon l'emplacement du fichier
$basePath = '';
if (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) {
    $basePath = '../';
} elseif (strpos($_SERVER['PHP_SELF'], '/gestion/') !== false) {
    $basePath = '../';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' – ' : ''; ?>Revue de la Faculté de Théologie – UPC</title>
    <link rel="stylesheet" href="<?php echo $basePath; ?>css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <?php if (isset($additionalCSS)): ?>
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>

