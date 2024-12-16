<?php

class UserModel
{
    protected $db;

    public function __construct()
    {
        $this->db = DataBase::getConnection();
    }

    // Récupérer un utilisateur par son ID
    public function getUserById($userId): ?UserEntity
    {
        $statement = $this->db->prepare('SELECT id, name, email, password, role, image FROM users WHERE id = :id');
        $statement->execute(['id' => $userId]);
        $row = $statement->fetch(PDO::FETCH_OBJ);

        return $row ? new UserEntity($row->id, $row->name, $row->email, $row->password, $row->role, $row->image) : null;
    }

    // Récupérer un utilisateur par son email
    public function getUserByEmail($email): ?UserEntity
    {
        $sql = "SELECT id, name, email, password, role, image FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row ? new UserEntity($row->id, $row->name, $row->email, $row->password, $row->role, $row->image) : null;
    }

    // Créer un utilisateur
    public function createUser(UserEntity $user): bool
    {
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password, role, image) VALUES (:name, :email, :password, :role, :image)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
        $stmt->bindValue(':image', $user->getImage(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Mettre à jour un utilisateur
    public function updateUser(UserEntity $user): bool
    {
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_BCRYPT);
        $sql = "UPDATE users SET name = :name, email = :email, password = :password, role = :role, image = :image WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':role', $user->getRole(), PDO::PARAM_STR);
        $stmt->bindValue(':image', $user->getImage(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Supprimer un utilisateur
    public function deleteUser($userId): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
