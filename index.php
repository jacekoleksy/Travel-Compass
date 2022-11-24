<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('index', 'DefaultController');
Router::get('compass', 'QuestionsController');
Router::post('questions', 'QuestionsController');
Router::post('answer', 'QuestionsController');
Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('logout', 'SecurityController');

Router::run($path);