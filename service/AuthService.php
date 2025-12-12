<?php 
  namespace Service;

  use Controllers\Controller;

  class AuthService extends Controller
  {
    public function sign(array $datas = [], array $fields = ['nom', 'prenom', 'email', 'password', 'confirm-password'])
    {
      $user = new \Models\UserModel(new \Models\Database());
      if (!$this->isNotEmpty($datas) || !$this->verifyFields($datas, $fields)) {
           $this->jsonResponse([
              'status' => 400,
              'message' => 'Tous les champs sont requis'
          ]);
           return;
      }

     // Validation des longueurs
      if (
          !$this->valideLength($datas['nom'], 6, 64) ||
          !$this->valideLength($datas['prenom'], 6, 64) ||
          !$this->valideLength($datas['institution'], 6, 64) ||
          !$this->valideLength($datas['email'], 6, 64) ||
          !$this->valideLength($datas['password'], 6, 64)  ||
          !$this->valideLength($datas['phone'], 6, 64)  ||
          !$this->valideLength($datas['confirm-password'], 6, 64) 
      ) {
          $this->jsonResponse([
              'status' => 400,
              'message' => 'Longueur incorrecte'
          ]);
          return;
      }

      // Validation de l'email
      if (!$this->isEmailValid($datas['email'])) {
          $this->jsonResponse([
              'status' => 400,
              'message' => 'Email invalide'
          ]);
          return;
      }

     if(!$this->isEqual($datas['password'], $datas['confirm-password']))
     {
        $this->jsonResponse([
            'status' => 409,
            'message' => 'Les 2 mots de passe sont différents'
        ]);
        return;
     }

     if($user->getUserByEmail($datas['mails']))
     {
        // arrete tout si l utilisateur existe
        $this->jsonResponse([
            'status' => '409',
            'message' => 'Utilisateur existant'
        ]);
        return;
     }

  
    // Si tout est valide, tu peux continuer ici (ex: insertion en base)
  
     $user->createUser($user,$datas['nom'],$datas['prenom'],$datas['institution'],$datas['email'],password_hash($datas['password'],PASSWORD_DEFAULT) ,3,'');

     $this->jsonResponse([
         'status' => 200,
         'message' => 'Inscription réussie',
         'redirect' => \Router\Router::route('login')
     ]);
    }
    
    // fonction pour la connexion 

    public function login($datas = [], $fields = ['email', 'password'])
    {
        // Connexion à la base de données
        $db = $this->db();
        $userModel = new \Models\UserModel($db);
        
        if (!$this->isNotEmpty($datas) || !$this->verifyFields($datas, $fields)) {
             $this->jsonResponse([
                'status' => 400,
                'message' => 'Tous les champs sont requis'
            ]);
             return;
        }

       if(
          !isset($datas['email']) || !$this->valideLength($datas['email'], 5, 64) ||
          !isset($datas['password']) || !$this->valideLength($datas['password'], 8, 64)
        ) {
          $this->jsonResponse([
              'status' => 400,
              'message' => 'Longueur incorrecte (email min 5, mot de passe min 8)'
          ]);
          return;
        }

        // Validation de l'email
        if (!$this->isEmailValid($datas['email'])) {
            $this->jsonResponse([
                'status' => 400,
                'message' => 'Email invalide'
            ]);
            return;
        }

        // Récupérer l'utilisateur par email
        $user = $userModel->getUserByEmail($datas['email']);
        
        if ($user && isset($user['password'])) {
            // Vérifier le mot de passe
            if (password_verify($datas['password'], $user['password'])) {
                // Démarrer la session si elle n'est pas déjà démarrée
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                // Récupérer le rôle depuis roles/model_has_roles s'il existe
                $roleRow = $db->fetchOne(
                    "SELECT r.name 
                     FROM roles r 
                     JOIN model_has_roles mr ON mr.role_id = r.id 
                     WHERE mr.model_type = 'App\\\\Models\\\\User' 
                       AND mr.model_id = :uid 
                     LIMIT 1",
                    [':uid' => $user['id']]
                );
                $role = $roleRow['name'] ?? null;
                
                // Stocker les informations de l'utilisateur en session
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'] ?? null;
                $_SESSION['user_nom'] = $user['nom'] ?? null;
                $_SESSION['user_prenom'] = $user['prenom'] ?? null;
                $_SESSION['user_role'] = $role;
                $_SESSION['panier'] = [];

                $this->jsonResponse([
                    'status' => 200,
                    'message' => 'Connexion réussie',
                    'redirect' => \Router\Router::route('')
                ]);
                return;
            }
        }

        // Si on arrive ici, les identifiants sont incorrects
        $this->jsonResponse([
            'status' => 401,
            'message' => 'Email ou mot de passe incorrect'
        ]);
    }
    

       public function logout()
      {
          // Démarrer la session si elle n'est pas déjà démarrée
          if (session_status() === PHP_SESSION_NONE) {
              session_start();
          }
          
          // Détruire toutes les variables de session
          $_SESSION = array();
          
          // Si vous voulez détruire complètement la session, supprimez aussi le cookie de session
          if (ini_get("session.use_cookies")) {
              $params = session_get_cookie_params();
              setcookie(session_name(), '', time() - 42000,
                  $params["path"], $params["domain"],
                  $params["secure"], $params["httponly"]
              );
          }
          
          // Détruire la session
          session_destroy();
          
          // Rediriger vers la page d'accueil
          header('Location: ' . \Router\Router::route(''));
          exit;
       }

       public static function requireLogin() 
       {
            if (!self::isLoggedIn()) {
                header('Location: ' .\Router\Router::route('login'));
                exit;
            }
        }
        
        public static function isLoggedIn() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
        }

  }
?>