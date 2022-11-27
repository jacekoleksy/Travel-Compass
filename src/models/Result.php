<?php

class Result {
    private $id_users_results;
    private $id_results;
    private $value_w;
    private $value_h;
    private $country;
    private $name;
    private $description;
    private $tempreature;

    public function __construct(
        int $id_users_results,
        int $id_results,
        int $value_w,
        int $value_h,
        string $country,
        string $name,
        string $description,
        int $temperature
    ) {
        $this->id_users_results = $id_users_results;
        $this->id_results = $id_results;
        $this->value_w = $value_w;
        $this->value_h = $value_h;
        $this->country = $country;
        $this->name = $name;
        $this->description = $description;
        $this->temperature = $temperature;
    }

    public function getId(): int 
    {
        return $this->id_users_results;
    }

    public function getValueH(): int
    {
        return $this->value_h;
    }

    public function getValueW(): int
    {
        return $this->value_w;
    }

    public function getIdResult(): int
    {
        return $this->id_results;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDesc(): string
    {
        return $this->description;
    }
}
?>
