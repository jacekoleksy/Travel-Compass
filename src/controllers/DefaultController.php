<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function compass()
    {
        $this->cookieExists();

        $this->render('compass');
    }

    public function index()
    {
        //$this->cookieExists();

        $this->render('index');
    }

    public function questions()
    {
        $this->render('questions');
    }

    // public function about_us()
    // {
    //     $_SESSION["questionnumber"] = 1;
    //     $this->cookieNotExists();

    //     $this->render('about_us');
    // }
}