<!--footer-->
<footer>
  <div class="content">
    <div class="logo_f"><img src="img/logo_completa_branca.png" class="img_cem"></div>
    <div class="endereco_fone">
      <div class="title_footer">Endereço</div>
      <div class="text_footer">
        Rua Poeta Luiz Raimundo Batista de Carvalho, 423,<br>
        Jardim Oceania, Joao Pessoa-PB. CEP:58.037-530
      </div>
      <a href="tel:+5583981571656"><div class="title_footer">83 98157-1656</div></a>
    </div>
    <div class="social_footer">
      <a href="https://www.instagram.com/igrejabatistarenovadajp/" target="_blank"><div class="icotop"><img src="img/ico_insta1.png" class="img_cem"></div></a>
      <a href="https://api.whatsapp.com/send?phone=+5583981571656&amp;text=Olá!%20A%20Paz%20do%20Senhor!" target="_blank"><div class="icotop"><img src="img/ico_whats1.png" class="img_cem"></div></a>
      <div class="icotop"  data-element=".boxlocal" id="bt_local"><img src="img/ico_local1.png" class="img_cem"></div>
    </div>
  </div>
  <div class="copyright_dev">
    <div class="content">

      <div class="copyright">Igreja Batista Renovada <?php echo date('Y'); ?>. Todos os direitos reservados.</div>
      <div class="dev">

        <a href="https://wa.me/5583988336804" target="_blank">
          <div class="logo_dev2">
            <img src="img/fstrong.png" class="img_cem">
          </div>
        </a>
      </div>

    </div>
  </div>
</footer>


<!--fim container index-->
</div>

<!--base3-->


<!--base4-->


<!--base5-->


<!--base6-->


<!--box-->
<section class="boxquemsomos">
<div class="box">
  <div class="x" data-element=".boxquemsomos" id="bt_quemsomos"><img src="img/bt_x.jpg" class="img_cem"></div>
  <div class="content">

    <div class="tt_box font_black cor_azul">Quem somos</div>
    <div class="area_box">
      <div class="img_box">
        <img src="img/foto_empresa.jpg" class="img_cem">
      </div>
      <div class="txt_box">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra tortor sem, at laoreet nisl condimentum et. Phasellus vitae pretium libero, eu sollicitudin massa.
      </div>
    </div>

  </div>
</div>
</section>

<!--box-->
<section class="boxoferta">
<div class="box">
  <div class="x" data-element=".boxoferta" id="bt_oferta"><img src="img/bt_x.png" class="img_cem"></div>
  <div class="content">

    <div class="tt_box font_black cor_azul">Faça uma Oferta</div>
    <div class="area_box">

      <div class="txt_seguros">Ofertar na Igreja Batista Renovada é um ato de generosidade que sustenta a missão de amor, fé e compaixão, fortalecendo nossa comunidade e servindo a Deus.</div>

      <div class="area_pag">
        <img src="img/qrcode.jpg" class="img_cem">
        <div class="pix_view">Igreja Batista Renovada</div>

      </div>
      <div id="texto" class="pix_copy">18124451000104</div>
      <button id="botao-copiar" class="bt_click">Copiar CNPJ: 18.124.451/0001-04</button>

    </div>

  </div>
</div>
</section>

<!--box-->
<section class="boxorcamento">
<div class="box">
  <div class="x" data-element=".boxorcamento" id="bt_orcamento"><img src="img/bt_x.jpg" class="img_cem"></div>
  <div class="content">

    <div class="tt_box font_black cor_azul">Orçamento</div>
    <div class="area_box">

      <div class="txt_seguros">Faça a cotação do seguro do seu veículo aqui! Rápido e fácil. Em breve entraremos em contato.</div>

      <form method="post" action="enviar.php" class="form">
        <input type="text" name="nome" placeholder="Seu Nome:" class="input">
        <input type="number" name="fone" placeholder="Seu Telefone:" class="input">
        <input type="number" name="cpf" placeholder="Seu CPF:" class="input">
        <input type="number" name="CEP" placeholder="CEP:" class="input">
        <input type="text" name="placa" placeholder="Placa do Veículo:" class="input">
        <input type="submit" name="enviar" value="enviar orçamento" class="bt_form">
      </form>

    </div>

  </div>
</div>
</section>

<!--box-->
<section class="boxlocal">
<div class="box">
  <div class="x" data-element=".boxlocal" id="bt_local"><img src="img/bt_x.png" class="img_cem"></div>
  <div class="content">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.3812492344155!2d-34.8379774250019!3d-7.0817236929211855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7acdda36872670d%3A0xac74a631d073e22f!2sIgreja%20Batista%20Renovada!5e0!3m2!1spt-BR!2sbr!4v1697538362604!5m2!1spt-BR!2sbr" class="mapa" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>
</section>



<!--Whatsapp-->
<a href="https://api.whatsapp.com/send?phone=+5583981571656&amp;text=Olá!%20A%20Paz%20do%20Senhor" target="_blank">
<div class="whatsapp_ico">
<img src="img/wp.png" class="img_cem">
</div>
</a>

<!--Slides-->
<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
showSlides(slideIndex += n);
}

function showSlides(n) {
let i;
let slides = document.getElementsByClassName("mySlides");

if (n > slides.length) {
slideIndex = 1;
}

if (n < 1) {
slideIndex = slides.length;
}

for (i = 0; i < slides.length; i++) {
slides[i].style.display = "none";
}

slides[slideIndex - 1].style.display = "block";
}

// Função para avançar automaticamente os slides a cada 5 segundos
function autoAdvance() {
plusSlides(1);
}

setInterval(autoAdvance, 5000); // Avança a cada 5 segundos
</script>

<!--copiar-->
<script>
// Seleciona o elemento de texto e o botão
const textoParaCopiar = document.getElementById("texto");
const botaoCopiar = document.getElementById("botao-copiar");

// Adiciona um evento de clique ao botão
botaoCopiar.addEventListener("click", function () {
// Seleciona o texto dentro do elemento
const textoSelecionado = window.getSelection();
const range = document.createRange();
range.selectNode(textoParaCopiar);
textoSelecionado.removeAllRanges();
textoSelecionado.addRange(range);

// Copia o texto selecionado para a área de transferência
document.execCommand("copy");

// Limpa a seleção
textoSelecionado.removeAllRanges();

// Atualiza o texto do botão após a cópia
botaoCopiar.textContent = "Copiado!";
setTimeout(function () {
  botaoCopiar.textContent = "Copiar: CNPJ: 18.124.451/0001-04";
}, 1500); // Volta para o texto original após 1,5 segundos
});
</script>

<!--fim do corpo-->
</div>

</body>
</html>
