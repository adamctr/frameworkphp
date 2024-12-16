<?php

class UserController {
    protected $user;

    // Le constructeur prend maintenant l'ID de l'utilisateur en paramètre
    public function __construct($userId = null) {
        if ($userId !== null) {
            $userModel = new UserModel();
            $this->user = $userModel->getUserById($userId);
        }
    }



    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processUpdate(); // Si la méthode est POST, on traite la mise à jour
        } else {
            $this->showEditForm(); // Sinon, on affiche le formulaire
        }
    }

    // Affiche le formulaire d'édition
    protected function showEditForm() {
        /*$view = new EditUserView($this->user);
        $view->show();*/
    }

    // Traite la mise à jour de l'utilisateur
    protected function processUpdate() {
        $name = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        // Mise à jour des informations dans la base de données
        $userModel = new UserModel();
        $userModel->updateUser($this->user->getId(), $name, $password);

        // Redirection après la mise à jour
        header('Location: /user/' . $this->user->getId());
        exit();
    }

    public function delete() {
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        // Vérification de l'ID du post
        if (!isset($data['userId']) || empty($data['userId'])) {
            Utils::sendResponse(false, "ID de l'utilisateur manquant ou invalide");
            return;
        }

        $userId = $data['userId'];
        $userModel = new UserModel();
        // Appeler la méthode deleteUser dans le modèle pour supprimer l'utilisateur
        $result = $userModel->deleteUser($userId);

        if ($result) {
            // Si la suppression réussit, redirige vers la page d'administration ou une autre page pertinente
            Utils::sendResponse(true, 'Utilisateur bien supprimé');
            //header("Location: /admin");
            exit();
        } else {
            // Si la suppression échoue, affiche un message d'erreur
            Utils::sendResponse(false, "Une erreur est survenue lors de la suppression de l'utilisateur");
        }
    }

}
