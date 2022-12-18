<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Result.php';

class Country extends Repository
{
    public function showCountries() {
        $stmt = $this->database->connect()->prepare('
            SELECT * from country order by id_country;
        ');

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results == false) {
            return null;
        }

        return $results;
    }

    public function updateCountry($id_c, $price, $price2, $temperature)
    {
        $stmt = $this->database->connect()->prepare('
            UPDATE country set (price, price_rent, temperature) = (?, ?, ?)
            where id_country = ?;
        ');

        $stmt->execute([
            $price,
            $price2,
            $temperature,
            $id_c
        ]);
    }

    public function showResults()
    {
        // SELECT r.id_results, r.name, r.temperature_link from results r order by r.name
        $stmt = $this->database->connect()->prepare('
            SELECT r.id_results, r.name, r.temperature_link from results r order by r.name
        ');

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results == false) {
            return null;
        }

        return $results;
    }

    public function showTemperatures(int $id_r)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT t.id_results, t.temperature as temp, t.month, r.name, r.temperature_link from temperature t join results r on t.id_results = r.id_results where t.id_results = :idr order by t.month
        ');

        $stmt->bindParam(':idr', $id_r, PDO::PARAM_INT);
        $stmt->execute();

        $temperatures = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($temperatures == false) {
            return null;
        }

        return $temperatures;
    }

    public function editTemperatures(int $id, array $temperatures)
    {
        for($i = 0; $i < 12; $i++) {
            $stmt = $this->database->connect()->prepare('
                UPDATE temperature set temperature = ?
                where id_results = ? and month = ?;
            ');

            $stmt->execute([
                $temperatures[$i],
                $id,
                $i+1
            ]);
        }

        $temperatures = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($temperatures == false) {
            return null;
        }

        return $temperatures;
    }
}