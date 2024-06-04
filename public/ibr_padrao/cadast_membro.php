<html lang="pt-br">

<head>
  <title>IBR - Seja um mebro IBR</title>
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
  <div class="title_page">SEJA UM MEMBRO IBR</div>

  <!--CONTEÚDO-->
  <div class="content_int">


    <div class="col_evento">



      <div class="img_evento">
        <img src="img/membro.jpg" class="img_cem">
      </div>

      <div class="texto_insc">
        Seja parte da nossa família espiritual! Inscreva-se como membro da Igreja Batista Renovada hoje mesmo.
        <br><br>
        Juntos, vamos fortalecer nossa fé e impactar vidas.
      </div>


    </div>


    <form method="post" action="" class="formulario">

          <div class="nome_campo">Nome Completo: <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">E-mail: <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">Fone (Whatsapp): <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">idade: <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <div class="nome_campo">Cidade: <span style="color: #ff0000";>*</span></div>
          <input type="text" class="campo" name="nome" required>

          <a href=""><div class="bt_pg">FINALIZAR CADASTRO</div></a>

    </form>

  </div>

<!--footer-->
<?php include "footer.php"; ?>
