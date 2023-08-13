<?php

namespace App\Db;


//on importe PDO
use PDO;
use PDOExeption;


class Db extends PDO
{
    //Une instance unique de la classe

    private static $instance;

    //Informations de connexion
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'demo_poo';

    private function __construct()
    {
        //DSN DE CONNEXION
        $_dsn = 'mysql:dbname='. self::DBNAME . ';host=' . self::DBHOST;
        
        //On appelle le constructeur de la classe PDO
        try{
            //On récupère les éléments du construct Parent
            parent::__construct($_dsn, self::DBUSER, self::DBPASS);

            //THIS = PDO
            //Pour faire toutes les transitions en utf8
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');

            //Chaque FETCH en FETCH_ASSOC
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            //Erreur mode
            // $this->setAtttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXEPTION);

            }catch(PDOExeption){
                die($e->getMessage());
            }

    }

    public static function getInstance():self
    {
        if(self::$instance === null){
            self::$instance = new self(); //self = Db
        }
        return self::$instance;
    }
}
