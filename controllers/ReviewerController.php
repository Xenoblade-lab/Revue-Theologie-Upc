<?php
namespace Controllers;

use Models\UserModel;
use Models\ReviewModel;
use Service\AuthService;

class ReviewerController extends Controller
{
    /**
     * Vérifie que l'utilisateur est connecté et reviewer
     */
    private function requireReviewer(): int
    {
        AuthService::requireLogin();

        $userId = $_SESSION['user_id'] ?? null;
        $role   = $_SESSION['user_role'] ?? null;

        if (!$userId || $role !== 'reviewer') {
            header('Location: ' . \Router\Router::route('login'));
            exit;
        }

        return $userId;
    }

    /**
     * Tableau de bord reviewer (articles en attente / en cours)
     */
    public function index()
    {
        $userId = $this->requireReviewer();
        $db = $this->db();

        $userModel  = new UserModel($db);
        $reviewModel = new ReviewModel($db);

        $user  = $userModel->getUserById($userId);
        $stats = $reviewModel->getReviewerStats($userId);

        $evaluations = $reviewModel->getReviewsByReviewer($userId, null, 1, 50) ?? [];
        // Ne garder que les évaluations non terminées
        $evaluations = array_values(array_filter($evaluations, function ($eval) {
            return strtolower($eval['statut'] ?? '') !== 'termine';
        }));

        \App\App::view('reviewer' . DIRECTORY_SEPARATOR . 'index', [
            'user'        => $user,
            'stats'       => $stats,
            'evaluations' => $evaluations,
            'current_page'=> 'dashboard',
        ]);
    }

    /**
     * Évaluations terminées
     */
    public function terminees()
    {
        $userId = $this->requireReviewer();
        $db = $this->db();

        $userModel  = new UserModel($db);
        $reviewModel = new ReviewModel($db);

        $user  = $userModel->getUserById($userId);
        $stats = $reviewModel->getReviewerStats($userId);
        $evaluations = $reviewModel->getReviewsByReviewer($userId, 'termine', 1, 50) ?? [];

        \App\App::view('reviewer' . DIRECTORY_SEPARATOR . 'terminees', [
            'user'        => $user,
            'stats'       => $stats,
            'evaluations' => $evaluations,
            'current_page'=> 'terminees',
        ]);
    }

    /**
     * Historique complet des évaluations
     */
    public function historique()
    {
        $userId = $this->requireReviewer();
        $db = $this->db();

        $userModel  = new UserModel($db);
        $reviewModel = new ReviewModel($db);

        $user  = $userModel->getUserById($userId);
        $stats = $reviewModel->getReviewerStats($userId);
        $evaluations = $reviewModel->getReviewsByReviewer($userId, null, 1, 200) ?? [];

        \App\App::view('reviewer' . DIRECTORY_SEPARATOR . 'historique', [
            'user'        => $user,
            'stats'       => $stats,
            'evaluations' => $evaluations,
            'current_page'=> 'historique',
        ]);
    }

    /**
     * Profil évaluateur
     */
    public function profil()
    {
        $userId = $this->requireReviewer();
        $db = $this->db();

        $userModel  = new UserModel($db);
        $reviewModel = new ReviewModel($db);

        $user  = $userModel->getUserById($userId);
        $stats = $reviewModel->getReviewerStats($userId);

        \App\App::view('reviewer' . DIRECTORY_SEPARATOR . 'profil', [
            'user'        => $user,
            'stats'       => $stats,
            'current_page'=> 'profil',
        ]);
    }

    /**
     * Formate le statut d'évaluation
     */
    protected function formatStatut($statut): string
    {
        $statut = strtolower($statut ?? '');
        $map = [
            'en_attente' => 'En attente',
            'en cours'   => 'En cours',
            'en_cours'   => 'En cours',
            'termine'    => 'Terminé',
            'rejete'     => 'Rejeté',
            'accepte'    => 'Accepté',
        ];
        return $map[$statut] ?? ucfirst($statut);
    }
}

