

<?php
require_once('../class/conf.php');
require_once('../autoload.php');

// $login = new Login();
// $login->isAuth($_SESSION['EMAIL']);

// // Verificar se o usuário está logado
// if (!isset($_SESSION['EMAIL'])) {
//   header('Location: login.php');
//   exit();
// }







//configuraçao geral
$servidor="localhost";
$usuario="root";
$senha="";
$banco="sgcarro";

//conexao
$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);
?>
<!DOCTYPE html>
<html>
<head>
<title>Reserva de Estacionamento</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h2>Reserva de Estacionamento</h2>

<?php if (isset($mensagem_erro)): ?>
<p class="erro"><?php echo $mensagem_erro; ?></p>
<?php endif; ?>

<form method="POST" >

<?php
 

 //SELECIONAR DADOS DA TABELA
 $sql = $pdo->prepare("SELECT * FROM parking");
 $sql->execute();
 $dados = $sql->fetchAll();
 

?>
<?php
//VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
if(count($dados) > 0){

//listar valores

?>
Statu:
<select name="statu1" require>
<option value="vaga" >vaga</option>
<option value="ocupado">ocupado</option>
 
  </select>              
    <?php  }?>
    
Nª Parking:    
<select name="numero1" require>
<?php
foreach($dados as $chave => $valor){

 
 
    echo "<option value=".$valor["id"].">".$valor["numeroPark"]."</option>";


  }?>
 
  </select>              
    <?php  ?> 
    
    <br><br><button type="submit" name="editar">editar</button>

</form>
</body>
</html>
   
<?php

if (isset($_POST['statu1']) && isset($_POST['numero1'])) {
# code...
$statu1=$_POST['statu1'];

$numero1 = $_POST['numero1'];


   // Atualizar o status do espaço de estacionamento para 'reservado'
$sql = "UPDATE parking SET statu = '$statu1' WHERE numeroPark = '$numero1'";
$sql = DB::prepare($sql);

$sql->execute(array());
header('location: caro.php'); 


}

?>

