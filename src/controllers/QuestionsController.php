<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/Questions.php';

class QuestionsController extends AppController {

    private $userRepository;
    private $questions;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->questions = new Questions();
    }
    
    public function compass()
    {
        //$this->cookieNotExists();

        if (!$this->isPost()) {
            $_SESSION["questionnumber"] = 1;
            $_SESSION["value_w"] = 0;
            $_SESSION["value_h"] = 0;
        }
        else if(!isset($_SESSION['send'])){
            $_SESSION['send'] = 100;
            $questionValues = $this->questions->getQuestions();
            $answers = explode(',', $_POST['answers']);
            foreach ($questionValues as $key => $quest) {
                $_SESSION['value_h'] += intval($answers[$key]) * $quest['value_h'];  
                $_SESSION['value_w'] += intval($answers[$key]) * $quest['value_w'];  
            }
            $this->userRepository->addResult($_SESSION['user']);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/results");
        } 
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/results");
        }

        return $this->render('compass', ['currentquestion' => $_SESSION['questionnumber'], 'questionnum' => $this->questions->getNumberOfQuestions(), 'questiontitle' => $this->questions->getQuestionTitle($_SESSION['questionnumber']), 'questiontype' => $this->questions->getQuestionType($_SESSION['questionnumber'])]);
    }

    public function questions() {
        $que = $this->questions->getAllQuestions();

        echo json_encode($que);
    }

    public function answer() {
        //$this->cookieNotExists();

        $answer = json_decode(file_get_contents('php://input'));
        $this->compass_action($answer->idq, $answer->value);
    }
}