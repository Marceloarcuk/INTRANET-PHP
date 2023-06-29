<?php
	ob_start();

	include('conect.php');

	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');
	
	$TotalNoticiasLista=18;
	$ArqPHP = 'fotografias.php';
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

<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">

<!--==================================================================================-->
<!--===== CABEÇALHO SUPERIOR - MENU DE NAVEGAÇÃO =====================================-->
<!--==================================================================================-->
<?php include '@intra_head.php'; ?>
  
<!--==================================================================================-->
<!--===== FOTOGRAFIAS - BANNERS - DIÁRIO OFICIAL - FACEBOOK ==========================-->
<!--==================================================================================-->
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
  
<!--==================================================================================-->
<!--===== FOTOGRAFIAS ================================================================-->
<!--==================================================================================-->
        <div class="single_post_content">
          <h2><span>Fotografias</span></h2>
		  <div class="single_post_content">
			<?php
			$sql = "SELECT count(id_foto) as total FROM db_intranetadmin.tb_fotos WHERE ativa_sistema=1;";
			$obj=$connect->prepare($sql);
			$resul= ($obj->execute()) ? $obj->fetchAll() : false;
			foreach ($resul as $noticia);
			$pag_tot = 0;
			$num1 = 0;
			$num2 = $TotalNoticiasLista;
	
			$num_tot = $noticia['total'];
			$num1 = $noticia['total'];
			if ($num1 < 1) $num1=0;
			$inteiro = (int)($num1 / $num2);
			$resto = $num1 % $num2;
			if($resto>0) $pag_tot = 1;
			$pag_tot = $pag_tot + $inteiro;
			$pag_atual = 1;
			$reg_1 = 1;
			$reg_Ult = ($num2 * $pag_atual);
			//--------------------------------------------------------
			//VERIFICA QUAL O 1 E O ÚLTIMO REGISTRO DA PÁGINA
			if(isset($_GET['start'])){
				try{
				if ($_GET['start'] != ""){
					$num1 = $_GET['start'];
					if ($num1 < 1) $num1=0;
					$inteiro = (int)($num1 / $num2);
					$resto = $num1 % $num2;
					$pag_atual = 0;
					if($resto>0) $pag_atual = 1;
					$pag_atual = $pag_atual + $inteiro;
					$reg_1 = ($num2 * $pag_atual) - $num2 + 1;
					$reg_Ult = ($num2 * $pag_atual);
				}
				}catch(PDOException $e_i){
					echo '<font color = #CC0000>Falha na visualização da notícia.<br><br>'. $e_i->getMessage() . '</font>';
				}	
			}
			//--------------------------------------------------------
			//PAGINAÇÃO
			include('@intra_pagination.php');		  
			
			//--------------------------------------------------------
			//FOTOGRAFIAS
			?>
			<ul class="photograph_nav">
				<?php
				$sql = "SELECT  * from (SELECT  @row_num := @row_num + 1 AS ID_Number, t.* FROM (select * from tb_fotos WHERE ativa_sistema=1) t, (SELECT @row_num := 0) x ORDER BY t.id_foto desc) y
						WHERE ID_Number>=" . $reg_1 . " and ID_Number <=" . $reg_Ult . ";";		  
				$obj=$connect->prepare($sql);
				$resul= ($obj->execute()) ? $obj->fetchAll() : false;
				if($resul) {
					foreach ($resul as $Fotografia) {
				?>
				<li>
				<div class="photo_grid">
					<figure class="effect-layla"> 
						<a class="fancybox-buttons" data-fancybox-group="button" href="intranet/adm/upload/fotos/<?php echo $Fotografia['nome_foto']; ?>" title="<?php echo $Fotografia['desc_foto']; ?>"> 
							<img src="intranet/adm/upload/fotos/<?php echo $Fotografia['nome_foto']; ?>" alt=""/>
						</a> 
					</figure>
				</div>
				</li>				
				<?php 
					} 
				} ?>
			</ul>
		  </div>
		  <!---------------------------------------------------------->
		  <!--   PAGINAÇÃO                                          -->
		  <div class="single_post_content">
		    <?php include('@intra_pagination.php'); ?>
          </div>
        </div>
	  </div>
<!--==================================================================================-->
<!--===== BANNERS 2 ==================================================================-->
<!--==================================================================================-->	  
      <div class="col-lg-3 col-md-3 col-sm-3">
	    <?php include '@intra_banner1.php'; ?>
		<br>
	    <?php include '@intra_banner2.php'; ?>
      </div>
	  
    </div>
	
<!--==================================================================================-->
<!--===== DIÁRIO OFICIAL - FACEBOOK ==================================================-->
<!--==================================================================================-->
    <!--<div class="row">
	  <?php //include '@intra_dou_face.php'; ?>
    </div>-->
  </section>

  
<!--==================================================================================-->
<!--===== RODAPÉ =====================================================================-->
<!--==================================================================================-->	  
  <?php	include('@intra_rodape.php'); ?>

</div>

</body>
</html>
<?
  ob_flush();
?> 