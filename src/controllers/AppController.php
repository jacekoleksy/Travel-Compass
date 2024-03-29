<?php

class AppController
{
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
        session_start();
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        print $output;
    }

    protected function cookieExists()
    {
        if (isset($_SESSION['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/results");
        }
    }

    protected function cookieNotExists(string $page = 'compass')
    {
        if (!isset($_SESSION['user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        }

        if (!isset($_SESSION)){
            session_start();
        }
        $_SESSION['page'] = $page;
    }
}
