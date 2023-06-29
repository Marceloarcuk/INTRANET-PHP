
<?php
		  
		  $pag_ant = 1;
		  $reg_1_ant = 1;
		  
		  $pag_pos = $pag_atual + 1;
		  $reg_1_pos = ($num2 * $pag_pos) - $num2 + 1;
		  
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
	
				$pag_ant = $pag_atual - 1;
				if ($pag_ant==0) $pag_ant=1;
				$reg_1_ant = ($num2 * $pag_ant) - $num2 + 1;
				
				$pag_pos = $pag_atual + 1;
				$reg_1_pos = ($num2 * $pag_pos) - $num2 + 1;
			  }
			}catch(PDOException $e_i){
				echo '<font color = #CC0000>Falha na visualização.<br><br>'. $e_i->getMessage() . '</font>';
			}	
		  }
		  if ($reg_1_pos>$num_tot){
 		    $pag_pos = $pag_atual;
		    $reg_1_pos = $reg_1;
		  }		  
		  echo'<ul class="pagination">
				<li>&laquo;</li>
				<li>&nbsp;<strong><a href="/' . $ArqPHP . '" title="Início">Início</a></strong>&nbsp;</li>
				<li>&nbsp;<strong><a href="/' . $ArqPHP . '?start=' . $reg_1_ant . '" title="Anterior">Anterior</a></strong>&nbsp;</li>';			
			
		  $pag_ini = 1;
		  $pag_fim = 10;
		  if ($pag_atual > $pag_fim){
			$pag_ini = $pag_atual-9;
			$pag_fim = $pag_atual;
		  }
		  if ($pag_tot<10) $pag_fim = $pag_tot;
		  
		  for ($pag = $pag_ini; $pag <= $pag_fim; $pag++) {
			$reg_start = ($num2 * $pag) - $num2 + 1;
			if ($pag == $pag_atual)
			  echo'<li>&nbsp;<strong><a href="/' . $ArqPHP . '?start=' . $reg_start . '" title="' . $pag . '"><font color="#FE9A2E">' . $pag . '</font></a></strong>&nbsp;</li>';		  
			else
			  echo'<li>&nbsp;<strong><a href="/' . $ArqPHP . '?start=' . $reg_start . '" title="' . $pag . '">' . $pag . '</a></strong>&nbsp;</li>';		  
		  } 
		  echo' <li>&nbsp;<strong><a href="/' . $ArqPHP . '?start=' . $reg_1_pos . '" title="Próximo">Próximo</a></strong>&nbsp;</li>
				<li>&nbsp;<strong><a href="/' . $ArqPHP . '?start=' . $num_tot . '" title="Fim">Fim</a></strong>&nbsp;</li>
				<li>&raquo;</li>
			  </ul>';
			  
?>

