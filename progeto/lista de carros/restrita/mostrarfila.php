
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>biblioteca</title>
    <link href="../css/listarcondutor.css" rel="stylesheet">
    <script src="jq/jquery-3.6.0.js"></script>
    <script src="jq/jquery-3.6.0.min.js"></script>
    <style>
        table{
            border-collapse: collapse;
            width:100%;
        }
        th,td{
            padding:10px;
            text-align:center;
            border:1px solid #ccc;
        }
        p{
            padding:20px;
            border:1px solid #ccc;
        }
    </style>   
</head>
</head>
<body>
  <h1>Listas saidas de carros</h1> 

  
  <form method="" action="">
      <!-- <input type="search" name="pesquisar" width="10"> -->
      <div class="searchbar2">
				<input type="text"
					name="pesquisar"
					id=""
					placeholder="Search">
				<div class="searchbtn">
			
	
				</div>

     
    </form>

</body>
</html>


<?php

require_once('../class/conf.php');
require_once('../autoload.php');


//configuraçao geral
$servidor="localhost";
$usuario="root";
$senha="";
$banco="sgcarro";

//conexao
$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

   //funcao para limpar entrada de dados como espaços baras e caracteres especial
   function limparEntrada($dado){
    $dado=trim($dado);
    $dado=stripslashes($dado);
    $dado=htmlspecialchars($dado);
    return $dado;

   } 

  

//verifica se a pesquisa foi realizada e recebe o termo pesquisado

    
     
     
  
      
      $query = $pdo->query("SELECT c.idControlo, c.data_inicio, c.posicao, c.data_saida,c.statu,v.matricula FROM controlo c
      JOIN veiculu v ON c.idControlo= v.id where c.statu='in'");
      $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
    
     
         //VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
    if(count($resultados) > 0){
        //CONSTROI PARTE DE CIMA DA TABELA
        echo "<br><br><table>
        <tr>
           
           
           
            <th>Data_inicio</th>
            <th>Data_saida</th>
            <th>statu</th>
            <th>Matricula</th>
            <th>posicão</th>
           
          
            
        
            
        </tr>";

        //LAÇO DE REPETIÇÃO PARA ADICIONAR LINHA
        foreach($resultados as $chave => $valor){
            echo " <tr>
                        
                  
                        <td>".$valor['data_inicio']."</td>
                        <td>".$valor['data_saida']."</td>
                        <td>".$valor['statu']."</td>
                        <td>".$valor['matricula']."</td>
                        <td>".$valor['posicao']."</td>
                        
                      
                       
                        <td> <button class='btn-blue' id='".$valor['idControlo']."' name='editar'>saiu</button></td>
                          
               </tr>";

if (isset($_POST['editar'])) {
    $id=$valor['idControlo'];

       // Atualizar o status do espaço de estacionamento para 'reservado'
$sql = "UPDATE controlo SET statu = 'out' WHERE idControlo = '$id'";
$sql = DB::prepare($sql);

$sql->execute(array());
header('location: caro.php'); 
// $sql->execute(array());
// $sql->execute();

    # code...
}

            }
        }else{
           //CASO NÃO TENHA NENHUM DADO ADICIONADO
        echo "<p>Nenhum obra pesquisado</p>";
        }
      
      
      
      
        //FECHA TABELA
        echo "</table>";
   
    ?>
