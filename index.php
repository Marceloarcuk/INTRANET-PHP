<?php
	ob_start();

	include('conect.php');

	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html>
<head>

<?php include '@intra_head_css.php'; ?>


<title>Intranet</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">

<!--==================================================================================-->
<!--===== CABEÇALHO SUPERIOR - MENU DE NAVEGAÇÃO - BARRA DE NOTICIAS =================-->
<!--==================================================================================-->
<?php include '@intra_head.php'; ?>

<!--==================================================================================-->
<!--===== SLIDER DE NOTICIAS - BANNERS GDF ===========================================-->
<!--==================================================================================-->
  <section id="sliderSection">
    <div class="row">
<!--==================================================================================-->
<!--===== SLIDER DE NOTICIAS =========================================================-->
<!--==================================================================================-->
      <div class="col-lg-9 col-md-9 col-sm-9">
        <div class="slick_slider">
			<?php
			$sql = "SELECT  * FROM db_intranetadmin.tb_noticia
					where (ativa_principal=1) and (ativa_sistema=1) 
					ORDER BY id_noticia desc limit 3";
			$obj=$connect->prepare($sql);
			$resul= ($obj->execute()) ? $obj->fetchAll() : false;
			if($resul) {
				foreach ($resul as $noticia) {
			?>
				<div class="single_iteam"> <a href="noticias.php?id=<?php echo $noticia['id_noticia']; ?>"> <img src="intranet/adm/upload/tmp/<?php echo $noticia['img_noticia1']; ?>" alt=""></a>
					<div class="slider_article">
					<h2><a class="slider_tittle" href="noticias.php?id=<?php echo $noticia['id_noticia']; ?>"><?php echo $noticia['titulo']; ?></a></h2>
		<!--              <p>Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas imperdiet nulla nisl quis mauris. Suspendisse a pharetra urna. Morbi dui...</p>-->
					</div>
				</div>	
			<?php } } ?>		  
		</div>
	  </div>

<!--==================================================================================-->
<!--===== BANNERS 1 ++++++++++========================================================-->
<!--==================================================================================-->
      <div class="col-lg-3 col-md-3 col-sm-3">
	    <?php include '@intra_banner1.php'; ?>
      </div>
    </div>
  </section>
  
<!--==================================================================================-->
<!--===== OUTRAS NOTICIAS - FOTOGRAFIAS - BANNERS - DIÁRIO OFICIAL - FACEBOOK ========-->
<!--==================================================================================-->
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
<!--==================================================================================-->
<!--===== OUTRAS NOTICIAS ============================================================-->
<!--==================================================================================-->
		<div class="single_post_content">
            <h2><span>Últimas Notícias</span></h2>
            <div class="single_post_content_left">
              <ul class="spost_nav">
					<?php
					$sql = "SELECT  * FROM db_intranetadmin.tb_noticia
							where  (ativa_sistema=1) and (ativa_principal!=1) ORDER BY id_noticia desc limit 8";
					$obj=$connect->prepare($sql);
					$resul= ($obj->execute()) ? $obj->fetchAll() : false;
					$idUltimo = 0;
					if($resul) {
						foreach ($resul as $noticia) {
							if ($idUltimo < 4){
					?>
						<li>
						<div class="media wow fadeInDown"> <a href="noticias.php?id=<?php echo $noticia['id_noticia']; ?>" class="media-left"> <img alt="" src="/intranet/adm/upload/tmp/<?php echo $noticia['img_noticia1']; ?>"> </a>
							<div class="media-body"> <a href="noticias.php?id=<?php echo $noticia['id_noticia']; ?>" class="catg_title"><?php echo $noticia['titulo']; ?></a> </div>
						</div>
						</li>
					<?php 
								$idUltimo=$idUltimo+1;
							}
							else {
								$idUltimo=$noticia['id_noticia'];
								break;
							}
						} 
					} ?>	
              </ul>
            </div>
            <div class="single_post_content_right">
              <ul class="spost_nav">
					<?php
					$sql = "SELECT  * FROM db_intranetadmin.tb_noticia
							where (ativa_sistema=1) and (ativa_principal!=1) ORDER BY id_noticia desc limit 8";
					$obj=$connect->prepare($sql);
					$resul= ($obj->execute()) ? $obj->fetchAll() : false;
					if($resul) {
						foreach ($resul as $noticia) {
							if ($idUltimo >= $noticia['id_noticia']){
					?>
						<li>
						<div class="media wow fadeInDown"> <a href="noticias.php?id=<?php echo $noticia['id_noticia']; ?>" class="media-left"> <img alt="" src="/intranet/adm/upload/tmp/<?php echo $noticia['img_noticia1']; ?>"> </a>
							<div class="media-body"> <a href="noticias.php?id=<?php echo $noticia['id_noticia']; ?>" class="catg_title"><?php echo $noticia['titulo']; ?></a> </div>
						</div>
						</li>
					<?php 
							}
						} 
					} ?>	
              </ul>
            </div>
        </div>
	  
<!--==================================================================================-->
<!--===== FOTOGRAFIAS ================================================================-->
<!--==================================================================================-->
		<?php
		$sql = "SELECT * FROM db_intranetadmin.tb_fotos WHERE (ativa_sistema=1) and (ativa_principal=1) 
				ORDER BY id_foto desc limit 6";
		$obj=$connect->prepare($sql);
		$resul= ($obj->execute()) ? $obj->fetchAll() : false;
		
		if($resul) {
		?>
        <div class="single_post_content">
          <h2><span><a href="/fotografias.php"><font color="#fff">Fotografias</font></a></span></h2>
          <ul class="photograph_nav  wow fadeInDown">
			<?php
				foreach ($resul as $Fotografia) {
			?>
            <li>
              <div class="photo_grid">
                <figure class="effect-layla"> 
					<a class="fancybox-buttons" data-fancybox-group="button" href="/intranet/adm/upload/fotos/<?php echo $Fotografia['nome_foto']; ?>" title="<?php echo $Fotografia['desc_foto']; ?>"> 
						<img src="/intranet/adm/upload/fotos/<?php echo $Fotografia['nome_foto']; ?>" alt=""/>
					</a> 
				</figure>
              </div>
            </li>				
			<?php } ?>			  
          </ul>
        </div>
		<?php } ?>			  

	  </div>
<!--==================================================================================-->
<!--===== BANNERS 2 ==================================================================-->
<!--==================================================================================-->	  
      <div class="col-lg-3 col-md-3 col-sm-3">
	    <?php include '@intra_banner2.php'; ?>
      </div>
	  
    </div>
	
<!--==================================================================================-->
<!--===== DIÁRIO OFICIAL - FACEBOOK ==================================================-->
<!--==================================================================================-->
    <div class="row">
	  <?php include '@intra_dou_face.php'; ?>
    </div>
  </section>

<!--==================================================================================-->
<!--===== RODAPÉ =====================================================================-->
<!--==================================================================================-->	  
  <?php	//include('@intra_rodape.php'); ?>
</div>

</body>
</html>
<?
  ob_flush();
?> 