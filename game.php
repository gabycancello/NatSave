<?php
include("protecao.php");
protecao();

$usuario = $_SESSION["usuario"];
$id_usuario = $_SESSION["id_usuario"];

include('conexao.php'); // Abre a conexão apenas uma vez

if (isset($_GET['Missao']) && is_numeric($_GET['Missao'])) {
    $id_missao = intval($_GET['Missao']); // Garante que seja um número inteiro
    
    // Verifica se a missão já foi concluída
    $sql = "SELECT COUNT(*) as total FROM usuar_desafio WHERE id_usuario = ? AND id_desafio = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_missao);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($total == 0) { // Se a missão ainda não foi concluída
        $sql = "INSERT INTO usuar_desafio (id_usuario, id_desafio) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_missao);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Missão concluída com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao concluir a missão: " . mysqli_error($conn) . "');</script>";
        }
        mysqli_stmt_close($stmt);
    }
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
        <link rel="stylesheet" href="assets/css/noscript.css" />
    </noscript>
</head>

<body id="game" class="is-preload">

    <!-- Header -->
    <header style="height: 100px;" id="header">
        <a href="index.html" class="title">
            <img style="width: 60px;" src="images/logo.png" alt="Logo com nome">
        </a>
        <nav>
            <ul>
                <li><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($usuario); ?> </li>
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

    <!-- Plugin de acessibilidade VLibras -->
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
        $sql = "SELECT * FROM tbl_desafio ORDER BY id_desafio ASC";
        $resultado = mysqli_query($conn, $sql);

        while ($registro = mysqli_fetch_assoc($resultado)) {
            $id_desafio = $registro['id_desafio'];

            // Verifica se o usuário já concluiu a missão
            $sql = "SELECT COUNT(*) as total FROM usuar_desafio WHERE id_usuario = ? AND id_desafio = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ii", $id_usuario, $id_desafio);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $total);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            $missao_concluida = ($total > 0);
        ?>
            <section id="game" class="card-game">
                <div class="game-align">
                    <img class="game-image" src="<?php echo htmlspecialchars($registro["figura"]); ?>" alt="">
                    <h3>Missão <?php echo htmlspecialchars($registro["id_desafio"]); ?></h3>
                </div>

                <p class="psn"><?php echo htmlspecialchars($registro["enun_desafio"]); ?></p>
                <p class="psn">Pontos: <?php echo htmlspecialchars($registro["pontos"]); ?> NatCoins</p>

                <ul class="actions">
                    <li>
                        <?php if (!$missao_concluida) { ?>
                            <a id="btngame" href="?Missao=<?php echo htmlspecialchars($registro["id_desafio"]); ?>" class="button scrolly game-btn">Concluir</a>
                        <?php } else { ?>
                            <a id="btngame" class="button scrolly game-btn" disabled="disabled" style="color= #fff;">Finalizada!</a>
                        <?php } ?>
                    </li>
                </ul>
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
