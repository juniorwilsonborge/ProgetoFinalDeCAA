<?php
// Inclua a classe Fila e crie uma instância
require_once 'Fila.php';
require_once('../class/conf.php');
require_once('../autoload.php');
require_once('../class/DB.php');

//$pdo= new DB();

$login = new Login();
$login->isAuth($_SESSION['EMAIL']);


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
    <title>fila de caro</title>
    <link href="../css/veiculo.css" rel="stylesheet">
    <script src="jq/jquery-3.6.0.js"></script>
    <script src="jq/jquery-3.6.0.min.js"></script>
 
</head>

<body>
    <form action="" method="post">
        <h1>Adicionar Veiculos no estacionamento</h1>
        
       Data Entrada:<br></Entrada:br><input type="date" name="dataEntrada" placeholder="digite placa" required><br><br>

        
      

      
        hora de Saida: <br><input type="time" placeholder="Categoria do veiculo" name="dataSaida" require><br><br>
        
      
        <?php
      

      //SELECIONAR DADOS DA TABELA
      $sql = $pdo->prepare("SELECT * FROM veiculu");
      $sql->execute();
      $dados = $sql->fetchAll();
      

?>
    <?php
    //VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
 if(count($dados) > 0){

     //listar valores
     ?>
   Veiculo:<br>
    <select name="veiculo" require>
     <?php
     foreach($dados as $chave => $valor){

      
      
         echo "<option value=".$valor["id"].">".$valor["matricula"]."</option>";
    
    
       }?>
      
       </select><br><br>              
         <?php  }?>
        
    
         <?php
      

      //SELECIONAR DADOS DA TABELA
      $sql = $pdo->prepare("SELECT * FROM parking WHERE statu = 'vaga'");
      $sql->execute();
      $dados = $sql->fetchAll();
      

?>
    <?php
    //VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
 if(count($dados) > 0){

     //listar valores
     ?>
   Lugar: <br>
    <select name="parking" require>
     <?php
     foreach($dados as $chave => $valor){

      
      
         echo "<option value=".$valor["id"].">".$valor["numeroPark"]."</option>";
    
    
       }?>
      
       </select>              
         <?php  }?>
        
    
<?php
      

      //SELECIONAR DADOS DA TABELA funcionario
      $sql2 = $pdo->prepare("SELECT * FROM usuarios where email='$login->email'");
      $sql2->execute();
      $usuario = $sql2->fetchAll();
      
      

?>
       
          <?php
       //VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
    if(count($usuario) > 0){
   
        //listar valores
        ?>
        
       
        <?php
        foreach($usuario as $chave => $valor){

          $idUsuario=$valor['id'];
          // echo "<option value=".$valor["id"].">".$valor["nome"]."</option>";
       
      //  $fun=$valor["id"];
          }?>
         
                      
            <?php  }?>
            <br>
      Status:<br>

      <select name="statu" id="" require>
    <option value="in" >in</option>
    <option value="out">out</option>
    </select><br><br>
        <button name="salvar" class='btn-blue'>Salvar</button>

        </form>
        

</body>
</html>

<?php
//SELECIONAR DADOS DA TABELA
$sql = $pdo->prepare("SELECT * FROM controlo where statu='in'");
$sql->execute();
$dados = $sql->fetchAll();

$total=count($dados);
//VERIFICAR SE EXISTE O POST COM TODOS OS DADOS
if (isset($_POST['dataEntrada']) && isset($_POST['dataSaida']) &&isset($_POST['statu']) && isset($_POST['veiculo']) && isset($_POST['parking'])){
  //RECEBER VALORES VINDOS DO POST E LIMPAR
  $dataEntrada = limpaPost($_POST['dataEntrada']);
  
  $dataSaida = limpaPost($_POST['dataSaida']);
 $parking=limpaPost($_POST['parking']);
  $veiculo = limpaPost($_POST['veiculo']);
  $data= date('d-m-Y');

$statu=limpaPost($_POST['statu']);
  $sql = $pdo->prepare("SELECT * FROM controlo");
      $sql->execute();
      $dados = $sql->fetchAll();

    $posicao=count($dados) + 1;
  //instanciar fila 
  $estacionamento = new Fila();
  //instanciar veiculo
  $veiculo = new Veiculo($matricula, $categoria);

    //txupetar veiculo na fila
  $estacionamento->enfileirar($veiculo);
  // Imprimir a fila
  $estacionamento->imprimirFila();


//     //VERIFICAR SE VALORES VINDOS DO POST NÃO ESTÃO VAZIOS

  if(empty($dataEntrada) or empty($dataSaida) or empty($veiculo)){
      echo "os dados tem que ser prencido obrigatorio";

  }else{

   if ($total >= 10) {
    # code...
    $sql = "UPDATE parking SET statu = 'ocupado' WHERE numeroPark = $parking";
$sql = DB::prepare($sql);

$sql->execute(array());


  
        
        
    $sql=$pdo->prepare("INSERT INTO controlo VALUES(null,?,?,?,?,?,?,?)");//vai inserir dados na tabela
    $sql->execute(array($dataEntrada,$dataSaida,$parking,$idUsuario,$veiculo,$posicao,$statu));//para executar parametro acima
    echo "dados Inseridos na base dados com sucessos";
    header('location: caro.php'); 
   }else {
    //<script></script>
    echo "Estacionamento cheio";
   }
   
   // Atualizar o status do espaço de estacionamento para 'ocupado'

}
    
}
  

    


?>