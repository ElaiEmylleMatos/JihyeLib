<?php

/**
 * @author Emylle Matos
 */
abstract class Conexao
{
  protected $con;

  function __construct()
  {
    $servidor = "localhost";
    $user = "emylle";
    $senha = "nct2016#127udream";
    $banco = "test";

    $this->con = mysqli_connect($servidor,$user,$senha,$banco);
    $this->con->query("SET NAMES 'utf8'");
    $this->con->query("SET character_set_connection=utf8");
    $this->con->query("SET character_set_client=utf8");
    $this->con->query("SET character_set_results=utf8");

    if (!$this->con) {
      echo "Erro ao conectar ao banco de dados!<br>" . $this->con->connect_error;
      exit();
    }
  }
}

?>
