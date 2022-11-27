<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Result.php';

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

    public function addResult(string $email){
        $user = $this->getUser($email);
        $id_user = $this->getUserId($user);
        
        $stmt = $this->database->connect()->prepare('
        select id_results, name, (abs(value_h - (?)) + abs(value_w - (?))) as difference from results 
        order by difference asc limit 1;
        ');

        $stmt->execute([
            $_SESSION['value_h'],
            $_SESSION['value_w'],
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $id_result = $data['id_results'];

        if ($_SESSION['value_h'] > 13) 
            $value_h = 13;
        else if ($_SESSION['value_h'] < -13) 
            $value_h = -13;
        else 
            $value_h = $_SESSION['value_h'];
        if ($_SESSION['value_w'] > 13) 
            $value_w = 13;
        else if ($_SESSION['value_w'] < -13) 
            $value_w = -13;
        else 
            $value_w = $_SESSION['value_w'];

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_results (id_users, value_h, value_w, id_results)
            VALUES (?, ?, ?, ?);
        ');

        $stmt->execute([
            $id_user,
            $value_h,
            $value_w,
            $id_result
        ]);
    }

    public function showResult(string $email) {
        $user = $this->getUser($email);
        $id_user = $this->getUserId($user);

        $stmt = $this->database->connect()->prepare('
            SELECT users_results.id_users_results, users_results.id_results, users_results.value_w, users_results.value_h, country.name as country, results.name, results.description, results.temperature from users_results 
            inner join results on users_results.id_results = results.id_results join country on results.id_country = country.id_country
            WHERE id_users = :id_users order by users_results.id_users_results desc;
        ');

        $stmt->bindParam(':id_users', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results == false) {
            return null;
        }

        return $results;
    }
}