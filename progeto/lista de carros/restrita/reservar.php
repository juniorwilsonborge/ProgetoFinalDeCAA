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

// Verificar se o formulário foi enviado
if (isset($_POST['numero']) && isset($_POST['statu']) && isset($_POST['reserva']) ) {
  // Processar os dados do formulário de reserva

  // Validar os campos do formulário (data, hora, etc.)

  $numero = $_POST['numero'];
  $statu = $_POST['statu'];


  // Verificar a disponibilidade do espaço de estacionamento
//   $sql = "SELECT * FROM espacos_estacionamento WHERE statu = 'vaga' LIMIT 1";
//   $result = $conn->query($sql);

//   if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $espaco_id = $row['id'];

//     // Salvar a reserva no banco de dados
//     $user_id = $_SESSION['user_id'];
//     $sql = "INSERT INTO reservas (usuario_id, espaco_id, data, hora) VALUES ($user_id, $espaco_id, '$data', '$hora')";
//     $conn->query($sql);

    // Atualizar o status do espaço de estacionamento para 'reservado'
//     $sql = "UPDATE espacos_estacionamento SET status = 'reservado' WHERE id = $espaco_id";
//     $conn->query($sql);

//     // Redirecionar para a página de sucesso
//     header('Location: caro.php');
//     exit();
//   } else {
//     // Não há espaços de estacionamento disponíveis
//     $mensagem_erro = 'Não há espaços de estacionamento disponíveis no momento.';


if(empty($numero) or empty($statu)){
    echo "os dados tem que ser prencido obrigatorio";

}else{

//VERIFICAR SE o parck nao foi cadastrado uma vez
$sql = "SELECT * FROM parking WHERE numeroPark=?  LIMIT 1";
$sql = DB::prepare($sql);
$sql->execute(array($numero));
$usuario = $sql->fetch(PDO::FETCH_ASSOC);
if (!$usuario) {
    # code...

      
  $sql=$pdo->prepare("INSERT INTO parking VALUES(null,?,?)");//vai inserir dados na tabela
  $sql->execute(array($numero,$statu));//para executar parametro acima
  echo "dados Inseridos na base dados com sucessos";
  header('location: caro.php'); 


}else{
echo "Dados já existe no banco";
}


}
}

?>
   
    <!-- Outros campos do formulário -->
  
    <h3> <a href="editar.php">Editar</a></h3>
  </form>
</body>
</html>
<?php    




      
        
    # code...


  

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
   
  
    <select name="numero" id="" require>
    <option value="1" >1</option>
    <option value="2">2</option>
    <option value="3" >3</option>
    <option value="4" >4</option>
    <option value="5" >5</option>
    <option value="6" >6</option>
    <option value="7" >7</option>
    <option value="8" >8</option>
    <option value="9" >9</option>
    <option value="10" >10</option>
    <option value="11" >11</option>
    <option value="12" >12</option>
    <option value="13" >13</option>
    <option value="14" >14</option>
    <option value="15" >15</option>
  

    </select>

    <select name="statu" id="" require>
    <option value="vaga" >vaga</option>
    <option value="ocupado">ocupado</option>
    </select>
    <!-- Outros campos do formulário -->
    <button type="submit" name="reserva">salvar</button>
   
  </form>
</body>
</html>
