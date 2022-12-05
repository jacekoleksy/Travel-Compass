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

        $this->cookieExists();

        $_SESSION["questionnumber"] = 1;
        if (!isset($_SESSION["formtype"]))
            $_SESSION["formtype"] = "Standard";

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

    public function settings()
    {
        $_SESSION["questionnumber"] = 1;
        $this->cookieNotExists();

        $this->render('settings');
    }

    public function settings_action()
    {
        if (!$this->isPost()) {
            return $this->render('settings');
        }

        $this->cookieNotExists();

        $email = $_POST['settings-email'];
        $password = $_POST['settings-password'];
        $newpassword = $_POST['settings-new-password'];
        $name = $_POST['settings-name'];
        $surname = $_POST['settings-surname'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('settings', ['messages' => ["Wrong email type!"]]);
        }

        if ($email !== $_SESSION["user"]) {
            if ($this->userRepository->getUser($email) != null) {
                return $this->render('settings', ['messages' => ["User with this email already exists!"]]);
            }
        }

        $user = $this->userRepository->getUser($_SESSION["user"]);
        if (!password_verify($password, $this->userRepository->getPassword($user))) {
            return $this->render('settings', ['messages' => ["Wrong current password!"]]);
        }

        if ($password == $newpassword) {
            return $this->render('settings', ['messages' => ["Passwords are the same!"]]);
        }

        if ($name == null) {
            return $this->render('settings', ['messages' => ["Your Name is necessarily!"]]);
        }

        if ($surname == null) {
            return $this->render('settings', ['messages' => ["Your Surname is necessarily!"]]);
        }

        if ($newpassword !== "") {
            $password = $newpassword;
        }

        $user = $this->userRepository->getUser($_SESSION["user"]);
        $this->userRepository->editUser($user, $email, password_hash($password, PASSWORD_BCRYPT),  $name, $surname);

        $_SESSION["user"] = $email;
        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/settings");
    }
    
    public function logout() {
        session_destroy();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/");
    }

    public function results()
    {
        if (!isset($_SESSION)){
            session_start();
        }

        $_SESSION["questionnumber"] = 1;
        $this->cookieNotExists();

        $results = $this->userRepository->showResult($_SESSION["user"]);

        if (!$results) {
            return $this->render('results', ['error' => ['No results', 'yet!', 'You need to complete Compass form first!']]);
        }

        unset($_SESSION['send']);

        $this->render('results', ['results' => $results]);
    }

    public function recommended()
    {
        $this->cookieNotExists();

        $recommended = $this->userRepository->showRecommended($_SESSION["user"]);

        if (!$recommended) {
            return $this->render('recommended', ['error' => ['No results yet!', 'No data in Database', ' ']]);
        }

        $this->render('recommended', ['recommended' => $recommended]);
    }
}