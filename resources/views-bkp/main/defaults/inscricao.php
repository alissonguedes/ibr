<html lang="pt-br">

<head>
  <title>IBR - Inscrição do Evento</title>
  <?php include "head.php"; ?>
</head>

<body>

  <!--carregando-->
  <?php include "loading.php"; ?>

  <!--início do corpo-->
  <div class="corpo" id="corpo">

  <!--menu-->
  <?php include "topo.php"; ?>

  <!--título da página-->
  <div class="title_page">INSCRIÇÃO</div>

  <!--CONTEÚDO-->
  <div class="content_int">


    <div class="col_evento">


      <div class="tt">ACAMP-X - Incendiários</div>
      <div class="data2 cor_cinza">De 03/02/2024 à 06/02/2024</div>


      <div class="img_evento">
        <img src="img/eventos/001.jpg" class="img_cem">
      </div>

      <div class="texto_insc">
        Preencha o formulário com os seus dados e logo após siga as instruções de pagamento.
      </div>

      <div class="valor_insc">
        <div class="name_vlr">Valor da Inscrição:</div>
        <div class="vlr cor_verde">R$350,00</div>
      </div>

    </div>


    <form method="post" action="" class="formulario">

          <div class="nome_campo">Nome Completo: <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">E-mail: <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">Fone (Whatsapp): <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">Cidade: <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">Membro da IBR? <span style="color: #ff0000";>*</span></div>


          <a href=""><div class="bt_pg">IR PARA PAGAMENTO</div></a>

    </form>

  </div>

<!--footer-->
<?php include "footer.php"; ?>
