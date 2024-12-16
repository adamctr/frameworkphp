<?php

class AuthController {


    public function showLoginForm() {
        // Affiche la page formulaire de connexion
        $view = new AuthView();
        (new PageView($view->showLoginForm(), "Page de connexion", "Cette page sert pour l'utilisateur afin de se connecter", ['loginRegister']))->show();


    }

    public function showRegisterForm() {
        // Affiche la page formulaire d'inscription
        $view = new AuthView();
        (new PageView($view->showRegisterForm(), "Page d'inscription", "Cette page sert pour l'utilisateur afin de s'inscrire au site", ['loginRegister']))->show();


    }

    public function login() {

        if (!Utils::isAjax()) {
            Utils::sendResponse('error', 'Erreur lors de la requête AJAX');
            return;
        }

        $userModel = new UserModel();

        $email = trim($_POST['email']) ?? '';
        $password = trim($_POST['password']) ?? '';
        $remember = trim($_POST['remember']) ?? '';
        $validation = ValidatorController::login($email, $password);


        if ($validation) {
            $user = $userModel->getUserByEmail($email);
            $sessionController = new SessionController();
            $sessionController->login($user->getId());

            $expirationTime = $remember ? (time() + 30 * 24 * 3600) : (time() + 7200); // 30 jours ou 2 heures

            $headerJWT = [
                'alg' => 'HS256',
                'type' => 'jwt'];

            $payloadJWT = [
                'userId' => $user->getId(),
                "exp" => $expirationTime,
                "revocate" => 0,
            ];

            $jwt = (new JWT())->generateJWT($headerJWT, $payloadJWT);
            setcookie('auth_token', $jwt, $expirationTime, './', '', true, true);
            //header("Location: /");
            //exit;
        }
    }


    public function register() {
        if (!Utils::isAjax()) {
            Utils::sendResponse('error', 'Erreur lors de la requête AJAX');
            return;
        }

        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $validation = ValidatorController::register($email, $password);

        if ($validation) {
            $userEntity = new UserEntity(null, $name, $email, $password);
            $userModel = new UserModel();
            $userModel->createUser($userEntity);
        }


    }

    static public function logout() {
        // Déconnecte l'utilisateur en détruisant la session
        $sessionController = new SessionController();
        $sessionController->logout();

        // Redirige vers la page de connexion après déconnexion
        header("Location: /login");
        exit;
    }
}
