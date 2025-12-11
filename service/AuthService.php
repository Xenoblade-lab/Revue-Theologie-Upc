<?php 
  namespace Service;

  use Controllers\Controller;

  class AuthService extends Controller
  {
    public function sign(array $datas = [], array $fields = ['nom', 'prenom', 'email', 'password', 'confirm-password'])
    {
      // Normaliser les noms de champs (fullname -> nom)
      if (isset($datas['fullname']) && !isset($datas['nom'])) {
          $datas['nom'] = $datas['fullname'];
      }
      if (isset($datas['confirmPassword']) && !isset($datas['confirm-password'])) {
          $datas['confirm-password'] = $datas['confirmPassword'];
      }
      
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

     // Validation des longueurs
      if (
          !isset($datas['nom']) || !$this->valideLength($datas['nom'], 2, 64) ||
          !isset($datas['prenom']) || !$this->valideLength($datas['prenom'], 2, 64) ||
          !isset($datas['email']) || !$this->valideLength($datas['email'], 5, 64) ||
          !isset($datas['password']) || !$this->valideLength($datas['password'], 8, 64) ||
          !isset($datas['confirm-password']) || !$this->valideLength($datas['confirm-password'], 8, 64)
      ) {
          $this->jsonResponse([
              'status' => 400,
              'message' => 'Longueur incorrecte (nom et prénom min 2, email min 5, mot de passe min 8)'
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

     // Vérifier si l'utilisateur existe déjà
     if($userModel->getUserByEmail($datas['email']))
     {
        $this->jsonResponse([
            'status' => 409,
            'message' => 'Un utilisateur avec cet email existe déjà'
        ]);
        return;
     }

     // Créer l'utilisateur avec un tableau associatif
     $userData = [
         'nom' => $datas['nom'],
         'prenom' => $datas['prenom'],
         'email' => $datas['email'],
         'password' => password_hash($datas['password'], PASSWORD_DEFAULT),
         'statut' => 'actif'
     ];
     
     $userModel->createUser($userData);

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
                
                // Stocker les informations de l'utilisateur en session
                $_SESSION['user'] = $user;
                $_SESSION['user_id'] = $user['id'];
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