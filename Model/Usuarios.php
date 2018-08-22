<?php
  /**
   *
   */
  include 'Conexao.php';

  class Usuarios extends Conexao {
    //private $usuario;
    private $senha;
    private $tipo;
    private $nome;
    private $tel;
    private $email;
    private $matricula;

  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  ///  MÉTODOS DE ACESSO  ///////////////////////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function setNomeUsuario($value)
    {
      $this->usuario = $value;
    }
    public function getNomeUsuario()
    {
      return $this->usuario;
    }

    public function setSenhaUsuario($value)
    {
      $this->senha = $value;
    }
    public function getSenhaUsuario()
    {
      return $this->senha;
    }

    public function setTipoUsuario($value)
    {
      $this->tipo = $value;
    }
    public function getTipoUsuario()
    {
      return $this->tipo;
    }

    public function setTelUsuario($value)
    {
      $this->tel = $value;
    }
    public function getTelUsuario()
    {
      return $this->tel;
    }

    public function setEmailUsuario($value)
    {
      $this->email = $value;
    }
    public function getEmailUsuario()
    {
      return $this->email;
    }

    public function setMatriculaUsuario($value)
    {
      $this->matricula = $value;
    }
    public function getMatriculaUsuario()
    {
      return $this->matricula;
    }

    public function logado($cod)
    {
      if (isset($cod)) {
        $sql = "SELECT * FROM users WHERE cod_users = $cod";
        try {

          $result = $this->con->query($sql);
          $row = $result->fetch_assoc();

          $this->setNomeUsuario($row['nome_users']);
          $this->setTipoUsuario($row['tipo_users']);
          $this->setTelUsuario($row['tel_users']);
          $this->setEmailUsuario($row['email_users']);


        } catch (Exception $e) {
          echo "Não foi possível...";
        }
      }
    }


    public function emprestimosUsuario($cod)
    {
      if (isset($cod)) {
        $sql = "SELECT * FROM emprestimos e JOIN livros l ON l.cod_liv = e.cod_liv WHERE cod_users = $cod ORDER BY data_emp";
        try {

          $result = $this->con->query($sql);

          while ($row = $result->fetch_assoc()) {
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
        } catch (Exception $e) {
          echo "Não foi possível...";
        }
      } else {
        echo "Não foi possível...";
      }
    }

    public function reservasUsuario($cod)
    {
      $sql = 'SELECT * FROM reservas r JOIN users u ON u.cod_users = r.cod_users JOIN livros l ON l.cod_liv = r.cod_liv WHERE u.cod_users='. $cod .' ORDER BY data_res';
      try {
        $result = $this->con->query($sql);
        while($row = $result->fetch_assoc()):
          #codigo emp
          $de = $row['prazo_busca_res'];
          $data_e = substr($de, 8,9) ."/".substr($de, 5,2)."/".substr($de, 0,4);
          $d = (int) substr($de, 8,9) + 14;
          #fazer calculo se passar de 31 ou 30 mudar o mês

          echo "<tr><td>". $row['nome_liv'];
          echo "<br><small>".$row['autor_liv'];
          echo "</small></td><td>".$data_e;
          echo "</td><td><button class='btn btn-danger btn-xs' data-user='".$row["cod_users"]."' data-id='".$row["cod_res"]."' id='cancelarReserva'><i class='fa fa-trash-o'></i> Cancelar </button></td></tr>";
          endwhile;
      } catch (Exception $e) {
        echo $e;
      }
    }

    public function esperaUsuario($cod)
    {
      $sql = 'SELECT * FROM espera e JOIN users u ON u.cod_users = e.cod_users JOIN livros l ON l.cod_liv = e.cod_liv WHERE u.cod_users='. $cod;
      try {
        $result = $this->con->query($sql);
        while($row = $result->fetch_assoc()):
          echo "<tr><td>".$row['nome_liv'];
          echo "<br><small>".$row['autor_liv']."</small></td>";
          echo "<td><button class='btn btn-danger btn-xs' data-id='".$row['cod_esp']."' data-user='".$row['cod_users']."' id='cancelarEspera'><i class='fa fa-trash-o'></i> Cancelar </button></td></tr>";
        endwhile;
      } catch (Exception $e) {
        echo $e;
      }

    }

  }

?>
