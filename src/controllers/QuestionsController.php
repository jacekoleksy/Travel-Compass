<?php

require_once 'AppController.php';
require_once __DIR__ . '/../repository/UserRepository.php';
require_once __DIR__ . '/../repository/Questions.php';

class QuestionsController extends AppController
{

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
        $this->cookieNotExists();

        if (!isset($_SESSION)) {
            session_start();
        }

        if (!$this->isPost()) {
            $_SESSION["questionnumber"] = 1;
            //$_SESSION["formtype"] = "Standard";
            $_SESSION["value_w"] = 0;
            $_SESSION["value_h"] = 0;
        } else if (!isset($_SESSION['send'])) {
            $_SESSION['send'] = 100;
            $questionValues = $this->questions->getQuestions();
            $answers = explode(',', $_POST['answers']);
            foreach ($questionValues as $key => $quest) {
                if ($key >= count($answers))
                    break;

                if ($key == 0)
                    $_SESSION['price'] = intval($answers[$key]) * 31;
                else if ($key == 1)
                    $_SESSION['temperature'] = intval($answers[$key]);
                else if ($key == 2)
                    $_SESSION['results_t'] = intval($answers[$key]);
                else if ($key == 3) {
                    if (intval($answers[$key]) <= 0)
                        $_SESSION['results_t'] = 0;
                } else {
                    $_SESSION['value_h'] += intval($answers[$key]) * $quest['value_h'];
                    $_SESSION['value_w'] += intval($answers[$key]) * $quest['value_w'];
                }
            }
            $this->userRepository->addResult($_SESSION['user']);

            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/results");
        } else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/results");
        }

        return $this->render('compass', [
            'currentquestion' => $_SESSION['questionnumber'],
            'value_h' => $this->questions->getHeightValue($_SESSION['questionnumber']),
            'value_h2' => $this->questions->getHeightValue(2),
            'value_w' => $this->questions->getWidthValue($_SESSION['questionnumber']),
            'value_w2' => $this->questions->getWidthValue(2),
            'questionnum' => $this->questions->getNumberOfQuestions(),
            'questiontitle' => $this->questions->getQuestionTitle($_SESSION['questionnumber']),
            'questiontype' => $this->questions->getQuestionType($_SESSION['questionnumber']),
            'resultstype' => $this->questions->getResultsType(),
            'formtype' => $_SESSION['formtype']
        ]);
    }

    public function fastform()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['formtype'] = 'Fast';

        $this->cookieNotExists();
        //$this->cookieExists();

        $this->render('compass', [
            'currentquestion' => $_SESSION['questionnumber'],
            'value_h' => $this->questions->getHeightValue($_SESSION['questionnumber']),
            'value_h2' => $this->questions->getHeightValue(2),
            'value_w' => $this->questions->getWidthValue($_SESSION['questionnumber']),
            'value_w2' => $this->questions->getWidthValue(2),
            'questionnum' => $this->questions->getNumberOfQuestions(),
            'questiontitle' => $this->questions->getQuestionTitle($_SESSION['questionnumber']),
            'questiontype' => $this->questions->getQuestionType($_SESSION['questionnumber']),
            'resultstype' => $this->questions->getResultsType(),
            'formtype' => $_SESSION['formtype']
        ]);
    }

    public function standardform()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['formtype'] = 'Standard';

        $this->cookieNotExists();
        //$this->cookieExists();

        $this->render('compass', [
            'currentquestion' => $_SESSION['questionnumber'],
            'value_h' => $this->questions->getHeightValue($_SESSION['questionnumber']),
            'value_h2' => $this->questions->getHeightValue(2),
            'value_w' => $this->questions->getWidthValue($_SESSION['questionnumber']),
            'value_w2' => $this->questions->getWidthValue(2),
            'questionnum' => $this->questions->getNumberOfQuestions(),
            'questiontitle' => $this->questions->getQuestionTitle($_SESSION['questionnumber']),
            'questiontype' => $this->questions->getQuestionType($_SESSION['questionnumber']),
            'resultstype' => $this->questions->getResultsType(),
            'formtype' => $_SESSION['formtype']
        ]);
    }

    public function accurateform()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['formtype'] = 'Accurate';

        $this->cookieNotExists();
        //$this->cookieExists();

        $this->render('compass', [
            'currentquestion' => $_SESSION['questionnumber'],
            'value_h' => $this->questions->getHeightValue($_SESSION['questionnumber']),
            'value_h2' => $this->questions->getHeightValue(2),
            'value_w' => $this->questions->getWidthValue($_SESSION['questionnumber']),
            'value_w2' => $this->questions->getWidthValue(2),
            'questionnum' => $this->questions->getNumberOfQuestions(),
            'questiontitle' => $this->questions->getQuestionTitle($_SESSION['questionnumber']),
            'questiontype' => $this->questions->getQuestionType($_SESSION['questionnumber']),
            'resultstype' => $this->questions->getResultsType(),
            'formtype' => $_SESSION['formtype']
        ]);
    }

    public function questions()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $que = $this->questions->getAllQuestions();

        echo json_encode($que);
    }

    public function questionsnum()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $que = $this->questions->getNumberOfQuestions();

        echo json_encode($que);
    }

    // public function answer()
    // {
    //     if (!isset($_SESSION)) {
    //         session_start();
    //     }
    //     $this->cookieNotExists();

    //     $answer = json_decode(file_get_contents('php://input'));
    //     $this->compass_action($answer->idq, $answer->value);
    // }
}
