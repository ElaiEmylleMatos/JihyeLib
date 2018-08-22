<?php
  include_once 'Usuarios.php';

  $user = new Usuarios();

  while ($user->emprestimosUsuario(1)) {
    $de = $row['data_emp'];
    $data_e = substr($de, 8,9) ."/".substr($de, 5,2)."/".substr($de, 0,4);
    #se for professor 14 dias, se for est, 7
    $d = (int) substr($de, 8,9) + 14;
    #fazer calculo se passar de 31 ou 30 mudar o mês
    $data_d = $d ."/".substr($de, 5,2)."/".substr($de, 0,4);
    echo "<tr><td>". $row['nome_liv'];
    echo "<br><small>".$row['autor_liv'];
    echo "</small></td><td>". $data_e;
    echo "</td><td>". $data_d;
    echo "</td></tr>";

  }

?>
