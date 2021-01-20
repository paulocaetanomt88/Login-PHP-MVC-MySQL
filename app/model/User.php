<?php
    use Login\Database\Connection;

    class User
    {
        private $id;
        private $name;
        private $email;
        private $password;

        /*
          conectar ao banco de dados
          selecionar o usuário que tenha o e-mail e a senha informados
          conferir dados
          se estiver tudo ok, redireciona para o dashboard
          senão redireciona para formulário de login
        */
        public function validateLogin()
        {
            $conn = Connection::getConn();
            
            $sql = 'SELECT * FROM user WHERE email = :email';

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email', $this->email);
            $stmt->execute();

            if ($stmt->rowCount())
            {
                $result = $stmt->fetch();

                if ($result['password'] === $this->password) {
                    $_SESSION['usr'] = array(
                        'id_user' => $result['id'],
                        'name_user' => $result['name']
                    );

                    return true;
                }
            }
            
            throw new \Exception('Login inválido');
        }

        public function setName($name)
        {
            $this->name = $name;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getName()
        {
            return $this->name;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getPassword()
        {
            return $this->password;
        }
    }

?>