<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        $_SESSION["questionnumber"] = 1;
        $this->cookieExists();

        $this->render('login');
    }

    public function about_us()
    {
        $_SESSION["questionnumber"] = 1;
        $this->cookieNotExists();

        $this->render('about_us');
    }
}