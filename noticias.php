<?php
	ob_start();

	include('conect.php');

	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');
	
	$TotalNoticiasLista=10;
	$ArqPHP = 'noticias.php';
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
<!--===== CABEÇALHO SUPERIOR - MENU DE NAVEGAÇÃO - BARRA DE NOTICIAS =================-->
<!--==================================================================================-->
<?php include '@intra_head.php'; ?>

<!--==================================================================================-->
<!--===== NOTICIA - BANNERS ==========================================================-->
<!--==================================================================================-->
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-9">
    <?php
//<!--==================================================================================-->
//<!--===== TEXTO DA NOTÍCIA ===========================================================-->
//<!--==================================================================================-->
    if(isset($_GET['id'])){
	  try{
		if ($_GET['id'] != ""){
  	      $sql = "select * from tb_noticia where id_noticia= ".$_GET['id'].";";
          $obj=$connect->prepare($sql);
          $resul= ($obj->execute()) ? $obj->fetchAll() : false;
  		  foreach ($resul as $noticia);
  		  echo '<h3>' . $noticia['titulo'] . '</h3><BR>';
  		  echo $noticia['texto'];
		}
	  }catch(PDOException $e_i){
	  	echo '<font color = #CC0000>Falha na visualização da notícia.<br><br>'. $e_i->getMessage() . '</font>';
	  }	
    }
//<!--==================================================================================-->
//<!--===== LISTA DE NOTÍCIAS - PAGINAÇÃO ==============================================-->
//<!--==================================================================================-->		
	else{
		  
  	      $sql = "SELECT count(id_noticia) as total FROM db_intranetadmin.tb_noticia where (ativa_sistema=1);";
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
		  //NOTÍCIAS
		  
		  $sql = "SELECT  * from (SELECT  @row_num := @row_num + 1 AS ID_Number, t.* FROM (select * from tb_noticia WHERE ativa_sistema=1) t, (SELECT @row_num := 0) x ORDER BY t.id_noticia desc) y
				  WHERE ID_Number>=" . $reg_1 . " and ID_Number <=" . $reg_Ult . ";";		  
		  $obj=$connect->prepare($sql);
		  $resul= ($obj->execute()) ? $obj->fetchAll() : false;
		  foreach ($resul as $noticia){
			  $date=strftime('%d de %B de %Y', strtotime($noticia['sis_dt_insert_noticia']))
		  ?>
			<h3><a href="noticias.php?id=<?php echo $noticia['id_noticia']; ?>"><?php if ($noticia['titulo']=='') echo '<i><font color="#FE9A2E">Sem Título</font></i>'; else echo $noticia['titulo']; ?></a></h3>
			<span>Publicado em <?php echo $date;?></span>
			<hr>			  
			  
		  <?php	
		  }// FIM foreach ($resul as $noticia){
			  
			
		  //--------------------------------------------------------
		  //PAGINAÇÃO
		  include('@intra_pagination.php');		
		  echo'<br><br>';
		  
	}// FIM ELSE if(isset($_GET['id'])){
/*    echo'<br><br>';
		echo $sql;
		echo '<br><br><br>';
		echo '$inteiro' . $inteiro . '<br>';
		echo '$resto' . $resto . '<br>';
		echo '$pag_tot - ' . $pag_tot . '<br>';
		echo '$pag_atual - ' . $pag_atual . '<br>';
		echo '$reg_1 - ' . $reg_1 . '<br>';
		echo '$reg_Ult - ' . $reg_Ult . '<br>';
		
		echo '$pag_ant - ' . $pag_ant . '<br>';
		echo '$reg_1_ant - ' . $reg_1_ant . '<br>';
		echo '$pag_pos - ' . $pag_pos . '<br>';
		echo '$reg_1_pos - ' . $reg_1_pos . '<br>';
*/
    ?>
	  </div>
<!--==================================================================================-->
<!--===== BANNERS 1 - BANNERS 2 ======================================================-->
<!--==================================================================================-->
      <div class="col-lg-3 col-md-3 col-sm-3">
	    <?php include '@intra_banner1.php'; 
		      include '@intra_banner2.php';?>
      </div>
    </div>
	
<!--==================================================================================-->
<!--===== DIÁRIO OFICIAL - FACEBOOK ==================================================-->
<!--==================================================================================-->	
    <div class="row">
	  <?php //include '@intra_dou_face.php'; ?>
    </div>

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