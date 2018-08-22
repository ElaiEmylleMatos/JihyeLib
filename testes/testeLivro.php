<?php
include 'conexao.php';
include "Livro.php";

$livro = new Livro();
$livro->nome = "Cidade dos Ossos";
$livro->ano = 2006;

echo "<br/>Nome do livro: ".$livro->nome;
echo "<br/>Ano: ".$livro->ano;

$sql = "SELECT * FROM livros";
$result = $con->query($sql);

echo "<br><br>CHAIN BRRRRRRRAH REACTION<br><br>";

?>
<table>
  <thead>
    <th>Nome</th>
    <th>Autor</th>
    <th>Ano</th>
  </thead>
  <tbody>
    <?php
      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['nome_liv']."</td>";
        echo "<td>".$row['autor_liv']."</td>";
        echo "<td>".$row['ano_liv']."</td>";
        echo "</tr>";
      }

      $con->close();
    ?>
  </tbody>
</table>
