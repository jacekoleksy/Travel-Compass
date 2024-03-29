<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('index', 'DefaultController');
Router::get('compass', 'QuestionsController');
Router::post('settings', 'SecurityController');
Router::post('settings_action', 'SecurityController');
Router::post('questions', 'QuestionsController');
Router::post('questionsnum', 'QuestionsController');
Router::post('fastform', 'QuestionsController');
Router::post('standardform', 'QuestionsController');
Router::post('accurateform', 'QuestionsController');
Router::post('results', 'SecurityController');
Router::post('recommended', 'SecurityController');
Router::post('answer', 'QuestionsController');
Router::post('login', 'SecurityController');
Router::post('admin', 'AdminController');
Router::post('admin_temperature', 'AdminController');
Router::post('register', 'SecurityController');
Router::post('logout', 'SecurityController');

Router::run($path);