<?php
/**
 * Helper pour générer les badges de statuts avec leurs couleurs
 * Revue de Théologie UPC - Admin Dashboard
 */

/**
 * Retourne la classe CSS appropriée pour un badge de statut
 * 
 * @param string $statut Le statut à formater
 * @param string $type Le type de statut ('article', 'paiement', 'user', 'abonnement')
 * @return string La classe CSS pour le badge
 */
function getStatusBadgeClass($statut, $type = 'article') {
    $statut = strtolower(trim($statut));
    
    // Mapping des statuts vers les classes CSS
    $mapping = [
        // Articles
        'article' => [
            'soumis' => 'pending',
            'en_attente' => 'pending',
            'en attente' => 'pending',
            'en évaluation' => 'in-review',
            'en_evaluation' => 'in-review',
            'en evaluation' => 'in-review',
            'accepté' => 'accepted',
            'accepte' => 'accepted',
            'accepted' => 'accepted',
            'valide' => 'accepted',
            'publié' => 'published',
            'publie' => 'published',
            'published' => 'published',
            'rejeté' => 'rejected',
            'rejete' => 'rejected',
            'rejected' => 'rejected',
            'refuse' => 'rejected',
        ],
        // Paiements
        'paiement' => [
            'en_attente' => 'pending',
            'en attente' => 'pending',
            'valide' => 'accepted',
            'validé' => 'accepted',
            'refuse' => 'rejected',
            'refusé' => 'rejected',
            'rejete' => 'rejected',
        ],
        // Utilisateurs
        'user' => [
            'actif' => 'accepted',
            'active' => 'accepted',
            'suspendu' => 'rejected',
            'suspended' => 'rejected',
            'en_attente' => 'pending',
            'en attente' => 'pending',
        ],
        // Abonnements
        'abonnement' => [
            'actif' => 'accepted',
            'active' => 'accepted',
            'en_attente' => 'pending',
            'en attente' => 'pending',
            'refuse' => 'rejected',
            'refusé' => 'rejected',
            'expire' => 'rejected',
            'expiré' => 'rejected',
        ],
    ];
    
    // Récupérer le mapping pour le type donné
    $typeMapping = $mapping[$type] ?? $mapping['article'];
    
    // Retourner la classe correspondante ou 'pending' par défaut
    return $typeMapping[$statut] ?? 'pending';
}

/**
 * Formate le texte du statut pour l'affichage
 * 
 * @param string $statut Le statut à formater
 * @return string Le statut formaté
 */
function formatStatusText($statut) {
    $statut = strtolower(trim($statut));
    
    $formatting = [
        'soumis' => 'Soumis',
        'en_attente' => 'En attente',
        'en attente' => 'En attente',
        'en évaluation' => 'En évaluation',
        'en_evaluation' => 'En évaluation',
        'en evaluation' => 'En évaluation',
        'accepté' => 'Accepté',
        'accepte' => 'Accepté',
        'accepted' => 'Accepté',
        'valide' => 'Validé',
        'publié' => 'Publié',
        'publie' => 'Publié',
        'published' => 'Publié',
        'rejeté' => 'Rejeté',
        'rejete' => 'Rejeté',
        'rejected' => 'Rejeté',
        'refuse' => 'Refusé',
        'refusé' => 'Refusé',
        'actif' => 'Actif',
        'active' => 'Actif',
        'suspendu' => 'Suspendu',
        'suspended' => 'Suspendu',
        'expire' => 'Expiré',
        'expiré' => 'Expiré',
    ];
    
    return $formatting[$statut] ?? ucfirst($statut);
}

/**
 * Génère le HTML complet d'un badge de statut
 * 
 * @param string $statut Le statut à afficher
 * @param string $type Le type de statut ('article', 'paiement', 'user', 'abonnement')
 * @return string Le HTML du badge
 */
function statusBadge($statut, $type = 'article') {
    $class = getStatusBadgeClass($statut, $type);
    $text = formatStatusText($statut);
    
    return '<span class="status-badge ' . htmlspecialchars($class) . '">' . htmlspecialchars($text) . '</span>';
}

