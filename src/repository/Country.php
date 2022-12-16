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
}