<?php
  include "Livro.php";

  $livro = new Livro();

  $livro->setNomeLivro($_POST['nome']);
  $livro->setAnoLivro($_POST['ano']);
  $livro->setAutorLivro($_POST['autor']);

  $livro->inserirLivro();


?>
