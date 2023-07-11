<?php
session_start();
//CONFIGURAÇÕES DO BANCO DE DADOS
//constante
define('SERVIDOR','localhost');
define('USUARIO','root');
define('SENHA','');
define('BANCO','sgcarro');
//limpar dados para ir base de dados 
function limpaPost($dados){
    $dados = trim($dados);//elemina espasos em branco no inicio e no fim
    $dados = stripslashes($dados);//tira baras
    $dados = htmlspecialchars($dados);//tira  caracteres espesia 
    return $dados;
}
?>