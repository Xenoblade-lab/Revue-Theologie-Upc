<?php 
  namespace Service;

  use Controllers\Controller;

  class AuthService extends Controller
  {
    public function sign(array $datas = [], array $fields = [])
    {
       $user = new \Models\UserModel(new \Models\Database());
    //   if (!$this->isNotEmpty($datas)) {
    //        $this->jsonResponse([
    //           'status' => 400,
    //           'message' => 'Tous les champs sont requis'
    //       ]);
    //        return;
    //   }

     // Validation des longueurs
    //   if (
    //       !$this->valideLength($datas['fullname'], 6, 64) ||
    //       !$this->valideLength($datas['prenom'], 6, 64) ||
    //       !$this->valideLength($datas['institution'], 6, 64) ||
    //       !$this->valideLength($datas['email'], 6, 64) ||
    //       !$this->valideLength($datas['password'], 6, 64)  
    //   ) {
    //       $this->jsonResponse([
    //           'status' => 400,
    //           'message' => 'Longueur incorrecte'
    //       ]);
    //       return;
    //   }

      // Validation des formats
    //   $validators = [
    //       ['value' => $datas['mails'], 'regex' => $this->emailRegex, 'field' => 'Email invalide'],
    //       ['value' => $datas['mdps'], 'regex' => $this->passwordRegex, 'field' => 'Mot de passe invalide']
    //   ];

    //  foreach ($validators as $validator) {
    //      if (!$this->matcherString($validator['value'], $validator['regex'])) {
    //          $this->jsonResponse([
    //              'status' => 400,
    //              'message' => $validator['field']
    //          ]);
    //          return;
    //      }
    //  }

     if(!$this->isEqual($datas['password'],$datas['confirm-password']))
     {
        $this->jsonResponse([
            'status' => '409',
            'message' => 'Les 2 mot de passe  sont differents'
        ]);

        return;
     }

    //  if($user->getUserByEmail($datas['email']))
    //  {
    //     // arrete tout si l utilisateur existe
    //     $this->jsonResponse([
    //         'status' => '409',
    //         'message' => 'Utilisateur existant'
    //     ]);
    //     return;
    //  }
//    var_dump($datas);
//    die;
  
    // Si tout est valide, tu peux continuer ici (ex: insertion en base)
    $datas = [
        'nom' => $datas['nom'],
        'prenom' => $datas['prenom'],
        'institution' => $datas['institution'],
        'email' => $datas['email'],
        'password' => $datas['password'],
        'confirmPassword' => $datas['confirm-password'],
        'terms' => $datas['terms']
    ];
     $user->createUser($datas);

     $this->jsonResponse([
         'status' => 200,
         'message' => 'Inscription réussie',
         'redirect' => 'index.php?p=connexion'
     ]);

     header("Location: ".\Router\Router::route('login'));
     return;
    }
    
    // fonction pour la connexion 

    public function login($datas = [] , $fields = [])
    {
        $user = new \Models\UserModel(new \Models\Database());
       if (!$this->isNotEmpty($datas) || !$this->verifyFields($datas, $fields)) {
             $this->jsonResponse([
                'status' => 400,
                'message' => 'Tous les champs sont requis'
            ]);
             return;
        }

       if(
          !$this->valideLength($datas['email']) ||
          !$this->valideLength($datas['password'])
        ) {
          $this->jsonResponse([
              'status' => 400,
              'message' => 'Longueur incorrecte'
          ]);
          return;
        }

        // $validators = [
        //     ['value' => $datas['mails'], 'regex' => $this->emailRegex, 'field' => 'Email invalide'],
        //     ['value' => $datas['mdps'], 'regex' => $this->passwordRegex, 'field' => 'Mot de passe invalide']
        // ];

        // foreach ($validators as $validator) {
        //   if (!$this->matcherString($validator['value'], $validator['regex'])) {
        //       $this->jsonResponse([
        //           'status' => 400,
        //           'message' => $validator['field']
        //       ]);
        //       return;
        //   } 
        // }
        $user = $user->getUserByEmail($datas['email']);
        
        if ($user) {

            // $this->jsonResponse([
            //     'status' => 200,
            //     'message' => 'Connexion réussie',
            // ]);
            $user->giveOnlineUser($user['id_user']);
            $_SESSION['user'] = $user;
            $_SESSION['panier'] = [];

            header("Location: ".\Router\Router::route(''));
            return;
        }

        else {

            $this->jsonResponse([
                'status' => 401,
                'message' => 'Email ou mot de passe incorrect'
            ]);
         return;
        }
     
    }
    

       public function logout()
      {
          $_SESSION = array();
          session_destroy();
       }

       public static function requireLogin() 
       {
            if (!self::isLoggedIn()) {
                header('Location: ' .\Router\Router::route('login'));
                exit;
            }
        }
        
        public static function isLoggedIn() {
            return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
        }

  }
?>