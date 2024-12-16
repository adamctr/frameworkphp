<?php

class ValidatorController {

    static public function login($email, $password) {

        if(empty($email) || empty($password)) {
            DynamicMessageController::showMessage('error', "Merci de renseigner vos informations");
            return false;
        }

        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user && $user->getEmail()) {
            if (password_verify($password, $user->getPassword())) {
                DynamicMessageController::showMessage('success', "Vous vous êtes bien connecté !");
                return true;
            } else {
                DynamicMessageController::showMessage('error', "Le mot de passe ne correspond pas");
                return false;
            }
        } else {
            DynamicMessageController::showMessage('error', "L'email n'existe pas");
            return false;
        }
    }

    static public function register($email, $password) {
        // Vérifier que l'email et le mot de passe ne sont pas vides
        if (empty($email) || empty($password)) {
            DynamicMessageController::showMessage('error', "Merci de renseigner vos informations");
            return false;
        }

        // Validation de l'adresse email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            DynamicMessageController::showMessage('error', "L'adresse email n'est pas valide");
            return false;
        }

        // Validation du mot de passe
        if (strlen($password) < 8) {
            DynamicMessageController::showMessage('error', "Le mot de passe doit contenir au moins 5 caractères");
            return false;
        }
        if (!preg_match('/[A-Z]/', $password)) {
            DynamicMessageController::showMessage('error', "Le mot de passe doit contenir au moins une lettre majuscule");
            return false;
        }

        // Vérifier si l'utilisateur existe déjà
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($email);

        if ($user && $user->getEmail()) {
            DynamicMessageController::showMessage('error', "L'email est déjà utilisé");
            return false;
        } else {
            // Ajouter l'utilisateur à la base de données
            DynamicMessageController::showMessage('success', "Inscription réussie");
            return true;
        }
    }

}
