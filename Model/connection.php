<?php

/**
 * @author Emylle Matos
 */

    $servidor = "localhost";
    $user = "emylle";
    $senha = "nct2016#127udream";
    $banco = "test";


    $con = mysqli_connect($servidor,$user,$senha,$banco);
    $con->query("SET NAMES 'utf8'");
    $con->query("SET character_set_connection=utf8");
    $con->query("SET character_set_client=utf8");
    $con->query("SET character_set_results=utf8");

    if (!$con) {
      echo "Erro ao conectar ao banco de dados!<br>" . $con->connect_error;
      exit();
    }


?>
