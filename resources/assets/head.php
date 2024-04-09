<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/rolagem.js" type="text/javascript"></script>

<!--box-->
<script>
$(function(){
  $("#bt_mob, #bt_quemsomos, #bt_seguros, #bt_orcamento, #bt_oferta, #bt_local, #bt_x").click(function(e){
      el = $(this).data('element');
      $(el).toggle();
  });
});
</script>

<!--carregaar-->
<script>
$(window).on('load', function (){
  document.getElementById("carregando").style.display = "none";
  document.getElementById("corpo").style.display = "block";
})

/*var intervalo = setInterval(function (){
  clearInterval(intervalo);

  document.getElementById("carregando").style.display = "none";
  document.getElementById("corpo").style.display = "block";
},5000
);*/
</script>



<!--- CONFIGURAÇÕES BÁSICAS
 ================================================== -->
<meta charset="utf-8">
<meta name="Igreja Batista Renovada" content="Igreja Batista Renovada">

<meta name="description" content="A Igreja Batista Renovada de João Pessoa é uma comunidade cristã acolhedora e vibrante que promove a fé, adoração e serviço na capital da Paraíba." />
<meta name="keywords" content="" />
<meta name="robots" content="index, follow">

 <!-- Mobile Especificações Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
 ================================================== -->
<link rel="stylesheet" href="css/layout.css">


<!-- FONTES
 ================================================== -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">


 <!-- Favicons
================================================== -->
<link rel="shortcut icon" href="favicon.png" >
