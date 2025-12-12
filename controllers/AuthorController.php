<?php
namespace Controllers;

use Models\Database;
use Models\UserModel;
use Models\BlogModel;

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
        $articleModel = new BlogModel($db);
        
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
        
        \App\App::view('author' . DIRECTORY_SEPARATOR . 'index');
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
        $articleModel = new BlogModel($db);
        
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
     * Affiche les détails d'un article
     */
    public function articleDetails($params = [])
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        $articleId = is_array($params) ? ($params['id'] ?? null) : $params;
        if (!$articleId) {
            header('Location: ' . \Router\Router::route('author'));
            exit;
        }
        
        $db = $this->db();
        $articleModel = new ArticleModel($db);
        
        // Récupérer l'article
        $article = $articleModel->getArticleById($articleId);
        
        // Vérifier que l'article appartient à l'utilisateur connecté
        if (!$article || $article['auteur_id'] != $userId) {
            header('Location: ' . \Router\Router::route('author'));
            exit;
        }
        
        $data = [
            'article' => $article,
            'user' => (new UserModel($db))->getUserById($userId)
        ];
        
        \App\App::view('author' . DIRECTORY_SEPARATOR . 'article-details', $data);
    }
    
    /**
     * Affiche le formulaire d'édition d'un article
     */
    public function articleEdit($params = [])
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }
        
        $articleId = is_array($params) ? ($params['id'] ?? null) : $params;
        if (!$articleId) {
            header('Location: ' . \Router\Router::route('author'));
            exit;
        }
        
        $db = $this->db();
        $articleModel = new ArticleModel($db);
        
        // Récupérer l'article
        $article = $articleModel->getArticleById($articleId);
        
        // Vérifier que l'article appartient à l'utilisateur connecté et qu'il peut être modifié
        if (!$article || $article['auteur_id'] != $userId) {
            header('Location: ' . \Router\Router::route('author'));
            exit;
        }
        
        // Vérifier que l'article peut être modifié (seulement si statut = soumis)
        $statut = strtolower($article['statut'] ?? '');
        if ($statut !== 'soumis') {
            header('Location: ' . \Router\Router::route('author') . '/article/' . $articleId);
            exit;
        }
        
        $data = [
            'article' => $article,
            'user' => (new UserModel($db))->getUserById($userId)
        ];
        
        \App\App::view('author' . DIRECTORY_SEPARATOR . 'article-edit', $data);
    }
    
    /**
     * Met à jour un article
     */
    public function articleUpdate($params = [])
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $this->respond(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $articleId = is_array($params) ? ($params['id'] ?? null) : $params;
        if (!$articleId) {
            $this->respond(['error' => 'ID d\'article manquant'], 400);
            return;
        }
        
        $db = $this->db();
        $articleModel = new ArticleModel($db);
        
        // Récupérer l'article
        $article = $articleModel->getArticleById($articleId);
        
        // Vérifier que l'article appartient à l'utilisateur connecté
        if (!$article || $article['auteur_id'] != $userId) {
            $this->respond(['error' => 'Article introuvable ou non autorisé'], 403);
            return;
        }
        
        // Vérifier que l'article peut être modifié
        $statut = strtolower($article['statut'] ?? '');
        if ($statut !== 'soumis') {
            $this->respond(['error' => 'Cet article ne peut plus être modifié'], 400);
            return;
        }
        
        // Préparer les données de mise à jour
        $updateData = [
            'titre' => $_POST['titre'] ?? $article['titre'],
            'contenu' => $_POST['contenu'] ?? $article['contenu']
        ];
        
        // Gérer l'upload du fichier si un nouveau fichier est fourni
        if (isset($_FILES['fichier']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR;
            
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $file = $_FILES['fichier'];
            $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowedExtensions = ['pdf', 'doc', 'docx', 'tex'];
            
            if (!in_array($fileExtension, $allowedExtensions)) {
                $this->respond(['error' => 'Format de fichier non autorisé. Formats acceptés : PDF, Word (.doc, .docx), LaTeX (.tex)'], 400);
                return;
            }
            
            // Supprimer l'ancien fichier s'il existe
            if (!empty($article['fichier_path'])) {
                $oldFilePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $article['fichier_path'];
                if (file_exists($oldFilePath)) {
                    @unlink($oldFilePath);
                }
            }
            
            // Générer un nom de fichier unique
            $fileName = uniqid('article_', true) . '_' . time() . '.' . $fileExtension;
            $filePath = $uploadDir . $fileName;
            
            // Déplacer le fichier
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $updateData['fichier_path'] = 'uploads/articles/' . $fileName;
            } else {
                $this->respond(['error' => 'Erreur lors de l\'upload du fichier'], 500);
                return;
            }
        }
        
        // Mettre à jour l'article
        $success = $articleModel->updateArticle($articleId, $updateData);
        
        if ($success) {
            $this->respond(['success' => true, 'message' => 'Article modifié avec succès'], 200);
        } else {
            $this->respond(['error' => 'Erreur lors de la modification de l\'article'], 500);
        }
    }
    
    /**
     * Supprime un article
     */
    public function articleDelete($params = [])
    {
        \Service\AuthService::requireLogin();
        
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            $this->respond(['error' => 'Non autorisé'], 401);
            return;
        }
        
        $articleId = is_array($params) ? ($params['id'] ?? null) : $params;
        if (!$articleId) {
            $this->respond(['error' => 'ID d\'article manquant'], 400);
            return;
        }
        
        $db = $this->db();
        $articleModel = new ArticleModel($db);
        
        // Récupérer l'article
        $article = $articleModel->getArticleById($articleId);
        
        // Vérifier que l'article appartient à l'utilisateur connecté
        if (!$article || $article['auteur_id'] != $userId) {
            $this->respond(['error' => 'Article introuvable ou non autorisé'], 403);
            return;
        }
        
        // Vérifier que l'article peut être supprimé (seulement si statut = soumis)
        $statut = strtolower($article['statut'] ?? '');
        if ($statut !== 'soumis') {
            $this->respond(['error' => 'Cet article ne peut plus être supprimé'], 400);
            return;
        }
        
        // Supprimer le fichier associé s'il existe
        if (!empty($article['fichier_path'])) {
            $filePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $article['fichier_path'];
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }
        
        // Supprimer l'article
        $success = $articleModel->deleteArticle($articleId);
        
        if ($success) {
            $this->respond(['success' => true, 'message' => 'Article supprimé avec succès'], 200);
        } else {
            $this->respond(['error' => 'Erreur lors de la suppression de l\'article'], 500);
        }
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
