<?php
require_once('../class/conf.php');
require_once('../autoload.php');
require_once('../class/DB.php');

$pdo= new DB();


//VERIFICAR SE EXISTE O POST COM TODOS OS DADOS
if (isset($_POST['nome']) && isset($_POST['telefone']) && isset($_POST['cni']) && isset($_POST['idade'])){
    //RECEBER VALORES VINDOS DO POST E LIMPAR
   
    $nome = limpaPost($_POST['nome']);
    $morada = limpaPost($_POST['morada']);
    $telefone = limpaPost($_POST['telefone']);
    $idade = limpaPost($_POST['idade']);
    $cni=limpaPost($_POST['cni']);
    $data= date('d-m-Y');
  
    //VERIFICAR SE VALORES VINDOS DO POST NÃO ESTÃO VAZIOS

    if(empty($nome) or empty($idade) or empty($telefone) or empty($morada) or empty($cni)){
    //     echo "os dados tem que ser prencido obrigatorio";

    }else{

      //public function validar_cadastro(){

      

       //VALIDAÇÃO DO NOME//VALIDAÇÃO DO NOME
      if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/",$nome)) {
        //$this->erro["erro_nome"] = "Por favor informe um nome válido!";
        echo "Nome Invalido";
     }
     if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/",$morada)) {
        //$this->erro["erro_nome"] = "Por favor informe um nome válido!";
     }

      // public function auth($email,$telefone){

      //CRIPTOGRAFAR A SENHA
      //$senha_cripto = sha1($senha);

      //VERIFICAR SE TEM ESTE condutor esta castrano  CADASTRADO
      $sql = "SELECT * FROM condutor WHERE CNI=?  LIMIT 1";
      $sql = DB::prepare($sql);
      $sql->execute(array($cni));
      $usuario = $sql->fetch(PDO::FETCH_ASSOC);
      if (!$usuario){//se nao existir o usuario 
          
          
      $sql=$pdo->prepare("INSERT INTO condutor VALUES(null,?,?,?,?,?,?)");//vai inserir dados na tabela
      $sql->execute(array($nome,$morada,$idade,$telefone,$cni,$data));//para executar parametro acima
      echo "dados Inseridos na base dados com sucessos";
      header('location: caro.php'); 
  }else{
    echo "Dados já existe no banco";
  }
      }
    

      

}




    


    









?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>biblioteca</title>
    <link href="../css/codutor.css" rel="stylesheet">
    <script src="jq/jquery-3.6.0.js"></script>
    <script src="jq/jquery-3.6.0.min.js"></script>
 
</head>

<body>
    <form action="" method="post">
        <h1>Cadastrar Condutor</h1>
        
        Nome:<input type="text" name="nome" placeholder="digite nome do condutor" required>
        
      
        idade:<input type="text" name="idade" placeholder="digite idade do condutor" required>
      
        Morada:<input type="text" placeholder="Digite o tipo de utente" name="morada" required>

        Telefone:<input type="tel" name="telefone"  placeholder="Digite o Telefone" required>
      
      CNI:<input type="text" name="cni"  placeholder="Digite o cni"required>
      
        <button name="salvar" class='btn-blue'>Salvar</button>

        </form>
        

</body>
</html>