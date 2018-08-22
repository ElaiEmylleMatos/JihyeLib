<?php
  include 'connection.php';

  $value = $_REQUEST["id"];
  $del = "DELETE FROM espera WHERE cod_esp = $value";
  $ans = $con->query($del);

  mysqli_close($link);
?>
