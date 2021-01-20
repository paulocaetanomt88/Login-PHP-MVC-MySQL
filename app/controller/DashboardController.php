<?php

class DashboardController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader, [
            'cache' => '/path/to/compilation_cache',
            'auto_reload' => true,
        ]);

        $template = $twig->load('dashboard.html');
            $msg['name_user'] = $_SESSION['usr']['name_user'];

        return $template->render($msg);
    }

    public function logout()
    {
        unset($_SESSION['usr']);
        session_destroy();

        header("Location: http://localhost/sistema-login/");
    }
}

?>