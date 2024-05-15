<html lang="pt-br">

<head>
    <title>Igreja Batista Renovada</title>
    {{-- <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
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
 --}}


    <!--- CONFIGURAÇÕES BÁSICAS
   ================================================== -->
    <meta charset="utf-8">
    <meta name="Igreja Batista Renovada" content="Igreja Batista Renovada">

    <meta name="description"
        content="A Igreja Batista Renovada de João Pessoa é uma comunidade cristã acolhedora e vibrante que promove a fé, adoração e serviço na capital da Paraíba." />
    <meta name="keywords" content="" />
    <meta name="robots" content="index, follow">

    <!-- Mobile Especificações Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
{{--
    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">

    <!-- FONTES
   ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@700&display=swap" rel="stylesheet">

    <!-- Favicons
  ================================================== -->
    <link rel="shortcut icon" href="favicon.png"> --}}

</head>

<body>
{{--
    <!--carregando-->
    <div class="carregando" id="carregando">
        <div class="logo_carregando">
            <img src="{{ asset('assets/img/logo_carregando.png') }}" class="img_cem"><br>
            <p align="center"><img src="{{ asset('assets/img/carregando.gif') }}" style="width: 100px;">
            </p>
        </div>
    </div>
 --}}

    {{-- <div class="corpo" id="corpo"> --}}

        {{-- <!--menu-->
        <section class="topo">
            <div class="logo"><img src="{{ asset('assets/img/logo1.png') }}" class="img_cem"></div>
            <div class="logo2"><img src="{{ asset('assets/img/logo2.png') }}" class="img_cem"></div>
            <div class="menu">
                <a href="index.php">
                    <div class="lk">HOME</div>
                </a>
                <a href="ibr.php">
                    <div class="lk">A IBR</div>
                </a>
                <a href="ministerios.php">
                    <div class="lk">Ministérios</div>
                </a>
                <a href="cultos.php">
                    <div class="lk">Cultos</div>
                </a>
                <a href="eventos.php">
                    <div class="lk">Eventos</div>
                </a>
                <a href="calendario.php">
                    <div class="lk">Calendário</div>
                </a>
                <a href="cadast_membro.php">
                    <div class="lk_bt">SEJA MEMBRO</div>
                </a>
            </div>
            <div class="socialtop">
                <a href="https://www.instagram.com/igrejabatistarenovadajp/" target="_blank">
                    <div class="icotop"><img src="{{ asset('assets/img/ico_insta1.png') }}" class="img_cem"></div>
                </a>
                <a href="https://api.whatsapp.com/send?phone=+5583981571656&amp;text=Olá!%20A%20Paz%20do%20Senhor!"
                    target="_blank">
                    <div class="icotop"><img src="{{ asset('assets/img/ico_whats1.png') }}" class="img_cem"></div>
                </a>
                <div class="icotop" data-element=".boxlocal" id="bt_local"><img src="{{ asset('assets/img/ico_local1.png') }}"
                        class="img_cem"></div>
            </div>
            <div class="bt_menu_mob" data-element=".menu" id="bt_mob"><img src="{{ asset('assets/img/bt_mob.png') }}" class="img_cem">
            </div>
        </section> --}}


        {{-- <!--ABA HORÁRIOS-->
        <div class="aba_h">
            <div class="aba">
                <img src="{{ asset('assets/img/abah.png') }}" class="img_cem">
            </div>
            <div class="cont_aba">

                <div class="conj_h">
                    <div class="dia_semana">Segunda-feira</div>
                    <div class="horario">19h30</div>
                    <div class="conteudo_h">Culto de Oração</div>
                </div>

                <div class="conj_h">
                    <div class="dia_semana">Quarta-feira</div>
                    <div class="horario">19h30</div>
                    <div class="conteudo_h">Culto de Oração</div>
                </div>

                <div class="conj_h">
                    <div class="dia_semana">Sábado</div>
                    <div class="horario">19h30</div>
                    <div class="conteudo_h">Culto de Oração</div>
                </div>

                <div class="conj_h">
                    <div class="dia_semana">Domingo</div>
                    <div class="horario">19h30</div>
                    <div class="conteudo_h">Culto de Oração</div>
                </div>

            </div>
        </div> --}}



        {{-- <!--banners-->
        <div id="slideshow-container">
            <div class="mySlides">
                <img src="{{ asset('assets/img/slides/img1.jpg') }}" alt="Image 1">
            </div>

            <div class="mySlides">
                <img src="{{ asset('assets/img/slides/img2.jpg') }}" alt="Image 2">
            </div>

            <div class="mySlides">
                <img src="{{ asset('assets/img/slides/img3.jpg') }}" alt="Image 3">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div> --}}



        {{-- <!--base1-->
        <div class="base_slide"><img src="{{ asset('assets/img/base_slide.png') }}" class="img_cem"></div> --}}

        {{-- <!--começo container-->
        <div class="container_index"> --}}

            {{-- <div class="apresentacao">
                <div class="img_ap"><img src="{{ asset('assets/img/pastorwalber.png') }}" class="img_cem"></div>
                <div class="text_ap">
                    <div class="title_ap">O que acreditamos</div>
                    <div class="sub_ap">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna massa.
                    </div>
                    <div class="resumo_ap">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce magna massa,
                        condimentum at eleifend eu, semper a arcu. Phasellus dictum sem et urna malesuada pellentesque.
                        Sed nisi enim, laoreet non justo id, commodo dapibus enim.</div>
                </div>
            </div> --}}

            {{-- <!--palavra-->
            <section class="area_palavra">

                <div class="title_section">ÚLTIMOS CULTOS</div>
                <div class="content">
                    <!--conj palavra-->
                    <a href="culto_page.php">
                        <div class="conj_palavra">
                            <div class="img_palavra"><img src="{{ asset('assets/img/palavra/001.jpg') }}" class="img_cem"></div>
                            <div class="datapastor">
                                <div class="data">
                                    <div class="icon_p"><img src="{{ asset('assets/img/icon_data.jpg') }}" class="img_cem"></div>
                                    <div class="text_p">16 de outubro de 2023</div>
                                </div>
                                <div class="pastor">
                                    <div class="icon_p"><img src="{{ asset('assets/img/icon_pastor.jpg') }}" class="img_cem"></div>
                                    <div class="text_p">Pastor Walber</div>
                                </div>
                            </div>
                            <div class="title_palavra">Disciplina na Igreja - Parte I</div>
                            <div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                magna massa...</div>
                            <!--<div class="bts_palavra">
            <a href=""><div class="bt_p"><img src="img/play.png" class="img_cem"></div></a>
            <a href=""><div class="bt_p"><img src="img/galeria.png" class="img_cem"></div></a>
            <a href=""><div class="bt_p"><img src="img/resumo.png" class="img_cem"></div></a>
          </div>-->
                        </div>
                    </a>

                    <!--conj palavra-->
                    <a href="culto_page.php">
                        <div class="conj_palavra">
                            <div class="img_palavra"><img src="{{ asset('assets/img/palavra/001.jpg') }}" class="img_cem"></div>
                            <div class="datapastor">
                                <div class="data">
                                    <div class="icon_p"><img src="{{ asset('assets/img/icon_data.jpg') }}" class="img_cem"></div>
                                    <div class="text_p">16 de outubro de 2023</div>
                                </div>
                                <div class="pastor">
                                    <div class="icon_p"><img src="{{ asset('assets/img/icon_pastor.jpg') }}" class="img_cem"></div>
                                    <div class="text_p">Pastor Walber</div>
                                </div>
                            </div>
                            <div class="title_palavra">Disciplina na Igreja - Parte I</div>
                            <div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                magna massa...</div>
                            <!--<div class="bts_palavra">
            <a href=""><div class="bt_p"><img src="img/play.png" class="img_cem"></div></a>
            <a href=""><div class="bt_p"><img src="img/galeria.png" class="img_cem"></div></a>
            <a href=""><div class="bt_p"><img src="img/resumo.png" class="img_cem"></div></a>
          </div>-->
                        </div>
                    </a>

                    <!--conj palavra-->
                    <a href="culto_page.php">
                        <div class="conj_palavra">
                            <div class="img_palavra"><img src="{{ asset('assets/img/palavra/001.jpg') }}" class="img_cem"></div>
                            <div class="datapastor">
                                <div class="data">
                                    <div class="icon_p"><img src="{{ asset('assets/img/icon_data.jpg') }}" class="img_cem"></div>
                                    <div class="text_p">16 de outubro de 2023</div>
                                </div>
                                <div class="pastor">
                                    <div class="icon_p"><img src="{{ asset('assets/img/icon_pastor.jpg') }}" class="img_cem"></div>
                                    <div class="text_p">Pastor Walber</div>
                                </div>
                            </div>
                            <div class="title_palavra">Disciplina na Igreja - Parte I</div>
                            <div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                magna massa...</div>
                            <!--<div class="bts_palavra">
            <a href=""><div class="bt_p"><img src="img/play.png" class="img_cem"></div></a>
            <a href=""><div class="bt_p"><img src="img/galeria.png" class="img_cem"></div></a>
            <a href=""><div class="bt_p"><img src="img/resumo.png" class="img_cem"></div></a>
          </div>-->
                        </div>
                    </a>

                </div>

                <a href="cultos.php">
                    <div class="bt_ver_mais">ver mais</div>
                </a>

            </section>

            <!--corpo pastoral-->
            <section class="corpo_pastoral">

                <div class="title_section">CORPO PASTORAL</div>
                <div class="content">

                    <div class="conj_pastor">
                        <div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
                        <div class="nome_pr">Pastor Walber Barbosa</div>
                    </div>

                    <div class="conj_pastor">
                        <div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
                        <div class="nome_pr">Pastor Walber Barbosa</div>
                    </div>

                    <div class="conj_pastor">
                        <div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
                        <div class="nome_pr">Pastor Walber Barbosa</div>
                    </div>

                    <div class="conj_pastor">
                        <div class="img_pr"><img src="{{ asset('assets/img/pastor.jpg') }}" class="img_cem"></div>
                        <div class="nome_pr">Pastor Walber Barbosa</div>
                    </div>

                </div>

            </section>

            <!--eventos-->
            <section class="eventos">
                <div class="title_section cor_verde">EVENTOS IBR</div>

                <div class="content">

                    <!--conj palavra-->
                    <a href="evento_page.php">
                        <div class="conj_palavra">
                            <div class="img_palavra"><img src="{{ asset('assets/img/eventos/001.jpg') }}" class="img_cem"></div>
                            <div class="title_palavra">Acamp-X<br>Incendiários</div>
                            <div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                magna massa...</div>
                        </div>
                    </a>

                    <!--conj palavra-->
                    <a href="evento_page.php">
                        <div class="conj_palavra">
                            <div class="img_palavra"><img src="{{ asset('assets/img/eventos/001.jpg') }}" class="img_cem"></div>
                            <div class="title_palavra">Acamp-X<br>Incendiários</div>
                            <div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                magna massa...</div>
                        </div>
                    </a>

                    <!--conj palavra-->
                    <a href="evento_page.php">
                        <div class="conj_palavra">
                            <div class="img_palavra"><img src="{{ asset('assets/img/eventos/001.jpg') }}" class="img_cem"></div>
                            <div class="title_palavra">Acamp-X<br>Incendiários</div>
                            <div class="resumo_palavra">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce
                                magna massa...</div>
                        </div>
                    </a>

                </div>

                <a href="eventos.php">
                    <div class="bt_ver_mais2">ver todos os eventos</div>
                </a>

            </section>

            <!--nosso templo-->
            <section class="nossotemplo">

                <div class="text_templo">
                    <div class="title_templo1 cor cinza">Nosso novo</div>
                    <div class="title_templo2 cor_verde">Templo</div>
                    <div class="resumo_templo">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra tortor sem, at laoreet
                        nisl condimentum et. Phasellus vitae pretium libero, eu sollicitudin massa.
                    </div>
                    <div class="bt_oferta" data-element=".boxoferta" id="bt_oferta">FAÇA SUA OFERTA</div>
                </div>
                <div class="img_templo">
                    <img src="{{ asset('assets/img/novotemplo.png') }}" class="img_cem">
                </div>

            </section> --}}


            {{-- <!--footer-->
            <footer>
                <div class="content">
                    <div class="logo_f"><img src="{{ asset('assets/img/logo_completa_branca.png') }}" class="img_cem"></div>
                    <div class="endereco_fone">
                        <div class="title_footer">Endereço</div>
                        <div class="text_footer">
                            Rua Poeta Luiz Raimundo Batista de Carvalho, 423,<br>
                            Jardim Oceania, Joao Pessoa-PB. CEP:58.037-530
                        </div>
                        <a href="tel:+5583981571656">
                            <div class="title_footer">83 98157-1656</div>
                        </a>
                    </div>
                    <div class="social_footer">
                        <a href="https://www.instagram.com/igrejabatistarenovadajp/" target="_blank">
                            <div class="icotop"><img src="{{ asset('assets/img/ico_insta1.png') }}" class="img_cem"></div>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=+5583981571656&amp;text=Olá!%20A%20Paz%20do%20Senhor!"
                            target="_blank">
                            <div class="icotop"><img src="{{ asset('assets/img/ico_whats1.png') }}" class="img_cem"></div>
                        </a>
                        <div class="icotop" data-element=".boxlocal" id="bt_local"><img src="{{ asset('assets/img/ico_local1.png') }}"
                                class="img_cem"></div>
                    </div>
                </div>
                <div class="copyright_dev">
                    <div class="content">

                        <div class="copyright">Igreja Batista Renovada <?php echo date('Y'); ?>. Todos os direitos
                            reservados.</div>
                        <div class="dev">

                            <a href="https://wa.me/5583988336804" target="_blank">
                                <div class="logo_dev2">
                                    <img src="{{ asset('assets/img/fstrong.png') }}" class="img_cem">
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </footer> --}}


            {{-- <!--fim container index-->
        </div> --}}

        <!--base3-->


        <!--base4-->


        <!--base5-->


        <!--base6-->


        <!--box-->
        <section class="boxquemsomos">
            <div class="box">
                <div class="x" data-element=".boxquemsomos" id="bt_quemsomos"><img src="{{ asset('assets/img/bt_x.jpg') }}"
                        class="img_cem"></div>
                <div class="content">

                    <div class="tt_box font_black cor_azul">Quem somos</div>
                    <div class="area_box">
                        <div class="img_box">
                            <img src="{{ asset('assets/img/foto_empresa.jpg') }}" class="img_cem">
                        </div>
                        <div class="txt_box">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam viverra tortor sem, at
                            laoreet nisl condimentum et. Phasellus vitae pretium libero, eu sollicitudin massa.
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!--box-->
        <section class="boxoferta">
            <div class="box">
                <div class="x" data-element=".boxoferta" id="bt_oferta"><img src="{{ asset('assets/img/bt_x.png') }}"
                        class="img_cem"></div>
                <div class="content">

                    <div class="tt_box font_black cor_azul">Faça uma Oferta</div>
                    <div class="area_box">

                        <div class="txt_seguros">Ofertar na Igreja Batista Renovada é um ato de generosidade que
                            sustenta a missão de amor, fé e compaixão, fortalecendo nossa comunidade e servindo a Deus.
                        </div>

                        <div class="area_pag">
                            <img src="{{ asset('assets/img/qrcode.jpg') }}" class="img_cem">
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
                <div class="x" data-element=".boxorcamento" id="bt_orcamento"><img src="{{ asset('assets/img/bt_x.jpg') }}"
                        class="img_cem"></div>
                <div class="content">

                    <div class="tt_box font_black cor_azul">Orçamento</div>
                    <div class="area_box">

                        <div class="txt_seguros">Faça a cotação do seguro do seu veículo aqui! Rápido e fácil. Em breve
                            entraremos em contato.</div>

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
                <div class="x" data-element=".boxlocal" id="bt_local"><img src="{{ asset('assets/img/bt_x.png') }}"
                        class="img_cem"></div>
                <div class="content">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.3812492344155!2d-34.8379774250019!3d-7.0817236929211855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7acdda36872670d%3A0xac74a631d073e22f!2sIgreja%20Batista%20Renovada!5e0!3m2!1spt-BR!2sbr!4v1697538362604!5m2!1spt-BR!2sbr"
                        class="mapa" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>



        <!--Whatsapp-->
        <a href="https://api.whatsapp.com/send?phone=+5583981571656&amp;text=Olá!%20A%20Paz%20do%20Senhor"
            target="_blank">
            <div class="whatsapp_ico">
                <img src="{{ asset('assets/img/wp.png') }}" class="img_cem">
            </div>
        </a>

        {{-- <!--Slides-->
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
        </script> --}}

        <!--fim do corpo-->
    {{-- </div> --}}

</body>

</html>
