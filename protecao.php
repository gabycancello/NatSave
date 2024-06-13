<?php

if(!function_exists("protecao")){
    function protecao(){
        session_start();
        
        if(!isset($_SESSION["usuario"])){  
            header("Location: login.html");
        }
    }
}

?>