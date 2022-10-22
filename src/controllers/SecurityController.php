<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $userRepository;
    private $questions;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {   
        if (!isset($_SESSION)){
            session_start();
        }

        $_SESSION["questionnumber"] = 1;

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['login-email'];
        $password = $_POST['login-password'];

        $user = $this->userRepository->getUser($email);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('login', ['messages' => ["Wrong email type!"]]);
        }

        if (!$user) {
            return $this->render('login', ['messages' => ['User not found!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email exists!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION["user"] = $email;
        $_SESSION["name"] = $user->getName();
        $_SESSION["surname"] = $user->getSurname();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/compass");
    }
    
    public function register()
    {   
        $_SESSION["questionnumber"] = 1;
        $this->cookieExists();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['register-email'];
        $password = $_POST['register-password'];
        $confirmpassword = $_POST['register-confirm-password'];
        $name = $_POST['register-name'];
        $surname = $_POST['register-surname'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('login', ['messages2' => ["Wrong email type!"]]);
        }

        if ($password !== $confirmpassword) {
            return $this->render('login', ['messages2' => ["Passwords don't match!"]]);
        }

        if ($this->userRepository->getUser($email) != null) {
            return $this->render('login', ['messages2' => ["User with this email already exists!"]]);
        }

        if ($name == null) {
            return $this->render('login', ['messages2' => ["Your Name is necessarily!"]]);
        }

        if ($surname == null) {
            return $this->render('login', ['messages2' => ["Your Surname is necessarily!"]]);
        }

        if (!isset($_POST['terms-of-use'])) {
            return $this->render('login', ['messages2' => ["You have to accept Terms of Use!"]]);
        }

        $_SESSION["user"] = $email;
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;

        $user = new User($email, password_hash($password, PASSWORD_BCRYPT), $name, $surname);
        $this->userRepository->addUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/compass");
    }
    
    public function logout() {
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }
}