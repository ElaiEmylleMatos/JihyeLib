<?php
  include 'connection.php';

  $value = $_REQUEST["id"];
  $del = "DELETE FROM reservas WHERE cod_res = $value";
  $ans = $con->query($del);

  mysqli_close($link);
?>
