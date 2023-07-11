<?php
require_once('DB.php');
//classe abstrata que vai rxtender db
abstract class Crud extends DB{
    protected string $tabela; //pega nome de tabela que queremos 

    abstract public function insert();// abstrata porque vai ser herdada e vai ser rescrito
    abstract public function update($id);
//procur uma unica dados
    public function find($id){
        $sql = "SELECT * FROM $this->tabela WHERE id=?";
        $sql = DB::prepare($sql);
        $sql->execute(array($id));
        $valor = $sql->fetch();
        return $valor; //return o valor que foi pege
    }
//procurar todos os dados da tabelas
    public function findAll(){
        $sql = "SELECT * FROM $this->tabela";
        $sql = DB::prepare($sql);
        $sql->execute();
        $valor = $sql->fetchAll();
        return $valor;
    }
//eleminar uma unica dados de tabela
    public function delete($id){
        $sql = "DELETE FROM $this->tabela WHERE id=?";
        $sql = DB::prepare($sql);
        return $sql->execute(array($id));
    }

}
?>