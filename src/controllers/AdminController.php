<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/Country.php';

class AdminController extends AppController
{
    private $country;

    public function __construct()
    {
        parent::__construct();
        $this->country = new Country();
    }
    
    public function admin()
    {
        if (!isset($_SESSION)){
            session_start();
        }

        $_SESSION["questionnumber"] = 1;
        $this->cookieNotExists();

        $countries = $this->country->showCountries();

        if (!$countries) {
            return $this->render('admin', ['error' => ['No data yet!', 'You need to fill database!']]);
        }

        if ($this->isPost()) {
            if (isset($_POST["short"]))
                $this->render('admin', ['countries' => $countries, 'current_country' => $_POST["short"]]);
            else if (isset($_POST["insert"])) {
                $this->country->updateCountry($_POST['insert'], $_POST['price'], $_POST['price2'],$_POST['temperature']);
                $countries = $this->country->showCountries();
                $this->render('admin', ['countries' => $countries]);
            }
        } 

        unset($_SESSION['send']);

        $this->render('admin', ['countries' => $countries]);
        
    }
}