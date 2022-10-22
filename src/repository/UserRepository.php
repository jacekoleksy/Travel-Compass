<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (name, surname, email, password)
            VALUES (?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getEmail(),
            $user->getPassword(),
        ]);
    }

    public function getUserId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email AND password = :password
        ');
        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id_users'];
    }

    public function getPassword(User $user): string
    {
        return $user->getPassword();
    }

    public function editUser(User $user, $email, $password, $name, $surname) {
        $id = $this->getUserId($user);

        $stmt = $this->database->connect()->prepare('
            UPDATE users
            SET email = ?, password = ?
            WHERE id_users = ?;
        ');

        $stmt->execute([
            $email,
            $password,
            $id
        ]);

        $stmt = $this->database->connect()->prepare('
            UPDATE users_details
            SET name = ?, surname = ?
            WHERE id_users_details = ?;
        ');

        $stmt->execute([
            $name,
            $surname,
            $id,
        ]);
    }
}