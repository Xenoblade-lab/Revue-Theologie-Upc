<?php

namespace Controllers;

use Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 20;

        $model = new UserModel($this->db());
        $this->respond($model->all());
    }

    public function show(array $params)
    {
        $model = new UserModel($this->db());
        $user = $model->getUserById($params['id'] ?? 0);
        $user ? $this->respond($user) : $this->respond(['message' => 'Utilisateur introuvable'], 404);
    }

    public function store()
    {
        $model = new UserModel($this->db());
        $model->createUser($this->input());
        $this->respond(['message' => 'Utilisateur créé'], 201);
    }

    public function update(array $params)
    {
        $model = new UserModel($this->db());
        $model->updateUser($params['id'] ?? 0, $this->input());
        $this->respond(['message' => 'Utilisateur mis à jour']);
    }

    public function delete(array $params = [])
    {
        $user = new UserModel($this->db());

        if((int)$params['id'] && $user->getUserById((int)$params['id']))
        {
            echo "nice";
            $user->delete($params['id']);
        }
        echo "echec";
        header("Location: ".\Router\Router::route(''));
        
    }
}
?>

