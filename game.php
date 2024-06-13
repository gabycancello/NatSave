<?php
	include("protecao.php");
	protecao();	
	$usuario=$_SESSION["usuario"];
	$id_usuario=$_SESSION["id_usuario"];
	if (isset($_GET['Missao'])){
		$id_missao= $_GET['Missao'];
		$sql="INSERT INTO usuar_desafio (id_usuario, id_desafio) VALUES ($id_usuario, $id_missao)";

		include('conexao.php');

		mysqli_query($conn, $sql);
		
		mysqli_close($conn);

	} 
	

?>

<!DOCTYPE HTML>
<html>

<head>
	<title>NatSave</title>
	<link rel="icon" href="images/logo.png">
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
</head>

<body id="game" class="is-preload">

	<!-- Header -->
	<header style="height: 100px;" id="header">
		<a href="index.html" class="title">
		<img style="width: 60px;" src="images/logo.png" alt="Logo com nome"></a>
		<nav>
			<ul>
				<li> <i class="fas fa-user-circle"></i> <?php echo $usuario?> </li>
				<li><a href="logout.php">Sair</a></li>
			</ul>
		</nav>

		<nav>
			<ul>
				<li><a href="game.php" class="active">Na'tividade</a></li>
				<li><a href="ranking.php">Ranking</a></li>
				<li><a href="premio.php">Prêmios</a></li>
			</ul>
		</nav>
	</header><br><br><br><br>

	<div vw class="enabled">
		<div vw-access-button class="active"></div>
		<div vw-plugin-wrapper>
			<div class="vw-plugin-top-wrapper"></div>
		</div>
	</div>
	<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
	<script>
		new window.VLibras.Widget('https://vlibras.gov.br/app');
	</script>


		<!-- Main -->
		<section id="main" class="wrapper">
			<div class="inner">
				<h1 id="natividade" class="major">Na'tividade!</h1>
			</div>
		</section>

		<section id="main" class="wrapper game-menu row gtr-uniform">

			<?php

			$sql="SELECT * FROM tbl_desafio ORDER BY id_desafio ASC";

			include('conexao.php');

			$resultado=mysqli_query($conn, $sql);
			while ($registro=mysqli_fetch_array($resultado))
				{
			?>

			<section id="game" class="card-game">
				<form method="POST" action="login_usuario.php">

						<div class="game-align">
							<img class="game-image" src="<?php echo($registro["figura"]);?>" alt="">
							<h3>Missão <?php echo($registro["id_desafio"]);?></h3>
						</div>

						<p class="psn"><?php echo($registro["enun_desafio"]); ?></p>
						<p class="psn">Pontos: <?php echo($registro["pontos"]); ?> NatCoins</p>
						<ul class="actions">
							<li>
								<?php 
									$id_desafio=$registro['id_desafio'];

									$sql="SELECT id_desafio FROM usuar_desafio WHERE id_usuario=$id_usuario and id_desafio=$id_desafio"; 

									$verificar_missao=mysqli_query($conn, $sql);
									$missao_ok=mysqli_fetch_object($verificar_missao);
								
									if ($missao_ok== NULL){
										?>
										<a id="btngame" href="?Missao=<?php echo($registro["id_desafio"]);?>" class="button scrolly game-btn">Concluir</a>
										<?php
									}
									else {
										?>
										<a id="btngame" class="button scrolly game-btn" disabled="disabled" style="color= #fff;">Finalizada!</a>
										<?php
									}

								?>
							</li>
						</ul>
				</form>
			</section>


			<?php
                    }
                    mysqli_close($conn);
                ?>

		</section>



	<!-- Footer -->
	<footer id="footer" class="wrapper style1-alt">
		<hr>
		<div class="inner">
			<ul class="menu">
				<li>&copy; NatSave. Todos os direitos reservados.</li>
				<li>Design: Equipe de Design NatSave</li>
			</ul>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>