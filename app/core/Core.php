<?php

    class Core
    {
        private $url;

        private $controller;
        private $method = 'index';
        private $params = array();

        private $user;

        private $error;

        public function __construct()
        {
            $this->user = $_SESSION['usr'] ?? null;
            $this->error = $_SESSION['msg_error'] ?? null;

            if (isset($this->error)) {
                if($this->error['count'] === 0) {
                    $_SESSION['msg_error']['count']++;
                }  else {
                    unset($_SESSION['msg_error']);
                }
            }
        }

        public function start($request)
        {
            if (isset($request['url'])) {
                $this->url = explode('/', $request['url']);

                $this->controller = ucfirst($this->url[0]).'Controller';
                
                // verifica se o parametro url foi definido com algo na posição [0] e se é o conteúdo é diferente de texto vazio
                if (isset($this->url[1]) && $this->url[1] != '') {
                    $this->method = $this->url[1];

                    if (isset($this->url[2]) && $this->url[2] != '') {
                        $this->params = $this->url[2];
                    }
                } 
            } 
            
            if ($this->user) {
                $pg_permission = ['DashboardController'];

                if (!isset($this->controller) || !in_array($this->controller, $pg_permission)) {
                    $this->controller = 'DashboardController';
                    $this->method = 'index';
                }
            } else {
                $pg_permission = ['LoginController'];

                if (!isset($this->controller) || !in_array($this->controller, $pg_permission)) {
                    $this->controller = 'LoginController';
                    $this->method = 'index';
                }
            }
            
            // else {
            //     $this->controller = 'LoginController';
            //     $this->method = 'index';
            // }
            
            // função que carrega a Controller, chama o método que chama a View html, parametros são opcionais
            return call_user_func(array(new $this->controller, $this->method), $this->params);

            //var_dump($this->controller, $this->method, $this->params);
        }
    }

?>