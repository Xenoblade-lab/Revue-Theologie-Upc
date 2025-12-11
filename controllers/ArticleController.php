<?php

namespace Controllers;

use Models\ArticleModel;

class ArticleController extends Controller
{   #good
    public function index()
    {
        $model = new ArticleModel($this->db());
        return $model->all();
    }
    #good
    public function show(array $params)
    {
        $model = new ArticleModel($this->db());
        $article = $model->getArticleById($params['id'] ?? 0);
        return $article;
    }

    public function store($data = [])
    {
        $model = new ArticleModel($this->db());
        $id = $model->createArticle($data);
        $this->respond(['id' => $id], 201);
    }

    public function update(array $params)
    {
        $data = $this->input();
        $model = new ArticleModel($this->db());
        $model->updateArticle($params['id'] ?? 0, $data);
        $this->respond(['message' => 'Article mis à jour']);
    }

    public function delete(array $params)
    {
        $model = new ArticleModel($this->db());
        $model->deleteArticle($params['id'] ?? 0);
        $this->respond(['message' => 'Article supprimé']);
    }
}
?>

