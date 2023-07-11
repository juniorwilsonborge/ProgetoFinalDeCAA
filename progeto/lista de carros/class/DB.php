<?php
require_once('conf.php');

class DB{
    private static $pdo;
    //funcao instanciar 
    public static function instanciar(){
        if(!isset(self::$pdo)){// se nao existir conexao vai fazer conexao
            try{
              self::$pdo = new PDO('mysql:host='.SERVIDOR.';dbname='.BANCO,USUARIO,SENHA);//fazer conexao
              self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
              self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }catch(PDOException $erro){
                echo "Falha ao se conectar com o banco: ".$erro->getMessage();
            }
        }

        return self::$pdo;
    }
//funcao 
    public static function prepare($sql){       
        return self::instanciar()->prepare($sql); //instanciar o banco
    }
}
?>