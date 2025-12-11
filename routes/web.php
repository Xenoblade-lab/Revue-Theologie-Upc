<?php
use Models\ArticleModel;
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
    Service\AuthService::requireLogin();
    App\App::view('submit');
});

Router\Router::get('/test', function () {

    var_dump(App\Html::class('/test'));
});

Router\Router::get('/admin', function () {
    App\App::view('admin' . DIRECTORY_SEPARATOR . 'index');
});
Router\Router::get('/author', function () {
    Service\AuthService::requireLogin();
    App\App::view('author' . DIRECTORY_SEPARATOR . 'index');
});

// ======== Routes ArticleModel ========
Router\Router::get('/articles', function () {
    $db = getDb();
    $model = new ArticleModel($db);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 20;
    respond($model->getAllArticles($page, $limit));
});

Router\Router::get('/articles/[i:id]', function ($params) {
    $db = getDb();
    $model = new ArticleModel($db);
    $article = $model->getArticleById($params['id']);
    $article ? respond($article) : respond(['message' => 'Article introuvable'], 404);
});

Router\Router::post('/articles', function () {
    $db = getDb();
    $model = new ArticleModel($db);
    $data = $_POST;
    $id = $model->createArticle($data);
    // respond(['id' => $id], 201);
});

Router\Router::post('/articles/[i:id]/update', function ($params) {
    $db = getDb();
    $model = new ArticleModel($db);
    $data = input();
    $model->updateArticle($params['id'], $data);
    respond(['message' => 'Article mis à jour']);
});

Router\Router::post('/articles/[i:id]/delete', function ($params) {
    $db = getDb();
    $model = new ArticleModel($db);
    $model->deleteArticle($params['id']);
    respond(['message' => 'Article supprimé']);
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
    respond(['id' => $id], 201);
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
Router\Router::get('/users', function () {
    $db = getDb();
    $model = new UserModel($db);
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 20;
    respond($model->getAllUsers($page, $limit));
});

Router\Router::get('/users/[i:id]', function ($params) {
    $db = getDb();
    $model = new UserModel($db);
    $user = $model->getUserById($params['id']);
    $user ? respond($user) : respond(['message' => 'Utilisateur introuvable'], 404);
});

Router\Router::post('/users', function () {
    $db = getDb();
    $model = new UserModel($db);
    $model->createUser(input());
    respond(['message' => 'Utilisateur créé'], 201);
});

Router\Router::post('/users/[i:id]/update', function ($params) {
    $db = getDb();
    $model = new UserModel($db);
    $model->updateUser($params['id'], input());
    respond(['message' => 'Utilisateur mis à jour']);
});

Router\Router::post('/users/[i:id]/delete', function ($params) {
    $db = getDb();
    $model = new UserModel($db);
    $model->deleteUser($params['id']);
    respond(['message' => 'Utilisateur suspendu']);
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
    $auth->login(input());
});

Router\Router::post('/register', function () {
    $auth = new Service\AuthService();
    $auth->sign(input());
});

Router\Router::get('/logout', function () {
    $auth = new Service\AuthService();
    $auth->logout();
});

Router\Router::post('/logout', function () {
    $auth = new Service\AuthService();
    $auth->logout();
});

// Route pour récupérer les notifications
Router\Router::get('/api/notifications', function () {
    Service\AuthService::requireLogin();
    $db = getDb();
    $userModel = new UserModel($db);
    $userId = $_SESSION['user_id'] ?? null;
    
    if (!$userId) {
        respond(['notifications' => []], 200);
        return;
    }
    
    // Récupérer les notifications (à adapter selon votre structure)
    $notifications = [];
    // TODO: Implémenter la récupération des notifications depuis la base de données
    
    respond(['notifications' => $notifications], 200);
});

// Route pour marquer une notification comme lue
Router\Router::post('/api/notifications/[i:id]/read', function ($params) {
    Service\AuthService::requireLogin();
    // TODO: Implémenter la mise à jour de la notification
    respond(['message' => 'Notification marquée comme lue'], 200);
});

?>