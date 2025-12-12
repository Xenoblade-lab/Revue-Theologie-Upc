<?php

namespace Controllers;

use Models\BlogModel;

class ArticleController extends Controller
{   #good
    public function index()
    {
        $model = new BlogModel($this->db());
        return $model->all();
    }
    #good
    public function show(array $params)
    {
        $model = new BlogModel($this->db());
        $article = $model->getArticleById($params['id'] ?? 0);
        return $article;
    }

    public function store($data = [])
    {
        $model = new BlogModel($this->db());
        $id = $model->create($data);
        $this->respond(['id' => $id], 201);
    }

    public function update(array $params)
    {
        $data = $this->input();
        $model = new BlogModel($this->db());
        $model->updateArticle($params['id'] ?? 0, $data);
        $this->respond(['message' => 'Article mis à jour']);
    }

    public function delete(array $params)
    {
        $model = new BlogModel($this->db());
        $model->deleteArticle($params['id'] ?? 0);
        $this->respond(['message' => 'Article supprimé']);
    }
}
?>

