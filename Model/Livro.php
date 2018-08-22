<?php
/**
 * @author Emylle Matos NCT China vai debutar
 */
include 'Conexao.php';

class Livro extends Conexao {

  private $nome;
  private $ano;
  private $autor;
  private $pags;
  private $edicao;
  private $volume;
  private $local;
  private $sinopse;
  private $capa;
  private $genero;
  private $isbn;
  private $editora;
  private $quant;

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///  MÉTODOS DE ACESSO  ///////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function setNomeLivro($n)
  {
    $this->nome = $n;
  }
  public function getNomeLivro()
  {
    return $this->nome;
  }

  public function setAnoLivro($n)
  {
    $this->ano = $n;
  }
  public function getAnoLivro()
  {
    return $this->ano;
  }

  public function setAutorLivro($n)
  {
    $this->autor = $n;
  }
  public function getAutorLivro()
  {
    return $this->autor;
  }

  public function setPagsLivro($n)
  {
    $this->pags = $n;
  }
  public function getPagsLivro()
  {
    return $this->pags;
  }

  public function setEdicaoLivro($n)
  {
    $this->edicao = $n;
  }
  public function getEdicaoLivro()
  {
    return $this->edicao;
  }

  public function setVolumeLivro($n)
  {
    $this->volume = $n;
  }
  public function getVolumeLivro()
  {
    return $this->volume;
  }

  public function setLocalLivro($n)
  {
    $this->local = $n;
  }
  public function getLocalLivro()
  {
    return $this->local;
  }

  public function setSinopseLivro($n)
  {
    $this->sinopse = $n;
  }
  public function getSinopseLivro()
  {
    return $this->sinopse;
  }

  public function setCapaLivro($n)
  {
    $this->capa = $n;
  }
  public function getCapaLivro()
  {
    return $this->capa;
  }

  public function setGeneroLivro($n)
  {
    $this->genero = $n;
  }
  public function getGeneroLivro()
  {
    return $this->genero;
  }

  public function setIsbnLivro($n)
  {
    $this->isbn = $n;
  }
  public function getIsbnLivro()
  {
    return $this->isbn;
  }

  public function setEditoraLivro($n)
  {
    $this->editora = $n;
  }
  public function getEditoraLivro()
  {
    return $this->editora;
  }

  public function setQuantLivro($n)
  {
    $this->quant = $n;
  }
  public function getQuantLivro()
  {
    return $this->quant;
  }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///  CRUD  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function selecionarLivro($cod)
  {
    if (isset($cod)) {
      $sql = "SELECT * FROM livros WHERE cod_liv = $cod";
      try {

        $result = $this->con->query($sql);

        $row = $result->fetch_assoc();
        return $row;

      } catch (Exception $e) {
        echo "Não foi possível selecionar livro.";
      }
    } else {
      echo "Não foi possível selecionar livro.";
    }
  }

  public function inserirLivro()
  {
    try {

      $stmt = $this->con->prepare("INSERT INTO livros (nome_liv,ano_liv,autor_liv,pags_liv,edicao_liv,volume_liv,local_publi_liv,sinopse_liv,capa_liv,cod_gen,isbn_liv,editora_liv,quant_liv,cod_liv) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NULL)");
      // TEM QUE VER OS FORMATOS TIPO BLOB E TEXT AQUI ABAIXO
      // DEVE HAVER ALGUM TRATAMENTO PARA O UPLOAD DE IMAGENS. NÃO VAI SER FÁCIL ASSIM
      $stmt->bind_param("sisiiissbissi",$nome2,$ano2,$autor2,$pags2,$edicao2,$volume2,$local2,$sinopse2,$capa2,$genero2,$isbn2,$editora2,$quant2);
      $nome2 = $this->nome;
      $ano2 = $this->ano;
      $autor2 = $this->autor;
      $pags2 = $this->pags;
      $edicao2 = $this->edicao;
      $volume2 = $this->volume;
      $local2 = $this->local;
      $sinopse2 = $this->sinopse;
      $capa2 = $this->capa;
      $genero2 = $this->genero;
      $isbn2 = $this->isbn;
      $editora2 = $this->editora;
      $quant2 = $this->quant;

      $stmt->execute();
      $stmt->close();

    } catch (Exception $e) {
      echo "Não foi possível inserir Livro";
    }

  }
  public function editarLivro($cod)
  {
    if (!isset($cod)) {
      try {
        $stmt = $this->con->prepare("UPDATE livros SET nome_liv = ?,ano_liv = ?,autor_liv = ?,pags_liv = ?,edicao_liv = ?,volume_liv = ?,local_publi_liv = ?,sinopse_liv = ?,capa_liv = ?,cod_gen = ?,isbn_liv = ?,editora_liv = ?,quant_liv = ? WHERE cod_liv = $cod");
        // TEM QUE VER OS FORMATOS TIPO BLOB E TEXT AQUI ABAIXO
        // DEVE HAVER ALGUM TRATAMENTO PARA O UPLOAD DE IMAGENS. NÃO VAI SER FÁCIL ASSIM
        $stmt->bind_param("sisiiissbissi",$nome2,$ano2,$autor2,$pags2,$edicao2,$volume2,$local2,$sinopse2,$capa2,$genero2,$isbn2,$editora2,$quant2);
        $nome2 = $this->nome;
        $ano2 = $this->ano;
        $autor2 = $this->autor;
        $pags2 = $this->pags;
        $edicao2 = $this->edicao;
        $volume2 = $this->volume;
        $local2 = $this->local;
        $sinopse2 = $this->sinopse;
        $capa2 = $this->capa;
        $genero2 = $this->genero;
        $isbn2 = $this->isbn;
        $editora2 = $this->editora;
        $quant2 = $this->quant;

        $stmt->execute();
        $stmt->close();
      } catch (Exception $e) {
        echo "Não foi possível editar o livro. Por favor tente novamente.";
      }
    }
  }
  public function excluirLivro($cod)
  {
    if (!isset($cod)) {
      $sql = "DELETE FROM livros WHERE cod_liv = $cod";
      try {
        $this->con->query($sql);
      } catch (Exception $e) {
        echo "Não foi possível excluir o livro. Por favor tente novamente.";
      }
    }
  }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>
