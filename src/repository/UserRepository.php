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
        
        $email = $user->getEmail();
        $password = $user->getPassword();

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
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
            SET email = ?, password = ?, name = ?, surname = ?
            WHERE id_users = ?;
        ');

        $stmt->execute([
            $email,
            $password,
            $name,
            $surname,
            $id,
        ]);
    }

    public function addResult(string $email){
        $user = $this->getUser($email);
        $id_user = $this->getUserId($user);

        if ($_SESSION['value_h'] > 35) 
            $value_h = 35;
        else if ($_SESSION['value_h'] < -35) 
            $value_h = -35;
        else 
            $value_h = $_SESSION['value_h'];

        if ($_SESSION['value_w'] > 30) 
            $value_w = 30;
        else if ($_SESSION['value_w'] < -30) 
            $value_w = -30;
        else 
            $value_w = $_SESSION['value_w'];

        $value_w = $value_w / 3;
        $price = $_SESSION['price'] * (1 - (0.3 * $value_h / 30));
        
        if($_SESSION['results_t'] == 0) {
            $stmt = $this->database->connect()->prepare('
            select r.id_results, r.name, (abs(((c.price+c.price_rent) - (?)) / 75) + abs(r.value_w - (?)) + abs((c.temperature - (?)))) as difference from results r join country c on r.id_country = c.id_country
            order by difference asc limit 1;
            ');

            $stmt->execute([
                $price,
                $value_w,
                $_SESSION['temperature']
            ]);
        }
        else {
            $stmt = $this->database->connect()->prepare('
            select r.id_results, r.name, (abs(((c.price+c.price_rent) - (?)) / 75) + abs(r.value_w - (?)) + abs((c.temperature - (?)))) as difference from results r join country c on r.id_country = c.id_country where r.id_results_types = (?)
            order by difference asc limit 1;
            ');

            $stmt->execute([
                $price,
                $value_w,
                $_SESSION['temperature'],
                $_SESSION['results_t']
            ]);
        }

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $id_result = $data['id_results'];

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_results (id_users, value_h, value_w, price, temperature, id_results, id_results_types)
            VALUES (?, ?, ?, ?, ?, ?, ?);
        ');

        $stmt->execute([
            $id_user,
            $value_h,
            $value_w,
            $_SESSION['price'],
            $_SESSION['temperature'],
            $id_result,
            $_SESSION['results_t']
        ]);
    }

    public function showResult(string $email) {
        $user = $this->getUser($email);
        $id_user = $this->getUserId($user);

        $stmt = $this->database->connect()->prepare('
            SELECT users_results.id_users_results, users_results.id_results, users_results.value_w as user_value_w, results.value_w as result_value_w, users_results.value_h as user_value_h, users_results.price as user_price, (country.price + country.price_rent) as result_price, country.name as country, results.name, results.description, country.temperature as result_temperature, users_results.temperature as user_temperature, results.map as map from users_results 
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

    public function showRecommended() {
        $stmt = $this->database->connect()->prepare('
            SELECT results.id_results as id, results.name as name, country.name as country, (country.price + country.price_rent) as price, results.value_w as value_w, country.temperature as temperature, results.description as description, results.map as map from results join country on results.id_country = country.id_country
            order by recommended, random();
        ');

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results == false) {
            return null;
        }

        return $results;
    }
}