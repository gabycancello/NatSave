<?php  
include("protecao.php");
protecao();
$usuario=$_SESSION["usuario"];

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
				<li><a href="game.php">Na'tividade</a></li>
				<li><a href="ranking.php">Ranking</a></li>
				<li><a href="premio.html" class="active">Prêmios</a></li>
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
				<h1 id="natividade" class="major">Prêmios</h1>
			</div>
		</section>

		<section id="main" class="wrapper game-menu row gtr-uniform">

			<?php

			$sql="SELECT * FROM tbl_premio";

			include('conexao.php');

			$resultado=mysqli_query($conn, $sql);
			while ($registro=mysqli_fetch_array($resultado))
				{
			?>

			<section style="height: 480px;" id="game" class="card-game">
				<form method="POST" action="login_usuario.php">  

					<img src="<?php echo($registro["figura_premio"]);?>" alt="">

					<p class="psn"><?php echo($registro["enun_premio"]);?></p>

					<p class="psn">Valor: <?php echo($registro["valor"]);?> NatCoins</p>

					<ul class="actions">
						<li>
							<a id="btngame" href="#" class="button scrolly game-btn">Resgatar</a>	
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