<?php

namespace App\Config;

use PDO;

class Conexao {

    private $endereco   = "mysql:dbname=crmall;host=localhost";
    private $user       = "root";
    private $senha      = "root";
    public static $conexaoSingleton = null;

    public function __construct()
    {
        if(!self::$conexaoSingleton){
            self::$conexaoSingleton = new PDO($this->endereco, $this->user, $this->senha);
        }
    }

    public function exec(){
        return self::$conexaoSingleton;
    }

}