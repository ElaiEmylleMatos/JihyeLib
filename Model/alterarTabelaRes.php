<?php
include 'connection.php';
$cod = $_REQUEST["id"];

$sql = 'SELECT * FROM reservas r JOIN users u ON u.cod_users = r.cod_users JOIN livros l ON l.cod_liv = r.cod_liv WHERE r.cod_users='. $cod .' ORDER BY data_res';

  $result = $con->query($sql);
  while($row = $result->fetch_assoc()):
    #codigo emp
    $de = $row['prazo_busca_res'];
    $data_e = substr($de, 8,9) ."/".substr($de, 5,2)."/".substr($de, 0,4);
    $d = (int) substr($de, 8,9) + 14;
    #fazer calculo se passar de 31 ou 30 mudar o mês
?>

    <tr><td><?= $row['nome_liv'];?>
    <br><small><?=$row['autor_liv'];?>
    </small></td><td><?= $data_e;?>
    </td><td><button class='btn btn-danger btn-xs' data-user='<?= $row["cod_users"]; ?>' data-id='<?= $row["cod_res"]; ?>' id='cancelarReserva'><i class='fa fa-trash-o'></i> Cancelar </button></td></tr>
<?php endwhile;?>
