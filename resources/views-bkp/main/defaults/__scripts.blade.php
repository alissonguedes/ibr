<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ asset('assets/js/rolagem.js') }}" type="text/javascript"></script>

<!--box-->
<script>
    $(function() {
        $("#bt_mob, #bt_quemsomos, #bt_seguros, #bt_orcamento, #bt_oferta, #bt_local, #bt_x").click(function(
            e) {
            el = $(this).data('element');
            $(el).toggle();
        });
    });
</script>

<!--carregaar-->
<script>
    $(window).on('load', function() {
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
    botaoCopiar.addEventListener("click", function() {
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
        setTimeout(function() {
            botaoCopiar.textContent = "Copiar: CNPJ: 18.124.451/0001-04";
        }, 1500); // Volta para o texto original após 1,5 segundos
    });
</script>
