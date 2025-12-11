<?php
namespace Controllers;

use Models\Database;
use Models\UserModel;
use Models\ArticleModel;

class AuthorController extends Controller
{
    /**
     * Affiche le dashboard de l'auteur
     */
    public function index()
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        $db = $this->db();
        $userModel = new UserModel($db);
        $articleModel = new ArticleModel($db);
        
        // Récupérer les informations de l'utilisateur
        $user = $userModel->getUserById($userId);
        if (!$user) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        // Récupérer tous les articles de l'auteur
        $allArticles = $articleModel->getArticlesByAuthor($userId, 1, 1000);
        
        // Calculer les statistiques
        $stats = [
            'total' => count($allArticles),
            'soumis' => 0,
            'en_evaluation' => 0,
            'accepte' => 0,
            'publie' => 0,
            'rejete' => 0
        ];
        
        foreach ($allArticles as $article) {
            $statut = strtolower($article['statut'] ?? '');
            switch ($statut) {
                case 'soumis':
                    $stats['soumis']++;
                    break;
                case 'en évaluation':
                case 'en_evaluation':
                case 'en evaluation':
                    $stats['en_evaluation']++;
                    break;
                case 'accepté':
                case 'accepte':
                case 'accepted':
                    $stats['accepte']++;
                    break;
                case 'publié':
                case 'publie':
                case 'published':
                    $stats['publie']++;
                    break;
                case 'rejeté':
                case 'rejete':
                case 'rejected':
                    $stats['rejete']++;
                    break;
            }
        }
        
        // Formater les articles pour l'affichage
        $articles = array_map(function($article) {
            return [
                'id' => $article['id'],
                'titre' => $article['titre'] ?? 'Sans titre',
                'date_soumission' => $article['date_soumission'] ?? $article['created_at'] ?? date('Y-m-d'),
                'statut' => $article['statut'] ?? 'soumis',
                'statut_display' => $this->formatStatut($article['statut'] ?? 'soumis')
            ];
        }, array_slice($allArticles, 0, 10)); // Limiter à 10 pour l'affichage
        
        // Passer les données à la vue
        $data = [
            'user' => $user,
            'articles' => $articles,
            'stats' => $stats,
            'total_articles' => $stats['total']
        ];
        
        \App\App::view('author' . DIRECTORY_SEPARATOR . 'index', $data);
    }
    
    /**
     * Affiche les articles publiés de l'auteur
     */
    public function articles()
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        $db = $this->db();
        $userModel = new UserModel($db);
        $articleModel = new ArticleModel($db);
        
        // Récupérer les informations de l'utilisateur
        $user = $userModel->getUserById($userId);
        if (!$user) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        // Récupérer uniquement les articles publiés
        $allArticles = $articleModel->getArticlesByAuthor($userId, 1, 1000);
        $publishedArticles = array_filter($allArticles, function($article) {
            $statut = strtolower($article['statut'] ?? '');
            return in_array($statut, ['publié', 'publie', 'published']);
        });
        
        // Calculer les statistiques pour la sidebar
        $stats = [
            'total' => count($allArticles),
            'publie' => count($publishedArticles)
        ];
        
        $data = [
            'user' => $user,
            'publishedArticles' => array_values($publishedArticles),
            'stats' => $stats
        ];
        
        \App\App::view('author' . DIRECTORY_SEPARATOR . 'articles', $data);
    }
    
    /**
     * Affiche les abonnements et paiements de l'auteur
     */
    public function abonnement()
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        $db = $this->db();
        $userModel = new UserModel($db);
        $articleModel = new ArticleModel($db);
        
        // Récupérer les informations de l'utilisateur
        $user = $userModel->getUserById($userId);
        if (!$user) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        // Récupérer l'abonnement actif
        $abonnement = $db->fetchOne(
            "SELECT * FROM abonnements WHERE utilisateur_id = :userId AND statut = 'actif' ORDER BY date_fin DESC LIMIT 1",
            [':userId' => $userId]
        );
        
        // Récupérer tous les paiements
        $paiements = $db->fetchAll(
            "SELECT * FROM paiements WHERE utilisateur_id = :userId ORDER BY created_at DESC",
            [':userId' => $userId]
        );
        
        // Calculer les statistiques pour la sidebar
        $allArticles = $articleModel->getArticlesByAuthor($userId, 1, 1000);
        $stats = ['total' => count($allArticles)];
        
        $data = [
            'user' => $user,
            'abonnement' => $abonnement,
            'paiements' => $paiements,
            'stats' => $stats
        ];
        
        \App\App::view('author' . DIRECTORY_SEPARATOR . 'abonnement', $data);
    }
    
    /**
     * Affiche et gère le profil de l'auteur
     */
    public function profil()
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        $db = $this->db();
        $userModel = new UserModel($db);
        $articleModel = new ArticleModel($db);
        
        // Récupérer les informations de l'utilisateur
        $user = $userModel->getUserById($userId);
        if (!$user) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        // Calculer les statistiques
        $allArticles = $articleModel->getArticlesByAuthor($userId, 1, 1000);
        $stats = [
            'total_articles' => count($allArticles),
            'publie' => 0
        ];
        
        foreach ($allArticles as $article) {
            $statut = strtolower($article['statut'] ?? '');
            if (in_array($statut, ['publié', 'publie', 'published'])) {
                $stats['publie']++;
            }
        }
        
        $data = [
            'user' => $user,
            'stats' => $stats
        ];
        
        \App\App::view('author' . DIRECTORY_SEPARATOR . 'profil', $data);
    }
    
    /**
     * Formate le statut pour l'affichage
     */
    private function formatStatut($statut)
    {
        $statut = strtolower($statut);
        $statuts = [
            'soumis' => 'Soumis',
            'en évaluation' => 'En évaluation',
            'en_evaluation' => 'En évaluation',
            'en evaluation' => 'En évaluation',
            'accepté' => 'Accepté',
            'accepte' => 'Accepté',
            'accepted' => 'Accepté',
            'publié' => 'Publié',
            'publie' => 'Publié',
            'published' => 'Publié',
            'rejeté' => 'Rejeté',
            'rejete' => 'Rejeté',
            'rejected' => 'Rejeté'
        ];
        
        return $statuts[$statut] ?? ucfirst($statut);
    }
}

