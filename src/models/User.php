<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $admin;

    public function __construct(
        string $email,
        string $password,
        string $name,
        string $surname,
        int $admin
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->admin = $admin;
    }

    public function getEmail(): string 
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getAdmin(): int
    {
        return $this->admin;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }
}