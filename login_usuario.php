<?php
session_start();

include('conexao.php');

if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    
// Evita SQL Injection usando prepared statements
    $sql = "SELECT id_usuario, nome_usuario, senha_usuario FROM tbl_usuario WHERE nome_usuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $linha = mysqli_fetch_assoc($resultado);

    // Verifica se o usuário existe e se a senha está correta
    if ($linha && password_verify($senha, $linha['senha_usuario'])) {
        $_SESSION["usuario"] = $linha['nome_usuario'];
        $_SESSION["id_usuario"] = $linha['id_usuario'];
        
        echo ("<script> alert('Login realizado com sucesso!'); window.location.href='game.php'; </script>");
    } else {
        echo ("<script> alert('Usuário ou senha incorretos!'); window.location.href='login.html'; </script>");
    }
} else {
    echo ("<script> alert('Preencha todos os campos!'); window.location.href='login.html'; </script>");
}

mysqli_close($conn);
?>
