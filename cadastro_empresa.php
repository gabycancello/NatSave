<?php

    $nomeempresa=$_POST['nomeempresa'];
    $numfunvionario=$_POST['numfuncionario'];
    $cnpj=$_POST['cnpj'];
    $email=$_POST['email'];

    include('conexao.php');

    $sql="INSERT INTO tbl_empresa (nome_empresa, num_funcionarios, cnpj, email) VALUES ('$nomeempresa', $numfunvionario, '$cnpj', '$email')";

    $resultado=mysqli_query($conn,$sql) or die('falha na atualização do registro!');

    mysqli_close($conn);

    echo ("<script> alert('Registro atualizado com sucesso!'); window.location.href='cadastro-concluido.html'; </script>");

?>