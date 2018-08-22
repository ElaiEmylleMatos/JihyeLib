$(document).ready(function() {
  $(document).on('click', '#cancelarReserva', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var user = $(this).data('user');
    $.ajax({
      url: '../Model/excluirReserva.php',
      type: 'POST',
      data: 'id=' + id,
      success: function() {
        recarregarReservas(user);
        new PNotify({
          text: 'Reserva excluída com sucesso.',
          type: 'success',
          styling: 'bootstrap3'
        });
      },
      error: function() {
        new PNotify({
          text: 'Não foi possível excluir a reserva, tente novamente.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    });
  });

  $(document).on('click', '#cancelarEspera', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var user = $(this).data('user');
    $.ajax({
      url: '../Model/excluirEspera.php',
      type: 'POST',
      data: 'id=' + id,
      success: function() {
        recarregarEsperas(user);
        new PNotify({
          text: 'Livro excluído da lista de espera.',
          type: 'success',
          styling: 'bootstrap3'
        });

      },
      error: function() {
        new PNotify({
          text: 'Não foi possível excluir o livro da lista de espera, tente novamente.',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
    });
  });

  function recarregarReservas(id) {
    $.ajax({
        url: '../Model/alterarTabelaRes.php',
        type: 'POST',
        data: 'id=' + id,
        dataType: 'html',
        cache: false
      })
      .done(function(table) {
        $('#tabela').html(table);
      })
      .fail(function(table) {
        alert(oi);
        alert(table);
      });
  }

  function recarregarEsperas(id) {
    $.ajax({
        url: '../Model/alterarTabelaEspera.php',
        type: 'POST',
        data: 'id=' + id,
        dataType: 'html',
        cache: false
      })
      .done(function(table) {
        $('#tabela2').html(table);
      });
  }

  $(document).on('click','#modal', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#detalhes-livro').hide();
    $('#livro_data-loader').show();
    $.ajax({
        url: '../Model/modalLiv.php',
        type: 'POST',
        data: 'id=' + id,
        dataType: 'json',
        cache: false
      })
      .done(function(data) {
        $('#detalhes-livro').hide();
        $('#detalhes-livro').show();

        $('#capa').attr('src',"../"+data.capa_liv);
        $('#nome').html(data.nome_liv);
        $('#autor').html("Autor: " + data.autor_liv);
        $('#editora').html("Editora: " + data.editora_liv);
        $('#ano').html("Ano: " + data.ano_liv);
        $('#isbn').html("ISBN: " + data.isbn_liv);
        $('#pags').html("Páginas: " + data.pags_liv);
        $('#gen').html("Gênero: " + data.nome_gen);
        if (data.sinopse_liv == "") {
          $('#sinopse').html("Livro sem sinopse.");
        } else {
          $('#sinopse').html(data.sinopse_liv);
        }
        
        $('#livro_data-loader').hide();
      })
      .fail(function() {
        $('#detalhes-livro').html('Erro, por favor tente novamente...');
        $('#livro_data-loader').hide();
      });
  });

  //isso funciona, mas a pagina não funciona e tb se trocar de pág sai da tela cheia
 /*function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
     (!document.mozFullScreen && !document.webkitIsFullScreen)) {
      if (document.documentElement.requestFullScreen) {
        document.documentElement.requestFullScreen();
      } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullScreen) {
        document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    } else {
      if (document.cancelFullScreen) {
        document.cancelFullScreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
      }
    }
    tela.attr("class","glyphicon glyphicon-resize-small");
  }*/
});
