<?php
namespace Controllers;

use Models\Database;
use Models\UserModel;
use Models\BlogModel;

class AdminController extends Controller
{
    private function requireAdmin()
    {
        \Service\AuthService::requireLogin();
        $role = $_SESSION['user_role'] ?? null;
        // On ne bloque pas si le rôle n'est pas renseigné, mais on peut restreindre si disponible
        if ($role && strtolower($role) !== 'admin' && strtolower($role) !== 'rédacteur en chef' && strtolower($role) !== 'redacteur en chef') {
            header('Location: ' . \Router\Router::route(''));
            exit;
        }
        return $_SESSION['user_id'] ?? null;
    }

    public function index()
    {
        $userId = $this->requireAdmin();
        $db = $this->db();
        $userModel = new UserModel($db);
        $articleModel = new BlogModel($db);

        $user = $userModel->getUserById($userId);

        // Stats
        $articlesTotal = $db->fetchOne("SELECT COUNT(*) as c FROM articles")['c'] ?? 0;
        $articlesPublies = $db->fetchOne("SELECT COUNT(*) as c FROM articles WHERE statut IN ('valide','publie','publié')")['c'] ?? 0;
        $utilisateurs = $db->fetchOne("SELECT COUNT(*) as c FROM users")['c'] ?? 0;
        $revenusMois = $db->fetchOne("SELECT COALESCE(SUM(montant),0) as total FROM paiements WHERE statut='valide' AND date_paiement IS NOT NULL AND MONTH(date_paiement)=MONTH(CURDATE()) AND YEAR(date_paiement)=YEAR(CURDATE())")['total'] ?? 0;

        $recentSubmissions = $db->fetchAll("
            SELECT a.titre, a.date_soumission, a.statut, u.prenom, u.nom
            FROM articles a
            JOIN users u ON u.id = a.auteur_id
            ORDER BY a.date_soumission DESC
            LIMIT 5
        ");
   
        $data = [
            'user' => $user,
            'stats' => [
                'articles_total' => $articlesTotal,
                'articles_publies' => $articlesPublies,
                'evaluateurs_actifs' => $utilisateurs,
                'revenus_mois' => $revenusMois,
            ],
            'recentSubmissions' => $recentSubmissions,
            'current_page' => 'dashboard',
        ];
     
      
        \App\App::view('admin' . DIRECTORY_SEPARATOR . 'index', $data);
    }

    public function users()
    {
        $this->requireAdmin();
        $db = $this->db();
        $userModel = new UserModel($db);
        $users = $db->fetchAll("SELECT id, nom, prenom, email, statut, created_at FROM users ORDER BY created_at DESC LIMIT 200");

        \App\App::view('admin' . DIRECTORY_SEPARATOR . 'users', [
            'users' => $users,
            'current_page' => 'users'
        ]);
    }

    public function volumes()
    {
        $this->requireAdmin();
        $db = $this->db();
        $revues = $db->fetchAll("SELECT id, numero, titre, date_publication, created_at FROM revues ORDER BY created_at DESC LIMIT 200");

        \App\App::view('admin' . DIRECTORY_SEPARATOR . 'volumes', [
            'revues' => $revues,
            'current_page' => 'volumes'
        ]);
    }

    public function paiements()
    {
        $this->requireAdmin();
        $db = $this->db();
        $paiements = $db->fetchAll("
            SELECT p.id, p.utilisateur_id, p.montant, p.moyen, p.statut, p.date_paiement, u.prenom, u.nom, u.email
            FROM paiements p
            JOIN users u ON u.id = p.utilisateur_id
            ORDER BY p.created_at DESC
            LIMIT 200
        ");

        \App\App::view('admin' . DIRECTORY_SEPARATOR . 'paiements', [
            'paiements' => $paiements,
            'current_page' => 'paiements'
        ]);
    }

    public function settings()
    {
        $this->requireAdmin();
        \App\App::view('admin' . DIRECTORY_SEPARATOR . 'settings', [
            'current_page' => 'settings'
        ]);
    }

    public function delete(array $params = [])
    {
        $this->requireAdmin();
        $db = $this->db();
        $userModel = new UserModel($db);
        
        $userId = $params['id'] ?? null;
        
        if (!$userId) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'ID utilisateur manquant']);
            exit;
        }
        
        // Vérifier que l'utilisateur existe
        $user = $userModel->getUserById($userId);
        if (!$user) {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Utilisateur introuvable']);
            exit;
        }
        
        // Supprimer l'utilisateur
        $userModel->delete($userId);
        
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Utilisateur supprimé avec succès']);
        exit;
    }
}
