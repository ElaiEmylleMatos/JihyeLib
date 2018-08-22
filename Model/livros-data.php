<?php
  include 'connection.php';

      $sql = "SELECT * FROM livros";
      $result = $con->query($sql);
      while ($row = $result->fetch_assoc()):

      echo '<div class="col-md-55">
        <div class="thumbnail">
          <div class="image view view-first">
            <img style="width: 100%; display: block;" id="modal" data-toggle="modal" data-target="#detalhes" data-id="'.$row["cod_liv"].'" src="../'.$row['capa_liv'].'" alt="image" />
          </div>
          <div class="caption" id="modal" data-toggle="modal" data-target="#detalhes" data-id="'.$row["cod_liv"].'">
            <p><strong>'.$row['nome_liv'].'</strong>
            </p>
            <p>'.$row['autor_liv'].'</p>
          </div>';

          if ($row['quant_liv']==0) {
            echo "<button class='btn btn-info'><i class='fa fa-add'></i>Lista de Espera</button>";
          } else {
            echo "<button class='btn btn-success'>Reservar</button>";
          }


        echo '</div>
      </div>';
      endwhile;



?>
