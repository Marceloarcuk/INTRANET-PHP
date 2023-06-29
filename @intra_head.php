<?PHP 
	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');
    $dt = date('Y-m-d');
	$data= strftime("%d de %B de %Y", strtotime($dt));
echo '
<!--==================================================================================-->
<!--===== CABEÇALHO SUPERIOR =========================================================-->
<!--==================================================================================-->
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
		  <p></p>
          </div>
          <div class="header_top_right">
			<p>' . $data . '</p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
          <div class="logo_area"><a href="index.php" class="logo"><img src="images/logo_Intra.png" alt=""></a></div>
          <div class="add_banner"><a href="#"></a></div>
        </div>
      </div>
    </div>
  </header>

<!--==================================================================================-->
<!--===== MENU DE NAVEGAÇÃO ==========================================================-->
<!--==================================================================================-->
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="/"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
          <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Espaço do Servidor</a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Contra-cheque</a></li>
              <li><a href="#">SICOP</a></li>
              <li><a href="#">Calendário</a></li>
              <li><a target="_blank" href="https://cas.gdfnet.df.gov.br/owa/">Web Mail</a></li>
            </ul>
          </li>
          <li><a href="/noticias.php">Notícias</a></li>
          <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Sistemas</a>
            <ul class="dropdown-menu" role="menu">
              <li><a target="_blank" href="https://sei.df.gov.br">SEI</a></li>
              <li><a target="_blank" href="/atendimento">SAU - Atendimento ao Usuário</a></li>
            </ul>
          </li>
          <li><a target="_blank" href="https://cas.gdfnet.df.gov.br/owa/">Web Mail</a></li>
		  <li><a href="/fotografias.php">Fotografias</a></li>
        </ul>
      </div>
    </nav>
  </section>
  
<!--==================================================================================-->
<!--===== BARRA DE NOTICIAS - DESTAQUE ===============================================-->
<!--==================================================================================-->
  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Destaques</span>
          <ul id="ticker01" class="news_sticker">
';		  
			$sql = "SELECT  * FROM db_intranetadmin.tb_noticia
                    where  (ativa_sistema=1) and (ativa_destaque=1) ORDER BY id_noticia desc limit 6";
			$obj=$connect->prepare($sql);
			$resul= ($obj->execute()) ? $obj->fetchAll() : false;
			if($resul) {
				foreach ($resul as $noticia) {
					$idNot = $noticia["id_noticia"];
					$imgNot = $noticia["img_noticia1"];
					$titNot = $noticia["titulo"];
echo'				<li><a href="noticias.php?id=' . $idNot . '"><img src="intranet/adm/upload/tmp/' . $imgNot . '" alt="">' . $titNot . '</a></li>';
			    }
			} 
echo'			
          </ul>
        </div>
      </div>
    </div>
  </section>  
';		