<?php

if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
    $usuario=$_POST['usuario'];
    $senha=$_POST['senha'];
}
else {
    echo ("<script> alert('Usuário ou senha incorretos!');
        window.location.href='login.html'; </script>");
}

$sql="SELECT * FROM tbl_usuario WHERE nome_usuario='$usuario' AND senha_usuario='$senha'";

include('conexao.php');

$resultado=mysqli_query($conn, $sql);
$linha=mysqli_fetch_array($resultado);

if (!$linha) {
    echo ("<script> alert('Usuário não cadastrado!'); window.location.href='login.html'; </script>");
}
else { 
    session_start();
    $_SESSION["usuario"]=$usuario;
    $_SESSION["id_usuario"]=$linha["0"]["id_usuario"];
    echo ("<script> alert('Registro atualizado com sucesso!'); </script>");
    header("Location: game.php");
}

mysqli_close($conn);

?>