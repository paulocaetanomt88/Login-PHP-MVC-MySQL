<?php

    // usar namespace é importante caso for trabalhar com mais de uma classe de Conexão
    namespace Login\Database;

    // Lembrete: classes abstratas não podem ser instanciadas
    abstract class Connection
    {
        // atritubo estático que armazena a conexão
        private static $conn;

        // função que será chamada por todas as classes que queiram utilizar uma instância do PDO
        public static function getConn()
        {
            // utiliza self:: ao invés de this-> porque é um atributo estático
            if(!self::$conn) {
                self::$conn = new \PDO('mysql: host=localhost; dbname=bd-sist-login', 'root', '');
            }

            return self::$conn;
        }

    }

?>