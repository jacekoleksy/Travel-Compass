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
        $this->cookieNotExists('admin');
        if($_SESSION['admin'] != 1) {
            $this->render('index');
        }

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

    public function admin_temperature()
    {
        if (!isset($_SESSION)){
            session_start();
        }

        $_SESSION["questionnumber"] = 1;
        $this->cookieNotExists('admin_temperature');
        if($_SESSION['admin'] != 1) {
            $this->render('index');
        }

        $countries = $this->country->showResults();

        if (!$countries) {
            return $this->render('admin', ['error' => ['No data yet!', 'You need to fill database!']]);
        }

        if (isset($_POST["temperatures"])) {
            $temp = array($_POST['1'], $_POST['2'], $_POST['3'], $_POST['4'], $_POST['5'], $_POST['6'], $_POST['7'], $_POST['8'], $_POST['9'], $_POST['10'], $_POST['11'], $_POST['12']);
            $temperatures = $this->country->editTemperatures(intval($_POST['id_results']), $temp);
            $countries = $this->country->showResults();
            $this->render('admin_temperature', ['countries' => $countries]);
        } else if (isset($_POST["country"])) {
            $temperatures = $this->country->showTemperatures(intval($_POST['country']));
            $this->render('admin_temperature', ['countries' => $countries, 'temperatures' => $temperatures]);
        } else {
            unset($_SESSION['send']);
            $this->render('admin_temperature', ['countries' => $countries]);
        }
    }
}