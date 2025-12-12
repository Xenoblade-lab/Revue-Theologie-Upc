<?php 

namespace Controllers;

class BlogContoller extends Controller
{
    public function index()
    {
        $db = getDb();
        $blog = new \Models\BlogModel($db);
        $blog =  $blog->all();
        \App\App::view('archives',['blog' => $blog]);
    }

    public function show($params)
    {
        // $article = new \Models\BlogModel(new \Models\Database());
        
        // \App\App::view('',['article' => $article->fetchOne("SELECT * FROM articles  wHERE id = :id",[':id' => $params['id']])]);
    }

    public function create($datas,$file){
       $model = new \Models\BlogModel(new \Models\Database());
     
  
        if(isset($file['doc']) && $file['doc']['error'] == 0){
          $directory = dirname(__DIR__). DIRECTORY_SEPARATOR ."assets". DIRECTORY_SEPARATOR . "pdf";
          $fichier = basename($file['doc']['name']);
          $directory_to_upload = $directory . DIRECTORY_SEPARATOR . $fichier;
          $imageFiletype = strtolower(pathinfo($fichier,PATHINFO_EXTENSION));
          $allowed = ["pdf","doc","docx","dotx"];

          if(in_array($imageFiletype,$allowed)){
            if(file_exists($directory_to_upload)){
              $image = time().".".$imageFiletype;
              $directory_to_upload = $directory . DIRECTORY_SEPARATOR . $image;
            }
          }
          if(move_uploaded_file($file['doc']['tmp_name'], $directory_to_upload)){
            $datas['fichier_path'] =  $directory . DIRECTORY_SEPARATOR . $fichier;
          }
       }
       $model->create($datas);
       header("Location :" . \Router\Router::route('author'));
     
    }
    
    public function delete($params)
    {
        $blog = new \Models\BlogModel(new \Models\Database());
        $blog->delete($params['id']);
        header("Location: ". \Router\Router::route(''));
    }
    
}
?>