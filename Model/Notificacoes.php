<?php
include_once 'Conexao.php';
date_default_timezone_set('America/Sao_Paulo');
/**
 *
 */
class Notificacoes extends Conexao
{
  private $dataAtual = "2018-08-20";
  //private $dataAtual = date("Y-m-d");
  private $diasProf = 14;
  private $diasEst = 7;
  private $quantNot = 0;

  public function getQuant()
  { // CONTAR QUANTAS NOTIFICACOES TEM
    if ($this->quantNot !== 0) {
      echo '<span class="badge bg-green">'.$this->quantNot.'</span>';
    }
  }

  public function verificarEmprestimos($cod)
  { // AQUI VER SE O EMPRESTIMO ESTÁ PERTO DE VENCER, NO DIA, OU ATRASADO
    // depois ver o que realmente vai usar para não ficar pegando tudo
    $sql = "SELECT * FROM emprestimos e JOIN livros l ON l.cod_liv = e.cod_liv JOIN users u ON u.cod_users = e.cod_users WHERE u.cod_users = $cod ORDER BY data_emp";
    try {
      $result = $this->con->query($sql);

      while ($row = $result->fetch_assoc()) {
        $dataDevEmp = $row['data_dev_emp'];

        // ver se a data de devolucao é a atual
        if ($this->dataAtual === $dataDevEmp) {
          echo '<li style="background-color: rgba(255,216,0,0.5);">
            <a>
              <span>
                <span><i class="fa fa-exclamation"></i> ATENÇÃO</span>
              </span>
              <span class="message">
                A data de devolução do livro <strong>'. $row['nome_liv'] .'</strong> é <strong>hoje</strong>.
              </span>
            </a>
          </li>';
          $this->quantNot++;
        } else if ($this->dataAtual > $dataDevEmp) {
          echo '<li class="bg-red">
            <a>
              <span>
                <span><i class="fa fa-close"></i> ATRASO </span>
              </span>
              <span class="message">
                A devolução do livro <strong>'. $row['nome_liv'] .'</strong> está atrasada.
              </span>
            </a>
          </li>';
          $this->quantNot++;
        } else {
          // ver isso aqui de acordo com os dias. e fazer funcao pra enviar emails ou sms
          echo '<li style="background-color: rgba(255,216,0,0.5);">
            <a>
              <span>
                <span><i class="fa fa-exclamation"></i> ATENÇÃO</span>
              </span>
              <span class="message">
                A data de devolução do livro <strong>'. $row['nome_liv'] .'</strong> é <strong>'. $row['data_dev_emp'] .'</strong>.
              </span>
            </a>
          </li>';
          $this->quantNot++;
        }
      }
    } catch (Exception $e) {
      echo $e;
    }
  }

  public function verificarEspera($cod)
  { // AQUI VER SE O LIVRO NA LISTA DE ESPERA ESTA DISPONIVEL
    $sql = "SELECT * FROM espera e JOIN livros l ON l.cod_liv = e.cod_liv JOIN users u ON u.cod_users = e.cod_users WHERE u.cod_users = $cod";
    try {
      $result = $this->con->query($sql);

      while ($row = $result->fetch_assoc()) {
        // ver se a data de devolucao é a atual
        if ($row['quant_liv'] > 0) {
          echo '<li class="bg-blue">
            <a>
              <span>
                <span><i class="fa fa-asterisk"></i> OPA!</span>
              </span>
              <span class="message">
                O livro <strong>'. $row['nome_liv'] .'</strong> está disponível para reserva.
                <small><a href="reservar.php?cod='. $row['cod_liv'] .'" class="link-re">fazer reserva</a></small>
              </span>
            </a>
          </li>';
          $this->quantNot++;
        }
      }
    } catch (Exception $e) {
      echo $e;
    }
  }

  // VERIFICAR SE A RESERVA AINDA ESTA NA VALIDADE, SENAO EXCLUI


  public function getStatus($cod)
  {
    $sql = "SELECT status_users FROM users WHERE cod_users = $cod";
    try {
      $result = $this->con->query($sql);
      $row = $result->fetch_assoc();

      if ($row['status_users'] === false) {
        echo "<span class='bg-red'>Você não pode realizar reservas ou empréstimos por <strong>x</strong> dias.</span>";
      } else {
        echo "<span class='bg-blue'>Você já pode realizar reservas ou empréstimos.</span>";
      }
      // se a data for 1 dia depois do dia da multa, exibe um negocinho verde

    } catch (Exception $e) {
      echo $e;
    }
  }


  // NAO SEI SE ISSO EH AQUI
  public function calcularMulta()
  { // AQUI CALCULAR O TANTO DE DIAS QUE O USUARIO VAI FICAR SEM PODER PEGAR O LIVRO

  }
}
?>
