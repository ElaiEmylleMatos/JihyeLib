<?php

include_once 'connection.php';

if($_REQUEST['id']) {
  $sql = "SELECT * FROM livros l JOIN genero_livros g ON g.cod_gen = l.cod_gen WHERE l.cod_liv=".$_REQUEST['id'];
  $resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
  $data = array();
  while( $row = mysqli_fetch_assoc($resultset) ) {
    $data = $row;
  }
  echo json_encode($data);
} else {
  echo 0;
}

?>
