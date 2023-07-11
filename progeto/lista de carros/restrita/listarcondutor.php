
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
  <h1>Listas de condutores</h1> 

  
  <form method="post" action="">
      <!-- <input type="search" name="pesquisar" width="10"> -->
      <div class="searchbar2">
				<input type="text"
					name="pesquisar"
					id=""
					placeholder="Search">
				<div class="searchbtn">
			
	
				</div>

      <button type="submit" class="button" >Pesquisar</button>
    </form>

</body>
</html>


<?php
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
if(isset($_POST['pesquisar'])){
    $pesquisa = limparEntrada($_POST['pesquisar']);
    if($pesquisa=="" || $pesquisa==null){
     
     
  }else{
      
      $query = $pdo->query("SELECT * FROM condutor WHERE nome LIKE '$pesquisa%'");
      $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
    
     
         //VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
    if(count($resultados) > 0){
        //CONSTROI PARTE DE CIMA DA TABELA
        echo "<br><br><table>
        <tr>
           
           
           
            <th>Nome condutor</th>
            <th>Morada</th>
            <th>idade</th>
            <th>telefone</th>
           
           
          
            <th>CNI</th>
            <th>Data</th>
        
            
        </tr>";

        //LAÇO DE REPETIÇÃO PARA ADICIONAR LINHA
        foreach($resultados as $chave => $valor){
            echo " <tr>
                        
                  
                        <td>".$valor['nome']."</td>
                        <td>".$valor['morada']."</td>
                        <td>".$valor['idade']."</td>
                        <td>".$valor['telefone']."</td>
                        <td>".$valor['CNI']."</td>
                        <td>".$valor['data']."</td>
                      
                       
                        <td> <button class='btn-blue' id='".$valor['idCondutor']."' name='apagar'>Apagar</button></td>
                          
               </tr>";
            }
        }else{
           //CASO NÃO TENHA NENHUM DADO ADICIONADO
        echo "<p>Nenhum obra pesquisado</p>";
        }
      
      
      
      }
        //FECHA TABELA
        echo "</table>";
   }else{

        //SELECIONAR DADOS DA TABELA obra
        $sql = $pdo->prepare("SELECT * FROM condutor");
        $sql->execute();
        $dados = $sql->fetchAll();
        

        //EXEMPLO COM FILTRAGEM
        /*
         $sql = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
         $email = 'teste2@gmail.com';
         $sql->execute(array($email));
         $dados = $sql->fetchAll();
        */
        
        /*
        echo "<pre>";
        print_r($dados);
        echo "</pre>";
        */

         //VERIFICAR SE TEM DADOS (ARRAY DADOS MAIOR QUE ZERO)
    if(count($dados) > 0){
        //CONSTROI PARTE DE CIMA DA TABELA
        echo "<br><br><table>
        <tr>
           
           
           
            <th>Nome condutor</th>
            <th>Morada</th>
            <th>idade</th>
            <th>telefone</th>
           
           
          
            <th>CNI</th>
            <th>Data</th>
        
            
        </tr>";

        //LAÇO DE REPETIÇÃO PARA ADICIONAR LINHA
        foreach($dados as $chave => $valor){
            echo " <tr>
                        
                  
                        <td>".$valor['nome']."</td>
                        <td>".$valor['morada']."</td>
                        <td>".$valor['idade']."</td>
                        <td>".$valor['telefone']."</td>
                        <td>".$valor['CNI']."</td>
                        <td>".$valor['data']."</td>
                      
                       
                        <td> <button class='btn-blue' id='".$valor['idCondutor']."' name='apagar'>Apagar</button></td>
                          
               </tr>";
        }

        //FECHA TABELA
        echo "</table>";
    }else{
        //CASO NÃO TENHA NENHUM DADO ADICIONADO
        echo "<p>Nenhum utente cadastrado</p>";
    }
  }

    ?>
