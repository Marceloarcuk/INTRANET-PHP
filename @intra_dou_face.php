<?php
echo'
<!--==================================================================================-->
<!--===== DIÁRIO OFICIAL - FACEBOOK ==================================================-->
<!--==================================================================================-->
    <div class="row">
<!--==================================================================================-->
<!--===== DIÁRIO OFICIAL =============================================================-->
<!--==================================================================================-->
      <div class="col-lg-4 col-md-4 col-sm-4">
		<div class="single_post_content">
            <h2><span>Diário Oficial</span></h2>
			<center>
			    <script language="javascript" type="text/javascript">
			    	function iFrameHeight() {

';
echo"
					var h = 0;
			    		if ( !document.all ) {
			    			h = document.getElementById('blockrandom').contentDocument.height;
			    			document.getElementById('blockrandom').style.height = h + 60 + 'px';
			    		} else if( document.all ) {
			    			h = document.frames('blockrandom').document.body.scrollHeight;
			    			document.all.blockrandom.style.height = h + 20 + 'px';
			    		}
";		
echo'				
			    	}
			    </script>
			    <iframe id="blockrandom"
			    	name="diario_oficial"
			    	src="http://www.buriti.df.gov.br/ftp/novo_portal_gdf/novo_dodf.asp"
			    	width="360"
			    	height="360"
			    	scrolling="no"
			    	align="top"
			    	frameborder="0"
			    	class="wrapper_box_padrao">
			    	Sem Iframes
			    </iframe>	
			</center>			
	    </div>
      </div>
<!--==================================================================================-->
<!--===== FACEBOOK ===================================================================-->
<!--==================================================================================-->
<!--
      <div class="col-lg-5 col-md-5 col-sm-5">
		<div class="single_post_content">
			<p><iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FSecretariadaCriancadoDistritoFederal&amp;width=360&amp;height=284&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border: none; overflow: hidden; width: 360px; height: 284px; margin-top: 5px;" allowtransparency="true" width="360px" height="284px"></iframe></p>		
	    </div>
      </div>
    </div>
-->	
';
?>
