<?php
    $server='localhost';
    $user='root';
    $password="";
    $database='natsave';

    // Criar conexão
    $conn=mysqli_connect($server, $user, $password, $database);
    
    //teste de conexão
    if(!$conn) {
        die('Conexão falhou: '.mysqli_connect_error());
    }
    else {
        //correção de acentuação
        mysqli_query( $conn, "SET NAMES 'utf8'" );
        mysqli_query( $conn, 'SET character_set_connection=utf8' );
        mysqli_query( $conn, 'SET character_set_client=utf8' );
        mysqli_query( $conn, 'SET character_set_results=utf8' ); 
    }
