<?php

    class LoginController
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader, [
                'cache' => '/path/to/compilation_cache',
                'auto_reload' => true,
            ]);

            $template = $twig->load('login.html');
                $msg['error'] = $_SESSION['msg_error'] ?? null;

            return $template->render($msg);
        }

        public function check()
        {
            try
            {
                // cria um objeto da Classe User com todos os seus atributos e métodos
                $user = new User;
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['senha']);
                $user->validateLogin();

                header('Location: http://localhost/sistema-login/dashboard/');
            } 
            catch (\Exception $e)
            {
                $_SESSION['msg_error'] = array('msg' => $e->getMessage(), 'count' => 0);

                header('Location: http://localhost/sistema-login/');
            }
        }
    }

?>