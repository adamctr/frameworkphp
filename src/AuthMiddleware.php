<?php

class AuthMiddleware
{
    public function handle()
    {
        // Vérifiez si le token est présent (par exemple, dans un cookie ou un header)
        $jwt = $_COOKIE['auth_token'] ?? null;

        if (!$jwt) {
            http_response_code(401); // Unauthorized
            Utils::sendResponse('error', 'Unauthorized');
            exit;
        }

        $sessionController = new SessionController();

        // Vérifiez si l'utilisateur est connecté
        if (!$sessionController->isLoggedIn()) {
            // Redirigez vers la page de connexion
            header("Location: /login");
            exit;
        }
    }
}
