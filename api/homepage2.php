<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="/css/style.css">
        <script src="/js/inicial.js" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
</head>
<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Help<span>Memory</span></a></div>
            <ul class="menu">
                <li><a href="homepage.php" class="menu-btn">Página Inicial</a></li>
                <li><a href="cadastro.php" class="menu-btn">Cadastro/login</a></li>
                <li><a href="Paciente.php" class="menu-btn">Paciente</a></li>                
                <li><a href="#home" class="menu-btn">Casa</a></li>
                <li><a href="#about" class="menu-btn">Sobre mim</a></li>
                <li><a href="#services" class="menu-btn">Serviços</a></li>
                <li><a href="#skills" class="menu-btn">Habilidades</a></li>
                <li><a href="#teams" class="menu-btn">Equipe</a></li>
                <li><a href="#contact" class="menu-btn">Contato</a></li>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>
    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">Olá, nosso nome é</div>
                <div class="text-2">Help Memory</div>
                <div class="text-3">E nós somos um <?php echo "&nbsp"?><span class="typing"></span></div>
            </div>
        </div>
    </section>
    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">Sobre mim</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="images/foto.jpg" alt="">
                </div>
                <div class="column right">
                    <div class="text">Somos a Help Memory e nos somos um <br><span class="typing-2"></span></div>
                    <p>A Help Memory é uma empresa moderna,ágil e dinâmica, que disponibilizam ao mercado corporativo soluções completas e sincronizadas com as necessidades peculiares de cada cliente. Nossa meta é a satisfação de nosso maior "patrimônio" nossos clientes</p>
                </div>
            </div>
        </div>
    </section>
    <!-- services section start -->
    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">Meu serviço</h2>
            <div class="serv-content">
                <div class="card">
                    <div class="box">
                        <i class="fas fa-ambulance"></i>
                        <div class="text">ATENDIMENTO</div>
                        <p>Nosso atendimento é focado em ser o mais informativo possivel, para que todos entendão.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-chart-line"></i>
                        <div class="text">ADVERSIDADE</div>
                        <p>Após superar muito problemas o nosso hospital se tornou um dos melhores se São Paulo.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-briefcase-medical"></i>
                        <div class="text">HOSPITAL</div>
                        <p>No nosso hospital temos os melhores equipamentos e profissionais voltado pra área da saúde.</p>
                    </div>
                </div>
               </div>
            </div>
        </div>
    </section>
    <!-- skills section start -->
    <section class="skills" id="skills">
        <div class="max-width">
            <h2 class="title">Nossas habilidades</h2>
            <div class="skills-content">
                <div class="column left">
                    <div class="text">Minhas habilidades e experiências criativas.</div>
                    <p>Possuímos profissionais qualificados, de notavel conhecimento e experieêcia no ramo da medicina, para o melhor atendimento</p>
                </div>
                <div class="column right">
                    <div class="bars">
                        <div class="info">
                            <span>ATENDIMENTO</span>
                            <span>100%</span>
                        </div>
                        <div class="line html"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>COMPROMISSO</span>
                            <span>100%</span>
                        </div>
                        <div class="line css"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>PROFISSIONAIS</span>
                            <span>100%</span>
                        </div>
                        <div class="line js"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>EQUIPAMENTO</span>
                            <span>100%</span>
                        </div>
                        <div class="line php"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>EFICIÊNCIA</span>
                            <span>100%</span>
                        </div>
                        <div class="line mysql"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- teams section start -->
    <section class="teams" id="teams">
        <div class="max-width">
            <h2 class="title">Minha Equipe</h2>
            <div class="carousel owl-carousel">
                <div class="card">
                    <div class="box">
                        <img src="/images/foto1.jfif" alt="">
                        <div class="text">Documentador</div>
                        <p>José Nataniel da Silva</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="/images/foto2.jpg" alt="">
                        <div class="text">Banco de Dados</div>
                        <p>Pedro Henrique Lesbrão</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="/images/foto3.jfif" alt="">
                        <div class="text">Progamador</div>
                        <p>Ricardo Prado</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- contact section start -->
    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">Contate-me</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="text">Entre em contato</div>
                    <p>Caso ocorra algum tipo de erro ou tenha alguma sugestão que queira compartilhar, mande um e-mail nos informando por favor.</p>
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Nome</div>
                                <div class="sub-title">HelpMemory</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Endereço</div>
                                <div class="sub-title">São Paulo, Brasil</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title">HelpMemory@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Escreva-me</div>
                    <form action="#">
                        <div class="fields">
                            <div class="field name">
                                <input type="text" placeholder="Nome" required>
                            </div>
                            <div class="field email">
                                <input type="email" placeholder="E-mail" required>
                            </div>
                        </div>
                        <div class="field">
                            <input type="text" placeholder="Sujeito(a)" required>
                        </div>
                        <div class="field textarea">
                            <textarea cols="30" rows="10" placeholder="Mensagem.." required></textarea>
                        </div>
                        <div class="button-area">
                            <button type="submit">Enviar Mensagem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- footer section start -->

</body>
</html>