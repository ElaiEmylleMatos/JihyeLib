<?php
  include '../Model/conexao.php';
  //include '../View/cadastroLivro.php';
  include '../Model/Livro.php';

class manterLivro extends Livro{

   $livro = new Livro();

  public function inserirLivro(){
    $stmt = $con->prepare("INSERT INTO livros (nome_liv,ano_liv,autor_liv, cod_liv) VALUES (?,?,?,NULL)");
    $stmt->bind_param("sis", $nome2, $ano2, $autor2);
    $nome2 = $livro->nome;
    $ano2 = $livro->ano;
    $autor2 = $livro->autor;

    $stmt->execute();
    $stmt->close();
  }
  public function editarLivro($cod){
    $stmt = $con->prepare("UPDATE livros SET nome_liv = ?,ano_liv = ?,autor_liv = ? WHERE cod_liv = $cod");
    $stmt->bind_param("sisi", $nome2, $ano2, $autor2);
    $nome2 = $livro->nome;
    $ano2 = $livro->ano;
    $autor2 = $livro->autor;

    $stmt->execute();
    $stmt->close();
  }
  public function excluirLivro($cod){
    $sql = "DELETE FROM livros WHERE cod_liv = $cod";
    $con->query($sql);
  }
  //$con->close();
}
?>
