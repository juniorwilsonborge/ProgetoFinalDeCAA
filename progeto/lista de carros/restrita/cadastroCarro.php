<?php
// Inclua a classe Fila e crie uma instância
//require_once 'Fila.php';
require_once('../class/conf.php');
require_once('../autoload.php');
require_once('../class/DB.php');

//$pdo= new DB();


//configuraçao geral
$servidor="localhost";
$usuario="root";
$senha="";
$banco="sgcarro";

//conexao
$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
// //class veiculo
// class Veiculo {
//   private $modelo;
//   private $placa;


//   public function __construct($modelo, $placa) {
//     $this->modelo = $modelo;
//     $this->placa = $placa;
//   }

//   public function getModelo() {
//     return $this->modelo;
//   }

//   public function setModelo($modelo) {
//     $this->modelo=$modelo;
//   }

//   public function getPlaca() {
//     return $this->placa;
//   }

//   public function __toString() {
//     return $this->modelo . " (" . $this->placa . ")";
//   }
// }




    
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>biblioteca</title>
    <link href="../css/veiculo.css" rel="stylesheet">
    <script src="jq/jquery-3.6.0.js"></script>
    <script src="jq/jquery-3.6.0.min.js"></script>
 
</head>

<body>
    <form action="" method="post">
        <h1>Cadastrar Veiculos</h1>
        
       <br><input type="text" name="matricula" placeholder="digite placa" required>
        
      

      
        categoria:<input type="text" placeholder="Categoria do veiculo" name="categoria" require>
      
        <?php
      

      //SELECIONAR DADOS DA TABELA
      $sql = $pdo->prepare("SELECT * FROM condutor");
      $sql->execute();
      $dados = $sql->fetchAll();
      

?>
    <?php
    //VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
 if(count($dados) > 0){

     //listar valores
     ?>
   condutor:
    <select name="idCondutor" require>
     <?php
     foreach($dados as $chave => $valor){

      
      
         echo "<option value=".$valor["idCondutor"].">".$valor["nome"]."</option>";
    
    
       }?>
      
       </select>              
         <?php  }?>
        
    
    condutor:<input type="text" name="codutor"  placeholder="Digite o nome do condutor"require>
      
        <button name="salvar" class='btn-blue'>Salvar</button>

        </form>
        

</body>
</html>

<?php

//VERIFICAR SE EXISTE O POST COM TODOS OS DADOS
if (isset($_POST['matricula']) && isset($_POST['categoria']) && isset($_POST['idCondutor'])){
  //RECEBER VALORES VINDOS DO POST E LIMPAR
  $matricula = limpaPost($_POST['matricula']);
  
  $categoria = limpaPost($_POST['categoria']);
 
  $condutor = limpaPost($_POST['idCondutor']);
  $data= date('d-m-Y');


  // //instanciar fila 
  // $estacionamento = new Fila();
  // //instanciar veiculo
  // $veiculo = new Veiculo($matricula, $categoria);

  //   //txupetar veiculo na fila
  // $estacionamento->enfileirar($veiculo);
  // // Imprimir a fila
  // $estacionamento->imprimirFila();


//     //VERIFICAR SE VALORES VINDOS DO POST NÃO ESTÃO VAZIOS

  if(empty($matricula) or empty($categoria) or empty($condutor)){
      echo "os dados tem que ser prencido obrigatorio";

  }else{

    //public function validar_cadastro(){

    //VALIDAÇÃO DO NOME
    if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/",$categoria)) {
      //$this->erro["erro_nome"] = "Por favor informe um nome válido!";
      echo "Nome Invalido";
   }
    //VALIDAÇÃO DO NOME
    if (!preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/",$marca)) {
      //$this->erro["erro_nome"] = "Por favor informe um nome válido!";
      echo "Nome Invalido";
   }

 
    // public function auth($email,$telefone){

    //CRIPTOGRAFAR A SENHA
    //$senha_cripto = sha1($senha);

    //VERIFICAR SE o veiculo nao foi cadastrado uma vez
    $sql = "SELECT * FROM veiculu WHERE matricula=?  LIMIT 1";
    $sql = DB::prepare($sql);
    $sql->execute(array($matricula));
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    if (!$usuario){//se nao existir o veiculo com mesmo matricula faz cadastro
        
        
    $sql=$pdo->prepare("INSERT INTO veiculu VALUES(null,?,?,?,?)");//vai inserir dados na tabela
    $sql->execute(array($matricula,$categoria,$condutor,$data));//para executar parametro acima
    echo "dados Inseridos na base dados com sucessos";
    header('location: caro.php'); 
}else{
  echo "Dados já existe no banco";
}
    
}
  

    

}
?>