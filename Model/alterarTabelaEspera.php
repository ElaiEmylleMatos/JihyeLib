<?php

include 'connection.php';
$cod = $_REQUEST["id"];

$sql = 'SELECT * FROM espera e JOIN users u ON u.cod_users = e.cod_users JOIN livros l ON l.cod_liv = e.cod_liv WHERE e.cod_users='.$cod;
try {
  $result = $con->query($sql);
  while($row = $result->fetch_assoc()):
?>

<tr><td><?= $row['nome_liv'];?>
<br><small><?= $row['autor_liv'];?></small></td>
<td><button class='btn btn-danger btn-xs' data-id="<?php echo $row['cod_esp']; ?>" data-user='<?php echo $row['cod_users'];?>' id='cancelarEspera'><i class='fa fa-trash-o'></i> Cancelar </button></td></tr>

<?php endwhile; ?>
