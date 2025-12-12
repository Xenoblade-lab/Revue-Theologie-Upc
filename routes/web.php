<?php

use Models\BlogModel;
use Models\Database;
use Models\IssueModel;
use Models\JournalModel;
use Models\ReviewModel;
use Models\UserModel;
use Models\VolumeModel;
//  =========== Helpers ================

/**
 * Crée une instance de base de données initialisée.
 */
function getDb(): Database
{
    $db = new Database();
    $db->connect();
    return $db;
}

/**
 * Récupère les données d'entrée (JSON ou POST classique).
 */
function input(): array
{
    $json = json_decode(file_get_contents('php://input'), true);
    return is_array($json) ? $json : ($_POST ?? []);
}

/**
 * Répond en JSON avec un statut HTTP optionnel.
 */
function respond($payload, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($payload);
}

//  =========== GET ================

Router\Router::get('/', function () {
    App\App::view('index');
});

Router\Router::get('/archives', [\Controllers\BlogContoller::class, 'index']);

Router\Router::get('/archives/[i:id]', [\Controllers\BlogContoller::class, 'show']);

Router\Router::get('/comite', function () {
    App\App::view('comite');
});

Router\Router::get('/instructions', function () {
    Service\AuthService::requireLogin();
    App\App::view('instructions');
});

Router\Router::get('/login', function () {
    App\App::view('login');
});

Router\Router::get('/search', function () {
    Service\AuthService::requireLogin();
    App\App::view('search');
});

Router\Router::get('/register', function () {
    App\App::view('register');
});

Router\Router::get('/submit', function () {
    App\App::view('submit');
});

Router\Router::get('/test', function () {

});

Router\Router::get('/admin', [\Controllers\AdminController::class, 'index']);
Router\Router::get('/admin/users', [\Controllers\AdminController::class, 'users']);
Router\Router::get('/admin/volumes', [\Controllers\AdminController::class, 'volumes']);
Router\Router::get('/admin/paiements', [\Controllers\AdminController::class, 'paiements']);
Router\Router::get('/admin/settings', [\Controllers\AdminController::class, 'settings']);
Router\Router::get('/author', [\Controllers\AuthorController::class, 'index']);
Router\Router::get('/author/articles', [\Controllers\AuthorController::class, 'articles']);
Router\Router::get('/author/abonnement', [\Controllers\AuthorController::class, 'abonnement']);
Router\Router::get('/author/profil', [\Controllers\AuthorController::class, 'profil']);

// <<<<<<< HEAD
// ======== Reviewer Dashboard ========
Router\Router::get('/reviewer', [\Controllers\ReviewerController::class, 'index']);
Router\Router::get('/reviewer/terminees', [\Controllers\ReviewerController::class, 'terminees']);
Router\Router::get('/reviewer/historique', [\Controllers\ReviewerController::class, 'historique']);
Router\Router::get('/reviewer/profil', [\Controllers\ReviewerController::class, 'profil']);

// ======== Routes ArticleModel ========
Router\Router::get('/articles', function () {
    $db = getDb();
    $model = new  BlogModel($db);
    
    respond($model->all());
});
// =======
// ======== Routes BlogModel ========
// >>>>>>> 1a9ccc2c006b448c9a91bc5473440c07f16b232c

Router\Router::get('/articles/[i:id]', function ($params) {
    $db = getDb();
    $model = new BlogModel($db);
    $article = $model->getArticleById($params['id']);
    $article ? respond($article) : respond(['message' => 'Article introuvable'], 404);
});

Router\Router::post('/articles', function () {
    $blog = new \Controllers\BlogContoller();
    $blog->create($_POST,$_FILES);

});

Router\Router::post('/articles/[i:id]/update', function ($params) {
    $db = getDb();
    $model = new BlogModel($db);
    $data = input();
    $model->updateArticle($params['id'], $data);
    respond(['message' => 'Article mis à jour']);
});

Router\Router::post('/articles/[i:id]/delete', function ($id) {
    $blog = new \Controllers\BlogContoller();
    $blog->delete($id);
   
});

// ======== Routes JournalModel / VolumeModel ========
Router\Router::get('/revues', function () {
    $db = getDb();
    $model = new JournalModel($db);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 20;
    respond($model->getAllJournals($page, $limit));
});

Router\Router::get('/revues/[i:id]', function ($params) {
    $db = getDb();
    $model = new JournalModel($db);
    $journal = $model->getJournalById($params['id']);
    $journal ? respond($journal) : respond(['message' => 'Revue introuvable'], 404);
});

Router\Router::post('/revues', function () {
    $db = getDb();
    $model = new VolumeModel($db);
    $data = input();
    $id = $model->createVolume($data);
    // respond(['id' => $id], 201);
});

Router\Router::post('/revues/[i:id]/update', function ($params) {
    $db = getDb();
    $model = new JournalModel($db);
    $model->updateJournal($params['id'], input());
    respond(['message' => 'Revue mise à jour']);
});

Router\Router::post('/revues/[i:id]/delete', function ($params) {
    $db = getDb();
    $model = new JournalModel($db);
    $model->deleteJournal($params['id']);
    respond(['message' => 'Revue supprimée']);
});

// ======== Routes IssueModel (revue_parts) ========
Router\Router::get('/issues/[i:id]', function ($params) {
    $db = getDb();
    $model = new IssueModel($db);
    $issue = $model->getIssueById($params['id']);
    $issue ? respond($issue) : respond(['message' => 'Numéro introuvable'], 404);
});

Router\Router::get('/revues/[i:revueId]/issues', function ($params) {
    $db = getDb();
    $model = new IssueModel($db);
    respond($model->getIssuesByJournal($params['revueId']));
});

Router\Router::post('/revues/[i:revueId]/issues', function ($params) {
    $db = getDb();
    $model = new IssueModel($db);
    $id = $model->createIssue($params['revueId'], input());
    respond(['id' => $id], 201);
});

Router\Router::post('/issues/[i:id]/update', function ($params) {
    $db = getDb();
    $model = new IssueModel($db);
    $model->updateIssue($params['id'], input());
    respond(['message' => 'Numéro mis à jour']);
});

Router\Router::post('/issues/[i:id]/delete', function ($params) {
    $db = getDb();
    $model = new IssueModel($db);
    $model->deleteIssue($params['id']);
    respond(['message' => 'Numéro supprimé']);
});

// ======== Routes UserModel ========
Router\Router::get('/admin/users', function () {
    $db = getDb();
    $model = new UserModel($db);
    var_dump($model->all());
});

Router\Router::get('/admin/users/[i:id]', function ($params) {
    $db = getDb();
    $model = new UserModel($db);
    $user = $model->getUserById($params['id']);
    $user ? respond($user) : respond(['message' => 'Utilisateur introuvable'], 404);
});
#good
Router\Router::post('/admin/users', function () {
    $db = getDb();
    $model = new UserModel($db);
    $model->create(input());
    respond(['message' => 'Utilisateur créé'], 201);
});

Router\Router::post('/users/[i:id]/update', function ($params) {
    $db = getDb();
    $model = new UserModel($db);
    $model->updateUser($params['id'], input());
    respond(['message' => 'Utilisateur mis à jour']);
});
#good
Router\Router::post('/users/[i:id]/delete', function ($params) {
    $user = new \Controllers\AdminController();
    $user->delete($params);
});

// ======== Routes ReviewModel (évaluations) ========
Router\Router::get('/reviews/[i:id]', function ($params) {
    $db = getDb();
    $model = new ReviewModel($db);
    $review = $model->getReviewById($params['id']);
    $review ? respond($review) : respond(['message' => 'Évaluation introuvable'], 404);
});

Router\Router::get('/articles/[i:id]/reviews', function ($params) {
    $db = getDb();
    $model = new ReviewModel($db);
    respond($model->getReviewsByArticle($params['id']));
});

Router\Router::post('/reviews/assign', function () {
    $db = getDb();
    $model = new ReviewModel($db);
    $data = input();
    $model->assignReviewer($data['article_id'], $data['reviewer_id'], $data['deadline_days'] ?? 14);
    respond(['message' => 'Évaluateur assigné']);
});

Router\Router::post('/reviews/[i:id]/submit', function ($params) {
    $db = getDb();
    $model = new ReviewModel($db);
    $model->submitReview($params['id'], input());
    respond(['message' => 'Évaluation soumise']);
});

Router\Router::post('/reviews/[i:id]/accept', function ($params) {
    $db = getDb();
    $model = new ReviewModel($db);
    $model->acceptReviewAssignment($params['id']);
    respond(['message' => 'Invitation acceptée']);
});

Router\Router::post('/reviews/[i:id]/decline', function ($params) {
    $db = getDb();
    $model = new ReviewModel($db);
    $data = input();
    $model->declineReviewAssignment($params['id'], $data['reason'] ?? null);
    respond(['message' => 'Invitation déclinée']);
});

// =========== POST ================
Router\Router::post('/login', function () {
    $auth = new Service\AuthService();
    $auth->login($_POST);
});

Router\Router::post('/register', function () {
    $auth = new Service\AuthService();
    $auth->sign($_POST);
});

?>