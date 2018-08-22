<?php

include_once '../Model/Usuarios.php';
include_once '../Model/Notificacoes.php';
// codigo do usuario
$cod = 1;
$n = new Notificacoes();
$user = new Usuarios();
$user->logado($cod);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Meu Perfil | Jihye </title>

  <link rel="icon" href="../Assets/lv.ico" type="image/ico">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/nprogress.css" rel="stylesheet">
  <link href="css/pnotify.css" rel="stylesheet">
  <link href="css/custom.min.css" rel="stylesheet">

  <script src="js/jquery.min.js"></script>
  <script src="js/data.js"></script>
</head>

<body class="nav-md">
  <div class="container body dark">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-university"></i> <span>Jihye</span></a>
          </div>
          <div class="clearfix"></div><br>

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>  <a href="indexPE.php">Perfil</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-book"></i> Livros <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="reservar.php">Reservar</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <!-- ir pra pagina com configurações -->
            <a data-toggle="tooltip" data-placement="top" title="Configurações">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <!-- deixar tela cheia -->
            <a data-toggle="tooltip" data-placement="top" title="Tela cheia">
              <span id="tela" name="tela" class="glyphicon glyphicon-fullscreen" aria-hidden="true" onclick="toggleFullScreen()"></span>
            </a>
            <!-- sair -->
            <a data-toggle="tooltip" data-placement="top" title="Sair" href="../Model/logout.php">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?php echo $user->getNomeUsuario(); ?>   <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="indexPE.php"> Perfil</a></li>
                  <li><a href="../Model/logout.php"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <?php
                  $n->verificarEmprestimos($cod);
                  $n->verificarEspera($cod); ?>
                </ul>
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <?php $n->getQuant(); ?>
                </a>

              </li>
              <li>
                <a>
                <div class="form-group top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Pesquise por...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
                </div></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h1><?php echo $user->getNomeUsuario(); ?></h1>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="../Assets/img/johnny.jpg" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                    </div>
                    <address>
                      <h4><strong><?php echo $user->getTipoUsuario(); ?></strong></h4>
                      <h4><?php echo $user->getTelUsuario(); ?></h4>
                      <h4><?php echo $user->getEmailUsuario(); ?></h4>
                    </address>
                    <h4><?php $n->getStatus($cod); ?></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Meus Empréstimos</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th style="width: 70%">Livro</th>
                        <th>Data de empréstimo</th>
                        <th>Data de devolução</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $user->emprestimosUsuario($cod); ?>
        	          </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Minhas Reservas</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped projects table-hover">
                    <thead>
                      <tr>
                        <th style="width: 59%">Livros</th>
                        <th>Data limite</th>
                        <th> </th>
                      </tr>
                    </thead>
                    <tbody id="tabela">
                      <?php $user->reservasUsuario($cod); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Lista de Espera</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Livros</th>
                        <th>  </th>
                      </tr>
                    </thead>
                    <tbody id="tabela2">
                      <?php $user->esperaUsuario($cod); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer>
        <div class="pull-right">
          Jihye por <a href="#">SMILE</a>
        </div>
        <div class="clearfix"></div>
      </footer>
    </div>
  </div>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/fastclick.js"></script>
  <script src="js/nprogress.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/pnotify.js"></script>
</body>

</html>
