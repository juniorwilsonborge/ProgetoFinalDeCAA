<?php
require_once('../class/conf.php');
require_once('../autoload.php');

$login = new Login();
$login->isAuth($_SESSION['EMAIL']);

$pdo= new DB();
//SELECIONAR DADOS DA TABELA
$sql = $pdo->prepare("SELECT * FROM controlo where statu='in'");
$sql->execute();
$dados = $sql->fetchAll();

$total=count($dados);
//echo "<h1>Bem-vindo $login->nome!<br>Email: $login->email";


$sql = $pdo->prepare("SELECT * FROM controlo where statu='out'");
$sql->execute();
$dados2 = $sql->fetchAll();
$total2=count($dados2);


//pegar dados de espacos quantas parckes estao vazia e ocupadas
$sql = "SELECT * FROM parking WHERE statu='vaga'";
$sql = DB::prepare($sql);
$sql->execute(array());
$dados4 = $sql->fetchAll();
$vaga=count($dados4);
//pegar dados de espacos quantas parckes estao vazia e ocupadas
$sql = "SELECT * FROM controlo WHERE statu='out'";
$sql = DB::prepare($sql);
$sql->execute(array());
$dados3 = $sql->fetchAll();
$ocupado=count($dados3);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible"
		content="IE=edge">
	<meta name="viewport"
		content="width=device-width,
				initial-scale=1.0">
	<title>Terminal Assomada</title>
	<link rel="stylesheet"
		href="../css/estilo.css">
	<link rel="stylesheet"
		href="../css/estilo3.css">
</head>

<body>

	<!-- for header part -->
	<header>

		<div class="logosec">
			<div class="logo">Controlo de carro no terminal</div>
			<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
				class="icn menuicn"
				id="menuicn"
				alt="menu-icon">
		</div>

		<div class="searchbar">
			<input type="text"
				placeholder="Search">
			<div class="searchbtn">
			<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
					class="icn srchicn"
					alt="search-icon">
			</div>
		</div>
		<?php
echo "<h4>Bem-vindo $login->email </h4> ";
?>
	<p>&copy; <?php echo date("Y"); ?> </p>
		<div class="message">
			<div class="circle"></div>
			<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png"
				class="icn"
				alt="">
			<div class="dp">
			<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
					class="dpicn"
					alt="dp">
			</div>
		</div>

	</header>

	<div class="main-container">
		<div class="navcontainer">
			<nav class="nav">
				<div class="nav-upper-options">
					<div class="nav-option option1">
						<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png"
							class="nav-img"
							alt="dashboard">
						<h3>home</h3>
					</div>

					<div class="option2 nav-option">
						<a href="controlo.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png"
							class="nav-img"
							alt="articles"></a>
						<h3>Fila de carro</h3>
					</div>

					<div class="nav-option option3">
						<a href="listarSaida.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/5.png"
							class="nav-img"
							alt="report"></a>
						<h3> Saidas</h3>
					</div>

					<div class="nav-option option4">
						<a href="mostrarfila.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png"
							class="nav-img"
							alt="institution"></a>
						<h3> Terminal</h3>
					</div>

					<div class="nav-option option5">
						
							<a href="cadastroCarro.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
							class="nav-img"
							alt="blog"></a>
						<h3>registrar carro</h3>
					</div>
					
					<div class="nav-option option5">
						
							<a href="condutor.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
							class="nav-img"
							alt="blog"></a>
						<h3>registrar condutor</h3>
					</div>

					<div class="nav-option option5">
						
							<a href="controlo.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
							class="nav-img"
							alt="blog"></a>
						<h3> Estacionamento</h3>
					</div>
					<div class="nav-option option5">
						
							<a href="listarcondutor.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
							class="nav-img"
							alt="blog"></a>
						<h3> listar condutor</h3>
					</div>

					<div class="nav-option option6">
						
							<a href="reservar.php"><img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
							class="nav-img"
							alt="settings"></a>
							<h3>reserva</h3>
					</div>

					<div class="nav-option logout">
						<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png"
							class="nav-img"
							alt="logout">
						<h3>sair</h3>
					</div>

				</div>
			</nav>
		</div>
		<div class="main">
	
			<div class="searchbar2">
				<input type="text"
					name=""
					id=""
					placeholder="Search">
				<div class="searchbtn">
				<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
						class="icn srchicn"
						alt="search-button">
	
				</div>

			</div>
	
			<div class="box-container">

				<div class="box box1">
					<div class="text">
						<h2 class="topic-heading"><?php  echo $total;  ?>  </h2>
						<h2 class="topic">total de carro na bicha</h2>
					</div>

					<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(31).png"
						alt="Views">
				</div>

				<div class="box box2">
					<div class="text">
						<h2 class="topic-heading"><?php  echo $vaga=10-$total;  ?> </h2>
						<h2 class="topic">Vagas de estacionar</h2>
					</div>

					<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210185030/14.png"
						alt="likes">
				</div>

				<div class="box box3">
					<div class="text">
						<h2 class="topic-heading"><?php  echo $ocupado;  ?> </h2>
						<h2 class="topic"> vagas ocupadas </h2>
					</div>

					<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210184645/Untitled-design-(32).png"
						alt="comments">
				</div>

				<div class="box box4">
					<div class="text">
						<h2 class="topic-heading"><?php  echo $total2;  ?></h2>
						<h2 class="topic">Saidas</h2>
					</div>

					<img src=
"https://media.geeksforgeeks.org/wp-content/uploads/20221210185029/13.png" alt="published">
				</div>
			</div>

			<div class="report-container">
				<div class="report-header">
					<h1 class="recent-Articles">Recentes Saidas</h1>
					<button class="view">23</button>
				</div>

				<div class="report-body">
					<div class="report-topic-heading">
						<h3 class="t-op">Matricula</h3>
						<h3 class="t-op">Destino</h3>
						<h3 class="t-op">Nº Passagero</h3>
						<h3 class="t-op">Condutor</h3>
					</div>

					<div class="items">
						<div class="item1">
							<h3 class="t-op-nextlvl">st-91-ux</h3>
							<h3 class="t-op-nextlvl">Praia</h3>
							<h3 class="t-op-nextlvl">15</h3>
							<h3 class="t-op-nextlvl label-tag">Penha</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 72</h3>
							<h3 class="t-op-nextlvl">1.5k</h3>
							<h3 class="t-op-nextlvl">360</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 71</h3>
							<h3 class="t-op-nextlvl">1.1k</h3>
							<h3 class="t-op-nextlvl">150</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 70</h3>
							<h3 class="t-op-nextlvl">1.2k</h3>
							<h3 class="t-op-nextlvl">420</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 69</h3>
							<h3 class="t-op-nextlvl">2.6k</h3>
							<h3 class="t-op-nextlvl">190</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 68</h3>
							<h3 class="t-op-nextlvl">1.9k</h3>
							<h3 class="t-op-nextlvl">390</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 67</h3>
							<h3 class="t-op-nextlvl">1.2k</h3>
							<h3 class="t-op-nextlvl">580</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 66</h3>
							<h3 class="t-op-nextlvl">3.6k</h3>
							<h3 class="t-op-nextlvl">160</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

						<div class="item1">
							<h3 class="t-op-nextlvl">Article 65</h3>
							<h3 class="t-op-nextlvl">1.3k</h3>
							<h3 class="t-op-nextlvl">220</h3>
							<h3 class="t-op-nextlvl label-tag">Published</h3>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../javaScript/javascrip.js"></script>
</body>
</html>
